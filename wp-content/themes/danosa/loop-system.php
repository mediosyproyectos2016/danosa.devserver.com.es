<?php
$image_list = get_field('image_list');
$noImage = false;
if(empty($image_list)){
    $image_list = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
    $noImage = true;
}

if($noFade){
    $class = "";
}else{
    $class = "fade-top";
}
?>
<div class="wp-block-column content-list <?php echo $class; ?>">
    <a href="<?php the_permalink(); ?>">
        <figure class="wp-block-image size-large content-list-image <?php if($noImage){ echo "no-image"; } ?>">
            <img width="180" height="122" src="<?php echo $image_list; ?>" class="attachment-danosa-content-list size-danosa-content-list wp-post-image" alt="" loading="lazy">
        </figure>

        <div class="system-icons">

                <?php
                $main_products = get_field("main_products");
                if(!empty($main_products)){

                    $main_products = explode(",", $main_products);

                    $main_products = array_map("sanitize_title", $main_products);

                    $args = array(
                        'post_type'       => 'product',
                        'post_name__in'        => $main_products,
                        'post_parent' => 0,
                    );


                    // The Loop
                    $icons = array();
                    $syistemID = get_the_ID();


                    $icon_text = explode(",",get_field("icon_text"));
                    $icon_url = explode(",",get_field("icon_url"));

                    foreach ($icon_text as $key => $value) {
                        $icons[$value] = $icon_url[$key];
                    }

                    $iconsTemp = wp_get_post_terms( $syistemID, 'system_icon', array( 'fields' => 'all' ) );

                    if(!empty($iconsTemp)){
                        foreach ($iconsTemp as $key => $value) {
                            $icons[$value->description] = get_field("icon",$value);
                        }
                    }
                    /*
                    $the_query = new WP_Query( $args );

                    if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();


                            $familyTemp = wp_get_post_terms( $syistemID, 'family', array( 'fields' => 'all' ) );
                            //obtenemos la categoría principal a la que pertenece
                            if(!empty($familyTemp)){
                                $family_id = get_term_top_most_parent($familyTemp[0]->term_id,"family");
                                $family = get_term( $family_id, "family" );
                                $familyName = $family->description;
                                $icons[$familyName] =  get_field('icon', $family);
                            }else{
                                $familyName = "";
                            }

                            ?>
                            <?php
                        }


                    }

                    wp_reset_postdata();
                    */
                }
                ?>

            <?php


                if(!empty($icons)){
                    foreach ($icons as $key => $value) {
                        ?>
                        <img src="<?php echo $value; ?>" alt="<?php echo $key; ?>" title="<?php echo $key; ?>" />
                        <?php
                    }
                }
            ?>
        </div>
    </a>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">


            <h5><?php the_title(); ?></h5>
            <h3><a href="<?php the_permalink(); ?>"><?php echo strip_tags(get_the_content()); ?></a></h3>
        </div>
    </div>
    <?php if(1==2){ ?>
    <div class="wp-block-columns">
        <div class="wp-block-column">
            <a href="<?php the_permalink(); ?>"><?php _e("View product","danosa"); ?> <i class="danosa-arrow-go"></i></a>
        </div>
    </div>
    <?php } ?>
</div>