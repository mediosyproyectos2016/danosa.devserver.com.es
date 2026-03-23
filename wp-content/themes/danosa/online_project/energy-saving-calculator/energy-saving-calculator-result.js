var ano_construccion = localStorage.getItem("ano_construccion");
var m_ano = localStorage.getItem("m_ano");
 
 
var zc_capital = localStorage.getItem("zc_capital");
var altitud_capital = localStorage.getItem("altitud_capital");
var altitud_localidad = localStorage.getItem("altitud_localidad");

var zc = localStorage.getItem("zc");
var tipo_vivienda = localStorage.getItem("tipo_vivienda");
var mts_vivienda = localStorage.getItem("mts_vivienda");
var tipo_energia = localStorage.getItem("tipo_energia");
var U_envolvente_fachadas = localStorage.getItem("U_envolvente_fachadas");
var U_envolvente_ventanas = localStorage.getItem("U_envolvente_ventanas");
var U_envolvente_cubiertas = localStorage.getItem("U_envolvente_cubiertas");
var vum_fs = U_envolvente_fachadas;
var vum_eps = U_envolvente_fachadas;
var vum_epsg = U_envolvente_fachadas;
var vumv_fs = U_envolvente_ventanas;
var vumv_eps = U_envolvente_ventanas;
var vumv_epsg = U_envolvente_ventanas;
var vumc_fs = U_envolvente_cubiertas;
var vumc_eps = U_envolvente_cubiertas;
var vumc_epsg = U_envolvente_cubiertas;

var pp_fachada = 0.0;
var pp_ventanas = 0.0;
var pp_cubierta = 0.0;

var bloqueu = ["Bloque plurifamiliar - piso bajo cubierta", "0.599", "0.1", "1"];
var bloquei = ["Bloque plurifamiliar - piso intermedio", "0.599", "0.1", "0"];
var adosada = ["Adosado", "0.70", "0.15", "0.504"];
var pareada = ["Pareado", "0.80", "0.15", "0.504"];
var independiente = ["Independiente", "1.008", "0.20", "0.693"];

var vne_inicial = 0.0;

function datos_envolvente() {
    pp_fachada = eval(tipo_vivienda)[1] * mts_vivienda;
    pp_ventanas = eval(tipo_vivienda)[2] * pp_fachada;
    pp_cubierta = eval(tipo_vivienda)[3] * mts_vivienda;
    tipo_vivienda = eval(tipo_vivienda)[0];

}

function ne_inicial() {
    vne_inicial = ((U_envolvente_fachadas * pp_fachada) + (U_envolvente_ventanas * pp_ventanas) + (U_envolvente_cubiertas * pp_cubierta)) * 3.624;
}

var mensa = "";

var mensa2 = "";

var fachada_danopren_fs_40 = ["40", "0.034", "0.67", "0.57", "0.52", "0.4"];
var fachada_danopren_fs_50 = ["50", "0.034", "0.56", "0.49", "0.45", "0.36"];
var fachada_danopren_fs_60 = ["60", "0.034", "0.48", "0.43", "0.4", "0.32"];
var fachada_danopren_fs_70 = ["70", "0.036", "0.44", "0.4", "0.37", "0.31"];
var fachada_danopren_fs_80 = ["80", "0.036", "0.39", "0.36", "0.34", "0.28"];
var fachada_danopren_fs_90 = ["90", "0.037", "0.36", "0.33", "0.32", "0.27"];
var fachada_danopren_fs_100 = ["100", "0.037", "0.33", "0.3", "0.29", "0.25"];
var fachada_danopren_fs_110 = ["110", "0.034", "0.28", "0.26", "0.25", "0.22"];
var fachada_danopren_fs_120 = ["120", "0.034", "0.26", "0.24", "0.23", "0.21"];
var fachada_danopren_fs_130 = ["130", "0.036", "0.25", "0.24", "0.23", "0.2"];
var fachada_danopren_fs_140 = ["140", "0.036", "0.24", "0.22", "0.22", "0.19"];
var fachada_danopren_fs_150 = ["150", "0.036", "0.22", "0.21", "0.20", "0.18"];
var fachada_danopren_fs_160 = ["160", "0.036", "0.21", "0.20", "0.19", "0.17"];

