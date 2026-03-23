<?php
add_shortcode( 'country_selector', 'country_selector_function' );

function country_selector_function($atts, $content, $tag) {

    ob_start();

    ?>
    <div class="currentCountry">
        <img src="<?php echo getCountryFlag(); ?>" />
        <div>
            <span class="currentCountry-label"><?php _e("Region","danosa"); ?> / <?php _e("Language","danosa"); ?></span>
            <span class="currentCountry-text"><?php echo getCountryName(); ?> / <?php echo getCountryLanguage(); ?></span>
        </div>
    </div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}