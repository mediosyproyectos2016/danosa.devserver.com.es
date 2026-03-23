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

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>
		<section class="ast-archive-description fade-top">
			<h1 class="page-title ast-archive-title"><span>Preguntas frecuentes</span> <?php echo single_term_title(); ?></h1>
			<?php echo  term_description(); ?>
		</section>

			<main id="main" class="site-main">

				<ul id="faq-menu" class="tabs  fade-top">
				    <?php
				    $terms = get_terms([
				        'taxonomy' => "faq_cat",
				        'hide_empty' => false,
				    ]);

				    foreach ($terms as $key => $term) {

				        ?>
				        <li <?php if(get_queried_object()->term_id == $term->term_id){ echo 'class="active"'; } ?> ><a href="<?php echo get_term_link($term,"faq_cat"); ?>"><?php echo $term->name; ?></a></li>
				        <?php
				    }
				    ?>
				</ul>     
  				<div class="accordion">
				<?php 
				if ( have_posts() ) :
					//do_action( 'astra_template_parts_content_top' );

					while ( have_posts() ) :
						the_post();

						?>
					    <div class="option">
					      <input type="checkbox" id="toggle-<?php the_ID(); ?>" class="accordion-toggle" />
					      <label class="accordion-title" for="toggle-<?php the_ID(); ?>">
					        <?php the_title(); ?>
					      </label>
					      <div class="accordion-content">
					        <?php the_content(); ?>
					        <div class="wp-block-button"><a href="<?php the_permalink(); ?>" class="wp-block-button__link"><?php _e("More information","danosa"); ?></a></div>
					      </div>
					    </div>						
						<?php
						endwhile;
					//do_action( 'astra_template_parts_content_bottom' );
					else :
						do_action( 'astra_template_parts_content_none' );
					endif; 
					?>
  					</div>
			</main><!-- #main -->


		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>


<?php get_footer(); ?>