var fachada_danotherm_eps_40 = ["40", "0.036", "0.7", "0.59", "0.54", "0.41"];
var fachada_danotherm_eps_50 = ["50", "0.036", "0.59", "0.51", "0.47", "0.37"];
var fachada_danotherm_eps_60 = ["60", "0.036", "0.51", "0.45", "0.42", "0.33"];
var fachada_danotherm_eps_70 = ["70", "0.036", "0.44", "0.4", "0.37", "0.31"];
var fachada_danotherm_eps_80 = ["80", "0.036", "0.39", "0.36", "0.34", "0.28"];
var fachada_danotherm_eps_90 = ["90", "0.036", "0.36", "0.33", "0.31", "0.26"];
var fachada_danotherm_eps_100 = ["100", "0.036", "0.32", "0.3", "0.28", "0.24"];
var fachada_danotherm_eps_110 = ["110", "0.036", "0.30", "0.28", "0.26", "0.23"];
var fachada_danotherm_eps_120 = ["120", "0.036", "0.27", "0.26", "0.25", "0.21"];
var fachada_danotherm_eps_130 = ["130", "0.036", "0.25", "0.24", "0.23", "0.2"];
var fachada_danotherm_eps_140 = ["140", "0.036", "0.24", "0.22", "0.22", "0.19"];
var fachada_danotherm_eps_150 = ["150", "0.036", "0.22", "0.21", "0.20", "0.18"];
var fachada_danotherm_eps_160 = ["160", "0.036", "0.21", "0.20", "0.19", "0.17"];

var fachada_danotherm_epsg_40 = ["40", "0.031", "0.62", "0.54", "0.49", "0.38"];
var fachada_danotherm_epsg_50 = ["50", "0.031", "0.52", "0.46", "0.42", "0.34"];
var fachada_danotherm_epsg_60 = ["60", "0.031", "0.45", "0.40", "0.37", "0.31"];
var fachada_danotherm_epsg_70 = ["70", "0.031", "0.39", "0.35", "0.33", "0.28"];
var fachada_danotherm_epsg_80 = ["80", "0.031", "0.35", "0.32", "0.30", "0.26"];
var fachada_danotherm_epsg_90 = ["90", "0.031", "0.31", "0.29", "0.27", "0.24"];
var fachada_danotherm_epsg_100 = ["100", "0.031", "0.28", "0.26", "0.25", "0.22"];
var fachada_danotherm_epsg_110 = ["110", "0.031", "0.26", "0.24", "0.23", "0.20"];
var fachada_danotherm_epsg_120 = ["120", "0.031", "0.24", "0.22", "0.22", "0.19"];
var fachada_danotherm_epsg_130 = ["130", "0.031", "0.22", "0.21", "0.2", "0.18"];
var fachada_danotherm_epsg_140 = ["140", "0.031", "0.21", "0.20", "0.19", "0.17"];
var fachada_danotherm_epsg_150 = ["150", "0.031", "0.19", "0.18", "0.18", "0.16"];
var fachada_danotherm_epsg_160 = ["160", "0.031", "0.18", "0.17", "0.17", "0.15"];

var ventanas0 = ["0", "Ningún cambio en ventanas", "5", "4", "3", "1.7"];
var ventanas1 = ["1", "Metal con rotura PT y 4/16/4", "2.3", "2.3", "2.3", "1.7"];
var ventanas2 = ["2", "PVC con 4/16/4", "2.2", "2.2", "2.2", "1.7"];
var ventanas3 = ["3", "Metal con rotura PT y 4/16/4 y bajo-emisivo", "1.7", "1.7", "1.7", "1.7"];
var ventanas4 = ["4", "PVC con 4/16/4 y bajo-emisivo", "1.4", "1.4", "1.4", "1.4"];

