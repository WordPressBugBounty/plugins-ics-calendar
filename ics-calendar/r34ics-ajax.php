<?php

function r34ics_ajax() {
	global $R34ICS;
	
	// Get list of valid shortcode attributes
	$valid_atts = $R34ICS->shortcode_defaults_merge();
		
	// Don't do anything in Block Editor
	if (function_exists('get_current_screen') && $current_screen = get_current_screen()) {
		if (method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor()) {
			exit;
		}
	}
	
	if (!empty($_POST)) {

		// Bypass nonce verification
		if (get_option('r34ics_ajax_bypass_nonce')) {
			add_filter('r34ics_debug_array', function($arr) {
				$arr['Misc'][] = sprintf(__('%1$s AJAX request bypassed nonce verification, due to configuration setting.', 'r34ics'), 'ICS Calendar');
				return $arr;
			}, 10, 1);
		}
		// Verify nonce
		elseif (!wp_verify_nonce($_POST['r34ics_nonce'], 'r34ics_nonce')) { echo 1; exit; }
		
		// Sanitize input
		$args = $_POST['args'];
		foreach ((array)$args as $key => $value) {
			if (!in_array($key, array_keys($valid_atts))) { continue; }
			if ($key == 'url') {
				$args['url'] = r34ics_url_uniqid_array_convert($args['url']);
			}
			elseif (is_array($value)) {
				$args[$key] = array_map(function($v) {
					return is_string($v) ? stripslashes(wp_kses_post($v)) : intval($v);
				}, $value);
			}
			else {
				$args[$key] = is_string($value) ? stripslashes(wp_kses_post($value)) : intval($value);
			}
			if ($value == 'true') { $args[$key] = 1; }
			elseif ($value == 'false') { $args[$key] = 0; }
		}
		
		switch ($_POST['subaction']) {
		
			case 'display_calendar':
				if (!empty($args['url'])) {
					$R34ICS->display_calendar($args);
					if (!empty($args['debug'])) {
						_r34ics_wp_footer_debug_output();
					}
				}
				break;
		
			default:
				break;

		}
	}
	exit;
}

add_action('wp_ajax_r34ics_ajax', 'r34ics_ajax');
add_action('wp_ajax_nopriv_r34ics_ajax', 'r34ics_ajax');
