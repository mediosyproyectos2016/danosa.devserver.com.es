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

		<?php astra_primary_content_top(); ?>
		<?php

		$location = get_field("location");


		if(!empty($location)){
			echo $location;
		}
		?>
		<h1><?php the_title(); ?></h1>

		<?php getShareon(); ?>

		<?php the_content(); ?>



		<div class="wp-block-button"><a href="<?php the_permalink(); ?>" class="wp-block-button__link"><?php _e("Contact us","danosa"); ?></a></div>


	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
