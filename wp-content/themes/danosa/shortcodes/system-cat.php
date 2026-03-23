<?php
add_shortcode( 'system_cat', 'system_cat_function' );

function system_cat_function($atts, $content, $tag) {

     $a = shortcode_atts( array(
     'hreflang_ref' => '#',
     'id' => '',
     ), $atts );

    ob_start();

    $posts = get_posts(array(
        'numberposts'   => -1,
        'post_type'     => 'page',
        'meta_key'      => 'hreflang_ref',
        'meta_value'    => $a["hreflang_ref"]
    ));

    if($posts){
        $link = get_the_permalink( $posts[0] );
        $title = $posts[0]->post_title;
    }

    $terms = get_terms( 'system_icon', array(
        'hide_empty' => true,
        'parent' => 0,
        'description__like' => $title,
    ) );

    foreach ($terms as $key => $product) {


        $image = get_field('image', $product);
        $icon = get_field('icon', $product);
        $description = get_field('description', $product);
        $color = get_field('color', $product);
        $color = "#f5f5f5";
        if(empty($icon)){
            $icon = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
        }
        ?>

        <div id="<?php echo sanitize_title($product->name); ?>" class="wp-block-column content-list fade-top">
            <?php if(!empty($link)){ ?>
            <a href="<?php echo $link; ?>">
                <figure class="wp-block-image size-large content-list-image">
                    <img loading="lazy" src="<?php echo $image; ?>" alt="<?php echo $product->name; ?>"></figure>
                </figure>
            </a>
            <?php } ?>
            <div class="wp-block-group">
                <div class="wp-block-group__inner-container">
                        <h5><?php _e("Solutions","danosa") ?></h5>
                        <h2><?php echo $product->name; ?></h2>
                        <p><?php echo $description; ?></p>

                        <ul class="subsystems">

                        <?php
                        $subsystems = get_terms( 'system_cat', array(
                            'hide_empty' => true,
                            'parent' => $product->term_id,

                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'meta_query' => [[
                                'key' => 'order',
                                'type' => 'NUMERIC',
                            ]],
                        ) );




                        ?>
                        </ul>
                </div>
            </div>
            <div class="wp-block-columns">
                <div class="wp-block-column">
                    <a href="<?php echo $link; ?>"><?php _e("View solutions","danosa"); ?> <i class="danosa-arrow-go"></i></a>
                </div>
            </div>
        </div>





<?php

                        }
                        ?>

 <?php
$output = ob_get_contents();
ob_end_clean();

return $output;
}