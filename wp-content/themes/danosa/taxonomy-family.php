<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$currentTermID = get_queried_object()->term_id;
$parentID = get_term_top_most_parent($currentTermID, 'family');

$icon = get_field('icon', 'family_'.$parentID);
$image = get_field('image', 'family_'.$parentID);
$description = get_field('description', 'family_'.$parentID);
$short_description = get_field('short_description', 'family_'.$parentID);
$large_description = get_field('large_description', 'family_'.$currentTermID);
$color = get_field('color', 'family_'.$parentID);

if(empty($icon)){
    $icon = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
}
if(empty($color)){
	$color = "#2581C4";
}

$hasImage = false;
if(!empty($image)){
    $hasImage = true;
}

?>


	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>


			<main id="main" class="site-main">
				<div class="entry-content clear" itemprop="text">
				<div id="family-main-header" class="wp-block-group alignfull has-background" style="background: <?php echo $color; ?>">
					<?php if(!empty($icon)){ ?>
					<div id="family-main-header-bg" style="">
					</div>
					<style type="text/css">

						@media (min-width: 782px) {
							#family-main-header-bg{
								background-image: linear-gradient(90deg, <?php echo $color; ?> 65%, rgba(255,255,255,0) 80%), url(<?php echo $image; ?>);
							}
						}
						@media (max-width: 781px) {
							#family-main-header-bg{
								background-image: url(<?php echo $image; ?>);
								opacity: 0.5;
    							background-size: cover;
							}
						}
					</style>
					<?php } ?>
				    <div class="wp-block-group__inner-container">
				        <div class="wp-block-columns">
				            <div id="family-main-header-icon" class="wp-block-column" style="flex-basis:20%">
				                <figure class="wp-block-image size-full">

									<img src="<?php echo $icon; ?>" />

				                </figure>
				            </div>
				            <div id="family-main-header-info" class="wp-block-column" style="flex-basis:80%">
				            	<?php if(get_queried_object()->parent == 0){ ?>
				                <h1><?php echo strip_tags(term_description($parentID)); ?></h1>
				            	<?php }else{ ?>
				            	<h2><?php echo strip_tags(term_description($parentID)); ?></h2>
				            	<?php } ?>
				                <p><?php echo $short_description; ?></p>

				            </div>
				        </div>
				    </div>
				</div>

				<div id="family-container" class="wp-block-columns">
					<div id="family-left" class="wp-block-column" style="flex-basis:33.33%">
						<div id="menu-families">
							<?php echo get_family_tree('family',$parentID); ?>
						</div>
					</div>



					<div id="family-right" class="wp-block-column" style="flex-basis:66.66%">

		            	<?php if(get_queried_object()->parent != 0){ ?>
		            	<div id="family-header">
			                <h1><?php echo strip_tags(term_description($currentTermID)); ?></h1>
					        <p><?php echo get_field('description', "family_".$currentTermID); ?></p>
					    </div>
		            	<?php }else{ ?>
		            	<div id="family-header">
				                <p><?php echo $description; ?></p>
					    </div>
		            	<?php } ?>

   								<?php
   								$filtros = get_cat_filters($currentTermID);

   								if(!empty($filtros)){ ?>
		                        	<div id="products-filters-mobile">
		                        		<span class="products-filters-title-mobile"><?php _e("Filters","danosa"); ?></span>
						            	<div id="products-filters">
						                <div class="et_pb_text_inner">

											<?php

											?>

											<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
												<?php

												?>
												<input type="hidden" id="input_referencia_de_seccion" name="referencia_de_seccion[]" value="<?php echo $currentTermID; ?>" />


												<?php
												$countFilters = 0;
											    foreach ($filtros as $key => $value) {
													if($value['type'] != "submenu"){
											        ?>
													<div class="product-filter product-filter-<?php echo $key; ?>" >
														<h4 class="familia <?php if(strlen($value['name'])> 20){ echo "len20";}elseif(strlen($value['name'])> 15){echo "len15";}elseif(strlen($value['name'])> 10){echo "len10";}?>"><?php echo $value['name']; ?></h4>
														<div class="product-filter-dropdown">
															<div class="childs">
															</div>
															<span><?php _e("CLOSE","danosa"); ?></span>
														</div>
													</div>
											        <?php
													}
													$countFilters++;
											    }

											    ?>

												<input type="hidden" name="action" id="input_filtrar_productos" value="filtrar_productos">
											</form>

											<script type="text/javascript">
												jQuery(document).ready(function() {
												    cargarFiltros(<?php echo $currentTermID; ?>);
												});
											</script>

											<div id="query-debug"></div>


						                </div>
						            	</div>
									</div>
									<div id="profucts-filters-inline" style="display: none;"><a href="" id="reset-filter">Quitar filtros</a></div>
		            			<?php } ?>

						<div class="content-list-container">
						<?php
						if ( have_posts() ) :
							//do_action( 'astra_template_parts_content_top' );

							while ( have_posts() ) :
								the_post();

								get_template_part('loop','products');

							endwhile;
						//do_action( 'astra_template_parts_content_bottom' );
						else :
							do_action( 'astra_template_parts_content_none' );
						endif;
						?>
						</div>
						<?php astra_pagination(); ?>

						<?php if(!empty($large_description)){ ?>
		            	<div id="family-large-description">
				                <?php echo $large_description; ?>
					    </div>
						<?php } ?>
					</div>
				</div>
				</div>

			</main><!-- #main -->



		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>


<?php get_footer(); ?>
