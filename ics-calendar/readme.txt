=== ICS Calendar ===
Contributors: room34
Donate link: https://icscalendar.com
Tags: iCalendar, Google Calendar, Office 365, events, ICS feed
Requires at least: 4.9
Tested up to: 6.9
Requires PHP: 7.2
Stable tag: 12.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add the calendar you already use to Any WordPress site! Google Calendar, Microsoft 365, iCloud and more… no API keys or complicated setup required.

== Description ==

Add the calendar you already use to Any WordPress site! Google Calendar, Microsoft 365, iCloud, Airbnb and more… no API keys or complicated setup required.

Using a simple shortcode, you can turn any iCalendar subscription (ICS) feed (Google Calendar, Microsoft Office 365, Apple iCloud, Airbnb, Vrbo, and many more) into a seamlessly integrated, auto-updating, zero-maintenance WordPress calendar.

Continue to manage your events in the calendar software you're already using! You'll automatically have an up-to-date calendar in your WordPress website with no extra work.

Display your calendar in month, list or week view. Many additional customization options are available. See our [User Guide](https://icscalendar.com/user-guide/) for full details.

**No API keys required!**

**Works with ANY calendar software** that generates a public iCalendar subscription link.

= Live Preview =

You can preview your own calendar in any ICS Calendar view at our website: [icscalendar.com/preview](https://icscalendar.com/preview/)

= Shortcode Builder =

We've made it easier than ever to get started using ICS Calendar with our new online shortcode builder: [icscalendar.com/shortcode-builder](https://icscalendar.com/shortcode-builder/)

= Language Support =

All date strings (days of the week, months, etc.) are automatically translated into your site's configured language (under **Settings > General > Language**) and date/time formats using core WordPress functionality. All text content for the calendar itself is displayed as-is from the feed.

ICS Calendar includes built-in translation files for the following languages: Chinese, Czech, Danish, Dutch, Estonian, Finnish, French, German, Greek, Hungarian, Italian, Japanese, Korean, Latvian, Lithuanian, Polish, Portuguese, Romanian, Russian, Serbian, Slovak, Slovenian, Spanish, Swedish, Turkish, and Ukrainian.

Please contact us if you would like us to add support for your language!

_This plugin includes the PHP ICS Parser library by Jonathan Goode, John Grogg and Martin Thoma (MIT license)._

== Installation ==

Once the plugin is installed and activated, use the shortcode below (adding your own ICS feed URL between the quotation marks) to insert a calendar into your pages. Use our online [Shortcode Builder](https://icscalendar.com/shortcode-builder/) to easily create a customized shortcode, or consult the [User Guide](https://icscalendar.com/user-guide) for more information.

`[ics_calendar url=""]`

Be sure you are using the _iCalendar subscription (ICS)_ URL (i.e. for importing into a calendar program), not the URL for viewing a calendar in a web browser. To test if you have the correct URL, paste it directly into your browser address bar. It should download an `.ics` file, not display the calendar in the browser.

== Frequently Asked Questions ==

= How do I find my calendar's ICS feed URL? =

Different calendar systems have different ways to obtain the feed URL. You may need to consult your calendar software's documentation for assistance. Find instructions for commonly used calendars below.

You will also need to make sure that your calendar is public. Private calendars cannot be accessed by this plugin.

_Documentation quick links:_

* [Google Calendar](https://support.google.com/calendar/answer/37083#link)
* [Microsoft Office 365](https://support.office.com/en-us/article/share-your-calendar-in-outlook-on-the-web-7ecef8ae-139c-40d9-bae2-a23977ee58d5)
* [Apple iCloud](https://www.macobserver.com/tips/quick-tip/icloud-configure-public-calendar)

= How do I insert a calendar into my page? =

Use this shortcode, inserting your ICS feed URL between the quotation marks:

`[ics_calendar url=""]`

Be sure you are using the _iCalendar subscription (ICS)_ URL (i.e. for importing into a calendar program), not the URL for viewing a calendar in a web browser. To test if you have the correct URL, paste it directly into your browser address bar. It should download an `.ics` file, not display the calendar in the browser.

= Can I combine multiple calendars? =

Yes! You can combine multiple calendars by including more than one feed URL in the `url` parameter. __Separate the calendar URLs with one space or a pipe `|` character.__ Do not include any other delimiter characters, as they will be interpreted as part of the URL.

= Why isn't my calendar loading? =

This may be due to your server's configuration. This plugin requires either the PHP cURL extensions, or the `allow_url_fopen` PHP setting to be turned on. Check your PHP configuration or your server administrator if you think this may be the issue. You can also add `debug="true"` to your shortcode and view your page to see debugging output which may provide additional details about any connection issues.

= Why isn't my calendar updating? =

For performance, this plugin uses WordPress transients to store retrieved calendar data for one hour between requests to the calendar source server. If you have updated events that are not showing up in your page, visit the **ICS Calendar** page in your site admin and click the **Clear Cached Calendar Data** button.

Third-party caching plugins may interfere with ICS Calendar's feed syncing. If you are using a caching plugin and your calendar is not updating, try using the [AJAX](https://icscalendar.com/icsdocs/#ajax) option in your shortcode.

= Why are event times an hour off after Daylight Saving Time begins? =

PHP has two different ways of defining timezones: as a number of hours offset from GMT/UTC (e.g. "UTC-5"), or as a continent/city combination (e.g. "America/Chicago"). Timezones using UTC offsets do not handle Daylight Saving Time correctly (as noted in the [PHP documentation](https://www.php.net/manual/en/timezones.others.php)). Please check your WordPress timezone settings (__Settings > General > Timezone__). If it is set to a UTC offset, change it to the city closest to your location, in the same timezone. As of version 6.0 you can also set the timezone within the shortcode using the `tz` parameter. (Again, be sure to use a named region/city timezone, not a UTC offset.)

= Additional documentation and support =

Our [User Guide](https://icscalendar.com/user-guide/) includes extensive documentation of all features of the plugin, is frequently updated, and is translated into all languages supported by the plugin.

= Feature requests =

The paid [ICS Calendar Pro](https://icscalendar.com) add-on includes additional layout options, tools for customizing the calendar's appearance more easily than directly editing CSS, an improved insertion tool, and more. We are also constantly adding new features and refinements to _both_ the free and paid versions. If you have suggestions for features you'd like to see or any other additional input, please let us know by following the support link on the admin page or in the [WordPress support forums](https://wordpress.org/support/plugin/ics-calendar/)! The base plugin will always be free to use.

== Changelog ==

= 12.0.4 - 2026.02.02 =

* Print Button:
  * Added logic to print the currently selected month or week in the print view. Previously, printing would revert to the initial month or week selection.
  * Several CSS modifications, including adjusting text size for list-type views vs. table-type views, and flattening list/basic pagination (all "pages" shown in print output).
  * Restored general print CSS media queries; changes for the print button introduced in v. 11.6.0 work _only_ with the print button, not when printing the full page with the browser's default printing.
* Miscellaneous:
  * Changed `redirection` value in `R34ICS::_url_get_contents()` method from 0 to 5. May resolve some feed loading issues when the source returns an HTTP 302 redirect.
  * Refactored CSS.

= 12.0.3.1 - 2026.01.21 =

* Modified AJAX conditional in `R34ICS::shortcode()`, changed in 12.0.3, to handle undefined `$args['ajax']`. (Probably unnecessary since it's explicitly defined above, but best practice since there's a filter that can modify the contents of `$args`.)
* Tweaked logic in `r34ics_is_html()` to resolve false negatives.
* Updated new inline image logic in `r34ics_maybe_make_clickable()` to only run if there is no detected HTML in the string. In some instances the code was converting images that were already in an `img` tag. (The assumption here will be that if the string contains any HTML, the image will _already_ be in an `img` tag if that's the intention.

= 12.0.3 - 2026.01.19 =

* AJAX:
  * Made logic for determining whether or not to load the calendar via AJAX more explicit, to resolve an issue that was occurring in certain highly optimized setups involving caching and preloading (e.g. WP Rocket).
* Block Editor:
  * Modified `r34ics_is_block_editor()` to more effectively limit the conditional check for `REST_REQUEST` constant.
* Event downloads:
  * Fixed a bug that was causing incorrect event information to be downloaded under certain conditions, apparently affecting mainly Microsoft calendars. According to the [iCalendar spec](https://icalendar.org/New-Properties-for-iCalendar-RFC-7986/5-3-uid-property.html) the event UID property is supposed to be persistent, but in some cases (possibly pertaining to modified instances of recurring events) Microsoft calendars assign the same event a new UID each time the feed is reloaded. (There was also a bug in the plugin's logic that was causing the wrong event's data to get inserted into the download when this UID mismatch occurred, rather than just failing altogether.) This update resolves the mismatched data bug, as well as adding fallback logic to match events by title, start date/time and end date/time when no UID match is found in the feed.
* Performance:
  * Added `r34ics_display_calendar_force_reload` filter to allow bypassing the new rate limit related restrictions added in 12.0.0. **Please do not use this filter unless you understand the performance impact it may have.** By default, ICS Calendar intentionally throttles how frequently requests are made to the source calendar. This is done both to improve your site performance and to avoid hitting source calendar providers' rate limits, which can result in HTTP 429 errors and failure to load your calendar. (In some extreme cases, providers may rate limit entire networks.) If you have any questions about whether or not it is appropriate to use this filter with your site, please [contact support](https://icscalendar.com/support) before proceeding.
* Plugin conflicts:
  * Worked around conflict with Loco Translate plugin by creating symlinks to ICS Calendar's general language translation files with locale-specific names in the `WP_LANG_DIR` path when Loco Translate is active. (Normally, the general language files self-contained within ICS Calendar load directly, but Loco Translate overrides this functionality.)
* Miscellaneous:
  * Refactored instances of directly checking the `active_plugins` core option to use the `is_plugin_active()` function instead.

= 12.0.2 - 2026.01.16 =

* Event descriptions:
  * Modified `r34ics_maybe_make_clickable()` function to convert raw image file URLs in event descriptions directly into HTML `img` tags, instead of clickable links. May be a useful workaround for including images in event descriptions for sources like Google Calendar and Microsoft 365, which do not make files directly accessible. _Note: The URL **must** be a direct URL to a publicly accessible image file, with a standard image extension (supported extensions: `.apng`, `.avif`, `.gif`, `.jpg`, `.jpeg`, `.png`, `.svg`). Using a URL that links to Google Drive, OneDrive, iCloud, Dropbox, etc. will not work, because those are permission-restricted "wrapper" page URLs, not the direct URLs of the files themselves.
* Miscellaneous:
  * Added fallback values for possibly undefined keys in `R34ICS::display_calendar_date_range()` method. (There is no evidence that this was actually an issue but it's best practice and may help with resolving a date range issue affecting certain users.)
  * Added SVG tag support to `r34ics_color_key_allowed()` function to allow SVG images to be included in the legend (color key). Mainly used by ICS Calendar Pro for the Subscribe button.
  * Changed legend to use `--r34ics--element--events--color` text color (the same as events).
  * Other minor CSS tweaks.
  * Added `phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment` to a translation string in admin page to pass Plugin Check test.

= 12.0.1 - 2026.01.06 =

* Admin: Updated Pro version promo block.
* i18n: Updated translation strings.

= 12.0.0.1 - 2026.01.05 =

* Added conditional to avoid a potential fatal error in the `r34ics_scrub_duplicate_uids()` function. (This function runs only when the `fixredundantuids` parameter is set.)
* Added `$force_reload` parameter to `R34ICS::display_calendar()` method.
* Removed CSS that causes event time and title not to appear in description hover box on mobile.

= 12.0.0 - 2025.12.29 =

* Admin:
  * Added **Allow access to these ports** setting to allow defining custom HTTP ports for feed requests. Useful if your source calendar server uses a custom port number and you are having trouble retrieving the feeds.
  * Added **Pause Calendars** button (under Utilities) to temporarily shut off all ICS Calendar output on front-end pages.
  * Added **Register Customizer** setting to enable the Customizer on Block Themes, for users who may want to add their own custom CSS without editing their theme files. (Note: The WordPress core team is phasing out support for the Customizer so this may eventually stop working.)
  * Added `r34ics_admin_full_access()` function for Multisite-aware restriction of access to Administrator-only features, and `r34ics_admin_access()` function for configurable level of access to all admin features.
  * Changed default access level from Author to Editor; added **Minimum access role** setting to make this configurable.
  * Fixed issue with settings page loading scrolled partially after saving changes.
  * Fixed possible false negatives on valid feed URL status with ICS Feed URL Tester utility.
  * Refactored admin page template files.
  * Removed *Also reset all ICS Calendar settings* checkbox on *Clear Cached Calendar Data* utility for non-Administrators.
  * Removed *System Report* tab for non-Administrators, since only Administrators can access the System Report.
  * Various design and layout refinements on Settings and Help screens.
* AJAX:
  * Removed **Always use AJAX to render calendars** option; AJAX is now automatic _unless_ `ajax="false"` is explicitly added to the shortcode.
* Color:
  * Deprecated `whitetext` shortcode parameter. Use **Dark Mode** setting on ICS Calendar Settings page instead, or `darkmode="true"` on individual shortcodes.
  * Fixed some inconsistencies with text colors.
  * Lightened background tints of color-coded feed events for better text contrast.
* CSS:
  * Extensively restructured CSS for greater efficiency (especially making use of the `:is()` pseudo-element).
  * Moved most color specifications to CSS variables for easier customization.
  * Updated handling of `word-break` and `hyphens` to eliminate vendor prefixes and undesirable `break-all` setting.
* Developer:
  * Added `r34ics_url_get_contents_request_args` filter.
  * Added support for overriding default calendar templates by creating an `ics-calendar` folder within your theme or child theme, and placing appropriately named replacement files (e.g. `calendar-month.php`) in that folder. Developers who wish to override templates are encouraged to copy the existing template to use as a starting point.
* Event Downloads (`eventdl`):
  * Modified handling of recurring events in the event download link, so the download now contains only the single selected instance of the event, rather than the full recurrence set.
* Month/Week Views:
  * `combinemultiday` now defaults to `true`.
* Performance:
  * Added `r34ics_rate_limit_check()` function to identify situations where calendars may be hitting rate limits, and display an admin notice with recommended steps to remedy the situation.
  * Added conditional before `r34ics_url_uniqid_update()` calls in `R34ICS::_url_get_contents()` and `R34ICS::_url_get_contents_legacy()`, to run it only if we've verified the URL returns iCalendar formatted data. Also added `r34ics_url_uniqid_delete()` to delete individual feed URLs from the list.
  * Due to observed issues with some sites using `reload` in ways that exceed request rate limits, causing providers like Google Calendar to put temporary blocks on IP ranges, the `reload` option is now forced to a minimum value of 120 (2 minutes), _unless_ `debug` is also set to `2` or higher. **The `reload` option is intended for troubleshooting only.** If your calendar updates more frequently than once per hour, the best option is to change the **Transient (cache) expiration** setting to a lower value. Recommended value: 300 (5 minutes).
* Plugin Conflicts:
  * Elementor: Added jQuery code to re-run ICS Calendar's initialization script when switching Elementor tabs. Resolves an issue where some calendars may not render properly in tabs.
* Utilities:
  * Added "Also clear all saved ICS feed URLs" option to **ICS Calendar Data Cache** utility. This allows for purging the list of previously retrieved feed URLs in addition to cached transient data. (Previously the only way to purge the list of feed URLs was to use the "Reset all ICS Calendar settings" option.)
  * Updated status message output and fixed false negative bug with **ICS Feed URL Tester** utility.
* Miscellaneous:
	* Added `r34ics_reset_non_empty_defaults()` function and associated filter for managing setting/resetting initial non-empty option values.
	* Added dynamic cookie handling when interacting with source servers that send cookies. May resolve an issue for Google Calendar users in Europe.
	* Changed most saved options to autoload = false.
	* Removed `r34ics_curl_cookie_path()` function and deprecated code that used it.
  * Refactored several functions and addressed various minor bugs.
  * Removed disused asset files.
  * Removed `r34ics_curl_cookie_path()` function and deprecated code that used it.
  * Renamed JS and CSS asset files to include `-pro` in the filenames. (To prevent confusion during development.)
  * Updated and reformatted System Report output.
  * Updated System Report formatting and added new settings fields.
  * Updated user agent string logic (v. 11.5.15.1) to include Google Calendar, and updated the base UA string.
  * Various other minor code refactoring throughout the plugin to address inefficiencies, improve organization, and resolve some PHP notices and warnings.
* a11y:
  * Added tab support for help hover boxes on admin pages.
* i18n:
  * Added new translations: Romanian, Serbian, Slovak, Turkish and Ukrainian.
  * Revised _all_ translation strings for all languages. Please note: By necessity we are using machine translations. (Most strings are translated by DeepL; a few that produced errors with DeepL are cross-referenced with Google Translate.) If you find any translation errors, please let us know at the link below.
  * Streamlined language files to one default file per language, rather than separate files for each locale. Note: This will make translations available to many more locations, rather than defaulting to U.S. English if a file for a specific language _and_ locale were not previously present. However, the new translations may be slightly less accurate for specific locales that previously had a dedicated file.
* Vendors:
  * Incorporated recent ics-parser changes into our customized version.

**If you identify any translation issues, please use our [Translation Suggestions](https://icscalendar.com/translation-suggestions/) form to contact us.**

= 11.7.0.4 - 2025.12.08 =

* Performance:
  * Due to observed issues with some sites using `reload` in ways that exceed request rate limits, causing providers like Google Calendar to put temporary blocks on IP ranges, the `reload` option is now forced to a minimum value of 120 (2 minutes), _unless_ `debug` is also set to `2` or higher. **The `reload` option is intended for troubleshooting only.** If your calendar updates more frequently than once per hour, the best option is to change the **Transient (cache) expiration** setting to a lower value. Recommended value: 300 (5 minutes).

= 11.7.0.3 - 2025.11.30 =

* Added dynamic cookie handling when interacting with source servers that send cookies. May resolve an issue for Google Calendar users in Europe. If you are experiencing this issue, please note that it may take up to 24 hours after you apply this update for your calendars to reappear. [Your feedback is requested.](https://icscalendar.com/support) Also please note that these changes _only_ apply if you have the legacy feed request method turned _off._ That feature is deprecated and will not be receiving further feature updates. If you are currently using the legacy feed request method, you are encouraged to try turning it off and see if your site is now able to load feeds with the standard method.
* Added `r34ics_get_all_options()` function to retrieve all ICS Calendar options for the admin utility **Clear Cached Calendar Data** with the **Also reset all ICS Calendar settings** option checked. There is currently no way (even with filters) to force the WP core function `wp_load_alloptions()` to retrieve non-autoload options. (See [this note](https://developer.wordpress.org/reference/functions/wp_autoload_values_to_autoload/#comment-7430) for details. It's unclear whether this is a performance-focused intentional decision or a bug in the core `wp_autoload_values_to_autoload()` function.)
* Removed `r34ics_curl_cookie_path()` function and deprecated code that used it.

= 11.7.0.2 - 2025.11.28 =

* Appended real user agent string when retrieving feeds from Google Calendar.

= 11.7.0.1 - 2025.10.29 =

* Delayed application of `r34ics_shortcode_defaults_new_10_6` filter until other plugins are loaded.

= 11.7.0 - 2025.10.27 =

* schema.org structured data: _BETA_
  * Added `jsonld` shortcode parameter (and related `r34ics_event2jsonld()` function) for adding [JSON-LD structured data](https://schema.org/Event) to calendar output. This is still a beta/experimental feature. We have confirmed that our generated test code passes [validation](https://validator.schema.org), but we need to observe some real-world testing to determine whether or not the output needs additional refinements to match Google's expectations for structured event data. This feature is _off_ by default. To use it, add `jsondl="true"` to your shortcode. And please send your [feedback](https://icscalendar.com/support/) on how it works for you! **IMPORTANT: Because Google requires each event in the structured data to have a designated URL, _only_ events that have a URL are included in the structured data ICS Calendar generates.** (See [Google's documentation](https://developers.google.com/search/docs/appearance/structured-data/event) for more information.)
* Miscellaneous:
  * Bumped 'tested up to' to 6.9.

= 11.6.0 - 2025.10.10 =

* Print: _BETA_
  * Added `print` shortcode parameter, which will add a print button at the top of your calendar. Use `print="true"` to print the calendar with basic event info (time and event title), or `print="descriptions"` to include all event descriptions. (This works independently of how the event descriptions appear on-screen.) **Important: You MUST be using AJAX to render your calendar to use the `print` parameter.** You can accomplish this either by adding `ajax="true"` to your shortcode, or by turning on the **Always use AJAX to render calendars** setting.
  * Improved print CSS, now retains calendar colors. _Note: It is impossible for us to test all potential site configurations; if you experience problems with the new print colors, please [submit a support request](https://icscalendar.com/support)._
* Dark Mode: _BETA_
  * Resolved conflicts that mostly broke dark mode after adding new element-based CSS variables in v. 11.5.15.
* i18n:
  * Updated translation strings.
  * Added missing en_GB translation files. (Introduced in v. 11.5.17.4 but inadvertently omitted from repository.)

_The print and dark mode features are currently considered BETA and are subject to change._
  
= Full Changelog =

_Changelog truncated here due to WordPress repository requirements._ Please see `changelog.txt` for older logs.