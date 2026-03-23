<?php
$link = get_permalink();
?>

<p>Rellena los campos siguientes</p>


<form class="et_pb_contact_form clearfix" method="post" action="<?=$link?>">

    <div class="wp-block-columns">
        <div class="wp-block-column" data-id="field_1" data-type="select">
			<label for="et_pb_contact_field_1_0" class="et_pb_contact_form_label">Año de construcción</label>
			<select id="et_pb_contact_field_1_0" class="et_pb_contact_select input" name="ano_construccion" required data-field_type="select" data-original_id="field_1" onchange="f_ano_construccion(this.value);">
				<option value="">Año de construcción</option>
				<option value="const_1960">Antes 1960</option>
				<option value="const_1961">1961-1980</option>
				<option value="const_1981">1981-2006</option>
				<option value="const_2007">A partir de 2007</option>
			</select>
        </div>
        <div class="wp-block-column" data-id="field_2" data-type="select">
			<label for="et_pb_contact_field_2_0" class="et_pb_contact_form_label">Provincia</label>
			<select id="et_pb_contact_field_2_0" class="et_pb_contact_select input" name="provincia" required data-field_type="select" data-original_id="field_2" onchange="zonas_climaticas(this.value);">
				<option value="">Elije provincia </option>
				<option value="Alava">Álava</option>
				<option value="Albacete">Albacete</option>
				<option value="Alicante">Alicante</option>
				<option value="Almeria">Almería</option>
				<option value="Asturias">Asturias</option>
				<option value="Avila">Avila</option>
				<option value="Badajoz">Badajoz</option>
				<option value="Baleares">Baleares</option>
				<option value="Barcelona">Barcelona</option>
				<option value="Bilbao">Bilbao</option>
				<option value="Burgos">Burgos</option>
				<option value="Caceres">Cáceres</option>
				<option value="Cadiz">Cádiz</option>
				<option value="Cantabria">Cantabria</option>
				<option value="Castellon">Castellón</option>
				<option value="Ceuta">Ceuta</option>
				<option value="Ciudad_Real">Ciudad Real</option>
				<option value="Cordoba">Córdoba</option>
				<option value="Coruna">Coruña (a)</option>
				<option value="Cuenca">Cuenca</option>
				<option value="Girona">Girona</option>
				<option value="Granada">Granada</option>
				<option value="Guadalajara">Guadalajara</option>
				<option value="Guipuzcoa">Guipúzcoa</option>
				<option value="Huelva">Huelva</option>
				<option value="Huesca">Huesca</option>
				<option value="Jaen">Jaén C</option>
				<option value="Leon">León</option>
				<option value="Lleida">Lleida</option>
				<option value="Lugo">Lugo</option>
				<option value="Madrid">Madrid</option>
				<option value="Malaga">Málaga</option>
				<option value="Melilla">Melilla</option>
				<option value="Murcia">Murcia</option>
				<option value="Navarra">Navarra</option>
				<option value="Ourense">Ourense</option>
				<option value="Palencia">Palencia</option>
				<option value="Las_Palmas">Las Palmas</option>
				<option value="Pontevedra">Pontevedra</option>
				<option value="La_Rioja">La Rioja</option>
				<option value="Salamanca">Salamanca</option>
				<option value="Segovia">Segovia</option>
				<option value="Sevilla">Sevilla</option>
				<option value="Soria">Soria</option>
				<option value="Tarragona">Tarragona</option>
				<option value="Tenerife">Tenerife</option>
				<option value="Teruel">Teruel</option>
				<option value="Toledo">Toledo</option>
				<option value="Valencia">Valencia</option>
				<option value="Valladolid">Valladolid</option>
				<option value="Zamora">Zamora</option>
				<option value="Zaragoza">Zaragoza</option>
			</select>
        </div>
    </div>

    <div class="wp-block-columns">
        <div class="wp-block-column" data-conditional-logic="[[&quot;field_2&quot;,&quot;is not empty&quot;,&quot;provincia1&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="radio">
			<label for="et_pb_contact_field_3_0" class="et_pb_contact_form_label">¿capital?</label>
			<span class="et_pb_contact_field_options_list">
				<span class="et_pb_contact_field_radio">
					<input type="radio" id="et_pb_contact_field_3_0_2_0" class="input" value="Capital de provincia" name="capital" data-required_mark="required" data-field_type="radio" data-original_id="field_3"  data-id="" onchange="calc_zc('cap')">
					<label for="et_pb_contact_field_3_0_2_0"><i></i>Capital de provincia</label>
				</span>
				<span class="et_pb_contact_field_radio">
					<input type="radio" id="et_pb_contact_field_3_0_2_1" class="input" value="Otra localidad" name="capital" data-required_mark="required" data-field_type="radio" data-original_id="field_3"  data-id="" onchange="localidades(this.value);">
					<label for="et_pb_contact_field_3_0_2_1"><i></i>Otra localidad</label>
				</span>
			</span>
        </div>
        <div class="wp-block-column" data-conditional-logic="[[&quot;field_3&quot;,&quot;is&quot;,&quot;Otra localidad&quot;]]" data-conditional-relation="any" data-id="field_4" data-type="input">
        	<label for="et_pb_contact_field_4_0" class="et_pb_contact_form_label">altitud</label>
			<input type="text" id="et_pb_contact_field_4_0" class="input" value="" name="altitud" required data-required_mark="required" data-field_type="input" data-original_id="field_4" placeholder="altitud" pattern="[0-9\s-]{1,4}" title="Sólo se permiten números.Longitud Mínima: 1 caracteres. Longitud Máxima: 4 caracteres." maxlength="4" onchange="calc_zc(this.value)">
        </div>
    </div>

    <div class="wp-block-columns">
        <div class="wp-block-column" data-id="field_5" data-type="select">
			<label for="et_pb_contact_field_5_0" class="et_pb_contact_form_label">Tipología de la vivienda</label>
			<select id="et_pb_contact_field_5_0" class="et_pb_contact_select input" name="tipo_vivienda" required data-required_mark="required" data-field_type="select" data-original_id="field_5" onchange="f_tipo_vivienda(this.value);">
				<option value="">Tipología de la vivienda</option>
				<option value="bloqueu">Bloque plurifamiliar (último piso)</option>
				<option value="bloquei">Bloque plurifamiliar (pisos intermedios o bajos)</option>
				<option value="adosada">Adosada</option><option value="pareada">Pareada</option>
				<option value="independiente">Independiente</option>
			</select>
        </div>
        <div class="wp-block-column" data-id="field_6" data-type="input">
			<label for="et_pb_contact_field_6_0" class="et_pb_contact_form_label">Metros cuadrados de la vivienda</label>
			<input type="text" id="et_pb_contact_field_6_0" class="input" value="" name="mts_vivienda" required data-required_mark="required" data-field_type="input" data-original_id="field_6" placeholder="Metros cuadrados de la vivienda" pattern="[0-9\s-]{2,3}" title="Sólo se permiten números.Longitud Mínima: 2 caracteres. Longitud Máxima: 3 caracteres." maxlength="3" onchange="f_mts_vivienda(this.value);">
        </div>
    </div>


    <div class="wp-block-columns">
        <div class="wp-block-column">
			<label for="et_pb_contact_field_6_0" class="et_pb_contact_form_label">Tipo de energía</label>
			<select id="et_pb_contact_field_6_0" class="et_pb_contact_select input" name="tipo_energia" required data-required_mark="required" data-field_type="select" data-original_id="field_6" onchange="f_tipo_energia(this.value)">
				<option value="">Tipo de energía</option>
				<option value="Eléctrica">Eléctrica</option>
				<option value="Gas">Gas</option>
				<option value="Gasoil">Gasoil</option>
				<option value="Biomasa">Biomasa</option>
			</select>
        </div>
        <div class="wp-block-column">
        </div>
    </div>


    <div class="wp-block-columns">
        <div class="wp-block-column">
        </div>
        <div class="wp-block-column">
        </div>
    </div>



			
	<p class="et_pb_contact_field et_pb_contact_field_5 et_pb_contact_field_half et_pb_contact_field_last" data-id="field_6" data-type="select">				

	</p> 

	<input type="hidden" value="et_contact_proccess" name="et_pb_contactform_submit_0"/>
	<div class="et_contact_bottom_container">		
			<button type="submit" name="calcular" class="et_pb_contact_submit et_pb_button">Calcular</button>
	</div>

	<?=wp_nonce_field( 'danosa-calculator', 'nonce' );?>


					
