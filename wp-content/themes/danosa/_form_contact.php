<?php

if(isset($results)){
   //guid,origen,nombre,apellidos,email,telefono,empresa,actividad,ciudad,cpos,pais,consulta,comentarios,acceptacion, created_at, bulk 
	if(count($results) > 0){
		$contact = $results[0];
		$raw = array();
		if($contact["bulk"] !=""){
			$raw = json_decode($contact["bulk"],true);
		}?>

		 <table class="table order<?=$o?> direction<?=$d?>" style="width:100%">
        <thead>
        <tr>
			<th>Campo</th>
			<th>Valor</th>
		</tr>
		</thead>
		<tbody>
		 <tr>
			<th>guid</th>
			<th><?=$contact["guid"]?></th>
		</tr>
		 <tr>
			<th>origen</th>
			<th><?=$contact["origen"]?></th>
		</tr>
		 <tr>
			<th>nombre</th>
			<th><?=$contact["nombre"]?></th>
		</tr>
		 <tr>
			<th>apellidos</th>
			<th><?=$contact["apellidos"]?></th>
		</tr>
		 <tr>
			<th>email</th>
			<th><?=$contact["email"]?></th>
		</tr>
		 <tr>
			<th>telefono</th>
			<th><?=$contact["telefono"]?></th>
		</tr>
		 <tr>
			<th>empresa</th>
			<th><?=$contact["empresa"]?></th>
		</tr> <tr>
			<th>actividad</th>
			<th><?=$contact["actividad"]?></th>
		</tr> <tr>
			<th>ciudad</th>
			<th><?=$contact["ciudad"]?></th>
		</tr> <tr>
			<th>cpos</th>
			<th><?=$contact["cpos"]?></th>
		</tr> <tr>
			<th>pais</th>
			<th><?=$contact["pais"]?></th>
		</tr> <tr>
			<th>consulta</th>
			<th><?=$contact["consulta"]?></th>
		</tr> <tr>
			<th>comentarios</th>
			<th><?=$contact["comentarios"]?></th>
		</tr> <tr>
			<th>acceptacion</th>
			<th><?=$contact["acceptacion"]?></th>
		</tr> <tr>
			<th>created_at</th>
			<th><?=$contact["created_at"]?></th>
		</tr>
		<?php foreach($raw as $key => $value){ ?>
		<tr>
			<th><?=$key?></th>
			<th><?=$value?></th>
		</tr>
		<?php } ?>
		</tbody>
		</table>

	<?php }else{
		echo "error";
	}
}else{?>

<div id="formcontact<?=$form->id?>div" class="modalFormContact" style="cursor:pointer" data-blogid="<?=$form->blog_id?>" data-id="<?=$form->id?>" data-guid="<?=$form->guid;?>" data-modalid="formcontact_<?=$form->id?>">
 
 
	 <?=$form->guid;?>
	
 </div> 
 
 <div style="display: none;">
		 <div id="formcontact_<?=$form->id?>">
			  
		 </div>
	 </div>


<?php } ?>
