<?php
// phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage

// Don't load directly
if (!defined('ABSPATH')) { exit; }

?>

<div class="r34ics-gradient-bg postbox"><div class="inside">

	<a href="https://icscalendar.com/" target="_blank"><img src="<?php echo esc_url(plugins_url('assets/ics-calendar-logo-2026.svg', dirname(dirname(__FILE__)))); ?>" alt="ICS Calendar" style="display: block; height: auto; margin: 0 auto 1.5em auto; width: 180px;" width="180" height="62" /></a>
	
	<h3><?php esc_html_e('User Guide', 'ics-calendar'); ?></h3>
	
	<p><?php esc_html_e('Our complete user guide is available with full translation into dozens of languages on our website:', 'ics-calendar'); ?><br />
	<strong><a href="https://icscalendar.com/user-guide/">icscalendar.com/user-guide</a></strong></p>
	
	<h3><?php esc_html_e('Support', 'ics-calendar'); ?></h3>
	
	<p><?php
	// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
	printf(esc_html__('For assistance, please use our %1$ssupport request form%2$s.', 'ics-calendar'), '<strong><a href="https://icscalendar.com/support/" target="_blank" style="white-space: nowrap;">', '</a></strong>');
	?></p>
	
	<?php
	// Restrict System Report to admins / super admins
	if (function_exists('r34ics_admin_full_access') && r34ics_admin_full_access()) {
		?>
		<p><?php
		// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		printf(esc_html__('When contacting support, please include the %1$ssystem report%2$s from this page.', 'ics-calendar'), '<strong><a href="#system-report" style="white-space: nowrap;">', '</a></strong>');
		?></p>
		<?php
	}
	?>

	<h3><?php esc_html_e('Spread the word!', 'ics-calendar'); ?></h3>
	
	<p><?php
	// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
	printf(esc_html__('If you find %1$s useful, you can help support our continued growth and development with a %2$sfive-star review%3$s. Thank you!', 'ics-calendar'), '<strong>ICS Calendar</strong>', '<strong><a href="https://wordpress.org/support/plugin/ics-calendar/reviews/#new-post" target="_blank" style="white-space: nowrap;">', '</a></strong>');
	?></p>

</div></div>

<div class="postbox"><div class="inside">

	<a href="https://room34.com/" target="_blank"><img src="<?php echo esc_url(plugins_url('assets/room34-logo-on-white.svg', dirname(dirname(__FILE__)))); ?>" alt="Room 34 Creative Services" style="display: block; height: auto; margin: 1.5em auto; width: 180px;" width="180" height="55" /></a> 
			
	<p style="text-align: center;">ICS Calendar v. <?php echo esc_html(get_option('r34ics_version')); ?><br />
	&copy; <?php echo intval(wp_date('Y')); ?> Room 34 Creative Services, LLC</p>

</div></div>

<?php
// phpcs:enable
