<?php

function getSiteCountry() {
	return "es";
    $path = get_blog_details(get_current_blog_id())->path;
    if ($path == '/global/' || $path == "/") {
        return "";
    } else {
        $return = str_replace("/", "", $path);
        $return = explode("-", $return);
        $return = $return[1];

        return $return;
    }
}
function getSiteLanguage() {
	return "es";
    $path = get_blog_details(get_current_blog_id())->path;
    if ($path == '/global/' || $path == "/") {
        return "en";
    } else {
        $return = str_replace("/", "", $path);
        $return = explode("-", $return);
        $return = $return[0];

        return $return;
    }
}

function getContentCountries() {
    switch_to_blog(1);
    $baseURL = get_site_url();
    restore_current_blog();

    $paises = array(
        "America"              => array(
            array("url" => $baseURL . "/es-co/", "hreflang" => "es-co", "nombre" => "Latinoamérica", "idioma" => "Castellano", "icono" => "global"),
        ),
        "Europe"               => array(
            array("url" => $baseURL . "/es-es/", "hreflang" => "es-es", "nombre" => "España", "idioma" => "Español", "icono" => "230-spain"),
            array("url" => $baseURL . "/fr-fr/", "hreflang" => "fr-fr", "nombre" => "France", "idioma" => "Français", "icono" => "197-france"),
            array("url" => $baseURL . "/pt-pt/", "hreflang" => "pt-pt", "nombre" => "Portugal", "idioma" => "Português", "icono" => "098-portugal"),
            array("url" => $baseURL . "/en-gb/", "hreflang" => "en-gb", "nombre" => "United Kingdom", "idioma" => "English", "icono" => "110-united-kingdom"),

        ),
        "Asia and Middle East" => array(
            array("url" => "https://www.tikidan.in", "nombre" => "India", "idioma" => "English", "icono" => "055-india"),
        ),
        "Africa"               => array(
            array("url" => $baseURL . "/fr-dz/", "hreflang" => "fr-dz", "nombre" => "Algeria", "idioma" => "Français", "icono" => "136-Algeria"),
            array("url" => $baseURL . "/fr-ma/", "hreflang" => "fr-ma", "nombre" => "Maroc", "idioma" => "Français", "icono" => "182-morocco"),
        ), /*
        "Oceania"              => array(
        array("url" => "https://www.danosa.com/en-au/", "hreflang" => "en-au", "nombre" => "Australia", "warranty-mail" => "sales@residentiagroup.com.au", "idioma" => "Español", "icono" => "bandera-australia"),
        array("url" => "https://www.danosa.com/en-nz/", "hreflang" => "en-nz", "nombre" => "New Zealand", "warranty-mail" => "support@danosa.com", "idioma" => "Español", "icono" => "bandera-nueva-zelanda"),
        ),*/
        "Worldwide"            => array(
            array("url" => $baseURL . "/global/", "hreflang" => "en", "nombre" => "Global", "idioma" => "English", "icono" => "international"),
        ),
    );
    return $paises;
}

function getCountryData(){
    //echo get_site_url();

    foreach (getContentCountries() as $key => $continent) {
        foreach ($continent as $key => $country) {
            if($country["url"] == get_site_url()."/"){
                return $country;
            }
        }
    }
}


function getCountryFlag(){
    $data = getCountryData();
    return "/wp-content/themes/danosa/img/flags/".$data["icono"].".svg";
}

function getCountryName(){
    $data = getCountryData();
    return $data["nombre"];
}

function getCountryLanguage(){
    $data = getCountryData();
    return $data["idioma"];
}