</form>

<script>

	var Alava= ["Alava","D1","512","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","Vitoria - Gasteiz"];
	var Albacete= ["Albacete","D3","677","C3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","E1","E2","E3","E4","E5",""];
	var Alicante= ["Alicante","B4","7","B4","B4","B4","B4","B4","C3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Almeria= ["Almería","A4","0","A4","A4","B4","B4","B4","B3","B3","B3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Asturias= ["Asturias","C1","214","C1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","Oviedo"];
	var Avila= ["Avila","E1","1054","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1",""];
	var Badajoz= ["Badajoz","C4","168","C4","C4","C4","C4","C4","C4","C4","C4","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Baleares= ["Baleares","B3","1","B3","B3","B3","B3","B3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","Palma de Mallorca"];
	var Barcelona= ["Barcelona","C2","1","C2","C2","C2","C2","C2","D2","D2","D2","D2","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Bilbao= ["Bilbao","C1","214","C1","C1","C1","C1","C1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1",""];
	var Burgos= ["Burgos","E1","861","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Caceres= ["Cáceres","C4","385","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","D3","D3","D3","D3","D3","D3","D3","D3","D3","E1","E1","E1",""];
	var Cadiz= ["Cádiz","A3","0","A3","A3","A3","B3","B3","B3","B3","B3","B3","C3","C3","C3","C2","C2","C2","C2","C2","D2","D2","D2","D2","D2","D2","D2",""];
	var Cantabria= ["Cantabria","C1","1","C1","C1","C1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","Santander"];
	var Castellon= ["Castellón","B3","18","B3","B3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","Castellón de la Plana"];
	var Ceuta= ["Ceuta","B3","0","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3","B3",""];
	var Ciudad_Real= ["Ciudad Real","D3","630","C4","C4","C4","C4","C4","C4","C4","C4","C4","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Cordoba= ["Córdoba","B4","113","B4","B4","B4","C4","C4","C4","C4","C4","C4","C4","C4","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Coruna= ["Coruña (a)","C1","0","C1","C1","C1","C1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1",""];
	var Cuenca= ["Cuenca","D2","975","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D2","D2","D2","D2","D2","E1","E1","E1",""];
	var Girona= ["Girona","C2","143","C2","C2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Granada= ["Granada","C3","754","A4","B4","B4","B4","B4","B4","B4","C4","C4","C4","C4","C4","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","E1",""];
	var Guadalajara= ["Guadalajara","D3","708","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D2","E1","E1","E1","E1",""];
	var Guipuzcoa= ["Guipúzcoa","C1","5","D1","D1","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","Donostia - San Sebastián"];
	var Huelva= ["Huelva","B4","50","A4","B4","B4","B3","B3","B3","B3","C3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Huesca= ["Huesca","D2","432","C3","C3","C3","C3","D3","D3","D3","D3","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Jaen= ["Jaén C","C4","436","B4","B4","B4","B4","B4","B4","B4","C4","C4","C4","C4","C4","C4","C4","C4","D3","D3","D3","D3","D3","D3","D3","D3","E1",""];
	var Leon= ["León","E1","346","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Lleida= ["Lleida","D3","131","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var La_Rioja= ["La Rioja","D2","379","C2","C2","C2","C2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","Logroño"];
	var Lugo= ["Lugo","D1","412","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Madrid= ["Madrid","D3","589","C3","C3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D2","E1","E1","E1","E1",""];
	var Malaga= ["Málaga","A3","0","A3","A3","B3","B3","B3","B3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Melilla= ["Melilla","A3","130","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3","A3",""];
	var Murcia= ["Murcia","B3","25","B3","B3","C3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Navarra= ["Navarra","D1","456","C2","C2","D2","D2","D2","D2","D2","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","Pamplona"];
	var Ourense= ["Ourense","C2","327","C3","C3","C3","C2","C2","C2","C2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Palencia= ["Palencia","D1","722","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Las_Palmas= ["Las Palmas","A3","114","A3","A3","A3","A3","A3","A3","A3","A2","A2","A2","A2","A2","A2","A2","A2","B2","B2","B2","B2","B2","C2","C2","C2","C2","Las Palmas de Gran Canaria"];
	var Pontevedra= ["Pontevedra","C1","77","C1","C1","C1","C1","C1","C1","C1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1","D1",""];
	var Salamanca= ["Salamanca","D2","770","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1","E1","E1",""];
	var Tenerife= ["Tenerife","A3","0","A3","A3","A3","A3","A3","A3","A3","A2","A2","A2","A2","A2","A2","A2","A2","B2","B2","B2","B2","B2","C2","C2","C2","C2","Santa Cruz de Tenerife"];
	var Segovia= ["Segovia","D2","1013","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1",""];
	var Sevilla= ["Sevilla","B4","9","B4","B4","B4","B4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4",""];
	var Soria= ["Soria","E1","984","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D1","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Tarragona= ["Tarragona","B3","1","B3","B3","C3","C3","C3","C3","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Teruel= ["Teruel","D2","995","C3","C3","C3","C3","C3","C3","C3","C3","C3","C2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1",""];
	var Toledo= ["Toledo","C4","445","C4","C4","C4","C4","C4","C4","C4","C4","C4","C4","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3","D3",""];
	var Valencia= ["Valencia","B3","8","B3","C3","C3","C3","C3","C3","C3","C3","C3","C3","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1",""];
	var Valladolid= ["Valladolid","D2","704","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Zamora= ["Zamora","D2","617","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","D2","E1","E1","E1","E1","E1","E1","E1","E1",""];
	var Zaragoza= ["Zaragoza","D3","207","C3","C3","C3","C3","D3","D3","D3","D3","D3","D3","D3","D3","D3","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1","E1",""];



	var const_1960 = ["2.50","5.00","2.10"];
	var const_1961 = ["1.50","4.00","2.10"];
	var const_1981 = ["1.20","3.00","0.90"];
	var const_2007 = ["0.70","1.70","0.41"];




	var provincia="";
	var capital="";
	var localidad="";
	var zc_capital="";
	var altitud_capital=0;
	var altitud_localidad=0;

	for (var i = 0; i < 24; i++) {
		eval("var zc_d"+(i+1)+"='"+(i+1)+"';");
	}

	var ano_construccion="";
	var m_ano=0;
	var tipo_vivienda="";
	var mts_vivienda=0;
	var tipo_energia="";

	var U_envolvente_fachadas=0;
	var U_envolvente_ventanas=0;
	var U_envolvente_cubiertas=0;


	function zonas_climaticas(zona){
		provincia=(eval(zona)[0]);
		localStorage.setItem("provincia",provincia);
		capital=(eval(zona)[0]);
		localStorage.setItem("capital",capital);
		zc_capital=(eval(zona)[1]);
		localStorage.setItem("zc_capital",zc_capital);
		altitud_capital=(eval(zona)[2]);
		localStorage.setItem("altitud_capital",altitud_capital);
		for (var i = 0; i < 24; i++) {
			eval("zc_d"+(i+1)+"="+zona+"["+(i+3)+"]");
		}
	}

	function f_ano_construccion(valor){
		if (valor=="const_1960"){
			ano_construccion="Antes 1960";
			m_ano="2";  
			localStorage.setItem("ano_construccion",ano_construccion);
			localStorage.setItem("m_ano",m_ano);
		}
		if (valor=="const_1961"){
			ano_construccion="Entre 1961-1980";
			localStorage.setItem("ano_construccion",ano_construccion);
			m_ano="3";  
			localStorage.setItem("m_ano",m_ano);
		}
		if (valor=="const_1981"){
			ano_construccion="Entre 1981-2006";
			localStorage.setItem("ano_construccion",ano_construccion);
			m_ano="4";  
			localStorage.setItem("m_ano",m_ano);
		}
		if (valor=="const_2007"){
			ano_construccion="A partir de 2007";
			localStorage.setItem("ano_construccion",ano_construccion);
			m_ano="5";  
			localStorage.setItem("m_ano",m_ano);
		}

		U_envolvente_fachadas=(eval(valor)[0]);
		localStorage.setItem("U_envolvente_fachadas",U_envolvente_fachadas);
		U_envolvente_ventanas=(eval(valor)[1]);
		localStorage.setItem("U_envolvente_ventanas",U_envolvente_ventanas);
		U_envolvente_cubiertas=(eval(valor)[2]);
		localStorage.setItem("U_envolvente_cubiertas",U_envolvente_cubiertas);

	}


	function localidades(valor){
		localidad=valor;
	}

	function f_tipo_vivienda(valor){
		tipo_vivienda=valor;
		localStorage.setItem("tipo_vivienda",tipo_vivienda);
	}

	function f_mts_vivienda(valor){
		mts_vivienda=valor;
		localStorage.setItem("mts_vivienda",mts_vivienda);
	}

	function f_tipo_energia(valor){
		tipo_energia=valor;
		localStorage.setItem("tipo_energia",tipo_energia);
	}



	function calc_zc(opt){

		altitud_localidad=opt;
		localStorage.setItem("altitud_localidad",altitud_localidad);

		if(opt=="cap"){

			localidad="no"
			localStorage.setItem("localidad",localidad);
			localStorage.setItem("zc",zc_capital);

		}
		else {

			localidad="si";
			localStorage.setItem("localidad",localidad);
			/*
			dif_altitud=altitud_localidad-altitud_capital;
			dif_altitud=Math.abs(dif_altitud);
			*/

			var cont1=50;
			var cont2=151;

			if(altitud_localidad < 51){
				localStorage.setItem("zc",zc_d1);
			}

			for (var i = 0; i < 23; i++) {
				if((altitud_localidad > cont1) && (altitud_localidad < cont2)){
					eval("localStorage.setItem('zc',zc_d"+(i+2)+")");
				}
				cont1 =cont1+50;
				cont2 =cont2+50; 
			}

			if(altitud_localidad > 1300) localStorage.setItem("zc",zc_d24);

		}
	}

</script>

 




<?php 