var DANOPREN_TR_40 = ["40", "0.034", "0.61", "0.61", "0.44", "0.28"];
var DANOPREN_TR_50 = ["50", "0.034", "0.51", "0.51", "0.39", "0.26"];
var DANOPREN_TR_60 = ["60", "0.034", "0.45", "0.45", "0.35", "0.24"];
var DANOPREN_TR_70 = ["70", "0.036", "0.41", "0.41", "0.33", "0.23"];
var DANOPREN_TR_80 = ["80", "0.036", "0.37", "0.37", "0.3", "0.22"];
var DANOPREN_TR_90 = ["90", "0.037", "0.34", "0.34", "0.28", "0.21"];
var DANOPREN_TR_100 = ["100", "0.037", "0.31", "0.31", "0.26", "0.19"];
var DANOPREN_TR_110 = ["110", "0.034", "0.27", "0.27", "0.23", "0.18"];
var DANOPREN_TR_120 = ["120", "0.034", "0.25", "0.25", "0.22", "0.17"];
var DANOPREN_TR_130 = ["130", "0.036", "0.24", "0.24", "0.21", "0.17"];
var DANOPREN_TR_140 = ["140", "0.036", "0.23", "0.23", "0.20", "0.16"];
var DANOPREN_TR_150 = ["150", "0.036", "0.22", "0.22", "0.19", "0.15"];
var DANOPREN_TR_160 = ["160", "0.036", "0.20", "0.20", "0.18", "0.15"];
var DANOPREN_TR_170 = ["170", "0.037", "0.20", "0.20", "0.18", "0.14"];
var DANOPREN_TR_180 = ["180", "0.037", "0.19", "0.19", "0.17", "0.14"];
var DANOPREN_TR_190 = ["190", "0.037", "0.18", "0.18", "0.16", "0.13"];
var DANOPREN_TR_200 = ["200", "0.037", "0.17", "0.17", "0.15", "0.13"];

var DANOLOSA_75 = ["40", "0.034", "0.61", "0.61", "0.44", "0.28"];
var DANOLOSA_85 = ["50", "0.034", "0.51", "0.51", "0.39", "0.26"];
var DANOLOSA_95 = ["60", "0.034", "0.45", "0.45", "0.35", "0.24"];

window.onload = datos_iniciales();

function datos_iniciales() {

    datos_envolvente();

    ne_inicial();

    var mensa2 = '<ul>';
    mensa2 += '<li>Año de costrucción: <strong>' + ano_construccion + '</strong></li> ';
    /*
    mensa +='<table border=1><tr><td>Fachadas</td><td>Ventanas</td><td>Cubierta</td></tr>';
    mensa +='<tr><td>U (W/m<sup>2</sup>K) ' + ano_construccion + '</td><td>U (W/m<sup>2</sup>K) ' + ano_construccion + '</td><td>U (W/m<sup>2</sup>K) ' + ano_construccion + '</td></tr>';
    mensa +='<tr><td>' + U_envolvente_fachadas + '</td><td>' + U_envolvente_ventanas + '</td><td>' + U_envolvente_cubiertas + '</td></tr></table>';
    */

    var localidad = localStorage.getItem("localidad");
    if (localidad == "no") {

        mensa2 = '<li>Ubicación: <strong>' + localStorage.getItem("capital") + '</strong></li> ';
        mensa2 += '<li>Altitud: <strong>' + altitud_capital + '</strong></li> ';
        mensa2 += '<li>Zona climática: <strong>' + zc + '</strong></li> ';

    } else {
        mensa2 = '<li>Ubicación: <strong>' + localStorage.getItem("provincia") + '</strong></li> ';
        mensa2 += '<li>Altitud: <strong>' + altitud_localidad + '</strong></li> ';
        mensa2 += '<li>Zona climática: <strong>' + zc + '</strong></li> ';
    }

    mensa2 += '<li>Tipología de la vivienda: <strong>' + tipo_vivienda + '</strong></li> ';
    mensa2 += '<li>M<sup>2</sup> vivienda: <strong>' + mts_vivienda + '</strong></li> ';
    /*
    mensa2 +='<li>M<sup>2</sup> fachada (pp): <strong>' + pp_fachada + '</strong></li> ';
    mensa2 +='<li>M<sup>2</sup> ventanas (pp): <strong>' + pp_ventanas + '</strong></li> ';
    mensa2 +='<li>M<sup>2</sup> cubierta (pp): <strong>' + pp_cubierta + '</strong></li> ';
    */
    mensa2 += '<li>Tipo de energía: <strong>' + tipo_energia + '</strong></li> <br /><br />';

    //mensa2 += '<a style="font-size:1.2em;font-weight: bold;" href="https://www.danothermsate.com/calculadora-energetica/">MODIFICAR DATOS</a>';
    /*
    mensa2 +='<li><strong>NE<sub>inicial=  </sub>' + vne_inicial + '</strong></p> ';
    */

    mensa2 += '</ul>';

    //document.getElementById("txt_prueba").innerHTML = mensa;

    document.getElementById("ubicacion").innerHTML = mensa2;

}


