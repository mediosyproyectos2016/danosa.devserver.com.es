<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */


/**
 * Astra Layout Filters for Family Taxonomy
 * Forzar el diseño "Plain Container" para que coincida con Audal
 */
add_filter( 'astra_get_content_layout', function( $layout ) {
    if ( is_tax( 'family' ) ) {
        return 'ast-plain-container';
    }
    return $layout;
} );

add_filter( 'astra_page_layout', function( $layout ) {
    if ( is_tax( 'family' ) ) {
        return 'no-sidebar';
    }
    return $layout;
} );

// Forzar clases de body con prioridad alta
add_filter( 'body_class', function( $classes ) {
    if ( is_tax( 'family' ) || is_singular( 'product' ) ) {
        $classes = array_diff( $classes, array( 'ast-separate-container', 'ast-two-container' ) );
        $classes[] = 'ast-plain-container';
        $classes[] = 'ast-no-sidebar';
    }
    return $classes;
}, 999 );

// Capa de compatibilidad para funciones de Multisite en entornos de sitio único
if ( ! is_multisite() ) {
    if ( ! function_exists( 'get_blog_details' ) ) {
        function get_blog_details( $fields = null, $get_all = true ) {
            $blog = new stdClass();
            $blog->blog_id = 1;
            $blog->siteurl = get_site_url();
            $blog->path    = '/';
            return $blog;
        }
    }
    if ( ! function_exists( 'get_sites' ) ) {
        function get_sites( $args = array() ) {
            $blog = new stdClass();
            $blog->blog_id = 1;
            $blog->siteurl = get_site_url();
            $blog->path    = '/';
            return array( $blog );
        }
    }
    if ( ! function_exists( 'switch_to_blog' ) ) {
        function switch_to_blog( $new_blog_id, $validate = false ) {
            return true;
        }
    }
    if ( ! function_exists( 'restore_current_blog' ) ) {
        function restore_current_blog() {
            return true;
        }
    }
    if ( ! function_exists( 'get_blog_option' ) ) {
        function get_blog_option( $id, $option, $default = false ) {
            return get_option( $option, $default );
        }
    }
}

// Carga de traducciones en el hook correcto (requerido desde WP 6.7)
add_action( 'after_setup_theme', function() {
    load_theme_textdomain( 'danosa', get_stylesheet_directory_uri() . '/languages/' );
    load_theme_textdomain( 'danosa-design-your-project', get_stylesheet_directory_uri() . '/languages/' );
} );

/**
 * Filtra los productos en las páginas de familia para mostrar solo los que tienen variantes (hijos).
 */
add_action( 'pre_get_posts', 'filtrar_productos_familia_con_variantes' );
function filtrar_productos_familia_con_variantes( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_tax( 'family' ) ) {
        // Aseguramos que solo mostramos productos padre (post_parent = 0)
        $query->set( 'post_parent', 0 );
        
        // Añadimos el filtro SQL para verificar que tienen hijos (variantes)
        add_filter( 'posts_where', 'filtro_sql_tiene_hijos', 10, 2 );
    }
}

function filtro_sql_tiene_hijos( $where, $query ) {
    global $wpdb;
    // Quitamos el filtro para no afectar a otras consultas que puedan ocurrir en la misma carga
    remove_filter( 'posts_where', 'filtro_sql_tiene_hijos', 10 );
    
    // Solo permitimos productos que tengan al menos un post hijo de tipo product
    $where .= " AND {$wpdb->posts}.ID IN (SELECT DISTINCT post_parent FROM {$wpdb->posts} WHERE post_type = 'product' AND post_parent > 0)";
    
    return $where;
}

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );



include_once "shortcodes/home-systems.php";
include_once "shortcodes/system-cat.php";
include_once "shortcodes/product-list.php";
include_once "shortcodes/country-selector.php";
include_once "shortcodes/search-button.php";
include_once "shortcodes/banner.php";
include_once "shortcodes/link-hreflang.php";

//include_once "functions/functions-menu.php";
include_once "functions/functions-countries.php";
include_once "functions/functions-hreflang.php";
include_once "functions/functions-acoustic_app.php";

include_once "ajax/product-load-filters.php";
include_once "ajax/product-filter.php";
include_once "ajax/system-load-filters.php";
include_once "ajax/system-filter.php";


function get_page_by_slug($page_slug, $post_type = 'page', $output = OBJECT ) {
    global $wpdb;
    $page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s", $page_slug, $post_type ) );
    if ( $page )
            return get_page($page, $output);
    return null;
}


/*
function get_site_locale(){
        $path = get_blog_details(get_current_blog_id())->path;
        $path = str_replace("/", "", $path);
        $path = str_replace("-", "", $path);
        $path = str_replace("_", "", $path);
        return $path;
}
*/




function myp_scripts() {

    wp_enqueue_script( 'scrollreveal', get_stylesheet_directory_uri().'/js/scrollreveal.min.js', array ( 'jquery' ), 1.2, true);

    //job
    wp_enqueue_script( 'shareon', get_stylesheet_directory_uri().'/js/shareon.min.js', array ( 'jquery' ), 1.6, true);

    //home, constructions
    wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri().'/js/slick/slick.min.js', array ( 'jquery' ), 1.2, true);

    //online projects
    wp_enqueue_script( 'select2', get_stylesheet_directory_uri().'/js/select2.min.js', array ( 'jquery' ), 1.2, true);

    wp_enqueue_script('noty', get_stylesheet_directory_uri() . '/js/noty/noty.min.js', array('jquery'), 1.0, true);

    wp_enqueue_script('featherlight', get_stylesheet_directory_uri() . '/js/featherlight/featherlight.min.js', array('jquery'), 1.0, true);
    //wp_enqueue_script('featherlight-gallery', get_stylesheet_directory_uri() . '/js/featherlight/featherlight.gallery.min.js', array('featherlight'), 1.0, true);

    wp_enqueue_script('angoliasearch', 'https://cdn.jsdelivr.net/npm/algoliasearch@4.5.1/dist/algoliasearch-lite.umd.js');
    wp_enqueue_script('instantsearch', 'https://cdn.jsdelivr.net/npm/instantsearch.js@4.8.3/dist/instantsearch.production.min.js');

    //wp_enqueue_script( 'search', get_stylesheet_directory_uri().'/js/search.js', array ( 'jquery' ), 1.0, true);
    //wp_localize_script( 'search', 'searchParams', array("locale" => get_site_locale()) );

    //family
    wp_enqueue_script( 'family', get_stylesheet_directory_uri().'/js/family.js', array ( 'jquery' ), 1.0, true);

    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri().'/js/scripts.js', array ( 'jquery' ), 1.3, true);


}
add_action( 'wp_enqueue_scripts', 'myp_scripts' );


/**
 * Enqueue styles
 */
function child_enqueue_styles() {

    wp_enqueue_style( 'danosa-font', get_stylesheet_directory_uri() . '/css/danosa.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    //job
    wp_enqueue_style( 'shareon', get_stylesheet_directory_uri() . '/css/shareon.min.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    //home, constructions
    wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/js/slick/slick.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
    wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/js/slick/slick-theme.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    //online projects
    wp_enqueue_style( 'select2', get_stylesheet_directory_uri() . '/css/select2.min.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    wp_enqueue_style( 'noty', get_stylesheet_directory_uri() . '/js/noty/noty.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    wp_enqueue_style( 'danosa-custom', get_stylesheet_directory_uri() . '/css/custom.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

    wp_enqueue_style('featherlight', get_stylesheet_directory_uri() . "/js/featherlight/featherlight.min.css", array(), null);

    wp_enqueue_style( 'instantsearch', 'https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css' );
    //wp_enqueue_style('featherlight-gallery', get_stylesheet_directory_uri() . "/js/featherlight/featherlight.gallery.min.css", array(), null);

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


add_image_size( 'danosa-news-list', 352, 224, true );
add_image_size( 'danosa-news-medium', 928, 464, true );



function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//adminbar color
// Registramos los hooks dentro de acf/init para asegurar que ACF esté inicializado
add_action('acf/init', function() {
    add_action('wp_head', 'change_bar_color');
    add_action('admin_head', 'change_bar_color');
});
function change_bar_color() {
    ?>
    <style>
        #wpadminbar{
            background: <?php the_field("adminbar_color", 'option'); ?> !important;
        }
        /*
        #wp-admin-bar-wp-logo > a > span.ab-icon:before{
            content: ""!important;
            background-image: url(<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/danosa/img/flags/<?php the_field("country_flag", 'option'); ?>.svg) !important;width: 20px;
            display: inline-block;
            height: 20px;
            background-size: contain;
        }
        */
        #wp-admin-bar-site-name > a:after {
            content: " - ID <?php echo get_current_blog_id(); ?>";
            display: inline-block;
            margin-left: 3px;
            font-size: 9px;
        }
        #wpadminbar #wp-admin-bar-wp-logo>.ab-item {
            background-color: #23282d;
        }
        #adminmenu .wp-menu-image img {
            max-width: 70%;
            opacity: 1;
        }
    </style>
    <?php
}





add_shortcode( 'home_news', 'home_news_function' );

function home_news_function() {

    ob_start();

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => '4',
    );

    // The Query
    $the_query = new WP_Query( $args );

    // The Loop

    if ( $the_query->have_posts() ) {
        $x = 0;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $x++;
            if($x == 1){
                ?>
        <div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile news-list-featured" style="grid-template-columns:auto 83%" id="">
            <figure class="wp-block-media-text__media fade-right">
                <?php the_post_thumbnail(); ?>
                <?php if(1==2){ ?>
                <img loading="lazy" width="928" height="504" src="https://danosa.myp.com.es/wp-content/uploads/2021/06/Rectangle-89.jpg" alt="" class="wp-image-228 size-full" srcset="https://danosa.myp.com.es/wp-content/uploads/2021/06/Rectangle-89.jpg 928w, https://danosa.myp.com.es/wp-content/uploads/2021/06/Rectangle-89-300x163.jpg 300w, https://danosa.myp.com.es/wp-content/uploads/2021/06/Rectangle-89-768x417.jpg 768w" sizes="(max-width: 928px) 100vw, 928px">
                <?php } ?>
            </figure>
            <div class="wp-block-media-text__content fade-left">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
                <div class="wp-block-columns">
                    <div class="wp-block-column">
                        <a href="<?php the_permalink(); ?>"><?php _e("Read more","danosa"); ?> <i class="danosa-arrow-go"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="wp-block-columns">
                <?php
            }else{
                ?>
            <div class="wp-block-column content-list fade-top">
                <figure class="wp-block-image size-large content-list-image">
                    <?php danosa_post_thumbnail();
                     ?>
                </figure>
                <div class="wp-block-group">
                    <div class="wp-block-group__inner-container">
                        <h5>News</h5>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <div class="wp-block-columns">
                    <div class="wp-block-column" style="flex-basis:50%">
                        <a href="<?php the_permalink(); ?>"><?php _e("Read more","danosa"); ?> <i class="danosa-arrow-go"></i></a>
                    </div>
                </div>
            </div>
            <?php

            }
        }
        ?>
        </div>
        <?php
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();

    ?>




 <?php
$output = ob_get_contents();
ob_end_clean();

return $output;
}

