<?php
// Require object
if (empty($ics_data)) { return false; }

global $R34ICS;

$start_of_week = get_option('start_of_week', 0);

$date_format = r34ics_date_format($args['format'], true);

$ics_calendar_classes = apply_filters('r34ics_calendar_classes', array($args['nostyle'] ? 'nostyle' : ''), $args, true);

$today = r34ics_date('Ymd');

// Feed colors custom CSS
if (!empty($ics_data['colors'])) {
	r34ics_feed_colors_css($ics_data, true);
}

// Prepare event details toggle lightbox
if ($args['toggle'] === 'lightbox') {
	r34ics_lightbox_container();
}

// Pagination
// Initial opacity depends on whether or not we are using AJAX and pagination
$initial_opacity = 0;
if (!empty($args['pagination'])) {
	$pagination = intval($args['pagination']);
}
else {
	$pagination = false;
	$initial_opacity = !empty($args['ajax']) ? 0 : 1;
}
?>

<section class="<?php echo esc_attr($ics_calendar_classes); ?>" id="<?php echo esc_attr($ics_data['guid']); ?>" style="opacity: <?php echo intval($initial_opacity); ?>;">

	<?php
	// Title and description
	if (!empty($ics_data['title'])) {
		?>
		<<?php echo esc_attr($args['htmltagtitle']); ?> class="ics-calendar-title"><?php echo wp_kses_post($ics_data['title'] ?: ''); ?></<?php echo esc_attr($args['htmltagtitle']); ?>>
		<?php
	}
	if (!empty($ics_data['description'])) {
		?>
		<p class="ics-calendar-description"><?php echo wp_kses_post($ics_data['description'] ?: ''); ?></p>
		<?php
	}
	
	// Empty calendar message
	if (empty($ics_data['events']) || r34ics_is_empty_array($ics_data['events'])) {
		?>
		<p class="ics-calendar-error"><?php esc_html_e('No events found.', 'ics-calendar'); ?></p>
		<?php
	}
	
	// Display calendar
	else {

		// Actions before rendering calendar wrapper (can include additional template output)
		do_action('r34ics_display_calendar_before_wrapper', $view, $args, $ics_data);

		// Color code key
		if (empty($args['legendposition']) || $args['legendposition'] == 'above') {
			echo wp_kses(($R34ICS->color_key_html($args, $ics_data) ?: ''), r34ics_color_key_allowed());
		}
	
		// Pagination HTML
		$pagination_html = '';
		if (!empty($pagination)) {
			ob_start();
			?>
			<div class="ics-calendar-paginate-wrapper" aria-hidden="true">
				<a href="#<?php echo esc_attr($ics_data['guid']); ?>" class="ics-calendar-paginate prev">&larr; <?php esc_html_e('Previous Page', 'ics-calendar'); ?></a>
				<a href="#<?php echo esc_attr($ics_data['guid']); ?>" class="ics-calendar-paginate next"><?php esc_html_e('Next Page', 'ics-calendar'); ?> &rarr;</a>
			</div>
			<?php
			$pagination_html = ob_get_clean();
		}
		
		// Write calendar to output buffer so we can determine whether or not to display pagination
		// This is because the exact number of displayed events isn't known until we iterate through the output
		ob_start();

		// Build monthly calendars
		$i = 0;
		$skip_i = 0;
		$multiday_events_used = array();
		$years = $ics_data['events'];

		// Pagination?
		if (!empty($pagination)) {
			$p_i = 0; $p_c = 0; $pagination_open = false;
		}

		// Reverse?
		if ($args['reverse']) { krsort($years); }

		?>
		<article class="ics-calendar-basic-wrapper">

			<?php
			// Pagination?
			if (!empty($pagination)) {
				if ($p_i == 0 && empty($pagination_open)) {
					?>
					<div class="ics-calendar-pagination" data-page="<?php echo intval($p_c); ?>">
					<?php
					$p_c++; $p_i = 0; $pagination_open = true;
				}
			}
			?>

			<ul class="events r34ics-basic-events">
				<?php
				foreach ((array)$years as $year => $months) {

					// Reverse?
					if ($args['reverse']) { krsort($months); }

					foreach ((array)$months as $month => $days) {
						$ym = $year . $month;
			
						// Is this month in range? If not, skip to the next
						if (!r34ics_month_in_range($ym, $ics_data)) { continue; }
			
						$m = intval($month);
						$month_uid = $ics_data['guid'] . '-' . $ym;
							
						// Build month's calendar
						if (isset($days)) {

							// Reverse?
							if ($args['reverse']) { krsort($days); }

							foreach ((array)$days as $day => $day_events) {
								$date = r34ics_date('Ymd', $m.'/'.$day.'/'.$year);
								$d = r34ics_date('d', $date);
								$dow = r34ics_date('w', $date);
								$wknum = r34ics_date('W', $date . ' +' . (1 - $start_of_week) . 'day'); // PHP week numbers start on Monday
				
								// Is this past/present/future?
								$rel2today = null;
								if ($date < $today) { $rel2today = 'past'; }
								elseif ($date == $today) { $rel2today = 'today'; }
								elseif ($date > $today) { $rel2today = 'future'; }
					
								// Loop through events
								$day_events_count = r34ics_day_events_count($day_events);
								$day_feed_keys = r34ics_day_events_feed_keys($day_events, '|');
								$day_uid = $ics_data['guid'] . '-' . $ym . $d;

								foreach ((array)$day_events as $time => $events) {
									foreach ((array)$events as $event) {

										// Skip event if under the skip limit
										if (!empty($args['skip']) && $skip_i < $args['skip']) {
											$skip_i++; continue;
										}
										
										// Pagination?
										if (!empty($pagination)) {
											if ($p_i == 0 && empty($pagination_open)) {
												echo '<div class="ics-calendar-pagination" data-page="' . intval($p_c) . '" data-rel2today="' . esc_attr($rel2today) . '"><ul class="events r34ics-basic-events">';
												$p_c++; $p_i = 0; $pagination_open = true;
											}
										}

										// Set date label (and possibly skip, if this is a multiday event we've already shown)
										if (!empty($event['multiday'])) {
											// Give this instance its own unique ID, since multiple instances of a recurring event will have the same UID
											$multiday_instance_uid = $event['uid'] . '-' . $event['multiday']['start_date'];

											// Skip event if under the skip limit (but be sure to count it in $multiday_events_used!) 
											if (!empty($args['skip']) && $skip_i < $args['skip']) {
												if (!in_array($multiday_instance_uid, $multiday_events_used)) {
													$multiday_events_used[] = $multiday_instance_uid;
													$skip_i++;
												}
												continue;
											}

											// Have we used this event yet?
											if (in_array($multiday_instance_uid, $multiday_events_used)) {
												continue;
											}
											else {
												$multiday_events_used[] = $multiday_instance_uid;
											}
										
											$day_label = r34ics_multiday_date_label($date_format, $event, $args);
										}
										else {
											$day_label = r34ics_date($date_format, $month.'/'.$day.'/'.$year);
										}

										$has_desc = r34ics_has_desc($args, $event);
										?>
					
										<li class="<?php echo esc_attr(r34ics_event_css_classes($event, $time, $args)); ?>" data-dow="<?php echo esc_attr($dow); ?>" data-wknum="<?php echo esc_attr($wknum); ?>" data-rel2today="<?php echo esc_attr($rel2today); ?>" data-feed-key="<?php echo intval($event['feed_key']); ?>"<?php
											if (!empty($ics_data['colors'][$event['feed_key']]['base'])) { echo ' data-feed-color="' . esc_attr($ics_data['colors'][$event['feed_key']]['base']) . '"'; }
											if (!empty($event['categories'])) { echo ' data-categories="' . esc_attr($event['categories']) . '"'; }
											if (isset($p_i)) { echo ' data-p-i="' . intval($p_i) . '"'; }
										?>>
											<<?php echo esc_attr($args['htmltagdate']); ?> class="date<?php if (!empty($event['multiday'])) { echo ' multiday'; } ?>"><?php echo wp_kses_post($day_label ?: ''); ?></<?php echo esc_attr($args['htmltagdate']); ?>>

											<div class="event-info">
												<?php
												// Event start/end times (multiday events already include time in $day_label)
												if (empty($event['multiday']) && empty($args['hidetimes']) && !empty($event['start'])) {
													?>
													<<?php echo esc_attr($args['htmltagtime']); ?> class="time">
														<span class="start_time"><?php echo wp_kses_post($event['start'] ?: ''); ?></span>
														<?php
														if (!empty($args['showendtimes']) && !empty($event['end']) && $event['end'] != $event['start']) {
															?>
															<span class="end_time">&#8211; <?php echo wp_kses_post($event['end'] ?: ''); ?></span>
															<?php
														}
														?>
													</<?php echo esc_attr($args['htmltagtime']); ?>>
													<?php
												}

												// Event label (title)
												echo wp_kses_post($R34ICS->event_label_html($args, $event, (!empty($has_desc) ? array('has_desc') : null)) ?: '');

												// Sub-label
												echo wp_kses_post($R34ICS->event_sublabel_html($args, $event, null) ?: '');

												// Description/Location/Organizer
												echo wp_kses_post($R34ICS->event_description_html($args, $event, null, $has_desc) ?: '');
												?>
											</div>
										
										</li>

										<?php
										$i++;
										if (!empty($args['count']) && $i >= intval($args['count'])) {
											break(5);
										}

										// Pagination?
										if (!empty($pagination)) {
											$p_i++;
											if ($p_i >= $pagination) {
												echo '</ul></div>';
												$p_i = 0;
												$pagination_open = false;
											}
										}
									}
								}
							}
						}
					}
				}
				?>
			</ul>
		</article>

		<?php
		$calendar_output = ob_get_clean();
		
		// Pagination?
		if (!empty($pagination_html) && $p_c > 1) {
			switch ($args['paginationposition']) {
				case 'below': $calendar_output .= $pagination_html; break;
				case 'both': $calendar_output = $pagination_html . $calendar_output . $pagination_html; break;
				case 'above': default: $calendar_output = $pagination_html . $calendar_output; break;
			}
		}
		
		// Render calendar output
		echo wp_kses_post($calendar_output ?: '');
		
		// Color code key
		if (!empty($args['legendposition']) && $args['legendposition'] == 'below') {
			echo wp_kses(($R34ICS->color_key_html($args, $ics_data) ?: ''), r34ics_color_key_allowed());
		}
	
		// Actions after rendering calendar wrapper (can include additional template output)
		do_action('r34ics_display_calendar_after_wrapper', $view, $args, $ics_data);

	}
	?>

</section>