/*U SEGUN REVESTIMIENTO*/



function um_fs(id) {
    vum_fs = (eval(id))[m_ano];
    var txtt = "U (W/m<sup>2</sup>K) DANOPREN FS " + id.replace('fachada_danopren_fs_', '') + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_um_danopren_fs").innerHTML = txtt;
    caletixps();


}



function um_eps(id) {
    vum_eps = (eval(id))[m_ano];
    var txtt = "U (W/m<sup>2</sup>K) DANOTHERM EPS " + id.replace('fachada_danotherm_eps_', '') + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_um_danotherm_eps").innerHTML = txtt;
    caletieps();
}



function um_epsg(id) {
    vum_epsg = (eval(id))[m_ano];
    var txtt = "U (W/m<sup>2</sup>K) DANOTHERM EPS grafito " + id.replace('fachada_danotherm_epsg_', '') + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_um_danotherm_epsg").innerHTML = txtt;
    caletiepsg();
}


/*U SEGUN VENTANA*/



function umv_fs(id) {
    vumv_fs = (eval(id))[m_ano];
    var txtt = "U (W/m<sup>2</sup>K) " + (eval(id))[1] + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_umv_danopren_fs").innerHTML = txtt;
    caletixps();

}



function umv_eps(id) {
    vumv_eps = (eval(id))[m_ano];
    var txtt = "U (W/m<sup>2</sup>K) " + (eval(id))[1] + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_umv_danotherm_eps").innerHTML = txtt;
    caletieps();
}



function umv_epsg(id) {
    vumv_epsg = (eval(id))[m_ano];
    var txtt = "U (W/m<sup>2</sup>K) " + (eval(id))[1] + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_umv_danotherm_epsg").innerHTML = txtt;
    caletiepsg();

}

/*U SEGUN CUBIERTA*/



function umc_fs(id) {
    vumc_fs = (eval(id))[m_ano];
    var dtr = id.replace('_', ' ');
    dtr = dtr.replace('_', ' ');

    var txtt = "U (W/m<sup>2</sup>K) " + dtr + ":   <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_umc_danopren_fs").innerHTML = txtt;
    caletixps();


}



function umc_eps(id) {
    vumc_eps = (eval(id))[m_ano];
    var dtr = id.replace('_', ' ');
    dtr = dtr.replace('_', ' ');

    var txtt = "U (W/m<sup>2</sup>K) " + dtr + ":    <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_umc_danotherm_eps").innerHTML = txtt;
    caletieps();
}



function umc_epsg(id) {
    vumc_epsg = (eval(id))[m_ano];
    var dtr = id.replace('_', ' ');
    dtr = dtr.replace('_', ' ');

    var txtt = "U (W/m<sup>2</sup>K)  " + dtr + ":    <STRONG>" + (eval(id))[m_ano] + "</STRONG>"
    document.getElementById("p_umc_danotherm_epsg").innerHTML = txtt;
    caletiepsg();
}


/*********************************/

function sm_xps() {
    vumc_fs = U_envolvente_cubiertas;
    var txtt = "Sin mejoras";
    document.getElementById("p_umc_danopren_fs").innerHTML = txtt;
    caletixps();
}

