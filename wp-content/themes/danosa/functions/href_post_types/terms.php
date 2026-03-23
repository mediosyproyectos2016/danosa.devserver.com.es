<?php



class  syncPostType{

    public static function execute($config,$post_type_config){
        global $wpdb;
        $blog_ids = get_sites();
        $compared = array();
        foreach( $blog_ids as $blog ){
            if(!isset($_GET["nolog"])) echo "<br>----------------------------------------------<br>".PHP_EOL;
            if(isset($_GET["site"]) ) {
                if($_GET["site"] != $blog->blog_id ){
                    continue;
                }else{
                    if(!isset($_GET["nolog"])) echo "BLOG_ID: ".$blog->blog_id .PHP_EOL;
                }
            }elseif(isset($_GET["reference"])){
                if(!isset($_GET["nolog"])) echo "BLOG_ID: ".$blog->blog_id."<br>" .PHP_EOL;
            }
            if((count($config["sites"]) == 0 || in_array($blog->blog_id,$config["sites"])) && (count($config["exclude_sites"]) == 0 || !in_array($blog->blog_id,$config["exclude_sites"]))   ){

                if(!isset($_GET["nolog"])) echo "BLOG_ID: ".$blog->blog_id." ".$blog->path."<br>" .PHP_EOL;

                switch_to_blog( $blog->blog_id );
                $terms = get_terms( $post_type_config["taxonomy"], array(  'hide_empty' => false,    ) );


               
                $sin_referencia = 0;
                foreach ($terms as $term ) {                                    switch_to_blog( $blog->blog_id );

                    add_term_meta ( $term->term_id, "multisite_hreflang", "", true)  ;
                    //echo $wpdb->last_error.' '; echo $wpdb->last_query;
                    $hreflang = get_term_meta($term->term_id,"multisite_hreflang",true);
                    if($hreflang == "" || ( isset($post_type_config["refresh_all"])? $post_type_config["refresh_all"] : $config["refresh_all"])){
                        if($post_type_config["post_meta"]){
                            $compare =  get_term_meta($term->term_id,$post_type_config["sync_field"],true);
                        }else{
                            if($post_type_config["sync_field"] == "name"){
                                $compare =  $term->name;
                            }else{
                                $arr = $term->to_array();
                                $compare =  $arr[$post_type_config["sync_field"]];
                            }
                        }
                        $hreflang = array();
                        if($compare == "" || $compare == "default"){    
                            $sin_referencia += 1;
                            update_term_meta( $term->term_id,"multisite_hreflang",    $hreflang   );
                        }else{               
 
                            if(!array_key_exists($compare,$compared)){
                                $kink  = get_term_link( $term);
                                $kink = apply_filters( 'hreflang_link',$blog->blog_id, $term->term_id, $kink);
                                if(isset($_GET["reference"])){
                                    if(  $_GET["reference"] != $compare ){
                                        continue;
                                    }else{
                                        if(!isset($_GET["nolog"])) echo $term->term_id." compare: ".$compare." ".$kink ."<br>".PHP_EOL;                  
                                    }
                                }else{
                                    if(!isset($_GET["nolog"])) echo $term->term_id." compare: ".$compare." ".$kink ."<br>".PHP_EOL;   
                                }
                                $compared[$compare] = array();
                            }else{         
                                if(!isset($_GET["nolog"])) echo $term->term_id." Already compared ".$compare ."<br>".PHP_EOL;
                                continue;
                            }

                            $lang = str_replace("/","",$blog->path);   
                            if(isset($config["replaces"]) && array_key_exists($lang,$config["replaces"])) {
                                $lang = $config["replaces"][$lang];
                            }
                            $link = '<link   rel="alternate" hreflang="'. $lang .'" href="'.$kink.'" />';
                            $hreflang[$lang] = $link;
                            
                            if(!isset($_GET["nolog"])) echo "[";
                            foreach( $blog_ids as $other_blog ){
                                if( (count($config["sub_sites"]) == 0 || in_array($other_blog->blog_id,$config["sub_sites"])) &&   (count($config["exclude_sub_sites"]) == 0 || !in_array($other_blog->blog_id,$config["exclude_sub_sites"])) && $other_blog->blog_id  !=  $blog->blog_id ){
                                    if(!isset($_GET["nolog"])) echo $other_blog->path ;
                                    switch_to_blog( $other_blog->blog_id );
                                    $terms2 = get_terms( $post_type_config["taxonomy"], array( 'hide_empty' => false, ) );

                                    if(is_array($terms2) && count($terms2) > 0){
                                        foreach ($terms2 as $term2) {
                                            if($post_type_config["post_meta"]){
                                                $compare2 =  get_term_meta($term2->term_id,$post_type_config["sync_field"],true);
                                            }else{
                                                if($post_type_config["sync_field"] == "name"){
                                                    $compare2 =  $term2->name;
                                                }else{
                                                    $arr = $term2->to_array();
                                                    $compare2 =  $arr[$post_type_config["sync_field"]];
                                                }
                                            }
                                            //print_r("compare2 ".$compare2."<br>" );
                                            if($compare2 == $compare){
                                                $lang = str_replace("/","",$other_blog->path);
                                                $permalink  = get_term_link( $term2->term_id);
                                                $link = '<link   rel="alternate" hreflang="'. $lang .'" href="'.$permalink.'" />';
                                                $link = apply_filters( 'hreflang_link',$other_blog->blog_id, $term2->term_id, $link);
                                                $hreflang[$lang] = $link;
                                                $compared[$compare][$other_blog->blog_id] = $term2->term_id;
                                                if(!isset($_GET["nolog"])) echo "+ " ;
                                            }
                                        }
                                        switch_to_blog( $blog->blog_id );        
                                        update_term_meta( $term->term_id,"multisite_hreflang",    $hreflang   );
                                    }else{
                                          if(!isset($_GET["nolog"])) echo "- " ;
                                    }
                                }// IF PROCESS SUB BLOG
                            } //FOREACH SUB BLOG
                            if(!isset($_GET["nolog"])) echo "]<br>";
                            if(is_array($compared[$compare])){
                                foreach($compared[$compare] as $other_blog_id => $term_id){
                                    switch_to_blog( $other_blog_id );                    
                                    if(isset($_GET["reference"])){
                                        if(!isset($_GET["nolog"])) echo "COPY THE SAME HREFLANG TO BLOG ".$other_blog_id .":".$term_id."<br>".PHP_EOL;                     
                                    }            
                                    update_term_meta( $term->term_id,"multisite_hreflang",    $hreflang   );
                                }
                            }
                            $compared[$compare] = "";
                        }//IF COMPARE                       
                    } // IF REFRESH
                } // foreach Term
                if($sin_referencia > 0){
                    if(!isset($_GET["nolog"])) echo "Sin Referencia: ".$sin_referencia."<br>";
                }
                restore_current_blog();
            } //IF PROCESS BLOG
        } // FOREACH BLOG
    } // function
} // END CLASS