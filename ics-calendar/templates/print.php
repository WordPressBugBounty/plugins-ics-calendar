<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Don't load directly
if (!defined('ABSPATH')) { exit; }

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=yes" />
<meta name="robots" content="noindex,nofollow,noarchive" />
<?php wp_head(); ?>
</head>
<body <?php body_class('r34ics-print-calendar'); ?>>

<div>
	<div<?php
	foreach ((array)$r34ics_print as $key => $value) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo ' ' . sanitize_title($key) . '="' . esc_attr($value) . '"';
	}
	?>>&nbsp;</div>
</div>

<script>
jQuery(function() {
	jQuery(document).on('r34ics_init_end', function() {
	
		// Select the desired range
		<?php
		if (!empty($r34ics_print_selected)) {
			?>
			if (jQuery('.ics-calendar-select').length > 0) {
				jQuery('.ics-calendar-select').val('<?php echo esc_attr($r34ics_print_selected); ?>').trigger('change');
			}
			else if (jQuery('.ics-calendar button.<?php echo esc_attr($r34ics_print_selected); ?>').length > 0) {
				jQuery('.ics-calendar button.<?php echo esc_attr($r34ics_print_selected); ?>').trigger('click');
			}
			<?php
		}
		?>
	
		setTimeout(function() {
			window.print();
		}, 1000);
	});
});
</script>

<?php wp_footer(); ?>
</body>
</html>
