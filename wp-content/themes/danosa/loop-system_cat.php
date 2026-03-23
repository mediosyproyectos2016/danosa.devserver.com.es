<?php
if(empty($taxonomy)){
    $taxonomy = "system_cat";
}

$image = get_field('image', $product);

if(empty($image)){
    $image = get_field('image',$taxonomy."_".$product->parent);
}
$icon = get_field('icon', $product);
$description = get_field('description', $product);
$color = get_field('color', $product);
$color = "#f5f5f5";
if(empty($icon)){
    $icon = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
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

if(get_child_levels($product, $taxonomy) > 1 && !is_page()){
    ?>
    <div class="wp-block-group"><div class="wp-block-group__inner-container">
                <h1><?php echo $product->description; ?></h1>
    </div></div>
    <?php
    echo '<div class="content-list-container wp-block-columns">';

    foreach ($subsystems as $key2 => $subsystem) {

        $product = $subsystem;

        include("loop-system_cat.php");
    }

    echo '</div>';
}else{

?>

<div id="<?php echo sanitize_title($product->description); ?>" class="wp-block-column content-list fade-top">
    <?php if(getSiteCountry() != "gb"){ ?>
    <figure class="wp-block-image size-large content-list-image">
        <img loading="lazy" src="<?php echo $image; ?>" alt="<?php echo $product->description; ?>"></figure>
    </figure>
    <?php } ?>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
                <?php
                if (is_tax('system_cat')) {
                    echo "<h1>" . $product->description . "</h1>";
                } else {
                    echo "<h2>" . $product->description . "</h2>";
                }
                ?>
                <p><?php echo $description; ?></p>


                <?php

                if(get_child_levels($product, $taxonomy) == 1){
                    echo '<ul class="subsystems subsistems-'.$product->term_id.'">';

                    foreach ($subsystems as $key2 => $subsystem) {
                        ?>
                        <li class="subsystem-<?php echo $subsystem->term_id; ?>">
                            <a href="#" class="dropdown"><span><?php echo $subsystem->description; ?></span><i class="danosa-arrow-go"></i></a>
                            <?php get_system_list($taxonomy, $subsystem->term_id, $hreflang_ref); ?>
                        </li>
                        <?php
                    }

                    echo '</ul>';
                    ?>
                    <script type="text/javascript">
                        var visible = false;
                        jQuery( ".subsistems-<?php echo $product->term_id; ?> li" ).each(function( index ) {

                            if(jQuery(this).is(":visible")){
                                visible = true;
                            }
                        });

                        if(visible == false){
                            jQuery( ".subsistems-<?php echo $product->term_id; ?>" ).closest(".content-list").hide();
                        }


                    </script>
                    <?php
                }else{
                    echo '<div class="subsystems force">';
                        get_system_list($taxonomy, $product->term_id, $hreflang_ref);
                    echo '</div>';

                }


                ?>

        </div>
    </div>
</div>
<?php
}
?>