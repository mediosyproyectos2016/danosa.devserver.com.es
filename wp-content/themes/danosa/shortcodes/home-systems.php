<?php
add_shortcode( 'home_soluciones', 'home_soluciones_function' );

function home_soluciones_function() {

    ob_start();

    ?>
        <div class="wp-block-columns home-block-title">
            <div class="wp-block-column" style="flex-basis:25%"></div>
            <div class="wp-block-column" style="flex-basis:50%">
                <h2 class="has-text-align-center"><?php _e("Solutions","danosa"); ?></h2>
            </div>
            <div class="wp-block-column" style="flex-basis:25%"></div>
        </div>


        <div id="systems-home-list" class="wp-block-group alignfull has-background" id="product-bar" style="background-color:#F5F5F5">
            <div class="ast-container">
                <div  class="content-list-container wp-block-columns">
                    <?php
                    $terms = get_terms( 'system_cat', array(
                        'hide_empty' => true,
                        'parent' => 0
                    ) );

                    foreach ($terms as $key => $product) {
                        $image = get_field('image', $product);
                        $description = get_field('description', $product);
                        ?>
                            <div class="wp-block-column content-list home-solucion">
                                <a href="<?php echo get_term_link($product); ?>">
                                    <figure class="wp-block-image size-large content-list-image">
                                        <img loading="lazy" src="<?php echo $image; ?>" alt="<?php echo $product->description; ?>"></figure>
                                    </figure>
                                </a>
                                <div class="wp-block-group">
                                    <div class="wp-block-group__inner-container">
                                        <h5><?php _e("Solutions","danosa"); ?></h5>
                                        <h2><?php echo $product->description; ?></h2>
                                        <p><?php echo $description; ?></p>
                                    </div>
                                </div>
                                <div class="wp-block-columns">
                                    <div class="wp-block-column" style="flex-basis:50%">
                                        <a href="<?php echo get_term_link($product); ?>"><?php _e("View more","danosa"); ?> <i class="danosa-arrow-go"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }


                $banner_home_solutions_enabled = get_field("banner_home_solutions_enabled","option");
                $banner_home_solutions_image = get_field("banner_home_solutions_image","option");
                $banner_home_solutions_link = get_field("banner_home_solutions_link","option");

                if($banner_home_solutions_enabled){
                ?>
                <div id="home-system-banner" class="wp-block-column content-list home-solucion">
                    <a href="<?php echo $banner_home_solutions_link; ?>">
                    <figure class="wp-block-image size-large">
                        <img loading="lazy" width="352" height="504" src="<?php echo $banner_home_solutions_image; ?>" alt="" class="wp-image-1399" />
                    </figure>
                    </a>
                </div>
                <?php } ?>
            </div>
            </div>
        </div>

 <?php
$output = ob_get_contents();
ob_end_clean();

return $output;
}