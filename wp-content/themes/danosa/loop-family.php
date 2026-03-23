<?php

$imageMenu = get_field('image_menu', $product);
$icon = get_field('icon', $product);
$description = get_field('short_description', $product);
$color = get_field('color', $product);
$color = "#f5f5f5";
if(empty($icon)){
    $icon = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
}
?>

<div class="wp-block-column content-list fade-top">
    <a href="<?php echo get_term_link($product->term_id); ?>">
    <figure class="wp-block-image size-large content-list-image">
        <img loading="lazy" src="<?php echo $imageMenu; ?>" alt="<?php echo $product->description; ?>"></figure>
    </figure>
    </a>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
                <h2><?php echo $product->description; ?></h2>
                <p><?php echo $description; ?></p>
        </div>
    </div>
    <div class="wp-block-columns">
        <div class="wp-block-column" style="flex-basis:50%">
            <a href="<?php echo get_term_link($product->term_id); ?>"><?php _e("View products","danosa"); ?> <i class="danosa-arrow-go"></i></a>
        </div>
    </div>
</div>