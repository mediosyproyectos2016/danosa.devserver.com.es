jQuery('#home-obras-slider > div').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true,
    centerPadding: '0',
    autoplay: true,
    autoplaySpeed: 4000,
});

jQuery('#home-slider > div').slick({
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4000,
});


jQuery('#construction-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '#construction-slider-nav'
});

jQuery('#construction-slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '#construction-slider',
    arrows: true,
    dots: false,
    centerMode: true,
    focusOnSelect: true
});


jQuery('#systems-home-list > div > div').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    mobileFirst: true,
    arrows: false,
    dots: true,
    responsive: [{
        breakpoint: 767,
        settings: "unslick"
    }]
});


jQuery('#home-profile > div > div:nth-child(2)').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    mobileFirst: true,
    arrows: false,
    dots: true,
    responsive: [{
        breakpoint: 767,
        settings: "unslick"
    }]
});



var slideUp = {
    distance: '30px',
    origin: 'bottom',
    delay: 200,
    interval: 100,
    opacity: 0,
    //reset: true
};


window.sr = ScrollReveal();

sr.reveal('.fade-top, .home-solucion', slideUp);

var slideRight = {
    distance: '30px',
    origin: 'right',
    delay: 200,
    interval: 100,
    opacity: 0,
    //reset: true
};

sr.reveal('.fade-right, #home-sostenibilidad > div', slideRight);

var slideLeft = {
    distance: '30px',
    origin: 'left',
    delay: 200,
    interval: 100,
    opacity: 0,
    //reset: true
};

sr.reveal('.fade-left, #home-sostenibilidad > figure', slideLeft);



shareon();

//tabs
jQuery('.tab').on('click', function(evt) {
    evt.preventDefault();
    jQuery(".tab").removeClass('active');
    jQuery(this).addClass('active');
    var sel = this.getAttribute('data-toggle-target');
    jQuery('.tab-content').removeClass('active').filter(sel).addClass('active');
});

function formatState (data) {
  if (!data.id) {
    return data.text;
  }
  var $data = jQuery(
    '<div><span class="variant-reference">' + jQuery(data.element).data("id") + '</span> <span class="variant-name"> - ' + jQuery(data.element).data("name") + '</span></div>'
  );
  return $data;
};


    var $q = jQuery('#product-variant-selector');
    $q.select2({
        placeholder: "Seleccionar variación", //placeholder
        templateResult: formatState
        });

    jQuery("#product-variant-selector").on("select2:select", function (e) {
        window.location = e.params.data.id;
    });


jQuery(document).ready(function() {
    jQuery("ul.subsystems > li, #menu-families > ul > li").on("click", ".dropdown", function(e) {
        e.preventDefault();
        if (jQuery(this).hasClass("active")) {
            console.log("up");
            jQuery(this).removeClass("active");
            jQuery(this).next().slideUp();
        } else {
            console.log("down");
            jQuery(this).addClass("active");
            jQuery(this).next().slideDown();
        }
    });
});


function seleccionar_productos(name){
    jQuery( "."+name ).each(function() {
       jQuery(this).attr("checked",!jQuery(this).attr("checked"))
    });
}

jQuery(document).ready(function() {
    jQuery("body").on('click', '.currentCountry', function() {
        console.log("1");
        loadLighboxCountries();
    });
    getPrescripcionSistemas();
});