add_shortcode( 'danosa_jobs', 'danosa_jobs_function' );

function danosa_jobs_function() {

    ob_start();

    $args = array(
        'post_type' => 'job',
        'posts_per_page' => '-1',
    );

    // The Query
    $the_query = new WP_Query( $args );

    // The Loop

    if ( $the_query->have_posts() ) {

        while ( $the_query->have_posts() ) {
            $the_query->the_post();
                ?>
                <div class="jobs-list fade-top">
                    <div class="job-left">
                        <?php the_field("location"); ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div>
                    <div class="wp-block-button"><a href="<?php the_permalink(); ?>" class="wp-block-button__link"><?php _e("View job","danosa"); ?></a></div>

                </div>

        <?php
        }
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();

    ?>




 <?php
$output = ob_get_contents();
ob_end_clean();

return $output;
}



function danosa_post_thumbnail(){
    if(has_post_thumbnail()){
        the_post_thumbnail("danosa-news-list");
    }else{
        ?>
        <img loading="lazy" class="danosa-thumbnail-logo" src="/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg" />
        <?php
    }
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
   global $post;
   return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//ACF - Página de configuración (dentro de acf/init para evitar carga temprana de traducciones)
add_action( 'acf/init', function() {
    if( function_exists('acf_add_options_page') ) {

        $parent = acf_add_options_page(array(
                'page_title'    => __('Danosa Configuration'),
                'menu_title'    => __('Danosa Configuration'),
                'icon_url' => '/wp-content/themes/danosa/img/danosa-logo.svg',
            ));

        acf_add_options_sub_page(array(
                'page_title'  => 'Global',
                'menu_title'  => 'Global',
                'parent_slug' => $parent['menu_slug'],
            ));
    }
} );


function print__menu_function($atts) {
    // Normalize
    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    $atts = array_map('sanitize_text_field', $atts);
    // Attributes
    $menu_name  = $atts['name'];
    $menu_class = $atts['class'];
    return wp_nav_menu(array(
        'menu'       => esc_attr($menu_name),
        'menu_class' => 'menu ' . esc_attr($menu_class),
        'echo'       => false));
}
add_shortcode('print-menu', 'print__menu_function');

function widget_products($atts) {

       $terms = get_terms( 'family', array(
                    'hide_empty' => true,
                    'parent' => 0
                ) );

                $output = "<ul>";

                foreach ($terms as $key => $product) {
                    $output .= '<li><a href="'. get_term_link($product->term_id).'">'.$product->description.'</a></li>';
                }
return $output."</ul>";

}
add_shortcode('widget-products', 'widget_products');

function widget_systems($atts) {

       $terms = get_terms( 'system_cat', array(
                    'hide_empty' => true,
                    'parent' => 0
                ) );

        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'tp-systems.php'
        ));

        foreach($pages as $page){
            $systemIdPage = $page->ID;
        }

                $output = "<ul>";

                foreach ($terms as $key => $product) {
                    $output .= '<li><a href="'. get_the_permalink($systemIdPage)."#".sanitize_title($product->description).'">'.$product->description.'</a></li>';
                }
return $output."</ul>";

}
add_shortcode('widget-systems', 'widget_systems');




add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/delegations' );
    register_block_type( __DIR__ . '/blocks/sales' );
}

/*
function dont_create_terms( $term_into, $tx_name ) {

    // Check if term exists, checking both top-level and child
    // taxonomy terms.
    $term = empty($term_into['parent']) ? term_exists( $term_into['name'], $tx_name, 0 ) : term_exists( $term_into['name'], $tx_name, $term_into['parent'] );

    // Don't allow WP All Import to create the term if it doesn't
    // already exist.
    if ( empty($term) and !is_wp_error($term) ) {
        return false;
    }

    // If the term already exists assign it.
    return $term_into;

}

add_filter( 'pmxi_single_category', 'dont_create_terms', 10, 2 );
*/

function getTermName($name){
    switch($name){
        case "product_notice":
            return __("Notice","danosa");
        case "product_icon":
            return __("Icon","danosa");
        case "product_application":
            return __("Scope","danosa");
        case "product_standards_certification":
            return __("Standards and Certification","danosa");
        case "product_benefits":
            return __("Advantages & Benefits","danosa");
        case "product_support":
            return __("Support","danosa");
        case "product_substrate_preparation":
            return __("Substrate preparation","danosa");
        case "product_important_indications":
            return __("Indications and Important Recommendations","danosa");
        case "product_conservation":
            return __("Handling, storage and preservation","danosa");
        case "product_warning":
            return __("Warning","danosa");
        case "product_safety_hygiene":
            return __("Safety and hygiene","danosa");
        default:
            return "getTermName() ".$name;
    }
}

    function stripNewLines($match) {
    return str_replace(array("\r", "\n"), '', $match[0]);
}

function cleanSingularFeatures($detalles, $force = false){

    //Replace Cariage with HTML Code
    $Temp_String = strip_tags(html_entity_decode($detalles), '<ul><li><br><br /><strong><table><tbody><thead><tr><td><th><sub>');

    $lines=explode("\n",$Temp_String);

    $start_list=false;
    foreach($lines as &$line){
        if(!$force){
            if(strpos($line,'–')!==False){
                if(!$start_list)
                    $line="<ul> ".$line;
                $line=str_replace('–',"<li>",$line)."</li>";
                $start_list=true;
            }
            else{

                if($start_list){
                $start_list=false;
                $line="</ul> ". $line;
                }
            }
        }else{
            $line="<li>".$line."</li>";
        }
    }

    $sring=implode("\n",$lines);
    $sring = preg_replace_callback('~\<[^>]+\>.*\</[^>]+\>~ms','stripNewLines', "".$sring."");
    $sring = nl2br($sring);
    return $sring;
}


function formatTable($content, $firstHead = true){

    $content = str_replace("[[","",$content);
    $content = str_replace("]]","",$content);
    $content = str_replace(",null",",\"\"",$content);
    $content = str_replace("null,","\"\",",$content);

    $content = explode("],[", $content);

    $output = '<div class="data-table-container">';
    $output .= '<table class="data-table">';

    $a = 0;
    foreach ($content as $key => $value) {
        $row = substr($value, 1, -1);
        $row = explode("\",\"", $row);

        //limpiamos la fila para comprobar si está vacía la fila.
        $rowTemp = strip_tags($value);
        $rowTemp = str_replace(",","",$rowTemp);
        $rowTemp = str_replace("\"","",$rowTemp);

        if(!empty($rowTemp)){

            if($firstHead == true && $a == 0){
                $output .= '<thead>';
                $htmlrow = "th";
            }else{
                $htmlrow = "td";
            }

            if($firstHead == true && $a == 1){
                $output .= '<tbody>';
            }

            if(!empty($row)){
                $output .= '<tr class="data-table-row">';
            }
            foreach ($row as $key => $cell) {
                if($cell != "null"){
                    $output .= "<".$htmlrow.">".$cell."</".$htmlrow.">";
                }else{
                    $output .= "<".$htmlrow."></".$htmlrow.">";

                }
            }



            if(!empty($row)){
                $output .= "</tr>";
            }

            if($firstHead == true && $a == 0){
                $output .= '</thead>';
            }
        }
        $a++;
    }

    if($firstHead == true && $a == 1){
        $output .= '</tbody>';
    }

    $output .= "</table>";
    $output .= "</div>";


    return $output;
}

function getShareon(){
    ?>
    <div class="shareon-container">
        <span><?php _e("Share","danosa"); ?></span>
        <div class="shareon">

            <?php $mailToSend = "mailto:?Subject=".get_the_title()."&Body=".get_the_title()." ".urlencode(get_the_permalink()); ?>

            <a href="<?php echo $mailToSend; ?>" class="email"></a>
            <a class="facebook"></a>
            <a class="twitter"></a>
            <a class="linkedin"></a>
        </div>
    </div>
    <?php
}


// determine the topmost parent of a term
function get_term_top_most_parent( $term_id, $taxonomy, $level = 0 ) {
    $ancestors = get_ancestors( $term_id, $taxonomy );

    if($level == 0){
        if(!empty($ancestors)){
            $parentID = end( $ancestors );
        }else{
            $parentID = $term_id;
        }
    }else{
        if(!empty($ancestors[$level])){
            $parentID = $ancestors[0];
        }else{
            $parentID = $term_id;
        }
    }
    return $parentID;
}

