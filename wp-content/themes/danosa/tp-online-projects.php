<?php
/*
Template Name: Danosa - Online projects
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$image = get_field("image");
$title = get_field("title");
$description = get_field("description");

if(empty($title)){
    $title = get_the_title();
}
?>


	<div id="primary" <?php astra_primary_class(); ?>>



        <div class="entry-content clear" itemprop="text">


            <div id="products-header" class="section-header alignfull">
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


            <?php if( have_rows('block') ): ?>
                <div id="products-main-list" class="content-list-container wp-block-columns">
                <?php while( have_rows('block') ): the_row();
                    $block_image = get_sub_field('block_image');
                    $block_title = get_sub_field('block_title');
                    $block_description = get_sub_field('block_description');
                    $block_page = get_sub_field('block_page');
                    $block_link = get_sub_field('block_link');

                    if(!empty($block_page)){
                        $link = get_permalink($block_page);
                    }else{
                        $link = $block_link;
                    }
                    if(!empty($block_image)){
                        $image = wp_get_attachment_image_url( $block_image, 'danosa-news-list' );
                    }else{
                        $image = "https://danosa.myp.com.es/wp-content/uploads/sites/2/2021/06/logo-danosa-2.svg";
                    }


                    ?>
                    <div class="wp-block-column news-list fade-top">
                        <a href="<?php echo $link; ?>">
                            <figure class="wp-block-image size-large news-list-image">
                                <img loading="lazy" src="<?php echo $image; ?>" alt="<?php echo $image; ?>"></figure>
                            </figure>
                        </a>
                        <div class="wp-block-group">
                            <div class="wp-block-group__inner-container">
                                <h2><?php echo $block_title; ?></h2>
                                <?php if(!empty($block_description)){
                                    echo "<p>".$block_description."</p>";
                                } ?>
                            </div>
                        </div>
                        <div class="wp-block-columns">
                            <div class="wp-block-column" style="">
                                <a href="<?php echo $link; ?>"><?php _e("Calculate in application","danosa"); ?> <i class="danosa-arrow-go"></i></a>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
                </div>
            <?php endif; ?>


        </div>


	</div><!-- #primary -->


<?php get_footer(); ?>
