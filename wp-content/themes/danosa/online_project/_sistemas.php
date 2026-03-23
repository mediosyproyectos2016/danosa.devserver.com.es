<h4><?= __("DISTRIBUCIÓN DE PARTIDAS","danosa-design-your-project")?></h4>
<div  class="PrescripcionSistemas"></div>
<?php
if(false && is_user_logged_in()){
 $args = array(
        'post_type' => 'system',
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => -1,
    );

   
 

 
    $the_query = new WP_Query( $args );

 
     $sistemas = array();
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $title = explode("_",get_the_title());
            $id = get_the_ID();
            $sistemas[$id] = end($title);

          
        }
    
  
    /* Restore original Post Data */
    wp_reset_postdata();



?>
  <div class="wp-block-columns alternate">
            <div class="wp-block-column">
             
                    <span>M&#178;: <span>0.00</span></span>
                    <span  class="wpcf7-form-control-wrap">
                    <input id="addSistemaMM<?=$type?>" type="text"  value="" size="40">
                    </span>
              
            </div>
            <div class="wp-block-column">
          
                    <span><?= __("Sistema","danosa-design-your-project")?>:</span>
                    <span class="wpcf7-form-control-wrap">
                    <select id="addSistema<?=$type?>"  >
                    <option value="" selected disabled><?= __("SELECCIONE EL SISTEMA","danosa-design-your-project")?></option>
                       <?php
                      foreach($sistemas as $key => $value){?>
                      <option value="<?=$key?>"><?=$value?></option>
                     <?php }
                      ?>
                    </select>
                    </span>

            </div>

            <div class="wp-block-column">
                <button onclick="return addPrescripcionSistemas(jQuery('#addSistema<?=$type?>').val(),jQuery( '#select2-addSistema<?=$type?>-container' ).html(),jQuery( '#addSistemaMM<?=$type?>' ).val(),..);"><?=__("Añadir sistema","danosa-design-your-project")?></button>
            </div>
</div>
 <?php } ?>