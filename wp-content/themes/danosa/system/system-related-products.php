
<?php
$products = get_field("products");

if(!empty($products)){
    ?>
    <h3><?php _e("Related products","danosa"); ?></h3>
    <div class="content-list-container">
    <?php
    $products = explode(",", $products);

    $products = array_map("sanitize_title", $products);

    $args = array(
      'post_type'       => 'product',
      'post_name__in'        => $products,
      'post_parent' => 0
    );
    $the_query  = new WP_Query( $args );


    // The Loop
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();


            get_template_part('loop','products');

        }

        ?>
    </div>
        <?php
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();
}
?>