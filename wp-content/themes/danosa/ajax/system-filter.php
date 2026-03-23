<?php

function system_filter_function(){


	$args = array(
		'post_type' => 'system', // we will sort posts by date
		'posts_per_page' => -1,
		'numberposts' => -1
	);

    $catfiltros = get_cat_filters("SYSTEM");


    $filtros = array();

	//recorremos todos los filtros en busca de valores

	$args['meta_query'] = array('relation' => 'AND');


	foreach ($catfiltros as $key => $value) {

		if( isset($_POST["$key"]) ){
		    $filter_temp = $_POST["$key"];
		}else{
			$filter_temp = "";
		}

        if(!empty($filter_temp)){

          $filtros[$key][] =   $filter_temp ;

        }

		if(!empty($filter_temp)){
			if($value["origin"] == "field"){
				$args['meta_query'][] = array(
				'key' => $key,
				'value' => array_map("cleanFilterParameter", $filter_temp)
				);
			}elseif($value["origin"] == "term"){
				$args['tax_query'][] = array(
					'taxonomy' => $key,
					'field' => 'name',
					'terms' => array_map("cleanFilterParameter", $filter_temp)
				);
			}
		}

	}



  $query = new WP_Query( $args );



    ?>
    <?php if(get_current_user_id() == 1 && 1==2){ ?>
    <div class="debug filtrar-productos" style=""><?php print_r($args); ?><br><br><?php echo $query->request ?></div>
    <?php } ?>
    <?php




  if( $query->have_posts() ) :


    //$filtrosNuevos = array();
	$count = $query->post_count;
    while( $query->have_posts() ): $query->the_post();

		//recorremos todos los filtros en busca de valores
		foreach ($catfiltros as $key => $value) {
			if($value["origin"] == "field"){
				$filter_temp = get_post_meta($query->post->ID, $key, true);
				if(!empty($filter_temp)){
					//print_r($filter_temp);
					$filtrosNuevos[$key][$filter_temp] = $filter_temp;
				}
			}elseif($value["origin"] == "term"){
				if(isset($value["field"]) && $value["field"] == "description"){
					$filters_temp = wp_get_post_terms( $query->post->ID, $key, array( 'fields' => 'all' ) );
					if(!empty($filters_temp)){
						foreach ($filters_temp as $filters_temp_key => $filter_temp) {
							if(!empty($filter_temp->description)){
								$filtrosNuevos[$key][$filter_temp->name] = $filter_temp->description;
							}elseif(!empty($filter_temp->name)){
								$filtrosNuevos[$key][$filter_temp->name] = $filter_temp->name;
							}
						}
					}
				}else{
					$filters_temp = wp_get_post_terms( $query->post->ID, $key, array( 'fields' => 'all' ) );
					if(!empty($filters_temp)){
						foreach ($filters_temp as $filters_temp_key => $filter_temp) {
							if(!empty($filter_temp->name)){
								$filtrosNuevos[$key][$filter_temp->name] = $filter_temp->name;
							}
						}
					}
				}
			}
		}

		//echo $query->post->post_title;
		//$show_compare = "on";
		//$show_title = "on";
		//$divClass = "post-".$query->post->ID." product type-product status-publish hentry et_pb_portfolio_item et_pb_grid_item";
		include(locate_template('loop-system.php'));
        //get_template_part( 'content', 'product' );

    endwhile;

    ?>

      <script type="text/javascript">
				//jQuery("#number-products > span").html("<?php echo $count; ?>");
        //jQuery("#filter select").parent().show();
        jQuery(".ast-pagination").hide();
        jQuery("#systems-main-list").addClass("filtered");
      </script>
        <?php
		if(get_current_user_id() == 1 && 1==2){
				echo '<div class="debug filtrosNuevos system-filter">';
			   print_r($filtrosNuevos);
				echo "</div>";
			}
	    //inicializamos los filtros
	    foreach ($catfiltros as $key => $value) {
	    	set_select("$key",$filtrosNuevos[$key],$value,$filtros[$key]);
	    }

        ?>
    </tbody>
    </table>
    <?php
    wp_reset_postdata();
  else :
	?>
	<div id="no-products"><?php _e("There are no products available with these filters, please try other combinations.","danosa"); ?></div>
	<script type="text/javascript">
		jQuery("#number-products > span").html("0");
	</script>
	<?php
  endif;

  die();
}


add_action('wp_ajax_system_filter', 'system_filter_function');
add_action('wp_ajax_nopriv_system_filter', 'system_filter_function');
