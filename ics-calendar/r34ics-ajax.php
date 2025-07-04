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

		// Validate nonce
		/**
		 * Note: Nonce was removed in version 11.5.8, due to caching plugin conflicts.
		 * Custom data sanitization in the following block, combined with the limited
		 * functionality of the methods called in response, should obviate the nonce.
		 */
		
		// Sanitize input
		/**
		 * Note: Plugin Check throws a warning about a non-sanitized variable but that is
		 * literally what this entire block of code is for! We have our own specific
		 * requirements for sanitizing this data, so we can't use a built-in WordPress
		 * function to do it.
		 */
		$args = isset($_POST['args']) ? wp_unslash($_POST['args']) : array();
		foreach ((array)$args as $key => $value) {
			// Only allow keys that match a valid shortcode attribute
			if (!in_array($key, array_keys($valid_atts))) { continue; }
			// Sanitize values
			// Convert URL code to the corresponding real URL in the database
			if ($key == 'url') {
				$args['url'] = r34ics_url_uniqid_array_convert($args['url']);
			}
			// Sanitize array values
			elseif (is_array($value)) {
				$args[$key] = array_map(function($v) {
					return is_string($v) ? wp_kses_post(stripslashes(trim($v ?: ''))) : intval($v);
				}, $value);
			}
			// Sanitize scalar values
			else {
				$args[$key] = is_string($value) ? wp_kses_post(stripslashes(trim($value ?: ''))) : intval($value);
			}
			// Sanitize boolean values
			if ($value == 'true') { $args[$key] = 1; }
			elseif ($value == 'false') { $args[$key] = 0; }
		}
		
		if (isset($_POST['subaction'])) {
			switch (sanitize_text_field(wp_unslash($_POST['subaction']))) {
			
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
	}
	exit;
}

add_action('wp_ajax_r34ics_ajax', 'r34ics_ajax');
add_action('wp_ajax_nopriv_r34ics_ajax', 'r34ics_ajax');
