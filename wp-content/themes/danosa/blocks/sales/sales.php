<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'sales-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sales fade-top';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$city = get_field('city');
$name = get_field('name');
$phone = get_field('phone');
$photo = get_field('photo');
$email = get_field('email');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

		<div>
	        <h4 class="sales-city"><?php echo $city; ?></h4>
	        <?php if(!empty($photo)){ ?>
	        	<img class="sales-photo" src="<?php echo $photo; ?>" alt="<?php echo $name; ?>" />
	    	<?php }else{
				$words = explode(" ", $name);
				$acronym = "";

				foreach ($words as $w) {
					if($w != "D." && $w != "Dª" && $w != "Mr." && $w != "el" && $w != "de"){
				  		$acronym .= $w[0];
				  	}
				}	  
				?>

	        	<div class="sales-photo" alt="<?php echo $name; ?>"><?php echo $acronym; ?></div>
	    	<?php } ?>

	        <span class="sales-name"><?php echo $name; ?></span>

	        <?php if(!empty($phone)){ ?>
	        <span class="sales-phone">Tel: <span><?php echo $phone; ?></span></span>
	    	<?php } ?>


	        <?php if(!empty($email)){ ?>
	        <span class="sales-email">Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
	        <?php } ?>
	    </div>



</div>