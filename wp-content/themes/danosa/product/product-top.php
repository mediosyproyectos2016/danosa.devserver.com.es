<div id="product-top" class="wp-block-columns">
    <div id="product-title" class="wp-block-column">
		<?php
		$productName = get_field("product_name",$parentId);
		if(empty($productName)){
			$productName = get_the_title($parentId);
		}
		?>
        <h1><?php echo $productName ?></h1>
        <h2><?php echo get_the_excerpt($parentId); ?></h2>


		<?php
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
			  $childId = $parent->posts[0]->ID;
			}
		}

		if(empty($childId) && is_user_logged_in()){
			?><div class="debug">Este producto no tiene variantes</div><?php
		}

		if ( $parent->have_posts() ) : ?>

			<?php

			$familyTemp = wp_get_post_terms( $post->ID, 'family', array( 'fields' => 'all' ) );
			//obtenemos la categoría principal a la que pertenece
			if(!empty($familyTemp)){
				$family_id = get_term_top_most_parent($familyTemp[0]->term_id,"family");
				$family = get_term( $family_id, "family" );
				$familyIcon = get_field("icon",$family);
				$familyDescription = $family->description;
				$family = $family->name;
			}else{
				$family = 0;
			}

			//$count = $parent->found_posts;
			//if($count > 1){


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
						$tabla[$color][$weight]["variant_reference"] = $variant_reference;
						$tabla[$color][$weight]["child_id"] = get_the_ID();
				    endwhile;
				}else{ ?>
					<div id="product-variant-selector-container">
						<span class="product-variant-title"><?php _e("Product variations","danosa"); ?>:</span>
						<select id="product-variant-selector" name="variant">
					    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
					    	<option value="" ><?php _e("Select","danosa"); ?></option>

					    	<option value="<?php the_permalink(); ?>" data-id="<?php the_field("variant_reference"); ?>" data-name="<?php the_title(); ?>" <?php if($childId == get_the_ID()){ echo 'selected="selected"'; } ?>><?php the_field("variant_reference"); ?> - <?php the_title(); ?></option>
					    <?php endwhile; ?>
					    </select>
					</div>

				<?php } ?>
			<?php //} ?>


		<?php endif; wp_reset_postdata(); ?>


    </div>
    <div id="product-image" class="wp-block-column">
        <figure class="wp-block-image size-full">

        	<img loading="lazy" width="400" height="350" src="<?php echo $image_sheet; ?>" alt="">
        </figure>
    </div>
    <div id="product-certification-icons" class="wp-block-column">
    	<?php if(!empty($familyIcon)){ ?>
    		<img src="<?php echo $familyIcon; ?>" alt="<?php echo $familyDescription; ?>" title="<?php echo $familyDescription; ?>" style="max-width: 70px;" />
    	<?php } ?>
    	<?php foreach ($certificationIcons as $key => $value) {
    		if(!empty($value)){
    		?>
    		<div>
	    		<img src="<?php echo $value; ?>" alt="<?php echo $key; ?>" title="<?php echo $key; ?>" />
	    		<span><?php echo $key; ?></span>
    		</div>
    	<?php
    		}
    	} ?>
    </div>
</div>

<?php
if($displayMode === "Tabla" && !empty($tabla)){ ?>
	<h3 id="color-weight-info-title"><?php _e("Colors","danosa"); ?>:</h3>
	<div id="color-weight-info">
		<?php
		$i == 0;
		$j == 0;
		foreach ($tabla as $color => $variantes) {
			$i++;
		?>
			<div class="color-group <?php if($i == 1){ echo "active"; } ?>">
				<div class="color-hex" style="background-color: <?php echo $variantes["color_hex"]; ?>"></div>
				<div class="color-weight-references">
					<strong><?php echo $color; ?></strong>
					<?php foreach ($variantes as $peso => $datos) {
                if ($peso !== "color_hex" && $peso !== "child_id") {
                    $j++;
                    $referencia = $datos["variant_reference"];
                    ?>
                    <span data-child-id="<?php echo $datos["child_id"]; ?>" data-color="<?php echo $color; ?>" data-peso="<?php echo $peso; ?>" data-ref="<?php echo $referencia; ?>" class="<?php if($i == 1 && $j == 1){ echo "active"; } ?>"><?php echo $peso; ?> - <?php echo $referencia; ?></span>
                <?php }
            } ?>
				</div>
			</div>
			<?php
		} ?>
	</div>
<?php } ?>