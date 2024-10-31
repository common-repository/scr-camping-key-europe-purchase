=== SCR Camping Key Europe Purchase ===
Contributors: Erik Bernskiold, bernskioldmedia
Tags: scr, camping key europe, camping key, swedish camping
Requires at least: 4.0
Tested up to: 4.9
Stable tag: trunk
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A WordPress plugin to help campsite owners integrate the Camping Key Europe purchase functionality by SCR.

== Description ==
This plugin gives you a shortcode that can be used anywhere, on pages and in sidebar widgets, to display either a text link or banner to the purchasing iframe.

The shortcode be configured with a few parameters, which will control how it show. The langauge parameter is optional, while the text or banner parameter is mandatory.

Before the shortcodes will work, you *need* to enter your organization ID in the settings (Settings > CKE Purchase). Your organization ID will be provided to you by SCR.

= Text Link =
To create a text link, just add the shortcode where you want the link. The text parameter lets you change what the link will say.

	[cke_buy_link lang="" text="Buy Camping Key Europe"]

= Image Banner =
To create an image banner, you need to use the following shortcode. You may select one of the three banners (1,2 or 3) to enter as an option.

	[cke_buy_link lang="" banner="1"]

= Select Language (optional) =
By default, the link will try and load the content in the same language that your website is in. If you want to override this, you may set a custom language. We support: Swedish (code: se), German (code: de) and English (code: en)

	[cke_buy_link lang="sv" text="Köp Camping Key Europe"]

= Authors =
This plugin has been developed customly for Swedish Camping (SCR) by Bernskiold Media. Please contact SCR with any questions.

= Support =
All questions should be directed to Swedish Camping (SCR) at: support@camping.se

== Installation ==
To get started with the plugin, activate it and enter your organization ID in the settings (Settings > CKE Purchase). Then you can add your shortcodes and get started selling.

== Frequently Asked Questions ==
= Why doesn\'t the shortcodes work? =
You need to enter your organization ID that you get from SCR in the settings (Settings > CKE Purchase) in order for the shortcodes to work. Otherwise they will just display as text.

= How do I get my organization ID? =
Your organization ID is a text string which your contact person on SCR will provide you when setting you up for the program. It is usually a variant on your campsite name.

== Changelog ==

= Version 1.0 =
Initial version.