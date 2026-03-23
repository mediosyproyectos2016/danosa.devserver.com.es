<?php

$image = get_field('image', $product);
$icon = get_field('icon', $product);
$description = get_field('description', $product);
$color = get_field('color', $product);
$color = "#f5f5f5";
if(empty($icon)){
    $icon = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
}

if(empty($taxonomy)){
    $taxonomy = "system_cat";
}
if(empty($hreflang_ref)){
    $hreflang_ref = "";
}

 $subsystems = get_terms( $taxonomy, array(
    'hide_empty' => true,
    'parent' => $product->term_id,

    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [[
        'key' => 'order',
        'type' => 'NUMERIC',
    ]],
) );

//echo get_child_levels($product, $taxonomy);



?>

<div id="<?php echo sanitize_title($product->description); ?>" class="wp-block-column content-list fade-top">
    <a href="<?php echo get_term_link($product); ?>">
    <figure class="wp-block-image size-large content-list-image">
        <img loading="lazy" src="<?php echo $image; ?>" alt="<?php echo $product->description; ?>"></figure>
    </figure>
    </a>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
                <h2><?php echo $product->description; ?></h2>
                <p><?php echo $description; ?></p>


                <?php

                echo '<ul class="subsystems">';

                foreach ($subsystems as $key2 => $subsystem) {
                    ?>
                    <li>
                        <a href="<?php echo get_term_link($subsystem); ?>"><span><?php echo $subsystem->description; ?></span><i class="danosa-arrow-go"></i></a>
                        <?php //get_system_list($taxonomy, $subsystem->term_id, $hreflang_ref); ?>
                    </li>
                    <?php
                }
                echo '</ul>';




                ?>

        </div>
    </div>
</div>