function get_family_tree($taxonomy, $parent = 0, $field = "description", $prefix = "")
{
    $terms = get_terms($taxonomy, array('parent' => $parent, 'hide_empty' => true));
    //If there are terms, start displaying
    if(count($terms) > 0)
    {
        //Displaying as a list
        $out = "<ul>";
        //Cycle though the terms
        if($taxonomy == "cad_cat"){
            $counter = 1;
        }else{
            $counter = "";
        }
        foreach ($terms as $term)
        {
            $parentID = get_term_top_most_parent($term->term_id,$taxonomy,1);
            $currentParentID = get_term_top_most_parent(get_queried_object()->term_id,$taxonomy,1);

            if($parentID == $currentParentID){
                $active = "active";
            }else{
                $active = "colapsed";
            }

            if($field == "name"){
                $name = $term->name;
            }else{
                $name = $term->description;
            }

            $dropdown = false;
            $terms_aux = get_terms($taxonomy, array('parent' => $term->term_id, 'hide_empty' => false));
            if(!empty($terms_aux)){
                $dropdown = true;
            }

            if($taxonomy == "cad_cat"){

                if($dropdown){
                    $out .="<li><a class='dropdown ".$active."' href=\"" . get_term_link( $term, $taxonomy ) . "\">". $prefix . $counter . " " . $name ."<i class='danosa-arrow-right'></i></a>". get_family_tree($taxonomy, $term->term_id, $field,  $prefix . $counter.".") . "</li>";
                }else{
                    $out .="<li><a href=\"" . get_term_link( $term, $taxonomy ) . "\">". $prefix . $counter . " " . $name ."</a>". get_family_tree($taxonomy, $term->term_id, $field,  $prefix . $counter.".") . "</li>";
                }

            }else{
                if($dropdown){
                    $out .="<li class='list-".$active."'><a class='dropdown ".$active."' href=\"" . get_term_link( $term, $taxonomy ) . "\">". $prefix . $counter . " " . $name ."<i class='danosa-arrow-right'></i></a>". get_family_tree($taxonomy, $term->term_id, $field) . "</li>";
                }else{
                    $out .="<li><a href=\"" . get_term_link( $term, $taxonomy ) . "\">". $prefix . $counter . " " . $name ."</a>". get_family_tree($taxonomy, $term->term_id, $field) . "</li>";
                }

            }

            if($taxonomy == "cad_cat"){
                $counter++;
            }
        }
        $out .= "</ul>";
        return $out;
    }
    return;
}

/**
 * Custom posts per page for Taxonomy
 */
function cs_custom_posts_per_page( $query ) {

    if ( is_tax( 'family' ) && $query->is_main_query() ) {
        $query->query_vars['posts_per_page'] = 24;
        $query->query_vars['meta_key'] = 'order';
        $query->query_vars['orderby'] = 'meta_value_num';
        $query->query_vars['order'] = 'ASC';
        return;
    }

    if ( is_tax( 'documentation_cat' ) ) {
        $query->query_vars['posts_per_page'] = 24;
        return;
    }

    if ( is_tax( 'cad_cat' ) ) {
        $query->query_vars['posts_per_page'] = 24;
        return;
    }
}
add_filter( 'pre_get_posts', 'cs_custom_posts_per_page' );


add_shortcode( 'online_project', 'online_project_function' );

add_action( 'wp_ajax_download', 'my_download' );
add_action( 'wp_ajax_nopriv_download', 'my_download' );

function my_download() {
    $nonce = sanitize_text_field( $_REQUEST['nonce'] );
    if ( ! wp_verify_nonce( $nonce, 'online-project-post-nonce' ) ) {
        die ( 'La sesión ha caducado, lo sentimos pero ha de volver a crear el proyecto');
    }
    if(isset($_REQUEST['webId']) && $_REQUEST['webId'] != ""){
        $_REQUEST['webid'] = $_REQUEST['webId'];
    }
    if(isset($_REQUEST["download_type"])){
        $dir =    __DIR__."/online_project/Downloads/".$_REQUEST["download_type"]."/".sanitize_text_field($_REQUEST['webid']);
    }else{
        $dir =    __DIR__."/online_project/Downloads/".sanitize_text_field($_REQUEST['webid']);
    }
    $status = __DIR__."/online_project/Downloads/status".sanitize_text_field($_REQUEST['webid']).".log";

    unlink($status);
    $zip = $dir.".zip";
    $file_name = basename($zip);
    if(isset($_REQUEST["file_name"])){
        $file_name= $_REQUEST["file_name"].".zip";
         $zipArchive = new ZipArchive();

        $zipArchive->addFromString( $file_name,  file_get_contents($zip));
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$file_name.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zip));
    readfile($zip);
    unlink($zip);
    wp_die();
    die();
}


add_action( 'wp_ajax_download_post', 'my_download_post' );
add_action( 'wp_ajax_nopriv_download_post', 'my_download_post' );

function my_download_post() {

    ini_set('memory_limit', '1024M');

    $nonce = sanitize_text_field( $_POST['nonce'] );
    if ( ! wp_verify_nonce( $nonce, 'online-project-post-nonce' ) ) {
        die ( 'La sesión ha caducado, lo sentimos pero ha de volver a crear el proyecto');
    }
    $array = array("status" => "error","total" => 0,"actual" => 0,"message" => "");
    if(isset($_POST['webId']) && $_POST['webId'] != ""){
        $_POST['webid'] = $_POST['webId'];
    }
    if(isset($_POST['webid']) && $_POST['webid'] != ""  && isset($_POST["callback"])){
        require_once __DIR__ . '/vendor/autoload.php';
        require_once __DIR__."/online_project/Downloads/ZipFolder.php";
        if(isset($_POST["download_type"])){
            $dir = __DIR__."/online_project/Downloads/".$_POST["download_type"]."/".sanitize_text_field($_POST['webid']);
            if(!file_exists(__DIR__."/online_project/Downloads/".$_POST["download_type"]))  mkdir(__DIR__."/online_project/Downloads/".$_POST["download_type"]);
        }else{
            $dir = __DIR__."/online_project/Downloads/system/".sanitize_text_field($_POST['webid']);
        }

        $zip = $dir.".zip";
        $status = __DIR__."/online_project/Downloads/status".sanitize_text_field($_POST['webid']).".log";
        if(!file_exists($status)){
           if(!file_exists($dir))  mkdir($dir);
            $action = $_POST["callback"];
            $array["message"] = $action;
            if(is_callable($action)){
                $action($dir,$status);
            }else{
                $array["message"] = $action." is not callable";
                file_put_contents($status,json_encode($array));
            }
        }
         $array = json_decode(file_get_contents($status),true);
         if($array["status"] == "compressing" && file_exists($zip)){ // ha fallado el compresor de carpetas
            $array["status"] = "finish";
            file_put_contents($status,json_encode($array));
         }
    }  else{
        $array["message"] = "Not webid or callback";
        file_put_contents($status,json_encode($array));
    }


    header('Content-type: application/json');
    echo json_encode($array);

   wp_die();
   die();
}

    function rrmDir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                rrmDir($dir. DIRECTORY_SEPARATOR .$object);
                else
                unlink($dir. DIRECTORY_SEPARATOR .$object);
            }
            }
            rmdir($dir);
        }
    }

 function wpcf7_do_something (&$WPCF7_ContactForm) {

        $wpcf7      = WPCF7_ContactForm::get_current();


        $submission = WPCF7_Submission::get_instance();
        if ($submission) {

            $data = $submission->get_posted_data();

            $webId = $WPCF7_ContactForm->id();
            $origen =  "Consultas";
            if($webId == "2 8416") $origen = "Calculadora energética";
            $nombre = "";
            if(isset($data["your-name"])) $nombre = $data["your-name"];
            $apellidos = "";
            if(isset($data["your-surnames"])) $apellidos = $data["your-surnames"];
            $email = "";
            if(isset($data["your-email"])) $email = $data["your-email"];
            $telefono = "";
            if(isset($data["your-phone"])) $telefono = $data["your-phone"];
            $empresa = "";
            if(isset($data["company"])) $empresa = $data["company"];
            $actividad = "";
            if(isset($data["activity"])) {
                if(is_array($data["activity"])){
                $actividad = $data["activity"][0];
                }else{
                  $actividad = $data["activity"];
                }
            }
            $ciudad = "";
            if(isset($data["city"])) $ciudad = $data["city"];
            $cpos = "";
            if(isset($data["pc"])) $cpos = $data["pc"];
            $pais = "";
            if(isset($data["country"])) {
                if(is_array($data["country"])){
                $pais = $data["country"][0];
                }else{
                  $pais = $data["country"];
                }
            }
            $consulta = "";
            if(isset($data["type-of-question"])) {
                if(is_array($data["type-of-question"])){
                $consulta = $data["type-of-question"][0];
                }else{
                  $consulta = $data["type-of-question"];
                }
            }
            $comentarios = "";
            if(isset($data["your-message"])) $comentarios = $data["your-message"];
            $acceptacion = "";
            if(isset($data["rgpd"])) $acceptacion = $data["rgpd"];
            save_dynamics_contact(
                $webId,
                $origen,
                $nombre,
                $apellidos,
                $email,
                $telefono,
                $empresa,
                $actividad,
                $ciudad,
                $cpos,
                $pais,
                $consulta,
                $comentarios,
                $acceptacion,
                $data);

        }
   }

   add_action("wpcf7_before_send_mail", "wpcf7_do_something");
