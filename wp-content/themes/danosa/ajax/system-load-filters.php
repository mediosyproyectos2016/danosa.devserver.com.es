<?php
function system_load_filters_function(){


  $args = array(
	'post_type' => 'system',
	'posts_per_page' => -1,
	'numberposts' => -1
   );

	?>
	<?php if(get_current_user_id() == 1 && 1==2){ ?>
	<div class="debug"><?php print_r($args); ?></div>
	<?php } ?>
	<?php


  $query = new WP_Query( $args );

  if( $query->have_posts() ) :

	$filtros = array();

	while( $query->have_posts() ): $query->the_post();

		//obtenemos los filtros que le corresponden a la categoría
		$catfiltros = get_cat_filters($_POST['catId']);



		//recorremos todos los filtros en busca de valores
		foreach ($catfiltros as $key => $value) {
			if($value["origin"] == "field"){
				$filter_temp = get_post_meta($query->post->ID, $key, true);
				if(!empty($filter_temp)){
					//print_r($filter_temp);
					$filtros[$key][$filter_temp] = $filter_temp;
				}
			}elseif($value["origin"] == "term"){
				if(isset($value["field"]) && $value["field"] == "description"){
					$filters_temp = wp_get_post_terms( $query->post->ID, $key, array( 'fields' => 'all' ) );
					if(!empty($filters_temp)){
						foreach ($filters_temp as $filters_temp_key => $filter_temp) {
							if(!empty($filter_temp->description)){
								$filtros[$key][$filter_temp->name] = $filter_temp->description;
							}elseif(!empty($filter_temp->name)){
								$filtros[$key][$filter_temp->name] = $filter_temp->name;
							}
						}
					}
				}else{
					$filters_temp = wp_get_post_terms( $query->post->ID, $key, array( 'fields' => 'all' ) );
					if(!empty($filters_temp)){
						foreach ($filters_temp as $filters_temp_key => $filter_temp) {
							if(!empty($filter_temp->name)){
								$filtros[$key][$filter_temp->name] = $filter_temp->name;
							}
						}
					}
				}
			}
		}

	endwhile;
	//print_r($filtros);
	//valor_unico($filter_type_of_installation);
	//valor_unico($filter_energy_class);

	//inicializamos los filtros
	if(get_current_user_id() == 1 && 1==2){
		echo '<div class="debug">';
		foreach ($catfiltros as $key => $value) {
		  echo "<strong>".$value['name'].":</strong><br>";
		  valor_unico($filtros[$key]);
		  echo "<br>";
		}
		echo "</div>";
	}
	?>
	<script type="text/javascript">
        jQuery("#filter .product-filter").removeClass("filterActive");
	</script>
	<?php
	if(get_current_user_id() == 1 && 1==2){
				echo '<div class="debug filtrosNuevos system-load-filters">';
			   print_r($filtros);
				echo "</div>";
			}

	foreach ($catfiltros as $key => $value) {
		set_select("$key",(isset($filtros[$key]))?$filtros[$key]:array(),$value);
	}
	?>

	<script type="text/javascript">
		checkGetValues();
	</script>

	<?php

	wp_reset_postdata();
  else :
	echo 'No posts found';
  endif;

  die();
}


add_action('wp_ajax_system_load_filters', 'system_load_filters_function');
add_action('wp_ajax_nopriv_system_load_filters', 'system_load_filters_function');
