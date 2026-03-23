<?php
add_shortcode( 'search_button', 'search_button_function' );



function search_button_function() {

    ob_start();


    ?>
    <i class='danosa-search'></i>

    <div class="currentCountry">
        <img src="<?php echo getCountryFlag(); ?>" />
    </div>
    <?php

    $output = ob_get_contents();
    ob_end_clean();

return $output;
}



add_action( 'astra_masthead_bottom', 'search_modal_function' );

function search_modal_function() {
    $get_post_type = get_post_type();
    $hreflang_ref= get_field("hreflang_ref");
    if($hreflang_ref == "systems" || $hreflang_ref == "system_acoustics" || is_tax('system_cat')  || is_tax('system_acoustic')){
        $get_post_type = "system";
    }else if($get_post_type != "system" && $get_post_type != "product" && $get_post_type != "documentation" && $get_post_type != "post"){
        $get_post_type = "product";
    }
    ?>
    <div id="search-container" style="display: none;">
        <div id="search-input-container">
            <div class="ast-container">
                <div id="search-input" style="display: none;"></div>
                <div id="search-inputTmp">
                    <div class="ais-SearchBox">
                        <form action="" role="search" class="ais-SearchBox-form" novalidate="">
                            <input class="ais-SearchBox-input" type="search" placeholder="<?= __("What are you looking for?","danosa")?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="512">

                        </form>
                    </div>
                </div>
                <?php
                        $most_searched = get_field("most_searched","option");

                        if(!empty($most_searched)){ ?>
                        <div id="top-search">
                            <strong><?= __("Most searched","danosa")?></strong>
                            <?php

                            $most_searched = explode(",", $most_searched);

                            foreach ($most_searched as $key => $value) {
                                ?>
                                <span><?php echo trim($value); ?></span>
                                <?php
                            }
                            ?>
                        </div>
                <?php } ?>
            </div>
        </div>
        <div id="search-results-container" style="display: none;">
            <div class="ast-container">

                <div id="search-tabs" class="danosa-tabs" data-type="<?=$get_post_type?>" data-type2="<?= get_post_type()?>" data-type3="<?=$hreflang_ref?>">
                    <a href="#" class="tab <?=$get_post_type == "product"?"active":"";?>" id="hits-search-products-tab" data-toggle-target="#hits-search-products"><?php _e("Products","danosa"); ?><span id="hits-search-products-count"></span></a>
                    <?php if(!empty(getSiteCountry()) && getSiteCountry() != "gb"){ ?><a href="#" class="tab <?=$get_post_type == "system"?"active":"";?>" id="hits-search-systems-tab" data-toggle-target="#hits-search-systems"><?php _e("Systems","danosa"); ?><span id="hits-search-systems-count"></span></a><?php } ?>
                    <a href="#" class="tab <?=$get_post_type == "documentation"?"active":"";?>" id="hits-search-documentation-tab" data-toggle-target="#hits-search-documentation"><?php _e("Documentation","danosa"); ?><span id="hits-search-documentation-count"></span></a>
                    <?php if(!empty(getSiteCountry()) && getSiteCountry() != "gb"){ ?><a href="#" class="tab <?=$get_post_type == "post"?"active":"";?>" id="hits-search-posts-tab" data-toggle-target="#hits-search-posts"><?php _e("News","danosa"); ?><span id="hits-search-posts-count"></span></a><?php } ?>
                </div>

                <div id="hits-search-products" class="tab-content <?=$get_post_type == "product"?"active":"";?>"></div>
                <div id="hits-search-systems" class="tab-content <?=$get_post_type == "system"?"active":"";?>"></div>
                <div id="hits-search-documentation" class="tab-content <?=$get_post_type == "documentation"?"active":"";?>"></div>
                <div id="hits-search-posts" class="tab-content <?=$get_post_type == "post"?"active":"";?>"></div>

                <div id="stats"></div>

            </div>
        </div>
    </div>
    <?php


}

