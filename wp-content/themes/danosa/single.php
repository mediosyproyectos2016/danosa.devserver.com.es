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

							<?php astra_entry_top(); ?>

							<div <?php astra_blog_layout_class( 'single-layout-1' ); ?>>

								<?php astra_single_header_before(); ?>

								<header class="entry-header <?php astra_entry_header_class(); ?>">

									<?php astra_single_header_top(); ?>

										<header class="entry-header ">
										    <div class="ast-single-post-order">
										    	<span class="posted-on"><span class="published" itemprop="datePublished"> <?php the_date(); ?></span>
										        <?php astra_get_single_post_title_meta(); ?>
										    </div>

										    <div class="post-thumb-img-content post-thumb"><?php the_post_thumbnail( 'post-thumbnail'); ?></div>

										</header>
									<?php astra_single_header_bottom(); ?>

								</header><!-- .entry-header -->

								<?php astra_single_header_after(); ?>

								<div class="entry-content clear"
								<?php
											echo astra_attr(
												'article-entry-content-single-layout',
												array(
													'class' => '',
												)
											);
											?>
								>

									<?php astra_entry_content_before(); ?>

									<?php the_content(); ?>

									<?php
										astra_edit_post_link(
											sprintf(
												/* translators: %s: Name of current post */
												esc_html__( 'Edit %s', 'astra' ),
												the_title( '<span class="screen-reader-text">"', '"</span>', false )
											),
											'<span class="edit-link">',
											'</span>'
										);
										?>

									<?php astra_entry_content_after(); ?>

									<?php
										wp_link_pages(
											array(
												'before'      => '<div class="page-links">' . esc_html( astra_default_strings( 'string-single-page-links-before', false ) ),
												'after'       => '</div>',
												'link_before' => '<span class="page-link">',
												'link_after'  => '</span>',
											)
										);
										?>
								</div><!-- .entry-content .clear -->
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



<?php get_footer(); ?>