function getPrescripcionSistemas() {
    var objJson = window.localStorage.getItem('system_prescripcion_online');
    jQuery("#PrescripcionSistemas").val(objJson);
    objJson = JSON.parse(objJson);
    if (Array.isArray(objJson)) {
        var s = "<div class='flexrow partidas sistemas'>";
        var c = 0;
        objJson.forEach(obj => {
            if (obj != null ) {
                c = 1;
               /* d = '<div class="v2">' + obj.sistema_text + '</div>';*/
               /* s += '<div class="flexcolumn"><span>' + d + '</span><span class="delete" onclick="delPrescripcionSistemas(' + obj.id + ')">x</span></div>';*/
                if (obj.mm == undefined) {
                    obj.mm = 10
                }
                s += '<div class="wp-block-columns added fade-left">';
                s += '<div class="partida sistema completed">';
                s += '<div class="header"><h4 style="margin:0px">' + obj.sistema_tipo + '</h4>';
                s += '<div class="systeminputmm">';
                s += '<input onchange="changeMM(jQuery(this).val(),' + obj.id + ')"   type="number" value="' + obj.mm + '" size="40"><span>m&#178;</span>';
                   s += "</div>";
                s += '<i class="close danosa-cross" title="Eliminar" onclick="return delPrescripcionSistemas(' + obj.id + ');"></i></div><div class="body wp-block-columns alternate add">';


                s += '<div class="systemtext">';
                if (obj.sistema_text !== obj.sistema_desc  ) {
                    s += obj.sistema_text;
                }
                s += "</div>";
                s += '<div class="systemdescription">';

                if (obj.sistema_vertical !== undefined && obj.sistema_vertical != "") {
                    s += '<p> ' + obj.sistema_vertical + '</p>';
                }
                if (obj.sistema_vertical2 !== undefined && obj.sistema_vertical2 != "") {
                    s += '<p> ' + obj.sistema_vertical2 + '</p>';
                    }
                s += '<p> ' + obj.sistema_desc + '</p>';
                s += "</div>";
                s += '<div class="systembutton">';
                if (obj.link !== undefined && obj.link != "") {
                    s += '<button   onclick="window.open(\'' + obj.link + '\', \'_blank\').focus();return false;" >Ver</button>';
                }
                s += "</div>";
                    s += "</div>";
                s += "</div>";
                s += "</div>";
            }
        });
        s += "</div>";
        if (c == 1) {
            jQuery(".PrescripcionSistemas").html("");
            jQuery(".PrescripcionSistemas").append(s);
        } else {
            jQuery(".PrescripcionSistemas").html("");
        }
    } else {
        jQuery(".PrescripcionSistemas").html("");
    }


}
function changeMM(mm,id) {
    if (id != null) {
        var objJson = window.localStorage.getItem('system_prescripcion_online');
        objJson = JSON.parse(objJson);
        if (!Array.isArray(objJson)) {
            objJson = [];
        }
        objJson.forEach(function (obj, index, object) {
            if (obj != null && obj.id == id) {
                obj.mm = mm;
            }
        });
        window.localStorage.setItem('system_prescripcion_online', JSON.stringify(objJson));
        jQuery("#PrescripcionSistemas").val(objJson);
    }
}
function delPrescripcionSistemas(id) {
    if (id != null) {
        var objJson = window.localStorage.getItem('system_prescripcion_online');
        objJson = JSON.parse(objJson);
        if (!Array.isArray(objJson)) {
            objJson = [];
        }
        objJson.forEach(function (obj, index, object) {
            if (obj != null && obj.id == id) {
                object.splice(index, 1);
            }
        });
        window.localStorage.setItem('system_prescripcion_online', JSON.stringify(objJson));
        getPrescripcionSistemas();
    }

}
function addPrescripcionSistemas(id, text, mm, tipo, link,desc,vertical,vertical2) {
    if (id != null) {
        var objJson = window.localStorage.getItem('system_prescripcion_online');
        objJson = JSON.parse(objJson);
        if (!Array.isArray(objJson)) {
            objJson = [];
        }
        var p = {};
        p.sistema = id;
        p.mm = mm;
        p.sistema_text = text;
        p.sistema_desc = desc;
        p.sistema_tipo = tipo;
        p.sistema_vertical = vertical;
        p.sistema_vertical2 = vertical2;
        p.id = "" + Date.now() + "";
        p.link = link;
        objJson.push(p);
        window.localStorage.setItem('system_prescripcion_online', JSON.stringify(objJson));
        getPrescripcionSistemas();
    }

}
function loadLighboxCountries() {
    //cargamos una única vez los paises
    console.log("1");
    if (jQuery("#lighboxCountries").children().length == 0) {
        //console.log("lighboxCountries");
        console.log("2");
        jQuery.ajax({
            url: home_uri + 'wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'cargar_paises'
            },
            beforeSend: function(xhr) {
                //filter.find('button').text('Processing...'); // changing the button label
            },
            success: function(response) {
                jQuery("#lighboxCountries").html(response); // insert data

                jQuery.featherlight("#lighboxCountries", {
                    variant: "lighboxCountries"
                });
            }
        });
    } else {
        jQuery.featherlight("#lighboxCountries", {
            variant: "lighboxCountries"
        });
    }
}

