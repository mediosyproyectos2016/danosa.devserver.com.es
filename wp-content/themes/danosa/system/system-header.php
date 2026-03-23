
<div class="wp-block-group__inner-container">
    <div class="wp-block-columns">
        <div id="system-header-info" class="wp-block-column">
            <?php
            $title = explode("_",get_the_title($post->ID)); ?>
            <h2><?php echo end($title); ?></h2>
            <h1><?php echo get_the_content(null,false,$post->ID); ?></h1>

            <ul>
            <?php
            $waterproofing = get_field("waterproofing");
            $thermal_insulation = get_field("thermal_insulation");
            $acoustic_insulation = get_field("acoustic_insulation");
            $thermo_acoustic_insulation = get_field("thermo_acoustic_insulation");
            $finishing = get_field("finishing");
            $mortar = get_field("mortar");
            $support = get_field("support");
            $solar_structure = get_field("solar_structure");

            if(!empty($waterproofing)){
                echo "<li><strong>".__("Waterproofing","danosa")."</strong>: ".$waterproofing."</li>";
            }
            if(!empty($thermal_insulation)){
                echo "<li><strong>".__("Thermal Insulation","danosa")."</strong>: ".$thermal_insulation."</li>";
            }
            if(!empty($acoustic_insulation)){
                echo "<li><strong>".__("Acoustic Insulation","danosa")."</strong>: ".$acoustic_insulation."</li>";
            }
            if(!empty($thermo_acoustic_insulation)){
                echo "<li><strong>".__("Thermo-acoustic Insulation","danosa")."</strong>: ".$thermo_acoustic_insulation."</li>";
            }
            if(!empty($finishing)){
                echo "<li><strong>".__("Finishing","danosa")."</strong>: ".$finishing."</li>";
            }
            if(!empty($mortar)){
                echo "<li><strong>".__("Mortar","danosa")."</strong>: ".$mortar."</li>";
            }
            if(!empty($support)){
                echo "<li><strong>".__("Support","danosa")."</strong>: ".$support."</li>";
            }
            if(!empty($solar_structure)){
                echo "<li><strong>".__("Solar Structure","danosa")."</strong>: ".$solar_structure."</li>";
            }
            ?>
            </ul>


            <?php
            getShareon(); ?>
        </div>
        <div id="system-header-main-products" class="wp-block-column">

            <?php
            $main_products = get_field("main_products");
            if(!empty($main_products)){
                ?>
                <div id="system-main-products-list">
                <?php
                $main_products = explode(",", $main_products);

                $main_products = array_map("sanitize_title", $main_products);

                $args = array(
                    'post_type'       => 'product',
                    'post_name__in'        => $main_products,
                    'post_parent' => 0,
                );
                $the_query  = new WP_Query( $args );


                // The Loop


                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();


                        $familyTemp = wp_get_post_terms( $post->ID, 'family', array( 'fields' => 'all' ) );
                        //obtenemos la categoría principal a la que pertenece
                        if(!empty($familyTemp)){
                            $family_id = get_term_top_most_parent($familyTemp[0]->term_id,"family");
                            $family = get_term( $family_id, "family" );


                            $color = get_field('color', $family);
                            $familyName = $family->description;
                            //$icons[$familyName] =  get_field('icon', $family);
                        }else{
                            $color = "#0069b4";
                            $familyName = "";
                        }

                        ?>
                        <div class="system-main-products-list" style="background-color: <?php echo $color; ?>">
                            <a href="<?php the_permalink(); ?>"></a>
                            <?php if(!empty($familyName)){ ?><h4><?php echo $familyName; ?></h4><?php } ?>
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <?php
                    }

                    ?>
                <?php
                }
                ?>

                </div>
                <?php
                /* Restore original Post Data */
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</div>