<?php
add_shortcode( 'link_hreflang', 'link_hreflang_function' );

function link_hreflang_function($atts, $content, $tag) {

    $p = shortcode_atts( array (
          'hreflang' => '#'
          ), $atts );

    $posts = get_posts(array(
        'numberposts'   => -1,
        'post_type'     => 'page',
        'meta_key'      => 'hreflang_ref',
        'meta_value'    => $p['hreflang']
    ));

    if($posts){
        return get_the_permalink( $posts[0] );
    }else{
        return "#";
    }

}


add_filter( 'wpcf7_form_elements', 'do_shortcode' );