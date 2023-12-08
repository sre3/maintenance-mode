=== IP Maintenance Mode ===
Contributors: petermann
Donate link: https://ivanpetermann.com/donation
Tags: maintenance, mode, petermann
Requires at least: 4.0
Tested up to: 6.4
Stable tag: 1.2.10
Requires PHP: 5.6
License: GPL-3.0-or-later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

Display a maintenance mode page, except when logged in as an administrator or using the /?view=1 parameter in the URL.

== Installation ==

Install the plugin by:

1. Upload `ip-maintenance-mode` directory to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to `Settings -> IP Maintenance Mode` page and setup you phone number and message.

== Changelog ==

= 1.2.10 =
* New: Added conditions to check if the request is made via wp-cli.
* New: Implemented checks to handle POST requests to the wp-json endpoint.
* Change: Corrected typographical errors and made minor improvements to the documentation.
* Change: Adjusted the structure of the LICENSE file to provide a link to the full text of the GPL.
* Tested up to: 6.4

= 1.1.9 =
* Hide return errors.
* Tested in version 6.2

= 1.1.8 =
* Changed the URL view parameter.
* Changed from cookies to session.
* Changed phrases and style.
* Changed plugin description.
* Tested in version 6.0

= 1.0.7 =
* Added rule for WP-CLI
* Tested in version 5

= 1.0.6 =
* Initial release.