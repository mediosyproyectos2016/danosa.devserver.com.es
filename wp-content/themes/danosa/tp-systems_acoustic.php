<?php
/*
Template Name: Danosa - Systems Acoustic
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$image = get_field("image");
$title = get_field("title");
$description = get_field("description");
$hreflang_ref = get_field("hreflang_ref");

if(empty($title)){
    $title = get_the_title();
}
?>



	<div id="primary" <?php astra_primary_class(); ?>>



        <div class="entry-content clear" itemprop="text">


            <div id="systems-header" class="section-header alignfull">
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

            <div id="systems-acoustic-list" class="wp-block-group alignfull has-background" id="product-bar" style="background-color:#F5F5F5">
                <div class="ast-container">
                    <div  class="content-list-container wp-block-columns">

                        <?php
                        $terms = get_terms( 'system_acoustic', array(
                            'hide_empty' => true,
                            'parent' => 0
                        ) );

                        $taxonomy = "system_acoustic";


                        foreach ($terms as $key => $product) {


                                include("loop-system_acoustic.php");


                        }


                        ?>
                    </div>
                </div>
            </div>





        </div>


	</div><!-- #primary -->


<?php get_footer(); ?>
