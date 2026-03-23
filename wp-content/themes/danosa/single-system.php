<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>


	<div id="primary" <?php astra_primary_class(); ?>>

			<main id="main" class="site-main">
				<?php
				if ( have_posts() ) :
					do_action( 'astra_template_parts_content_top' );

					while ( have_posts() ) :
						the_post();

						$image = get_field("image");

						$system_data_sheet = get_field("system_data_sheet");
						$bim = get_field("bim");

						?>

						<article <?php echo astra_attr('article-single',array('id'    => 'post-' . get_the_id(),'class' => join( ' ', get_post_class() ),)); ?>>


							<div class="entry-content clear" itemprop="text">
							    <div id="system-header" class="wp-block-group alignfull has-background" style="background-image:linear-gradient(90deg,rgba(0,0,0,0.5) 0%,rgba(0,0,0,0.5) 100%),url(<?php echo $image; ?>);">
							    	<?php require_once("system/system-header.php"); ?>
							    </div>
							    <div id="system-bar" class="wp-block-group alignfull has-background" style="background-color:#eef3f6">
							    	<?php require_once("system/system-bar.php"); ?>
							    </div>

								<div class="wp-block-group" id="system-legend">
									<?php require_once("system/system-legend.php"); ?>
							    </div>

							    <div id="system-content" class="wp-block-group">
							        <div class="wp-block-group__inner-container">

										<?php if(getSiteCountry() != "gb"){ ?>
										<div id="system-tabs" class="danosa-tabs">
											<a href="#" class="tab active" data-toggle-target=".tab-content-1"><?php _e('Description', "danosa"); ?></a>
											<a href="#" class="tab" data-toggle-target="#system-datasheet"><?php _e('Technical features and measures', "danosa"); ?></a>
											<a href="#" class="tab" data-toggle-target=".tab-content-3"><?php _e('Tools, guides and downloads', "danosa"); ?></a>

										</div>
										<?php } ?>
										<div id="system-description" class="tab-content tab-content-1 active">
										  	<?php
									        $campos = array(

									            'advantages'             => array('name' => __('Advantages', "danosa"), 'origin' => 'field', 'field' => "list"),
									            'application'            => array('name' => __('Application', "danosa"), 'origin' => 'field', 'field' => "list"),
									            'graph'                  => array('name' => __('Graph', "danosa"), 'origin' => 'field', 'field' => 'image'),

									        );

											load_product_fields($campos,$post->ID);
											?>
										</div>
										<?php if(getSiteCountry() != "gb"){ ?>
										<div id="system-datasheet" class="tab-content tab-content-2">
										  	<?php

									        $campos = array(
									            'technical_requirements' => array('name' => __('Technical Requirements', "danosa"), 'origin' => 'field', 'field' => 'table'),
									            'recommendations'        => array('name' => __('Recommendations', "danosa"), 'origin' => 'field'),
									            'unit_of_work'           => array('name' => __('Unit of Work', "danosa"), 'origin' => 'field'),

									        );

											load_product_fields($campos,$post->ID);


											?>
										</div>

										<?php } ?>
										<?php if(getSiteCountry() != "gb"){ ?>
										<div id="system-downloads" class="tab-content tab-content-3">
										  <?php require_once("system/system-downloads.php"); ?>
										</div>
										<?php } ?>

							        </div>
							    </div>


							    <?php
							    	$video = get_field("url_video");
							    	if(!empty($video)){
								        $ytcode = getYoutubeCode($video);
								        ?>

									    <div id="system-video" class="wp-block-group">
									        <div class="wp-block-group__inner-container">
												<h3><?php _e("Installation video","danosa"); ?></h3>
												<div
												  class="youtube-player pristine"
												  data-video-id="<?php echo $ytcode; ?>">
												  <img src="https://img.youtube.com/vi/<?php echo $ytcode; ?>/maxresdefault.jpg" alt="custom-preview">
												</div>
											</div>
										</div>
								        <?php

									}
							    ?>

								<?php if(getSiteCountry() != "gb"){ ?>
							    <div  id="system-related-products" class="wp-block-group alignfull has-background" style="background-color:#F5F5F5">
							    	<div class="wp-block-group__inner-container">
										  <?php require_once("system/system-related-products.php"); ?>
									</div>
								</div>
								<?php } ?>

								<?php echo do_shortcode("[danosa_banner]"); ?>

							    <div id="system-related-systems" class="wp-block-group">
							        <div class="wp-block-group__inner-container">
							            <?php
										if(!empty($solutions)){
											?>
											<h3>solutions</h3>
											<?php
											echo $solutions;
										}
										?>
							        </div>
							    </div>
							</div>


							<?php astra_entry_bottom(); ?>

						</article><!-- #post-## -->

						<?php astra_entry_after();

						endwhile;
					do_action( 'astra_template_parts_content_bottom' );
					else :
						do_action( 'astra_template_parts_content_none' );
					endif;
					?>
			</main><!-- #main -->

	</div><!-- #primary -->


<?php
	get_footer();
?>
