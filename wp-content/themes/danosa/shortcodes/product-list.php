<?php
add_shortcode( 'product_list', 'product_list_function' );

function product_list_function($atts, $content, $tag) {


     $a = shortcode_atts( array(
     'products' => ''
     ), $atts );


    ob_start();

    $products = explode(",", $a["products"]);


    $args = array (
        'post_type'              => array( 'product' ),
        'post_name__in' => $products

    );


    // The Query
    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<ul class="product-landing-list">';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            echo '<li><a href="'.get_the_permalink().'"><span>' . get_the_title() . '</span> <i class="danosa-arrow-go"></i></a></li>';
        }
        echo '</ul>';
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();


$output = ob_get_contents();
ob_end_clean();

return $output;
}