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
$id = 'delegation-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'delegation fade-top';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$city = get_field('city');
$address = get_field('address');
$phone = get_field('phone');
$fax = get_field('fax');
$email = get_field('email');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

		<div>
	        <h4 class="delegation-city"><?php echo $city; ?></h4>
	        <span class="delegation-address"><?php echo $address; ?></span>

	        <?php if(!empty($phone)){ ?>
	        <span class="delegation-phone">Tel: <span><?php echo $phone; ?></span></span>
	    	<?php } ?>
	        <?php if(!empty($fax)){ ?>
	        <span class="delegation-fax">Fax: <span><?php echo $fax; ?></span></span>
	    	<?php } ?>

	        <?php if(!empty($email)){ ?>
	        <span class="delegation-email">Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
	        <?php } ?>
	    </div>


        <?php if(!empty($address)){ ?>
		<div class="wp-block-button"><a href="https://www.google.com/maps/search/?api=1&query=Danosa <?php echo $address; ?>" target="_blank" class="wp-block-button__map"><?php _e("Locate on the map","danosa"); ?></a></div>
        <?php } ?>


</div>