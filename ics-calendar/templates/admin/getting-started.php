<?php
// Don't load directly
if (!defined('ABSPATH')) { exit; }
?>
<div class="inside" id="getting-started" data-current="current">

	<h2 class="screen-reader-text"><?php esc_html_e('Getting Started', 'ics-calendar'); ?></h2>
	
	<?php
	if (get_option('r34ics_admin_first_run')) {
		?>
		<p><mark class="alert"><?php
		// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		printf(esc_html__('Thank you for installing %1$s. Before creating your first calendar shortcode, please visit your %2$sGeneral Settings%3$s page and verify that your site language, timezone and date/time format settings are correct. See our %4$sUser Guide%5$s for more information.', 'ics-calendar'), '<strong>ICS Calendar</strong>', '<a href="' . esc_url(admin_url('options-general.php')) . '">', '</a>', '<a href="https://icscalendar.com/general-wordpress-settings/" target="_blank">', '</a>')
		?></mark></p>
		<?php
		update_option('r34ics_admin_first_run', false, false);
	}
	?>

	<p><mark class="info"><?php
	// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
	printf(esc_html__('Get started with %1$s in four easy steps... and you\'ve already completed step one! Check out our %2$sQuick Start Guide%3$s for the rest.', 'ics-calendar'), '<strong>' . (class_exists('R34ICSPro') ? 'ICS Calendar Pro' : 'ICS Calendar') . '</strong>', '<a href="https://icscalendar.com/quick-start/" target="_blank">', '<span class="dashicons dashicons-external" style="font-size: inherit; text-decoration: none;"></span></a>');
	?></mark></p>
	
	<p style="margin: 1.5rem 0;"><a href="https://icscalendar.com/quick-start/" target="_blank" class="button button-primary" style="font-size: 1.25rem;"><?php esc_html_e('Quick Start Guide', 'ics-calendar'); ?> <span class="dashicons dashicons-external" style="vertical-align: middle; font-size: 1rem;"></span></a></p>
	
	<div class="r34ics-inner-box">
	
		<p style="font-size: larger;"><?php
		// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		printf(esc_html__('An extensive %1$sUser Guide%2$s is available on our website. Below are some quick links to key resources in the documentation.', 'ics-calendar'), '<strong><a href="https://icscalendar.com/user-guide/">', '</a></strong>');
		?></p>
		
		<ul style="display: flex; flex-wrap: wrap; gap: 3rem;">
			<?php do_action('r34ics_admin_getting_started_links_before'); ?>
			<li>
				<h3 style="margin-bottom: 0.25rem;"><?php esc_html_e('General:', 'ics-calendar'); ?></h3>
				<ul>
				<li><a href="https://icscalendar.com/getting-started/" target="_blank"><?php esc_html_e('Getting Started', 'ics-calendar'); ?></a></li>
				<li><a href="https://icscalendar.com/general-wordpress-settings/" target="_blank"><?php esc_html_e('General WordPress Settings', 'ics-calendar'); ?></a></li>
				<li><a href="https://icscalendar.com/ics-calendar-settings/" target="_blank"><?php
				// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				printf(esc_html__('%1$s Settings', 'ics-calendar'), 'ICS Calendar');
				?></a></li>
				</ul>
			</li>
			<li>
				<h3 style="margin-bottom: 0.25rem;"><?php esc_html_e('Working with Shortcodes:', 'ics-calendar'); ?></h3>
				<ul>
				<li><a href="https://icscalendar.com/shortcode-overview/" target="_blank"><?php esc_html_e('Shortcode Overview', 'ics-calendar'); ?></a></li>
				<li><a href="https://icscalendar.com/shortcode-builder/" target="_blank"><?php esc_html_e('Shortcode Builder', 'ics-calendar'); ?></a></li>
				<li><a href="https://icscalendar.com/icsdocs/" target="_blank"><?php esc_html_e('Shortcode Parameters Reference', 'ics-calendar'); ?></a></li>
				</ul>
			</li>
			<li>
				<h3 style="margin-bottom: 0.25rem;"><?php esc_html_e('Advanced Topics:', 'ics-calendar'); ?></h3>
				<ul>
				<li><a href="https://icscalendar.com/faqs-and-tips/" target="_blank"><?php esc_html_e('FAQs and Tips', 'ics-calendar'); ?></a></li>
				<li><a href="https://icscalendar.com/css-guide/" target="_blank"><?php esc_html_e('CSS Guide', 'ics-calendar'); ?></a></li>
				<li><a href="https://icscalendar.com/developer/" target="_blank"><?php esc_html_e('Developer Resources', 'ics-calendar'); ?></a></li>
				<li><a href="https://icscalendar.com/gdpr/" target="_blank"><?php esc_html_e('GDPR', 'ics-calendar'); ?></a></li>
				</ul>
			</li>
			<?php do_action('r34ics_admin_getting_started_links_after'); ?>
		</ul>
	
	</div>
	
</div>
