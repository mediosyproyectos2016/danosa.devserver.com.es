<?php
/*
Template Name: Country Selector
 */
header('Cache-Control: no-store');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before();?>
<html <?php language_attributes();?>>
<head>
<?php astra_head_top();?>
<meta charset="<?php bloginfo('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head();?>
<?php astra_head_bottom();?>
</head>

<body <?php astra_schema_body();?> <?php body_class();?>>
<?php astra_body_top();?>
<?php wp_body_open();?>
<div
<?php
echo astra_attr(
    'site',
    array(
        'id'    => 'page',
        'class' => 'hfeed site',
    )
);
?>
>
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html(astra_default_strings('string-header-skip-link', false)); ?></a>
	<?php
//astra_header_before();

//astra_header();

//astra_header_after();

//astra_content_before();
;?>
	<div id="content" class="site-content">
		<div class="ast-container">

			<div id="root-country-selector">
				<div class="container">
					<?php
					$logo = '/wp-content/uploads/sites/2/2021/06/logo-danosa-2.svg';
					?>
					<img src="<?php echo $logo; ?>" id="root-logo" alt="danosa" title="danosa" />

					<div id="select-market">
						<span>Select your country or region</span>
					</div>
					<div id="lighboxCountries">
						<?php
						get_template_part('content', 'countries');
						?>
					</div>
					<div id="description">
						<p>DANOSA has become the leader company in Spain as manufacturer of bituminous waterproofing membranes for a long time. It is one of the most pretigious companies in Europe in the distribution of roof thermal insulation and in the manufacture of acoustic materials.</p>
					</div>
				</div>
			</div>
		</div> <!-- ast-container -->
	</div><!-- #content -->

	</div><!-- #page -->

	<style >
		body {
		    overflow-y: scroll;
		    min-height: 100vh;
		}

		#select-market {
		    text-align: center;
		    font-size: 30px;
		    color: #222;
		    margin-bottom: 1em;
		    line-height: 1.25em;
		}
#select-market > span {
    display: block;
}#description {
    max-width: 500px;
    margin: 0 auto;
    text-align: center;
}
		#root-country-selector {
		    padding: 50px 0;
		    margin: 0 auto;
    		width: 100%;
		}

		#root-country-selector>.container {
		    width: 90%;
		    max-width: 900px;
		    margin: 0 auto;
		}

		#root-country-selector #root-logo {
    		width: 200px;
		    margin: 0 auto 30px;
		    display: block;
		}

		#root-country-selector #lighboxCountries .country-header {
		    color: #222;
		    font-weight: normal;
		    border-bottom: 1px solid #e4e3e3;
		}

		#root-country-selector #lighboxCountries .country-header > span {
		    font-weight: bold;
		}


		#root-country-selector .accordion-lang:after {
			font-family: "danosa";
		    content: '\e807';
		    width: 16px;
		    height: 9px;
		    line-height: 1em;
		    margin-top: 8px;
		    -webkit-transform: rotate(180deg);
		    -moz-transform: rotate(180deg);
		    -o-transform: rotate(180deg);
		    -ms-transform: rotate(180deg);
		    transform: rotate(180deg);
		    display: block;
		    -webkit-transition: all 0.3s ease-in-out;
		    -moz-transition: all 0.3s ease-in-out;
		    -ms-transition: all 0.3s ease-in-out;
		    -o-transition: all 0.3s ease-in-out;
		    transition: all 0.3s ease-in-out;
		}

		#root-country-selector .accordion-lang:after {
		    right: 16px;
		    position: relative;
		}

		#root-country-selector .accordion-lang.active:after {
		    -webkit-transform: rotate(0);
		    -moz-transform: rotate(0);
		    -o-transform: rotate(0);
		    -ms-transform: rotate(0);
		    transform: rotate(0);
		}

		.select2-container--default .select2-results__group {
		    color: #222;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow b {
		    border: 0!important;
		    width: 16px!important;
		    height: 9px!important;
		    top: 11px!important;
		    left: 18px!important;
		}

		#root-country-selector #lighboxCountries li {
		    width: 25%;
		    float: none;
		    margin: 0;
		    padding-right: 10px;
		}

		@media (max-width: 800px) {
		    #root-country-selector #lighboxCountries li {
		        width: 100%;
		        padding-right: 0;
		    }
		}

		#root-country-selector #lighboxCountries li a {
		    display: block;
		    padding: 7px 0;
		}

		#root-country-selector #lighboxCountries .language-item span {
		    color: #222;
		}

		#country_redirector {
		    display: none;
		}

		.select2-container--default .select2-results>.select2-results__options {
		    max-height: 300px;
		}

		.select2-bandera img {
		    width: 25px;
		    height: 25px;
		    margin-right: 10px;
		    vertical-align: middle;
		}

		.select2-bandera span,
		.select2-bandera label {
		    vertical-align: middle;
		    color: #222;
		}
	</style>
<?php
astra_body_bottom();
wp_footer();
?>
	</body>
</html>
