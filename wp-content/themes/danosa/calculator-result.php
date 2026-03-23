<?php
global $wpdb;
$posts_contact = $wpdb->get_results("SELECT * FROM $wpdb->postmeta
WHERE meta_key = 'hreflang_ref' AND  meta_value = 'contact' LIMIT 1", ARRAY_A);
$contact_link = "";
if(count($posts_contact) > 0){
	$contact_link =  get_permalink($posts_contact[0]["post_id"]);
}
?>


<div id="main-content">


			
				<article id="post-467" class="post-467 page type-page status-publish hentry">

				
					<div class="entry-content">
					<div id="et-boc" class="et-boc">
			
		<div class="et-l et-l--post">
			<div class="et_builder_inner_content et_pb_gutters3"><div class="et_pb_section et_pb_section_0 et_section_regular" >
				
				
				
				
					<div class="et_pb_row et_pb_row_0">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_0  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_left et_pb_bg_layout_light">
				
				
				<div class="et_pb_text_inner"><h3><strong>Datos iniciales</strong></h3></div>
			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_1">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_1  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_0">
				
				
				<div class="et_pb_code_inner"><div id="txt_prueba"></div>

</div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_2">
				<div class="et_pb_column et_pb_column_1_2 et_pb_column_2  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_1">
				
				
				<div class="et_pb_code_inner"><div id="ubicacion"></div>

<script>
var	ano_construccion = localStorage.getItem("ano_construccion");
  
var	m_ano = localStorage.getItem("m_ano");

var	provincia = localStorage.getItem("provincia");
						
var	capital = localStorage.getItem("capital");
						
var	zc_capital = localStorage.getItem("zc_capital");
						
var	altitud_capital = localStorage.getItem("altitud_capital");
						
var	altitud_localidad = localStorage.getItem("altitud_localidad");
						
var	localidad = localStorage.getItem("localidad");
						
var	zc = localStorage.getItem("zc");
						
var	tipo_vivienda = localStorage.getItem("tipo_vivienda");
						
var	mts_vivienda = localStorage.getItem("mts_vivienda");
						
var	tipo_energia = localStorage.getItem("tipo_energia");

var	U_envolvente_fachadas = localStorage.getItem("U_envolvente_fachadas");

var	U_envolvente_ventanas = localStorage.getItem("U_envolvente_ventanas");

var	U_envolvente_cubiertas = localStorage.getItem("U_envolvente_cubiertas");

var vum_fs = U_envolvente_fachadas;

var vum_eps = U_envolvente_fachadas;

var vum_epsg = U_envolvente_fachadas;

var vumv_fs = U_envolvente_ventanas;

var vumv_eps = U_envolvente_ventanas;

var vumv_epsg = U_envolvente_ventanas;

var vumc_fs = U_envolvente_cubiertas;

var vumc_eps = U_envolvente_cubiertas;

var vumc_epsg = U_envolvente_cubiertas;
 
 




var pp_fachada=0.0;
var pp_ventanas=0.0;
var pp_cubierta=0.0;


var bloqueu = ["Bloque plurifamiliar - piso bajo cubierta","0.599","0.1","1"];
var bloquei = ["Bloque plurifamiliar - piso intermedio","0.599","0.1","0"];
var adosada = ["Adosado","0.70","0.15","0.504"];
var pareada = ["Pareado","0.80","0.15","0.504"];
var independiente = ["Independiente","1.008","0.20","0.693"];
  
var vne_inicial = 0.0;
  
function datos_envolvente(){
pp_fachada = eval(tipo_vivienda)[1]*mts_vivienda;
pp_ventanas = eval(tipo_vivienda)[2]*pp_fachada;
pp_cubierta = eval(tipo_vivienda)[3]*mts_vivienda;
tipo_vivienda = eval(tipo_vivienda)[0]; 

}
  
function ne_inicial(){
vne_inicial= ((U_envolvente_fachadas*pp_fachada)+(U_envolvente_ventanas*pp_ventanas)+(U_envolvente_cubiertas*pp_cubierta))*3.624;
}
  
var mensa="";

var mensa2="";
  
var fachada_danopren_fs_40 = ["40","0.034","0.67","0.57","0.52","0.4"];
var fachada_danopren_fs_50 = ["50","0.034","0.56","0.49","0.45","0.36"];
var fachada_danopren_fs_60 = ["60","0.034","0.48","0.43","0.4","0.32"];
var fachada_danopren_fs_70 = ["70","0.036","0.44","0.4","0.37","0.31"];
var fachada_danopren_fs_80 = ["80","0.036","0.39","0.36","0.34","0.28"];
var fachada_danopren_fs_90 = ["90","0.037","0.36","0.33","0.32","0.27"];
var fachada_danopren_fs_100 = ["100","0.037","0.33","0.3","0.29","0.25"];
var fachada_danopren_fs_110 = ["110","0.034","0.28","0.26","0.25","0.22"];
var fachada_danopren_fs_120 = ["120","0.034","0.26","0.24","0.23","0.21"];
var fachada_danopren_fs_130 = ["130","0.036","0.25","0.24","0.23","0.2"];
var fachada_danopren_fs_140 = ["140","0.036","0.24","0.22","0.22","0.19"];
var fachada_danopren_fs_150 = ["150","0.036","0.22","0.21","0.20","0.18"];
var fachada_danopren_fs_160 = ["160","0.036","0.21","0.20","0.19","0.17"];

var fachada_danotherm_eps_40 = ["40","0.036","0.7","0.59","0.54","0.41"];
var fachada_danotherm_eps_50 = ["50","0.036","0.59","0.51","0.47","0.37"];
var fachada_danotherm_eps_60 = ["60","0.036","0.51","0.45","0.42","0.33"];
var fachada_danotherm_eps_70 = ["70","0.036","0.44","0.4","0.37","0.31"];
var fachada_danotherm_eps_80 = ["80","0.036","0.39","0.36","0.34","0.28"];
var fachada_danotherm_eps_90 = ["90","0.036","0.36","0.33","0.31","0.26"];
var fachada_danotherm_eps_100 = ["100","0.036","0.32","0.3","0.28","0.24"];
var fachada_danotherm_eps_110 = ["110","0.036","0.30","0.28","0.26","0.23"];
var fachada_danotherm_eps_120 = ["120","0.036","0.27","0.26","0.25","0.21"];
var fachada_danotherm_eps_130 = ["130","0.036","0.25","0.24","0.23","0.2"];
var fachada_danotherm_eps_140 = ["140","0.036","0.24","0.22","0.22","0.19"];
var fachada_danotherm_eps_150 = ["150","0.036","0.22","0.21","0.20","0.18"];
var fachada_danotherm_eps_160 = ["160","0.036","0.21","0.20","0.19","0.17"];

var fachada_danotherm_epsg_40 = ["40","0.031","0.62","0.54","0.49","0.38"];
var fachada_danotherm_epsg_50 = ["50","0.031","0.52","0.46","0.42","0.34"];
var fachada_danotherm_epsg_60 = ["60","0.031","0.45","0.40","0.37","0.31"];
var fachada_danotherm_epsg_70 = ["70","0.031","0.39","0.35","0.33","0.28"];
var fachada_danotherm_epsg_80 = ["80","0.031","0.35","0.32","0.30","0.26"];
var fachada_danotherm_epsg_90 = ["90","0.031","0.31","0.29","0.27","0.24"];
var fachada_danotherm_epsg_100 = ["100","0.031","0.28","0.26","0.25","0.22"];
var fachada_danotherm_epsg_110 = ["110","0.031","0.26","0.24","0.23","0.20"];
var fachada_danotherm_epsg_120 = ["120","0.031","0.24","0.22","0.22","0.19"];
var fachada_danotherm_epsg_130 = ["130","0.031","0.22","0.21","0.2","0.18"];
var fachada_danotherm_epsg_140 = ["140","0.031","0.21","0.20","0.19","0.17"];
var fachada_danotherm_epsg_150 = ["150","0.031","0.19","0.18","0.18","0.16"];
var fachada_danotherm_epsg_160 = ["160","0.031","0.18","0.17","0.17","0.15"];
  
var ventanas0 = ["0","Ningún cambio en ventanas","5","4","3","1.7"];
var ventanas1 = ["1","Metal con rotura PT y 4/16/4","2.3","2.3","2.3","1.7"];
var ventanas2 = ["2","PVC con 4/16/4","2.2","2.2","2.2","1.7"];
var ventanas3 = ["3","Metal con rotura PT y 4/16/4 y bajo-emisivo","1.7","1.7","1.7","1.7"];
var ventanas4 = ["4","PVC con 4/16/4 y bajo-emisivo","1.4","1.4","1.4","1.4"];  

var DANOPREN_TR_40 = ["40","0.034","0.61","0.61","0.44","0.28"];
var DANOPREN_TR_50 = ["50","0.034","0.51","0.51","0.39","0.26"];
var DANOPREN_TR_60 = ["60","0.034","0.45","0.45","0.35","0.24"];
var DANOPREN_TR_70 = ["70","0.036","0.41","0.41","0.33","0.23"];
var DANOPREN_TR_80 = ["80","0.036","0.37","0.37","0.3","0.22"];
var DANOPREN_TR_90 = ["90","0.037","0.34","0.34","0.28","0.21"];
var DANOPREN_TR_100 = ["100","0.037","0.31","0.31","0.26","0.19"];
var DANOPREN_TR_110 = ["110","0.034","0.27","0.27","0.23","0.18"];
var DANOPREN_TR_120 = ["120","0.034","0.25","0.25","0.22","0.17"];
var DANOPREN_TR_130 = ["130","0.036","0.24","0.24","0.21","0.17"];
var DANOPREN_TR_140 = ["140","0.036","0.23","0.23","0.20","0.16"];
var DANOPREN_TR_150 = ["150","0.036","0.22","0.22","0.19","0.15"];
var DANOPREN_TR_160 = ["160","0.036","0.20","0.20","0.18","0.15"];
var DANOPREN_TR_170 = ["170","0.037","0.20","0.20","0.18","0.14"];
var DANOPREN_TR_180 = ["180","0.037","0.19","0.19","0.17","0.14"];
var DANOPREN_TR_190 = ["190","0.037","0.18","0.18","0.16","0.13"];
var DANOPREN_TR_200 = ["200","0.037","0.17","0.17","0.15","0.13"];

var DANOLOSA_75 = ["40","0.034","0.61","0.61","0.44","0.28"];
var DANOLOSA_85 = ["50","0.034","0.51","0.51","0.39","0.26"];
var DANOLOSA_95 = ["60","0.034","0.45","0.45","0.35","0.24"];

window.onload  = datos_iniciales();

function datos_iniciales(){
  
datos_envolvente();

ne_inicial();

var mensa='<p>Año de costrucción: <strong>' + ano_construccion + '</strong></p> ';
/*
mensa +='<table border=1><tr><td>Fachadas</td><td>Ventanas</td><td>Cubierta</td></tr>';
mensa +='<tr><td>U (W/m<sup>2</sup>K) ' + ano_construccion + '</td><td>U (W/m<sup>2</sup>K) ' + ano_construccion + '</td><td>U (W/m<sup>2</sup>K) ' + ano_construccion + '</td></tr>';
mensa +='<tr><td>' + U_envolvente_fachadas + '</td><td>' + U_envolvente_ventanas + '</td><td>' + U_envolvente_cubiertas + '</td></tr></table>';
*/


if (localidad=="no"){

mensa2 ='<p>Ubicación: <strong>' + capital + '</strong></p> ';
mensa2 +='<p>Altitud: <strong>' + altitud_capital + '</strong></p> ';
mensa2 +='<p>Zona climática: <strong>' + zc + '</strong></p> ';
 
}
else{
mensa2 ='<p>Ubicación: <strong>' + provincia + '</strong></p> ';
mensa2 +='<p>Altitud: <strong>' + altitud_localidad + '</strong></p> ';
mensa2 +='<p>Zona climática: <strong>' + zc + '</strong></p> ';
}

mensa2 +='<p>Tipología de la vivienda: <strong>' + tipo_vivienda + '</strong></p> ';
mensa2 +='<p>M<sup>2</sup> vivienda: <strong>' + mts_vivienda + '</strong></p> ';
  /*
mensa2 +='<p>M<sup>2</sup> fachada (pp): <strong>' + pp_fachada + '</strong></p> ';
mensa2 +='<p>M<sup>2</sup> ventanas (pp): <strong>' + pp_ventanas + '</strong></p> ';
mensa2 +='<p>M<sup>2</sup> cubierta (pp): <strong>' + pp_cubierta + '</strong></p> ';
*/
mensa2 +='<p>Tipo de energía: <strong>' + tipo_energia + '</strong></p> <br /><br />';
  
    mensa2 +='<a style="font-size:1.2em;font-weight: bold;" href="https://www.danothermsate.com/calculadora-energetica/">MODIFICAR DATOS</a>';
  /*
mensa2 +='<p><strong>NE<sub>inicial=  </sub>' + vne_inicial + '</strong></p> ';
*/


document.getElementById("txt_prueba").innerHTML=mensa;

document.getElementById("ubicacion").innerHTML=mensa2;

}


/*U SEGUN REVESTIMIENTO*/



function um_fs(id){
	vum_fs=(eval(id))[m_ano];
  var txtt="U (W/m<sup>2</sup>K) DANOPREN FS " + id.replace('fachada_danopren_fs_','') + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_um_danopren_fs").innerHTML=txtt;
  caletixps();
  
  
}


  
function um_eps(id){
vum_eps=(eval(id))[m_ano];
  var txtt="U (W/m<sup>2</sup>K) DANOTHERM EPS " + id.replace('fachada_danotherm_eps_','') + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_um_danotherm_eps").innerHTML=txtt;
  caletieps();
}


  
   function um_epsg(id){
vum_epsg=(eval(id))[m_ano];
  var txtt="U (W/m<sup>2</sup>K) DANOTHERM EPS grafito " + id.replace('fachada_danotherm_epsg_','') + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_um_danotherm_epsg").innerHTML=txtt;
  caletiepsg();
} 


/*U SEGUN VENTANA*/



function umv_fs(id){
vumv_fs=(eval(id))[m_ano];
  var txtt="U (W/m<sup>2</sup>K) " + (eval(id))[1] + ":   <STRONG>" + (eval(id))[m_ano]	+ "</STRONG>"
  document.getElementById("p_umv_danopren_fs").innerHTML=txtt;
  caletixps();
  
}
 

  
function umv_eps(id){
vumv_eps=(eval(id))[m_ano];
  var txtt="U (W/m<sup>2</sup>K) " + (eval(id))[1] + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_umv_danotherm_eps").innerHTML=txtt;
  caletieps();
}


  
   function umv_epsg(id){
vumv_epsg=(eval(id))[m_ano];
  var txtt="U (W/m<sup>2</sup>K) " + (eval(id))[1]+ ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_umv_danotherm_epsg").innerHTML=txtt;
  caletiepsg();
  
} 

/*U SEGUN CUBIERTA*/

 

function umc_fs(id){
  vumc_fs=(eval(id))[m_ano];
  var dtr=id.replace('_',' ');
  dtr=dtr.replace('_',' ');

  var txtt="U (W/m<sup>2</sup>K) " + dtr + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_umc_danopren_fs").innerHTML=txtt;
  caletixps();
  
  
}
  
  
  
function umc_eps(id){
 vumc_eps=(eval(id))[m_ano];
   var dtr=id.replace('_',' ');
  dtr=dtr.replace('_',' ');

  var txtt="U (W/m<sup>2</sup>K) " + dtr + ":    <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_umc_danotherm_eps").innerHTML=txtt;
 caletieps();
}
  

  
   function umc_epsg(id){
   vumc_epsg=(eval(id))[m_ano];
      var dtr=id.replace('_',' ');
  dtr=dtr.replace('_',' ');

  var txtt="U (W/m<sup>2</sup>K)  " + dtr + ":    <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
  document.getElementById("p_umc_danotherm_epsg").innerHTML=txtt;
  caletiepsg();
} 


