<?php
// Don't load directly
if (!defined('ABSPATH')) { exit; }
?>
<a href="#" class="button r34ics_media_link add_r34ics" id="add_r34ics_<?php echo esc_attr(r34ics_uid()); ?>" title="<?php
// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
printf(esc_attr__('Add %1$s', 'ics-calendar'), 'ICS Calendar');
?>"><div class="r34ics_media_icon">&nbsp;</div><?php
// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
printf(esc_html__('Add %1$s', 'ics-calendar'), 'ICS Calendar');
?></a>
