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
				<div id="family-main-header" class="wp-block-group alignfull has-background breakout" style="background: #090909; padding: 60px 0;">
				    <div class="wp-block-group__inner-container">
				        <!-- Enlace de retorno -->
				        <p class="has-ast-global-color-4-color" style="margin-bottom: 25px;">
				            <a href="<?php echo site_url('/soluciones-acusticas/'); ?>" style="text-decoration: none; color: inherit;">&lt;- Volver a soluciones acústicas</a>
				        </p>

				        <!-- Etiqueta superior -->
				        <p class="has-luminous-vivid-orange-color" style="font-size: 14px; margin-bottom: 15px; letter-spacing: 1px;"><strong>GAMA PREMIUM</strong></p>

				        <!-- Logo de Marca -->
				        <figure class="wp-block-image size-full" style="margin-bottom: 30px;">
				            <img fetchpriority="high" decoding="async" width="415" height="136" src="https://danosa.devserver.com.es/wp-content/uploads/2026/03/audal.jpg" alt="" class="wp-image-286" style="max-width: 350px; height: auto;">
				        </figure>

				        <!-- Descripción Audal -->
				        <div class="wp-block-group is-content-justification-left is-layout-constrained">
				            <p class="has-ast-global-color-4-color" style="font-size: 18px; line-height: 1.6; max-width: 850px;">Audal™ te ofrece una gama avanzada de productos y sistemas que crean espacios perfectamente insonorizados, donde el ruido no deseado no puede entrar y el sonido no puede escapar.</p>
				        </div>
				    </div>
				</div>

				<style type="text/css">
					/* Estructura Full-Width */
					.ast-plain-container .site-content .ast-container {
						max-width: 100% !important;
						padding: 0 !important;
					}
					#primary {
						width: 100% !important;
						padding: 0 !important;
						margin: 0 !important;
					}
					.breakout {
						width: 100vw !important;
						position: relative;
						left: 50%;
						right: 50%;
						margin-left: -50vw !important;
						margin-right: -50vw !important;
					}
					#family-main-header .wp-block-group__inner-container {
						max-width: 1240px;
						margin: 0 auto;
						padding: 0 20px;
					}

					/* Layout de Columnas 30/70 Forzado */
					#family-container {
						display: flex !important;
						flex-direction: row !important;
						flex-wrap: nowrap !important;
						max-width: 1240px;
						margin: 60px auto !important;
						padding: 0 20px !important;
					}
					#family-left {
						flex: 0 0 30% !important;
						width: 30% !important;
						max-width: 30% !important;
						padding-right: 50px !important;
						box-sizing: border-box !important;
					}
					#family-right {
						flex: 0 0 70% !important;
						width: 70% !important;
						max-width: 70% !important;
						box-sizing: border-box !important;
					}

					@media (max-width: 921px) {
						#family-container {
							flex-wrap: wrap !important;
						}
						#family-left, #family-right {
							flex: 0 0 100% !important;
							width: 100% !important;
							max-width: 100% !important;
							padding-right: 0 !important;
						}
						#family-left {
							margin-bottom: 40px !important;
						}
					}

					/* Estilos Barra Lateral */
					#menu-families p strong {
						letter-spacing: 1px;
						font-weight: 700;
						color: #333;
					}
					#menu-families ul {
						list-style: none;
						margin-left: 0;
						padding-left: 0;
						border-top: 1px solid #eee;
					}
					#menu-families ul li {
						padding: 12px 0;
						border-bottom: 1px solid #eee;
					}
					#menu-families ul li a {
						color: #666;
						font-size: 15px;
						text-decoration: none;
						transition: all 0.3s ease;
						display: block;
					}
					#menu-families ul li a:hover, #menu-families ul li a.active {
						color: #2581C4;
						font-weight: 600;
						padding-left: 5px;
					}
				</style>
				<div id="family-container">
					<div id="family-left">
						<div id="menu-families">
							<p style="margin: 0; padding: 0 0 15px 0; font-size: 16px;"><strong>CATEGORÍAS</strong></p>
							<?php echo get_family_tree('family',$parentID); ?>
						</div>
					</div>

					<div id="family-right">

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