/*********************************/

function sm_xps(){
vumc_fs = U_envolvente_cubiertas;
var txtt="Sin mejoras";
document.getElementById("p_umc_danopren_fs").innerHTML=txtt;
caletixps();
}

function sm_eps(){
vumc_eps = U_envolvente_cubiertas;
var txtt="Sin mejoras";
document.getElementById("p_umc_danotherm_eps").innerHTML=txtt;
caletieps();
}

function sm_epsg(){
vumc_epsg = U_envolvente_cubiertas;
var txtt="Sin mejoras";
document.getElementById("p_umc_danotherm_epsg").innerHTML=txtt;
caletiepsg();
}



var vne_mej_xps=0.0;
var d_xps="";
var p_mejora_xps=0.0;

function caletixps(){
/*
vne inicial vne_inicial
U SEGUN REVESTIMIENTO vum_fs
U SEGUN VENTANA vumv_fs
U SEGUN CUBIERTA vumc_fs
*/

vne_mej_xps= ((vum_fs*pp_fachada)+(vumv_fs*pp_ventanas)+(vumc_fs*pp_cubierta))*3.624;

p_mejora_xps=((vne_inicial-vne_mej_xps)/vne_inicial)*100;
  
p_mejora_xps=p_mejora_xps.toFixed();

/*
alert("U SEGUN REVESTIMIENTO " + vum_fs + "\r\nU SEGUN VENTANA " + vumv_fs + "\r\nU SEGUN CUBIERTA " + vumc_fs + "\r\nVNE "+ vne_mej_xps);
*/
  /*
d_xps ="<strong><u>PARÁMETROS INICIALES</u></strong><br /><br />";
d_xps +="U (W/m2K) inicial en fachada: <strong>" + U_envolvente_fachadas + "</strong><br />";
d_xps +="U (W/m2K) inicial en ventanas: <strong>" + U_envolvente_ventanas + "</strong><br />";
d_xps +="U (W/m2K) inicial en cubiertas: <strong>" + U_envolvente_cubiertas + "</strong><br />";
d_xps +="NE<sub>inicial</sub> <strong>" + vne_inicial + "</strong><br /><br />";
d_xps +="<strong><u>PARÁMETROS MEJORADOS</u></strong><br /><br />";
d_xps +="U (W/m2K) mejora en fachada: <strong>" + vum_fs + "</strong><br />";
d_xps +="U (W/m2K) mejora ventanas: <strong>" + vumv_fs + "</strong><br />";
d_xps +="U (W/m2K) mejora cubierta: <strong>" + vumc_fs + "</strong><br /><br />";
d_xps +="NE<sub>mejorado</sub> <strong>" + vne_mej_xps + "</strong><br /><br /><br />";
  */
 d_xps ="";  
  
  if (p_mejora_xps == 0){
 d_xps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_xps +" %</strong><br /><br />";  

  }
  
  if (p_mejora_xps > 0 && p_mejora_xps < 40){
 
 d_xps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_xps +" %</strong><br /><br />";  
     d_xps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion1.jpg'><br />";
 d_xps +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es improbable que se consiga la mejora de letra del certificado energético";
  }
if (p_mejora_xps > 40 && p_mejora_xps < 70){
  d_xps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_xps +" %</strong><br /><br />";
     d_xps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion2.jpg'><br />";
  d_xps +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta una letra del certificado energético";
}
  if (p_mejora_xps > 70 && p_mejora_xps < 85){
    d_xps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_xps +" %</strong><br /><br />";
       d_xps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion3.jpg'><br />";
d_xps +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta dos letras del certificado energético";
  }
  if (p_mejora_xps > 85){
    d_xps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_xps +" %</strong><br /><br />";
       d_xps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion4.jpg'><br />";
   d_xps +=" Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta tres letras del certificado energético";
  }
document.getElementById("p_r_danopren_fs").innerHTML=d_xps;


}

