<?php

if(!empty($childId)){

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
	<div class="wp-block-columns">
	    <div class="wp-block-column">
	    	<h3><?php _e("Presentation","danosa"); ?></h3>
	    	<?php echo $presentation; ?>
	    </div>
	    <div class="wp-block-column">
	    	<img src="<?php echo $image; ?>" alt="<?php echo get_the_title($post->ID); ?>">
	    </div>
	</div>
	<?php
	if(!empty($image_dimensions)){
	?>
	<div class="product-data image-dimensions">
	    <img src="<?php echo $image_dimensions; ?>" alt="<?php echo get_the_title($post->ID); ?>">
	</div>
	<?php
	}

	if(!empty($technical_data)){
	?>
	<div class="product-data technical-data">
		<h3><?php _e("Technical Data","danosa"); ?></h3>
		<?php echo comprobarTabla($technical_data); ?>
	</div>
	<?php
	}

	if(!empty($technical_data_dome) && strpos($technical_data_dome, '<tbody></tbody>') == false){
	?>
	<div class="product-data technical-data-dome">
		<h3><?php _e("Technical Data","danosa"); ?> - <?php _e("Dome","danosa"); ?></h3>
		<?php echo comprobarTabla($technical_data_dome); ?>
	</div>
	<?php
	}

	if(!empty($technical_data_plinth) && strpos($technical_data_plinth, '<tbody></tbody>') == false){
	?>
	<div class="product-data technical-data-plinth">
		<h3><?php _e("Technical Data","danosa"); ?> - <?php _e("Plinth","danosa"); ?></h3>
		<?php echo comprobarTabla($technical_data_plinth); ?>
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
			echo formatTable($dta_table);
		}
		?>
	</div>
	<?php
	}

	if(!empty($additional_technical_data) && strpos($additional_technical_data, '<tbody></tbody>') == false){
	?>
	<div class="product-data additional-technical-data">
		<h3><?php _e("Addtitional Technical Data","danosa"); ?></h3>
		<?php echo comprobarTabla($additional_technical_data); ?>
	</div>
	<?php
	}

	if(!empty($application_data) && strpos($application_data, '<tbody></tbody>') == false){
	?>
	<div class="product-data application-data">
		<h3><?php _e("Application Data","danosa"); ?></h3>
		<?php echo comprobarTabla($application_data); ?>
	</div>
	<?php
	}

}

$campos = array(
'product_standards_certification' => array('name' => __('Standards and Certification', "danosa"), 'origin' => 'term'), //memoria descriptiva
);

load_product_fields($campos,$parentId);



	if(!empty($normative_table) && strpos($normative_table, '<tbody></tbody>') == false){
	?>
	<div class="product-data normative-table">
		<?php echo formatTable($normative_table); ?>
	</div>
	<?php
	}
	if(!empty($notes_normative_table)){
	?>
	<div class="product-data notes-normative-table">
		<?php echo nl2br($notes_normative_table); ?>
	</div>
	<?php
	}



if(!empty($childId)){
	if(!empty($environmental_information) && strpos($environmental_information, ": %") === false && strpos($environmental_information, '<tbody></tbody>') == false){
	?>
	<div class="product-data environmental-information">
		<h3><?php _e("Environmental Information","danosa"); ?></h3>
		<?php echo nl2br($environmental_information); ?>
	</div>
	<?php
	}

}
