
<?php

$campos = array(

    'descriptive_memory'            => array('name' => __('Descriptive Memory', "danosa"), 'origin' => 'field'), //memoria descriptiva
    'product_application'           => array('name' => __('Scope', 'danosa'), 'origin' => 'term'), //Campo de Aplicación
    'product_benefits'              => array('name' => __('Advantages & Benefits', 'danosa'), 'origin' => 'term'), //Ventajas y Beneficios
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

    'system_icon'                  => array('name' => __('Icon', 'danosa'), 'origin' => 'term'), //Icon

);

load_product_fields($campos,$parentId);