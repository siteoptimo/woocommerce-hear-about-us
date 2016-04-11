=== WooCommerce Hear About Us ===
Contributors: siteoptimo, vdwijngaert
Donate link: https://www.siteoptimo.com/
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Tags: woocommerce, user, source, customer, acquisition, hear, about
Requires at least: WordPress 3.8 and WooCommerce 2.1
Tested up to: 4.5
Stable tag: 1.5.1

Ask where your new customers come from at checkout.

== Description ==
This small plugin makes it possible to ask your customers where they came from at checkout. You can have a look in your Google Analytics, but it's easier (and more correct) to ask your customers where they came from by asking one question: "Where did you hear about us?".

Current features:

* Define your own question
* Set source locations
* Saves the location at the customer profile or/and at the order
* Mentions the source location on the order emails
* Option for a custom "other" field
* WPML compatible


= WPML compatible =
This plugin is WPML compatible. Multilingual shops can now ask where they came from in the language of the customer.

= About the authors & support =
This plugin is written by the brave and handsome coders of [SiteOptimo](http://www.siteoptimo.com/?utm_source=hear-about-plugin&utm_medium=wordpress&utm_campaign=wch).
We made it freely available for the WordPress and WooCommerce community. We might build more custom work in the future.

Issues can be reported in our [GitHub Repository](https://github.com/siteoptimo/woocommerce-hear-about-us/issues) or in the WordPress support forums.


== Installation ==
1. Upload the `woocommerce-hear-about-us` folder to the `/wp-content/plugins/` directory.
1. Activate the Woocommerce Hear About Us plugin through the 'Plugins' menu in WordPress.
1. Add some referral locations in the WooCommerce Account Settings
1. Done!

== Frequently Asked Questions ==
There are no frequently asked questions. Head over to the support forums, we'll be glad to give you a quick answer.

== Screenshots ==
1. Define your settings in the WooCommerce Account Settings.

2. Et voila! An extra field at checkout with your options.

3. Setting is saved with the customer data.

== Changelog ==
= 1.5.1 (2016-03-04) =
* Classes instantiated by WooCommerce_HearAboutUs are now publicly available.

= 1.5.0 (2015-12-03) =
* Other field now has an "other" label and appears the same as other WooCommerce fields.

= 1.4.3 (2015-10-15) =
* Prevents asking the "Where did you hear about us?" question more than one time for the same user.

= 1.4.2 (2015-10-02) =
* Added custom sortable column to order listing.
* Added custom sortable column to user listing. Thanks for your input, [goto10](https://profiles.wordpress.org/goto10/).

= 1.4.1 (2015-09-10) =
* Fixed a bug where "other" field was not displayed on the user profile.

= 1.4 (2015-09-09) =
* Plugin now works with WordPress multisite, thanks to [ionainteractive](https://wordpress.org/support/profile/ionainteractive).
* Updated translations
* Added Hebrew translation, thanks to thanks to [krko](https://wordpress.org/support/profile/krko).

= 1.3 (2015-07-27) =
* Added an option for displaying an "other" field.

= 1.2 (2015-04-02) =
* Added the source location to the order emails.

= 1.1.1 (2015-03-19) =
* Now displays the pretty value on the order summary instead of the slug version.

= 1.1.0 (2015-01-15) =
* Added requested feature to save the source on the order page. Added a choice in the admin (profiles and orders, orders, profiles).

= 1.0.1 (2014-10-07) =
* Added proper i18n handling for non-wpml users.

= 1.0 (2014-09-29) =
* First version of the plugin.
