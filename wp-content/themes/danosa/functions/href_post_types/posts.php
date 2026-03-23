<?php



class  syncPostType{

  public static function execute($config,$post_type_config){
 
    global $wpdb;
    global $post;
    $post_type = $post_type_config["post_type"];
    $blog_ids = get_sites();
 
    if(!isset($_GET["nolog"])) print_r($post_type_config);
 
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

      if( (count($config["sites"]) == 0 || in_array($blog->blog_id,$config["sites"])) 
          && (count($config["exclude_sites"]) == 0 || !in_array($blog->blog_id,$config["exclude_sites"]))   ){
        if(!isset($_GET["nolog"])) echo "BLOG_ID: ".$blog->blog_id." ".$blog->path."<br>" .PHP_EOL;
        switch_to_blog( $blog->blog_id );
 
        if(isset($_GET["reference"])){
            $args = array(
                            'posts_per_page' => 1,
                            'post_type'  => $post_type,
                            'post_status' => 'publish',
                            'meta_query' => array( array(
                                                    'key' => $post_type_config["sync_field"],
                                                    'value' => $_GET["reference"],
                                                    'compare' => '='
                                                        ),
                                                  ),
                                    );
        }else{
          $args = array(
            'numberposts'      => -1,
            'posts_per_page'   => -1,
            'post_status' => 'publish',
            'post_type'  => $post_type
          );
        }
      

	

        $the_query = new WP_Query( $args );
        $n_posts = 0;


        if ( $the_query->have_posts() ) {
            if(isset($_GET["reference"])){
                if(!isset($_GET["nolog"])) echo "have posts for ".$_GET["reference"] ."<br>".PHP_EOL;
            } else{
                if(!isset($_GET["nolog"])) echo "have posts" ."<br>".PHP_EOL;
            }
            $sin_referencia = 0;

 
          while ( $the_query->have_posts() ) {
            switch_to_blog( $blog->blog_id );
            $the_query->the_post();           
            
            add_post_meta( $post->ID, "multisite_hreflang", "", true)  ;
            $hreflang = get_post_meta($post->ID,"multisite_hreflang",true);
         
            if( ($hreflang == "") 
                || ( isset($post_type_config["refresh_all"])? $post_type_config["refresh_all"] : $config["refresh_all"])){
                 
              if($post_type_config["post_meta"]){
                      $compare =  get_post_meta($post->ID,$post_type_config["sync_field"],true);
              }else{
                      $compare =  get_post_field($post_type_config["sync_field"],$post);
              }

              
               


              


            

              $hreflang = array();
              if($compare == "" || $compare == "default"){    
                $sin_referencia += 1;
                 update_post_meta( $post->ID,"multisite_hreflang",    $hreflang   );
              }else{

  


                if(!array_key_exists($compare,$compared)){
                    $kink  = get_permalink( $post->ID);
                    $kink = apply_filters( 'hreflang_link',$blog->blog_id, $post->ID, $kink);
                    //$kink = get_blog_permalink( $blog->blog_id,$post->ID);
                    if(isset($_GET["reference"])){
                        if(  $_GET["reference"] != $compare ){
                            continue;
                        }else{
                            if(!isset($_GET["nolog"])) echo $post->ID." compare: ".$compare." ".$kink ."<br>".PHP_EOL;                  
                        }
                    }else{
                        if(!isset($_GET["nolog"])) echo $post->ID." compare: ".$compare." ".$kink ."<br>".PHP_EOL;   
                    }
                    $compared[$compare] = array();
                }else{         
                    if(!isset($_GET["nolog"])) echo $post->ID." Already compared ".$compare ."<br>".PHP_EOL;
                    continue;
                }
                
                
                
               
                if(isset($_GET["reference"])){
                    if(!isset($_GET["nolog"])) echo "LINK: ". $kink  ."<br>".PHP_EOL;                   
                }
                $lang = str_replace("/","",$blog->path);   
                if(isset($config["replaces"]) && array_key_exists($lang,$config["replaces"])) {
                    $lang = $config["replaces"][$lang];
                }
                $link = '<link   rel="alternate" hreflang="'. $lang .'" href="'.$kink.'" />';
                $hreflang[$lang] = $link;
                if(!isset($_GET["nolog"])) echo "[";
                foreach( $blog_ids as $other_blog ){
                 
                  if( (count($config["sub_sites"]) == 0 || in_array($other_blog->blog_id,$config["sub_sites"])) 
                      &&   (count($config["exclude_sub_sites"]) == 0 || !in_array($other_blog->blog_id,$config["exclude_sub_sites"])) 
                      && ($other_blog->blog_id  !=  $blog->blog_id ) ){

                        if(!isset($_GET["nolog"])) echo $other_blog->path ;
                       
                       
                       if(isset($_GET["reference"])){
                            if(!isset($_GET["nolog"])) echo "COMPARE IN: ".$other_blog->blog_id ." ".$other_blog->path."<br>".PHP_EOL;
                        }

                    switch_to_blog( $other_blog->blog_id );
                         
                    if($post_type_config["post_meta"]){
                        $args2 = array(
                        'posts_per_page' => 1,
                        'post_type'  => $post_type,
                        'post_status' => 'publish',
                        'meta_query' => array( 
                            array(
                                'key' => $post_type_config["sync_field"],
                                'value' => $compare,
                                'compare' => '='
                            ),
                        ),
                        );
                        $langage_posts = get_posts( $args2 );
                    }else{
                        $search_query = "SELECT ID FROM {$wpdb->prefix}posts
                                                 WHERE post_type = '".$post_type."' 
                                                 AND post_status = 'publish' 
                                                 AND ".$post_type_config["sync_field"]." = %s";

               
 
                        $langage_posts = $wpdb->get_results($wpdb->prepare($search_query, $compare));                 
                        
           
                        
                      //  $langage_posts = array_column($results[0], 'ID');
               
                    }
            
             
              
                    if(is_array($langage_posts) && count($langage_posts) > 0){
                     
                        $lang = str_replace("/","",$other_blog->path); 
                        if(isset($config["replaces"]) && array_key_exists($lang,$config["replaces"])) {
                            $lang = $config["replaces"][$lang];
                        }
  
                        // $permalink  = get_blog_permalink($other_blog->blog_id , $langage_posts[0]->ID);    
                        $permalink = get_permalink($langage_posts[0]->ID);    
                        $permalink = apply_filters( 'hreflang_link',$other_blog->blog_id,$langage_posts[0]->ID, $permalink);
                        if(isset($_GET["reference"])){
                            if(!isset($_GET["nolog"])) echo $lang.": ".$permalink ."<br>".PHP_EOL;                        
                        }
                       
                        $link = '<link   rel="alternate" hreflang="'. $lang .'" href="'.$permalink.'" />';
                        $hreflang[$lang] = $link;
                        $compared[$compare][$other_blog->blog_id] = $langage_posts[0]->ID;
                        if(!isset($_GET["nolog"])) echo "+ " ;
                        switch_to_blog( $blog->blog_id );
                        update_post_meta( $post->ID,"multisite_hreflang",    $hreflang   );
                    }else{                     
                      if(!isset($_GET["nolog"])) echo "- " ;
                    }//IF HAS HREFLANG
  
                  }//IF process sub blog
                   
                } // foreach sub blog
                if(!isset($_GET["nolog"])) echo "]<br>";
                if(is_array($compared[$compare])){
                  foreach($compared[$compare] as $other_blog_id => $post_id){
                    switch_to_blog( $other_blog_id );
                    
                    if(isset($_GET["reference"])){
                      if(!isset($_GET["nolog"])) echo "COPY THE SAME HREFLANG TO BLOG ".$other_blog_id .":".$post_id."<br>".PHP_EOL;                     
                    }                  
                    update_post_meta( $post_id,"multisite_hreflang",    $hreflang   );
                  }
                }
                $compared[$compare] = "";
              } // ELSE default
              if($sin_referencia > 0){
               if(!isset($_GET["nolog"])) echo "Sin Referencia: ".$sin_referencia."<br>";
              }

            } // IF REFRESH
              $n_posts ++;
          } // WHILE HAS POSTS

          wp_reset_postdata();
          
        }else{
          if(isset($_GET["reference"])){
        
            if(!isset($_GET["nolog"])) echo "no have posts" ."<br>".PHP_EOL;
          }
        }//IF HAS POSTS

        restore_current_blog();

      } //IF PROCESS BLOG

    } // FOREACH BLOG

    restore_current_blog();
  } // FUNCTION
   
} //CLASS
