<?php
global $R34ICS;
?>

<div class="wrap r34ics">

	<h2><?php echo get_admin_page_title(); ?></h2>
	
	<div class="metabox-holder columns-2">
	
		<div class="column-1">
		
			<div class="postbox">
		
				<nav class="r34ics-menu"><ul>
					<li><a href="#getting-started"><?php _e('Getting Started', 'r34ics'); ?></a></li>
					<li><a href="#utilities"><?php _e('Utilities', 'r34ics'); ?></a></li>
					<li><a href="#system-report"><?php _e('System Report', 'r34ics'); ?></a></li>
					<li><a href="#settings"><?php _e('Settings', 'r34ics'); ?></a></li>
				</ul></nav>
			
				<?php include_once(plugin_dir_path(__FILE__) . 'getting-started.php'); ?>
	
				<?php include_once(plugin_dir_path(__FILE__) . 'utilities.php'); ?>
	
				<?php
				if (current_user_can('manage_options')) {
					?>
					<div class="inside" id="settings">
	
						<h2><?php _e('Settings', 'r34ics'); ?></h2>
	
						<form id="r34ics-settings" method="post" action="#settings">
							<?php
							wp_nonce_field('r34ics','r34ics-settings-nonce');
						
							include_once(plugin_dir_path(__FILE__) . 'settings.php');
							?>
	
							<p><input type="submit" class="button button-primary" value="<?php echo esc_attr(__('Save Changes', 'r34ics')); ?>" /></p>
						</form>
	
					</div>
					<?php
				}
				?>
			
			</div>
	
		</div>
	
		<div class="column-2">

			<?php include_once(plugin_dir_path(__FILE__) . 'sidebar.php'); ?>
	
		</div>
	
	</div>

</div>