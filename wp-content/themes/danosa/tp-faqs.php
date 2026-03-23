<?php
/*
Template Name: Danosa - FAQs
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>



	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

		<?php astra_content_page_loop(); ?>

		<?php astra_primary_content_bottom(); ?>



                <ul id="faq-menu" class="tabs">
                    <?php
                    $terms = get_terms([
                        'taxonomy' => "faq_cat",
                        'hide_empty' => false,
                    ]);

                    foreach ($terms as $key => $term) {

                        ?>
                        <li <?php if(get_queried_object()->term_id == $term->term_id){ echo 'class="active"'; } ?> ><a href="<?php echo get_term_link($term,"faq_cat"); ?>"><?php echo $term->name; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>         

<style type="text/css">
    /**
 * Tabs
 */
.tabs {
    display: flex;
    flex-wrap: wrap; // make sure it wraps
}
.tabs label {
    order: 1; // Put the labels first
    display: block;
    padding: 1rem 2rem;
    margin-right: 0.2rem;
    cursor: pointer;
  background: #90CAF9;
  font-weight: bold;
  transition: background ease 0.2s;
}
.tabs .tab {
  order: 99; // Put the tabs last
  flex-grow: 1;
    width: 100%;
    display: none;
  padding: 1rem;
  background: #fff;
}
.tabs input[type="radio"] {
    display: none;
}
.tabs input[type="radio"]:checked + label {
    background: #fff;
}
.tabs input[type="radio"]:checked + label + .tab {
    display: block;
}

@media (max-width: 45em) {
  .tabs .tab,
  .tabs label {
    order: initial;
  }
  .tabs label {
    width: 100%;
    margin-right: 0;
    margin-top: 0.2rem;
  }
}

</style>

	</div><!-- #primary -->


<?php get_footer(); ?>
