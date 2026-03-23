<?php

function add_menu_dinamic($items, $args) {

    // Obtenemos el campo aquí dentro (no en el nivel raíz) para que ACF esté inicializado
    $merchants_bottom = function_exists('get_field') ? get_field("Filters description") : '';


        $iconArrow = '
        <span class="ast-icon icon-arrow">
            <svg enable-background="new 57 35.171 26 16.043" height="16.043px" id="Layer_1" version="1.1" viewbox="57 35.171 26 16.043" width="26px" x="0px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
                <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z">
                </path>
            </svg>
        </span>';

        $argstemp = array(
            'post_type' => 'page',
            'meta_key' => 'hreflang_ref',
            'meta_value' => 'products',
            'posts_per_page' => 1
          );

        $myPages = new WP_Query($argstemp);
        while ($myPages->have_posts()) : $myPages->the_post();
            $productLink = get_the_permalink();
            $productTitle = get_the_title();
        endwhile;

        wp_reset_postdata();

        if(getSiteCountry() == "gb"){
        $argstemp = array(
            'post_type' => 'page',
            'meta_key' => 'hreflang_ref',
            'meta_value' => 'merchants',
            'posts_per_page' => 1
          );

        $myPages = new WP_Query($argstemp);
        while ($myPages->have_posts()) : $myPages->the_post();
            $merchantLink = get_the_permalink();
            $merchantTitle = get_the_title();
        endwhile;

        wp_reset_postdata();
        }

        $argstemp = array(
            'post_type' => 'page',
            'meta_key' => 'hreflang_ref',
            'meta_value' => 'systems',
            'posts_per_page' => 1
          );

        $myPages = new WP_Query($argstemp);
        while ($myPages->have_posts()) : $myPages->the_post();
            $systemLink = get_the_permalink();
            $systemTitle = get_the_title();
        endwhile;


        wp_reset_postdata();


        $menu_append       = '';
    if ($args->menu_id == 'ast-hf-menu-1') {

        /* --------------------------------------------  MENU PRODUCTOS -------------------------------------------- */

        $parents = get_terms(array(
            'taxonomy'   => 'family',
            'hide_empty' => true,
            'parent'     => 0,
        ));

            $menu_append .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-products astra-megamenu-li full-stretched-width-mega" id="menu-item-products">
        <a class="menu-link" href="'.$productLink.'">
            '.$iconArrow.'
            <span class="menu-text">
                '.$productTitle.'
                <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                </span>
            </span>
            '.$iconArrow.'
            <span class="sub-arrow">
            </span>
        </a>
        <button aria-expanded="false" class="ast-menu-toggle">
            <span class="screen-reader-text">
                Alternar menú
            </span>
            '.$iconArrow.'
        </button>
        <div aria-haspopup="true" class="astra-full-megamenu-wrapper">
            <ul class="astra-megamenu sub-menu astra-mega-menu-width-full-stretched">';


        foreach ($parents as $key1 => $parent) {
            $term_id   = $parent->term_id;
            $destacado = "";
            $childrens = get_terms(array(
                'taxonomy'   => 'family',
                'hide_empty' => true,
                'parent'     => $term_id,
            ));

            $icon = get_field('icon', $parent);

            $menu_append .= '<li aria-haspopup="true" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6994" id="menu-item-6994">
                <a class="menu-link" href="'.get_term_link($parent).'">
                    '.$iconArrow.'
                    <span class="menu-text">
                        <img src="'.$icon.'" class="menu-products-icon" />
                        '.$parent->description.'
                        <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                        </span>
                    </span>
                    '.$iconArrow.'
                </a>
                <button aria-expanded="false" class="ast-menu-toggle">
                    <span class="screen-reader-text">
                        Alternar menú
                    </span>
                    '.$iconArrow.'
                </button>';

            if (count($childrens) > 0) {
                $menu_append .= '<ul class="sub-menu astra-megamenu-focus">';
                foreach ($childrens as $key2 => $children) {
                    $menu_append .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6995" id="menu-item-6995">
                        <a class="menu-link" href="'.get_term_link($children).'">
                            <span class="ast-icon icon-arrow">
                                <svg enable-background="new 57 35.171 26 16.043" height="16.043px" id="Layer_1" version="1.1" viewbox="57 35.171 26 16.043" width="26px" x="0px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
                                    <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z">
                                    </path>
                                </svg>
                            </span>
                            <span class="menu-text">
                                '.$children->description.'
                            </span>
                        </a>
                    </li>';
                }
                $menu_append .= '</ul>';
            } // end if count



        } // enf foreach parent


            $menu_append .= '</ul>
            </div>
        </li>';

        /* --------------------------------------------  END MENU PRODUCTOS -------------------------------------------- */


        /* --------------------------------------------  MENU MERCHANTS -------------------------------------------- */

        if(getSiteCountry() == "gb"){
        $parents = get_terms(array(
            'taxonomy'   => 'product_merchant',
            'hide_empty' => true,
            'parent'     => 0,
        ));

            $menu_append .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-products astra-megamenu-li full-stretched-width-mega" id="menu-item-products">
        <a class="menu-link" href="'.$merchantLink.'">
            '.$iconArrow.'
            <span class="menu-text">
                '.$merchantTitle.'
                <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                </span>
            </span>
            '.$iconArrow.'
            <span class="sub-arrow">
            </span>
        </a>
        <button aria-expanded="false" class="ast-menu-toggle">
            <span class="screen-reader-text">
                Alternar menú
            </span>
            '.$iconArrow.'
        </button>
        <div aria-haspopup="true" class="astra-full-megamenu-wrapper">
            <ul class="astra-megamenu sub-menu astra-mega-menu-width-full-stretched">';


        foreach ($parents as $key1 => $parent) {
            $term_id   = $parent->term_id;
            $destacado = "";
            $childrens = get_terms(array(
                'taxonomy'   => 'product_merchant',
                'hide_empty' => true,
                'parent'     => $term_id,
            ));

            $icon = get_field('icon', $parent);

            $menu_append .= '<li aria-haspopup="true" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6994" id="menu-item-6994">
                <a class="menu-link" href="'.get_term_link($parent).'">
                    '.$iconArrow.'
                    <span class="menu-text">
                        <img src="'.$icon.'" class="menu-products-icon" />
                        '.$parent->description.'
                        <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                        </span>
                    </span>
                    '.$iconArrow.'
                </a>
                <button aria-expanded="false" class="ast-menu-toggle">
                    <span class="screen-reader-text">
                        Alternar menú
                    </span>
                    '.$iconArrow.'
                </button>';

            if (count($childrens) > 0) {
                $menu_append .= '<ul class="sub-menu astra-megamenu-focus">';
                foreach ($childrens as $key2 => $children) {
                    $menu_append .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6995" id="menu-item-6995">
                        <a class="menu-link" href="'.get_term_link($children).'">
                            <span class="ast-icon icon-arrow">
                                <svg enable-background="new 57 35.171 26 16.043" height="16.043px" id="Layer_1" version="1.1" viewbox="57 35.171 26 16.043" width="26px" x="0px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
                                    <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z">
                                    </path>
                                </svg>
                            </span>
                            <span class="menu-text">
                                '.$children->description.'
                            </span>
                        </a>
                    </li>';
                }
                $menu_append .= '</ul>';
            } // end if count



        } // enf foreach parent


            $menu_append .= '</ul>
            </div>
        
</li><p>'.$merchants_bottom.'</p>';
        }
        /* --------------------------------------------  END MENU MERCHANTS -------------------------------------------- */


        /* --------------------------------------------  MENU SISTEMAS -------------------------------------------- */

        $parents = get_terms(array(
            'taxonomy'   => 'system_cat',
            'orderby'    => 'term_order',
            'hide_empty' => true,
            'parent'     => 0,
        ));

        if(!empty($parents)){

            $menu_append .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-systems astra-megamenu-li full-stretched-width-mega" id="menu-item-systems">
        <a class="menu-link" href="'.$systemLink.'">
            '.$iconArrow.'
            <span class="menu-text">
                '.$systemTitle.'
                <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                </span>
            </span>';

            if(getSiteCountry() != "gb"){
                $menu_append .= $iconArrow;
            }
            $menu_append .= '<span class="sub-arrow">
            </span>
        </a>
        <button aria-expanded="false" class="ast-menu-toggle">
            <span class="screen-reader-text">
                Alternar menú
            </span>';
            if(getSiteCountry() != "gb"){
                $menu_append .= $iconArrow;
            }
            $menu_append .= '
        </button>';

        if(getSiteCountry() != "gb"){

        $menu_append .= '<div aria-haspopup="true" class="astra-full-megamenu-wrapper">
            <ul class="astra-megamenu sub-menu astra-mega-menu-width-full-stretched">';


        foreach ($parents as $key1 => $parent) {
            $term_id   = $parent->term_id;
            $destacado = "";
            $childrens = get_terms(array(
                'taxonomy'   => 'system_cat',
                'orderby'    => 'term_order',
                'hide_empty' => true,
                'parent'     => $term_id,
            ));


            $menu_append .= '<li aria-haspopup="true" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6994" id="menu-item-6994">
                <a class="menu-link" href="'.get_term_link($parent).'">
                    '.$iconArrow.'
                    <span class="menu-text">
                        '.$parent->description.'
                        <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                        </span>
                    </span>
                    '.$iconArrow.'
                </a>
                <button aria-expanded="false" class="ast-menu-toggle">
                    <span class="screen-reader-text">
                        Alternar menú
                    </span>
                    '.$iconArrow.'
                </button>';

            if (count($childrens) > 0) {
                $menu_append .= '<ul class="sub-menu astra-megamenu-focus">';
                foreach ($childrens as $key2 => $children) {
                    $menu_append .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6995" id="menu-item-6995">
                        <a class="menu-link" href="'.get_term_link($children).'">
                            <span class="ast-icon icon-arrow">
                                <svg enable-background="new 57 35.171 26 16.043" height="16.043px" id="Layer_1" version="1.1" viewbox="57 35.171 26 16.043" width="26px" x="0px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
                                    <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z">
                                    </path>
                                </svg>
                            </span>
                            <span class="menu-text">
                                '.$children->description.'
                            </span>
                        </a>
                    </li>';
                }
                
				$menu_append .= '</ul>';
            } // end if count



        } // enf foreach parent
		
		$menu_append .= '</ul>';
		
		if(getSiteCountry() == "es"){ 
		
            $menu_append .= '<ul><li><a class="menu-link" style="padding-left:30px;color:#000"; href="/es-es/sistemas/">Filtros de búsqueda</a></li></ul>';
		};
			$menu_append .= '</div>';

        }

        $menu_append .= '</li>';

        }

        /* --------------------------------------------  END MENU SISTEMAS -------------------------------------------- */

    } // ast-hf-menu-1

    if ($args->menu_id == 'ast-hf-mobile-menu' || $args->menu_id == 'ast-desktop-toggle-menu') {

        /* --------------------------------------------  MENU PRODUCTOS -------------------------------------------- */

        $parents = get_terms(array(
            'taxonomy'   => 'family',
            'hide_empty' => true,
            'parent'     => 0,
        ));

            $menu_append .= '<li aria-haspopup="true" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1571" id="menu-item-products-mobile">
        <a class="menu-link" href="'.$productLink.'">
            '.$iconArrow.'
            <span class="menu-text">
                '.$productTitle.'
                <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                </span>
            </span>
            '.$iconArrow.'
        </a>
        <button aria-expanded="false" class="ast-menu-toggle">
            <span class="screen-reader-text">
                Alternar menú
            </span>
            '.$iconArrow.'
        </button>
        <ul class="sub-menu" style="display: none;">';


        foreach ($parents as $key1 => $parent) {
            $term_id   = $parent->term_id;
            $destacado = "";
            $childrens = get_terms(array(
                'taxonomy'   => 'family',
                'hide_empty' => true,
                'parent'     => $term_id,
            ));

            $icon = get_field('icon', $parent);

            $menu_append .= '        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1572" id="menu-item-1572">
            <a class="menu-link" href="'.get_term_link($parent).'">

                <span class="menu-text">
                        <img src="'.$icon.'" class="menu-products-icon" />
                        '.$parent->description.'
                </span>
            </a>
            </li>';


        } // enf foreach parent


            $menu_append .= '</ul>

        </li>';

        /* --------------------------------------------  END MENU PRODUCTOS -------------------------------------------- */


        /* --------------------------------------------  MENU MERCHANTS -------------------------------------------- */

        if(getSiteCountry() == "gb"){
        $parents = get_terms(array(
            'taxonomy'   => 'product_merchant',
            'hide_empty' => true,
            'parent'     => 0,
        ));

            $menu_append .= '<li aria-haspopup="true" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1571" id="menu-item-products-mobile">
        <a class="menu-link" href="'.$merchantLink.'">
            '.$iconArrow.'
            <span class="menu-text">
                '.$merchantTitle.'
                <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                </span>
            </span>
            '.$iconArrow.'
        </a>
        <button aria-expanded="false" class="ast-menu-toggle">
            <span class="screen-reader-text">
                Alternar menú
            </span>
            '.$iconArrow.'
        </button>
        <ul class="sub-menu" style="display: none;">';


        foreach ($parents as $key1 => $parent) {
            $term_id   = $parent->term_id;
            $destacado = "";
            $childrens = get_terms(array(
                'taxonomy'   => 'product_merchant',
                'hide_empty' => true,
                'parent'     => $term_id,
            ));

            $icon = get_field('icon', $parent);

            $menu_append .= '        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1572" id="menu-item-1572">
            <a class="menu-link" href="'.get_term_link($parent).'">

                <span class="menu-text">
                        <img src="'.$icon.'" class="menu-products-icon" />
                        '.$parent->description.'
                </span>
            </a>
            </li>';


        } // enf foreach parent


            $menu_append .= '</ul>

        </li><p>merchants</p>';

        }
        /* --------------------------------------------  END MENU MERCHANTS -------------------------------------------- */


        /* --------------------------------------------  MENU SISTEMAS BURGER-------------------------------------------- */

        $parents = get_terms(array(
            'taxonomy'   => 'system_cat',
            'orderby'    => 'term_order',
            'hide_empty' => true,
            'parent'     => 0,
        ));

        if(!empty($parents)){
            $menu_append .= '<li aria-haspopup="true" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1571" id="menu-item-systems-mobile">
        <a class="menu-link" href="'.$systemLink.'">
            '.$iconArrow.'
            <span class="menu-text">
                '.$systemTitle.'
                <span class="dropdown-menu-toggle" role="presentation" tabindex="0">
                </span>
            </span>
            '.$iconArrow.'
        </a>
        <button aria-expanded="false" class="ast-menu-toggle">
            <span class="screen-reader-text">
                Alternar menú
            </span>
            '.$iconArrow.'
        </button>
        <ul class="sub-menu" style="display: none;">';


        foreach ($parents as $key1 => $parent) {
            $term_id   = $parent->term_id;
            $destacado = "";
            $childrens = get_terms(array(
                'taxonomy'   => 'system_cat',
                'orderby'    => 'term_order',
                'hide_empty' => true,
                'parent'     => $term_id,
            ));

            $menu_append .= '        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1572" id="menu-item-1572">
            <a class="menu-link" href="'.get_term_link($parent).'">

                <span class="menu-text">
                        '.$parent->description.'
                </span>
            </a>
            </li>';


        } // enf foreach parent
		if(getSiteCountry() == "es"){ 
		
   $menu_append .= '<ul><li><a class="menu-link" style="padding-left:30px;color:#fff"; href="/es-es/sistemas/"><span class="menu-text">Filtros de búsqueda</span></a></li></ul>';
		};

            $menu_append .= '</ul>

        </li>';
        }
        /* --------------------------------------------  END MENU SISTEMAS -------------------------------------------- */

    } // end ast-hf-mobile-menu


    //echo $menu_append;

       $items = $menu_append . $items;
    return $items;
} // end add_menu_dinamic


    add_filter('wp_nav_menu_items', 'add_menu_dinamic', 10, 2);
