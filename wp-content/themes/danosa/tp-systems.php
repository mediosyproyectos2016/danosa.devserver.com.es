<?php
/*
Template Name: Danosa - Systems
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$image = get_field("image");
$title = get_field("title");
$description = get_field("description");
$filters_description = get_field("filters_description");
$hreflang_ref = get_field("hreflang_ref");

if(empty($title)){
    $title = get_the_title();
}
?>



	<div id="primary" <?php astra_primary_class(); ?>>



        <div class="entry-content clear" itemprop="text">


            <div id="systems-header" class="section-header alignfull">
            <div class="section-header-bg" style="background-image: url(<?php echo $image; ?>);"></div>
            <div class="ast-container">
                <div class="content-area">
                    <h1><?php echo $title; ?></h1>
                    <?php if(!empty($description)){ ?>
                        <?php echo $description; ?>
                    <?php } ?>
                </div>
            </div>
            </div>

            <div id="systems-filter" class="wp-block-group alignfull has-background" style="background-color:#F5F5F5">
                <div class="ast-container"><p>
                    <?php if(!empty($filters_description)){ ?>
                        <?php echo $filters_description; ?>
                    <?php }; ?>
					</p>
					<?php
					
                    $filtros = get_cat_filters("SYSTEM");

                    if(!empty($filtros) && getSiteCountry() != "gb"){ ?>
                    <div id="products-filters-mobile">
                        <span class="products-filters-title-mobile"><?php _e("Filters","danosa"); ?></span>
                        <div id="products-filters">
                        <div class="et_pb_text_inner">

                            <?php

                            ?>

                            <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
                                <?php

                                ?>


                                <?php
                                $countFilters = 0;
                                foreach ($filtros as $key => $value) {
                                    if($value['type'] != "submenu"){
                                    ?>
                                    <div class="product-filter product-filter-<?php echo $key; ?>" >
                                        <h4 class="familia <?php if(strlen($value['name'])> 20){ echo "len20";}elseif(strlen($value['name'])> 15){echo "len15";}elseif(strlen($value['name'])> 10){echo "len10";}?>"><?php echo $value['name']; ?></h4>
                                        <div class="product-filter-dropdown">
                                            <div class="childs">
                                            </div>
                                            <span><?php _e("CLOSE","danosa"); ?></span>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    $countFilters++;
                                }

                                ?>

                                <input type="hidden" name="action" id="input_system_filter" value="system_filter">
                            </form>


                            <div id="query-debug"></div>


                        </div>
                        </div>
                    </div>
                    <div id="profucts-filters-inline" style="display: none;"><a href="" id="reset-filter">Quitar filtros</a></div>
                    <?php } ?>
                </div>
                <script type="text/javascript">
                    jQuery( document ).ready(function() {
                        jQuery.ajax({
                            url: home_uri + 'wp-admin/admin-ajax.php',
                            type: 'post',
                            data: {
                                action: 'system_load_filters',
                                catId: "SYSTEM"
                            },
                            beforeSend: function(xhr) {
                                //filter.find('button').text('Processing...'); // changing the button label
                                jQuery("#systems-filter > div > div").fadeTo("slow", 0.3);
                            },
                            success: function(response) {
                                jQuery("#systems-filter > div > div").fadeTo("slow", 1);
                                jQuery('#query-debug').html(response); // insert data
                            }
                        });
                    });
                </script>
            </div>

            <div id="systems-main-list" class="wp-block-group alignfull has-background" style="background-color:#F5F5F5">

                <div class="ast-container">
                    <div  class="content-list-container wp-block-columns">

                        <?php
                        $terms = get_terms( 'system_cat', array(
                            'hide_empty' => true,
                            'parent' => 0
                        ) );


                        foreach ($terms as $key => $product) {


                                include("loop-system_cat.php");


                        }


                        ?>
                    </div>
                </div>
            </div>





        </div>


	</div><!-- #primary -->


<?php get_footer(); ?>
