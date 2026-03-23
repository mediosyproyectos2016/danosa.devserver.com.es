<?php
/*
Template Name: Danosa - Form Views
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if(!isset($_REQUEST["csv"])){
    get_header();
}


$image = get_field("image");
$title = get_field("title");
$description = get_field("description");

if(empty($title)){
    $title = get_the_title();
}
 
if ( post_password_required( get_the_ID())) {
    echo get_the_password_form( get_the_ID());
} else {



    global $wpdb;  
    $query = 'select * from '.$wpdb->base_prefix.'blogs where blog_id != 1';
        
    $sites = $wpdb->get_results($query , OBJECT ); // VAMOS A RECOGER TODOS LOS SITES


    $c = 0;
    $query = "Select * from (";
    $country_select = "<option value='all'>".__("All")."</option>";
    $params = array();
    foreach( $sites as $i => $site ){
        create_dynamics_tables($wpdb->base_prefix.$site->blog_id."_");
        if(!isset($_REQUEST["cid"]) || $_REQUEST["cid"] == $site->blog_id || $_REQUEST["cid"] == "all"  ){

            if($c != 0){
                $query .= " UNION ALL ";
            }


            if(isset($_REQUEST["csv"]) && is_user_logged_in() && false){            
                $query .= "select '".str_replace("/","",$site->path)."' as blog,".$site->blog_id." as blog_id, a.id,a.guid,a.type,a.created_at,a.json_data,a.status,a.comments,b.nombre,b.apellidos,b.email,b.telefono,b.empresa,b.actividad,b.ciudad,b.cpos,b.pais,b.acceptacion,b.consulta,b.comentarios from ".$wpdb->base_prefix.$site->blog_id."_dynamics_form a inner join ".$wpdb->base_prefix.$site->blog_id.'_dynamics_form_contact b on a.guid = b.guid';
            }else{
                $query .= "select '".str_replace("/","",$site->path)."' as blog,".$site->blog_id." as blog_id, id,guid,type,created_at,json_data,status,comments from ".$wpdb->base_prefix.$site->blog_id."_dynamics_form";
            }

            $query .= " where 1=1 ";
      
            if(isset($_REQUEST["status"]) && $_REQUEST["status"] != "" && $_REQUEST["status"] != "all"){
                    $query .= "and IFNULL(status,0) = %d ";
                    $params[] = $_REQUEST["status"];
            }
            if(isset($_REQUEST["guid"]) && trim($_REQUEST["guid"]) != ""){
                    $query .= "and guid = %s ";
                    $params[] = trim($_REQUEST["guid"]);
            }
            if(isset($_REQUEST["type"]) && $_REQUEST["type"] != "" && $_REQUEST["type"] != "all"){
                    $query .= "and type = %s ";
                    $params[] = $_REQUEST["type"];
            }
            if(isset($_REQUEST["date"]) && $_REQUEST["date"] != "" ){
                    $query .= "and DATE(created_at) = %s ";
                    $params[] = $_REQUEST["date"];
            }
            if(isset($_REQUEST["title"]) && $_REQUEST["title"] != "" ){
                    $query .= "and json_data like %s  ";
                    $params[] ='%'.$_REQUEST["title"].'%' ;
            }
            if(isset($_REQUEST["file_name"]) && $_REQUEST["file_name"] != "" ){
                    $query .= "and json_data like %s  ";
                    $params[] ='%'.$_REQUEST["file_name"].'%' ;
            }
            if(isset($_REQUEST["comunidad"]) && $_REQUEST["comunidad"] != "" ){
                    $query .= "and json_data like %s  ";
                    $params[] ='%'.$_REQUEST["comunidad"].'%' ;
            }
            if(isset($_REQUEST["system_check"]) && $_REQUEST["system_check"] != ""  && is_array($_REQUEST["system_check"]) ){
           
                if(in_array("OR",$_REQUEST["system_check"])){
                    $query .= "and ( 1=0 ";
                    foreach($_REQUEST["system_check"] as $system_check){
                    if($system_check !="OR"){
                            $query .= "OR json_data like %s ";
                        $params[] ='%'.$system_check.'%' ;
                    }
                  
                    }
                    $query .= ")";
                }else{
                    $query .= "and ( 1=1 ";
                    foreach($_REQUEST["system_check"] as $system_check){
                        $query .= "AND json_data like %s ";
                        $params[] ='%'.$system_check.'%' ;
                    }
                    $query .= ")";
                }
                    $query .= "and json_data like %s";
                    $params[] ='%'.$_REQUEST["title"].'%' ;
            }
            $c ++;
        }         
            if(isset($_REQUEST["cid"]) && $_REQUEST["cid"] == $site->blog_id   ){
                $country_select .= "<option selected value='".$site->blog_id."'>".str_replace("/","",$site->path)."</option>";
            }else{
                $country_select .= "<option value='".$site->blog_id."'>".str_replace("/","",$site->path)."</option>";
            }
          
    }
    $query .= ") as t";
    $o = "";
    $d = "";
    if(isset($_GET["o"]) && isset($_GET["d"]) && $_GET["o"] != ""){
        $o = $_GET["o"];
        $d = $_GET["d"];
        if(in_array($d,array("asc","desc")) && in_array($o,array("type","status","created_at"))){
            $query .=" ORDER BY  ".$o." ".$d;
        }       
    }else{
        $query .=" ORDER BY created_at desc";
    }
    if(!isset($_REQUEST["csv"])){
        $items_per_apge = 100;
        $page = 1;
        if(isset($_GET["l"]) && $_GET["l"] > 1){
            $page = $_GET["l"] ;
            $query .=" LIMIT ".(($page-1) * $items_per_apge).",".($items_per_apge+1);

        }else{
            $query .=" LIMIT ".($items_per_apge+1);
        }       
    }

        
    if(count($params) > 0){
        $query = $wpdb->prepare($query,$params);
    }      

 
    $data = $wpdb->get_results($query , OBJECT );
    if(isset($_REQUEST["csv"])){

         $f = fopen('php://memory', 'w'); 

         $delimiter = ";";

         if(is_user_logged_in()  && false){ 
            fputcsv($f, array("Estado","Pais","Titulo","Region","ID","Tipo","Fecha","Sistema","Sys","Bim","Dwg","Comp","Ft","Seg","Comments","nombre","apellidos","email","telefono","empresa","actividad","ciudad","cpos","pais","acceptacion","comentarios","consulta"), $delimiter); 
         }else{ 
            fputcsv($f, array("Estado","Pais","Titulo","Region","ID","Tipo","Fecha","Sistema","Sys","Bim","Dwg","Comp","Ft","Seg","Comments"), $delimiter); 
         }  

        // loop over the input array
        foreach($data as $form){ 
            $data_json = json_decode(str_replace("\\","",$form->json_data),true);
            // generate csv lines from the inner arrays
            $titulo = isset($data_json["titproy"])?$data_json["titproy"]:"";
            $regin = isset($data_json["comunidad"])?$data_json["comunidad"]:"";

            $file_name =  isset($data_json["file_name"])?$data_json["file_name"]:"";
            $system_data_sheet =  isset($data_json["system_data_sheet"])?$data_json["system_data_sheet"]:"";
            $bim =  isset($data_json["bim"])?$data_json["bim"]:"";
            $dwg_details =  isset($data_json["dwg_details"])?$data_json["dwg_details"]:"";
            $decomposed_prices =  isset($data_json["decomposed_prices"])?$data_json["decomposed_prices"]:"";
            $check_productos_ft =  isset($data_json["check_productos_ft"])?$data_json["check_productos_ft"]:"";
            $check_productos_fs =  isset($data_json["check_productos_fs"])?$data_json["check_productos_fs"]:"";

            if(is_user_logged_in()  && false){ 
                fputcsv($f,  array($form->status,$form->blog,"$titulo","$regin",$form->guid,$form->type,substr($form->created_at,0,10),"$file_name",$system_data_sheet,$bim,$dwg_details,$decomposed_prices,$check_productos_ft,$check_productos_fs,"$form->comments","$form->nombre","$form->apellidos","$form->email","$form->telefono","$form->empresa","$form->actividad","$form->ciudad","$form->cpos","$form->pais",$form->acceptacion,"$form->comentarios","$form->consulta"), $delimiter); 
            }else{ 
                fputcsv($f,  array($form->status,$form->blog,"$titulo",$regin,$form->guid,$form->type,substr($form->created_at,0,10),"$file_name",$system_data_sheet,$bim,$dwg_details,$decomposed_prices,$check_productos_ft,$check_productos_fs,"$form->comments"), $delimiter); 
            }  

       }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: text/csv');
        // tell the browser we want to save it instead of displaying it
       // header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
        die();
    }

?>

	<div id="primary" <?php astra_primary_class('FormViews'); ?>>
        <div class="entry-content clear" itemprop="text">

            <div id="construction-header" class="section-header alignfull">
            <div class="section-header-bg" style="background-image: url(<?php echo $image; ?>);"></div>
            <div class="ast-container">
                <div class="content-area">
                    <h1><?php echo $title; ?></h1>
                    <?php if(!empty($description)){ ?>
                        <?php echo $description; ?>
                    <?php } ?>
                </div>
            </div>
            </div>


        <div class="form_view">
        <?php
     
        ?>
        <form>
        <table class="table order<?=$o?> direction<?=$d?>" style="width:100%">
        <thead>
        <tr><th class="status <?php if($o == "status"){ echo "ordered ".$d; }?>">
            <?php  $_GET["o"] = "status"; if($o == "status" && $d =="asc"){  $_GET["d"] = "desc"; }else{   $_GET["d"] = "asc";   }  ?>
            <a href="<?=get_permalink(the_ID())?>?<?=http_build_query($_GET)?>"><?=__("Status")?></a>
        </th>
        
        <th><?=__("Country")?></th>
        <th><?=__("Title")?></th>
        <th><?=__("Region")?></th>
        <th>ID</th><th><?=__("Type")?></th>
        <th class="created_at <?php if($o == "created_at"){ echo "ordered ".$d; }?>"">
         <?php  $_GET["o"] = "created_at"; if($o == "created_at" && $d =="asc"){  $_GET["d"] = "desc"; }else{   $_GET["d"] = "asc";   }  ?>
        <a href="<?=get_permalink(the_ID())?>?<?=http_build_query($_GET)?>"> <?=__("Date")?></a></th>
        <th style="min-width: 215px">
       
       <?=__("Data")?>
        </th>
        <th>
            <button class="btn btn-primary" type="submit" name="csv" style="width: 20px;padding: 2px;background-color:green" title="Guardar CSV">&#x1f4be;</button>
            <span style="display:none"><?=$query?></span>
        </th>
        </tr>

        <tr class="filter">
            <th>
            <select name="status">
                <option value="all"><?=__("All")?></option>
                <option value="0"  <?= (isset($_REQUEST["status"]) && $_REQUEST["status"] == "0")?"selected":"" ?>><?=__("NEW")?></option>
                <option value="1"  <?= (isset($_REQUEST["status"]) && $_REQUEST["status"] == "1")?"selected":"" ?>><?=__("REVIEWED")?></option>
                <option value="2"  <?= (isset($_REQUEST["status"]) && $_REQUEST["status"] == "2")?"selected":"" ?>><?=__("IGNORED")?></option>
                <option value="3"  <?= (isset($_REQUEST["status"]) && $_REQUEST["status"] == "3")?"selected":"" ?>><?=__("IMPORTANT")?></option>
            </select></th>
            <th><select name="cid"><?=$country_select?></select></th>
         <th><input type="text" name="title" value="<?= (isset($_REQUEST["title"]) && $_REQUEST["title"] !="")?trim($_REQUEST["title"]):"" ?>"></th>
        <th><input type="text" name="comunidad" value="<?= (isset($_REQUEST["comunidad"]) && $_REQUEST["comunidad"] !="")?trim($_REQUEST["comunidad"]):"" ?>"></th>
        <th><input type="text" name="guid" value="<?= (isset($_REQUEST["guid"]) && $_REQUEST["guid"] !="")?trim($_REQUEST["guid"]):"" ?>"></th>
        <th>
        <select name="type">
        <option value="all"><?=__("All")?></option>
        <option value="Diseña tu proyecto" <?= (isset($_REQUEST["type"]) && $_REQUEST["type"] == "Diseña tu proyecto")?"selected":"" ?>>Diseña tu proyecto</option>
        <option value="Sistemas" <?= (isset($_REQUEST["type"]) && $_REQUEST["type"] == "Sistemas" )?"selected":"" ?>>Sistemas</option></select>
        </th><th><input type="date" name="date" value="<?= (isset($_REQUEST["date"]) && $_REQUEST["date"] !="")?trim($_REQUEST["date"]):"" ?>"></th>
        <th>
        <?php include("_filterJson.php") ?>
        </th>
        <th><button class="btn btn-primary" type="submit" style="    width: 20px;    padding: 5px;" title="Aplicar Filtro"><?=__(">")?></button></th></tr>
        </form>
        </thead>
        <tbody>
        <?php
            $c = 0;
            $hasmore = false;
            foreach($data as $form){ 
                $data_json = json_decode(str_replace("\\","",$form->json_data),true);
              
                $c ++;
                if($c > $items_per_apge){
                    $hasmore = true;
                    break;
                }
                ?>
                 <tr class="status<?=$form->status?>" id="row<?=$form->id?>">
                 <td><select onChange="saveStatus(jQuery(this));" data-id="<?=$form->id?>"><option></option>
                    <option value="0"  <?= ($form->status == "" || $form->status == 0)?"selected":"" ?> ><?=__("NEW")?></option>
                    <option value="1" <?= ($form->status == 1)?"selected":"" ?> ><?=__("REVIEWED")?></option>
                    <option value="2" <?= ($form->status == 2)?"selected":"" ?> ><?=__("IGNORED")?></option>
                    <option value="3" <?= ($form->status == 3)?"selected":"" ?> ><?=__("IMPORTANT")?></option> 
                 </select></td>

                 <td><?=$form->blog?></td>
                 <td><?=isset($data_json["titproy"])?$data_json["titproy"]:"";?></td>
                <td><?=isset($data_json["comunidad"])?$data_json["comunidad"]:"";?></td>

                 <td><?php if(is_user_logged_in()){ include("_form_contact.php"); }else{ echo $form->guid; } ?></td>
                 <td><?=$form->type?></td>
                 <td><?= substr($form->created_at,0,10)?></td>
                 <td><?php include("_".sanitize_title($form->type).".php") ?></td>
                 <td><?php include("_comments.php") ?></td>
                 </tr>    
          <?php  }
        ?>
        </tbody>
        </table>
        <?php if($hasmore || $page > 1){?>
        <nav>
            <ul>
                <?php if($page > 1){  $_GET["l"] = $page-1;?>
                    <li><a href="<?=get_permalink(the_ID())?>?<?=http_build_query($_GET)?>"><?=__("Previous")?></a></li>
                <?php }?>
                <li><?=__("Page")." ".$page?></li>
                <?php if($hasmore){$_GET["l"] = $page+1;?>
                    <li><a href="<?=get_permalink(the_ID())?>?<?=http_build_query($_GET)?>"><?=__("Next")?></a></li>
                <?php }?>
            </ul>
        </nav>
       <?php }?>
        <?php

    


        wp_reset_postdata();

        ?>

        </div>

        </div>



	</div><!-- #primary -->
    <?php } ?>

<?php get_footer(); ?>
  <div style="display: none;"><div id="lighboxProject"></div></div>
<script>
jQuery(document).ready(function() {
 
    jQuery(".modalComments").on('click',   function () { 
        loadLighboxComments(jQuery(this));
    });
    <?php if(is_user_logged_in()){?>
    jQuery(".modalFormContact").on('click',   function () { 
        var id = jQuery(this).data('id');
        var guid = jQuery(this).data('guid');
        var blog_id = jQuery(this).data('blogid');
        var _this  = jQuery(this);
        jQuery.ajax({
            url: home_uri + 'wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'get_dynamics_form_contact',
                guid: guid,
                blog_id: blog_id,

            },
            beforeSend: function(xhr) {
                //filter.find('button').text('Processing...'); // changing the button label
            },
            success: function(response) {
                jQuery('#formcontact_'+id).html(response);
                loadLighboxComments(_this);
            }
        });

        
    });
        <?php } ?>
    jQuery("._disenya_tu_proyecto").on('click',   function () { 
        jQuery.ajax({
            url: home_uri + 'wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'resumen_proyecto',
                guid: jQuery(this).data('guid'),
                blog_id: jQuery(this).data('blog_id'),

            },
            beforeSend: function(xhr) {
                //filter.find('button').text('Processing...'); // changing the button label
            },
            success: function(response) {
                jQuery("#lighboxProject").html(response); // insert data

                jQuery.featherlight("#lighboxProject", {
                    variant: "lighboxProject"
                });
            }
        });
    });
    jQuery(".modalComments button").on('click',   function () { 
        var id =  jQuery(this).attr("id");
        var text = jQuery(".lighboxComments #"+id+"text").val().trim() ;
        var current = jQuery.featherlight.current();
        current.close();
         jQuery("#"+id+"text").val(text);
        if(text== ""){     
            jQuery("#"+id+"div").removeClass("widthComments");
            jQuery("#"+id+"div").addClass("widthoutComments");
        }else{
            jQuery("#"+id+"div").removeClass("widthoutComments");
            jQuery("#"+id+"div").addClass("widthComments");
        }

        jQuery.ajax({
            url: '<?php echo admin_url( 'admin-post.php' ); ?>',
            type: 'post',
            data: {
                action: 'save_dynamics_form_field',
                comments: text,
                id: jQuery(this).data("id")

            }
        });
    });
});
function saveStatus(element) {
        var element_id = element.data("id");
        jQuery.ajax({
            url: '<?php echo admin_url( 'admin-post.php' ); ?>',
            type: 'post',
            data: {
                action: 'save_dynamics_form_field',
                status: element.val(),
                id: element.data("id")

            },
            success: function(id) {
                console.log(id);
                jQuery("#row"+element_id).removeClass("status");
                jQuery("#row"+element_id).removeClass("status0");
                jQuery("#row"+element_id).removeClass("status1");
                jQuery("#row"+element_id).removeClass("status2");
                jQuery("#row"+element_id).removeClass("status3");
                jQuery("#row"+element_id).removeClass("status4");
                jQuery("#row"+element_id).removeClass("status5");
                jQuery("#row"+element_id).removeClass("status6");
                jQuery("#row"+element_id).addClass("status"+id);
            }
        });
}
function loadLighboxComments(element) {
    var modal_id = element.data("modalid");
    jQuery.featherlight("#"+modal_id, {
            variant: "lighboxComments"
        });
}
</script>
