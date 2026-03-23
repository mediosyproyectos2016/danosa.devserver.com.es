<div class="wp-block-group__inner-container">
    <div class="wp-block-buttons">

        <div class="wp-block-button"><a id="system-download-button" class="wp-block-button__link download" href="#"><?php _e("Downloads","danosa"); ?></a></div>
        <script type="text/javascript">
            jQuery( "#system-download-button" ).click(function(e) {
                e.preventDefault();
                jQuery( "#system-tabs > a.tab:last-of-type" ).click();
                jQuery('html, body').animate({
                    scrollTop: jQuery("#system-tabs").offset().top
                }, 1000);
            });
        </script>


        <?php if(!empty($system_data_sheet)){ ?>
        <div class="wp-block-button"><a class="wp-block-button__link download" href="<?php echo $system_data_sheet; ?>" target="_blank"><?php _e("Datasheet","danosa"); ?></a></div>
        <?php } ?>
        <?php if(!empty($bim)){ ?>
        <div class="wp-block-button"><a class="wp-block-button__link download" href="<?php echo $bim; ?>" target="_blank"><?php _e("BIM","danosa"); ?></a></div>
        <?php } ?>


        <?php
        $certifications = wp_get_post_terms( get_the_ID(), "system_certification", array( 'fields' => 'all' ) );
        $hasCertifications = false;

        foreach ($certifications as $key => $certification) {
            $certificationLink = get_field("file",$certification);

            if(!empty($certificationLink)){
                $hasCertifications = true;
                ?>
                <div class="wp-block-button"><a class="wp-block-button__link secondary download" href="<?php echo $certificationLink; ?>" title="<?php echo $certification->name; ?>" target="_blank"><?php _e("Certificate","danosa"); ?></a></div>
                <?php
            }
        }


        ?>
         <?php if(getSiteCountry() == "es" || getSiteCountry() == "pt"){ ?>
            <?php $design_your_project = do_shortcode("[link_hreflang hreflang='design_your_project']"); ?>
            <div class="wp-block-button" style="display:none" id="sth1"><a class="wp-block-button__link" href="<?php echo $design_your_project; ?>"><?php _e("Ver Proyecto","danosa"); ?><span class="sthn"  ></span></a></div>
            <div class="wp-block-button" style="display:none" id="sth2">
                <a class="wp-block-button__link" onclick="jQuery.featherlight('#sth2Add', {variant: 'sth2Add'});jQuery('#sth3').find('input').focus();">
                    <?php _e("Añadir A Proyecto","danosa"); ?><span class="sthn" style="display:none"></span>
                </a>
            </div>
            <div class="wp-block-button" style="display:none" id="sth3">
                <div id="sth2Add">           
                    <h5><?php _e("Introduzca los metros cuadrados necesarios de este sistema  para el proyecto","danosa"); ?></h5>
                    <div class="wp-block-button__link system" >m&#178;
                        <input type="number" min="0" name="agregaraproyecto" id="agregaraproyecto"  class="any" style=""  value="">
                        <button class="btn btn-success" onclick="var n = jQuery(this).parent().find('input').val();   if(n == ''){alert('<?php _e("Indique los metros cuadrados","danosa"); ?>'); return false;}else{ addPrescripcionSistemas(<?=get_the_ID()?>,'<?=end($title)?>',n,'<?= explode(" ",strtoupper(get_the_content(null,false,get_the_ID())))[0]?>','<?=get_the_permalink(get_the_ID())?>','<?php echo get_the_content(null,false,get_the_ID()); ?>','','');jQuery('#sth1').show();jQuery('#sth2').hide();jQuery('#sth3').hide();let c = jQuery('.sthn').html(); c++; jQuery('.sthn').html(c );jQuery.featherlight.close();jQuery.featherlight('#sth4Add', {variant: 'sth4Add'});return false;}"><?php _e("Añadir","danosa"); ?></button>
                    </div>
                </div>
            </div>
            <div class="wp-block-button" style="display:none" id="sth4">
                <div id="sth4Add">           
                    <h5><?php _e("Se ha añadido el sistema","danosa"); ?> <?=end($title)?> <?php _e("al proyecto","danosa"); ?> </h5>
                        <?php $design_your_project = do_shortcode("[link_hreflang hreflang='design_your_project']"); ?>
                       <div class="wp-block-button"><a class="wp-block-button__link" href="<?php echo $design_your_project; ?>"><?php _e("Ir al proyecto","danosa"); ?><span class="sthn"  ></span></a></div>
                       <div class="wp-block-button"><a class="wp-block-button__link" href="#" onclick="jQuery.featherlight.close();"><?php _e("Seguir navegando","danosa"); ?></a></div>
                   
                </div>
            </div>
      <script>
        jQuery(document).ready(function() {
   
            var objJson = window.localStorage.getItem('system_prescripcion_online');
            objJson = JSON.parse(objJson);
            if (!Array.isArray(objJson)) {
                objJson = [];
            }
            let f = false;
            let c = 0;
            objJson.forEach(function (obj, index, object) {
               
                if (obj != null  ) {
                c +=1;
                   if (  obj.sistema == <?=get_the_ID()?>) {
                    f = true; 
                    }
                }
                 
            });
            if(f){             
                jQuery('#sth1').show();
            }else{
            
                jQuery('#sth2').show();
            }
            
            if(c > 0){
               
                jQuery('.sthn').html(c );
                jQuery('.sthn').show();
            }
   
        });
      </script>
            <?php } ?>
    </div>

    <div id="system-icons">
        <?php
            $icons = array();


            $iconsTemp = wp_get_post_terms( get_the_ID(), 'system_icon', array( 'fields' => 'all' ) );

            if(!empty($iconsTemp)){
                foreach ($iconsTemp as $key => $value) {
                    $icons[$value->description] = get_field("icon",$value);
                }
            }

            if(!empty($icons)){
                foreach ($icons as $key => $value) {
                    ?>
                    <img src="<?php echo $value; ?>" alt="<?php echo $key; ?>" title="<?php echo $key; ?>" />
                    <?php
                }
            }
        ?>
    </div>
</div>