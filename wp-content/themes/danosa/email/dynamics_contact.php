<?php

//$webId,$origen,$nombre,$apellidos,$email,$telefono,$empresa,$actividad,$ciudad,$cpos,$pais,$consulta,$comentarios,$acceptacion,$data = array()

	if(!is_array($data) || count($data) == 0){
		$data = $_REQUEST;
	}
	$titulacion = "";
	if(isset($data["titulacion"])) $titulacion = $data["titulacion"];
	$ubicacion = "";
	if(isset($data["comunidad"])) $ubicacion = $data["comunidad"];
	if(isset($data["area"])) $ubicacion = $data["area"];
	$proyecto = "";
	if(isset($data["titproy"])) $proyecto = $data["titproy"];
	if(isset($data["project_name"])) $proyecto = $data["project_name"];
	/*SISTEMAS*/
	$descargas = "";
	if(isset($data["file_name"])) $descargas .= "<tr><td></td><th>".__("Nombre del sistema").":</th><td>".$data["file_name"]."</td></tr>";
	if(isset($data["system_data_sheet"])) $descargas .= "<tr><td></td><td colspan='2'>".__("Ficha del sistema")."</td></tr>";
	if(isset($data["bim"])) $descargas .= "<tr><td></td><td colspan='2'>".__("BIM del sistema")."</td></tr>";
	if(isset($data["certifications"])) $descargas .= "<tr><td></td><td colspan='2'>".__("Certificaciones del sistema")."</td></tr>";
	if(isset($data["dwg_details"])) $descargas .= "<tr><td></td><td colspan='2'>".__("DWG del sistema")."</td></tr>";
	if(isset($data["decomposed_prices"])) $descargas .= "<tr><td></td><td colspan='2'>".__("Precios descompuestos")."</td></tr>";
	if(isset($data["check_productos_ft"])) $descargas .= "<tr><td></td><td colspan='2'>".__("Fichas técnicas de productos")."</td></tr>";
	if(isset($data["check_productos_fs"])) $descargas .= "<tr><td></td><td colspan='2'>".__("Fichas seguridad de productos")."</td></tr>";
	/*PROYECTOS*/
	if(isset($data["type"])) $descargas .= "<tr><td></td><th>".__("Tipo de obra").":</th><td>".$data["type"]."</td></tr>";
	if(isset($data["PrescripcionSistemas"])){
		$PrescripcionSistemas = html_entity_decode(htmlentities($data["PrescripcionSistemas"], ENT_QUOTES, "UTF-8"));             
		$PrescripcionSistemas = str_replace("\\","",$PrescripcionSistemas);               
		$PrescripcionSistemas_array = json_decode($PrescripcionSistemas,true);              
		foreach($PrescripcionSistemas_array as $pSistema){                       
			$descargas .= "<tr><td></td><th>". $pSistema["sistema_text"]."</th><td>".$pSistema["mm"]."m&#178;</td></tr>";
		}      
	}
	/* ACCOUSTIC APP */
	if(isset($data["entrevista"])) $descargas .= "<tr><td></td><th>".__("Concertar una entrevista").":</th><td>".$data["entrevista"]."</td></tr>";
	if(isset($data["experto"])) $descargas .= "<tr><td></td><th>".__("Hablar con un experto").":</th><td>".$data["experto"]."</td></tr>";
	if(isset($data["descargar"])) $descargas .= "<tr><td></td><th>".__("Descargar detalles DWG y BIM").":</th><td>".$data["descargar"]."</td></tr>";
	if(isset($data["consultar"])) $descargas .= "<tr><td></td><th>".__("Consultar instalación de producto").":</th><td>".$data["consultar"]."</td></tr>";

	if(isset($data["tipo"])) $descargas .= "<tr><td></td><th>".__("TIPO DE PROYECTO").":</th><td>".$data["tipo"]."</td></tr>";
	if(isset($data["localidad"])) $descargas .= "<tr><td></td><th>".__("LOCALIDAD DEL PROYECTO").":</th><td>".$data["localidad"]."</td></tr>";
	if(isset($data["adjuntar"])) $descargas .= "<tr><td></td><th>".__("FOTO O DOCUMENTO").":</th><td>".$data["adjuntar"]."</td></tr>";
	if(isset($data["adjunto"])) $descargas .= "<tr><td></td><th>".__("ADJUNTO").":</th><td>".$data["adjunto"]."</td></tr>";
	if(isset($data["consulta"])) $descargas .= "<tr><td></td><th>".__("MENSAJE").":</th><td>".$data["consulta"]."</td></tr>";

?>

<table> 
	<tbody>
		<tr> 
		<td></td>
			<th><?=__("WebId")?>:</th>
			<td><?=$webId?></td>
			 
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Origen")?>:</th>
			<td><?=$origen?></td>
			 
		</tr>
		<tr>
			<th><?=__("Datos del solicitante")?>:</th>
			<td colspan="2"><hr></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Nombre")?>:</th>
			<td><?=$nombre?></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Apellidos")?>:</th>
			<td><?=$apellidos?></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Correo electrónico")?>:</th>
			<td><?=$email?></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Teléfono")?>:</th>
			<td><?=$telefono?></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Titulación")?>:</th>
			<td><?=$titulacion?></td>
		</tr>
		<tr>
		 
			<th><?=__("Dirección")?>:</th>
			<td  colspan="2"><hr></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Código postal")?>:</th>
			<td><?=$cpos?></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Ciudad")?>:</th>
			<td><?=$ciudad?></td>
		</tr>		
		<tr>

			<th><?=__("Datos de la Empresa")?></th>
			<td  colspan="2"><hr></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Empresa")?>:</th>
			<td><?=$empresa?></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Actividad")?>:</th>
			<td><?=$actividad?></td>
		</tr>
		<tr>
			<th><?=__("Datos del Proyecto")?></th>
			<td  colspan="2"><hr></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Título")?>:</th>
			<td><?=$proyecto?></td>
		</tr>
		<tr> 
		<td></td>
			<th><?=__("Ubicación")?>:</th>
			<td><?=$ubicacion?></td>
		</tr>
		<tr>
			<th><?=__("Descargas")?></th>
			<td colspan="2"><hr></td>
		</tr>
		<?=$descargas?>
	</body>
</table>