var vne_mej_eps=0.0;
var d_eps="";
var p_mejora_eps=0.0;

function caletieps(){

/*
vne inicial vne_inicial
U SEGUN REVESTIMIENTO vum_eps
U SEGUN VENTANA vumv_eps
U SEGUN CUBIERTA vumc_eps
*/

vne_mej_eps= ((vum_eps*pp_fachada)+(vumv_eps*pp_ventanas)+(vumc_eps*pp_cubierta))*3.624;

p_mejora_eps=((vne_inicial-vne_mej_eps)/vne_inicial)*100;
  
  p_mejora_eps=p_mejora_eps.toFixed();

/*
alert("U SEGUN REVESTIMIENTO " + vum_eps + "\r\nU SEGUN VENTANA " + vumv_eps + "\r\nU SEGUN CUBIERTA " + vumc_eps + "\r\nVNE "+ vne_mej_eps);

*/
  /*
d_eps ="<strong><u>PARÁMETROS INICIALES</u></strong><br /><br />";
d_eps +="U (W/m2K) inicial en fachada: <strong>" + U_envolvente_fachadas + "</strong><br />";
d_eps +="U (W/m2K) inicial en ventanas: <strong>" + U_envolvente_ventanas + "</strong><br />";
d_eps +="U (W/m2K) inicial en cubiertas: <strong>" + U_envolvente_cubiertas + "</strong><br />";
d_eps +="NE<sub>inicial</sub> <strong>" + vne_inicial + "</strong><br /><br />";
d_eps +="<strong><u>PARÁMETROS MEJORADOS</u></strong><br /><br />";
d_eps +="U (W/m2K) mejora en fachada: <strong>" + vum_eps + "</strong><br />";
d_eps +="U (W/m2K) mejora ventanas: <strong>" + vumv_eps + "</strong><br />";
d_eps +="U (W/m2K) mejora cubierta: <strong>" + vumc_eps + "</strong><br /><br />";
d_eps +="NE<sub>mejorado</sub> <strong>" + vne_mej_eps + "</strong><br /><br /><br />";
*/

   d_eps =""; 
   if (p_mejora_eps == 0){
 d_eps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_eps +" %</strong><br /><br />";   

  }
  
  if (p_mejora_eps > 0 && p_mejora_eps < 40){
 d_eps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_eps +" %</strong><br /><br />";   
       d_eps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion1.jpg'><br />";
 d_eps +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es improbable que se consiga la mejora de letra del certificado energético";
  }
if (p_mejora_eps > 40 && p_mejora_eps < 70){
  d_eps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_eps +" %</strong><br /><br />";
  d_eps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion2.jpg'><br />";
  d_eps +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta una letra del certificado energético";
}
  if (p_mejora_eps > 70 && p_mejora_eps < 85){
    d_eps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_eps +" %</strong><br /><br />";
    d_eps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion3.jpg'><br />";
d_eps +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta dos letras del certificado energético";
  }
  if (p_mejora_eps > 85){
    d_eps ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_eps +" %</strong><br /><br />";
    d_eps +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion4.jpg'><br />";
   d_eps +=" Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta tres letras del certificado energético";
  }

document.getElementById("p_r_danotherm_eps").innerHTML=d_eps;

}

