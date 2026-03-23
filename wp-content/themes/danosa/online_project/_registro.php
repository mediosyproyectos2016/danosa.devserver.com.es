<div  class="registro" id="registro" style="display:none">
    <?php  include __DIR__."/_resumen.php";  ?> 
    <input type="hidden" name="webId" id="webId" value="">
    <h4><?php _e("Datos del solicitante","danosa-design-your-project"); ?></h4>
 
    <div class="wp-block-columns">
        <div class="wp-block-column">
            <label>
            <span><?= __("Nombre","danosa-design-your-project") ?>: *</span>
            <span class="wpcf7-form-control-wrap"><input type="text" name="name" value="" size="40" required></span>
            </label>
        </div>
        <div class="wp-block-column">
            <label>
            <span><?= __("Apellidos","danosa-design-your-project") ?>: *</span>
            <span class="wpcf7-form-control-wrap"><input type="text" name="surname" value="" size="40" required></span>
            </span>
            </label>
        </div>
    </div>
    <div class="wp-block-columns">
        <div class="wp-block-column">
            <label>
            <span><?= __("Empresa","danosa-design-your-project") ?>: *</span>
            <span class="wpcf7-form-control-wrap"><input type="text" name="company" value="" size="40" required></span>
            </label>
        </div>
        <div class="wp-block-column">
            <label>
            <span><?= __("Actividad","danosa-design-your-project") ?>:</span>
            <span class="wpcf7-form-control-wrap">
            <select name="activity">
                <option value="" selected disabled><?= __("Seleccione una actividad ...","danosa-design-your-project") ?></option>
                <option value="Constructora"><?= __("Constructora","danosa-design-your-project") ?></option>
                <option value="Promotora"><?= __("Promotora","danosa-design-your-project") ?></option>
                <option value="Arquitectura / Ingeniería"><?= __("Arquitectura / Ingeniería","danosa-design-your-project") ?></option>
                <option value="Instalador"><?= __("Instalador","danosa-design-your-project") ?></option>
                <option value="Distribuidor"><?= __("Distribuidor","danosa-design-your-project") ?></option>
                <option value="Particular"><?= __("Particular","danosa-design-your-project") ?></option>
                <option value="Estudiante"><?= __("Estudiante","danosa-design-your-project") ?></option>
                <option value="Otros"><?= __("Otros","danosa-design-your-project") ?></option>
            </select>
            </span>
            </label>
        </div>
    </div> 
    <div class="wp-block-columns">
        <div class="wp-block-column">
            <label>
            <span><?= __("Teléfono","danosa-design-your-project") ?>: *</span>
            <span class="wpcf7-form-control-wrap"><input type="text" name="phone" value="" size="40" required></span>
            </label>
        </div>    
        <div class="wp-block-column">
            <label>
            <span><?= __("E-mail","danosa-design-your-project") ?>: *</span>
            <span class="wpcf7-form-control-wrap"><input type="email" name="email" value=""   required></span>
            </label>
        </div>  
    </div>
    <div class="wp-block-columns">
        <div class="wp-block-column">
         <?php
                $form_texto_politica_privacidad = get_field("form_texto_politica_privacidad","option");
                $form_anchor_politica_privacidad = get_field("form_anchor_politica_privacidad","option");
                $form_link_politica_privacidad = get_field("form_link_politica_privacidad","option");
                if(empty($form_texto_politica_privacidad)){
                    $form_texto_politica_privacidad = __("I have read and agree to the","danosa");
                }
                if(empty($form_anchor_politica_privacidad)){
                    $form_anchor_politica_privacidad = __("Privacy Policy","danosa");
                }
                if(empty($form_link_politica_privacidad)){
                    $form_link_politica_privacidad = do_shortcode("[link_hreflang hreflang='privacy_policy']");
                }
                ?>
            <label>
             <span style="display: inline-block;    float: left;    width: 90px;" class="wpcf7-form-control-wrap"> <input class="ch" type="checkbox" name="SI_QUIERO_INSCRIBIRME" required=""></span>
             <span  style="display: inline-block;    float: left;    "> <?php echo $form_texto_politica_privacidad; ?> <a href="<?php echo $form_link_politica_privacidad; ?>"><?php echo $form_anchor_politica_privacidad; ?></a>. </span>
            </label>
        </div>             
    </div> 
    <div class="wp-block-columns" id="s_downloader_application">
        <div class="buttons">
            <button   onclick="location.reload();return false;"><?= __("Volver","danosa-design-your-project") ?></button>
        </div>
            <div class="buttons">
            <input type="submit" name="generate"  value="Generar documentación">
        </div>
    </div>
    <div class="progress" id="download_progress" style="display:none;">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        <div class="text"></div>
    </div>
    <input type="hidden" name="nonce" value="<?=$nonce?>">
    <input type="hidden" name="callback" value="my_prescripcion_online_download_post_create">
    <input type="hidden" name="download_type" value="prescripcion_online">
    <input type="hidden" name="action" value="download_post">
