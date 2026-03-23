<h3><?php _e("Downloads","danosa"); ?></h3>
<div class="product-download-list-container">
	<ul>
		<?php
		foreach ($product_safety_datasheet as $key => $value) {
			$link = get_field("file",$value);
			if(!empty($link)){
				get_download_link(__("Safety Datasheet","danosa")." - ".$value->description,$link);
			}
		}

		foreach ($certifications as $key => $value) {
			$link = get_field("file",$value);
			if(!empty($link)){
				get_download_link($value->description,$link);
			}
		}
		?>
	</ul>
</div>