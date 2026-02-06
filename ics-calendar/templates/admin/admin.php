<?php
// phpcs:disable PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Don't load directly
if (!defined('ABSPATH')) { exit; }

if (function_exists('r34ics_admin_access') && !r34ics_admin_access()) { return; }

global $R34ICS;
?>

<div class="wrap r34ics">

	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	
	<div class="metabox-holder columns-2">
	
		<div class="column-1">
		
			<div class="postbox">
		
				<nav class="r34ics-menu"><ul>
					<li><a href="#getting-started"><span class="dashicons dashicons-sos"></span><?php esc_html_e('Getting Started', 'ics-calendar'); ?></a></li>
					<?php
					if (function_exists('r34ics_admin_full_access') && r34ics_admin_full_access()) {
						?>
						<li><a href="#settings"><span class="dashicons dashicons-admin-settings"></span><?php esc_html_e('Settings', 'ics-calendar'); ?></a></li>
						<li><a href="#appearance"><span class="dashicons dashicons-admin-appearance"></span><?php esc_html_e('Appearance', 'ics-calendar'); ?></a></li>
						<?php
					}
					?>
					<li><a href="#utilities"><span class="dashicons dashicons-admin-tools"></span><?php esc_html_e('Utilities', 'ics-calendar'); ?></a></li>
					<?php
					if (function_exists('r34ics_admin_full_access') && r34ics_admin_full_access()) {
						?>
						<li><a href="#system-report"><span class="dashicons dashicons-clipboard"></span><?php esc_html_e('System Report', 'ics-calendar'); ?></a></li>
						<?php
					}
					?>
					<li><a href="https://icscalendar.com/support/" target="_blank"><span class="dashicons dashicons-email-alt"></span><?php esc_html_e('Support', 'ics-calendar'); ?></a></li>
				</ul></nav>
			
				<?php
				// Load Getting Started
				include_once(plugin_dir_path(__FILE__) . 'getting-started.php');
				
				// Load Settings
				include_once(plugin_dir_path(__FILE__) . 'settings.php');
				
				// Load Appearance
				include_once(plugin_dir_path(__FILE__) . 'appearance.php');
				
				// Load Utilities (includes System Report)
				include_once(plugin_dir_path(__FILE__) . 'utilities.php');
				?>
	
			</div>
	
			<div class="r34ics-pro-mo r34ics-gradient-bg postbox"><div class="inside">
				<h3><?php
				// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				printf(esc_html__('Do even more with %1$s version 6!', 'ics-calendar'), '<strong style="color: var(--r34ics--color--ics-purple); font-weight: 900; white-space: nowrap;">ICS Calendar Pro</strong>');
				?></h3>
						
				<div class="r34ics-pro-features">
					<div>
						<div style="align-items: center; text-align: center; display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center;"><a href="https://icscalendar.com/pro" target="_blank"><img src="<?php echo esc_url(plugins_url('assets/ics-calendar-pro-logo-2026.svg', dirname(dirname(__FILE__)))); ?>" alt="ICS Calendar Pro" width="206" height="72" /></a> <a href="https://icscalendar.com/pro" target="_blank"><img src="<?php echo esc_url(plugins_url('assets/ics-events-logo-2026.svg', dirname(dirname(__FILE__)))); ?>" alt="ICS Events" width="171" height="72" /></a></div>
						<h4><?php esc_html_e('Calendar Builder + Block Editor', 'ics-calendar'); ?></h4>
						<p><?php
							// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
							printf(esc_html__('Configure all calendar settings with an easy visual interface, and use the new %1$s block to select your saved calendars from a dropdown in the Block Editor, no shortcode needed! %2$sLearn more...%3$s', 'ics-calendar'), '<strong style="white-space: nowrap;">ICS Calendar Pro</strong>', '<strong style="white-space: nowrap;"><a href="https://icscalendar.com/calendar-builder/" target="_blank">', '</a></strong>');
						?></p>
						<h4><?php esc_html_e('Additional Views and Enhanced Features', 'ics-calendar'); ?></h4>
						<p><?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						printf(esc_html__('%1$s offers many new ways to display your calendar, including integrations with the popular %2$s and %3$s open source libraries. Month and year views with a sidebar for the selected day. "Up Next" works great for radio or TV station schedules. Widget and year availability are perfect for holiday bookings. Plus, additional capabilities are added to the core Month, Basic, List and Week views. %4$sView sample calendars...%5$s', 'ics-calendar'), '<strong style="white-space: nowrap;">ICS Calendar Pro</strong>', '<strong>FullCalendar</strong>', '<strong>Masonry</strong>', '<strong style="white-space: nowrap;"><a href="https://icscalendar.com/sample-calendars/" target="_blank">', '</a></strong>');
						?></p>
						<h4><?php esc_html_e('Customization', 'ics-calendar'); ?></h4>
						<p><?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						printf(esc_html__('Easy-to-use tools to completely customize your calendar colors, typography and more. Select one of our preset color palettes or create your own, with options to individually customize the color of each element in the calendar layout. Choose between your theme fonts, system fonts, or more than 20 included open source fonts. %1$sLearn more...%2$s', 'ics-calendar'), '<strong style="white-space: nowrap;"><a href="https://icscalendar.com/customizer/" target="_blank">', '</a></strong>');
						?></p>
						<h4><?php esc_html_e('ICS Events', 'ics-calendar'); ?></h4>
						<p><?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						printf(esc_html__('Turns %1$s into a full calendar management system. Create and edit new events directly in WordPress, and even integrate them seamlessly with your existing external ICS feeds. %2$sLearn more...%3$s', 'ics-calendar'), '<strong style="white-space: nowrap;">ICS Calendar Pro</strong>', '<strong style="white-space: nowrap;"><a href="https://icscalendar.com/ics-events-documentation/" target="_blank">', '</a></strong>');
						?></p>
						<h4><?php esc_html_e('Localized Admin Interface', 'ics-calendar'); ?></h4>
						<p><?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						printf(esc_html__('All %1$s admin pages are translated into dozens of languages, including English, Czech, Danish, German, Greek, Spanish, Estonian, Finnish, French, Hungarian, Italian, Japanese, Korean, Lithuanian, Latvian, Norwegian, Dutch, Polish, Portuguese, Romanian, Russian, Slovak, Serbian, Swedish, Turkish, Ukrainian, and Chinese.', 'ics-calendar'), '<strong style="white-space: nowrap;">ICS Calendar Pro</strong>');
						?></p>
						<p style="font-size: larger;"><?php
						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						printf(esc_html__('Visit %1$s to learn more.', 'ics-calendar'), '<strong><a href="https://icscalendar.com/pro/" target="_blank">icscalendar.com/pro</a></strong>');
						?></p>
					</div>
					<div style="position: relative;">
						<a href="https://icscalendar.com/calendar-builder/" target="_blank"><img src="<?php echo esc_url(plugins_url('assets/ss6-cb-general-scaled.png', dirname(dirname(__FILE__)))); ?>" alt="<?php esc_attr_e('Calendar Builder screenshot', 'ics-calendar'); ?>" style="width: 100%; height: auto;" /></a><br />
						<a href="https://icscalendar.com/customizer/" target="_blank"><img src="<?php echo esc_url(plugins_url('assets/ss6-appearance-scaled.png', dirname(dirname(__FILE__)))); ?>" alt="<?php esc_attr_e('Appearance screenshot', 'ics-calendar'); ?>" style="width: 100%; height: auto;" /></a>
					</div>
				</div>
		
				<h4 class="aligncenter"><?php esc_html_e('Available now!', 'ics-calendar'); ?></h4>
		
				<p class="aligncenter">
					<a href="https://icscalendar.com/pro/" target="_blank" class="button button-primary" style="font-size: large;"><?php
					// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
					printf(esc_html__('Get %1$s!', 'ics-calendar'), '<strong style="white-space: nowrap;">ICS Calendar Pro</strong>');
					?></a>
				</p>
			</div></div>

		</div>
	
		<div class="column-2" style="position: sticky; top: 60px;">

			<?php include_once(plugin_dir_path(__FILE__) . 'sidebar.php'); ?>
	
		</div>
	
	</div>

</div>

<?php
// phpcs:enable
