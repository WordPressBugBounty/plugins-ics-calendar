<div class="inside" id="utilities">

	<h2><?php _e('Utilities', 'r34ics'); ?></h2>

	<div id="data-cache">
	
		<h3><?php printf(__('%1$s Data Cache', 'r34ics'), 'ICS Calendar'); ?></h3>
	
		<form id="r34ics-purge-calendar-transients" method="post" action="#utilities">
			<?php
			wp_nonce_field('r34ics','r34ics-purge-calendar-transients-nonce');
			?>
			<p><input type="submit" class="button button-primary" value="<?php echo esc_attr(__('Clear Cached Calendar Data', 'r34ics')); ?>" /></p>
			<p><?php _e('This will immediately clear all existing cached calendar data (purge transients), forcing WordPress to reload all calendars the next time they are viewed. Caching will then resume as before.', 'r34ics'); ?></p>
		</form>
	
	</div>
		
	<div id="ics-feed-url-tester">
	
		<h3><?php _e('ICS Feed URL Tester', 'r34ics'); ?></h3>
	
		<p><?php _e('If you are concerned that the plugin is not properly retrieving your feed, you can test the URL here.', 'r34ics'); ?></p>
	
		<form id="r34ics-url-tester" method="post" action="#utilities">
			<?php
			wp_nonce_field('r34ics','r34ics-url-tester-nonce');
			?>
			<div class="r34ics-input">
				<label for="r34ics-url-tester-url_to_test"><input type="text" name="url_to_test" id="r34ics-url-tester-url_to_test" value="<?php if (!empty($url_tester_result['url'])) { echo esc_url($url_tester_result['url']); } ?>" placeholder="<?php echo esc_attr(__('Enter feed URL...', 'r34ics')); ?>" style="width: 50%;" /></label> <input type="submit" class="button button-primary" value="<?php echo esc_attr(__('Test URL', 'r34ics')); ?>" />
			</div>
		</form>
		
		<?php
		if (!empty($url_tester_result)) {
			?>
			<h3><?php _e('Results:', 'r34ics'); ?></h3>
			<?php
			if (!empty($url_tester_result['size'])) {
				?>
				<p><mark class="success"><?php printf(__('%s received.', 'r34ics'), wp_kses_post($url_tester_result['size'])); ?></mark></p>
				<?php
			}
			switch ($url_tester_result['status']) {
				case 'valid':
					?>
					<p><mark class="success"><?php _e('This appears to be a valid ICS feed URL.', 'r34ics'); ?></mark></p>
					<?php
					break;
				case 'invalid':
					?>
					<p><mark class="error"><?php _e('This does not appear to be a valid ICS feed URL.', 'r34ics'); ?></mark></p>
					<?php
					break;
				case 'failed':
					?>
					<p><mark class="error"><?php _e('Could not retrieve data from the requested URL.', 'r34ics'); ?></mark></p>
					<?php
					break;
				case 'unknown':
					?>
					<p><mark class="error"><?php _e('An unknown error occurred while attempting to retrieve the requested URL.', 'r34ics'); ?></mark></p>
					<?php
					break;
				default: break;
			}
			if (!empty($url_tester_result['special'])) {
				foreach ((array)$url_tester_result['special'] as $item) {
					?>
					<p><mark class="alert"><?php echo wp_kses_post($item); ?></mark></p>
					<?php
				}
			}
		}
		?>
	</div>

</div>

<?php
// Restrict System Report to admins / super admins
if	(
			(is_multisite() && current_user_can('setup_network')) ||
			(!is_multisite() && current_user_can('manage_options'))
		)
{
	?>	
	<div class="inside" id="system-report">

		<h2><?php _e('System Report', 'r34ics'); ?></h2>

		<p><mark class="alert"><?php _e('Please copy the following text and include it in your message when emailing support.', 'r34ics'); ?><br />
		<?php printf(__('Also please include the %1$s shortcode exactly as you have it entered on the affected page.', 'r34ics'), 'ICS Calendar'); ?></mark><br /><mark class="error"><?php printf(__('For your site security please do NOT post the System Report in the support forums.', 'r34ics')); ?></mark></p>

		<textarea class="diagnostics-window" readonly="readonly" style="cursor: copy;" onclick="this.select(); document.execCommand('copy');"><?php r34ics_system_report(); ?></textarea>

	</div>
	<?php
}
?>