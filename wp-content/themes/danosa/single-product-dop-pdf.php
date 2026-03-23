<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$fields = get_fields();
?>
<html>
<body>
	<style type="text/css">
		body{
			font-family: Open Sans, Arial, Helvetica, Verdana;
			color: #666;
		}
		h1{
			color: #333;
		}
		h3 {
		    color: #0069b4;
		}
		table{
			width:100%; border-collapse: collapse;
		}
		table.data-table{
			border: 1px solid #000;
			margin-bottom: 20px;
		}
		table.data-table thead tr{
			background-color:#ebeff5;
		}
		table,div{
			font-size: 14px;
		}
		table.data-table tr{
		}
		table.data-table td,
		table.data-table th{
			border-left: 1px solid #222;
			border-top: 1px solid #000;
			padding: 1px 10px;
		}

		.product-data {
		    width: 680px;
		    margin: 0 auto 30px;
		}
	</style>


	<div class="product-data">
		<table>
			<tr style="background-color:#0069b4;">
				<td style="width:35px; background-color:#8daadb;"></td>
				<td style="padding:15px;">
					<img src="/wp-content/themes/danosa/img/danosa-logo.svg">
				</td>
				<td style="font-weight:bold; font-size: 18px; background-color:#2d91be; color:#fff; text-align: center;">
					DECLARACION DE PRESTACIONES (DoP)
				</td>
				<td style="background-color:#ebeff5; text-align: center; font-size:14px; ">
					Nº DoP: <?=$fields["dop_n"]?><br>
					<?=$fields["dop_fecha"]?><br>
					<?=$fields["dop_version"]?>
				</td>
			</tr>
		</table>
	</div>

	<div class="product-data">
		<h3>1. Código de Identificación única del producto-tipo:</h3>
		<?=$fields["dop_1_codigo_de_identificacion"]?>
	</div>


	<div class="product-data">
		<h3>2. Tipo, Lote, Nº de Serie o cualquier otro elemento que permita la identificación del producto de construcción, como se establece en el artículo 11(4) del RPC:</h3>
		<?=str_replace(PHP_EOL,"<br>",$fields["dop_2_tipo_lote_n_de_serie"])?>
	</div>

	<div class="product-data">
		<h3>3. Uso ó usos previstos del producto de construcción , con arreglo a la especificación técnica armonizada aplicable, tal como establece el fabricante:</h3>
		<?=$fields["dop_3_usos_previstos_del_producto"]?>
	</div>

	<div class="product-data">
		<h3>4. Nombre, razón social ó marca comercial y dirección de contacto del fabricante según lo dispuesto en el artículo 11(5) del RPC:</h3>
		<?=$fields["dop_4_nombre_comercial"]?>
	</div>

	<div class="product-data">
		<h3>5. En su caso, nombre y dirección de contacto del representante autorizado cuyo mandato abarca las tareas especificadas en el artículo 12(2) del RPC:</h3>
		<?=$fields["dop_5_contacto_representante"]?>
	</div>

	<div class="product-data">
		<h3>6. Sistema ó sistemas de evaluación y verificación de la constancia de las prestaciones del producto de construcción tal como figura en el anexo V:</h3>
		<?=$fields["dop_6_sistemas_de_evaluacion_y_verificacion"]?>
	</div>

	<div class="product-data">
		<h3>7. Para los productos cubiertos por una norma armonizada: Nombre y número del organismo notificado/Tarea realizada/ Por el sistema (1+,1, 2+,3)/nº certificado y fecha de concesión:</h3>
		<?=$fields["dop_7_nombre_y_numero_del_organismo_notificado"]?>
	</div>

	<div class="product-data">
		<h3>8. Prestaciones declaradas:</h3>

		<?php
		$json = json_decode($fields["dop_8_prestaciones_declaradas_json"]);

		$count==0;
		$putEta=true;
        ob_start();
		foreach ($json as $key => $value) {

			if($key == "E.T.A."){
				$eta = $value;
			}else{
				if(is_object($value)){
					if($value->placement == "row"){


					?>
					<tr>
						<td><?php echo $key; ?></td>
						<td></td>
					</tr>
					<?php

						foreach ($value->content as $key2 => $value2) {
							?>
							<tr>
								<td style="border-top-width: 0px;"><?php echo $value2->name; ?></td>
								<td style="border-top-width: 0px;"><?php print_r($value2->value); ?></td>
							</tr>
							<?php
						}
					}
				}else{
					if(!empty(trim($value))){ //ocultar campos vacíos
					?>
					<tr>
						<td><?php echo $key; ?></td>
						<td><?php echo $value; ?></td>
						<?php if(!empty($eta) && $putEta==true){ ?><td rowspan="40"><?=$eta; ?></td><?php $eta=false; } ?>
					</tr>
					<?php
					}
				}

			}
			$count++;
		}
        $rows = ob_get_contents();
        ob_end_clean();


        /*
		$prepare= $fields["dop_8_prestaciones_declaradas"];
		$prepare = explode(PHP_EOL,$prepare);

		$prestaciones = array();
		$row_count = 0;
		$group_key = 0;
		$especificacinTcnicaArmonizada = "";
		foreach($prepare as $prepare_string){
			if($prepare_string !=""){
				$prepare_line = explode(": ",$prepare_string);

				$key = str_replace(' ', '-', $prepare_line[0]);
				$key =  preg_replace('/[^A-Za-z0-9\-]/', '', $key);
				if($group_key != "" && $group_key != $key){
					if(count($prestaciones[$group_key]["key"]) == 1){ //Quitamos los grupos de opciones sin ningún valor
						unset($prestaciones[$group_key]);
						$row_count --;
					}
					$group_key = "";
				}
				if($key == "Especificacin-Tcnica-Armonizada"){
					$especificacinTcnicaArmonizada = $prepare_line[1];
				}else{
					if(count($prepare_line) == 3){ // Grupos de opciones
						if(!array_key_exists($key,$prestaciones)){
							$group_key = $key;
							$prestaciones[$key] = array("key" => array($prepare_line[0].": " ),"value" => array("" ));
							$row_count ++;
						}
						if(trim($prepare_line[2]) != ""){
							$prestaciones[$key]["key"][] =  $prepare_line[1];
							$prestaciones[$key]["value"][] =  $prepare_line[2];
						}
					}else{
						if(trim($prepare_line[1]) != ""){
							$prestaciones[$key] = array("key" => array($prepare_line[0]),"value" => array($prepare_line[1]));
							$row_count ++;
						}
					}
				}

			}

		}
		if($group_key != ""  ){
			if(count($prestaciones[$group_key]["key"]) == 1){ //Quitamos los grupos de opciones sin ningún valor
				unset($prestaciones[$group_key]);
				$row_count --;
			}
			$group_key = "";
		}
		*/
		//if($row_count > 0){
		//$first = array_shift($prestaciones);
		?>
			<table class="data-table">
				<thead>
					<tr align="center">
						<th><strong>Características esenciales</strong></th>
						<th><strong>Prestaciones</strong></th>
						<th style="width: 150px;"><strong>Especificación Técnica Armonizada</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php echo $rows; ?>
				</tbody>
				<?php /*
				<tr align="center">
					<td><strong><?=implode("<br>",$first["key"])?></strong></td>
					<td><?=implode("<br>",$first["value"])?></td>
					<td rowspan="<?=$row_count?>">
						 <?=$especificacinTcnicaArmonizada?>
					</td>
				</tr>
				<?php
				foreach($prestaciones as $key => $value){
				?>
				<tr align="center">
					<td><strong><?=implode("<br>",$value["key"])?></strong></td>
					<td><?=implode("<br>",$value["value"])?></td>
				</tr>
				<?php } ?>
				*/ ?>
			</table>

		 <?=$fields["dop_notas"]?>
	</div>

	<?php
	$nextStep = 9;
	if(!empty($fields["dop_9_prestaciones"])){
		$nextStep = 10;
		?>
	<div class="product-data">
		<h3>9. </h3>
		<?=$fields["dop_9_prestaciones"]?>
	</div>


	<div class="product-data">
		<h3><?=$nextStep;?>.</h3>
		<table class="data-table">
			<thead>
				<tr align="center">
					<th><strong>Nombre y cargo</strong></th>
					<th><strong>Lugar y fecha de emisión</strong></th>
					<th><strong>Firma</strong></th>
				</tr>
			</thead>
			<tbody>
				<tr align="center">
					<td><?=$fields["dop_10_responsable"]?></td>
					<td>
							<?=$fields["dop_10_lugar_y_fecha_de_emision"]?>
					</td>
					<td>
					<?php if($fields["dop_10_firma"] != ""){?>
					<img src="<?=$fields["dop_10_firma"]?>" width="100px">
					<?php } ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php } ?>



</body>
</html>
<?php
	endwhile;
endif;

?>