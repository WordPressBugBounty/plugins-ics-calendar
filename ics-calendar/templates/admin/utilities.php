<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Don't load directly
if (!defined('ABSPATH')) { exit; }

?>
<div class="inside" id="utilities">

	<h2 class="screen-reader-text"><?php esc_html_e('Utilities', 'ics-calendar'); ?></h2>

	<div class="r34ics-flex-tiles">

		<div id="pause-button" class="r34ics-inner-box">
		
			<h3><?php
			if (get_option('r34ics_paused')) {
				// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				printf(esc_html__('Calendar Status: %1$sPaused%2$s', 'ics-calendar'), '<span style="color: var(--r34ics--color--ics-red); text-transform: uppercase;">', '</span>');
			}
			else {
				// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				printf(esc_html__('Calendar Status: %1$sActive%2$s', 'ics-calendar'), '<span style="color: var(--r34ics--color--forestgreen); text-transform: uppercase;">', '</span>');
			}
			?></h3>
		
			<p><?php
			// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			printf(esc_html__('Use the pause button if you need to temporarily turn off %1$s on your front end pages.', 'ics-calendar'), 'ICS Calendar');
			?></p>
	
			<form id="r34ics-paused" method="post" action="#utilities">
				<?php wp_nonce_field('r34ics', 'r34ics-paused-nonce'); ?>
	
				<?php
				if (get_option('r34ics_paused')) {
					?>
					<div class="r34ics-pause-on">
						<p>
							<label>
								<button class="button button-play" name="r34ics_paused" value="0"><?php esc_html_e('Resume Calendars', 'ics-calendar'); ?></button>
							</label>
						</p>
					</div>
					<?php
				}
				else {
					?>
					<div class="r34ics-pause-off">
						<p>
							<label>
								<button class="button button-pause" name="r34ics_paused" value="1"><?php esc_html_e('Pause Calendars', 'ics-calendar'); ?></button>
							</label>
						</p>
					</div>
					<?php
				}
				?>
				
			</form>
	
			<p><?php
			// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			printf(esc_html__('No content will be altered, but your calendars will be hidden and no %1$s asset files (JavaScript, CSS) will be loaded on front-end pages. If you are using caching via a plugin or through your hosting provider, you may need to clear the cache after changing this setting.', 'ics-calendar'), 'ICS Calendar');
			?></p>
	
		</div>
		
		<div id="data-cache" class="r34ics-inner-box">
		
			<h3><?php
			// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			printf(esc_html__('%1$s Data Cache', 'ics-calendar'), 'ICS Calendar');
			?></h3>
		
			<form id="r34ics-purge-calendar-transients" method="post" action="#utilities">
				<?php wp_nonce_field('r34ics', 'r34ics-purge-calendar-transients-nonce'); ?>
				
				<p><?php esc_html_e('This will immediately clear all existing cached calendar data (purge transients), forcing WordPress to reload all calendars the next time they are viewed. Caching will then resume as before.', 'ics-calendar'); ?></p>
	
				<p><input type="submit" class="button button-primary" value="<?php esc_attr_e('Clear Cached Calendar Data', 'ics-calendar'); ?>" /></p>
	
				<?php
				if (function_exists('r34ics_admin_full_access') && r34ics_admin_full_access()) {
					?>
					<p>
						<?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						$confirm_urls = sprintf(esc_attr__('If you are using a third-party caching plugin, you may need to clear your site-wide cache after running this utility.', 'ics-calendar'), 'ICS Calendar');
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						$confirm_all = sprintf(esc_attr__('Are you sure? This will reset all %1$s settings to their defaults. Your saved calendar configurations and shortcodes will be retained, but resetting the defaults may change the appearance of your calendars. If you are using a third-party caching plugin, you may need to clear your site-wide cache after running this utility.', 'ics-calendar'), 'ICS Calendar');
						?>
						<label>
							<input type="radio" name="reset_options" value="" checked="checked" />
							<?php esc_html_e('Only clear transients (default)', 'ics-calendar'); ?>
						</label><br />
						<label>
							<input type="radio" name="reset_options" value="urls" onclick="if (jQuery(this).prop('checked') == true) { if (!confirm('<?php echo esc_attr($confirm_urls); ?>')) { jQuery(this).prop('checked', false); } }" />
							<?php esc_html_e('Also clear all saved ICS feed URLs', 'ics-calendar'); ?>
						</label><br />
						<label>
							<input type="radio" name="reset_options" value="all" onclick="if (jQuery(this).prop('checked') == true) { if (!confirm('<?php echo esc_attr($confirm_all); ?>')) { jQuery(this).prop('checked', false); } }" />
							<?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('Reset %1$sall%2$s %3$s settings (including transients and feed URLs)', 'ics-calendar'), '<strong><em>', '</em></strong>', 'ICS Calendar');
							?>
						</label>
					</p>
					<?php
				}
				?>
				
				<p><em>
					<?php
					esc_html_e('Last cleared:', 'ics-calendar');
					echo ' ';
					if ($r34ics_refreshed = get_option('r34ics_refreshed')) {
						echo wp_kses_post(r34ics_date(get_option('date_format') . ' ' . get_option('time_format'), $r34ics_refreshed));
					}
					else {
						esc_html_e('never', 'ics-calendar');
					}
					?> 
				</em></p>
			</form>
		
			<?php do_action('r34ics_admin_utilities_cache'); ?>
	
		</div>
			
		<div id="ics-feed-url-tester" class="r34ics-inner-box">
		
			<h3><?php esc_html_e('ICS Feed URL Tester', 'ics-calendar'); ?></h3>
		
			<p><?php esc_html_e('If you are concerned that the plugin is not properly retrieving your feed, you can test the URL here.', 'ics-calendar'); ?></p>
		
			<form id="r34ics-url-tester" method="post" action="#utilities">
				<?php wp_nonce_field('r34ics', 'r34ics-url-tester-nonce'); ?>
				
				<div class="r34ics-input">
					<label for="r34ics-url-tester-url_to_test" class="screen-reader-text"><?php esc_html_e('Enter feed URL...', 'ics-calendar'); ?></label>
					<input type="text" name="url_to_test" id="r34ics-url-tester-url_to_test" value="<?php if (!empty($url_tester_result['url'])) { echo esc_url($url_tester_result['url']); } ?>" placeholder="<?php esc_attr_e('Enter feed URL...', 'ics-calendar'); ?>" style="width: 70%;" />
					<input type="submit" class="button button-primary" value="<?php esc_attr_e('Test URL', 'ics-calendar'); ?>" />
				</div>
			</form>
			
			<?php
			if (!empty($url_tester_result)) {
				?>
				<div class="r34ics-inner-box">
					<h3><?php esc_html_e('Results:', 'ics-calendar'); ?></h3>
					<p><mark class="<?php echo !empty($url_tester_result['size']) ? 'success' : 'error'; ?>">
						<?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						printf(esc_html__('%1$s received.', 'ics-calendar'), wp_kses_post($url_tester_result['size_display'] ?? ''));
						?>
						[HTTP <?php echo wp_kses_post($url_tester_result['response']); ?>]
					</mark></p>
					<?php
					switch ($url_tester_result['status']) {
						case 'valid':
							?>
							<p><mark class="success"><?php esc_html_e('This appears to be a valid ICS feed URL.', 'ics-calendar'); ?> [MIME: <?php echo wp_kses_post($url_tester_result['content-type'] ?: __('unknown', 'ics-calendar')); ?>]</mark></p>
							<?php
							break;
						case 'invalid':
							?>
							<p><mark class="error"><?php esc_html_e('This does not appear to be a valid ICS feed URL.', 'ics-calendar'); ?> [MIME: <?php echo wp_kses_post($url_tester_result['content-type'] ?: __('unknown', 'ics-calendar')); ?>]</mark></p>
							<?php
							break;
						case 'failed':
							?>
							<p><mark class="error"><?php esc_html_e('Could not retrieve data from the requested URL.', 'ics-calendar'); ?></mark></p>
							<?php
							break;
						case 'unknown':
							?>
							<p><mark class="error"><?php esc_html_e('An unknown error occurred while attempting to retrieve the requested URL.', 'ics-calendar'); ?></mark></p>
							<?php
							break;
						default: break;
					}
					if (!empty($url_tester_result['special'])) {
						foreach ((array)$url_tester_result['special'] as $item) {
							?>
							<p><mark class="alert"><?php echo wp_kses_post($item ?: ''); ?></mark></p>
							<?php
						}
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		
		<?php do_action('r34ics_admin_utilities_more'); ?>
	
	</div>

</div>

<?php
// Restrict System Report to admins / super admins
if (function_exists('r34ics_admin_full_access') && r34ics_admin_full_access()) {
	?>	
	<div class="inside" id="system-report">

		<h2 class="screen-reader-text"><?php esc_html_e('System Report', 'ics-calendar'); ?></h2>

		<p><mark class="alert"><?php esc_html_e('Please copy the following text and include it in your message when emailing support.', 'ics-calendar'); ?><br />
		<?php
		// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		printf(esc_html__('Also please include the %1$s shortcode exactly as you have it entered on the affected page.', 'ics-calendar'), 'ICS Calendar');
		?></mark></p>

		<textarea class="diagnostics-window" readonly="readonly" style="cursor: copy;" onclick="this.select(); document.execCommand('copy');"><?php
			echo wp_kses(strtoupper(esc_attr__('System Report', 'ics-calendar')), 'data') . "\n=================================\n";
			r34ics_system_report();
		?></textarea>

	</div>
	<?php
}
?>