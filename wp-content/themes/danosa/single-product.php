<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if(isset($_GET["dop-pdf"])){
	if(isset($_GET["download"])){
		ob_start();
		include "single-product-dop-pdf.php";
		$pdf = ob_get_contents();
		ob_end_clean();		header("Content-type:application/pdf");
		header("Content-Disposition:attachment;filename='fichatecnica".$post->ID.".pdf'");		require_once __DIR__ . '/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($pdf);
		$mpdf->Output("Danosa DOP - ".get_the_title().".pdf", 'I');
	}else{
		include "single-product-dop-pdf.php";
	}
}elseif(isset($_GET["pdf"])){
	if(isset($_GET["download"])){
		ob_start();
		include "single-product-pdf.php";
		$pdf = ob_get_contents();
		ob_end_clean();		header("Content-type:application/pdf");
		header("Content-Disposition:attachment;filename='fichatecnica".$post->ID.".pdf'");		require_once __DIR__ . '/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($pdf);
		$mpdf->Output("Danosa - ".get_the_title().".pdf", 'I');
	}else{
		include "single-product-pdf.php";
	}
}else{

get_header(); ?>


<style>

    .m-d.expand-list{
        margin: 0;
        padding: 0;
    }
    .m-d.expand-list > li{
        list-style-type: none;
        padding: 15px 0;
        border-bottom: 1px solid #212121;
        position: relative;
/*         max-width: 80%; */
    }
    .m-d label[class^="tab"]:hover{
        cursor: pointer;
    }
    .m-d input{
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    .m-d input[class^="tab"]{
        width: 100%;
        height: 40px;
        position: absolute;
        left: 0;
        top: 0;
    }
		.m-d input[class^="tab"]:hover{
			cursor: pointer;
		}
    .m-d label[class^="tab"]{
        font-weight: bold;
    }
    .m-d .content{
        height: auto;
        max-height: 0;

/*        background: yellow;*/
        overflow: hidden;
        transform: translateY(20px);
        transition: all 180ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="100"] input[class^="tab"]:checked ~ .content{
        max-height: 100px;
        transition: all 150ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="200"] input[class^="tab"]:checked ~ .content{
        max-height: 200px;
        transition: all 200ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="300"] input[class^="tab"]:checked ~ .content{
        max-height: 300px;
        transition: all 250ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="400"] input[class^="tab"]:checked ~ .content{
        max-height: 400px;
        transition: all 250ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="500"] input[class^="tab"]:checked ~ .content{
        max-height: 500px;
        transition: all 250ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="600"] input[class^="tab"]:checked ~ .content{
        max-height: 600px;
        transition: all 250ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="700"] input[class^="tab"]:checked ~ .content{
        max-height: 700px;
        transition: all 300ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="800"] input[class^="tab"]:checked ~ .content{
        max-height: 800px;
        transition: all 300ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="900"] input[class^="tab"]:checked ~ .content{
        max-height: 900px;
        transition: all 300ms ease-in-out 0ms;
    }
    .m-d li[data-md-content="1000"] input[class^="tab"]:checked ~ .content{
        max-height: 1000px;
        transition: all 350ms ease-in-out 0ms;
    }
		.m-d li[data-md-content=""] input[class^="tab"]:checked ~ .content{
        max-height: 1000px;
        transition: all 250ms ease-in-out 0ms;
    }
    .m-d input[class^="tab"]:checked ~ .content{
        margin-bottom: 20px;
    }

    .m-d .open-close-icon{
        display: inline-block;
        position: absolute;
        right: 20px;
        transform: translatey(2px);
    }
    .m-d .open-close-icon i{
        position: absolute;
        left: 0;
    }
    .m-d .open-close-icon .fa-minus{
        transform:rotate(-90deg);
        transition: transform 150ms ease-in-out 0ms;
    }
    .m-d input[class^="tab"]:checked ~ .open-close-icon .fa-minus{
        transform: rotate(0deg);
        transition: transform 150ms ease-in-out 0ms;
    }
    .m-d .open-close-icon .fa-plus{
        opacity: 1;
        transform:rotate(-90deg);
        transition: opacity 50ms linear 0ms, transform 150ms ease-in-out 0ms;
    }
    .m-d input[class^="tab"]:checked ~ .open-close-icon .fa-plus{
        opacity: 0;
        transform: rotate(0deg);
        transition: opacity 50ms linear 0ms, transform 150ms ease-in-out 0ms;
    }

</style>

	<div id="primary" <?php astra_primary_class(); ?>>

			<main id="main" class="site-main">
				<?php
				if ( have_posts() ) :
					do_action( 'astra_template_parts_content_top' );

					while ( have_posts() ) :
						the_post();

						if($post->post_parent == 0){
							$parentId = $post->ID;
						}else{
							$parentId = $post->post_parent;
							$childId = $post->ID;
						}

						$commercial_sheet = get_field('commercial_sheet',$parentId);
						$dop = get_field('dop',$parentId);
						$image_sheet = get_field('image');
						if(empty($image_sheet)){
							$image_sheet = get_field('image_sheet',$parentId);
						}

						$certifications = wp_get_post_terms( $parentId, "system_certification", array( 'fields' => 'all' ) );
						$product_safety_datasheet = wp_get_post_terms( $parentId, "product_safety_datasheet", array( 'fields' => 'all' ) );

						$currentId = get_the_ID();


						$certificationIcons = array();
						foreach ($certifications as $key => $certification) {
							$certificationIcons[$certification->name] = get_field("icon",$certification);
						}

						$certificationIcons = array_unique($certificationIcons);
						$productName = get_the_title($parentId);
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <style>
        /* ===================================
           AUDAL PRODUCT PAGE - PREMIUM THEME
           =================================== */

        /* Reset contenedores Astra */
        .entry-content.clear {
            padding: 0 !important;
            max-width: 100% !important;
        }
        .ast-plain-container.ast-single-post #primary {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .ast-plain-container .site-content .entry-content {
            max-width: 100% !important;
            margin: 0 !important;
        }
        .ast-single-post .post-navigation,
        .ast-single-post .ast-post-nav {
            display: none !important;
        }
        /* Ocultar elementos duplicados del fragmento original */
        #product-variant-area #product-title,
        #product-variant-area #product-image,
        #product-variant-area #product-certification-icons {
            display: none !important;
        }

        /* ---- Layout principal ---- */
        .audal-product-wrapper {
            display: flex;
            flex-wrap: nowrap;
            min-height: 100vh;
            align-items: stretch;
            margin: 0;
            padding: 0;
        }

        /* ---- Columna Imagen (izquierda) ---- */
        .audal-product-media {
            flex: 0 0 50%;
            background-color: #e8e8e8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
        }
        .audal-product-media img.audal-main-img {
            width: 100%;
            max-width: 480px;
            height: auto;
            object-fit: contain;
            border-radius: 2px;
        }
        .audal-certification-icons {
            display: flex;
            gap: 20px;
            margin-top: 32px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .audal-certification-icons img {
            max-height: 48px;
            opacity: 0.75;
        }

        /* ---- Columna Info (derecha) ---- */
        .audal-product-info {
            flex: 0 0 50%;
            background: #fff;
            padding: 80px 64px 80px 64px;
            display: flex;
            flex-direction: column;
            gap: 0;
            min-height: 100vh;
            box-sizing: border-box;
        }

        /* Breadcrumb / Back link */
        .audal-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #888;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.03em;
            margin-bottom: 40px;
            transition: color 0.2s;
        }
        .audal-back-link:hover { color: #000; }
        .audal-back-link svg { flex-shrink: 0; }

        /* Título: Marca + Nombre */
        .audal-brand-name {
            font-size: 32px;
            font-weight: 700;
            color: #1a2e4c;
            margin: 0 0 4px 0;
            line-height: 1.1;
            font-family: inherit;
        }
        .audal-product-name {
            font-size: 36px;
            font-weight: 700;
            color: #e04e24;
            margin: 0 0 24px 0;
            line-height: 1.1;
            font-family: inherit;
        }
        .audal-product-excerpt {
            font-size: 15px;
            line-height: 1.7;
            color: #555;
            margin: 0 0 32px 0;
        }

        /* Botón DATASHEET - ancho completo */
        .audal-actions {
            margin-bottom: 48px;
        }
        .audal-btn-primary {
            display: block;
            width: 100%;
            padding: 16px 24px;
            background: #000;
            color: #fff;
            text-align: center;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-decoration: none;
            border-radius: 2px;
            transition: background 0.2s;
            box-sizing: border-box;
        }
        .audal-btn-primary:hover { background: #333; color: #fff; }
        .audal-btn-secondary {
            display: block;
            width: 100%;
            padding: 14px 24px;
            background: transparent;
            color: #000;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            text-decoration: none;
            border: 1px solid #000;
            border-radius: 2px;
            margin-top: 12px;
            transition: background 0.2s;
            box-sizing: border-box;
        }
        .audal-btn-secondary:hover { background: #f5f5f5; }

        /* Sección agrupada (Información / Documentación) */
        .audal-section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 700;
            color: #1a2e4c;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin: 0 0 4px 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e5e5;
        }
        .audal-section-label::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e04e24;
            flex-shrink: 0;
        }

        /* Acordeón naked – activa drawer lateral */
        .audal-accordion {
            width: 100%;
            margin-bottom: 40px;
        }
        .audal-accordion-item {
            border-bottom: 1px solid #e5e5e5;
        }
        .audal-accordion-header {
            width: 100%;
            padding: 18px 0;
            background: none;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-size: 15px;
            font-weight: 400;
            text-align: left;
            color: #1a2e4c;
            transition: color 0.2s;
        }
        .audal-accordion-header:hover { color: #e04e24; }
        .audal-accordion-arrow {
            flex-shrink: 0;
            color: #888;
            transition: color 0.2s;
        }
        .audal-accordion-header:hover .audal-accordion-arrow { color: #e04e24; }

        /* DRAWER LATERAL */
        .audal-drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 9000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        .audal-drawer-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        .audal-drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: min(560px, 90vw);
            height: 100vh;
            background: #fff;
            z-index: 9001;
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.32, 0.72, 0, 1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .audal-drawer-overlay.open .audal-drawer {
            transform: translateX(0);
        }
        .audal-drawer-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 32px 20px;
            border-bottom: 1px solid #e5e5e5;
            flex-shrink: 0;
        }
        .audal-drawer-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a2e4c;
            margin: 0;
        }
        .audal-drawer-close {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #888;
            transition: color 0.2s;
            line-height: 1;
        }
        .audal-drawer-close:hover { color: #000; }
        .audal-drawer-body {
            padding: 24px 32px 40px;
            overflow-y: auto;
            flex: 1;
            font-size: 14px;
            line-height: 1.75;
            color: #444;
        }
        .audal-drawer-body h3, .audal-drawer-body h4 { color: #1a2e4c; margin-top: 24px; }
        .audal-drawer-body table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .audal-drawer-body table tr { border-bottom: 1px solid #f0f0f0; }
        .audal-drawer-body table td { padding: 10px 0; color: #444; }
        .audal-drawer-body table td:last-child { text-align: right; color: #1a2e4c; font-weight: 500; }
        @media (max-width: 900px) { .audal-drawer { width: 100vw; } }

        /* CTA bar inferior */
        .audal-cta-bar {
            display: flex;
            border-top: 1px solid #e5e5e5;
            margin-top: auto;
        }
        .audal-cta-bar a {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 0;
            font-size: 14px;
            font-weight: 600;
            color: #1a2e4c;
            text-decoration: none;
            transition: color 0.2s;
        }
        .audal-cta-bar a:first-child {
            border-right: 1px solid #e5e5e5;
            padding-right: 32px;
        }
        .audal-cta-bar a:last-child {
            padding-left: 32px;
            color: #e04e24;
        }
        .audal-cta-bar a:hover { opacity: 0.75; }
        .audal-cta-arrow { font-size: 18px; }

        /* Sistemas relacionados (exterior) */
        #product-related-systems {
            background: #f5f5f5;
            padding: 80px 0;
        }
        #product-related-systems > div {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .audal-product-wrapper {
                flex-direction: column;
                min-height: auto;
            }
            .audal-product-media {
                flex: none;
                width: 100%;
                height: 50vw;
                min-height: 280px;
                position: relative;
                top: auto;
                padding: 40px 24px;
            }
            .audal-product-info {
                flex: none;
                width: 100%;
                padding: 40px 24px 60px;
                min-height: auto;
            }
            .audal-brand-name { font-size: 24px; }
            .audal-product-name { font-size: 28px; }
            .audal-cta-bar { flex-direction: column; }
            .audal-cta-bar a:first-child { border-right: none; border-bottom: 1px solid #e5e5e5; padding-right: 0; padding-bottom: 16px; }
            .audal-cta-bar a:last-child { padding-left: 0; padding-top: 16px; }
        }
    </style>
    <?php 
    // Extraer familia y logos antes de renderizar
    $familyTemp = wp_get_post_terms( $parentId, 'family', array( 'fields' => 'all' ) );
    $family_id = 0;
    $familyIcon = "";
    $familyDescription = "";
    if(!empty($familyTemp)){
        $family_id = get_term_top_most_parent($familyTemp[0]->term_id,"family");
        $familyTermObj = get_term( $family_id, "family" );
        $familyIcon = get_field("icon",$familyTermObj);
        $familyDescription = $familyTermObj->description;
    }
    ?>
    <div class="audal-product-wrapper">
        <!-- Columna Izquierda: Imagen con fondo gris -->
        <div class="audal-product-media">
            <?php if(!empty($image_sheet)){ ?>
                <img class="audal-main-img" src="<?php echo $image_sheet; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
            <?php } ?>
            <div class="audal-certification-icons">
                <?php if(!empty($familyIcon)){ ?>
                    <img src="<?php echo $familyIcon; ?>" alt="<?php echo $familyDescription; ?>" title="<?php echo $familyDescription; ?>" />
                <?php } ?>
                <?php foreach ($certificationIcons as $key => $value) {
                    if(!empty($value)){
                        echo '<img src="'.$value.'" alt="'.$key.'" title="'.$key.'" />';
                    }
                } ?>
            </div>
        </div>

        <!-- Columna Derecha: Información premium -->
        <div class="audal-product-info">
            <?php 
            $family_link = get_term_link($family_id, 'family');
            ?>
            <a href="<?php echo esc_url($family_link); ?>" class="audal-back-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                <?php _e("Volver a productos", "danosa"); ?>
            </a>

            <!-- Marca / Familia en azul oscuro -->
            <p class="audal-brand-name">Audal&#8482;</p>
            <!-- Nombre del producto en naranja -->
            <p class="audal-product-name"><?php echo $productName; ?></p>

            <!-- Excerpt -->
            <div class="audal-product-excerpt">
                <?php echo get_the_excerpt($parentId); ?>
            </div>

            <!-- Selector de variantes -->
            <div id="product-variant-area">
                <?php 
                ob_start();
                include("product/product-top.php");
                echo ob_get_clean();
                ?>
            </div>

            <!-- DATASHEET button -->  
            <div class="audal-actions">
                <a target="_blank" class="audal-btn-primary" href="<?php the_permalink(); ?>?pdf&download">
                    <?php _e("Datasheet","danosa"); ?>
                </a>
                <?php if(!empty($commercial_sheet)){ ?>
                    <a class="audal-btn-secondary" href="<?php echo $commercial_sheet; ?>" target="_blank">
                        <?php _e("Ficha comercial","danosa"); ?>
                    </a>
                <?php } ?>
            </div>

            <!-- Sección: INFORMACIÓN -->
            <p class="audal-section-label"><?php _e('Información', 'danosa'); ?></p>
            <div class="audal-accordion">
                <div class="audal-accordion-item">
                    <button class="audal-accordion-header" data-drawer="drawer-desc">
                        <span><?php _e('Descripción', 'danosa'); ?></span>
                        <svg class="audal-accordion-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
                <div class="audal-accordion-item">
                    <button class="audal-accordion-header" data-drawer="drawer-tech">
                        <span><?php _e('Características técnicas y medidas', 'danosa'); ?></span>
                        <svg class="audal-accordion-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
            </div>

            <!-- Sección: DOCUMENTACIÓN -->
            <?php if(!empty($certifications) || !empty($product_safety_datasheet)){ ?>
            <p class="audal-section-label"><?php _e('Documentación', 'danosa'); ?></p>
            <div class="audal-accordion">
                <div class="audal-accordion-item">
                    <button class="audal-accordion-header" data-drawer="drawer-docs">
                        <span><?php _e('Documentación relacionada', 'danosa'); ?></span>
                        <svg class="audal-accordion-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
            </div>
            <?php } ?>

            <!-- CTA bar: ¿Necesitas ayuda? | Ficha técnica -->
            <div class="audal-cta-bar">
                <a href="#">
                    <span><?php _e('¿Necesitas ayuda para elegir?', 'danosa'); ?></span>
                    <span class="audal-cta-arrow">&#8594;</span>
                </a>
                <a href="<?php the_permalink(); ?>?pdf&download" target="_blank">
                    <span><?php _e('Ficha técnica', 'danosa'); ?></span>
                    <span style="font-size:18px;">&#8675;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- DRAWERS: paneles que se deslizan desde la derecha -->

    <!-- Drawer: Descripción -->
    <div class="audal-drawer-overlay" id="drawer-desc-overlay">
        <div class="audal-drawer">
            <div class="audal-drawer-header">
                <h2 class="audal-drawer-title"><?php _e('Descripción', 'danosa'); ?></h2>
                <button class="audal-drawer-close" aria-label="Cerrar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="audal-drawer-body">
                <?php require_once("product/product-description.php"); ?>
            </div>
        </div>
    </div>

    <!-- Drawer: Características Técnicas -->
    <div class="audal-drawer-overlay" id="drawer-tech-overlay">
        <div class="audal-drawer">
            <div class="audal-drawer-header">
                <h2 class="audal-drawer-title"><?php _e('Características técnicas', 'danosa'); ?></h2>
                <button class="audal-drawer-close" aria-label="Cerrar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="audal-drawer-body">
                <?php require_once("product/product-datasheet.php"); ?>
            </div>
        </div>
    </div>

    <?php if(!empty($certifications) || !empty($product_safety_datasheet)){ ?>
    <!-- Drawer: Documentación -->
    <div class="audal-drawer-overlay" id="drawer-docs-overlay">
        <div class="audal-drawer">
            <div class="audal-drawer-header">
                <h2 class="audal-drawer-title"><?php _e('Documentación', 'danosa'); ?></h2>
                <button class="audal-drawer-close" aria-label="Cerrar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="audal-drawer-body">
                <?php require_once("product/product-downloads.php"); ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Sistemas Relacionados -->
    <div id="product-related-systems">
        <div>
            <?php require_once("product/product-related-systems.php"); ?>
        </div>
    </div>

    <?php echo do_shortcode("[danosa_banner]"); ?>
</div>

<script>
    // Abrir drawer al pulsar fila de acordeón
    document.querySelectorAll('.audal-accordion-header[data-drawer]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-drawer');
            const overlay = document.getElementById(id + '-overlay');
            if (overlay) {
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // Cerrar: botón X o click en el fondo
    document.querySelectorAll('.audal-drawer-overlay').forEach(overlay => {
        overlay.addEventListener('click', e => {
            if (e.target === overlay) closeDrawer(overlay);
        });
        const btn = overlay.querySelector('.audal-drawer-close');
        if (btn) btn.addEventListener('click', () => closeDrawer(overlay));
    });

    // Cerrar con Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.audal-drawer-overlay.open').forEach(o => closeDrawer(o));
        }
    });

    function closeDrawer(overlay) {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }
</script>
							<?php astra_entry_bottom(); ?>

						</article><!-- #post-## -->

						<?php astra_entry_after();

						endwhile;
					do_action( 'astra_template_parts_content_bottom' );
					else :
						do_action( 'astra_template_parts_content_none' );
					endif;
					?>
			</main><!-- #main -->

	</div><!-- #primary -->


<?php
	get_footer();
}
?>