function my_prescripcion_online_download_post_create($dir,$status) {
        ini_set('memory_limit', '1024M');

        $nonce = sanitize_text_field( $_POST['nonce'] );
        if ( ! wp_verify_nonce( $nonce, 'online-project-post-nonce' ) ) {
            die ( 'La sesión ha caducado, lo sentimos pero ha de volver a crear el proyecto');
        }
        $data = html_entity_decode(htmlentities($_REQUEST["partidasData".$_REQUEST["type"]], ENT_QUOTES, "UTF-8"));
        $data = str_replace("\\","",$data);
        $data_array = json_decode($data,true);


        save_dynamics_contact($_REQUEST["webId"],"Diseña tu proyecto",$_REQUEST["name"],$_REQUEST["surname"],$_REQUEST["email"],"",$_REQUEST["company"],$_REQUEST["activity"],$_REQUEST["city"],"","","",$_REQUEST["project_name"],$_REQUEST["SI_QUIERO_INSCRIBIRME"]);

        $fixed_process = 2;
        $post_id = $_POST["post_id"];
        $title = sanitize_title(get_the_title( $post_id ));
        $array = array("status" => "preparing","total" => $fixed_process,"actual" => 0,"message" => "");
        $files = array();

        $files[$dir."/valoracion.pdf"] =  $_REQUEST["form"];
        $array["message"] = "valoracion.pdf";
        $array["total"] = $fixed_process + count( $files);
        $data_array[$_REQUEST["type"]]["partidas"] = array(); // ELIMINAMOS LAS PARTIDAS
        file_put_contents($status,json_encode($array));


        /*AÑADIMOS LOS SISTEMAS SELECCIONADOS COMO PARTIDAS*/
        if(isset($_REQUEST["PrescripcionSistemas"])){
            $PrescripcionSistemas = html_entity_decode(htmlentities($_REQUEST["PrescripcionSistemas"], ENT_QUOTES, "UTF-8"));
            $PrescripcionSistemas = str_replace("\\","",$PrescripcionSistemas);
            $PrescripcionSistemas_array = json_decode($PrescripcionSistemas,true);
            foreach($PrescripcionSistemas_array as $pSistema){
            $data_array[$_REQUEST["type"]]["partidas"][] = array("partida_text" => $pSistema["sistema_tipo"],"solucionVertical_text" => $pSistema["sistema_vertical"],"solucionVertical2_text" => $pSistema["sistema_vertical2"], "solucionHorizontal_text" => $pSistema["sistema_text"],"mm" => $pSistema["mm"]);
            }
        }


        foreach($data_array[$_REQUEST["type"]]["partidas"] as $partida){
            if($partida != null){
                $slug = explode(" - ",$partida["solucionHorizontal_text"]);
                $slug = trim(end($slug));
                $page = get_page_by_title($slug,OBJECT,"system");
                if($page){
                    mkdir($dir."/".$slug );
                    $system_data_sheet = get_field("system_data_sheet",$page->ID);
                    if($system_data_sheet !=""){
                        $files[$dir."/".$slug."/".basename($system_data_sheet)] =  $system_data_sheet;
                        $array["message"] = basename($system_data_sheet);
                        $array["total"] = $fixed_process + count( $files);
                        file_put_contents($status,json_encode($array));
                    }
                    $bim = get_field("bim",$page->ID);
                    if($bim !=""){
                        $files[$dir."/".$slug."/".basename($bim)] =  $bim;
                        $array["message"] = basename($bim);
                        $array["total"] = $fixed_process + count( $files);
                        file_put_contents($status,json_encode($array));
                    }
                    $dwg_details = get_field("dwg_details",$page->ID);
                    if($dwg_details !=""){
                        $files[$dir."/".$slug."/".basename($dwg_details)] =  $dwg_details;
                        $array["message"] = basename($dwg_details);
                        $array["total"] = $fixed_process + count( $files);
                        file_put_contents($status,json_encode($array));
                    }
                    $decomposed_prices = get_field("decomposed_prices",$page->ID);
                    if($decomposed_prices !=""){
                        $files[$dir."/".$slug."/".basename($decomposed_prices)] =  $decomposed_prices;
                        $array["message"] = basename($decomposed_prices);
                        $array["total"] = $fixed_process + count( $files);
                        file_put_contents($status,json_encode($array));
                    }
                    $products = get_field("products",$page->ID);
                    if(!empty($products)){
                        $products = explode(",", $products);
                        $products = array_map("sanitize_title", $products);
                        $args = array(
                          'post_type'       => 'product',
                          'post_name__in'        => $products
                        );
                        $the_query  = new WP_Query( $args );
                        // The Loop
                        if ( $the_query->have_posts() ) { // Para cada producto relacionado
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                mkdir($dir."/".$slug."/Products" );
                                $product_safety_datasheet = wp_get_post_terms( get_the_ID(), "product_safety_datasheet", array( 'fields' => 'all' ) );
                                foreach ($product_safety_datasheet as $key => $value) {
                                    $link = get_field("file",$value);
                                    if($link !=""){
                                        $files[$dir."/".$slug."/Products/".basename($link)] =  $link;
                                        $array["message"] = basename($link);
                                        $array["total"] = $fixed_process + count( $files);
                                        file_put_contents($status,json_encode($array));
                                    }
                                }

                                $certifications = wp_get_post_terms( get_the_ID(), "system_certification", array( 'fields' => 'all' ) );
                                foreach ($certifications as $key => $value) {
			                        $link = get_field("file",$value);
                                    if($link !=""){
                                        $files[$dir."/".$slug."/Products/".basename($link)] =  $link;
                                        $array["message"] = basename($link);
                                        $array["total"] = $fixed_process + count( $files);
                                        file_put_contents($status,json_encode($array));
                                    }
		                        }


                                $link = get_permalink( get_the_ID());
                                $title = sanitize_title(get_the_title());

                                $files[$dir."/".$slug."/Products/danosa_ftecnica_".$title.".pdf"] =  $link."?pdf&download";
                                $array["message"] = "danosa_ftecnica_".$title.".pdf";
                                $array["total"] = $fixed_process + count( $files);
                                file_put_contents($status,json_encode($array));

                            }
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    }
                }else{
                    $page = get_page_by_title($slug,OBJECT,"product");
                    if($page){
                        mkdir($dir."/".$slug );
                        $args = array(
                          'post_type'       => 'product',
                          'post__in'        => array(get_the_ID())
                        );
                        $the_query  = new WP_Query( $args );
                        // The Loop
                        if ( $the_query->have_posts() ) {
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $product_safety_datasheet = wp_get_post_terms( get_the_ID(), "product_safety_datasheet", array( 'fields' => 'all' ) );
                                foreach ($product_safety_datasheet as $key => $value) {
                                    $link = get_field("file",$value);
                                    if($link !=""){
                                        $files[$dir."/".$slug."/".basename($link)] =  $link;
                                        $array["message"] = basename($link);
                                        $array["total"] = $fixed_process + count( $files);
                                        file_put_contents($status,json_encode($array));
                                    }
                                }

                                $certifications = wp_get_post_terms( get_the_ID(), "system_certification", array( 'fields' => 'all' ) );
                                foreach ($certifications as $key => $value) {
			                        $link = get_field("file",$value);
                                    if($link !=""){
                                        $files[$dir."/".$slug."/".basename($link)] =  $link;
                                        $array["message"] = basename($link);
                                        $array["total"] = $fixed_process + count( $files);
                                        file_put_contents($status,json_encode($array));
                                    }
		                        }


                                $link = get_permalink( get_the_ID());
                                $title = sanitize_title(get_the_title());

                                $files[$dir."/".$slug."/danosa_ftecnica_".$title.".pdf"] =  $link."?pdf&download";
                                $array["message"] = "danosa_ftecnica_".$title.".pdf";
                                $array["total"] = $fixed_process + count( $files);
                                file_put_contents($status,json_encode($array));


                            }
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    }
                }
            }
        }

        require_once __DIR__ . '/vendor/autoload.php';
        require_once __DIR__."/online_project/Downloads/ZipFolder.php";

        $c = 1;
        $array["status"] = "generating";
        $array["message"] = "";
        $array["actual"] =  $c;
        file_put_contents($status,json_encode($array));
        $get_site_url = get_site_url();
        foreach($files as $file => $link){
            $c++;
            $array["actual"] = $c;
            if(endsWith($file,"valoracion.pdf")){
                $array["message"] = "Valoración";

                file_put_contents($status,json_encode($array));
                ob_start();
                include __DIR__."/online_project/".$link."_valoracion.php";
                $pdf = ob_get_contents();
                ob_end_clean();
                $mpdf = new \Mpdf\Mpdf();
		        $mpdf->WriteHTML($pdf);
		        $mpdf->Output($file, \Mpdf\Output\Destination::FILE);
            }else{
                $array["message"] = basename($file);
                file_put_contents($status,json_encode($array));
                $content = file_get_contents($link);
                file_put_contents($file, $content);
            }


        }
        $array["status"] = "compressing";
        $c++;
        $array["actual"] =  $c;
        file_put_contents($status,json_encode($array));
        $zip = $dir.".zip";
        HZip::zipDir($dir, $zip, true);
        $array["status"] = "finish";
        file_put_contents($status,json_encode($array));
}
/* Se llama desde my_download_post*/
function my_system_download_post_create($dir,$status) {

    $nonce = sanitize_text_field( $_POST['nonce'] );
    if ( ! wp_verify_nonce( $nonce, 'online-project-post-nonce' ) ) {
        die ( 'La sesión ha caducado, lo sentimos pero ha de volver a crear el proyecto');
    }


    save_dynamics_form($_REQUEST["webid"],"Sistemas");
    save_dynamics_contact($_REQUEST["webid"],"Sistemas",$_REQUEST["name"],$_REQUEST["surname"],$_REQUEST["E-mail"],$_REQUEST["phone"],$_REQUEST["company"],$_REQUEST["activity"],$_REQUEST["city"],$_REQUEST["cpos"],"","",$_REQUEST["titproy"],$_REQUEST["SI_QUIERO_INSCRIBIRME"]);



    $fixed_process = 2;
    $post_id = $_POST["post_id"];
    $title = sanitize_title(get_the_title( $post_id ));
    $array = array("status" => "preparing","total" => $fixed_process,"actual" => 0,"message" => "");
    $files = array();
    if(isset($_POST["system_data_sheet"])){
        $system_data_sheet = get_field("system_data_sheet",$post_id);
        if(!empty($system_data_sheet)){
            $files[$dir."/danosa_ficha_sistema_".$title.".pdf"] =  $system_data_sheet;
            $array["message"] = "danosa_ficha_sistema_".$title.".pdf";
            $array["total"] = $fixed_process + count( $files);
            file_put_contents($status,json_encode($array));
        }

    }
    if(isset($_POST["bim"])){
        $bim = get_field("bim",$post_id);
        if(!empty($bim)){
            $files[$dir."/danosa_bim_sistema_".$title.".rvt"] =  $bim;
            $array["message"] = "danosa_bim_sistema_".$title.".rvt";
            $array["total"] = $fixed_process + count($files);
            file_put_contents($status,json_encode($array));
        }

    }
    if(isset($_POST["certifications"])){
        $certifications = wp_get_post_terms( $post_id, "system_certification", array( 'fields' => 'all' ) );

        foreach ($certifications as $key => $certification) {

            $certificationLink = get_field("file",$certification);
            $name = "danosa_certification_sistema_".sanitize_title($certification->name)."_".$title.".pdf";

            if(!empty($certificationLink)){
                $files[$dir."/".$name] =  $certificationLink;
                $array["message"] = $name;
                $array["total"] = $fixed_process + count($files);
                file_put_contents($status,json_encode($array));

            }
        }

    }



    if(isset($_POST["dwg_details"])){
        $dwg_details = get_field("dwg_details",$post_id);
        if(!empty($dwg_details)){
            $files[$dir."/danosa_sistema_".$title.".dwg"] =  $dwg_details;
            $array["message"] = "danosa_sistema_".$title.".dwg";
            $array["total"] = $fixed_process + count( $files);
            file_put_contents($status,json_encode($array));
        }

    }
    if(isset($_POST["decomposed_prices"])){
        $decomposed_prices = get_field("decomposed_prices",$post_id);
        if(!empty($decomposed_prices)){
            $extension = pathinfo($decomposed_prices, PATHINFO_EXTENSION);
            $files[$dir."/danosa_precios_descompuestos_sistema_".$title.".".$extension] =  $decomposed_prices;
            $array["message"] = "danosa_precios_descompuestos_sistema_".$title.".".$extension;
            $array["total"] = $fixed_process + count($files);
            file_put_contents($status,json_encode($array));
        }

    }
    if(isset($_POST["check_productos_ft"])){
        if(!empty($_POST['ficha_tecnica'])) {
            mkdir($dir."/FichasTecnicas");
            foreach($_POST['ficha_tecnica'] as $check) {
                $link = get_permalink($check);
                if($link != ""){
                    $link = $link ."?pdf&download";
                    $subtitle = sanitize_title(get_the_title( $check ));
                    $files[$dir."/FichasTecnicas/danosa_ftecnica_".$subtitle.".pdf"] =  $link;
                    $array["message"] = "danosa_ftecnica_".$subtitle.".pdf";
                    $array["total"] = $fixed_process + count($files);
                    file_put_contents($status,json_encode($array));
                }

            }
        }
    }
    if(isset($_POST["check_productos_fs"])){
        if(!empty($_POST['ficha_seguridad'])) {
            mkdir($dir."/FichasSeguridad");
            foreach($_POST['ficha_seguridad'] as $check) {
                $product_safety_datasheet = wp_get_post_terms( $check, "product_safety_datasheet", array( 'fields' => 'all' ) );
                foreach ($product_safety_datasheet as $key => $value) {
                    $link = get_field("file",$value);
                    $subtitle = sanitize_title($value->name);
                    $extension = pathinfo($link, PATHINFO_EXTENSION);
                    $files[$dir."/FichasSeguridad/danosa_fseguridad_".$subtitle.".".$extension] =  $link;
                    $array["message"] = "danosa_fseguridad_".$subtitle.".".$extension;
                    $array["total"] = $fixed_process + count($files);
                    file_put_contents($status,json_encode($array));
                }
            }
        }
    }
   // $array["files"] =  $files;
    $c = 1;
    $array["status"] = "generating";
    $array["message"] = "";
    $array["actual"] =  $c;
    file_put_contents($status,json_encode($array));
   $get_site_url = get_site_url();
    foreach($files as $file => $link){
        $c++;
        if(endsWith($link,"?pdf&download")){

            $array["message"] = "Ficha Técnica: ". str_replace(array("?pdf&download",$get_site_url),array("",""),$link);
        }else{
            $array["message"] = basename($file);
        }

        $array["actual"] = $c;
        file_put_contents($status,json_encode($array));
        $content = file_get_contents($link);
        file_put_contents($file, $content);
    }
    $array["status"] = "compressing";
    $c++;
    $array["actual"] =  $c;
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__."/online_project/Downloads/ZipFolder.php";
    file_put_contents($status,json_encode($array));
    $zip = $dir.".zip";
    HZip::zipDir($dir, $zip, true);
    $array["status"] = "finish";
    file_put_contents($status,json_encode($array));
}
function endsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}

