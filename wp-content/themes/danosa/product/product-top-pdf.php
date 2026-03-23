<table id="product-top">
	<tr>
		<td>
			<?php
			$productName = get_field("product_name",$parentId);
			if(empty($productName)){
				$productName = get_the_title($parentId);
			}
			?>
	        <h1 style="margin-bottom: 30px; font-size: 20px"><?php echo $productName; ?></h1>
	        <br>
	        <?php echo get_the_excerpt(null,false,$parentId); ?>


			<?php
			$args = array(
			    'post_type'      => 'product',
			    'posts_per_page' => -1,
			    'post_parent'    => $parentId,
			    'order'          => 'ASC',
			    'orderby'        => 'menu_order'
			 );



			$parent = new WP_Query( $args );

			if ( $parent->have_posts() ) : ?>

				<?php


				$count = $parent->found_posts;
				if($count > 1){



					$displayMode = get_field("display_mode",$parentId);
					//si es Mortero
					if($displayMode === "Tabla"){
					    $tabla = array();
					    while ( $parent->have_posts() ) : $parent->the_post();

					    	$color = get_field("color");
					    	$color_hex = get_field("color_hex");
					    	$weight = get_field("weight");
					    	$kgorl = "Kg";

					    	if(empty($weight)){
					    		$weight = get_field("volume");
					    		$kgorl = "L";
					    	}

				    		$weight = $weight."".$kgorl;

					    	$variant_reference = get_field("variant_reference");

					    	$tabla[$color]["color_hex"] = $color_hex;
					    	$tabla[$color]["weight"]["$weight"] = $variant_reference;

					    endwhile;
					} ?>
				<?php } ?>


			<?php endif; wp_reset_postdata(); ?>
		</td>
		<td>

	        <figure class="wp-block-image size-full">
	        	<img  src="<?php echo $image_sheet; ?>" alt="" style="max-width: 50%;">
	        </figure>
		</td>
		<td width="90">
	    	<?php if(!empty($familyIcon)){ ?>
	    		<img src="<?php echo $familyIcon; ?>" alt="<?php echo $familyDescription; ?>" title="<?php echo $familyDescription; ?>" style="max-width: 70px; margin: 20px 0;   background: #FFF;" />
	    	<?php } ?>
	    	<?php foreach ($certificationIcons as $key => $value) { ?>
    		<div>
	    		<img src="<?php echo $value; ?>" alt="<?php echo $key; ?>" title="<?php echo $key; ?>" style="max-width: 90px; margin: 20px 0;display: block;" /><br>
	    		<span style="display: block; font-size: 10px; "><?php echo $key; ?></span>
    		</div>
	    	<?php } ?>
		</td>
	</tr>
</table>


<?php
if($family === "W06" && !empty($tabla)){ ?>
	<h3 id="color-weight-info-title"><?php _e("Colors","danosa"); ?>:</h3>
	<div id="color-weight-info">
		<?php  foreach ($tabla as $color => $variante) {
			?>
			<div class="color-group">
				<div class="color-hex" style="background-color: <?php echo $variante["color_hex"]; ?>"></div>
				<div class="color-weight-references">
					<strong><?php echo $color; ?></strong><br>
					<?php foreach ($variante["weight"] as $peso => $referencia) { ?>
						<span><?php echo $peso; ?> - <?php echo $referencia; ?></span><br>
					<?php } ?>
				</div>
			</div>
			<?php
		} ?>
	</div>
	<div style="clear: both;">
<?php } ?>