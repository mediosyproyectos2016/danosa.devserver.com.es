const searchClient = algoliasearch('FHZ279KJTE', 'd36a9d50290b40e9cf87919c9c35e55a');
const systemsSearch = 'systems' + searchParams.locale;
const productsSearch = 'products' + searchParams.locale;
const documentationsSearch = 'documentations' + searchParams.locale;
const postsSearch = 'posts' + searchParams.locale;
const search = instantsearch({
    indexName: systemsSearch,
    searchClient
});
const search_tab_active = jQuery('#search-tabs').parent().find('.tab-content.active').attr("id");

search.on('render', () => {
    var next = jQuery('#' + search_tab_active + ' .ais-Hits-item').length == 0; 
    if (!next) {
        jQuery('#' + search_tab_active+'-tab').trigger('click');
    }
    if (jQuery('#hits-search-systems .ais-Hits-item').length == 0) {
        jQuery('#hits-search-systems-count').addClass("hidden");
    } else {
        jQuery('#hits-search-systems-count').removeClass("hidden");
        jQuery('#hits-search-systems-count').html(jQuery('#hits-search-systems .ais-Hits-item').length);
        if (next) {
            jQuery('#hits-search-systems-tab').trigger('click');
            next = false;
        }
    }

    if (jQuery('#hits-search-products .ais-Hits-item').length == 0) {
        jQuery('#hits-search-products-count').addClass("hidden");
    } else {
        jQuery('#hits-search-products-count').removeClass("hidden");
        jQuery('#hits-search-products-count').html(jQuery('#hits-search-products .ais-Hits-item').length);
        if (next) {
            jQuery('#hits-search-products-tab').trigger('click');
            next = false;
        }
    }

    if (jQuery('#hits-search-documentation .ais-Hits-item').length == 0) {
        jQuery('#hits-search-documentation-count').addClass("hidden");
    } else {
        jQuery('#hits-search-documentation-count').removeClass("hidden");
        jQuery('#hits-search-documentation-count').html(jQuery('#hits-search-documentation .ais-Hits-item').length);
        if (next) {
            jQuery('#hits-search-documentation-tab').trigger('click');
            next = false;
        }
    }

    if (jQuery('#hits-search-posts .ais-Hits-item').length == 0) {
        jQuery('#hits-search-posts-count').addClass("hidden");
    } else {
        jQuery('#hits-search-posts-count').removeClass("hidden");
        jQuery('#hits-search-posts-count').html(jQuery('#hits-search-posts .ais-Hits-item').length);
        if (next) {
            jQuery('#hits-search-posts-tab').trigger('click');
            next = false;
        }
    }
 
 
});

search.addWidgets([
    instantsearch.widgets.configure({
        hitsPerPage: 32,
    }),

    instantsearch.widgets.searchBox({
        container: '#search-input',
        placeholder: '¿Qué estás buscando?',
        showSubmit: false,
    }),

    instantsearch.widgets.stats({
        container: '#stats',
    }),

    instantsearch.widgets.hits({
        container: '#hits-search-systems',
        templates: {
            item: `
                    <div class="wp-block-column content-list fade-top">
                        <a href="{{ link }}">
                            <figure class="wp-block-image size-large content-list-image ">
                                <img src="{{ metas.image_list }}" class="attachment-danosa-content-list size-danosa-content-list wp-post-image" alt="" loading="lazy">
                            </figure>
                        </a>
                        <div class="wp-block-group">
                            <div class="wp-block-group__inner-container">
                                <h2><a href="{{ link }}">{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}</a></h2>
                                <p>{{ post_content }}</p>
                            </div>
                        </div>
                        <div class="wp-block-columns">
                            <div class="wp-block-column">
                                <a href="{{ link }}">Ver solución <i class="danosa-arrow-go"></i></a>
                            </div>
                        </div>
                    </div>
                `,
            empty: 'No se han encontrado resultados',
        },
    }),

    instantsearch.widgets.index({
        indexName: productsSearch
    }).addWidgets([
        instantsearch.widgets.hits({
            container: '#hits-search-products',
            templates: {
                item: `
                        <div class="wp-block-column content-list fade-top">
                            <a href="{{ link }}">
                                <figure class="wp-block-image size-large content-list-image ">
                                    <img src="{{ image }}" class="attachment-danosa-content-list size-danosa-content-list wp-post-image" alt="" loading="lazy">
                                </figure>
                            </a>
                            <div class="wp-block-group">
                                <div class="wp-block-group__inner-container">
                                    <h2><a href="{{ link }}">{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}</a></h2>
                                    <p>{{ post_content }}</p>
                                </div>
                            </div>
                            <div class="wp-block-columns">
                                <div class="wp-block-column">
                                    <a href="{{ link }}">Ver producto <i class="danosa-arrow-go"></i></a>
                                </div>
                            </div>
                        </div>
                    `,
                empty: 'No se han encontrado resultados',
            },
        }),
    ]),


    instantsearch.widgets.index({
        indexName: documentationsSearch
    }).addWidgets([
        instantsearch.widgets.hits({
            container: '#hits-search-documentation',
            templates: {
                item: `
                        <div class="wp-block-column content-list fade-top">
                            <a href="{{ link }}" target="_blank">
                                <figure class="wp-block-image size-large content-list-image ">
                                    <img src="{{ image }}" class="attachment-danosa-content-list size-danosa-content-list wp-post-image" alt="" loading="lazy">
                                </figure>
                            </a>
                            <div class="wp-block-group">
                                <div class="wp-block-group__inner-container">
                                    <h2><a href="{{ link }}" target="_blank">{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}</a></h2>
                                </div>
                            </div>
                            <div class="wp-block-columns">
                                <div class="wp-block-column">
                                    <a href="{{ link }}" target="_blank">Ver producto <i class="danosa-arrow-go"></i></a>
                                </div>
                            </div>
                        </div>
                    `,
                empty: 'No se han encontrado resultados',
            },
        }),
    ]),


    instantsearch.widgets.index({
        indexName: postsSearch
    }).addWidgets([
        instantsearch.widgets.hits({
            container: '#hits-search-posts',
            templates: {
                item: `
                        <div class="wp-block-column content-list fade-top">
                            <a href="{{ link }}">
                                <figure class="wp-block-image size-large content-list-image ">
                                    <img src="{{ image }}" class="attachment-danosa-content-list size-danosa-content-list wp-post-image" alt="" loading="lazy">
                                </figure>
                            </a>
                            <div class="wp-block-group">
                                <div class="wp-block-group__inner-container">
                                    <h2><a href="{{ link }}">{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}</a></h2>
                                </div>
                            </div>
                            <div class="wp-block-columns">
                                <div class="wp-block-column">
                                    <a href="{{ link }}">Leer más <i class="danosa-arrow-go"></i></a>
                                </div>
                            </div>
                        </div>
                    `,
                empty: 'No se han encontrado resultados',
            },
        }),
    ]),




]);
//search.start();

var AlgoliaStarted = false;
jQuery("#search-inputTmp").keydown(function(e) {
    algoliaStart();

    jQuery("#search-input .ais-SearchBox-input").val(e.key);
    jQuery("#search-input .ais-SearchBox-input").focus();
});

function algoliaStart() {
    if (!AlgoliaStarted) {
        AlgoliaStarted = true;

        search.start();

        jQuery("#search-inputTmp").hide();
        jQuery("#search-input").show();
        jQuery("#search-results-container").show();
        jQuery("body").addClass("has-modal");
    }
}


jQuery("#top-search span").click(function(event) {
    var texto = jQuery(this).text(); 
    algoliaStart();   
    search.helper.setQuery(texto).search();   
});