add_action( 'wp_ajax_online_project_post', 'my_online_project_post' );
add_action( 'wp_ajax_nopriv_online_project_post', 'my_online_project_post' );

function my_online_project_post() {

  /*  ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/
    ini_set('memory_limit', '1024M');

    $nonce = sanitize_text_field( $_POST['nonce'] );
    if ( ! wp_verify_nonce( $nonce, 'online-project-post-nonce' ) ) {
        die ( 'La sesión ha caducado, lo sentimos pero ha de volver a crear el proyecto');
    }
      $data = html_entity_decode(htmlentities($_REQUEST["partidasData".$_REQUEST["type"]], ENT_QUOTES, "UTF-8"));
    $data = str_replace("\\","",$data);
    $data_array = json_decode($data,true);

    if(isset($_REQUEST["valoracion"])){
        include __DIR__."/online_project/".$_REQUEST["form"]."_valoracion.php";
    }elseif(isset($_REQUEST["generate"]) && isset($_REQUEST["webId"]) && $_REQUEST["webId"] !=""){
        require_once __DIR__ . '/vendor/autoload.php';
        require_once __DIR__."/online_project/Downloads/ZipFolder.php";
        $dir = __DIR__."/online_project/Downloads/".sanitize_text_field($_REQUEST["webId"]);
        $zip = $dir.".zip";

        mkdir($dir );
        //Valoracion
        ob_start();
		include __DIR__."/online_project/".$_REQUEST["form"]."_valoracion.php";
		$pdf = ob_get_contents();
		ob_end_clean();
        //Sistemas
        foreach($data_array[$_REQUEST["type"]]["partidas"] as $partida){

            if($partida != null){
                $slug = explode(" - ",$partida["solucionHorizontal_text"]);
                $slug = trim(end($slug));
                $page = get_page_by_title($slug,OBJECT,"system");
                if($page){
                    mkdir($dir."/".$slug );

                    $system_data_sheet = get_field("system_data_sheet",$page->ID);
                    if($system_data_sheet !=""){
                        $content = file_get_contents($system_data_sheet);
                        file_put_contents($dir."/".$slug."/".basename($system_data_sheet), $content);
                    }
                    $bim = get_field("bim",$page->ID);
                    if($bim !=""){
                        $content = file_get_contents($bim);
                        file_put_contents($dir."/".$slug."/".basename($bim), $content);
                    }
                    $dwg_details = get_field("dwg_details",$page->ID);
                    if($dwg_details !=""){
                        $content = file_get_contents($dwg_details);
                        file_put_contents($dir."/".$slug."/".basename($dwg_details), $content);
                    }
                    $decomposed_prices = get_field("decomposed_prices",$page->ID);
                    if($decomposed_prices !=""){
                        $content = file_get_contents($decomposed_prices);
                        file_put_contents($dir."/".$slug."/".basename($decomposed_prices), $content);
                    }

                    $products = get_field("products",$page->ID);
                    if(!empty($products)){
                        $products = explode(",", $products);
                        $products = array_map("sanitize_title", $products);
                        $args = array(
                          'post_type'       => 'product',
                          'post_name__in'        => $products
                        );
                        $the_query  = new WP_Query( $args );
                        // The Loop
                        if ( $the_query->have_posts() ) { // Para cada producto relacionado
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();

                                $product_safety_datasheet = wp_get_post_terms( get_the_ID(), "product_safety_datasheet", array( 'fields' => 'all' ) );
                                foreach ($product_safety_datasheet as $key => $value) {
                                    $link = get_field("file",$value);
                                    if($link !=""){
                                        mkdir($dir."/".$slug."/Products" );
                                        $content = file_get_contents($link);
                                        file_put_contents($dir."/".$slug."/Products/".basename($link), $content);
                                    }
                                }

                                $certifications = wp_get_post_terms( get_the_ID(), "system_certification", array( 'fields' => 'all' ) );
                                foreach ($certifications as $key => $value) {
			                        $link = get_field("file",$value);
			                        $content = file_get_contents($link);
                                    file_put_contents($dir."/".$slug."/Products/".basename($link), $content);
		                        }

                                mkdir($dir."/".$slug."/Products" );
                                $link = get_permalink( get_the_ID());
                                $title = sanitize_title(get_the_title());

                                /*
                                $content = file_get_contents($link."?dop-pdf&download");
                                file_put_contents($dir."/".$slug."/Products/danosa_dop_".$title.".pdf", $content);
                                */
                                $content = file_get_contents($link."?pdf&download");
                                file_put_contents($dir."/".$slug."/Products/danosa_ftecnica_".$title.".pdf", $content);


                            }
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    }
                }else{
                    $page = get_page_by_title($slug,OBJECT,"product");
                    if($page){
                        mkdir($dir."/".$slug );
                        $args = array(
                          'post_type'       => 'product',
                          'post__in'        => array(get_the_ID())
                        );
                        $the_query  = new WP_Query( $args );
                        // The Loop
                        if ( $the_query->have_posts() ) {
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $product_safety_datasheet = wp_get_post_terms( get_the_ID(), "product_safety_datasheet", array( 'fields' => 'all' ) );
                                foreach ($product_safety_datasheet as $key => $value) {
                                    $link = get_field("file",$value);
                                    if($link !=""){
                                        $content = file_get_contents($link);
                                        file_put_contents($dir."/".$slug."/".basename($link), $content);
                                    }
                                }

                                $certifications = wp_get_post_terms( get_the_ID(), "system_certification", array( 'fields' => 'all' ) );
                                foreach ($certifications as $key => $value) {
			                        $link = get_field("file",$value);
			                        $content = file_get_contents($link);
                                    file_put_contents($dir."/".$slug."/".basename($link), $content);
		                        }


                                $link = get_permalink( get_the_ID());
                                $title = sanitize_title(get_the_title());

                                /*
                                $content = file_get_contents($link."?dop-pdf&download");
                                file_put_contents($dir."/".$slug."/danosa_dop_".$title.".pdf", $content);
                                */

                                $content = file_get_contents($link."?pdf&download");
                                file_put_contents($dir."/".$slug."/danosa_ftecnica_".$title.".pdf", $content);


                            }
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    }
                }
            }
        }




		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($pdf);
		$mpdf->Output($dir."/valoracion.pdf", \Mpdf\Output\Destination::FILE);
        HZip::zipDir($dir, $zip,true);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($zip).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zip));
        readfile($zip);
    }
    wp_die();
    die();
}
function getRegions($iso){
    switch ($iso) {
        case 'es':
            $regions = array("Álava"," Albacete"," Alicante"," Almería"," Asturias"," Ávila"," Badajoz"," Barcelona"," Burgos"," Cáceres"," Cádiz"," Cantabria"," Castellón"," Ceuta"," Ciudad Real"," Córdoba"," Cuenca"," Girona"," Las Palmas"," Granada"," Guadalajara"," Guipúzcoa"," Huelva"," Huesca"," Illes Balears"," Jaén"," A Coruña"," La Rioja"," León"," Lleida"," Lugo"," Madrid"," Málaga"," Melilla"," Murcia"," Navarra"," Ourense"," Palencia"," Pontevedra"," Salamanca"," Segovia"," Sevilla"," Soria"," Tarragona"," Santa Cruz de Tenerife"," Teruel"," Toledo"," Valencia"," Valencia"," Valladolid"," Vizcaya"," Zamora"," Zaragoza");
            break;
        case 'pt':
            $regions = array("Açores","Aveiro","Beja","Braga","Bragança","Castelo Branco","Coimbra","Évora","Faro","Guarda","Leiria","Lisboa","Madeira","Portalegre","Porto","Santarém","Setúbal","Viana do Castelo","Vila Real","Viseu");
            break;
        case 'fr':
            $regions = array("Auvergne-Rhône-Alpes","Bourgogne-Franche-Comté","Bretagne","Centre-Val de Loire","Corse","Grand Est","Hauts-de-France","Île-de-France","Normandie","Nouvelle-Aquitaine","Occitanie","Pays de la Loire","Provence-Alpes-Côte d'Azur");
            break;
        case 'gb':
            $regions = array("East of England","East Midlands","London","North East","North West","South East","South West","West Midlands","Yorkshire and the Humber");
            break;
        default:
            $regions = array();
            break;
    }
    return $regions;
}
function online_project_function($atts = [], $content = null, $tag = '' ) {
    ob_start();
    include __DIR__."/online_project/".$atts["form"].".php";
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
function create_dynamics_tables($prefix = ""){
    global $wpdb;
    if($prefix == ""){
        $prefix =  $wpdb->prefix;
    }


    $table =$prefix.'dynamics_form';
    //$wpdb->query( 'DROP TABLE ' . $table);
    $wpdb->query( 'CREATE TABLE IF NOT EXISTS ' . $table . ' (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,guid varchar(16), type varchar(100),created_at Datetime,json_data text,comments text NULL,status tinyint(2) NULL);' );
    $table = $prefix.'dynamics_form_contact';
    //$wpdb->query( 'DROP TABLE ' . $table);
    $wpdb->query( 'CREATE TABLE IF NOT EXISTS ' . $table . ' (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,guid varchar(16), origen varchar(100),nombre varchar(100),apellidos varchar(100),email varchar(250),telefono varchar(100),empresa varchar(100),actividad varchar(100),ciudad varchar(100),cpos varchar(100),pais varchar(100),consulta text,comentarios varchar(100),acceptacion varchar(100),created_at Datetime,bulk text);' );



}
add_action( 'admin_post_save_dynamics_form_field', 'save_dynamics_form_field' );
function save_dynamics_form_field( ){
    global $wpdb;
    if(isset($_POST["id"])  ){
        $table = $wpdb->prefix.'dynamics_form';
        if(isset($_POST["comments"])  ){
            $wpdb->query( $wpdb->prepare("UPDATE $table SET comments = %s where id = %s",
                array(
                        $_POST["comments"],
                        $_POST["id"]
                    )
                )
            );
        }
        if(isset($_POST["status"])  ){

            $wpdb->query( $wpdb->prepare("UPDATE $table SET status = %d where id = %s",
                array(
                        $_POST["status"],
                        $_POST["id"]
                    )
                )
            );
               echo  $_POST["status"];
        die();
        }

    }

}

function save_dynamics_form($guid,$type,$data = array()){
    global $wpdb;
    if(!is_array($data) || count($data) == 0){
        $data = $_REQUEST;
    }
    unset($data["nombre"]);
    unset($data["name"]);
    unset($data["apellidos"]);
    unset($data["surname"]);
    unset($data["email"]);
    unset($data["telefono"]);
    unset($data["phone"]);


    $req = json_encode($data) ;

    $table = $wpdb->prefix.'dynamics_form';

    create_dynamics_tables();
    $prepare =  $wpdb->prepare("INSERT INTO $table ( guid, type, created_at,json_data ) VALUES ( %s, %s, now(), %s)",
    array(
            $guid,
            $type,
            $req
        )
    );
    $wpdb->query($prepare);

}
function save_dynamics_contact($webId,$origen,$nombre,$apellidos,$email,$telefono,$empresa,$actividad,$ciudad,$cpos,$pais,$consulta,$comentarios,$acceptacion,$data = array()){

    create_dynamics_tables();
    global $wpdb;
    $table = $wpdb->prefix.'dynamics_form_contact';
    if(!is_array($data) || count($data) == 0){
        $req = json_encode($_REQUEST) ;
    }else{
        $req = json_encode($data) ;
    }

    $prepare = $wpdb->prepare("INSERT INTO $table ( guid,origen,nombre,apellidos,email,telefono,empresa,actividad,ciudad,cpos,pais,consulta,comentarios,acceptacion, created_at, bulk ) VALUES ( %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s, now(),%s)",
        array(
        $webId,$origen,$nombre,$apellidos,$email,$telefono,$empresa,$actividad,$ciudad,$cpos,$pais,$consulta,$comentarios,$acceptacion,$req )
        );
    $r =  $wpdb->query( $prepare  );

    $to = 'jmalvarez@danosa.com';
    $subject = __('Nuevo formulario').' '.__($origen).': '.$webId ;
    $body = '';
    $headers = array('Content-Type: text/html; charset=UTF-8');
   // $headers[] = 'Cc: otro@email';
   //$headers[] = 'Cc: pere@mediosyproyectos.com';


    switch ($origen) {
        case "Diseña tu proyecto":
            $to = get_field("disena_tu_proyecto","option");
	        $to = empty($to)?'proyectos.es@danosa.com':$to;
            ob_start();
                include "email/dynamics_contact.php";
            $body = ob_get_contents();
            ob_end_clean();
            $mailResult = wp_mail( $to, $subject, $body, $headers );
            $disena_tu_proyecto_template =  get_field("disena_tu_proyecto_template","option");
            $disena_tu_proyecto_asunto =  get_field("disena_tu_proyecto_asunto","option");
            if(!empty($disena_tu_proyecto_template)){
                $subject =  empty($disena_tu_proyecto_asunto)?$subject:$disena_tu_proyecto_asunto;
                $to = $email;
                $mailResult = wp_mail( $to, $subject, $disena_tu_proyecto_template, array('Content-Type: text/html; charset=UTF-8') );
            }
	        break;
        case "Sistemas":
            $to = get_field("sistemas","option");
            $to = empty($to)?'sistemas.es@danosa.com':$to;
            ob_start();
                include "email/dynamics_contact.php";
            $body = ob_get_contents();
            ob_end_clean();
            $mailResult = wp_mail( $to, $subject, $body, $headers );
            $sistemas_template =  get_field("sistemas_template","option");
            $sistemas_asunto =  get_field("sistemas_asunto","option");
            if(!empty($sistemas_template)){
                $subject =  empty($sistemas_asunto)?$subject:$sistemas_asunto;
                $to = $email;
                $mailResult = wp_mail( $to, $subject, $sistemas_template, array('Content-Type: text/html; charset=UTF-8') );
            }
	        break;
        case "Acoustic App FD":
            $subject = "Consulta DUDAS APP ACUSTICA";
            $to = get_field("acoustic_app_fd","option");
            $to = empty($to)?'jmalvarez@danosa.com':$to;
            ob_start();
                include "email/dynamics_contact.php";
            $body = ob_get_contents();
            ob_end_clean();
            $mailResult = wp_mail( $to, $subject, $body, $headers );
	        break;
        case "Acoustic App FST":
            $subject = "Formulario soporte Técnico APP ACUSTICA";
            $to = get_field("acoustic_app_fd","option");
            $to = empty($to)?'jmalvarez@danosa.com':$to;
            ob_start();
                include "email/dynamics_contact.php";
            $body = ob_get_contents();
            ob_end_clean();
            $mailResult = wp_mail( $to, $subject, $body, $headers );
	        break;
        default:

        break;
    }


}
function createDinamicsForm() {
    $nonce = sanitize_text_field( $_POST['nonce'] );

     if ( ! wp_verify_nonce( $nonce, 'create-dinamics-form-nonce' ) ) {
        die ( 'La sesión ha caducado, intentelo de nuevo refrescando la página');
    }
    global $wpdb;
    $guid = $_REQUEST["guid"];
    $table = $wpdb->prefix.'dynamics_form';
    if($guid == ""){
        create_dynamics_tables();
        $wpdb->query( $wpdb->prepare("INSERT INTO $table ( guid, type, created_at,json_data ) VALUES ( %s, %s, now(), %s)",
            array(
                    GUID(),
                    "Diseña tu proyecto",
                    $_REQUEST["data"]
                )
            )
        );
        $my_id = $wpdb->insert_id;
        $guid = $wpdb->get_var( "SELECT guid FROM $table where id = ".$my_id );
    }else{

        $wpdb->query( $wpdb->prepare("UPDATE $table SET  json_data = %s where guid = %s",
            array(

                    $_REQUEST["data"],
                    $guid
                )
            )
        );
    }

    echo $guid;
    wp_die();
    die();
}

add_action( 'wp_ajax_get_dynamics_form_contact', 'get_dynamics_form_contact' );
function get_dynamics_form_contact() {
    $blog_id = (int)sanitize_text_field( $_POST['blog_id'] );
     $guid = sanitize_text_field( $_POST['guid'] );

    global $wpdb;

    $table = $wpdb->base_prefix.$blog_id.'_dynamics_form_contact';

    $sql = "select * from ".$table." where  guid = %s";
    $prepare = $wpdb->prepare($sql, $guid) ;



    $results = $wpdb->get_results( $prepare,ARRAY_A  );




    include("_form_contact.php");
     wp_die();
    die();
}


add_action( 'wp_ajax_nopriv_createDinamicsForm', 'createDinamicsForm' );
add_action( 'wp_ajax_createDinamicsForm', 'createDinamicsForm' );

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

add_filter( 'upload_mimes', 'my_myme_types', 1, 1 );
function my_myme_types( $mime_types ) {
    $mime_types['rar'] = 'application/vnd.rar';
    return $mime_types;
}


function load_product_fields($campos, $postID){
    foreach ($campos as $key => $value) {

        if($value["origin"] == "term"){
            $term_list = wp_get_post_terms( $postID, $key, array( 'fields' => 'all' ) );

            if(!empty($value["field"]) &&  $value["field"] == "description"){
                if(!empty($term_list)){
                    echo '<div class="product-data '.$key.' product-data-term">';
                    echo '<h3>'.$value["name"].'</h3>';
                    echo '<div>';
                    $field_data = get_field('description',$term_list[0]);


                    echo cleanSingularFeatures($field_data);
                    echo '</div>';
                    echo '</div>';
                }
            }else{

                // Filtrar solo términos con descripción no vacía
                $term_list_filtered = array_filter($term_list, function($element) {
                    return !empty(trim($element->description));
                });

                if(!empty($term_list_filtered)){
                    echo '<div class="product-data product-data-term">';
                    echo '<h3>'.$value["name"].'</h3>';
                    echo '<div class="product-data">';
                    echo "<ul>";
                    foreach ($term_list_filtered as $key2 => $element) { ?>
                        <li><?php echo $element->description; ?></li>
                    <?php }
                    echo "</ul>";
                    echo '</div>';
                    echo '</div>';
                }
            }

        }else{
            $field_data = get_field($key, $postID);

            if(!empty($field_data)){
            ?>
            <div class="product-data product-data-field <?php echo $key; ?>">
                <h3><?php echo $value["name"]; ?></h3>
                <div>
                <?php if(!empty($value["field"]) &&  $value["field"] == "image"){ ?>
                    <img src="<?php echo $field_data; ?>" />
                <?php }elseif(!empty($value["field"]) &&  $value["field"] == "table"){ ?>
                    <?php echo formatTable($field_data); ?>
                <?php }elseif(!empty($value["field"]) &&  $value["field"] == "list"){ ?>
                    <?php echo cleanSingularFeatures($field_data,true); ?>
                <?php }else{ ?>
                    <?php echo cleanSingularFeatures($field_data); ?>
                <?php } ?>
                </div>
            </div>
            <?php
            }
        }
    }
}

function get_download_link($name,$link,$icon = null){
    ?>
    <li>
        <a href="<?php echo $link; ?>" target="_blank">
            <span><?php echo $name; ?></span><span class="view-more"><?php _e("Download","danosa"); ?> <i class="danosa-download"></i></span>
        </a>
    </li>
    <?php
}

function clean_system_reference($reference){
            $title = explode("_",$reference);
            return end($title);
}

// Add scripts to astra_header_before()
add_action( 'astra_header_after', 'add_script_before_header' );
function add_script_before_header() {
    $claim = get_field("claim","option");
    if(is_front_page() && !empty($claim)){
    ?>
    <div class="main-header-bar ast-header-breadcrumb">
        <div class="ast-container">
            <div class="ast-breadcrumbs-wrapper">
                <div class="ast-breadcrumbs-inner">
                    <h2><?php echo $claim; ?></h2>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
}

//END


add_filter( 'bcn_breadcrumb_title', 'my_bcn_breadcrumb_title', 1, 3 );
function my_bcn_breadcrumb_title(  $title, $type, $id ) {

    if(is_array($type) && in_array("taxonomy",$type) && in_array("family",$type)){
        return strip_tags(term_description($id));
    }else{
        return $title;
    }


}



function get_system_list($taxonomy = "system_cat", $termId = null, $hreflang_ref = null){



    $args = array(
        'post_type' => 'system',
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => -1,
    );

    $args["tax_query"] = array();
    $args["tax_query"]["relation"] = "AND";
    $args["tax_query"][] = array(
        'taxonomy' => $taxonomy,
        'field'    => 'term_id',
        'terms'    => $termId,
    );

    if(!empty($hreflang_ref) && $hreflang_ref == "system_sustainability"){

        $args["tax_query"][] = array(
            'taxonomy' => 'system_icon',
            'field'    => 'term_id',
            'terms'    => 2427,
        );
    }

    if(!empty($hreflang_ref) && $hreflang_ref == "system_rehabilitation"){

        $args["tax_query"][] = array(
            'taxonomy' => 'system_icon',
            'field'    => 'term_id',
            'terms'    => 2426,
        );
    }

    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<ul><li>';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $title = explode("_",get_the_title());
            $icons = get_the_terms( get_the_ID(), "system_icon" );

            $data = "";
                if($icons){
                foreach ($icons as $key => $value) {
                    $data = "data-".sanitize_title($value->name)."='true' ";
                }
            }
		/*

		include ("loop-system.php");
		*/
		$image_list = get_field('image_list');
        $noImage = false;
        if(empty($image_list)){
            $image_list = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
            $noImage = true;
        }
            ?>
            <div <?php echo $data; ?>>
                <a href="<?php the_permalink(); ?>">
                    <img width="200" height="136" src="<?php echo $image_list; ?>"  alt="" loading="lazy">
                    <span class="subsystem-system-title" style="padding-left:20px;padding-right:0;margin:0;"><?php echo end($title); ?></span>
                    <span class="subsystem-system-name" style="margin:0;padding:0;" ><i class="danosa-arrow-go" style="padding-left:0px;margin-left:0px;padding-right:10px;"></i><?php echo get_the_content(null,false); ?></span>
                </a>
            </div>
            <?php
        }

		echo '</li></ul>';
    } else {
        ?>
        <script type="text/javascript">
            jQuery(".subsystem-<?php echo $termId; ?>").hide();
        </script>
        <?php
    }
    /* Restore original Post Data */
    wp_reset_postdata();

}