function get_country_name_by_iso($iso) {
    switch ($iso) {
    case "AF":
        $name = __("Afghanistan", "danosa-countries");
        break;
    case "AL":
        $name = __("Albania", "danosa-countries");
        break;
    case "DZ":
        $name = __("Algeria", "danosa-countries");
        break;
    case "AS":
        $name = __("American Samoa", "danosa-countries");
        break;
    case "AD":
        $name = __("Andorra", "danosa-countries");
        break;
    case "AO":
        $name = __("Angola", "danosa-countries");
        break;
    case "AI":
        $name = __("Anguilla", "danosa-countries");
        break;
    case "AQ":
        $name = __("Antarctica", "danosa-countries");
        break;
    case "AG":
        $name = __("Antigua and Barbuda", "danosa-countries");
        break;
    case "AR":
        $name = __("Argentina", "danosa-countries");
        break;
    case "AM":
        $name = __("Armenia", "danosa-countries");
        break;
    case "AW":
        $name = __("Aruba", "danosa-countries");
        break;
    case "AU":
        $name = __("Australia", "danosa-countries");
        break;
    case "AT":
        $name = __("Austria", "danosa-countries");
        break;
    case "AZ":
        $name = __("Azerbaijan", "danosa-countries");
        break;
    case "BS":
        $name = __("Bahamas (the)", "danosa-countries");
        break;
    case "BH":
        $name = __("Bahrain", "danosa-countries");
        break;
    case "BD":
        $name = __("Bangladesh", "danosa-countries");
        break;
    case "BB":
        $name = __("Barbados", "danosa-countries");
        break;
    case "BY":
        $name = __("Belarus", "danosa-countries");
        break;
    case "BE":
        $name = __("Belgium", "danosa-countries");
        break;
    case "BZ":
        $name = __("Belize", "danosa-countries");
        break;
    case "BJ":
        $name = __("Benin", "danosa-countries");
        break;
    case "BM":
        $name = __("Bermuda", "danosa-countries");
        break;
    case "BT":
        $name = __("Bhutan", "danosa-countries");
        break;
    case "BO":
        $name = __("Bolivia", "danosa-countries");
        break;
    case "BQ":
        $name = __("Bonaire, Sint Eustatius and Saba", "danosa-countries");
        break;
    case "BA":
        $name = __("Bosnia and Herzegovina", "danosa-countries");
        break;
    case "BW":
        $name = __("Botswana", "danosa-countries");
        break;
    case "BV":
        $name = __("Bouvet Island", "danosa-countries");
        break;
    case "BR":
        $name = __("Brazil", "danosa-countries");
        break;
    case "IO":
        $name = __("British Indian Ocean Territory", "danosa-countries");
        break;
    case "BN":
        $name = __("Brunei Darussalam", "danosa-countries");
        break;
    case "BG":
        $name = __("Bulgaria", "danosa-countries");
        break;
    case "BF":
        $name = __("Burkina Faso", "danosa-countries");
        break;
    case "BI":
        $name = __("Burundi", "danosa-countries");
        break;
    case "CV":
        $name = __("Cabo Verde", "danosa-countries");
        break;
    case "KH":
        $name = __("Cambodia", "danosa-countries");
        break;
    case "CM":
        $name = __("Cameroon", "danosa-countries");
        break;
    case "CA":
        $name = __("Canada", "danosa-countries");
        break;
    case "KY":
        $name = __("Cayman Islands", "danosa-countries");
        break;
    case "CF":
        $name = __("Central African Republic", "danosa-countries");
        break;
    case "TD":
        $name = __("Chad", "danosa-countries");
        break;
    case "CL":
        $name = __("Chile", "danosa-countries");
        break;
    case "CN":
        $name = __("China", "danosa-countries");
        break;
    case "CX":
        $name = __("Christmas Island", "danosa-countries");
        break;
    case "CC":
        $name = __("Cocos (Keeling) Islands (the)", "danosa-countries");
        break;
    case "CO":
        $name = __("Colombia", "danosa-countries");
        break;
    case "KM":
        $name = __("Comoros (the)", "danosa-countries");
        break;
    case "CD":
        $name = __("Congo (the Democratic Republic of the)", "danosa-countries");
        break;
    case "CG":
        $name = __("Congo (the)", "danosa-countries");
        break;
    case "CK":
        $name = __("Cook Islands (the)", "danosa-countries");
        break;
    case "CR":
        $name = __("Costa Rica", "danosa-countries");
        break;
    case "HR":
        $name = __("Croatia", "danosa-countries");
        break;
    case "CU":
        $name = __("Cuba", "danosa-countries");
        break;
    case "CW":
        $name = __("Curaçao", "danosa-countries");
        break;
    case "CY":
        $name = __("Cyprus", "danosa-countries");
        break;
    case "CZ":
        $name = __("Czechia", "danosa-countries");
        break;
    case "CI":
        $name = __("Côte d'Ivoire", "danosa-countries");
        break;
    case "DK":
        $name = __("Denmark", "danosa-countries");
        break;
    case "DJ":
        $name = __("Djibouti", "danosa-countries");
        break;
    case "DM":
        $name = __("Dominica", "danosa-countries");
        break;
    case "DO":
        $name = __("Dominican Republic (the)", "danosa-countries");
        break;
    case "EC":
        $name = __("Ecuador", "danosa-countries");
        break;
    case "EG":
        $name = __("Egypt", "danosa-countries");
        break;
    case "SV":
        $name = __("El Salvador", "danosa-countries");
        break;
    case "GQ":
        $name = __("Equatorial Guinea", "danosa-countries");
        break;
    case "ER":
        $name = __("Eritrea", "danosa-countries");
        break;
    case "EE":
        $name = __("Estonia", "danosa-countries");
        break;
    case "SZ":
        $name = __("Eswatini", "danosa-countries");
        break;
    case "ET":
        $name = __("Ethiopia", "danosa-countries");
        break;
    case "FK":
        $name = __("Falkland Islands (the) [Malvinas]", "danosa-countries");
        break;
    case "FO":
        $name = __("Faroe Islands (the)", "danosa-countries");
        break;
    case "FJ":
        $name = __("Fiji", "danosa-countries");
        break;
    case "FI":
        $name = __("Finland", "danosa-countries");
        break;
    case "FR":
        $name = __("France", "danosa-countries");
        break;
    case "GF":
        $name = __("French Guiana", "danosa-countries");
        break;
    case "PF":
        $name = __("French Polynesia", "danosa-countries");
        break;
    case "TF":
        $name = __("French Southern Territories (the)", "danosa-countries");
        break;
    case "GA":
        $name = __("Gabon", "danosa-countries");
        break;
    case "GM":
        $name = __("Gambia (the)", "danosa-countries");
        break;
    case "GE":
        $name = __("Georgia", "danosa-countries");
        break;
    case "DE":
        $name = __("Germany", "danosa-countries");
        break;
    case "GH":
        $name = __("Ghana", "danosa-countries");
        break;
    case "GI":
        $name = __("Gibraltar", "danosa-countries");
        break;
    case "GR":
        $name = __("Greece", "danosa-countries");
        break;
    case "GL":
        $name = __("Greenland", "danosa-countries");
        break;
    case "GD":
        $name = __("Grenada", "danosa-countries");
        break;
    case "GP":
        $name = __("Guadeloupe", "danosa-countries");
        break;
    case "GU":
        $name = __("Guam", "danosa-countries");
        break;
    case "GT":
        $name = __("Guatemala", "danosa-countries");
        break;
    case "GG":
        $name = __("Guernsey", "danosa-countries");
        break;
    case "GN":
        $name = __("Guinea", "danosa-countries");
        break;
    case "GW":
        $name = __("Guinea-Bissau", "danosa-countries");
        break;
    case "GY":
        $name = __("Guyana", "danosa-countries");
        break;
    case "HT":
        $name = __("Haiti", "danosa-countries");
        break;
    case "HM":
        $name = __("Heard Island and McDonald Islands", "danosa-countries");
        break;
    case "VA":
        $name = __("Holy See (the)", "danosa-countries");
        break;
    case "HN":
        $name = __("Honduras", "danosa-countries");
        break;
    case "HK":
        $name = __("Hong Kong", "danosa-countries");
        break;
    case "HU":
        $name = __("Hungary", "danosa-countries");
        break;
    case "IS":
        $name = __("Iceland", "danosa-countries");
        break;
    case "IN":
        $name = __("India", "danosa-countries");
        break;
    case "ID":
        $name = __("Indonesia", "danosa-countries");
        break;
    case "IR":
        $name = __("Iran (Islamic Republic of)", "danosa-countries");
        break;
    case "IQ":
        $name = __("Iraq", "danosa-countries");
        break;
    case "IE":
        $name = __("Ireland", "danosa-countries");
        break;
    case "IM":
        $name = __("Isle of Man", "danosa-countries");
        break;
    case "IL":
        $name = __("Israel", "danosa-countries");
        break;
    case "IT":
        $name = __("Italy", "danosa-countries");
        break;
    case "JM":
        $name = __("Jamaica", "danosa-countries");
        break;
    case "JP":
        $name = __("Japan", "danosa-countries");
        break;
    case "JE":
        $name = __("Jersey", "danosa-countries");
        break;
    case "JO":
        $name = __("Jordan", "danosa-countries");
        break;
    case "KZ":
        $name = __("Kazakhstan", "danosa-countries");
        break;
    case "KE":
        $name = __("Kenya", "danosa-countries");
        break;
    case "KI":
        $name = __("Kiribati", "danosa-countries");
        break;
    case "KP":
        $name = __("Korea (the Democratic People's Republic of)", "danosa-countries");
        break;
    case "KR":
        $name = __("Korea (the Republic of)", "danosa-countries");
        break;
    case "KW":
        $name = __("Kuwait", "danosa-countries");
        break;
    case "KG":
        $name = __("Kyrgyzstan", "danosa-countries");
        break;
    case "LA":
        $name = __("Lao People's Democratic Republic (the)", "danosa-countries");
        break;
    case "LV":
        $name = __("Latvia", "danosa-countries");
        break;
    case "LB":
        $name = __("Lebanon", "danosa-countries");
        break;
    case "LS":
        $name = __("Lesotho", "danosa-countries");
        break;
    case "LR":
        $name = __("Liberia", "danosa-countries");
        break;
    case "LY":
        $name = __("Libya", "danosa-countries");
        break;
    case "LI":
        $name = __("Liechtenstein", "danosa-countries");
        break;
    case "LT":
        $name = __("Lithuania", "danosa-countries");
        break;
    case "LU":
        $name = __("Luxembourg", "danosa-countries");
        break;
    case "MO":
        $name = __("Macao", "danosa-countries");
        break;
    case "MG":
        $name = __("Madagascar", "danosa-countries");
        break;
    case "MW":
        $name = __("Malawi", "danosa-countries");
        break;
    case "MY":
        $name = __("Malaysia", "danosa-countries");
        break;
    case "MV":
        $name = __("Maldives", "danosa-countries");
        break;
    case "ML":
        $name = __("Mali", "danosa-countries");
        break;
    case "MT":
        $name = __("Malta", "danosa-countries");
        break;
    case "MH":
        $name = __("Marshall Islands (the)", "danosa-countries");
        break;
    case "MQ":
        $name = __("Martinique", "danosa-countries");
        break;
    case "MR":
        $name = __("Mauritania", "danosa-countries");
        break;
    case "MU":
        $name = __("Mauritius", "danosa-countries");
        break;
    case "YT":
        $name = __("Mayotte", "danosa-countries");
        break;
    case "MX":
        $name = __("Mexico", "danosa-countries");
        break;
    case "FM":
        $name = __("Micronesia (Federated States of)", "danosa-countries");
        break;
    case "MD":
        $name = __("Moldova (the Republic of)", "danosa-countries");
        break;
    case "MC":
        $name = __("Monaco", "danosa-countries");
        break;
    case "MN":
        $name = __("Mongolia", "danosa-countries");
        break;
    case "ME":
        $name = __("Montenegro", "danosa-countries");
        break;
    case "MS":
        $name = __("Montserrat", "danosa-countries");
        break;
    case "MA":
        $name = __("Morocco", "danosa-countries");
        break;
    case "MZ":
        $name = __("Mozambique", "danosa-countries");
        break;
    case "MM":
        $name = __("Myanmar", "danosa-countries");
        break;
    case "NA":
        $name = __("Namibia", "danosa-countries");
        break;
    case "NR":
        $name = __("Nauru", "danosa-countries");
        break;
    case "NP":
        $name = __("Nepal", "danosa-countries");
        break;
    case "NL":
        $name = __("Netherlands (the)", "danosa-countries");
        break;
    case "NC":
        $name = __("New Caledonia", "danosa-countries");
        break;
    case "NZ":
        $name = __("New Zealand", "danosa-countries");
        break;
    case "NI":
        $name = __("Nicaragua", "danosa-countries");
        break;
    case "NE":
        $name = __("Niger (the)", "danosa-countries");
        break;
    case "NG":
        $name = __("Nigeria", "danosa-countries");
        break;
    case "NU":
        $name = __("Niue", "danosa-countries");
        break;
    case "NF":
        $name = __("Norfolk Island", "danosa-countries");
        break;
    case "MK":
        $name = __("North Macedonia", "danosa-countries");
        break;
    case "MP":
        $name = __("Northern Mariana Islands (the)", "danosa-countries");
        break;
    case "NO":
        $name = __("Norway", "danosa-countries");
        break;
    case "OM":
        $name = __("Oman", "danosa-countries");
        break;
    case "PK":
        $name = __("Pakistan", "danosa-countries");
        break;
    case "PW":
        $name = __("Palau", "danosa-countries");
        break;
    case "PS":
        $name = __("Palestine, State of", "danosa-countries");
        break;
    case "PA":
        $name = __("Panama", "danosa-countries");
        break;
    case "PG":
        $name = __("Papua New Guinea", "danosa-countries");
        break;
    case "PY":
        $name = __("Paraguay", "danosa-countries");
        break;
    case "PE":
        $name = __("Peru", "danosa-countries");
        break;
    case "PH":
        $name = __("Philippines (the)", "danosa-countries");
        break;
    case "PN":
        $name = __("Pitcairn", "danosa-countries");
        break;
    case "PL":
        $name = __("Poland", "danosa-countries");
        break;
    case "PT":
        $name = __("Portugal", "danosa-countries");
        break;
    case "PR":
        $name = __("Puerto Rico", "danosa-countries");
        break;
    case "QA":
        $name = __("Qatar", "danosa-countries");
        break;
    case "RO":
        $name = __("Romania", "danosa-countries");
        break;
    case "RU":
        $name = __("Russian Federation (the)", "danosa-countries");
        break;
    case "RW":
        $name = __("Rwanda", "danosa-countries");
        break;
    case "RE":
        $name = __("Réunion", "danosa-countries");
        break;
    case "BL":
        $name = __("Saint Barthélemy", "danosa-countries");
        break;
    case "SH":
        $name = __("Saint Helena, Ascension and Tristan da Cunha", "danosa-countries");
        break;
    case "KN":
        $name = __("Saint Kitts and Nevis", "danosa-countries");
        break;
    case "LC":
        $name = __("Saint Lucia", "danosa-countries");
        break;
    case "MF":
        $name = __("Saint Martin (French part)", "danosa-countries");
        break;
    case "PM":
        $name = __("Saint Pierre and Miquelon", "danosa-countries");
        break;
    case "VC":
        $name = __("Saint Vincent and the Grenadines", "danosa-countries");
        break;
    case "WS":
        $name = __("Samoa", "danosa-countries");
        break;
    case "SM":
        $name = __("San Marino", "danosa-countries");
        break;
    case "ST":
        $name = __("Sao Tome and Principe", "danosa-countries");
        break;
    case "SA":
        $name = __("Saudi Arabia", "danosa-countries");
        break;
    case "SN":
        $name = __("Senegal", "danosa-countries");
        break;
    case "RS":
        $name = __("Serbia", "danosa-countries");
        break;
    case "SC":
        $name = __("Seychelles", "danosa-countries");
        break;
    case "SL":
        $name = __("Sierra Leone", "danosa-countries");
        break;
    case "SG":
        $name = __("Singapore", "danosa-countries");
        break;
    case "SX":
        $name = __("Sint Maarten (Dutch part)", "danosa-countries");
        break;
    case "SK":
        $name = __("Slovakia", "danosa-countries");
        break;
    case "SI":
        $name = __("Slovenia", "danosa-countries");
        break;
    case "SB":
        $name = __("Solomon Islands", "danosa-countries");
        break;
    case "SO":
        $name = __("Somalia", "danosa-countries");
        break;
    case "ZA":
        $name = __("South Africa", "danosa-countries");
        break;
    case "GS":
        $name = __("South Georgia and the South Sandwich Islands", "danosa-countries");
        break;
    case "SS":
        $name = __("South Sudan", "danosa-countries");
        break;
    case "ES":
        $name = __("Spain", "danosa-countries");
        break;
    case "LK":
        $name = __("Sri Lanka", "danosa-countries");
        break;
    case "SD":
        $name = __("Sudan (the)", "danosa-countries");
        break;
    case "SR":
        $name = __("Suriname", "danosa-countries");
        break;
    case "SJ":
        $name = __("Svalbard and Jan Mayen", "danosa-countries");
        break;
    case "SE":
        $name = __("Sweden", "danosa-countries");
        break;
    case "CH":
        $name = __("Switzerland", "danosa-countries");
        break;
    case "SY":
        $name = __("Syrian Arab Republic (the)", "danosa-countries");
        break;
    case "TW":
        $name = __("Taiwan (Province of China)", "danosa-countries");
        break;
    case "TJ":
        $name = __("Tajikistan", "danosa-countries");
        break;
    case "TZ":
        $name = __("Tanzania, the United Republic of", "danosa-countries");
        break;
    case "TH":
        $name = __("Thailand", "danosa-countries");
        break;
    case "TL":
        $name = __("Timor-Leste", "danosa-countries");
        break;
    case "TG":
        $name = __("Togo", "danosa-countries");
        break;
    case "TK":
        $name = __("Tokelau", "danosa-countries");
        break;
    case "TO":
        $name = __("Tonga", "danosa-countries");
        break;
    case "TT":
        $name = __("Trinidad and Tobago", "danosa-countries");
        break;
    case "TN":
        $name = __("Tunisia", "danosa-countries");
        break;
    case "TR":
        $name = __("Turkey", "danosa-countries");
        break;
    case "TM":
        $name = __("Turkmenistan", "danosa-countries");
        break;
    case "TC":
        $name = __("Turks and Caicos Islands (the)", "danosa-countries");
        break;
    case "TV":
        $name = __("Tuvalu", "danosa-countries");
        break;
    case "UG":
        $name = __("Uganda", "danosa-countries");
        break;
    case "UA":
        $name = __("Ukraine", "danosa-countries");
        break;
    case "AE":
        $name = __("United Arab Emirates (the)", "danosa-countries");
        break;
    case "GB":
        $name = __("United Kingdom of Great Britain and Northern Ireland (the)", "danosa-countries");
        break;
    case "UM":
        $name = __("United States Minor Outlying Islands (the)", "danosa-countries");
        break;
    case "US":
        $name = __("United States of America (the)", "danosa-countries");
        break;
    case "UY":
        $name = __("Uruguay", "danosa-countries");
        break;
    case "UZ":
        $name = __("Uzbekistan", "danosa-countries");
        break;
    case "VU":
        $name = __("Vanuatu", "danosa-countries");
        break;
    case "VE":
        $name = __("Venezuela (Bolivarian Republic of)", "danosa-countries");
        break;
    case "VN":
        $name = __("Viet Nam", "danosa-countries");
        break;
    case "VG":
        $name = __("Virgin Islands (British)", "danosa-countries");
        break;
    case "VI":
        $name = __("Virgin Islands (U.S.)", "danosa-countries");
        break;
    case "WF":
        $name = __("Wallis and Futuna", "danosa-countries");
        break;
    case "EH":
        $name = __("Western Sahara*", "danosa-countries");
        break;
    case "YE":
        $name = __("Yemen", "danosa-countries");
        break;
    case "ZM":
        $name = __("Zambia", "danosa-countries");
        break;
    case "ZW":
        $name = __("Zimbabwe", "danosa-countries");
        break;
    case "AX":
        $name = __("Åland Islands", "danosa-countries");
        break;
    default:
        $name = $iso;
        break;
    }

    return $name;
}
