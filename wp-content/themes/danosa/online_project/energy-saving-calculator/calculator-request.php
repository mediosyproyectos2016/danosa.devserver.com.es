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
			<select id="et_pb_contact_field_2_0"  class="et_pb_contact_select input" name="provincia" required data-field_type="select" data-original_id="field_2" onchange="jQuery('.altitudes').show();zonas_climaticas(this.value);">
				<option value="" disabled selected>Elije provincia </option>
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

    <div class="wp-block-columns altitudes" style="display:none">
        <div class="wp-block-column" data-conditional-logic="[[&quot;field_2&quot;,&quot;is not empty&quot;,&quot;provincia1&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="radio">
			<label for="et_pb_contact_field_3_0" class="et_pb_contact_form_label">¿Capital?</label>
			<br>
			<span class="et_pb_contact_field_options_list">
				<span class="et_pb_contact_field_radio">
					<input required onchange="jQuery('.altitud').hide();jQuery('#et_pb_contact_field_4_0').attr('required', false);jQuery('#et_pb_contact_field_4_0').removeData('required_mark'); localStorage.setItem('et_pb_contact_field_3_0', 'Capital de provincia');calc_zc('cap')" type="radio" id="et_pb_contact_field_3_0_2_0" class="input" value="Capital de provincia" name="capital" data-required_mark="required" data-field_type="radio" data-original_id="field_3"  data-id="" >
					<label for="et_pb_contact_field_3_0_2_0"><i></i>Capital de provincia</label>
				</span>
				<span class="et_pb_contact_field_radio">
					<input required  onchange="jQuery('.altitud').show();jQuery('#et_pb_contact_field_4_0').attr('required', true);jQuery('#et_pb_contact_field_4_0').data('required_mark', 'required'); localStorage.setItem('et_pb_contact_field_3_0', 'Otra localidad');localidades(this.value);" type="radio" id="et_pb_contact_field_3_0_2_1" class="input" value="Otra localidad" name="capital" data-required_mark="required" data-field_type="radio" data-original_id="field_3"  data-id="" >
					<label for="et_pb_contact_field_3_0_2_1"><i></i>Otra localidad</label>
				</span>
			</span>
        </div>
        <div class="wp-block-column altitud"  style="display:none" data-conditional-logic="[[&quot;field_3&quot;,&quot;is&quot;,&quot;Otra localidad&quot;]]" data-conditional-relation="any" data-id="field_4" data-type="input">
         	<label for="et_pb_contact_field_4_0" class="et_pb_contact_form_label">Altitud</label>
			<input type="text" id="et_pb_contact_field_4_0" class="input" value="" name="altitud"  data-field_type="input" data-original_id="field_4" placeholder="altitud" pattern="[0-9\s-]{1,4}" title="Sólo se permiten números.Longitud Mínima: 1 caracteres. Longitud Máxima: 4 caracteres." maxlength="4" onchange="calc_zc(this.value)">
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
			<label for="et_pb_contact_field_7_0" class="et_pb_contact_form_label">Tipo de energía</label>
			<select id="et_pb_contact_field_7_0" class="et_pb_contact_select input" name="tipo_energia" required data-required_mark="required" data-field_type="select" data-original_id="field_6" onchange="f_tipo_energia(this.value)">
				<option value="">Tipo de energía</option>
				<option value="Eléctrica">Eléctrica</option>
				<option value="Gas">Gas</option>
				<option value="Gasoil">Gasoil</option>
				<option value="Biomasa">Biomasa</option>
			</select>
        </div>
        <div class="wp-block-column">
        	<button type="submit" name="calcular" class="et_pb_contact_submit et_pb_button">Calcular</button>
        </div>
    </div>



	<input type="hidden" value="et_contact_proccess" name="et_pb_contactform_submit_0"/>


	<?=wp_nonce_field( 'danosa-calculator', 'nonce' );?>


					
</form>

<script>
	<?php include __DIR__."/energy-saving-calculator-request.js";?>
</script>

 




<?php 