function sm_eps() {
    vumc_eps = U_envolvente_cubiertas;
    var txtt = "Sin mejoras";
    document.getElementById("p_umc_danotherm_eps").innerHTML = txtt;
    caletieps();
}

function sm_epsg() {
    vumc_epsg = U_envolvente_cubiertas;
    var txtt = "Sin mejoras";
    document.getElementById("p_umc_danotherm_epsg").innerHTML = txtt;
    caletiepsg();
}



var vne_mej_xps = 0.0;
var d_xps = "";
var p_mejora_xps = 0.0;

function caletixps() {
    /*
    vne inicial vne_inicial
    U SEGUN REVESTIMIENTO vum_fs
    U SEGUN VENTANA vumv_fs
    U SEGUN CUBIERTA vumc_fs
    */

    vne_mej_xps = ((vum_fs * pp_fachada) + (vumv_fs * pp_ventanas) + (vumc_fs * pp_cubierta)) * 3.624;

    p_mejora_xps = ((vne_inicial - vne_mej_xps) / vne_inicial) * 100;

    p_mejora_xps = p_mejora_xps.toFixed();

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
    d_xps = "";

    if (p_mejora_xps == 0) {
        d_xps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_xps + " %</strong><br /><br />";

    }

    if (p_mejora_xps > 0 && p_mejora_xps < 40) {

        d_xps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_xps + " %</strong><br /><br />";
        d_xps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion1.jpg'><br />";
        d_xps += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es improbable que se consiga la mejora de letra del certificado energético";
    }
    if (p_mejora_xps > 40 && p_mejora_xps < 70) {
        d_xps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_xps + " %</strong><br /><br />";
        d_xps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion2.jpg'><br />";
        d_xps += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta una letra del certificado energético";
    }
    if (p_mejora_xps > 70 && p_mejora_xps < 85) {
        d_xps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_xps + " %</strong><br /><br />";
        d_xps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion3.jpg'><br />";
        d_xps += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta dos letras del certificado energético";
    }
    if (p_mejora_xps > 85) {
        d_xps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_xps + " %</strong><br /><br />";
        d_xps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion4.jpg'><br />";
        d_xps += " Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta tres letras del certificado energético";
    }
    document.getElementById("p_r_danopren_fs").innerHTML = d_xps;


}

var vne_mej_eps = 0.0;
var d_eps = "";
var p_mejora_eps = 0.0;

function caletieps() {

    /*
    vne inicial vne_inicial
    U SEGUN REVESTIMIENTO vum_eps
    U SEGUN VENTANA vumv_eps
    U SEGUN CUBIERTA vumc_eps
    */

    vne_mej_eps = ((vum_eps * pp_fachada) + (vumv_eps * pp_ventanas) + (vumc_eps * pp_cubierta)) * 3.624;

    p_mejora_eps = ((vne_inicial - vne_mej_eps) / vne_inicial) * 100;

    p_mejora_eps = p_mejora_eps.toFixed();

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

    d_eps = "";
    if (p_mejora_eps == 0) {
        d_eps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_eps + " %</strong><br /><br />";

    }

    if (p_mejora_eps > 0 && p_mejora_eps < 40) {
        d_eps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_eps + " %</strong><br /><br />";
        d_eps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion1.jpg'><br />";
        d_eps += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es improbable que se consiga la mejora de letra del certificado energético";
    }
    if (p_mejora_eps > 40 && p_mejora_eps < 70) {
        d_eps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_eps + " %</strong><br /><br />";
        d_eps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion2.jpg'><br />";
        d_eps += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta una letra del certificado energético";
    }
    if (p_mejora_eps > 70 && p_mejora_eps < 85) {
        d_eps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_eps + " %</strong><br /><br />";
        d_eps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion3.jpg'><br />";
        d_eps += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta dos letras del certificado energético";
    }
    if (p_mejora_eps > 85) {
        d_eps = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_eps + " %</strong><br /><br />";
        d_eps += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion4.jpg'><br />";
        d_eps += " Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta tres letras del certificado energético";
    }

    document.getElementById("p_r_danotherm_eps").innerHTML = d_eps;

}

