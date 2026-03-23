<?php
	function table_css($table){
		$table = comprobarTabla($table);
		$table = str_replace("<table>","<table style='width: 100%; text-align: left; border-spacing: 0;'>",$table);
		$table = str_replace("<table class=\"data-table\">","<table style='width: 100%; text-align: left; border-spacing: 0;'>",$table);
		$table = str_replace("<td>","<td style='border-bottom: 1px solid #E5E5E5; padding: 10px;'>",$table);
		$table = str_replace("<th>","<th style='border-bottom: 2px solid #B3DFFF; padding: 10px; text-align: left'>",$table);
		$table = str_replace("<pH","< pH",$table);


		return $table;
	}

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$fields = get_fields();

		if($post->post_parent == 0){
			$parentId = $post->ID;
		}else{
			$parentId = $post->post_parent;
			$childId = $post->ID;
		}

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => -1,
			'post_parent'    => $parentId,
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
		);

		$parent = new WP_Query( $args );

		if($post->post_parent == 0){
			if ($parent->have_posts()) {
				$childIds = wp_list_pluck( $parent->posts, 'ID' ); // Obtener todas las ID de los resultados

				// Comprobar si $_GET["childId"] está entre los resultados
				if (!empty($_GET["childId"]) && in_array($_GET["childId"], $childIds)) {
					$childId = $_GET["childId"];
				} else {
					$childId = $parent->posts[0]->ID;
				}
			}
		}

		wp_reset_postdata();

			//$commercial_sheet = get_field('commercial_sheet',$parentId);
			//$dop = get_field('dop',$parentId);
			$image_sheet = get_field('image');
			if(empty($image_sheet)){
				$image_sheet = get_field('image_sheet',$parentId);
			}
			$certifications = wp_get_post_terms( $parentId, "system_certification", array( 'fields' => 'all' ) );
			//$product_safety_datasheet = wp_get_post_terms( $parentId, "product_safety_datasheet", array( 'fields' => 'all' ) );
			$family = wp_get_post_terms( $parentId, "family", array( 'fields' => 'all' ) );


			$currentId = get_the_ID();


			$certificationIcons = array();
			foreach ($certifications as $key => $certification) {
				if(!empty(get_field("icon",$certification))){
					$certificationIcons[$certification->name] = get_field("icon",$certification);
				}
			}

			$certificationIcons = array_unique($certificationIcons);


				$familyTemp = wp_get_post_terms( $post->ID, 'family', array( 'fields' => 'all' ) );
				//obtenemos la categoría principal a la que pertenece
				if(!empty($familyTemp)){
					$family_id = get_term_top_most_parent($familyTemp[0]->term_id,"family");
					$family = get_term( $family_id, "family" );
					$familyIcon = get_field("icon_png",$family);
					$familyColor = get_field("color",$family);
					$familyDescription = $family->description;
					$family = $family->name;
				}else{
					$family = 0;
				}

?>

