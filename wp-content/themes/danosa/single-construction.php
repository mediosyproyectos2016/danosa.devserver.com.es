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

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

			<main id="main" class="site-main">
				<?php
				if ( have_posts() ) :
					do_action( 'astra_template_parts_content_top' );

					while ( have_posts() ) :
						the_post();

						astra_entry_before(); ?>

						<article <?php echo astra_attr('article-single',array('id'    => 'post-' . get_the_id(),'class' => join( ' ', get_post_class() ),)); ?>>

							<div class="entry-content clear" itemprop="text">
							    <div id="construction-top" class="wp-block-group alignfull">
							        <div class="wp-block-group__inner-container">
							            <div class="wp-block-columns">
							                <div id="construction-top-info" class="wp-block-column">

												<?php astra_primary_content_top(); ?>

												<h1><?php the_title(); ?></h1>

												<?php getShareon(); ?>

												<?php the_content(); ?>


												<?php

												$environmental_description = get_field("environmental_description");
												$year_of_construction = get_field("year_of_construction");
												$country = get_field("country");
												$province = get_field("province");
												$coordinates = get_field("coordinates");
												$type_of_construction = get_field("type_of_construction");
												$property = get_field("property");
												$project_management = get_field("project_management");
												$promoter = get_field("promoter");
												$construction_company = get_field("construction_company");
												$installer = get_field("installer");
												$systems = get_field("systems");
												$products = get_field("products");
												$measurements = get_field("measurements");



												if(!empty($country)){
													?>
													<div class="construction-data">
													<h3><?php _e("Location","danosa"); ?></h3>

													<?php
													if(!empty($coordinates)){
														?>
														<a target="_blank" href="https://maps.google.com/?q=<?php echo $coordinates; ?>">
														<?php
													}
													?>
													<i class="danosa-map"></i>
													<?php
													if(!empty($province)){
														?>
														<?php
														echo $province." - ";
													}
													echo get_country_name_by_iso($country)."<br>";


													if(!empty($coordinates)){
														?>
														</a>
														<?php
													}
													?>
													</div>
													<?php
												}


												if(!empty($environmental_description)){
													?>
													<div class="construction-data">
													<h3><?php _e("Environmental description","danosa"); ?></h3>
													<p><?php echo $environmental_description; ?></p>
													</div>
													<?php
												}






												if(!empty($measurements)){
													?>
													<div class="construction-data">
													<h3><?php _e("Measurements","danosa"); ?></h3>
													<?php
													echo formatTable($measurements);
													?>
													</div>
													<?php
												}

												if(!empty($year_of_construction)){
													?>


													<div class="construction-data">
														<h3><?php _e("More info","danosa"); ?></h3>

														<div class="data-table-container">
														<table class="data-table">
															<tbody>
																<tr class="data-table-row"><td><?php _e("Year of construction","danosa"); ?></td><td><?php echo $year_of_construction."</td>"; ?>
																<?php
																if(!empty($type_of_construction)){ ?>
																	<tr class="data-table-row"><td><?php _e("Type of construction","danosa"); ?></td><td><?php echo $type_of_construction."</td>"; }
																if(!empty($property)){ ?>
																	<tr class="data-table-row"><td><?php _e("Property","danosa"); ?></td><td><?php echo $property."</td>"; }
																if(!empty($project_management)){ ?>
																	<tr class="data-table-row"><td><?php _e("Project management","danosa"); ?></td><td><?php echo $project_management."</td>"; }
																if(!empty($promoter)){ ?>
																	<tr class="data-table-row"><td><?php _e("Promoter","danosa"); ?></td><td><?php echo $promoter."</td>"; }
																if(!empty($construction_company)){ ?>
																	<tr class="data-table-row"><td><?php _e("Construction company","danosa"); ?></td><td><?php echo $construction_company."</td>"; }
																if(!empty($installer)){ ?>
																	<tr class="data-table-row"><td><?php _e("Installer","danosa"); ?></td><td><?php echo $installer."</td>"; }
																?>
															</tbody>
														</table>
														</div>
													</div>
													<?php
												}



												?>



												<?php astra_primary_content_bottom(); ?>
							                </div>
							                <div id="construction-top-media" class="wp-block-column">
							                	<?php
												$image_thumbnail = get_field("image_thumbnail");
												$image_big = get_field("image_big");
												$gallery_thumbnail = get_field("gallery_thumbnail");
												$gallery_big = get_field("gallery_big");
												$video = get_field("video");

												$gallery_thumbnail = explode(",",$gallery_thumbnail);
												$gallery_big = explode(",",$gallery_big);

												if(empty($gallery_thumbnail)){
												?>
							                    <figure class="wp-block-image size-full">
							                    	<?php

													if(!empty($image)){
														?>
														<img src="<?php echo $image; ?>" alt="">
														<?php
													}
													?>

							                    </figure>
							                    <?php }else{ ?>

												<div id="construction-slider" class="slider slider-for">
													<div>
														<img src="<?php echo $image_big; ?>" alt="">
													</div>
													<?php
														foreach ($gallery_big as $key => $value) {
															?>
															<div>
																<img loading="lazy" src="<?php echo $value; ?>" alt="">
															</div>
															<?php
														}
													?>
												</div>
												<div id="construction-slider-nav" class="slider slider-nav">
													<div>
														<img loading="lazy" src="<?php echo $image_thumbnail; ?>" alt="">
													</div>
													<?php
														foreach ($gallery_thumbnail as $key => $value) {
															?>
															<div>
																<img loading="lazy" src="<?php echo $value; ?>" alt="">
															</div>
															<?php
														}
													?>
												</div>
							                	<?php
							                	}



													if(!empty($video)){
														?>
														<?php
														global $wp_embed;
														echo $wp_embed->run_shortcode('[embed]'.$video.'[/embed]');
													}
													?>
							                </div>
							            </div>
							        </div>
							    </div>
								<div id="product-related-systems" class="wp-block-group alignfull">
									<div class="wp-block-group__inner-container">
										<?php

										if(!empty($systems)){
											?>
											<h3><?php _e("Related solutions","danosa"); ?>:</h3>
											<?php
											$solutions = explode(",", $systems);

											$solutionsAux = array();
											foreach ($solutions as $key => $solution) {
												//echo clean_system_reference($solution)."<br>";
												$solution = get_page_by_title( clean_system_reference($solution), OBJECT, 'system' );
												if($solution){
													$solutionsAux[] = $solution->ID;
												}

											}

											$args = array(
											'post_type'       => 'system',
											'post__in'        => $solutionsAux,
											'posts_per_page' => -1
											);

											$the_query  = new WP_Query( $args );


											// The Loop
											if ( $the_query->have_posts() ) {
												?>
												<div class="content-list-container <?php if($the_query->post_count > 9){ ?>show-more-container<?php } ?>">
													<?php
												while ( $the_query->have_posts() ) {
													$the_query->the_post();

													$noFade = true;

													include ("loop-system.php");


												}
												?>
												</div>
												<?php

												if($the_query->post_count > 9){
													?>
													<a href="#" class="show-more"><?php _e("Show more","danosa"); ?> <i class="danosa-arrow-down"></i></a>
													<?php
												}
											} else {
												// no posts found
											}
											/* Restore original Post Data */
											wp_reset_postdata();
										}
										?>
									</div>
								</div>
								<?php
												if(!empty($products)){
													?>
													<h3><?php _e("Materials used","danosa"); ?>:</h3>
													<div class="content-list-container">
													<?php
													$products = explode(",", $products);

													$products = array_map("sanitize_title", $products);

													$args = array(
													  'post_type'       => 'product',
													  'post_name__in'        => $products
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



								<div class="wp-block-media-text is-stacked-on-mobile" style="grid-template-columns:78% auto" id="home-sostenibilidad">
								    <figure class="wp-block-media-text__media" data-sr-id="14" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 0.6s cubic-bezier(0.5, 0, 0, 1) 0.2s, transform 0.6s cubic-bezier(0.5, 0, 0, 1) 0.2s;"><img loading="lazy" width="928" height="392" src="https://danosa.myp.com.es/wp-content/uploads/2021/07/Rectangle-267.jpg" alt="" class="wp-image-1380 size-full" srcset="https://danosa.myp.com.es/wp-content/uploads/2021/07/Rectangle-267.jpg 928w, https://danosa.myp.com.es/wp-content/uploads/2021/07/Rectangle-267-300x127.jpg 300w, https://danosa.myp.com.es/wp-content/uploads/2021/07/Rectangle-267-768x324.jpg 768w" sizes="(max-width: 928px) 100vw, 928px"></figure>
								    <div class="wp-block-media-text__content" data-sr-id="11" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 0.6s cubic-bezier(0.5, 0, 0, 1) 0.2s, transform 0.6s cubic-bezier(0.5, 0, 0, 1) 0.2s;">
								        <h3>Sostenibilidad e innovación</h3>
								        <p>En esta obra se han empleado productos que contribuyen al cambio climático gracias al ahorro energético.</p>
								    </div>
								</div>

								<?php //if(is_user_logged_in()){ ?>
								<div class="wp-block-group alignfull has-background" id="constructions-list" style="background-color:#f5f5f5">
								    <div class="wp-block-group__inner-container">
								        <div class="wp-block-columns home-block-title">
								            <div class="wp-block-column" style="flex-basis:25%"></div>
								            <div class="wp-block-column" style="flex-basis:50%">
								                <h2 class="has-text-align-center">Otras obras</h2>
								            </div>
								            <div class="wp-block-column" style="flex-basis:25%"></div>
								        </div>
								        <div class="content-list-container wp-block-columns">

									        <?php
									        $args = array(
									            'post_type' => 'construction',
									            'posts_per_page' => '3',
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
								</div>
							<?php //} ?>
							</div>
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