var vne_mej_epsg=0.0;
var d_epsg="";
var p_mejora_epsg=0.0;

function caletiepsg(){

/*
vne inicial vne_inicial
U SEGUN REVESTIMIENTO vum_epsg
U SEGUN VENTANA vumv_epsg
U SEGUN CUBIERTA vumc_epsg
*/

vne_mej_epsg= ((vum_epsg*pp_fachada)+(vumv_epsg*pp_ventanas)+(vumc_epsg*pp_cubierta))*3.624;

p_mejora_epsg=((vne_inicial-vne_mej_epsg)/vne_inicial)*100;
  
  p_mejora_epsg=p_mejora_epsg.toFixed();

/*
alert("U SEGUN REVESTIMIENTO " + vum_epsg + "\r\nU SEGUN VENTANA " + vumv_epsg + "\r\nU SEGUN CUBIERTA " + vumc_epsg + "\r\nVNE "+ vne_mej_epsg);
*/
  /*
d_epsg ="<strong><u>PARÁMETROS INICIALES</u></strong><br /><br />";
d_epsg +="U (W/m2K) inicial en fachada: <strong>" + U_envolvente_fachadas + "</strong><br />";
d_epsg +="U (W/m2K) inicial en ventanas: <strong>" + U_envolvente_ventanas + "</strong><br />";
d_epsg +="U (W/m2K) inicial en cubiertas: <strong>" + U_envolvente_cubiertas + "</strong><br />";
d_epsg +="NE<sub>inicial</sub> <strong>" + vne_inicial + "</strong><br /><br />";
d_epsg +="<strong><u>PARÁMETROS MEJORADOS</u></strong><br /><br />";
d_epsg +="U (W/m2K) mejora en fachada: <strong>" + vum_epsg + "</strong><br />";
d_epsg +="U (W/m2K) mejora ventanas: <strong>" + vumv_epsg + "</strong><br />";
d_epsg +="U (W/m2K) mejora cubierta: <strong>" + vumc_epsg + "</strong><br /><br />";
d_epsg +="NE<sub>mejorado</sub> <strong>" + vne_mej_epsg + "</strong><br /><br /><br />";
*/
d_epsg ="";  
  
    if (p_mejora_epsg == 0){
 d_epsg ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_epsg +" %</strong><br /><br />";   

  }
  
  if (p_mejora_epsg > 0 && p_mejora_epsg < 40){
 d_epsg ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_epsg +" %</strong><br /><br />"; 
    d_epsg +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion1.jpg'><br />";
 d_epsg +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es improbable que se consiga la mejora de letra del certificado energético";
  }
if (p_mejora_epsg > 40 && p_mejora_epsg < 70){
  d_epsg ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_epsg +" %</strong><br /><br />";
   d_epsg +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion2.jpg'><br />";
  d_epsg +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta una letra del certificado energético";
}
  if (p_mejora_epsg > 70 && p_mejora_epsg < 85){
    d_epsg ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_epsg +" %</strong><br /><br />";
     d_epsg +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion3.jpg'><br />";
d_epsg +="Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta dos letras del certificado energético";
  }
  if (p_mejora_epsg > 85){
    d_epsg ="<strong>PORCENTAJE DE MEJORA : "+ p_mejora_epsg +" %</strong><br /><br />";
     d_epsg +="<img src='https://www.danothermsate.com/wp-content/uploads/2021/10/satisfacion4.jpg'><br />";
   d_epsg +=" Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta tres letras del certificado energético";
  }

document.getElementById("p_r_danotherm_epsg").innerHTML=d_epsg;

}

function muestro_cubierta(){
if (tipo_vivienda=="Bloque plurifamiliar - piso intermedio"){
var txtt="";
  document.getElementById("mostrar_cubierta").innerHTML=txtt;
}
}
</script></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_2 et_pb_column_3  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_0">
				
				
				<span class="et_pb_image_wrap "><img src="https://www.danothermsate.com/wp-content/uploads/2021/02/Zona-climatica-del-CTE-mapa-624x380-1.jpg" alt="" title="" srcset="https://www.danothermsate.com/wp-content/uploads/2021/02/Zona-climatica-del-CTE-mapa-624x380-1.jpg 730w, https://www.danothermsate.com/wp-content/uploads/2021/02/Zona-climatica-del-CTE-mapa-624x380-1-480x373.jpg 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 730px, 100vw" /></span>
			</div>
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_3">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_4  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_text et_pb_text_1  et_pb_text_align_left et_pb_bg_layout_light">
				
				
				<div class="et_pb_text_inner"><h3><strong>Mejora en fachada</strong></h3>
