<?php
$paises = getContentCountries();

?>


<?php foreach ($paises as $continentekey => $continenteValue) { ?>
    <a href="" class="country-header accordion-lang"><span ><?php echo $continentekey; ?></span></a>
    <ul style="display: none;">
    <?php
    foreach ($continenteValue as $pais) { ?>
                <li class="language-item" id="<?php echo $pais["nombre"]; ?>">
                    <a href="<?php echo $pais["url"]; ?>" onclick="setCountryCookie('<?php echo $pais["url"]; ?>')">
                        <img class="flag" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/danosa/img/flags/<?php echo $pais["icono"]; ?>.svg" alt="">
                        <span class="countryName"><?php echo $pais["nombre"]; ?></span>
                    </a>
                </li>
    <?php } ?>
    </ul>
<?php } ?>
<script>

function setCountryCookie( cvalue) {
  var d = new Date();
  d.setTime(d.getTime() + (365*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie =   "YourCountry=" + cvalue + ";" + expires + ";path=/";
}

//jQuery('#lighboxCountries > ul:not(:first)').hide();
jQuery('#lighboxCountries > ul').each(function() {
    if (jQuery(this).css("display") === 'flex') {
        jQuery(this).prev().toggleClass("active");
    }
});

jQuery('#lighboxCountries > a').click(function() {
    var self = jQuery(this);

    self.toggleClass("active");

    var accordionContent = self.next('ul');
    //accordionContent.slideToggle("slow");
    accordionContent.slideToggle('medium', function() {
        //if ($(this).is(':visible'))
        //    $(this).css('display', 'flex');
    });

    return false;
});

</script>