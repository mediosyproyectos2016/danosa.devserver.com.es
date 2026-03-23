<?php

add_action( 'wp_ajax_nopriv_hreflang_cron', 'hreflang_cron' );
add_action( 'wp_ajax_hreflang_cron', 'hreflang_cron' );

//https://danosa.myp.com.es/wp-admin/admin-ajax.php?action=hreflang_cron&sync=page_href&refresh_all
//https://danosa.myp.com.es/wp-admin/admin-ajax.php?action=hreflang_cron&sync=product&refresh_all
//https://danosa.myp.com.es/wp-admin/admin-ajax.php?action=hreflang_cron&sync=system&refresh_all
//https://danosa.myp.com.es/wp-admin/admin-ajax.php?action=hreflang_cron&sync=entradas&refresh_all
//https://danosa.myp.com.es/wp-admin/admin-ajax.php?action=hreflang_cron&sync=family&refresh_all
//https://danosa.myp.com.es/wp-admin/admin-ajax.php?action=hreflang_cron&sync=system_cat&refresh_all

if(isset($_GET["generateHrefLang"])){
	hreflang_cron();

	die();
}
global $hreflang_link_generate_replace_from;
global $hreflang_link_generate_replace_to;

function hreflang_link_generate_replaces(){
	global $hreflang_link_generate_replace_from;
	global $hreflang_link_generate_replace_to;
	$blog_ids = get_sites();

	$hreflang_link_generate_replace_from = array();
	$hreflang_link_generate_replace_to = array();
    foreach( $blog_ids as $blog ){
		if($blog->blog_id != 1){
			$posts = 	get_blog_option( $blog->blog_id, "cptui_post_types");
			if($posts && is_array($posts)){
				foreach($posts as $post_type => $post_conf ){
					if(isset($post_conf["rewrite_slug"]) && $post_conf["rewrite_slug"] != ""){
						$hreflang_link_generate_replace_from[] = $blog->path.'blog/'.$post_conf["name"].'/';
						$hreflang_link_generate_replace_to[] = $blog->path.$post_conf["rewrite_slug"].'/';
					}else{
						$hreflang_link_generate_replace_from[] = $blog->path.'blog/'.$post_conf["name"].'/';
						$hreflang_link_generate_replace_to[] = $blog->path.$post_conf["name"].'/';
					}
				}
			}

			$posts = 	get_blog_option( $blog->blog_id, "cptui_taxonomies");

			if($posts && is_array($posts)){
				foreach($posts as $post_type => $post_conf ){
					if(isset($post_conf["rewrite_slug"]) && $post_conf["rewrite_slug"] != ""){
						$hreflang_link_generate_replace_from[] = $blog->path.'blog/'.$post_conf["name"].'/';
						$hreflang_link_generate_replace_to[] = $blog->path.$post_conf["rewrite_slug"].'/';
					}else{
						$hreflang_link_generate_replace_from[] = $blog->path.'blog/'.$post_conf["name"].'/';
						$hreflang_link_generate_replace_to[] = $blog->path.$post_conf["name"].'/';
					}
				}
			}

		}
	}

}

function hreflang_link( $blog_id, $post_id, $link ) {

	global $hreflang_link_generate_replace_from;
	global $hreflang_link_generate_replace_to;
    $link = str_replace($hreflang_link_generate_replace_from,$hreflang_link_generate_replace_to,$link);
    return $link;
}
add_filter( 'hreflang_link', 'hreflang_link', 10, 3 );

function hreflang_cron(){

	set_time_limit(0);
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '6400M');

	hreflang_link_generate_replaces();



	$config = array(
		"sites" => array(),
		"exclude_sites" => array(1),
		"sub_sites" => array(),
		"exclude_sub_sites" => array(1),
		"refresh_all" => false,
		"replaces" => array("global" => "en"),
		"sync" =>    array(
			"system_cat" => array(
				"post_type" => "terms",
				"sync_field" => "name",
				"taxonomy" =>  "system_cat",
				"post_meta" => false
			),
			"family" => array(
				"post_type" => "terms",
				"sync_field" => "name",
				"taxonomy" =>  "family",
				"post_meta" => false
			),
			"entradas" => array(
				"post_type" => "post",
				"sync_field" => "post_title",
				"post_meta" => false
			),
			"page" => array(
				"post_type" => "page",
				"sync_field" => "_wp_page_template",
				"post_meta" => true
			),
			"page_href" => array(
				"post_type" => "page",
				"sync_field" => "hreflang_ref",
				"post_meta" => true,
				"URL" => "/wp-admin/admin-ajax.php?action=hreflang_cron&sync=page_href&refresh_all"
			),
			"product" => array(
				"post_type" => "product",
				"sync_field" => "post_title",
				"post_meta" => false
			),
			"system" => array(
				"post_type" => "system",
				"sync_field" => "post_title",
				"post_meta" => false
			),
			"broadcast" => array(
				"post_type" => "plugin_threewp-broadcast",
				"sync_field" => "reference",
				"post_meta" => true
			)

		)
	);

	$continents = getContentCountries();
	$sites = get_sites();
	$paths = array();
	foreach ($sites as $key => $value) {
		$paths[$value->path] = $value->blog_id;
	}
	foreach ($continents as $key => $paises) {
		foreach ($paises as $key1 => $pais) {
			if(isset($pais["hreflang"]) && isset($paths["/".$pais["hreflang"]."/"])){
				$config["sub_sites"][$pais["hreflang"]] = $paths["/".$pais["hreflang"]."/"];
			}
		}
	}

	if(!isset($_GET["nolog"])) print_r($config);

	if(isset($_GET["sync"]) ){
		$online_config = array();
		if(isset($_GET["refresh_all"])){
			$online_config["refresh_all"] = true;
		}
		syncHrefPostType($_GET["sync"],$config, $online_config);
	}
}

