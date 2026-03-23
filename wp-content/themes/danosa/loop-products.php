<?php
$image_list = get_field('image_list');
$noImage = false;
if(empty($image_list)){
    $image_list = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
    $noImage = true;
}
?>
<div class="wp-block-column content-list fade-top">
    <a href="<?php the_permalink(); ?>">
        <figure class="wp-block-image size-large content-list-image <?php if($noImage){ echo "no-image"; } ?>">
            <img width="180" height="122" src="<?php echo $image_list; ?>" class="attachment-danosa-content-list size-danosa-content-list wp-post-image" alt="" loading="lazy">
        </figure>
    </a>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
            <?php
            $productName = get_field("product_name",$parentId);
            if(empty($productName)){
                $productName = get_the_title($parentId);
            }
            ?>
            <h2><a href="<?php the_permalink(); ?>"><?php echo $productName; ?></a></h2>
            <p><?php the_excerpt(); ?></p>
        </div>
    </div>
    <div class="wp-block-columns">
        <div class="wp-block-column">
            <a href="<?php the_permalink(); ?>"><?php _e("View product","danosa"); ?> <i class="danosa-arrow-go"></i></a>
        </div>
    </div>
</div>