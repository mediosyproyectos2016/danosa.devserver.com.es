<?php
/*
Template Name: Danosa - Products
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


            <div id="products-main-list" class="content-list-container wp-block-columns">

                <?php
                $terms = get_terms( 'family', array(
                    'hide_empty' => false,
                    'parent' => 0
                ) );


                foreach ($terms as $key => $product) {


                        include("loop-family.php");


                }


                ?>
            </div>


        </div>


	</div><!-- #primary -->


<?php get_footer(); ?>