<p>Elije el tipo de aislamiento para la fachada</p></div>
			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_4">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_5  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_2">
				
				
				<div class="et_pb_code_inner"><div class="et_pb_column et_pb_column_1_3 et_pb_column_4  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_1">
				
				
				<span class="et_pb_image_wrap "><img src="https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_xps.png" alt="" title="" srcset="https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_xps.png 1242w, https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_xps-980x793.png 980w, https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_xps-480x388.png 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) and (max-width: 980px) 980px, (min-width: 981px) 1242px, 100vw" /></span>
			</div>
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_5  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_2">
				
				
				<span class="et_pb_image_wrap "><img src="https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps.png" alt="" title="" srcset="https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps.png 1220w, https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps-980x808.png 980w, https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps-480x396.png 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) and (max-width: 980px) 980px, (min-width: 981px) 1220px, 100vw" /></span>
			</div>
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_6  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_3">
				
				
				<span class="et_pb_image_wrap "><img src="https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps_grafito.png" alt="" title="" srcset="https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps_grafito.png 1259w, https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps_grafito-980x779.png 980w, https://www.danothermsate.com/wp-content/uploads/2020/11/danotherm_eps_grafito-480x382.png 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) and (max-width: 980px) 980px, (min-width: 981px) 1259px, 100vw" /></span>
			</div>
			</div> <!-- .et_pb_column -->
				
				



				<div class="et_pb_column et_pb_column_1_3 et_pb_column_7  et_pb_css_mix_blend_mode_passthrough">
				
				
				
			<div id="et_pb_contact_form_0" class="et_pb_module et_pb_contact_form_0 et_pb_contact_form_container clearfix" data-form_unique_num="0">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="#">
						<p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_half" data-id="field_1" data-type="select">
				
				
				<label for="et_pb_contact_field_1_0" class="et_pb_contact_form_label">Elige el espesor</label>
				<select id="et_pb_contact_field_1_0" class="et_pb_contact_select input" name="et_pb_contact_field_1_0" data-required_mark="required" data-field_type="select" data-original_id="field_1" onchange="um_fs(this.value)">
<option value="">Elige el espesor</option><option value="fachada_danopren_fs_40">40</option><option value="fachada_danopren_fs_50">50</option><option value="fachada_danopren_fs_60">60</option><option value="fachada_danopren_fs_70">70</option><option value="fachada_danopren_fs_80">80</option><option value="fachada_danopren_fs_90">90</option><option value="fachada_danopren_fs_100">100</option><option value="fachada_danopren_fs_110">110</option><option value="fachada_danopren_fs_120">120</option><option value="fachada_danopren_fs_130">130</option><option value="fachada_danopren_fs_140">140</option><option value="fachada_danopren_fs_150">150</option><option value="fachada_danopren_fs_160">160</option>
					</select>
			</p> 
            
						
					</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column -->
			
			
			<div class="et_pb_column et_pb_column_1_3 et_pb_column_8  et_pb_css_mix_blend_mode_passthrough">
			
					
			<div id="et_pb_contact_form_0" class="et_pb_module et_pb_contact_form_0 et_pb_contact_form_container clearfix" data-form_unique_num="0">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="#">
						<p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_half" data-id="field_2" data-type="select">
				
				
				<label for="et_pb_contact_field_1_0" class="et_pb_contact_form_label">Elige el espesor</label>
				<select id="et_pb_contact_field_1_0" class="et_pb_contact_select input" name="et_pb_contact_field_1_0" data-required_mark="required" data-field_type="select" data-original_id="field_1" onchange="um_eps(this.value)">
<option value="">Elige el espesor</option><option value="fachada_danotherm_eps_40">40</option><option value="fachada_danotherm_eps_50">50</option><option value="fachada_danotherm_eps_60">60</option><option value="fachada_danotherm_eps_70">70</option><option value="fachada_danotherm_eps_80">80</option><option value="fachada_danotherm_eps_90">90</option><option value="fachada_danotherm_eps_100">100</option><option value="fachada_danotherm_eps_110">110</option><option value="fachada_danotherm_eps_120">120</option><option value="fachada_danotherm_eps_130">130</option><option value="fachada_danotherm_eps_140">140</option><option value="fachada_danotherm_eps_150">150</option><option value="fachada_danotherm_eps_160">160</option>

					</select>
			</p> 
						
					</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column -->
			
			
		
			
			<div class="et_pb_column et_pb_column_1_3 et_pb_column_9  et_pb_css_mix_blend_mode_passthrough et-last-child">
			
			<div id="et_pb_contact_form_0" class="et_pb_module et_pb_contact_form_0 et_pb_contact_form_container clearfix" data-form_unique_num="0">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="#">
						<p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_half" data-id="field_3" data-type="select">
				
				
				<label for="et_pb_contact_field_1_0" class="et_pb_contact_form_label">Elige el espesor</label>
				<select id="et_pb_contact_field_1_0" class="et_pb_contact_select input" name="et_pb_contact_field_1_0" data-required_mark="required" data-field_type="select" data-original_id="field_1" onchange="um_epsg(this.value)">
<option value="">Elige el espesor</option><option value="fachada_danotherm_epsg_40">40</option><option value="fachada_danotherm_epsg_50">50</option><option value="fachada_danotherm_epsg_60">60</option><option value="fachada_danotherm_epsg_70">70</option><option value="fachada_danotherm_epsg_80">80</option><option value="fachada_danotherm_epsg_90">90</option><option value="fachada_danotherm_epsg_100">100</option><option value="fachada_danotherm_epsg_110">110</option><option value="fachada_danotherm_epsg_120">120</option><option value="fachada_danotherm_epsg_130">130</option><option value="fachada_danotherm_epsg_140">140</option><option value="fachada_danotherm_epsg_150">150</option><option value="fachada_danotherm_epsg_160">160</option>
					</select>
			</p> 
						
					</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column --></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_5">
				<div class="et_pb_column et_pb_column_1_3 et_pb_column_6  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_3">
				
				
				<div class="et_pb_code_inner"><div id="um_danopren_fs">
  <p id="p_um_danopren_fs"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_7  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_4">
				
				
				<div class="et_pb_code_inner"><div id="um_danotherm_eps">
  <p id="p_um_danotherm_eps"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_8  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_5">
				
				
				<div class="et_pb_code_inner"><div id="um_danotherm_epsg">
  <p id="p_um_danotherm_epsg"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_6">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_9  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_text et_pb_text_2  et_pb_text_align_left et_pb_bg_layout_light">
				
				
				<div class="et_pb_text_inner"><p>Elije el tipo de ventanas</p></div>
			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_7">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_10  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_6">
				
				
				<div class="et_pb_code_inner"><div class="et_pb_column et_pb_column_1_3 et_pb_column_7  et_pb_css_mix_blend_mode_passthrough">
				
				
				
			<div id="et_pb_contact_form_0" class="et_pb_module et_pb_contact_form_0 et_pb_contact_form_container clearfix" data-form_unique_num="0">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="https://www.danothermsate.com/calculo-etiqueta/">
						<p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_last" data-id="ventanas" data-type="select">
				
				
				<label for="et_pb_contact_ventanas_0" class="et_pb_contact_form_label">Elija el tipo de ventanas</label>
				<select id="et_pb_contact_ventanas_0" class="et_pb_contact_select input" name="et_pb_contact_ventanas_0" data-required_mark="required" data-field_type="select" data-original_id="ventanas" onchange="umv_fs(this.value)">