function getYoutubeCode($video){
    $ytarray=explode("/", $video);
    $ytendstring=end($ytarray);
    $ytendarray=explode("?v=", $ytendstring);
    $ytendstring=end($ytendarray);
    $ytendarray=explode("&", $ytendstring);
    $ytcode=$ytendarray[0];
    return $ytcode;
}

function get_child_levels($term,$taxonomy){
    $subsystems = get_terms( $taxonomy, array(
        'hide_empty' => true,
        'parent' => $term->term_id,
    ) );

    $i = 0;

    foreach ($subsystems as $key2 => $subsystem) {
        $i = $i + get_child_levels($subsystem,$taxonomy);
    }

    if(!empty($subsystems)){

        $i++;
    }
    return $i;
}


function resumen_proyecto_function(){

    get_template_part( 'content', 'resumen_proyecto' );

  die();
}

add_action('wp_ajax_resumen_proyecto', 'resumen_proyecto_function');
add_action('wp_ajax_nopriv_resumen_proyecto', 'resumen_proyecto_function');

function cargar_paises_function(){

    get_template_part( 'content', 'countries' );

  die();
}

add_action('wp_ajax_cargar_paises', 'cargar_paises_function');
add_action('wp_ajax_nopriv_cargar_paises', 'cargar_paises_function');



