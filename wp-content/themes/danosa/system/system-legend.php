
<div class="wp-block-group__inner-container">
    <?php
    $numbered_image = get_field("numbered_image");
    if(!empty($numbered_image)){
    ?>
    <img src="<?php echo $numbered_image; ?>" loading="lazy" alt="<?php the_title($post->ID); ?>" />
    <?php }


    function formatLegend($content, $firstHead = true){

        $content = str_replace("[[","",$content);
        $content = str_replace("]]","",$content);

        $content = explode("],[", $content);

        $a = 0;
        $tempLegend = array();

        //convertimos la tabla en array
        foreach ($content as $key => $value) {
            $row = explode(",", $value);

            if($firstHead == true && $a != 0){
                $b = 0;
                foreach ($row as $key2 => $cell) {
                        if($b == 0){ //zona
                            $zone = substr($cell, 1, -1);
                        }

                        if($b == 1){ //numero
                            $number = substr($cell, 1, -1);
                        }
                        if($b == 2){ //referencia producto
                            if(!empty($cell) && $cell != "null"){
                                $tempLegend[$zone][$number]["reference"] = substr($cell, 1, -1);
                            }
                        }
                        if($b == 3){ //texto
                            $tempLegend[$zone][$number]["text"] = substr($cell, 1, -1);
                        }


                        $b++;
                }
            }

            $a++;
        }




        $output = '<div id="legend">';
        //procesamos el array
        foreach ($tempLegend as $zone => $product) {


            $output .= "<div><h4>".$zone."</h4><ul>";

            foreach ($product as $number => $value) {

                if(!empty($value["reference"])){
                    $productTemp = get_page_by_title($value["reference"], OBJECT, 'product');


                    $color = "#000";

                    if(!empty($productTemp)){
                        if($productTemp->post_parent != 0){
                            $productID = $productTemp->post_parent;
                        }else{
                            $productID = $productTemp->ID;
                        }

                        $familyTemp = wp_get_post_terms( $productID, 'family', array( 'fields' => 'all' ) );
                        //obtenemos la categoría principal a la que pertenece
                        if(!empty($familyTemp)){
                            $family_id = get_term_top_most_parent($familyTemp[0]->term_id,"family");
                            $family = get_term( $family_id, "family" );
                            $color = get_field('color', $family);
                        }else{
                            $color = "#000";
                        }
                        //si tiene referencia y hemos encontrado el producto
                        $output .= "<li><span class='legend-number' style='color: #FFF; background-color: ".$color."; border-color: ".$color."'>".$number."</span> <a href='".get_the_permalink($productID)."'>".$value["text"]."</a></li>";
                    }else{
                        //si tiene referencia pero no hemos encontrado el producto
                        $output .= "<li><span class='legend-number' style='color: #FFF; background-color: ".$color."; border-color: ".$color."'>".$number."</span> <span>".$value["text"]."</span></li>";

                    }
                }else{
                    //si no tiene ninguna referencia
                    $output .= "<li><span class='legend-number' style=''>".$number."</span> <span>".$value["text"]."</span></li>";
                }


            }

            $output .= "</ul></div>";
        }



        return $output."</div>";
    }?>

    <?php
    $legend = get_field("legend");
    echo formatLegend($legend);

    ?>

</div>