var vne_mej_epsg = 0.0;
var d_epsg = "";
var p_mejora_epsg = 0.0;

function caletiepsg() {

    /*
    vne inicial vne_inicial
    U SEGUN REVESTIMIENTO vum_epsg
    U SEGUN VENTANA vumv_epsg
    U SEGUN CUBIERTA vumc_epsg
    */

    vne_mej_epsg = ((vum_epsg * pp_fachada) + (vumv_epsg * pp_ventanas) + (vumc_epsg * pp_cubierta)) * 3.624;

    p_mejora_epsg = ((vne_inicial - vne_mej_epsg) / vne_inicial) * 100;

    p_mejora_epsg = p_mejora_epsg.toFixed();

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
    d_epsg = "";

    if (p_mejora_epsg == 0) {
        d_epsg = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_epsg + " %</strong><br /><br />";

    }

    if (p_mejora_epsg > 0 && p_mejora_epsg < 40) {
        d_epsg = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_epsg + " %</strong><br /><br />";
        d_epsg += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion1.jpg'><br />";
        d_epsg += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es improbable que se consiga la mejora de letra del certificado energético";
    }
    if (p_mejora_epsg > 40 && p_mejora_epsg < 70) {
        d_epsg = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_epsg + " %</strong><br /><br />";
        d_epsg += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion2.jpg'><br />";
        d_epsg += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta una letra del certificado energético";
    }
    if (p_mejora_epsg > 70 && p_mejora_epsg < 85) {
        d_epsg = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_epsg + " %</strong><br /><br />";
        d_epsg += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion3.jpg'><br />";
        d_epsg += "Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta dos letras del certificado energético";
    }
    if (p_mejora_epsg > 85) {
        d_epsg = "<strong>PORCENTAJE DE MEJORA : " + p_mejora_epsg + " %</strong><br /><br />";
        d_epsg += "<img src='https://danosa.myp.com.es/wp-content/themes/danosa/online_project/energy-saving-calculator/img/satisfacion4.jpg'><br />";
        d_epsg += " Con dicho porcentaje de reducción de las necesidades energéticas del edificio o vivienda es posible alcanzar una mejora de hasta tres letras del certificado energético";
    }

    document.getElementById("p_r_danotherm_epsg").innerHTML = d_epsg;

}

function muestro_cubierta() {
    if (tipo_vivienda == "Bloque plurifamiliar - piso intermedio") {
        var txtt = "";
        document.getElementById("mostrar_cubierta").innerHTML = txtt;
    }
}






jQuery('select').on('change', function() {
    var maxHeight = 0;
    var maxHeight1 = 0;
    var maxHeight2 = 0;
    var maxHeight3 = 0;
    var maxHeight4 = 0;

    jQuery(".result-form").each(function(){
       if (jQuery(this).height() > maxHeight) { maxHeight = jQuery(this).height(); }
    });

    jQuery(".result-form").css("min-height",maxHeight);

    jQuery(".result-form-1").each(function(){
       if (jQuery(this).height() > maxHeight1) { maxHeight1 = jQuery(this).height(); }
    });

    jQuery(".result-form-1").css("min-height",maxHeight1);

    jQuery(".result-form-2").each(function(){
       if (jQuery(this).height() > maxHeight2) { maxHeight2 = jQuery(this).height(); }
    });

    jQuery(".result-form-2").css("min-height",maxHeight2);

    jQuery(".result-form-3").each(function(){
       if (jQuery(this).height() > maxHeight3) { maxHeight3 = jQuery(this).height(); }
    });

    jQuery(".result-form-3").css("min-height",maxHeight3);

    jQuery(".result-form-4").each(function(){
       if (jQuery(this).height() > maxHeight4) { maxHeight4 = jQuery(this).height(); }
    });

    jQuery(".result-form-4").css("min-height",maxHeigh4t);
});