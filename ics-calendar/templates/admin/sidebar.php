<div class="postbox"><div class="inside">

	<a href="https://icscalendar.com/" target="_blank"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/ics-calendar-logo-2023.svg" alt="ICS Calendar" style="display: block; height: auto; margin: 0 auto 1.5em auto; width: 180px;" /></a>
	
	<h3><?php _e('User Guide', 'r34ics'); ?></h3>
	
	<p><?php _e('Our complete user guide is available with full translation into dozens of languages on our website:', 'r34ics'); ?><br />
	<strong><a href="https://icscalendar.com/user-guide/">icscalendar.com/user-guide</a></strong></p>
	
	<h3><?php _e('Support', 'r34ics'); ?></h3>
	
	<p><?php printf(__('For support please email %1$s or use the %2$sWordPress Support Forums%3$s.', 'r34ics'), '<strong><a href="mailto:support@room34.com">support@room34.com</a></strong>', '<strong><a href="https://wordpress.org/support/plugin/ics-calendar" target="_blank" style="white-space: nowrap;">', '</a></strong>'); ?></p>
	
	<?php
	// Restrict System Report to admins / super admins
	if	(
				(is_multisite() && current_user_can('setup_network')) ||
				(!is_multisite() && current_user_can('manage_options'))
			)
	{
		?>
		<p><mark class="alert"><?php printf(__('When emailing, please include the %1$sSystem Report%2$s from this page.', 'r34ics'), '<a href="#system-report" style="white-space: nowrap;">', '</a>'); ?></mark></p>
		<?php
	}
	?>

</div></div>

<div class="postbox"><div class="inside">

	<h3 style="text-align: center;"><?php _e('Do even more with...', 'r34ics'); ?></h3>

	<a href="https://icscalendar.com/pro" target="_blank"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/ics-calendar-pro-logo-2023.svg" alt="ICS Calendar Pro" style="display: block; height: auto; margin: 1.5em auto; width: 180px;" /></a>
	
	<h4 style="margin-bottom: 0;"><?php _e('ICS Events', 'r34ics'); ?></h4>
	<p style="margin-top: 0;"><?php printf(__('%1$sNew in version 5.1!%2$s Turns ICS Calendar Pro into a full calendar system. Create and manage events directly in WordPress and even integrate them seamlessly with your existing feeds.', 'r34ics'), '<strong style="color: crimson;">', '</strong>'); ?></p>
	<h4 style="margin-bottom: 0;"><?php _e('Additional Views', 'r34ics'); ?></h4>
	<p style="margin-top: 0;"><?php _e('Full, Up Next, Masonry, Month with Sidebar, Widget, and more.', 'r34ics'); ?></p>
	<h4 style="margin-bottom: 0;"><?php _e('Calendar Builder', 'r34ics'); ?></h4>
	<p style="margin-top: 0;"><?php _e('Configure all calendar settings with an easy visual interface. Also works directly in Block Editor.', 'r34ics'); ?></p>
	<h4 style="margin-bottom: 0;"><?php _e('Customizer', 'r34ics'); ?></h4>
	<p style="margin-top: 0;"><?php _e('Easily modify your calendar color palettes, fonts, and more, site-wide.', 'r34ics'); ?></p>
	<h4 style="margin-bottom: 0;"><?php _e('Enhanced Features', 'r34ics'); ?></h4>
	<p style="margin-top: 0;"><?php _e('Additional capabilities are added to the core month, basic, list and week views.', 'r34ics'); ?></p>
	<p><?php printf(__('Visit %s to learn more.', 'r34ics'), '<strong><a href="https://icscalendar.com/pro/" target="_blank">icscalendar.com/pro</a></strong>'); ?></p>
	
	<p style="text-align: center;"><a href="https://icscalendar.com/pro/" target="_blank" class="button button-primary"><?php _e('Go PRO!', 'r34ics'); ?></a></p>

</div></div>

<div class="postbox"><div class="inside">

	<a href="https://room34.com/" target="_blank"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))); ?>assets/room34-logo-on-white.svg" alt="Room 34 Creative Services" style="display: block; height: auto; margin: 1.5em auto; width: 180px;" /></a> 
			
	<p style="text-align: center;">ICS Calendar v. <?php echo get_option('r34ics_version'); ?></p>

</div></div>
