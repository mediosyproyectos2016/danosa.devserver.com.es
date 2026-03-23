
<div class="wp-block-group__inner-container">
	<?php
	$solutions = get_field('solutions',$parentId);

	if(!empty($solutions)){
		?>
		<h3><?php _e("Product-related solutions","danosa"); ?></h3>
		<?php
		$solutions = explode(",", $solutions);

		$solutionsAux = array();
		foreach ($solutions as $key => $solution) {
			//echo clean_system_reference($solution)."<br>";
			$solution = get_page_by_title( clean_system_reference($solution), OBJECT, 'system' );
			if($solution){
				$solutionsAux[] = $solution->ID;
			}

		}

		$args = array(
		  'post_type'       => 'system',
		  'post__in'        => $solutionsAux,
		  'posts_per_page' => -1
		);

		$the_query  = new WP_Query( $args );


		// The Loop
		if ( $the_query->have_posts() ) {
			?>
			<div class="content-list-container <?php if($the_query->post_count > 9){ ?>show-more-container<?php } ?>">
				<?php
		    while ( $the_query->have_posts() ) {
		        $the_query->the_post();

		        $noFade = true;

		        include (__DIR__."/../loop-system.php");


		    }
		    ?>
		    </div>
		    <?php

		    if($the_query->post_count > 9){
		    	?>
		    	<a href="#" class="show-more"><?php _e("Show more","danosa"); ?> <i class="danosa-arrow-down"></i></a>
		    	<?php
		    }
		} else {
		    // no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	}
	?>
</div>