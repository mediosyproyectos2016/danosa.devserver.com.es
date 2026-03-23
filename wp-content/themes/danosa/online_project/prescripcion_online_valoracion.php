<?php
  
    
?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/../astra/assets/css/minified/main.min.css"  />
<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/css/danosa.css"  />
</head>
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
		table,div{
			font-size: 14px;
		}

	</style>

	<table style="width:100%;" cellpadding="30px" cellspacing="0">
		<tr style="background-color:#0069b4;">
			<td style="padding:15px; text-align: center; width:40%; ">
				<img src="/wp-content/themes/danosa/img/danosa-logo.svg">
			</td>
			<td style="font-weight:bold; font-size: 18px; color:#fff; text-align: center;">
				<?= __("Valoración","danosa-design-your-project"); ?> <?php echo sanitize_text_field($_REQUEST["webId"]); ?>
			</td>			 
		</tr>
	</table>

<div class="valoracion">
<input type="hidden" id="partidasData<?=$_REQUEST["type"]?>" value='<?=$data?>'> 
<input type="hidden" id="form-type-of-construction" value="<?=$_REQUEST["type"]?>"> 

<h1><?=$_POST["project_name"]?></h1>

<table style="width:100%">
<tr>
<td><label><?= __("Nombre","danosa-design-your-project"); ?></label></td>
<td><span><?=$_POST["name"]?></span></td>
<td><label><?= __("Apellidos","danosa-design-your-project"); ?></label></td>
<td><span><?=$_POST["surname"]?></span></td>
<tr>

<tr>
<td><label><?= __("Ciudad","danosa-design-your-project"); ?></label></td>
<td><span><?=$_POST["city"]?></span></td>
<td><label><?= __("Provincia","danosa-design-your-project"); ?></label></td>
<td><span><?=$_POST["area"]?></span></td>
<tr>

<tr>
<td><label><?= __("Empresa","danosa-design-your-project"); ?></label></td>
<td><span><?=$_POST["company"]?></span></td>
<td><label><?= __("Actividad","danosa-design-your-project"); ?></label></td>
<td><span><?=$_POST["activity"]?></span></td>
<tr>

</table>

<h2><?= __("Zona de actuación","danosa-design-your-project"); ?>: <?=$_POST["type"]?></h2>

<h2><?= __("Resumen","danosa-design-your-project"); ?></h2>
<table>
<thead>
<tr>
<th><?= __("Partida","danosa-design-your-project"); ?></th>
<th>M&#178;</th>
<th colspan="3"><?= __("Solución","danosa-design-your-project"); ?></th>
</tr>
</thead>
<tbody>
<?php
$total = 0;
foreach($data_array[$_REQUEST["type"]]["partidas"] as $partida){
  if($partida != null){ 
?>
  <tr>
    <td><?=$partida["partida_text"]?></td>
    <td><?=$partida["mm"]?></td>
     <?php 
     if($partida["solucionVertical_text"] != ""){ 
         if($partida["solucionVertical2_text"] != ""){?>
            <td><?=$partida["solucionVertical_text"]?></td>
            <td><?=$partida["solucionVertical2_text"]?></td>
            <td><?=$partida["solucionHorizontal_text"]?></td>
          <?php  }else{?>
           <td colspan="2"><?=$partida["solucionVertical_text"]?></td>
            <td><?=$partida["solucionHorizontal_text"]?></td>
         <?php   }
     }elseif($partida["solucionVertical2_text"] != ""){?> 
      <td colspan="2"><?=$partida["solucionVertical2_text"]?></td>
      <td><?=$partida["solucionHorizontal_text"]?></td>
    <?php  }else{ ?> 
         <td  colspan="3"><?=$partida["solucionHorizontal_text"]?></td>
     <?php }?>

  </tr>
<?php }} ?>
</tbody>
</table>

 <script>
var type  = '<?=$_REQUEST["type"]?>';
getResumen();
</script>

<h2><?= __("Valoración","danosa-design-your-project"); ?></h2>
<table>
<thead>
<tr>
<th><?= __("Partida","danosa-design-your-project"); ?></th>
<th><?= __("Solución","danosa-design-your-project"); ?></th>
<th>M&#178;</th>
<th><?= __("Precio","danosa-design-your-project"); ?></th>
<?php if(getSiteCountry() == "es"){ ?><th><?= __("Total","danosa-design-your-project"); ?></th><?php } ?>
</tr>
</thead>
<tbody>
<?php
$total = 0;
$consultar = false;
foreach($data_array[$_REQUEST["type"]]["partidas"] as $partida){
  if($partida != null){ 
    $precio = "";
    $precio_text = "";
    $slug = explode(" - ",$partida["solucionHorizontal_text"]);
    $slug = trim(end($slug)); 
    $page = get_page_by_title($slug,OBJECT,"system");
    if($page){
        $precio = get_post_meta($page->ID,"total_price",true);
    }else{
        $page = get_page_by_title($slug,OBJECT,"product");           
        if($page){
            $precio = get_post_meta($page,"total_price");
        } 
    }    
    if($precio == "" ){
        $consultar = true; 
        $precio_text = "Consultar";
    }else{
        $precio = str_replace(",",".",$precio);
        $precio_text =  $precio."€";
    }
    ?>
    <tr>
    <td><?=$partida["partida_text"]?></td>
    <td><?=$slug?></td>
    <td><?=$partida["mm"]?></td>
    <td><?php if($precio_text != ""){echo $precio_text;}?></td>
    <?php if(getSiteCountry() == "es"){ ?><td><?php if($precio != ""){ $total += (double)($precio) * (double)($partida["mm"]); echo number_format((double)($precio) * (double)($partida["mm"]),2)."€"; }?></td><?php } ?>
    </tr>
 <?php }}

?>
<?php if(getSiteCountry() == "es"){ ?>
<?php if($consultar){?>
<tr><th >Total</th><th colspan="3"><small><?= __("* Importe aproximado. Faltan precios por consultar","danosa-design-your-project"); ?></small></th><th><?=number_format($total,2)?>€ *</th></tr>
<?php }else{?>
<tr><th colspan="4"><?= __("Total","danosa-design-your-project"); ?></th><th><?=number_format($total,2)?>€</th></tr>
<?php }?>
<?php }?>

</tbody>
</table>
</div>
</body>
</html>