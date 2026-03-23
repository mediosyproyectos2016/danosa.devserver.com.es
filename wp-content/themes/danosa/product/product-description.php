<?php
if(!isset($_GET["pdf"])){ ?>
<div class="product-data">
<?php echo get_the_content(null,false,$parentId); ?>
</div>


                                <?php
                                    $video = get_field("url_video");
                                    if(!empty($video)){
                                        $ytcode = getYoutubeCode($video);
                                        ?>

                                        <div id="system-video" class="product-data product-data-term">
                                            <div class="wp-block-group__inner-container">
                                                <h3><?php _e("Installation video","danosa"); ?></h3>
                                                <div
                                                  class="youtube-player pristine"
                                                  data-video-id="<?php echo $ytcode; ?>">
                                                  <img src="https://img.youtube.com/vi/<?php echo $ytcode; ?>/sddefault.jpg" alt="custom-preview">
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                    }
                                ?>

<?php
}

$campos = array(
    'product_application'           => array('name' => __('Scope', 'danosa'), 'origin' => 'term'), //Campo de Aplicación
    'product_benefits'              => array('name' => __('Advantages & Benefits', 'danosa'), 'origin' => 'term'), //Ventajas y Beneficios
    'descriptive_memory'            => array('name' => __('Descriptive Memory', "danosa"), 'origin' => 'field'), //memoria descriptiva
    'product_support'               => array('name' => __('Support', 'danosa'), 'origin' => 'term'), //Soporte
    'product_substrate_preparation' => array('name' => __('Substrate preparation', 'danosa'), 'origin' => 'term'), //Preparación del soporte
    'instruction_for_use'           => array('name' => __('Instruction for Use', "danosa"), 'origin' => 'field'), //Modo de empleo
    'product_important_indications' => array('name' => __('Indications and Important Recommendations', 'danosa'), 'origin' => 'term'), //Indicaciones Importantes y Recomendaciones
    'product_maintenance'           => array('name' => __('Maintenance Recommendations', "danosa"), 'origin' => 'term'), //Recomendaciones de mantenimiento
    'product_warning'               => array('name' => __('Warning', 'danosa'), 'origin' => 'term'), //Precauciones
    'product_conservation'          => array('name' => __('Handling, storage and preservation', 'danosa'), 'origin' => 'term'), //Manipulación, Almacenaje y Conservación
    'cleaning_of_work_tools'        => array('name' => __('Cleaning of Work Tools', "danosa"), 'origin' => 'field'), //Limpieza de las herramientas
    'product_safety_hygiene'        => array('name' => __('Safety and hygiene', 'danosa'), 'origin' => 'term'), //Seguridad e higiene
    'product_notice'                => array('name' => __('Notice', 'danosa'), 'origin' => 'term'), //Aviso
    'product_icon'                  => array('name' => __('Icon', 'danosa'), 'origin' => 'term'), //Icon
);

load_product_fields($campos,$parentId);