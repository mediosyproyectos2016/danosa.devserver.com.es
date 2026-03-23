<?php



$links = array();
$posts_id = array();
$nonce = wp_create_nonce( 'online-project-post-nonce' );


?>
<style>
<?php
            include __DIR__."/design-your-project/design-your-project.css";?>

</style>
<form id="form-online-project" action="<?=admin_url( 'admin-ajax.php' )?>" method="POST" accept-charset="utf-8">
    <div id="design-your-project">
        <input type="hidden" name="nonce" value="<?=$nonce?>">
        <input type="hidden" name="action" value="online_project_post">
        <input type="hidden" name="form" value="prescripcion_online">
        <input type="hidden" name="PrescripcionSistemas" id="PrescripcionSistemas">
        <div class="wp-block-columns">
            <div class="wp-block-column">
                <label>
                    <span><?= __("Nombre del proyecto","danosa-design-your-project") ?>: <span>*</span></span>
                    <span class="wpcf7-form-control-wrap"><input type="text" id="project_name" name="project_name" value="" size="40" required></span>
                </label>
            </div>
        </div>
        <div class="wp-block-columns">
         <div class="wp-block-column">
                <label>
                    <span><?= __("Código postal","danosa-design-your-project")?>:</span>
                    <span class="wpcf7-form-control-wrap"><input type="text" id="cpos" name="cpos" value="" size="40"></span>
                </label>
            </div>
            <div class="wp-block-column">
                <label>
                    <span><?= __("Localidad","danosa-design-your-project")?>:</span>
                    <span class="wpcf7-form-control-wrap"><input type="text" id="city" name="city" value="" ></span>
                </label>
            </div>
           
        </div>
        <div class="wp-block-columns">
            <div class="wp-block-column">
                <label>
                    <span><?= __("Provincia","danosa-design-your-project")?>:</span>
                    <span class="wpcf7-form-control-wrap">
                    <select name="area" id="area">
                        <option value="" selected disabled><?= __("Seleccione una provincia","danosa-design-your-project") ?></option>
                        <?php
                            $regions = getRegions(getSiteCountry());
                            foreach ($regions as $value) {
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php
                            } 
                        ?>
                    </select>
                    </span>
                </label>
            </div>
            <div class="wp-block-column">
                <label>
                    <span><?= __("Tipo de obra","danosa-design-your-project")?>:</span>
                    <span class="wpcf7-form-control-wrap your-surnames">
                    <select name="type" id="type" onchange="changeType();">
                      <option value="" selected disabled><?= __("Tipo de obra","danosa-design-your-project")?></option>
                      <option value="RESIDENCIAL"><?= __("RESIDENCIAL","danosa-design-your-project")?></option>
                      <option value="INDUSTRIAL"><?= __("INDUSTRIAL","danosa-design-your-project")?></option>
                      <option value="OFICINAS"><?= __("OFICINAS","danosa-design-your-project")?></option>
                      <option value="COMERCIAL"><?= __("COMERCIAL","danosa-design-your-project")?></option>
                      <option value="HOSPITALARIO"><?= __("HOSPITALARIO","danosa-design-your-project")?></option>
                      <option value="DEPORTIVO"><?= __("DEPORTIVO","danosa-design-your-project")?></option>
                    </select>
                    </span>
                </label>
            </div>
 
        </div>
    </div>
        <?php include __DIR__."/_sistemas.php";
        $title = __("AGREGAR PARTIDAS","danosa-design-your-project")?>
        <div id="typeRESIDENCIAL" class="form-type-of-construction" style="display:none">
            <?php
            $type ="RESIDENCIAL";
          
           
            include __DIR__."/_partida.php";?>
        </div>
        <div id="typeINDUSTRIAL" class="form-type-of-construction" style="display:none">
            <?php
            $type ="INDUSTRIAL";
           
           
            include __DIR__."/_partida.php";?>
        </div>
        <div id="typeOFICINAS" class="form-type-of-construction" style="display:none">
            <?php
            $type ="OFICINAS";
            
           
           include __DIR__."/_partida.php";?>
        </div>
        <div id="typeCOMERCIAL" class="form-type-of-construction" style="display:none">
            <?php
            $type ="COMERCIAL";
             
           
            include __DIR__."/_partida.php";?>
        </div>
        <div id="typeHOSPITALARIO" class="form-type-of-construction" style="display:none">
            <?php 
            $type ="HOSPITALARIO";
            
           
            include __DIR__."/_partida.php";?>
        </div>
        <div id="typeDEPORTIVO" class="form-type-of-construction" style="display:none">
           <?php 
            $type ="DEPORTIVO";
          
           
            include __DIR__."/_partida.php";?>
        </div>
        <div id="typeEMPTY" class="form-type-of-construction"  >
           <?php 
            $type ="";
          
           
            include __DIR__."/_partida.php";?>
        </div>
        <?php include __DIR__."/_registro.php";?>
      
     

    </form>
    <script>
        jQuery(document).ready(function() {
                jQuery('select:not(.list)').select2();
        });
    function changeType(){
        var type = jQuery('#type').val();        
        var objJson =  jQuery("#partidasData"+type).val(); 
        objJson = JSON.parse(objJson);      
        window["refreshPartidas"+type](objJson);
        jQuery('.form-type-of-construction').hide();
        jQuery("#type"+type).show();
    }
    function loafFromStorage(){
        var ser = window.localStorage.getItem('online_project_prescripcion_online');
       if(ser != "" && ser != undefined){
            var urlParams = new URLSearchParams(ser); // get interface / iterator
      
            for ([key, value] of urlParams) { // get pair > extract it to key/value
                if (jQuery("#"+key).length){
                    jQuery("#"+key).val(value);
                }               
            }
            changeType();
        
       }      

    }
    loafFromStorage();

    </script>
