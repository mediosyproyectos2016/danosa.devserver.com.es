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
$parentID = get_term_top_most_parent($currentTermID, 'cad_cat');
$large_description = get_field('large_description', get_queried_object());
?>


	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>


			<main id="main" class="site-main">
				<div class="entry-content clear" itemprop="text">
		<?php astra_primary_content_top(); ?>
		<section class="ast-archive-description fade-top">
			<h1 class="page-title ast-archive-title"><span><?php _e("CAD","danosa"); ?>:</span> <?php echo single_term_title(); ?></h1>
			<?php echo  term_description(); ?>
		</section>

				<div class="wp-block-columns">
					<div class="wp-block-column" style="flex-basis:20%">
						<div id="menu-families">
							<?php echo get_family_tree('cad_cat',$parentID,"name"); ?>
						</div>
					</div>



					<div class="wp-block-column" style="flex-basis:80%">

		            	<?php if(get_queried_object()->parent != 0){ ?>
		            	<div id="family-header">
					    </div>
		            	<?php } ?>

						<div class="cad-list-container">
						<?php
						if ( have_posts() ) :
							//do_action( 'astra_template_parts_content_top' );

							while ( have_posts() ) :
								the_post();

								get_template_part('loop','cad');

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
