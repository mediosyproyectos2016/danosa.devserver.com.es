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

if(isset($_GET["dop-pdf"])){
	if(isset($_GET["download"])){
		ob_start();
		include "single-product-dop-pdf.php";
		$pdf = ob_get_contents();
		ob_end_clean();		header("Content-type:application/pdf");
		header("Content-Disposition:attachment;filename='fichatecnica".$post->ID.".pdf'");		require_once __DIR__ . '/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($pdf);
		$mpdf->Output("Danosa DOP - ".get_the_title().".pdf", 'I');
	}else{
		include "single-product-dop-pdf.php";
	}
}elseif(isset($_GET["pdf"])){
	if(isset($_GET["download"])){
		ob_start();
		include "single-product-pdf.php";
		$pdf = ob_get_contents();
		ob_end_clean();		header("Content-type:application/pdf");
		header("Content-Disposition:attachment;filename='fichatecnica".$post->ID.".pdf'");		require_once __DIR__ . '/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($pdf);
		$mpdf->Output("Danosa - ".get_the_title().".pdf", 'I');
	}else{
		include "single-product-pdf.php";
	}
}else{

get_header(); ?>


	<div id="primary" <?php astra_primary_class(); ?>>

			<main id="main" class="site-main">
				<?php
				if ( have_posts() ) :
					do_action( 'astra_template_parts_content_top' );

					while ( have_posts() ) :
						the_post();

						if($post->post_parent == 0){
							$parentId = $post->ID;
						}else{
							$parentId = $post->post_parent;
							$childId = $post->ID;
						}

						$commercial_sheet = get_field('commercial_sheet',$parentId);
						$dop = get_field('dop',$parentId);
						$image_sheet = get_field('image');
						if(empty($image_sheet)){
							$image_sheet = get_field('image_sheet',$parentId);
						}

						$certifications = wp_get_post_terms( $parentId, "system_certification", array( 'fields' => 'all' ) );
						$product_safety_datasheet = wp_get_post_terms( $parentId, "product_safety_datasheet", array( 'fields' => 'all' ) );

						$currentId = get_the_ID();


						$certificationIcons = array();
						foreach ($certifications as $key => $certification) {
							$certificationIcons[$certification->name] = get_field("icon",$certification);
						}

						$certificationIcons = array_unique($certificationIcons);
						?>

						<article <?php echo astra_attr('article-single',array('id'    => 'post-' . get_the_id(),'class' => join( ' ', get_post_class() ),)); ?>>


							<div class="entry-content clear" itemprop="text">
							    <div class="wp-block-group alignfull has-background" id="product-header" style="background:linear-gradient(90deg,rgb(251,251,251) 0%,rgb(255,255,255) 100%)">
							        <div class="wp-block-group__inner-container">
											<?php require_once("product/product-top.php"); ?>
							        </div>
							    </div>
							    <div class="wp-block-group alignfull has-background" id="product-bar" style="background-color:#eef3f6">
							        <div class="wp-block-group__inner-container">
							            <div class="wp-block-buttons">
							                <div class="wp-block-button"><a target="_blank" class="wp-block-button__link download" href="<?php the_permalink(); ?>?pdf&download"><?php _e("Datasheet","danosa"); ?></a></div>
							                <?php if(!empty($commercial_sheet)){ ?>
							                <div class="wp-block-button"><a class="wp-block-button__link secondary download" href="<?php echo $commercial_sheet; ?>" target="_blank"><?php _e("Commercial Sheet","danosa"); ?></a></div>
							            	<?php } ?>
							                <?php if(!empty($dop) && filter_var($dop, FILTER_VALIDATE_URL)){ ?>
							                <div class="wp-block-button"><a class="wp-block-button__link secondary download" href="<?php echo $dop; ?>" target="_blank"><?php _e("Declaration of Performance","danosa"); ?> (DoP)</a></div>
							            	<?php } ?>
							            </div>

							            <?php getShareon(); ?>
							        </div>
							    </div>
							    <div id="product-content" class="wp-block-group">
							        <div class="wp-block-group__inner-container">

										<!-- Tabs -->
										<div id="product-tabs" class="danosa-tabs">
											<a href="#" class="tab active" data-toggle-target=".tab-content-1"><?php _e('Description', "danosa"); ?></a>
											<a href="#" class="tab" data-toggle-target="#product-datasheet"><?php _e('Technical features and measures', "danosa"); ?></a>
											<?php if(!empty($certifications) || !empty($product_safety_datasheet)){ ?>
												<a href="#" class="tab" data-toggle-target=".tab-content-3"><?php _e('Related documentation', "danosa"); ?></a>
											<?php } ?>
										</div>
										<!-- Content -->
										<div id="product-description" class="tab-content tab-content-1 active">
											<?php require_once("product/product-description.php"); ?>
										</div>

										<div id="product-datasheet" class="tab-content tab-content-2">
											<?php require_once("product/product-datasheet.php"); ?>
										</div>

										<?php if(!empty($certifications) || !empty($product_safety_datasheet)){ ?>
										<div id="product-downloads" class="tab-content tab-content-3">
											<?php require_once("product/product-downloads.php"); ?>
										</div>
										<?php } ?>


							        </div>
							    </div>


							    <div id="product-related-systems" class="wp-block-group alignfull">
											<?php require_once("product/product-related-systems.php"); ?>
								</div>

							    <?php echo do_shortcode("[danosa_banner]"); ?>

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
}
?>
