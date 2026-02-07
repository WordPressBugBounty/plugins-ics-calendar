<?php
/*
Plugin Name: ICS Calendar
Plugin URI: https://icscalendar.com
Description: Turn your Google Calendar, Microsoft Office 365 or Apple iCloud Calendar into a seamlessly integrated, auto-updating, zero-maintenance WordPress experience.
Version: 12.0.4.1
Requires at least: 4.9
Requires PHP: 7.2
Author: Room 34 Creative Services, LLC
Author URI: https://icscalendar.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ics-calendar
Domain Path: /i18n/languages/
*/

/*
  Copyright 2026 Room 34 Creative Services, LLC. (Email: info@room34.com)

	This program is free software; you can redistribute it and/or modify it under the terms
	of the GNU General Public License, version 2, as published by the Free Software
	Foundation.

	This program is distributed in the hope that it will be useful, but WITHOUT ANY
	WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
	PARTICULAR PURPOSE. See the GNU General Public License for more details.

	https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
	
	NOTE: The ICS Calendar and ICS Calendar Pro names, logos, and related branding assets
	are trademarks of Room 34 Creative Services, LLC and may not be used without permission.
	They are distributed with this software for the purpose of identification only. Reuse or
	redistribution of these assets is NOT covered by the GPL, and is hereby prohibited.
*/

// Don't load directly
if (!defined('ABSPATH')) { exit; }


// Check if embedded version is already been loaded, to prevent fatal error on activation
if (!class_exists('R34ICS')) {
	
	// Load required files
	require_once(plugin_dir_path(__FILE__) . 'class-r34ics.php');
	require_once(plugin_dir_path(__FILE__) . 'functions.php');
	require_once(plugin_dir_path(__FILE__) . 'r34ics-ajax.php');
	
	
	// Backward compatibility for WP < 5.3
	// @todo Deprecated as of ICS Calendar v. 12.0
	if (!function_exists('wp_date')) {
		require_once(plugin_dir_path(__FILE__) . 'compatibility.php');
	}
	
	
	// Initialize plugin functionality
	function r34ics_plugins_loaded() {
	
		// Instantiate class
		global $R34ICS;
		$R34ICS = new R34ICS();
				
		// Conditionally run update function
		if (is_admin() && version_compare(get_option('r34ics_version'), $R34ICS->version, '!=')) { r34ics_update(); }
		
	}
	add_action('plugins_loaded', 'r34ics_plugins_loaded');


	// Force loading of embedded translation files
	function r34ics_load_textdomain_mofile($file='', $domain='') {
		if ($domain == 'ics-calendar') {
			// Determine the plugin locale with fallback generic language files
			$locales = r34ics_i18n_locales();
			$locale = determine_locale();
			if (!in_array($locale, $locales)) { $locale = substr($locale, 0, 2); }
			$file = plugin_dir_path(__FILE__) . 'i18n/languages/' . $domain . '-' . $locale . '.l10n.php';
			if (!file_exists($file)) {
				$file = plugin_dir_path(__FILE__) . 'i18n/languages/' . $domain . '-' . $locale . '.mo';
			}
		}
		return $file;
	}
	add_filter('load_textdomain_mofile', 'r34ics_load_textdomain_mofile', 10, 2);
	
	
	// Install/activate
	function r34ics_install() {
		global $R34ICS;
	
		// Remember previous version
		$previous_version = get_option('r34ics_version', 0);
		update_option('r34ics_previous_version', $previous_version, false);
		
		// Update version and locale
		if (isset($R34ICSPro->version)) {
			update_option('r34ics_version', $R34ICSPro->version);
			update_option('r34ics_locale', determine_locale());
		}	
		
		// Resolve Loco Translate conflict by copying general languages file to locale files (symlink if possible)
		if (is_plugin_active('loco-translate/loco.php')) {
			r34ics_i18n_symlinks();
		}

		// New installation; write non-empty defaults
		if (empty($previous_version)) {
			r34ics_reset_non_empty_defaults();
		}
		
		// Purge saved locale list
		delete_option('r34ics_i18n_locales');
	
		// Flush rewrite rules
		flush_rewrite_rules();
		
		// Set options for first run redirect (runs on admin_init hook, below)
		//update_option('r34ics_admin_first_run', true, false); // Reserved for future use
		update_option('r34ics_activation_redirect', true, false);
	}
	register_activation_hook(__FILE__, 'r34ics_install');
	
	// Redirect to Getting Started page with first run message
	add_action('admin_init', function() {
		if (get_option('r34ics_activation_redirect')) {
			update_option('r34ics_activation_redirect', false, false); // DO NOT REMOVE THIS LINE! You'll have to manually delete the plugin to stop the redirect loops
			wp_safe_redirect(admin_url('admin.php?page=ics-calendar'));
			exit;
		}
	}, PHP_INT_MAX - 1);
	
	
	// Updates
	function r34ics_update() {
		global $R34ICS;
	
		// Remember previous version
		$previous_version = get_option('r34ics_version', 0);
		update_option('r34ics_previous_version', $previous_version, false);
		
		// Update version
		if (isset($R34ICS->version)) {
			update_option('r34ics_version', $R34ICS->version);
		}
		
		// Version-specific updates
		// v. 6.11.1 renamed option from 'r34ics_transient_expiration' to 'r34ics_transient_expiration' so it's not a transient itself
		if (version_compare($previous_version, '6.11.1', '<')) {
			$transients_expiration = get_option('r34ics_transient_expiration', 3600);
			update_option('r34ics_transients_expiration', $transients_expiration, true);
			delete_option('r34ics_transient_expiration');
		}
		
		// v. 10.7.1 replaces "Load JS and CSS files on wp_enqueue_scripts action" option with check for block themes
		// Block themes support conditionally enqueuing JS and CSS when the page contains the ICS Calendar shortcode
		if (version_compare($previous_version, '10.7.1', '<')) {
			delete_option('r34ics_load_css_js_on_wp_enqueue_scripts');
		}
	
		// Remove r34ics_ajax_bypass_nonce option because the nonce was removed
		if (version_compare($previous_version, '11.5.8', '<')) {
			delete_option('r34ics_ajax_bypass_nonce');
		}
		
		// Purge calendar transients
		r34ics_purge_calendar_transients();
		
	}
	
	
	// Purge transients on certain option updates
	add_action('update_option_start_of_week', 'r34ics_purge_calendar_transients');
	add_action('update_option_timezone_string', 'r34ics_purge_calendar_transients');


	// Deferred admin notices (runs on shutdown to catch all collected notices during script execution)
	add_action('shutdown', 'r34ics_deferred_admin_notices', PHP_INT_MAX - 1);
	
	
	// Development only -- used with Plugin Check (PCP) plugin
	add_filter('wp_plugin_check_ignore_directories', function ($directories) {
			$directories[] = 'i18n';
			$directories[] = 'vendors';
			return $directories;
	});
	
}
