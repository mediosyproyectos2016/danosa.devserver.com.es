<?php
add_shortcode( 'danosa_banner', 'danosa_banner_function' );

function danosa_banner_function($atts, $content, $tag) {

    $banner_image = get_field("banner_image","option");
    $banner_text = get_field("banner_text","option");
    $banner_icon = get_field("banner_icon","option");
    $banner_link = get_field("banner_link","option");

    ob_start();

    if(!empty($banner_image)){
    ?>
    <div class="wp-block-cover" id="banner">
        <a href="<?php echo $banner_link; ?>"><img loading="lazy" width="1120" height="440" class="wp-block-cover__image-background wp-image-3348" alt="<?php echo $banner_text; ?>" src="<?php echo $banner_image; ?>"></a>
        <div class="">
            <p class="has-text-align-center has-large-font-size"><?php echo $banner_text; ?></p>
            <?php if(!empty($banner_icon)){ ?><img src="<?php echo $banner_icon; ?>" /><?php } ?>
        </div>
    </div>
    <?php } ?>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}