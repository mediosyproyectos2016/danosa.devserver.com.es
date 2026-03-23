<?php

$nonce = wp_create_nonce( 'online-project-post-nonce' );
$webId =  date("md").".".get_the_ID().".".date("His");
?>
<div class="cad-list-container">
	  <?php
        $system_data_sheet = get_field("system_data_sheet");
        $bim = get_field("bim");
		$dwg_details = get_field("dwg_details");
        $decomposed_prices = get_field("decomposed_prices");

		if(!empty($dwg_details)){
			//get_download_link("DWG",$dwg_details);
		}
		if(!empty($decomposed_prices)){
			//get_download_link(__("Precios descompuestos","danosa"),$decomposed_prices);
		}
		?>


</div>

<h2><?php _e("System documentation download","danosa"); ?> <?php the_title(); ?></h2>


    <div id="downloader_application">
        <form action="#" id="f_downloader_application"   class="contact_form" method="post">
            <input type="hidden" name="post_id" value="<?=get_the_ID()?>">
            <div id="downloader-application-checkbox">
                <?php if(!empty($system_data_sheet)){ ?>
                <label>
                    <input type="checkbox" name="system_data_sheet"  data-nombre="danosa_ficha_sistema_<?php the_title(); ?>.pdf" checked="">
                    <div>
                        <strong><?php _e("System Datasheet","danosa"); ?></strong>
                        <?php if(1==2){ ?><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><?php } ?>
                    </div>
                </label>
                <?php } ?>

                <?php if(!empty($bim)){ ?>
                <label>
                    <input type="checkbox" name="bim"  data-nombre="danosa_bim_sistema_<?php the_title(); ?>.rvt">
                    <div>
                        <strong><?php _e("System BIM","danosa"); ?></strong>
                        <?php if(1==2){ ?><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><?php } ?>
                    </div>
                </label>
                <?php } ?>

                <?php
                if($hasCertifications){ ?>
                <label>
                    <input type="checkbox" name="certifications"  data-nombre="danosa_certification_<?php the_title(); ?>.png">
                    <div>
                        <strong><?php _e("System Certifications","danosa"); ?></strong>
                        <?php if(1==2){ ?><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><?php } ?>
                    </div>
                </label>
                <?php } ?>

                <?php if(!empty($dwg_details)){ ?>
                <label>
                    <input type="checkbox" name="dwg_details"  data-nombre="danosa_sistema_<?php the_title(); ?>.dwg">
                    <div>
                        <strong><?php _e("System DWG","danosa"); ?></strong>
                        <?php if(1==2){ ?><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><?php } ?>
                    </div>
                </label>
                <?php } ?>

                <?php if(!empty($decomposed_prices)){ ?>
                <label>
                    <input type="checkbox" name="decomposed_prices"   data-nombre="danosa_precios_descompuestos_sistema_<?php the_title(); ?>.xlsx">
                    <div>
                        <strong><?php _e("Decomposed prices","danosa"); ?></strong>
                        <?php if(1==2){ ?><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><?php } ?>
                    </div>
                </label>
                <?php } ?>

                <label>
                    <input type="checkbox" name="check_productos_ft" data-verif="ok" onclick="seleccionar_productos('check_productos_ft');">
                    <div>
                        <strong><?php _e("Product datasheets","danosa"); ?></strong>
                        <?php if(1==2){ ?><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><?php } ?>
                    </div>
                </label>

                <label>
                    <input type="checkbox" name="check_productos_fs" data-verif="ok" onclick="seleccionar_productos('check_productos_fs');">
                    <div>
                        <strong><?php _e("Product Safety datasheets","danosa"); ?></strong>
                        <?php if(1==2){ ?><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><?php } ?>
                    </div>
                </label>


                <?php
                $products = get_field("products");

                if(!empty($products)){

                    $products = explode(",", $products);

                    $products = array_map("sanitize_title", $products);

                    $args = array(
                      'post_type'       => 'product',
                      'post_name__in'        => $products
                    );
                    $the_query  = new WP_Query( $args );


                    // The Loop
                    if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            ?>
                                <input type="checkbox" name="ficha_seguridad[]" style="display: none;" class="check_productos_fs" value="<?=get_the_ID()?>" data-nombre="danosa_fseguridad_<?php echo sanitize_title(get_the_title()); ?>.pdf" style="display:block;">
                                <input type="checkbox" name="ficha_tecnica[]" style="display: none;" class="check_productos_ft" value="<?=get_the_ID()?>" data-nombre="danosa_ftecnica_<?php echo sanitize_title(get_the_title()); ?>.pdf" style="display:block;">

                            <?php

                        }

                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
               }
                ?>
            </div>
            <div id="downloader-application-data">
                <div class="">
                    <h2><?php _e("You must enter your details to download","danosa"); ?></h2>

                    <h4><?php _e("Personal data","danosa"); ?></h4>

                    <div class="wp-block-columns">
                        <div class="wp-block-column">
                            <label for="telefono"><?php _e("Name","danosa"); ?>:*</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="wp-block-column">
                            <label for="surname"><?php _e("Surname","danosa"); ?>:*</label>
                            <input type="text" name="surname" id="surname" required>
                        </div>
                       
                    </div>

                    <div class="wp-block-columns">
                       
                        <div class="wp-block-column">
                            <label class="datos"><?php _e("E-mail","danosa"); ?>:*</label>
                            <input type="email" name="E-mail" id="E-mail" placeholder="<?php _e("your@mail.com","danosa"); ?>" required="">
                        </div>
                         <div class="wp-block-column">
                            <label for="telefono"><?php _e("Phone","danosa"); ?>:*</label>
                            <input type="text" name="phone" id="phone" required>
                        </div>
                    </div>

                     <div class="wp-block-columns">
                        <div class="wp-block-column">
                            <label class="datos" for="titulacion"><?php _e("Degree","danosa"); ?>:*</label>
                            <select name="titulacion" id="titulacion" placeholder="<?php _e("Degree","danosa"); ?>" required>
                                <option value="0"><?php _e("Select an option","danosa"); ?></option>
                                <option value="<?php _e("Architect","danosa"); ?>"><?php _e("Architect","danosa"); ?></option>
                                <option value="<?php _e("Technical Architect","danosa"); ?>"><?php _e("Technical Architect","danosa"); ?></option>
                                <option value="<?php _e("Civil Engineer","danosa"); ?>"><?php _e("Civil Engineer","danosa"); ?></option>
                                <option value="<?php _e("Public Works Engineer","danosa"); ?>"><?php _e("Public Works Engineer","danosa"); ?></option>
                                <option value="<?php _e("Other engineering","danosa"); ?>"><?php _e("Other engineering","danosa"); ?></option>
                                <option value="<?php _e("Other","danosa"); ?>"><?php _e("Other","danosa"); ?></option>
                            </select>
                        </div>
                       <div class="wp-block-column">
                            <label class="datos"  for="company"><?php _e("Company","danosa"); ?>:*</label>
                            <input type="text" name="company" id="company" required>
                        </div>
                    </div>

                     <div class="wp-block-columns">
                        <div class="wp-block-column">
                            <label class="datos" for="activity"><?php _e("Activity","danosa"); ?>:*</label>
                            <select name="activity" id="activity">
                                <option value="" selected disabled><?php _e("Seleccione una actividad ...","danosa"); ?></option>
                                <option value="Constructora"><?php _e("Constructora","danosa"); ?></option>
                                <option value="Promotora"><?php _e("Promotora","danosa"); ?></option>
                                <option value="Arquitectura / Ingeniería"><?php _e("Arquitectura / Ingeniería","danosa"); ?></option>
                                <option value="Instalador"><?php _e("Instalador","danosa"); ?></option>
                                <option value="Distribuidor"><?php _e("Distribuidor","danosa"); ?></option>
                                <option value="Particular"><?php _e("Particular","danosa"); ?></option>
                                <option value="Estudiante"><?php _e("Estudiante","danosa"); ?></option>
                                <option value="Otros"><?php _e("Otros","danosa"); ?></option>
                            </select>
                        </div>
                        <div class="wp-block-column">
                            <label for="cpos"><?php _e("Cpos","danosa"); ?>:*</label>
                            <input type="text" name="cpos" id="cpos" required>
                        </div>
                    </div>

                    <div class="wp-block-columns">      
                     	<div class="wp-block-column">
                            <label class="datos" for="city"><?php _e("City","danosa"); ?>:*</label>
                            <input type="text" name="city" id="city"  required >
                        </div>
                        <div class="wp-block-column">
                        </div>
                        
                    </div>

                    <h4><?php _e("Project data","danosa"); ?></h4>


                    <div class="wp-block-columns">
                        <div class="wp-block-column">
                            <label class="datos" for="titproy"><?php _e("Project title","danosa"); ?>:*</label>
                            <input type="text" name="titproy" id="titproy" placeholder="<?php _e("Project title","danosa"); ?>" required>
                        </div>

                        <?php
                        switch (getSiteCountry()) {
                            case 'es':
                                $regions = array("Álava"," Albacete"," Alicante"," Almería"," Asturias"," Ávila"," Badajoz"," Barcelona"," Burgos"," Cáceres"," Cádiz"," Cantabria"," Castellón"," Ceuta"," Ciudad Real"," Córdoba"," Cuenca"," Girona"," Las Palmas"," Granada"," Guadalajara"," Guipúzcoa"," Huelva"," Huesca"," Illes Balears"," Jaén"," A Coruña"," La Rioja"," León"," Lleida"," Lugo"," Madrid"," Málaga"," Melilla"," Murcia"," Navarra"," Ourense"," Palencia"," Pontevedra"," Salamanca"," Segovia"," Sevilla"," Soria"," Tarragona"," Santa Cruz de Tenerife"," Teruel"," Toledo"," Valencia"," Valencia"," Valladolid"," Vizcaya"," Zamora"," Zaragoza");
                                break;
                            case 'pt':
                                $regions = array("Açores","Aveiro","Beja","Braga","Bragança","Castelo Branco","Coimbra","Évora","Faro","Guarda","Leiria","Lisboa","Madeira","Portalegre","Porto","Santarém","Setúbal","Viana do Castelo","Vila Real","Viseu");
                                break;
                            case 'fr':
                                $regions = array("Auvergne-Rhône-Alpes","Bourgogne-Franche-Comté","Bretagne","Centre-Val de Loire","Corse","Grand Est","Hauts-de-France","Île-de-France","Normandie","Nouvelle-Aquitaine","Occitanie","Pays de la Loire","Provence-Alpes-Côte d'Azur");
                                break;
                            case 'gb':
                                $regions = array("East of England","East Midlands","London","North East","North West","South East","South West","West Midlands","Yorkshire and the Humber");
                                break;
                            default:
                                $regions = array();
                                break;
                        }
                        ?>
                        <div class="wp-block-column">
                            <label for="comunidad"><?php _e("Project location","danosa"); ?>:*</label>
                            <select name="comunidad" id="comunidad" placeholder="<?php _e("Select your region","danosa"); ?>" required>
                                <option value="0"><?php _e("Select your region","danosa"); ?> </option>
                                <?php foreach ($regions as $value) {
                                    ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php
                                } ?>
                            </select>
                        </div>
                    </div>


                    <input type="hidden" name="country" id="country" value="<?php getSiteCountry(); ?>">

                    <input type="hidden" name="file_name" id="nombre_sistema" value="<?php the_title(); ?>">
                    <input type="hidden" name="titulo_sistema" id="titulo_sistema" value="<?= strip_tags(get_the_content()); ?>">
                    <input type="hidden" name="imagen_sistema" id="imagen_sistema" value="<?php echo $image; ?>">

                    <div class="downloader-application-data-legal">
                        <label>
                            <input class="ch" type="checkbox" name="SI_QUIERO_INSCRIBIRME" required="">
                            <span class="insc">
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
                                <?php echo $form_texto_politica_privacidad; ?> <a href="<?php echo $form_link_politica_privacidad; ?>"><?php echo $form_anchor_politica_privacidad; ?></a>.
                            </span>
                        </label>
                    </div>
                    <button id="s_downloader_application"  class="submit" type="submit" name="enviar" value="Enviar formulario"><?php _e("Download selected","danosa"); ?></button>

                    <div class="progress" id="download_progress" style="display:none;">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      <div class="text"></div>
                    </div>
                    <input type="hidden" name="nonce" value="<?=$nonce?>">
                    <input type="hidden" name="webid" id="webId" value="<?=$webId?>">
                    <input type="hidden" name="callback" value="my_system_download_post_create">
                    <input type="hidden" name="download_type" value="system">
                    <input type="hidden" name="action" value="download_post">
                </div>
            </div>

        </form>
    </div>
    <script>
    var downloader_application_interval;
    jQuery( document ).ready(function() {
        jQuery( "#f_downloader_application" ).submit(function( event ) {
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
                  data: jQuery( "#f_downloader_application" ).serialize(),
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
        var webid = jQuery("#webId").val();
        if(webid != ""){
            var req = new XMLHttpRequest();
            req.onprogress = updateProgress;
            req.open("GET", '<?=admin_url( 'admin-ajax.php' )?>?action=download&webid=<?=$webId?>&nonce=<?=$nonce?>&download_type=system&file_name=<?= sanitize_text_field(the_title()); ?>', true);
            req.responseType = "blob";
            req.onload = function (event) {
                var blob = req.response;
                var fileName = '<?= sanitize_text_field(the_title()); ?>.zip';
                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download=fileName;
                link.click();
            };

            req.send();
        }

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
            //jQuery("#s_downloader_application").show();
            jQuery("#download_progress").fadeOut();
            jQuery("#webId").val('');
         }
       }
    }

    </script>