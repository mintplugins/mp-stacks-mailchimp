=== MP Stacks + MailChimp ===
Contributors: johnstonphilip
Donate link: http://mintplugins.com/
Tags: message bar, header
Requires at least: 3.5
Tested up to: 4.1
Stable tag: 1.0.0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add-On Plugin for MP Stacks which shows an email sign-up form for Mail Chimp. It uses ajax and provides proper messages to the user if error or successful sign-up. Includes colour pickers for the sign-up button’s styling.

== Description ==

Make a brick using “MP Stacks”, put the stack on a page, and set the brick’s Content-Type to be “MailChimp”. Then, fill in your API and List keys from Mailchimp and publish.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the 'mp-stacks-mailchimp’ folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
5. Put Stacks on pages using the “Add Stack” button.

== Frequently Asked Questions ==

See full instructions at http://mintplugins.com/doc/mp-stacks

== Screenshots ==


== Changelog ==

= 1.0.0.6 = February 11, 2015
* Update to MailChimp API Version 2.0 using JSON POST to lists/subscribe (was using 1.3).

= 1.0.0.5 = January 21, 2015
* Set “plugin_licensed” to true for theme bundle utilities.
* Added email input field background color control

= 1.0.0.4 = December 23, 2014
* Fixed Ajax responses which broke upon 1.0.0.3

= 1.0.0.3 = December 23, 2014
* General Improvements and simplification of settings.

= 1.0.0.2 = June 8, 2014
* CSS Prettify and bug fixes if no api

= 1.0.0.1 = May 27, 2014
* Changed input type submit to div and activate using JS - this is so that styles work because firefox doesn’t render submit buttons the same
* Before outputting CSS, make sure something has been entered.

= 1.0.0.0 = May 25, 2014
* Original release