<option value="">Elija el tipo de ventanas</option><option value="ventanas0">Sin cambios</option><option value="ventanas1">Metal con rotura PT y 4/16/4</option><option value="ventanas2">PVC con 4/16/4</option><option value="ventanas3">Metal con rotura PT y 4/16/4 y bajo-emisivo</option><option value="ventanas4">PVC con 4/16/4 y bajo-emisivo</option>
					</select>
			</p> 
			</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column -->
			
			
			<div class="et_pb_column et_pb_column_1_3 et_pb_column_8  et_pb_css_mix_blend_mode_passthrough">
			
					
			<div id="et_pb_contact_form_0" class="et_pb_module et_pb_contact_form_0 et_pb_contact_form_container clearfix" data-form_unique_num="0">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="https://www.danothermsate.com/calculo-etiqueta/">
						<p class="et_pb_contact_field et_pb_contact_field_1 et_pb_contact_field_last" data-id="ventanas" data-type="select">
				
				
				<label for="et_pb_contact_ventanas_1" class="et_pb_contact_form_label">Elija el tipo de ventanas</label>
				<select id="et_pb_contact_ventanas_1" class="et_pb_contact_select input" name="et_pb_contact_ventanas_1" data-required_mark="required" data-field_type="select" data-original_id="ventanas" onchange="umv_eps(this.value)">
<option value="">Elija el tipo de ventanas</option><option value="ventanas0">Sin cambios</option><option value="ventanas1">Metal con rotura PT y 4/16/4</option><option value="ventanas2">PVC con 4/16/4</option><option value="ventanas3">Metal con rotura PT y 4/16/4 y bajo-emisivo</option><option value="ventanas4">PVC con 4/16/4 y bajo-emisivo</option>
					</select>
			</p> 
			</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column -->
			
			
		
			
			<div class="et_pb_column et_pb_column_1_3 et_pb_column_9  et_pb_css_mix_blend_mode_passthrough et-last-child">
			
			<div id="et_pb_contact_form_0" class="et_pb_module et_pb_contact_form_0 et_pb_contact_form_container clearfix" data-form_unique_num="0">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="https://www.danothermsate.com/calculo-etiqueta/">
						<p class="et_pb_contact_field et_pb_contact_field_2 et_pb_contact_field_last" data-id="ventanas" data-type="select">
				
				
				<label for="et_pb_contact_ventanas_2" class="et_pb_contact_form_label">Elija el tipo de ventanas</label>
				<select id="et_pb_contact_ventanas_2" class="et_pb_contact_select input" name="et_pb_contact_ventanas_2" data-required_mark="required" data-field_type="select" data-original_id="ventanas" onchange="umv_epsg(this.value)">
<option value="">Elija el tipo de ventanas</option><option value="ventanas0">Sin cambios</option><option value="ventanas1">Metal con rotura PT y 4/16/4</option><option value="ventanas2">PVC con 4/16/4</option><option value="ventanas3">Metal con rotura PT y 4/16/4 y bajo-emisivo</option><option value="ventanas4">PVC con 4/16/4 y bajo-emisivo</option>
					</select>
			</p> 
			</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column --></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_8">
				<div class="et_pb_column et_pb_column_1_3 et_pb_column_11  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_7">
				
				
				<div class="et_pb_code_inner"><div id="umv_danopren_fs">
  <p id="p_umv_danopren_fs"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_12  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_8">
				
				
				<div class="et_pb_code_inner"><div id="umv_danotherm_eps">
  <p id="p_umv_danotherm_eps"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_13  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_9">
				
				
				<div class="et_pb_code_inner"><div id="umv_danotherm_epsg">
  <p id="p_umv_danotherm_epsg"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_9">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_14  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_10">
				
				
				<div class="et_pb_code_inner"><div id="mostrar_cubierta">
  
				<div class="et_pb_column et_pb_column_1_3 et_pb_column_17  et_pb_css_mix_blend_mode_passthrough">
				
				
				
			<div id="et_pb_contact_form_0" class="et_pb_module et_pb_contact_form_0 et_pb_contact_form_container clearfix" data-form_unique_num="0">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="https://www.danothermsate.com/calculo-etiqueta/">
						<p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_last" data-id="field_4" data-type="radio">
				
				
				<label for="et_pb_contact_field_4_0" class="et_pb_contact_form_label">Mejoras en cubierta</label>
				<span class="et_pb_contact_field_options_wrapper">
						<span class="et_pb_contact_field_options_title">Mejoras en cubierta</span>
						<span class="et_pb_contact_field_options_list"><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_0_0_0" class="input" value="Sin mejoras" name="et_pb_contact_field_4_0" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="-1" onchange="sm_xps();">
								<label for="et_pb_contact_field_4_0_0_0"><i></i>Sin mejoras</label>
							</span><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_0_0_1" class="input" value="Danolosa" name="et_pb_contact_field_4_0" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="0">
								<label for="et_pb_contact_field_4_0_0_1"><i></i>Danolosa</label>
							</span><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_0_0_2" class="input" value="Danopren" name="et_pb_contact_field_4_0" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="1">
								<label for="et_pb_contact_field_4_0_0_2"><i></i>Danopren</label>
							</span></span>
					</span>
			</p> <p class="et_pb_contact_field et_pb_contact_field_1 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danolosa&quot;]]" data-conditional-relation="any" data-id="field_2" data-type="select">
				
				
				<label for="et_pb_contact_field_2_0" class="et_pb_contact_form_label">Elige el espesor para Danolosa</label>
				<select id="et_pb_contact_field_2_0" class="et_pb_contact_select input" name="et_pb_contact_field_2_0" data-required_mark="required" data-field_type="select" data-original_id="field_2" onchange="umc_fs(this.value)">
