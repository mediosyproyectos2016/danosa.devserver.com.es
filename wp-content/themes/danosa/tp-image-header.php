<?php
/*
Template Name: Danosa - With Header
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

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

        <div class="entry-content clear" itemprop="text">
		<div id="page-header" class="section-header alignfull">
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
		</div>

		<?php astra_content_page_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