add_action('astra_body_bottom', 'footer_help_chat');
function footer_help_chat() {

    if((getSiteCountry() == "es" || getSiteCountry() == "pt") && (is_singular("product") || is_singular("system") || is_tax("family") || is_tax("system_cat") || is_tax("system_acoustic") )){
    ?>
    <div id="soporte-flotante-container">
        <div id="soporte-flotante-launcher">
            <div class="close"></div>
            <div class="show"></div>
        </div>
        <div id="soporte-flotante-texto">
            <button class="close"></button>
            <span class="grande"><?php _e("Hello! Do you need any help?","danosa"); ?></span><br>
            <span><?php _e("Let's meet up and discuss together","danosa"); ?> 😉</span>
            <div class="wp-block-button"><a href="<?php _e("https://www.danosa.com/en-gb/contact/technical-support/","danosa"); ?>" class="wp-block-button__link"><?php _e("Book an appointment","danosa"); ?></a></div>
        </div>
    </div>
    <?php
    }
}


add_action('astra_body_bottom', 'footer_code');
function footer_code() {


    ?>
    <div style="display: none;"><div id="lighboxCountries"></div></div>
    <script>
        var stylesheet_directory_uri = "<?php echo get_stylesheet_directory_uri(); ?>";
        var siteLang = "<?php //echo getSiteLanguage(); ?>";
        var siteCountry = "<?php //echo getSiteCountry(); ?>";
        var home_uri = "<?php echo esc_url( home_url( '/' ) ); ?>";
    </script>
    <!-- Matomo -->
    <script>
      var _paq = window._paq = window._paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//stats.danosa.com/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Matomo Code -->
    <!-- Matomo Tag Manager -->
    <script>
    var _mtm = window._mtm = window._mtm || [];
    _mtm.push({'mtm.startTime': (new Date().getTime()), 'event': 'mtm.Start'});
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src='https://stats.danosa.com/js/container_G9OoRlpc.js'; s.parentNode.insertBefore(g,s);
    </script>
    <!-- End Matomo Tag Manager -->
    <?php
}



function get_cat_filters($term_id) {

    if($term_id == "SYSTEM"){
        $category = $term_id;
    }else{
        $category = get_term_by('id', $term_id, 'family');
        $category = $category->name;
    }

    switch ($category) {
        case "SYSTEM":
            $filtros = array(
                'system_type_of_work'       => array('name' => __('Type of works', "danosa"), 'origin' => 'term', 'type' => 'checkbox'),
                'system_type_of_construction'       => array('name' => __('Type of constructions', "danosa"), 'origin' => 'term', 'type' => 'checkbox'),
                'system_area_of_operation'       => array('name' => __('Area of operation', "danosa"), 'origin' => 'term', 'type' => 'checkbox'),
                'system_solution_for'       => array('name' => __('Solutions for', "danosa"), 'origin' => 'term', 'type' => 'checkbox'),
                'system_products'       => array('name' => __('System products', "danosa"), 'origin' => 'term', 'type' => 'checkbox'),
            );
            break;
        case "W0111":
            $filtros = array(
                'filter_sheet_type'       => array('name' => __('Product type', "danosa"), 'origin' => 'field', 'type' => 'checkbox'),
                'filter_armor_type'       => array('name' => __('Reinforcement type', "danosa"), 'origin' => 'field', 'type' => 'checkbox'),
                'filter_finish'       => array('name' => __('Finishing', "danosa"), 'origin' => 'field', 'type' => 'checkbox'),
                'filter_special_uses'       => array('name' => __('Specific applications', "danosa"), 'origin' => 'term', 'type' => 'checkbox'),
            );
            break;
        default:
            $filtros = array();
            /*$filtros = array(
            'product_lifestyle' => array('name' => __('Lifestyle',"danosa"), 'origin' =>'term', 'type' => 'radio'),
            );*/
            break;
    }

    return $filtros;
}



