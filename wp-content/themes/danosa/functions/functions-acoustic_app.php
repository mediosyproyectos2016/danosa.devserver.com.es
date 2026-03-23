<?php

add_action( 'wp_ajax_acoustic_app_fd', 'wp_ajax_acoustic_app_fd' );
add_action( 'wp_ajax_nopriv_acoustic_app_fd', 'wp_ajax_acoustic_app_fd' );

function wp_ajax_acoustic_app_fd() {
 
	//file_put_contents(__DIR__."/fd.log",json_encode($_POST).PHP_EOL,FILE_APPEND);
 

    switch_to_blog(2); // ESPAÑA
    $guid = GUID();

	$nombre = "";
	$apellidos = "";
	$email = "";
	$telefono = "";
	$empresa = "";
	$actividad = "";
	$ciudad = "";
	$cpos = "";
	$pais = "";
	$consulta = "";
	$comentarios = "";
	$acceptacion = "";

$_POST['entrevista'] =  isset($_POST['entrevista'])?"SI":"NO";
$_POST['experto'] =  isset($_POST['experto'])?"SI":"NO";
$_POST['descargar'] =  isset($_POST['descargar'])?"SI":"NO";
$_POST['consultar'] =  isset($_POST['consultar'])?"SI":"NO";
 
 

$nombre = $_POST['nombre'];
if($nombre=="")
$nombre ="SD";


$empresa = $_POST['empresa'];
if($empresa=="")
$empresa ="SD";



$actividad = $_POST['actividad'];
if($actividad=="")
$actividad ="SD";


$email = $_POST['email'];
if($email=="")
$email ="SD";


$telefono = $_POST['telefono'];
if($telefono=="")
$telefono ="SD";



$consulta = $_POST['consulta'];
if($consulta=="")
$consulta ="SD";


save_dynamics_form($guid,"Acoustic App FD",$_POST);
save_dynamics_contact($guid,"Acoustic App FD",$nombre,$apellidos,$email,$telefono,$empresa,$actividad,$ciudad,$cpos,$pais,$consulta,$comentarios,$acceptacion,$_POST); 

 

 


}

add_action( 'wp_ajax_acoustic_app_fst', 'wp_ajax_acoustic_app_fst' );
add_action( 'wp_ajax_nopriv_acoustic_app_fst', 'wp_ajax_acoustic_app_fst' );

function wp_ajax_acoustic_app_fst() {
 
 
	//file_put_contents(__DIR__."/fst.log",json_encode($_POST).PHP_EOL,FILE_APPEND);
	//file_put_contents(__DIR__."/fst.log",json_encode($_FILES).PHP_EOL,FILE_APPEND);

	switch_to_blog(2); // ESPAÑA
    $guid = GUID();

	$nombre = "";
	$apellidos = "";
	$email = "";
	$telefono = "";
	$empresa = "";
	$actividad = "";
	$ciudad = "";
	$cpos = "";
	$pais = "";
	$consulta = "";
	$comentarios = "";
	$acceptacion = "";
	

	$nombre = $_POST['nombre'];
	if($nombre=="")
	$nombre ="SD";


	$empresa = $_POST['empresa'];
	if($empresa=="")
	$empresa ="SD";



	$actividad = $_POST['actividad'];
	if($actividad=="")
	$actividad ="SD";


	$email = $_POST['email'];
	if($email=="")
	$email ="SD";


	$telefono = $_POST['telefono'];
	if($telefono=="")
	$telefono ="SD";


if($_POST['tipo']=="")
$_POST['tipo'] ="SD";

if($_POST['localidad']=="")
$_POST['localidad'] ="SD";


if($_POST['adjuntar']=="")
$_POST['adjuntar'] ="SD";

$upload = "SD";

if($_POST['consulta']=="")
$_POST['consulta'] ="SD";


$_POST['adjunto'] = "";

if (is_uploaded_file($_FILES['upload']['tmp_name'])) {

    $archivo = $_FILES['upload'];	
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
	if(in_array(strtoupper($extension),array("DWG","JPG","JPEG","PNG","PDF"))){
		$nombre_arch = str_replace("..","", $_POST['adjuntar']);
		if (move_uploaded_file($archivo['tmp_name'],ABSPATH."wp-content/uploads/fst/".$guid.".".$extension)) {
			$_POST['adjuntar'] = $guid.".".$extension;
			$_POST['adjunto'] = "<a href='https://www.danosa.com/wp-content/uploads/fst/".$guid.".".$extension."'>/wp-content/uploads/fst/".$guid.".".$extension."</a>";
		} else {

			$_POST['adjunto'] = "ERROR";
		}
	}else{
		$_POST['adjunto'] = "Extensión no permitida ".$extension;
	}
 }

save_dynamics_form($guid,"Acoustic App FST",$_POST);
save_dynamics_contact($guid,"Acoustic App FST",$nombre,$apellidos,$email,$telefono,$empresa,$actividad,$ciudad,$cpos,$pais,$consulta,$comentarios,$acceptacion,$_POST); 

 
 




}