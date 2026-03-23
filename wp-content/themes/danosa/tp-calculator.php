<?php
/*
Template Name: Danosa - Calculator
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


$is_post = false;

if ( isset( $_REQUEST['nonce']) &&  wp_verify_nonce(  $_REQUEST['nonce'], 'danosa-calculator' ) ) {
	if(isset( $_REQUEST['calcular']) ){
		$is_post = true;
	}
	
}

?>
<style>
<?php include __DIR__."/online_project/energy-saving-calculator/energy-saving-calculator.css";?>
</style>
	<div id="primary" <?php astra_primary_class(); ?>>



        <div class="entry-content clear" itemprop="text">


            <div id="systems-header" class="section-header alignfull">
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

<?php
if(!$is_post){
	echo '<div id="energy-saving-calculator-request" class="wp-block-group test">';
	include __DIR__."/online_project/energy-saving-calculator/calculator-request.php";
	echo '</div>';
}else{
	echo '<div id="energy-saving-calculator-result" class="wp-block-group">';
	include __DIR__."/online_project/energy-saving-calculator/calculator-result.php";
	echo '</div>';
}
?>




        </div>


	</div><!-- #primary -->

<?php


get_footer(); ?>
