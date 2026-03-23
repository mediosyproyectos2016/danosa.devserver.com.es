<?php
 


 
$key = array_key_first($data_json);
$m2 = 0;
foreach($data_json[$key] as $partidas){
	foreach($partidas as $partida){
		if(is_array($partida)){
			$m2 += (int)$partida["mm"];
		}
		
	}

}
if(isset($data_json["sistemas"]) && $key != "sistemas"){
	foreach($data_json["sistemas"] as $sistemas){
	 
			if(is_array($sistemas) && isset($sistemas["mm"])){
				$m2 += (int)$sistemas["mm"];
			}
	 

	}

}


?>
<div style="display:none">
<?php 

print_r($data_json); 
print_r($key);
print_r($data_json[$key]);
foreach($data_json[$key] as $partidas){
	foreach($partidas as $partida){
	
		if(is_array($partida)){
			$m2 += (int)$partida["mm"];
		}
		
	}

}
?>
</div>
<?php

echo "<div class='_disenya_tu_proyecto' data-guid='".$form->guid."' data-blog_id='".$form->blog_id."'>".$key." ".$m2." m<sup>2</sup></div>";