</div>
<script>
    var downloader_application_interval;
    jQuery( document ).ready(function() {       
        jQuery( "#form-online-project" ).submit(function( event ) {
            event.preventDefault();
            downloaded = false;
            jQuery("#s_downloader_application").hide();
            jQuery("#download_progress").fadeIn();
            jQuery('#download_progress .progress-bar').css('width',  '100%').attr('aria-valuenow', 100); 
                jQuery('#download_progress .progress-bar').html('Preparando los ficheros');
                downloadprogress(true);
            downloader_application_interval = setInterval(downloadprogress, 3000);//time in milliseconds 
        });
    });
    var ajax_progress;
    function downloadprogress(no_cancel){
        if(ajax_progress) ajax_progress.abort();
        
        ajax_progress =   jQuery.ajax({
                    type:"post",
                    url:"<?=admin_url( 'admin-ajax.php' )?>",
                    data: jQuery( "#form-online-project" ).serialize(),
                    success:function(data)
                    {
                        if(data.status == 'error'){
                        jQuery('#download_progress .text').html("ERROR :".data.message);
                        clearInterval(downloader_application_interval);
                        }else if(data.status == 'finish'){                       
                        clearInterval(downloader_application_interval);
                            jQuery('#download_progress .text').html("Descargando...");
                        if(!downloaded) download();
                        }else{
                            var valeur = 0;
                            valeur = Math.round(data.actual * 100 / data.total);
                            jQuery('#download_progress .progress-bar').css('width', valeur+'%').attr('aria-valuenow', valeur); 
                            jQuery('#download_progress .progress-bar').html( valeur+'%');
                            jQuery('#download_progress .text').html(data.message);
                        
                        }
                    }
                });
                if(no_cancel){
                ajax_progress = false;
                }
    }
    var downloaded = false;
    function download(){
        downloaded = true;
        var req = new XMLHttpRequest();
        req.onprogress = updateProgress;
        req.open("GET", '<?=admin_url( 'admin-ajax.php' )?>?action=download&webid='+jQuery('#webId').val()+'&nonce=<?=$nonce?>&download_type=prescripcion_online', true);
        req.responseType = "blob";
        req.onload = function (event) {
            var blob = req.response;
            var fileName = jQuery('#webId').val() + '.zip';
            var link=document.createElement('a');
            link.href=window.URL.createObjectURL(blob);
            link.download=fileName;
            link.click();
        };

        req.send();
    }
    function updateProgress(evt) 
    {
        if (evt.lengthComputable) 
        {  // evt.loaded the bytes the browser received
            // evt.total the total bytes set by the header
            // jQuery UI progress bar to show the progress on screen
            var valeur =Math.round( (evt.loaded / evt.total) * 100);  
            jQuery('#download_progress .progress-bar').css('width', valeur+'%').attr('aria-valuenow', valeur); 
            jQuery('#download_progress .progress-bar').html(valeur+'%');
            if(valeur == 100){
                jQuery("#s_downloader_application").html("<h4><?php _e("Su descarga se ha completado","danosa-design-your-project"); ?></h4>");
                jQuery("#s_downloader_application").show();
                jQuery("#download_progress").fadeOut();
                objJson = [];
                window.localStorage.setItem('system_prescripcion_online', JSON.stringify(objJson));  
                window.localStorage.setItem('online_project_prescripcion_online', "");  
            }
        } 
    }  
       
</script>
<script>
 
    function createDinamicsForm(type){
        var type = jQuery('#type').val();
        var objJson =  jQuery("#partidasData"+type).val();  
         
       
        objJson = JSON.parse(objJson);  
        objJson.titproy = jQuery("#project_name").val();  
        objJson.comunidad = jQuery("#area").val();  

       

        var objJson2 = window.localStorage.getItem('system_prescripcion_online');
        objJson2 = JSON.parse(objJson2);
        if (Array.isArray(objJson2)) {
          objJson.sistemas = objJson2;
        }

        objJson = JSON.stringify(objJson);

        jQuery.ajax({
            type: "post",
            url: '<?=admin_url( 'admin-ajax.php' )?>',
            data: 'action=createDinamicsForm&nonce=<?=wp_create_nonce( 'create-dinamics-form-nonce' )?>&type='+type+'&guid='+ jQuery('#webId').val()+'&data='+objJson,
            success: function(result){
                jQuery('#webId').val(result);
            }
        });      
    }
</script>