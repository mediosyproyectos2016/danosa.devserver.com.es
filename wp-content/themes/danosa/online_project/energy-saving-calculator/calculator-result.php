<?php
/*
global $wpdb;
$posts_contact = $wpdb->get_results("SELECT * FROM $wpdb->postmeta
WHERE meta_key = 'hreflang_ref' AND  meta_value = 'contact' LIMIT 1", ARRAY_A);
$contact_link = "";
if(count($posts_contact) > 0){
	$contact_link =  get_permalink($posts_contact[0]["post_id"]);
}
*/
?>

<div class="wp-block-columns">
    <div class="wp-block-column">
    	<h3><strong>Datos iniciales</strong></h3>
    	<div id="ubicacion"></div>
        <a href="">MODIFICAR DATOS</a>
    </div>
    <div class="wp-block-column">
    	<span class="et_pb_image_wrap "><img src="<?php echo get_stylesheet_directory_uri(); ?>/online_project/energy-saving-calculator/img/mapa-zona-climatica.jpg" alt="" title=""  /></span>
    </div>
</div>


<h3><strong>Mejora en fachada</strong></h3>
<p>Elije el tipo de aislamiento para la fachada</p>

<div class="wp-block-columns">
    <div class="wp-block-column">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/online_project/energy-saving-calculator/img/danotherm_xps.jpg" alt="" title=""  />
        <div class="result-form">
	    <form class="et_pb_contact_form clearfix" method="post" action="#">
	        <p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_half" data-id="field_1" data-type="select">
	            <label for="et_pb_contact_field_1_0" class="et_pb_contact_form_label">Elige el espesor</label>
	            <select id="et_pb_contact_field_1_0" class="et_pb_contact_select input" name="et_pb_contact_field_1_0" data-required_mark="required" data-field_type="select" data-original_id="field_1" onchange="um_fs(this.value)">
	                <option value="">Elige el espesor</option>
	                <option value="fachada_danopren_fs_40">40</option>
	                <option value="fachada_danopren_fs_50">50</option>
	                <option value="fachada_danopren_fs_60">60</option>
	                <option value="fachada_danopren_fs_70">70</option>
	                <option value="fachada_danopren_fs_80">80</option>
	                <option value="fachada_danopren_fs_90">90</option>
	                <option value="fachada_danopren_fs_100">100</option>
	                <option value="fachada_danopren_fs_110">110</option>
	                <option value="fachada_danopren_fs_120">120</option>
	                <option value="fachada_danopren_fs_130">130</option>
	                <option value="fachada_danopren_fs_140">140</option>
	                <option value="fachada_danopren_fs_150">150</option>
	                <option value="fachada_danopren_fs_160">160</option>
	            </select>

	        </p>
	    </form>

        <div id="um_danopren_fs" class="result-form-1">
            <p id="p_um_danopren_fs"></p>
        </div>

	    <form class="et_pb_contact_form clearfix" method="post" action="#">
	        <p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_last" data-id="ventanas" data-type="select">
	            <label for="et_pb_contact_ventanas_0" class="et_pb_contact_form_label">Elija el tipo de ventanas</label>
	            <select id="et_pb_contact_ventanas_0" class="et_pb_contact_select input" name="et_pb_contact_ventanas_0" data-required_mark="required" data-field_type="select" data-original_id="ventanas" onchange="umv_fs(this.value)">
	                <option value="">Elija el tipo de ventanas</option>
	                <option value="ventanas0">Sin cambios</option>
	                <option value="ventanas1">Metal con rotura PT y 4/16/4</option>
	                <option value="ventanas2">PVC con 4/16/4</option>
	                <option value="ventanas3">Metal con rotura PT y 4/16/4 y bajo-emisivo</option>
	                <option value="ventanas4">PVC con 4/16/4 y bajo-emisivo</option>
	            </select>
	        </p>
	    </form>

        <div id="umv_danopren_fs" class="result-form-2">
            <p id="p_umv_danopren_fs"></p>
        </div>

        <form class="et_pb_contact_form clearfix" method="post" action="#">
            <p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_last" data-id="field_4" data-type="radio">
                <label for="et_pb_contact_field_4_0" class="et_pb_contact_form_label">Mejoras en cubierta</label>
                <br>
                <span class="et_pb_contact_field_options_wrapper">
                    <span class="et_pb_contact_field_options_list"><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras1').hide();" type="radio" id="et_pb_contact_field_4_0_0_0" class="input" value="Sin mejoras" name="et_pb_contact_field_4_0" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="-1" onchange="sm_xps();">
                            <label for="et_pb_contact_field_4_0_0_0"><i></i>Sin mejoras</label>
                        </span><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras1').hide();jQuery('.mejoras1.danolosa').show();" type="radio" id="et_pb_contact_field_4_0_0_1" class="input" value="Danolosa" name="et_pb_contact_field_4_0" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="0">
                            <label for="et_pb_contact_field_4_0_0_1"><i></i>Danolosa</label>
                        </span><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras1').hide();jQuery('.mejoras1.danopren').show();" type="radio" id="et_pb_contact_field_4_0_0_2" class="input" value="Danopren" name="et_pb_contact_field_4_0" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="1">
                            <label for="et_pb_contact_field_4_0_0_2"><i></i>Danopren</label>
                        </span></span>
                </span>
            </p>
            <p style="display:none" class="mejoras1 danolosa et_pb_contact_field et_pb_contact_field_1 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danolosa&quot;]]" data-conditional-relation="any" data-id="field_2" data-type="select">
                <label for="et_pb_contact_field_2_0" class="et_pb_contact_form_label">Elige el espesor para Danolosa</label>
                <select id="et_pb_contact_field_2_0" class="et_pb_contact_select input" name="et_pb_contact_field_2_0" data-required_mark="required" data-field_type="select" data-original_id="field_2" onchange="umc_fs(this.value)">
                    <option value="">Elige la Danolosa</option>
                    <option value="DANOLOSA_75">Danolosa 75</option>
                    <option value="DANOLOSA_85">Danolosa 85</option>
                    <option value="DANOLOSA_95">Danolosa 95</option>
                </select>
            </p>
            <p style="display:none" class="mejoras1 danopren et_pb_contact_field et_pb_contact_field_2 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danopren&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="select">
                <label for="et_pb_contact_field_3_0" class="et_pb_contact_form_label">Elige espesor para Danopren TR</label>
                <select id="et_pb_contact_field_3_0" class="et_pb_contact_select input" name="et_pb_contact_field_3_0" data-required_mark="required" data-field_type="select" data-original_id="field_3" onchange="umc_fs(this.value)">
                    <option value="">Elige espesor para Danopren TR</option>
                    <option value="DANOPREN_TR_40">40</option>
                    <option value="DANOPREN_TR_50">50</option>
                    <option value="DANOPREN_TR_60">60</option>
                    <option value="DANOPREN_TR_70">70</option>
                    <option value="DANOPREN_TR_80">80</option>
                    <option value="DANOPREN_TR_80">90</option>
                    <option value="DANOPREN_TR_100">100</option>
                    <option value="DANOPREN_TR_110">110</option>
                    <option value="DANOPREN_TR_120">120</option>
                    <option value="DANOPREN_TR_130">130</option>
                    <option value="DANOPREN_TR_140">140</option>
                    <option value="DANOPREN_TR_150">150</option>
                    <option value="DANOPREN_TR_160">160</option>
                    <option value="DANOPREN_TR_170">170</option>
                    <option value="DANOPREN_TR_180">180</option>
                    <option value="DANOPREN_TR_190">190</option>
                    <option value="DANOPREN_TR_200">200</option>
                </select>
            </p>
        </form>


        <div id="umc_danopren_fs" class="result-form-3">
            <p id="p_umc_danopren_fs"></p>
        </div>
        </div>

        <div id="r_danopren_fs" class="result-form-4">
            <p id="p_r_danopren_fs"></p>
        </div>

    </div>
    <div class="wp-block-column">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/online_project/energy-saving-calculator/img/danotherm_eps.jpg" alt="" title=""/>
        <div class="result-form">
        <form class="et_pb_contact_form clearfix" method="post" action="#">
            <p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_half" data-id="field_2" data-type="select">
                <label for="et_pb_contact_field_1_0" class="et_pb_contact_form_label">Elige el espesor</label>
                <select id="et_pb_contact_field_1_0" class="et_pb_contact_select input" name="et_pb_contact_field_1_0" data-required_mark="required" data-field_type="select" data-original_id="field_1" onchange="um_eps(this.value)">
                    <option value="">Elige el espesor</option>
                    <option value="fachada_danotherm_eps_40">40</option>
                    <option value="fachada_danotherm_eps_50">50</option>
                    <option value="fachada_danotherm_eps_60">60</option>
                    <option value="fachada_danotherm_eps_70">70</option>
                    <option value="fachada_danotherm_eps_80">80</option>
                    <option value="fachada_danotherm_eps_90">90</option>
                    <option value="fachada_danotherm_eps_100">100</option>
                    <option value="fachada_danotherm_eps_110">110</option>
                    <option value="fachada_danotherm_eps_120">120</option>
                    <option value="fachada_danotherm_eps_130">130</option>
                    <option value="fachada_danotherm_eps_140">140</option>
                    <option value="fachada_danotherm_eps_150">150</option>
                    <option value="fachada_danotherm_eps_160">160</option>
                </select>
            </p>
        </form>

        <div id="um_danotherm_eps" class="result-form-1">
            <p id="p_um_danotherm_eps"></p>
        </div>

        <form class="et_pb_contact_form clearfix" method="post" action="#">
            <p class="et_pb_contact_field et_pb_contact_field_1 et_pb_contact_field_last" data-id="ventanas" data-type="select">
                <label for="et_pb_contact_ventanas_1" class="et_pb_contact_form_label">Elija el tipo de ventanas</label>
                <select id="et_pb_contact_ventanas_1" class="et_pb_contact_select input" name="et_pb_contact_ventanas_1" data-required_mark="required" data-field_type="select" data-original_id="ventanas" onchange="umv_eps(this.value)">
                    <option value="">Elija el tipo de ventanas</option>
                    <option value="ventanas0">Sin cambios</option>
                    <option value="ventanas1">Metal con rotura PT y 4/16/4</option>
                    <option value="ventanas2">PVC con 4/16/4</option>
                    <option value="ventanas3">Metal con rotura PT y 4/16/4 y bajo-emisivo</option>
                    <option value="ventanas4">PVC con 4/16/4 y bajo-emisivo</option>
                </select>
            </p>
        </form>

        <div id="umv_danotherm_eps" class="result-form-2">
            <p id="p_umv_danotherm_eps"></p>
        </div>

        <form class="et_pb_contact_form clearfix" method="post" action="#">
            <p class="et_pb_contact_field et_pb_contact_field_3 et_pb_contact_field_last" data-id="field_4" data-type="radio">
                <label for="et_pb_contact_field_4_1" class="et_pb_contact_form_label">Mejoras en cubierta</label>
                <br>
                <span class="et_pb_contact_field_options_wrapper">
                    <span class="et_pb_contact_field_options_list"><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras2').hide()" type="radio" id="et_pb_contact_field_4_1_3_0" class="input" value="Sin mejoras" name="et_pb_contact_field_4_1" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="-1" onchange="sm_eps();">
                            <label for="et_pb_contact_field_4_1_3_0"><i></i>Sin mejoras</label>
                        </span><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras2').hide();jQuery('.mejoras2.danolosa').show();" type="radio" id="et_pb_contact_field_4_1_3_1" class="input" value="Danolosa" name="et_pb_contact_field_4_1" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="0">
                            <label for="et_pb_contact_field_4_1_3_1"><i></i>Danolosa</label>
                        </span><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras2').hide();jQuery('.mejoras2.danopren').show();" type="radio" id="et_pb_contact_field_4_1_3_2" class="input" value="Danopren" name="et_pb_contact_field_4_1" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="1">
                            <label for="et_pb_contact_field_4_1_3_2"><i></i>Danopren</label>
                        </span></span>
                </span>
            </p>
            <p style="display:none" class="mejoras2 danolosa et_pb_contact_field et_pb_contact_field_4 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danolosa&quot;]]" data-conditional-relation="any" data-id="field_2" data-type="select">
                <label for="et_pb_contact_field_2_1" class="et_pb_contact_form_label">Elige el espesor para Danolosa</label>
                <select id="et_pb_contact_field_2_1" class="et_pb_contact_select input" name="et_pb_contact_field_2_1" data-required_mark="required" data-field_type="select" data-original_id="field_2" onchange="umc_eps(this.value)">
                    <option value="">Elige el espesor para Danolosa</option>
                    <option value="DANOLOSA_75">Danolosa 75</option>
                    <option value="DANOLOSA_85">Danolosa 85</option>
                    <option value="DANOLOSA_95">Danolosa 95</option>
                </select>
            </p>
            <p style="display:none" class="mejoras2 danopren et_pb_contact_field et_pb_contact_field_5 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danopren&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="select">
                <label for="et_pb_contact_field_3_1" class="et_pb_contact_form_label">Elige espesor para Danopren TR</label>
                <select id="et_pb_contact_field_3_1" class="et_pb_contact_select input" name="et_pb_contact_field_3_1" data-required_mark="required" data-field_type="select" data-original_id="field_3" onchange="umc_eps(this.value)">
                    <option value="">Elige espesor para Danopren TR</option>
                    <option value="DANOPREN_TR_40">40</option>
                    <option value="DANOPREN_TR_50">50</option>
                    <option value="DANOPREN_TR_60">60</option>
                    <option value="DANOPREN_TR_70">70</option>
                    <option value="DANOPREN_TR_80">80</option>
                    <option value="DANOPREN_TR_80">90</option>
                    <option value="DANOPREN_TR_100">100</option>
                    <option value="DANOPREN_TR_110">110</option>
                    <option value="DANOPREN_TR_120">120</option>
                    <option value="DANOPREN_TR_130">130</option>
                    <option value="DANOPREN_TR_140">140</option>
                    <option value="DANOPREN_TR_150">150</option>
                    <option value="DANOPREN_TR_160">160</option>
                    <option value="DANOPREN_TR_170">170</option>
                    <option value="DANOPREN_TR_180">180</option>
                    <option value="DANOPREN_TR_190">190</option>
                    <option value="DANOPREN_TR_200">200</option>
                </select>
            </p>
        </form>

        <div id="umc_danotherm_eps" class="result-form-3">
            <p id="p_umc_danotherm_eps"></p>
        </div>
        </div>
        <div id="r_danotherm_eps" class="result-form-4">
            <p id="p_r_danotherm_eps"></p>
        </div>
    </div>
    <div class="wp-block-column">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/online_project/energy-saving-calculator/img/danotherm_eps_grafito.jpg" />
        <div class="result-form">
        <form class="et_pb_contact_form clearfix" method="post" action="#">
            <p class="et_pb_contact_field et_pb_contact_field_0 et_pb_contact_field_half" data-id="field_3" data-type="select">
                <label for="et_pb_contact_field_1_0" class="et_pb_contact_form_label">Elige el espesor</label>
                <select id="et_pb_contact_field_1_0" class="et_pb_contact_select input" name="et_pb_contact_field_1_0" data-required_mark="required" data-field_type="select" data-original_id="field_1" onchange="um_epsg(this.value)">
                    <option value="">Elige el espesor</option>
                    <option value="fachada_danotherm_epsg_40">40</option>
                    <option value="fachada_danotherm_epsg_50">50</option>
                    <option value="fachada_danotherm_epsg_60">60</option>
                    <option value="fachada_danotherm_epsg_70">70</option>
                    <option value="fachada_danotherm_epsg_80">80</option>
                    <option value="fachada_danotherm_epsg_90">90</option>
                    <option value="fachada_danotherm_epsg_100">100</option>
                    <option value="fachada_danotherm_epsg_110">110</option>
                    <option value="fachada_danotherm_epsg_120">120</option>
                    <option value="fachada_danotherm_epsg_130">130</option>
                    <option value="fachada_danotherm_epsg_140">140</option>
                    <option value="fachada_danotherm_epsg_150">150</option>
                    <option value="fachada_danotherm_epsg_160">160</option>
                </select>
            </p>
        </form>

        <div id="um_danotherm_epsg" class="result-form-1">
            <p id="p_um_danotherm_epsg"></p>
        </div>

        <form class="et_pb_contact_form clearfix" method="post" action="#">
            <p class="et_pb_contact_field et_pb_contact_field_2 et_pb_contact_field_last" data-id="ventanas" data-type="select">
                <label for="et_pb_contact_ventanas_2" class="et_pb_contact_form_label">Elija el tipo de ventanas</label>
                <select id="et_pb_contact_ventanas_2" class="et_pb_contact_select input" name="et_pb_contact_ventanas_2" data-required_mark="required" data-field_type="select" data-original_id="ventanas" onchange="umv_epsg(this.value)">
                    <option value="">Elija el tipo de ventanas</option>
                    <option value="ventanas0">Sin cambios</option>
                    <option value="ventanas1">Metal con rotura PT y 4/16/4</option>
                    <option value="ventanas2">PVC con 4/16/4</option>
                    <option value="ventanas3">Metal con rotura PT y 4/16/4 y bajo-emisivo</option>
                    <option value="ventanas4">PVC con 4/16/4 y bajo-emisivo</option>
                </select>
            </p>
        </form>

        <div id="umv_danotherm_epsg" class="result-form-2">
            <p id="p_umv_danotherm_epsg"></p>
        </div>

        <form class="et_pb_contact_form clearfix" method="post" action="#">
            <p class="et_pb_contact_field et_pb_contact_field_6 et_pb_contact_field_last" data-id="field_4" data-type="radio">
                <label for="et_pb_contact_field_4_2" class="et_pb_contact_form_label">Mejoras en cubierta</label>
                <br>
                <span class="et_pb_contact_field_options_wrapper">
                    <span class="et_pb_contact_field_options_list"><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras3').hide();" type="radio" id="et_pb_contact_field_4_2_6_0" class="input" value="Sin mejoras" name="et_pb_contact_field_4_2" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="-1" onchange="sm_epsg();">
                            <label for="et_pb_contact_field_4_2_6_0"><i></i>Sin mejoras</label>
                        </span><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras3').hide();jQuery('.mejoras3.danolosa').show();" type="radio" id="et_pb_contact_field_4_2_6_1" class="input" value="Danolosa" name="et_pb_contact_field_4_2" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="0">
                            <label for="et_pb_contact_field_4_2_6_1"><i></i>Danolosa</label>
                        </span><span class="et_pb_contact_field_radio">
                            <input onchange="jQuery('.mejoras3').hide();jQuery('.mejoras3.danopren').show();" type="radio" id="et_pb_contact_field_4_2_6_2" class="input" value="Danopren" name="et_pb_contact_field_4_2" data-required_mark="required" data-field_type="radio" data-original_id="field_4" data-id="1">
                            <label for="et_pb_contact_field_4_2_6_2"><i></i>Danopren</label>
                        </span></span>
                </span>
            </p>
            <p style="display:none" class="mejoras3 danolosa et_pb_contact_field et_pb_contact_field_7 et_pb_contact_field_last" data-conditional-logic="[['field_4','is','Danolosa']]" data-conditional-relation="any" data-id="field_2" data-type="select">
                <label for="et_pb_contact_field_2_2" class="et_pb_contact_form_label">Elige el espesor para Danolosa</label>
                <select id="et_pb_contact_field_2_2" class="et_pb_contact_select input" name="et_pb_contact_field_2_2" data-required_mark="required" data-field_type="select" data-original_id="field_2" onchange="umc_epsg(this.value)">
                    <option value="">Elige el espesor para Danolosa</option>
                    <option value="DANOLOSA_75">Danolosa 75</option>
                    <option value="DANOLOSA_85">Danolosa 85</option>
                    <option value="DANOLOSA_95">Danolosa 95</option>
                </select>
            </p>
            <p style="display:none" class="mejoras3 danopren et_pb_contact_field et_pb_contact_field_8 et_pb_contact_field_last" data-conditional-logic="[[&quot;field_4&quot;,&quot;is&quot;,&quot;Danopren&quot;]]" data-conditional-relation="any" data-id="field_3" data-type="select">
                <label for="et_pb_contact_field_3_2" class="et_pb_contact_form_label">Elige espesor para Danopren TR</label>
                <select id="et_pb_contact_field_3_2" class="et_pb_contact_select input" name="et_pb_contact_field_3_2" data-required_mark="required" data-field_type="select" data-original_id="field_3" onchange="umc_epsg(this.value)">
                    <option value="">Elige espesor para Danopren TR</option>
                    <option value="DANOPREN_TR_40">40</option>
                    <option value="DANOPREN_TR_50">50</option>
                    <option value="DANOPREN_TR_60">60</option>
                    <option value="DANOPREN_TR_70">70</option>
                    <option value="DANOPREN_TR_80">80</option>
                    <option value="DANOPREN_TR_80">90</option>
                    <option value="DANOPREN_TR_100">100</option>
                    <option value="DANOPREN_TR_110">110</option>
                    <option value="DANOPREN_TR_120">120</option>
                    <option value="DANOPREN_TR_130">130</option>
                    <option value="DANOPREN_TR_140">140</option>
                    <option value="DANOPREN_TR_150">150</option>
                    <option value="DANOPREN_TR_160">160</option>
                    <option value="DANOPREN_TR_170">170</option>
                    <option value="DANOPREN_TR_180">180</option>
                    <option value="DANOPREN_TR_190">190</option>
                    <option value="DANOPREN_TR_200">200</option>
                </select>
            </p>
        </form>

        <div id="umc_danotherm_epsg" class="result-form-3">
            <p id="p_umc_danotherm_epsg"></p>
        </div>
        </div>
        <div id="r_danotherm_epsg" class="result-form-4">
            <p id="p_r_danotherm_epsg"></p>
        </div>
    </div>