<html>
<body>
	<style type="text/css">
		body {
		    font-family: Open Sans, Arial, Helvetica, Verdana;
		    color: #666;
		}

		h1 {
		    color: #333;
		}

		h3 {
		    color: #0069b4;
		}

		table,
		div {
		    font-size: 14px;
		}

		#color-weight-info {
		    overflow: hidden;
		}

		.color-group {
		    line-height: 1.2em;
		    margin: 0 16px 12px 0;
		    padding: 10px;
		    float: left;
		    width: 150px;
		}

		.color-group .color-hex {
		    width: 30px;
		    height: 30px;
		    background: #545456;
		    border-radius: 6px;
		    margin-right: 10px;
		    float: left;
		}

		.color-weight-references {
		    padding-left: 45px;
		    font-size: 10px;
		    line-height: 12px;
		}
	</style>

	<table style="width:100%;" cellpadding="30px" cellspacing="0">
		<tr style="background-color:#0069b4;">
			<td style="padding:15px; text-align: center; width:40%; ">
				<img src="https://www.danosa.com/wp-content/themes/danosa/img/danosa-logo.svg">
			</td>
			<?php if(!empty($familyDescription)){ ?>
			<td style="font-weight:bold; font-size: 18px; background-color:<?php echo $familyColor; ?>; color:#fff; text-align: center;">
				<?php echo $familyDescription; ?>
			</td>
			<?php } ?>
		</tr>
	</table>

	<?php require_once("product/product-top-pdf.php"); ?>

	<div class="product-data">
	<?php echo get_the_content(null,false,$parentId); ?>
	</div>

	<?php


		$image = get_field("image",$childId);
		$image_dimensions = get_field("image_dimensions",$parentId);
		$technical_data = get_field("technical_data",$childId);
		$technical_data_dome = get_field("technical_data_dome",$childId);
		$technical_data_plinth = get_field("technical_data_plinth",$childId);
		$dta_text = get_field("dta_text",$childId);
		$dta_table = get_field("dta_table",$childId);
		$additional_technical_data = get_field("additional_technical_data",$childId);
		$application_data = get_field("application_data",$childId);
		$environmental_information = get_field("environmental_information",$childId);
		$normative_table = get_field("normative_table",$childId);
		$notes_normative_table = get_field("notes_normative_table",$childId);
		$presentation = get_field("presentation",$childId);

		?>

		<?php

		if(!empty($presentation)){ ?>
		<div class="product-data">
        	<h3><?php _e("Presentation","danosa"); ?></h3>
        	<?php echo table_css($presentation); ?>
        </div>
    	<?php } ?>

		<?php
		if(!empty($image_dimensions)){
		?>
		<div class="product-data">
		    <img src="<?php echo $image_dimensions; ?>" alt="<?php echo get_the_title($post->ID); ?>">
		</div>
		<?php
		}

		if(!empty($technical_data)){
		?>
		<div class="product-data">
			<h3><?php _e("Technical Data","danosa"); ?></h3>
			<?php echo table_css($technical_data); ?>
		</div>
		<?php
		}

		if(!empty($technical_data_dome) && strpos($technical_data_dome, '<tbody></tbody>') == false){
		?>
		<div class="product-data">
			<h3><?php _e("Technical Data","danosa"); ?> - <?php _e("Dome","danosa"); ?></h3>
			<?php echo table_css($technical_data_dome); ?>
		</div>
		<?php
		}

		if((!empty($dta_table) && strpos($dta_table, '<tbody></tbody>') == false) || !empty($dta_text)){
		?>
		<div class="product-data dta-text">
			<h3><?php _e("Addtitional Technical Data","danosa"); ?></h3>
			<?php
			if(!empty($dta_text)){
				echo $dta_text;
			}
			if(!empty($dta_table) && strpos($dta_table, '<tbody></tbody>') == false){
				echo table_css(formatTable($dta_table));
			}
			?>
		</div>
		<?php
		}

		if(!empty($technical_data_plinth) && strpos($technical_data_plinth, '<tbody></tbody>') == false){
		?>
		<div class="product-data">
			<h3><?php _e("Technical Data","danosa"); ?> - <?php _e("Plinth","danosa"); ?></h3>
			<?php echo table_css($technical_data_plinth); ?>
		</div>
		<?php
		}

		if(!empty($additional_technical_data) && strpos($additional_technical_data, '<tbody></tbody>') == false){
		?>
		<div class="product-data">
			<h3><?php _e("Addtitional Technical Data","danosa"); ?></h3>
			<?php echo table_css($additional_technical_data); ?>
		</div>
		<?php
		}

		if(!empty($application_data) && strpos($application_data, '<tbody></tbody>') == false){
		?>
		<div class="product-data">
			<h3><?php _e("Application Data","danosa"); ?></h3>
			<?php echo table_css($application_data); ?>
		</div>
		<?php
		}

		if(!empty($environmental_information) && strpos($environmental_information, ": %") === false && strpos($environmental_information, '<tbody></tbody>') == false){
		?>
		<div class="product-data environmental_information">
			<h3><?php _e("Environmental Information","danosa"); ?></h3>
			<?php echo table_css(nl2br($environmental_information)); ?>
		</div>
		<?php
		}

	$campos = array(
	    'product_standards_certification' => array('name' => __('Standards and Certification', "danosa"), 'origin' => 'term'), //memoria descriptiva
	);

	load_product_fields($campos,$parentId);

		if(!empty($normative_table) && strpos($normative_table, '<tbody></tbody>') == false){
		?>
		<div class="product-data">
			<?php echo table_css(formatTable($normative_table)); ?>
		</div>
		<?php
		}
		if(!empty($notes_normative_table)){
		?>
		<div class="product-data">
			<?php echo nl2br($notes_normative_table); ?>
		</div>
		<?php
		}

	?>
<?php require_once("product/product-description.php"); ?>

<div style="position: absolute; bottom: 10px"><?php _e("Document generated on ","danosa"); ?> <?php echo date("d/m/Y"); ?></div>
</body>
</html>
<?php
	endwhile;
endif;

?>