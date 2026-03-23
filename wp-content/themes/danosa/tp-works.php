<?php
/*
Template Name: Danosa - Works
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


        <div id="constructions-list" class="content-list-container wp-block-columns">
        <?php
        $args = array(
            'post_type' => 'construction',
            'posts_per_page' => '-1',
        );

        // The Query
        $the_query = new WP_Query( $args );

        // The Loop

        if ( $the_query->have_posts() ) {

            while ( $the_query->have_posts() ) {
                $the_query->the_post();


                        get_template_part("loop","construction");


                    ?>

            <?php
            }
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();

        ?>

        </div>

        </div>



	</div><!-- #primary -->


<?php get_footer(); ?>