<option value="">Elige la Danolosa</option><option value="DANOLOSA_75">Danolosa 75</option><option value="DANOLOSA_85">Danolosa 85</option><option value="DANOLOSA_95">Danolosa 95</option>
					</select>
			</p> <p class="et_pb_contact_field et_pb_contact_field_2 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danopren&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="select">
				
				
				<label for="et_pb_contact_field_3_0" class="et_pb_contact_form_label">Elige espesor para Danopren TR</label>
				<select id="et_pb_contact_field_3_0" class="et_pb_contact_select input" name="et_pb_contact_field_3_0" data-required_mark="required" data-field_type="select" data-original_id="field_3" onchange="umc_fs(this.value)">
<option value="">Elige espesor para Danopren TR</option><option value="DANOPREN_TR_40">40</option><option value="DANOPREN_TR_50">50</option><option value="DANOPREN_TR_60">60</option><option value="DANOPREN_TR_70">70</option><option value="DANOPREN_TR_80">80</option><option value="DANOPREN_TR_80">90</option><option value="DANOPREN_TR_100">100</option><option value="DANOPREN_TR_110">110</option><option value="DANOPREN_TR_120">120</option><option value="DANOPREN_TR_130">130</option><option value="DANOPREN_TR_140">140</option><option value="DANOPREN_TR_150">150</option><option value="DANOPREN_TR_160">160</option><option value="DANOPREN_TR_170">170</option><option value="DANOPREN_TR_180">180</option><option value="DANOPREN_TR_190">190</option><option value="DANOPREN_TR_200">200</option>
					</select>
			</p> 
						</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_18  et_pb_css_mix_blend_mode_passthrough">
				
				
				
			<div id="et_pb_contact_form_1" class="et_pb_module et_pb_contact_form_1 et_pb_contact_form_container clearfix" data-form_unique_num="1">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="https://www.danothermsate.com/calculo-etiqueta/">
						<p class="et_pb_contact_field et_pb_contact_field_3 et_pb_contact_field_last" data-id="field_4" data-type="radio">
				
				
				<label for="et_pb_contact_field_4_1" class="et_pb_contact_form_label">Mejoras en cubierta</label>
				<span class="et_pb_contact_field_options_wrapper">
						<span class="et_pb_contact_field_options_title">Mejoras en cubierta</span>
						<span class="et_pb_contact_field_options_list"><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_1_3_0" class="input" value="Sin mejoras" name="et_pb_contact_field_4_1" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="-1" onchange="sm_eps();">
								<label for="et_pb_contact_field_4_1_3_0"><i></i>Sin mejoras</label>
							</span><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_1_3_1" class="input" value="Danolosa" name="et_pb_contact_field_4_1" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="0">
								<label for="et_pb_contact_field_4_1_3_1"><i></i>Danolosa</label>
							</span><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_1_3_2" class="input" value="Danopren" name="et_pb_contact_field_4_1" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="1">
								<label for="et_pb_contact_field_4_1_3_2"><i></i>Danopren</label>
							</span></span>
					</span>
			</p> <p class="et_pb_contact_field et_pb_contact_field_4 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danolosa&quot;]]" data-conditional-relation="any" data-id="field_2" data-type="select">
				
				
				<label for="et_pb_contact_field_2_1" class="et_pb_contact_form_label">Elige el espesor para Danolosa</label>
				<select id="et_pb_contact_field_2_1" class="et_pb_contact_select input" name="et_pb_contact_field_2_1" data-required_mark="required" data-field_type="select" data-original_id="field_2" onchange="umc_eps(this.value)">
<option value="">Elige el espesor para Danolosa</option><option value="DANOLOSA_75">Danolosa 75</option><option value="DANOLOSA_85">Danolosa 85</option><option value="DANOLOSA_95">Danolosa 95</option>
					</select>
			</p> <p class="et_pb_contact_field et_pb_contact_field_5 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danopren&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="select">
				
				
				<label for="et_pb_contact_field_3_1" class="et_pb_contact_form_label">Elige espesor para Danopren TR</label>
				<select id="et_pb_contact_field_3_1" class="et_pb_contact_select input" name="et_pb_contact_field_3_1" data-required_mark="required" data-field_type="select" data-original_id="field_3" onchange="umc_eps(this.value)">
<option value="">Elige espesor para Danopren TR</option><option value="DANOPREN_TR_40">40</option><option value="DANOPREN_TR_50">50</option><option value="DANOPREN_TR_60">60</option><option value="DANOPREN_TR_70">70</option><option value="DANOPREN_TR_80">80</option><option value="DANOPREN_TR_80">90</option><option value="DANOPREN_TR_100">100</option><option value="DANOPREN_TR_110">110</option><option value="DANOPREN_TR_120">120</option><option value="DANOPREN_TR_130">130</option><option value="DANOPREN_TR_140">140</option><option value="DANOPREN_TR_150">150</option><option value="DANOPREN_TR_160">160</option><option value="DANOPREN_TR_170">170</option><option value="DANOPREN_TR_180">180</option><option value="DANOPREN_TR_190">190</option><option value="DANOPREN_TR_200">200</option>
					</select>
			</p> 
					</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_19  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				
			<div id="et_pb_contact_form_2" class="et_pb_module et_pb_contact_form_2 et_pb_contact_form_container clearfix" data-form_unique_num="2">
				
				
				
				<div class="et-pb-contact-message"></div>
				
				<div class="et_pb_contact">
					<form class="et_pb_contact_form clearfix" method="post" action="https://www.danothermsate.com/calculo-etiqueta/">
						<p class="et_pb_contact_field et_pb_contact_field_6 et_pb_contact_field_last" data-id="field_4" data-type="radio">
				
				
				<label for="et_pb_contact_field_4_2" class="et_pb_contact_form_label">Mejoras en cubierta</label>
				<span class="et_pb_contact_field_options_wrapper">
						<span class="et_pb_contact_field_options_title">Mejoras en cubierta</span>
						<span class="et_pb_contact_field_options_list"><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_2_6_0" class="input" value="Sin mejoras" name="et_pb_contact_field_4_2" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="-1" onchange="sm_epsg();">
								<label for="et_pb_contact_field_4_2_6_0"><i></i>Sin mejoras</label>
							</span><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_2_6_1" class="input" value="Danolosa" name="et_pb_contact_field_4_2" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="0">
								<label for="et_pb_contact_field_4_2_6_1"><i></i>Danolosa</label>
							</span><span class="et_pb_contact_field_radio">
								<input type="radio" id="et_pb_contact_field_4_2_6_2" class="input" value="Danopren" name="et_pb_contact_field_4_2" data-required_mark="required" data-field_type="radio" data-original_id="field_4"  data-id="1">
								<label for="et_pb_contact_field_4_2_6_2"><i></i>Danopren</label>
							</span></span>
					</span>
			</p> <p class="et_pb_contact_field et_pb_contact_field_7 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danolosa&quot;]]" data-conditional-relation="any" data-id="field_2" data-type="select">
				
				
				<label for="et_pb_contact_field_2_2" class="et_pb_contact_form_label">Elige el espesor para Danolosa</label>
				<select id="et_pb_contact_field_2_2" class="et_pb_contact_select input" name="et_pb_contact_field_2_2" data-required_mark="required" data-field_type="select" data-original_id="field_2" onchange="umc_epsg(this.value)">
