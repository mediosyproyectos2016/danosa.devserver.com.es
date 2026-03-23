<?php

$image = get_field('image', $product);
$description = get_field('description', $product);

$color = "#F5F5F5";
if(empty($image)){
    $image = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
}
?>

<div class="wp-block-column content-list fade-top">
    <a href="<?php echo get_term_link($product->term_id); ?>">
    <figure class="wp-block-image size-large content-list-image" style="background-color: <?php echo $color; ?>">
        <img loading="lazy" src="<?php echo $image; ?>" alt="<?php echo $product->description; ?>"></figure>
    </figure>
    </a>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
                <h2><?php echo $product->name; ?></h2>
                <p><?php echo $description; ?></p>
        </div>
    </div>
    <div class="wp-block-columns">
        <div class="wp-block-column" style="flex-basis:50%">
            <a href="<?php echo get_term_link($product->term_id); ?>"><?php _e("View","danosa"); ?> <i class="danosa-arrow-go"></i></a>
        </div>
    </div>
</div>