<?php

// Don't load directly
if (!defined('ABSPATH')) { exit; }

if (function_exists('r34ics_admin_full_access') && r34ics_admin_full_access()) {
	?>
	<div class="inside" id="appearance">

		<h2 class="screen-reader-text"><?php esc_html_e('Appearance', 'ics-calendar'); ?></h2>

		<form id="r34ics-appearance" method="post" action="#appearance">
			<?php
			wp_nonce_field('r34ics', 'r34ics-appearance-nonce');
			
			do_action('r34ics_appearance_fields_before');

			if (!class_exists('R34ICSPro')) {
				?>
				<p><mark class="info">
					<?php
					// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
					printf(esc_html__('Extensive color palette and typography options are available with %1$s. %2$sLearn More%3$s', 'ics-calendar'), '<strong>ICS Calendar Pro</strong>', '<a href="https://icscalendar.com/pro" target="_blank">', '<span class="dashicons dashicons-external" style="font-size: inherit; text-decoration: none;"></span></a>');
					?>
				</mark></p>
				<?php
			}
			?>
			
			<div class="r34ics-inner-box">

				<h3><?php esc_html_e('Color Palette', 'ics-calendar'); ?></h3>
				
				<p class="r34ics-input">
					<label for="r34ics_colors_match_theme_json">
						<input type="checkbox" name="colors_match_theme_json" id="r34ics_colors_match_theme_json"<?php if (get_option('r34ics_colors_match_theme_json')) { echo ' checked="checked"'; } ?> />
						<strong><?php esc_html_e('Match calendar color palette to current Block Theme colors', 'ics-calendar'); ?></strong>
						<small class="beta-indicator"><?php esc_html_e('beta', 'ics-calendar'); ?></small>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('Replaces the %1$s default neutral color palette with nearest matches from the current Site Editor Styles color palette or the %2$s file in your theme. Color selections are algorithmic, and some combinations may not pass accessibility contrast tests. This setting has no effect if you are using a "classic" theme that does not include a %3$s file.', 'ics-calendar'), 'ICS Calendar', '<code>theme.json</code>', '<code>theme.json</code>');
							?>
							<br /><br />
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('%1$sThis is currently a beta feature.%2$s It may require making some adjustments to your calendar appearance or CSS for optimal display, especially if you have color-coded your feeds. Functionality is subject to change.', 'ics-calendar'), '<strong style="color: var(--r34ics--color--ics-red);">', '</strong>');
							?>
						</span></small></span>
					</label>
				</p>
				
				<p class="r34ics-input">
					<label for="r34ics_colors_darkmode">
						<input type="checkbox" name="colors_darkmode" id="r34ics_colors_darkmode"<?php if (get_option('r34ics_colors_darkmode')) { echo ' checked="checked"'; } ?> />
						<strong><?php esc_html_e('Dark mode', 'ics-calendar'); ?></strong>
						<span class="description" tabindex="0"><small class="r34ics-help"><span class="help_content">
							<?php esc_html_e('Inverts color palette (light colors on a dark background).', 'ics-calendar'); ?>
						</span></small></span>
					</label>
				</p>
				
				<?php do_action('r34ics_appearance_fields_color_palette'); ?>
			
			</div>
			
			<?php do_action('r34ics_appearance_fields_after'); ?>
			
			<footer class="r34ics-admin-sticky-footer" style="position: sticky; bottom: 0; z-index: 10;">
				<input type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes', 'ics-calendar'); ?>" />
			</footer>
		</form>

	</div>
	<?php
}