function syncHrefPostType( $sync ,$config, $online_config = array()) {
	$post_type_config = $config["sync"][$sync];
	if(is_array($post_type_config)){
			$post_type_config = array_merge($online_config ,$post_type_config);
			$post_type = $post_type_config["post_type"];
			if(file_exists(__DIR__. "/href_post_types/".$post_type.".php")){
				include_once __DIR__. "/href_post_types/".$post_type.".php" ;
				syncPostType::execute($config,$post_type_config);
			}else{
				include_once __DIR__. "/href_post_types/posts.php" ;
				syncPostType::execute($config,$post_type_config);

			}

	}
}


add_action( 'wp_head', 'multisite_hreflang_wp_head' );
function multisite_hreflang_wp_head(  ){
    global $template;
	$hreflang = false;
	$type = get_queried_object();

	if(is_object($type)){
		if (get_class($type) == "WP_Term") {
			$term_id = $type->term_id;
			$hreflang = get_term_meta($term_id, "multisite_hreflang", true );
		}elseif (get_class($type) == "WP_Post") {
			$post_id = $type->ID;
			$hreflang = get_post_meta($post_id,"multisite_hreflang",true);
		}


		$url =  wp_get_canonical_url( );
		if ( is_front_page() ) {
			$countries = getContentCountries();
			foreach ($countries as $continente => $contenido) {
				foreach ($contenido as $key => $country) {
					if(isset($country["hreflang"])){
						echo '<link rel="alternate" hreflang="'.$country["hreflang"].'" href="'.$country["url"].'" />';
					}
				}
			}
		}elseif($url !=""){
			if(false && $hreflang && is_array($hreflang) && count($hreflang) > 0){
				$first = true;
				foreach ($hreflang as $key => $value) {
					echo $value;
					if($first ) echo str_replace('hreflang="'.$key.'"','hreflang="x-default"',$value);
					$first = false;
				}
			} else{
				$blog = get_blog_details();
				echo '<link rel="alternate" hreflang="'.str_replace("/","",$blog->path).'" href="'.$url.'" />';
			}
			echo '<link rel="canonical" href="'.$url.'"/>';
		}
	}



}

add_filter( 'get_canonical_url', 'multisite_get_canonical_url', 10, 2 );
function multisite_get_canonical_url( $canonical_url, $post ){
	$type = get_queried_object();
 	if(is_object($type)){
		if (get_class($type) == "WP_Term") {
			$kink  = get_term_link( $type);
			$canonical_url = apply_filters( 'hreflang_link',get_current_blog_id(), $type->term_id, $kink);
		}elseif ($post && get_class($type) == "WP_Post") {
			if($post->post_parent > 0 && $post->post_type == "product"){

				$parentId = $post->post_parent;
				$canonical_url = get_permalink($parentId);
				/*
				$displayMode = get_field("display_mode",$parentId);
				if($displayMode === "Tabla"){
					$canonical_url = get_permalink($parentId);
				}else{
					$childId = $post->ID;
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
						'post_parent'    => $parentId,
						'order'          => 'ASC',
						'orderby'        => 'menu_order'
					 );
					$siblings = new WP_Query( $args );
					if ($siblings->have_posts() && count($siblings->posts) == 1) {
			  				$canonical_url = get_permalink($parentId);
					}
					wp_reset_postdata();
				}
				*/
			}
		}
	}


	return $canonical_url;
}

add_filter( 'wpseo_robots', function( $robots ) {
	if ( is_singular( 'product' ) && wp_get_post_parent_id( get_the_ID() ) ) {
	  return 'noindex, follow';
	}
	return $robots;
});
