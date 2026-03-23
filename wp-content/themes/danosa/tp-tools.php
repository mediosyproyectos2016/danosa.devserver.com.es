<?php
/*
Template Name: Danosa - Tools
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


            <div id="documentation-main-list" class="content-list-container wp-block-columns">

                <?php
                $terms = get_terms( 'documentation_cat', array(
                    'hide_empty' => false,
                    'parent' => 0
                ) );


                foreach ($terms as $key => $product) {


                        include("loop-documentation_cat.php");


                }


                ?>

                <div class="wp-block-column content-list fade-top">
                    <a href="/es-es/proyecto-online/biblioteca-cad/">
                        <figure class="wp-block-image size-large content-list-image" style="background-color: #F5F5F5">
                            <img loading="lazy" src="/wp-content/uploads/sites/2/2021/10/CAD_Detalles_singulares.jpg" alt="">
                        </figure>
                    </a>
                    <div class="wp-block-group">
                        <div class="wp-block-group__inner-container">
                                <h2>Biblioteca CAD</h2>
                                <p></p>
                        </div>
                    </div>
                    <div class="wp-block-columns">
                        <div class="wp-block-column" style="flex-basis:50%">
                            <a href="/es-es/proyecto-online/biblioteca-cad/">Ver <i class="danosa-arrow-go"></i></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>


	</div><!-- #primary -->


<?php get_footer(); ?>