/*search*/
jQuery(document).ready(function() {
    jQuery("body").on('click', '#ast-desktop-header i.danosa-search, #ast-mobile-header i.danosa-search', function() {
        searchOpen();
    });

    jQuery("body").on('click', '#ast-desktop-header i.danosa-search.active, #ast-mobile-header i.danosa-search.active', function() {
        searchClose();
    });

    if(jQuery("body").hasClass("home")) {
        setTimeout( function() { searchOpen(); }, 2000);
    }


});

function searchOpen(){
    //jQuery("#search-container").slideDown("slow");
    jQuery("#ast-desktop-header i.danosa-search").addClass("active");
    jQuery("#ast-mobile-header i.danosa-search").addClass("active");
    jQuery("#search-container").addClass("active");

    jQuery("body").addClass("search-shown");
    if(jQuery("#search-results-container").is(":visible")){
        jQuery("body").addClass("has-modal");
    }
}
function searchClose(){
    //jQuery("#search-container").slideUp("slow");
    jQuery("#ast-desktop-header i.danosa-search").removeClass("active");
    jQuery("#ast-mobile-header i.danosa-search").removeClass("active");
    jQuery("#search-container").removeClass("active");
    jQuery("body").removeClass("has-modal");
    jQuery("body").removeClass("search-shown");
}

// Filtros producto responsive
jQuery('.products-filters-title-mobile').click(function() {
    if (jQuery('.products-filters-title-mobile').hasClass('open')) {
        jQuery('.products-filters-title-mobile').removeClass('open');
        jQuery('#products-filters-mobile>div').removeClass('important');
    } else {
        jQuery('.products-filters-title-mobile').addClass('open');
        jQuery('#products-filters-mobile>div').addClass('important');
    }

    return false;
});


// Filtros producto responsive
jQuery('.show-more').click(function(e) {
    e.preventDefault();
    jQuery(this).prev().removeClass("show-more-container");
    jQuery(this).remove();
});

//youtube player
var players = document.querySelectorAll('.youtube-player')

var loadPlayer = function(event) {
    var target = event.currentTarget
    var iframe = document.createElement('iframe')

    iframe.height = target.clientHeight
    iframe.width = target.clientWidth
    iframe.src = 'https://www.youtube.com/embed/' + target.dataset.videoId + '?autoplay=1'
    iframe.setAttribute('frameborder', 0)

    target.classList.remove('pristine')

    if (target.children.length) {
        target.replaceChild(iframe, target.firstElementChild)
    } else {
        target.appendChild(iframe)
    }
}

var config = {
    once: true
}

Array.from(players).forEach(function(player) {
    player.addEventListener('click', loadPlayer, config)
})


jQuery(".color-group span").click(function() {
    var color = jQuery(this).data("color");
    var peso = jQuery(this).data("peso");
    var ref = jQuery(this).data("ref");
    var childId = jQuery(this).data("child-id");

    jQuery(".presentation-color span").text(color);
    jQuery(".presentation-weight span").text(peso);
    jQuery(".presentation-reference span").text(ref);

    jQuery(".color-group").removeClass("active");
    jQuery(".color-group span").removeClass("active");

    jQuery(this).addClass("active");
    jQuery(this).closest(".color-group").addClass("active");

    var downloadLink = jQuery("#datasheet-button");
    var href = downloadLink.attr("href");
    var separator = href.includes("?") ? "&" : "?";

    // Verificar si childId ya existe en la URL y reemplazar su valor
    if (href.includes("childId=")) {
        href = href.replace(/childId=[^&]+/, "childId=" + childId);
    } else {
        href = href + separator + "childId=" + childId;
    }

    downloadLink.attr("href", href);
});


jQuery(document).ready(function() {
    if(localStorage.getItem("soporte-flotante") == null){
        jQuery("#soporte-flotante-container").addClass("active");
    }
});

jQuery("#soporte-flotante-texto > button, #soporte-flotante-launcher > div.close").click(function() {
        localStorage.setItem("soporte-flotante","close");
        jQuery("#soporte-flotante-container").addClass("hideAnimation");
});

jQuery("#soporte-flotante-launcher > div.show").click(function() {
        localStorage.removeItem("soporte-flotante","close");
        jQuery("#soporte-flotante-container").addClass("active");
        jQuery("#soporte-flotante-container").removeClass("hideAnimation");
});
