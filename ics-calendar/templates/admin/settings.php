<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Don't load directly
if (!defined('ABSPATH')) { exit; }

if (function_exists('r34ics_admin_full_access') && r34ics_admin_full_access()) {
	?>
	<div class="inside" id="settings">

		<h2 class="screen-reader-text"><?php esc_html_e('Settings', 'ics-calendar'); ?></h2>

		<form id="r34ics-settings" method="post" action="#settings">
			<?php wp_nonce_field('r34ics', 'r34ics-settings-nonce'); ?>
			
			<?php do_action('r34ics_settings_fields_before'); ?>
						
			<div class="r34ics-inner-box">
				
				<h3><?php esc_html_e('Loading', 'ics-calendar'); ?></h3>
				
				<p class="r34ics-input">
					<label for="r34ics_ajax_by_default">
						<input type="checkbox" name="ajax_by_default" id="r34ics_ajax_by_default" checked="checked" disabled="disabled" /> <strong><?php esc_html_e('Always use AJAX to render calendars', 'ics-calendar'); ?></strong>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('AJAX loading is now automatic. You can override AJAX, if necessary, by adding %1$s to your shortcode.', 'ics-calendar'), '<code style="font-size: 100%;">ajax="false"</code>');
							?>
						</span></small></span>
					</label>
				</p>
				
				<p class="r34ics-input">
					<label for="r34ics_display_calendar_memory_limit">
						<strong><?php esc_html_e('Increase memory limit when rendering calendars', 'ics-calendar'); ?>:</strong>
						<?php
						echo wp_kses(
							r34ics_memory_limit_select(
								'display_calendar_memory_limit',
								'r34ics_display_calendar_memory_limit',
								intval(get_option('r34ics_display_calendar_memory_limit', r34ics_memory_limit_mb()))
							),
							r34ics_select_allowed()
						);
						?>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('If your calendar is failing to load with an "out of memory" fatal error, try increasing the memory limit. A minimum of 512 MB is recommended. %1$s Notes: 1) Some hosting providers may not allow applications to override the server default setting. 2) It is not possible to set this option lower than the current default memory limit on your server.', 'ics-calendar'), '<br /><br />');
							?>
						</span></small></span>
					</label>
				</p>
				
				<p class="r34ics-input">
					<label for="r34ics_url_get_contents_legacy_method">
						<input type="checkbox" name="url_get_contents_legacy_method" id="r34ics_url_get_contents_legacy_method"<?php if (get_option('r34ics_url_get_contents_legacy_method')) { echo ' checked="checked"'; } ?> />
						<strong><?php esc_html_e('Use legacy feed request method', 'ics-calendar'); ?></strong>
						<small class="deprecated-indicator"><?php esc_html_e('deprecated', 'ics-calendar'); ?></small>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php esc_html_e('Some servers may not support the default feed request method. If your feeds are not loading, turn on this option to use the legacy request method. This feature is deprecated and will be removed in a future update.', 'ics-calendar'); ?>
						</span></small></span>
					</label>
				</p>
				
				<p class="r34ics-input">
					<label for="r34ics_default_shortcode">
						<strong><?php esc_html_e('Default shortcode', 'ics-calendar'); ?>:</strong>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('If your site will include a large number of similarly configured calendar shortcodes, you can enter a default "base" shortcode here with the parameters that should be the same for all of the calendars. Individual shortcodes on the site can then include only the parameters that are unique to that calendar, as such: %1$s Any parameters included in the individual shortcode will override what is set here.', 'ics-calendar'), '<code>[ics_calendar url="&hellip;"]</code><br /><br />');
							?>
						</span></small></span>
					</label><br />
					<textarea name="default_shortcode" id="r34ics_default_shortcode" style="margin: 0.25em 0; max-width: 400px; width: 100%; height: 4.5rem;" /><?php echo esc_attr(get_option('r34ics_default_shortcode')); ?></textarea>
				</p>
				
				<p class="r34ics-input full-width">
					<label for="r34ics_allowed_hosts">
						<strong><?php esc_html_e('Allow access to these hostnames that resolve to reserved IP addresses', 'ics-calendar'); ?>:</strong>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('If your calendar server is hosted on the same physical server as your website, is part of the same local network, or otherwise uses a %1$sreserved IP address%2$s, enter its hostname here to allow access. For multiple calendar servers, enter one hostname per line. See %3$sthe %4$s documentation%5$s for more information.', 'ics-calendar'), '<a href="https://en.wikipedia.org/wiki/Internet_Protocol_version_4#Special-use_addresses" target="_blank">', '</a>', '<a href="https://icscalendar.com/developer/#http_request_host_is_external" target="_blank">', 'ICS Calendar', '</a>');
							?>
						</span></small></span>
					</label><br />
					<textarea name="allowed_hosts" id="r34ics_allowed_hosts" style="margin: 0.25em 0; max-width: 400px; width: 100%; height: 4.5rem;" /><?php echo esc_attr(implode("\n", (array)get_option('r34ics_allowed_hosts'))); ?></textarea><br />
					<small><?php
					// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
					printf(esc_html__('Enter one hostname per line. Hostnames are the base domain name, not a full URL. %1$s For example, you would enter %2$s, not %3$s.', 'ics-calendar'), '<br />', '<code style="font-size: 100%;">example.com</code>', '<code style="font-size: 100%;">https://example.com/path/</code>');
					?></small>
				</p>
				
				<p class="r34ics-input">
					<label for="r34ics_allowed_ports">
						<strong><?php esc_html_e('Allow access to these ports', 'ics-calendar'); ?>:</strong>
						<input type="text" name="allowed_ports" id="r34ics_allowed_ports" value="<?php echo esc_attr(implode(',', (array)get_option('r34ics_allowed_ports'))); ?>" style="margin: 0.25em 0;" />
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php esc_html_e('WordPress automatically allows access to ports 80, 443, and 8080. If you need to be able to access source calendars that use non-standard ports, enter the port numbers here, separated by commas.', 'ics-calendar'); ?>
						</span></small></span>
					</label>
				</p>
				
				<?php do_action('r34ics_settings_fields_loading'); ?>
			
			</div>
			
			<div class="r34ics-inner-box">
				
				<h3><?php esc_html_e('Caching', 'ics-calendar'); ?></h3>
				
				<p class="r34ics-input">
					<label for="r34ics_transients_expiration">
						<strong><?php esc_html_e('Transient (cache) expiration', 'ics-calendar'); ?>:</strong>
						<input type="number" name="transients_expiration" id="r34ics_transients_expiration" value="<?php echo esc_attr(get_option('r34ics_transients_expiration', 3600)); ?>" min="120" max="86400" style="width: 100px;" /> <?php esc_html_e('seconds', 'ics-calendar'); ?>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php esc_html_e('Sets how long calendar feed data should be cached on the server (WordPress transients) before reloading. Default is 3600 (1 hour). Minimum allowed value is 120 (2 minutes).', 'ics-calendar'); ?>
						</span></small></span>
					</label>
				</p>
				
				<?php do_action('r34ics_settings_fields_caching'); ?>
			
			</div>
			
			<div class="r34ics-inner-box">
				
				<h3><?php esc_html_e('Admin', 'ics-calendar'); ?></h3>
				
				<p class="r34ics-input">
					<label for="r34ics_admin_access">
						<strong><?php esc_html_e('Minimum access role', 'ics-calendar'); ?>:</strong>
						<select name="admin_access" id="r34ics_admin_access">
							<?php
							// We don't use wp_dropdown_roles() because we need to restrict this to a subset of the built-in roles
							$current = get_option('r34ics_admin_access', 'editor');
							$allowed_roles = array(
								'edit_posts' => translate_user_role('Contributor'),
								'publish_posts' => translate_user_role('Author'),
								'edit_others_posts' => translate_user_role('Editor'),
								'manage_options' => translate_user_role('Administrator'),
							);
							foreach ((array)$allowed_roles as $role => $role_name) {
								?>
								<option value="<?php echo esc_attr($role); ?>"<?php if ($current == $role) { echo ' selected="selected"'; } ?>><?php echo wp_kses_post($role_name); ?></option>
								<?php
							}
							?>
						</select>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content"><?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						printf(esc_html__('Identifies the minimum user role that is allowed to access %1$s admin pages. Certain areas such as Settings are further restricted to %2$s users only (%3$s users on Multisite configurations).', 'ics-calendar'), 'ICS Calendar', esc_attr(translate_user_role('Administrator')), esc_attr(translate_user_role('Super Admin')));
						?></span></small></span>
					</label>
				</p>

				<p class="r34ics-input">
					<label for="r34ics_register_customizer">
						<input type="checkbox" name="register_customizer" id="r34ics_register_customizer"<?php if (get_option('r34ics_register_customizer')) { echo ' checked="checked"'; } ?> />
						<strong><?php esc_html_e('Register Customizer', 'ics-calendar'); ?></strong>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php esc_html_e('WordPress no longer includes a link to the Customizer in the Appearance menu when a Block Theme is active. Check this box if you wish to use the Customizer, e.g. for the Additional CSS input. Note: Some themes or plugins may already register the Customizer, in which case, this setting will have no effect. (The checkbox only enables the Customizer when checked; it does not disable the Customizer when unchecked.', 'ics-calendar'); ?>
						</span></small></span>
					</label>
				</p>
				
				<p class="r34ics-input">
					<label for="r34ics_display_add_calendar_button_false">
						<input type="checkbox" name="display_add_calendar_button_false" id="r34ics_display_add_calendar_button_false"<?php if (get_option('r34ics_display_add_calendar_button_false')) { echo ' checked="checked"'; } ?> />
						<strong><?php esc_html_e('Remove "Add ICS Calendar" button in Classic Editor', 'ics-calendar'); ?></strong>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php esc_html_e('By default, ICS Calendar adds an "Add ICS Calendar" button to the toolbar above the WYSIWYG editor when using Classic Editor. Check this box to remove the button. Has no effect on sites using the Block Editor (Gutenberg).', 'ics-calendar'); ?>
						</span></small></span>
					</label>
				</p>
				
				<p class="r34ics-input">
					<label for="r34ics_use_new_defaults_10_6">
						<input type="checkbox" name="use_new_defaults_10_6" id="r34ics_use_new_defaults_10_6"<?php if (get_option('r34ics_use_new_defaults_10_6')) { echo ' checked="checked"'; } ?> />
						<strong><?php esc_html_e('Use new parameter defaults (v.10.6)', 'ics-calendar'); ?></strong>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('%1$s version 10.6 introduced new default values for several shortcode parameters. New installations automatically use the new default values, but upgraded installations will continue to use the old default values, unless this box is checked. Read more about these changes on %2$sour blog%3$s.', 'ics-calendar'), 'ICS Calendar', '<a href="https://icscalendar.com/updated-parameter-defaults-in-ics-calendar-10-6/" target="_blank">', '</a>');
							?>
						</span></small></span>
					</label>
				</p>
				
				<?php do_action('r34ics_settings_fields_miscellaneous'); ?>
			
			</div>	
			
			<?php do_action('r34ics_settings_fields_after'); ?>

			<footer class="r34ics-admin-sticky-footer" style="position: sticky; bottom: 0; z-index: 10;">
				<input type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes', 'ics-calendar'); ?>" />
			</footer>
		</form>

	</div>
	<?php
}