function set_select($selector, $valores, $args = null, $get = null, $prefijo = null, $sufijo = null, $from = null, $to = null){
    $unicos = array_unique($valores);
    global $print_debug;

    //por ahora obtenemos el primer valor del get al ser select.
    $get = $get[0];

    asort($unicos, SORT_NATURAL);

    if(get_current_user_id() == 1 && 1==$print_debug){
        echo '<div class="debug unicos">';
          print_r($selector);
       print_r($unicos);
        echo "</div>";
    }

    if($selector == "filter_energy_class"){
        //$unicos = array_reverse($unicos);
        usort($unicos, function($a, $b){
          if($b == "B" || $b == "C" || $b == "D" || $b == "E" || $b == "F" || $b == "G"){
            return -1;
          }else{
            $plus1 = substr_count($a,"+");
            $plus2 = substr_count($b,"+");
            return ($plus1 > $plus2)? -1:1;
          }
        });
        $unicos = array_combine($unicos, $unicos);
    }

    if(get_current_user_id() == 1 && 1==2){
      echo '<div class="debug">';
       print_r($unicos);
      echo "</div>";
    }

    ?>
    <script type="text/javascript">
        var selectList = jQuery("#filter .product-filter-<?php echo $selector; ?>");
        selectList.find(".producto").remove();

        jQuery("#filter .product-filter-<?php echo $selector; ?>").show();

        //console.log("<?php echo count($unicos); ?>");
        jQuery("#filter .product-filter-<?php echo $selector; ?>").addClass("filterActive");

        <?php

        $contador = 0;



        foreach ($unicos as $value=>$texto){
            ?>
            //console.log("<?php echo $value; ?>");
            <?php

            //reemplazar texto
            if(!empty($from)){
                $texto = str_replace($from,$to,$texto);
            }
                $contador++;
            ?>


            <?php
            //buscar si el campo está marcado
            $check = "";
            if(is_array($get) && in_array($texto,$get)){
                foreach ($get as $getkey => $getvalue) {
                    if($getvalue == $texto){
                        $check = 'checked="checked"';
                    }
                }
            }
            ?>

                      jQuery("#filter .product-filter-<?php echo $selector; ?> .childs").append('<div class="producto va <?php echo $selector; ?>-<?php echo $contador; ?> <?php echo $selector; ?>-<?php echo clean($texto); ?>"><span class="checkbox-container"><input name="<?php echo $selector; ?>[]" type="checkbox" id="producto-<?php echo htmlentities($value, ENT_QUOTES); ?>" value="<?php echo htmlentities($value, ENT_QUOTES); ?>" data-selector="<?php echo $selector; ?>" data-value="<?php echo htmlentities($value, ENT_QUOTES); ?>" data-id="<?php echo clean($selector); ?>-<?php echo clean($texto); ?>" <?php echo $check; ?>><label for="producto-<?php echo htmlentities($value, ENT_QUOTES); ?>"><span></span><?php echo "$prefijo".htmlentities($texto, ENT_QUOTES)."$sufijo"; ?></label></span></div>');
                      <?php
        }
        ?>

        <?php if($contador < 1 && empty($get)){ ?>
            jQuery("#filter .product-filter-<?php echo $selector; ?>").hide();
            jQuery("#filter .product-filter-<?php echo $selector; ?>").removeClass("filterActive");

        <?php } ?>


    </script>
    <?php
}

function valor_unico($valor, $prefijo = null, $sufijo = null, $separador = " / ", $desc = false, $from = null, $to = null){
    //print_r($valor);
  if(!empty($from)){
    $valor = str_replace($from,$to,$valor);
  }
  if($valor){
    $unicos = array_unique($valor);
    if(empty($desc)){
      sort($unicos, SORT_NATURAL);
    }else{
      sort($unicos, SORT_NATURAL, SORT_DESC);
    }



    $j = 0;
    $len = count($unicos);
    foreach ($unicos as $i=>$unico){

        if($unico == "SI"){
          $unico = __("SI","danosa");
        }
        echo "<span>$prefijo".$unico."$sufijo</span>";
        if ($j != $len - 1) {
          echo "<span class='separador'>$separador</span>";
        }
        $j++;
    }
  }else{
    return "no hay valores";
  }

}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

//quitar el JavaScript para responder comentarios
function clean_header(){ wp_deregister_script( 'comment-reply' ); } add_action('init','clean_header');

add_action( 'send_headers', 'add_header_seguridad' );
function add_header_seguridad() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1;mode=block' );
}

// Remove - Canonical for - [Search - Page]
function remove_canonical() {
     //if ( is_singular('product') ) {
        add_filter( 'wpseo_canonical', '__return_false',  10, 1 );
    //}
}
add_action('wp', 'remove_canonical');


function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins

        if ( $user->data->user_login == "consultas" ) {
            // redirect them to the default place
            return "https://www.danosa.com/es-es/consultas-de-usuarios/";
        } else {
            return $redirect_to;
        }
    } else {
        return $redirect_to;
    }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    // show admin bar only for admins
    if (!current_user_can('manage_options')) {
        add_filter('show_admin_bar', '__return_false');
    }
    // show admin bar only for admins and editors
    if (!current_user_can('edit_posts')) {
        add_filter('show_admin_bar', '__return_false');
    }
}



add_action('wp_ajax_nopriv_product_file', 'wp_ajax_product_file');
add_action('wp_ajax_product_file', 'wp_ajax_product_file');

function wp_ajax_product_file(){
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sample.csv"');
    $posts = get_posts([
      'post_type' => 'product',
      'post_status' => 'publish',
      'numberposts' => -1
    ]);


    $fields = array("dop_1_codigo_de_identificacion",
    "dop_2_tipo_lote_n_de_serie",
    "dop_3_usos_previstos_del_producto",
    "dop_4_nombre_comercial",
    "dop_5_contacto_representante",
    "dop_6_sistemas_de_evaluacion_y_verificacion",
    "dop_7_nombre_y_numero_del_organismo_notificado",
    "dop_8_prestaciones_declaradas",
    "dop_notas",
    "dop_9_prestaciones",
    "dop_10_responsable",
    "dop_10_lugar_y_fecha_de_emision",
    "dop_10_firma");




    $user_CSV = array();
    $user_CSV[] = array('Reference', 'URL', 'SHA1',"Date","Version");
    foreach ( $posts as $post ) {
        $data = array();
        $data[] = get_the_title($post);
        $data[] = get_permalink($post)."?dop-pdf";
        $metas = get_post_meta($post->ID);
        $sha1 = array();
        $saved_sha1 = "";
        $saved_data = "";
        $saved_version = 0;
        foreach($metas as $key => $meta){
            if(in_array($key,$fields)){
                $sha1[$key] = $meta[0];
            }
            if($key=="dop_hash"){
                $saved_sha1 =  $meta[0];
            }
            if($key=="dop_fecha_interna"){
                $saved_data =  $meta[0];
            }
            if($key=="dop_version"){
                $saved_version =  $meta[0];
            }
        }
        $actual_sha1 = sha1( json_encode($sha1));
        if($actual_sha1 != $saved_sha1){
            update_field("dop_hash", $actual_sha1,$post->ID);
            $saved_data = date("Y-m-d H:i:s");
            update_field("dop_fecha_interna", $saved_data,$post->ID);
            $saved_version += 1;
        }
        $data[] = $actual_sha1;
        $data[] = $saved_data;
        $data[] = $saved_version;
        $user_CSV[] = $data;

    }
    $fp = fopen('php://output', 'wb');
    foreach ($user_CSV as $line) {
        fputcsv($fp, $line, ',');
    }
    fclose($fp);

}


function site_id_in_body_class($classes) {
        $this_id = get_current_blog_id();
        $classes[] = 'site-id-'.$this_id;
        return $classes;
}
add_filter('body_class', 'site_id_in_body_class');


/*
Después de las importaciones
*/

add_action('pmxi_after_xml_import', 'after_xml_import', 10, 1);

function after_xml_import($import_id) {
    global $wpdb;
    $blog_id = get_current_blog_id();



    $prefix = "wp_".$blog_id."_";
    $resultados= $wpdb->get_results( "select CONCAT(cat.slug,'___',".$prefix."terms.term_id) as cat_appl,count(*) as num  from ".$prefix."term_taxonomy inner join ".$prefix."terms on ".$prefix."terms.term_id = ".$prefix."term_taxonomy.term_id inner join ".$prefix."term_relationships on ".$prefix."term_relationships.term_taxonomy_id = ".$prefix."term_taxonomy.term_taxonomy_id inner join ".$prefix."posts on ".$prefix."posts.ID = ".$prefix."term_relationships.object_id inner join (select ".$prefix."posts.ID,".$prefix."terms.slug from ".$prefix."term_taxonomy inner join ".$prefix."terms on ".$prefix."terms.term_id = ".$prefix."term_taxonomy.term_id inner join ".$prefix."term_relationships on ".$prefix."term_relationships.term_taxonomy_id = ".$prefix."term_taxonomy.term_taxonomy_id inner join ".$prefix."posts on ".$prefix."posts.ID = ".$prefix."term_relationships.object_id where taxonomy = 'product_cat' )  as cat on cat.ID = ".$prefix."posts.ID where taxonomy = 'product_type_of_appliance' group by CONCAT(cat.slug,'___',".$prefix."terms.term_id)" );

    $arr = array();
    foreach ($resultados as $key => $value) {
    $arr[$value->cat_appl] = $value->num;
    }
    update_option( "type_of_appliances_amount", json_encode( $arr ) );


    $taxonomies = array("family","product_conservation","product_notice","product_application","product_standards_certification","product_benefits","product_support","product_substrate_preparation","product_important_indications","product_warning","product_safety_hygiene","product_maintenance","product_safety_datasheet");

    foreach ($taxonomies as $taxonomy) {
    $query = "SELECT t.name, t.term_id
            FROM " . $prefix . "terms AS t
            INNER JOIN " . $prefix . "term_taxonomy AS tt
            ON t.term_id = tt.term_id
            WHERE tt.taxonomy = '".$taxonomy."' and description = ''";

      $terms = $wpdb->get_results($query);

      foreach ($terms as $term) {
          wp_delete_term( $term->term_id, $taxonomy);
        }
    }



}

function comprobarTabla($cadena) {
    if (substr_count($cadena, '<table>') != substr_count($cadena, '</table>')) {
        $cadena .= '</table>';
    }
    return $cadena;
}

/* 1.  Disable Comments on ALL post types */
function disable_comments_post_types_support() {
    $types = get_post_types();
    foreach ($types as $type) {
       if(post_type_supports($type, 'comments')) {
          remove_post_type_support($type, 'comments');
          remove_post_type_support($type, 'trackbacks');
       }
    }
 }
 add_action('admin_init', 'disable_comments_post_types_support');

 /* 2. Hide any existing comments on front end */
 function disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
 }
 add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

 /* 3. Disable commenting */
 function disable_comments_status() {
    return false;
 }
 add_filter('comments_open', 'disable_comments_status', 20, 2);
 add_filter('pings_open', 'disable_comments_status', 20, 2);