</div>


<p><i>«La información proporcionada se ofrece a título estimativo como ayuda al usuario o propietario del edificio o vivienda, pero ni es ni puede sustituir al conjunto de cálculos y comprobaciones que la dirección técnica del proyecto de rehabilitación energética deberá llevar a cabo para justificar el cumplimiento de la reglamentación técnica vigente y de aplicación al proyecto, como puede ser la reglamentaria certificación energética del edificio o vivienda»</i></p>

<h3>Consulta aquí las ayudas disponibles</h3>
<p><strong><a href="https://www.idae.es/" target="_blank" rel="noopener noreferrer">https://www.idae.es/</a></strong></p>

<img src="<?php echo get_stylesheet_directory_uri(); ?>/online_project/energy-saving-calculator/img/calificacion-energetica.jpg" />

<?php if(1==2 && $contact_link !=""){ ?>
<div class="et_pb_text_inner">
    <h3>Para más información póngase en <a href="<?=$contact_link?>" target="_blank">contacto con nosotros</a></h3>
</div>
<?php } ?>



<?= do_shortcode( '[contact-form-7 id="8416" title="Calculadora energética"]' ); ?>



<script>
    <?php include __DIR__."/energy-saving-calculator-result.js";?>

    caletiepsg();
    caletixps();
    caletieps();
    muestro_cubierta();
</script>