<option value="">Elige el espesor para Danolosa</option><option value="DANOLOSA_75">Danolosa 75</option><option value="DANOLOSA_85">Danolosa 85</option><option value="DANOLOSA_95">Danolosa 95</option>
					</select>
			</p> <p class="et_pb_contact_field et_pb_contact_field_8 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danopren&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="select">
				
				
				<label for="et_pb_contact_field_3_2" class="et_pb_contact_form_label">Elige espesor para Danopren TR</label>
				<select id="et_pb_contact_field_3_2" class="et_pb_contact_select input" name="et_pb_contact_field_3_2" data-required_mark="required" data-field_type="select" data-original_id="field_3" onchange="umc_epsg(this.value)">
<option value="">Elige espesor para Danopren TR</option><option value="DANOPREN_TR_40">40</option><option value="DANOPREN_TR_50">50</option><option value="DANOPREN_TR_60">60</option><option value="DANOPREN_TR_70">70</option><option value="DANOPREN_TR_80">80</option><option value="DANOPREN_TR_80">90</option><option value="DANOPREN_TR_100">100</option><option value="DANOPREN_TR_110">110</option><option value="DANOPREN_TR_120">120</option><option value="DANOPREN_TR_130">130</option><option value="DANOPREN_TR_140">140</option><option value="DANOPREN_TR_150">150</option><option value="DANOPREN_TR_160">160</option><option value="DANOPREN_TR_170">170</option><option value="DANOPREN_TR_180">180</option><option value="DANOPREN_TR_190">190</option><option value="DANOPREN_TR_200">200</option>
					</select>
			</p> 
						</form>
				</div> <!-- .et_pb_contact -->
			</div> <!-- .et_pb_contact_form_container -->
			
			</div> <!-- .et_pb_column -->
				</div><!-- mostrar cubierta-->
				
			</div> <!-- .et_pb_row --></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_10">
				<div class="et_pb_column et_pb_column_1_3 et_pb_column_15  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_11">
				
				
				<div class="et_pb_code_inner"><div id="umc_danopren_fs">
  <p id="p_umc_danopren_fs"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_16  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_12">
				
				
				<div class="et_pb_code_inner"><div id="umc_danotherm_eps">
  <p id="p_umc_danotherm_eps"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_17  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_13">
				
				
				<div class="et_pb_code_inner"><div id="umc_danotherm_epsg">
  <p id="p_umc_danotherm_epsg"></p> 
</div></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_11">
				<div class="et_pb_column et_pb_column_1_3 et_pb_column_18  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_14">
				
				
				<div class="et_pb_code_inner"><div id="r_danopren_fs">
  <p id="p_r_danopren_fs"></p> 
</div>
<script>
caletixps();
</script></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_19  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_15">
				
				
				<div class="et_pb_code_inner"><div id="r_danotherm_eps">
  <p id="p_r_danotherm_eps"></p> 
</div>
<script>
caletieps();
</script></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_20  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_code et_pb_code_16">
				
				
				<div class="et_pb_code_inner"><div id="r_danotherm_epsg">
  <p id="p_r_danotherm_epsg"></p> 
</div>
<script>
caletiepsg();
</script></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_12">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_21  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_text et_pb_text_3  et_pb_text_align_left et_pb_bg_layout_light">
				
				
				<div class="et_pb_text_inner"><p><i>«La información proporcionada se ofrece a título estimativo como ayuda al usuario o propietario del edificio o vivienda, pero ni es ni puede sustituir al conjunto de cálculos y comprobaciones que la dirección técnica del proyecto de rehabilitación energética deberá llevar a cabo para justificar el cumplimiento de la reglamentación técnica vigente y de aplicación al proyecto, como puede ser la reglamentaria certificación energética del edificio o vivienda»</i></p></div>
			</div> <!-- .et_pb_text --><div class="et_pb_module et_pb_text et_pb_text_4  et_pb_text_align_left et_pb_bg_layout_light">
				
				
				<div class="et_pb_text_inner"><h3>Consulta aquí las ayudas disponibles</h3>
<p>
<strong><a href="https://www.idae.es/" target="_blank" rel="noopener noreferrer">https://www.idae.es/</a></strong></div>
			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_13">
				<div class="et_pb_column et_pb_column_1_3 et_pb_column_22  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_1">
				
				
				<span class="et_pb_image_wrap "><img src="https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica.jpg" alt="" title="" srcset="https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica.jpg 500w, https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica-480x360.jpg 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 500px, 100vw" /></span>
			</div>
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_23  et_pb_css_mix_blend_mode_passthrough">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_2">
				
				
				<span class="et_pb_image_wrap "><img src="https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica.jpg" alt="" title="" srcset="https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica.jpg 500w, https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica-480x360.jpg 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 500px, 100vw" /></span>
			</div>
			</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_3 et_pb_column_24  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_image et_pb_image_3">
				
				
				<span class="et_pb_image_wrap "><img src="https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica.jpg" alt="" title="" srcset="https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica.jpg 500w, https://www.danothermsate.com/wp-content/uploads/2021/02/calificacion-energetica-480x360.jpg 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 500px, 100vw" /></span>
			</div>
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row -->
			
			<div class="et_pb_row et_pb_row_14">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_25  et_pb_css_mix_blend_mode_passthrough et-last-child">
				
				
				<div class="et_pb_module et_pb_text et_pb_text_5  et_pb_text_align_left et_pb_bg_layout_light">
				
				
			<?php if($contact_link !=""){ ?>	<div class="et_pb_text_inner"><h3>Para más información póngase en <a href="<?=$contact_link?>" target="_blank">contacto con nosotros</a></h3></div><?php } ?> 
			</div> <!-- .et_pb_text --><div class="et_pb_module et_pb_code et_pb_code_17">
				
				
				<div class="et_pb_code_inner"><script>
muestro_cubierta();
</script></div>
			</div> <!-- .et_pb_code -->
			</div> <!-- .et_pb_column -->
				
				
			</div> <!-- .et_pb_row --><div class="et_pb_row et_pb_row_15">

			
				
				
			</div> <!-- .et_pb_row -->
				
				
			</div> <!-- .et_pb_section -->		</div><!-- .et_builder_inner_content -->
	</div><!-- .et-l -->
	
			
		</div><!-- #et-boc -->
							</div> <!-- .entry-content -->

				
				</article> <!-- .et_pb_post -->

			

</div> <!-- #main-content -->