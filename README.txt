=== WP-Obfuscator ===
Contributors: Adrien Thierry
Tags: Security, obfuscation, wp-config.php
Requires at least: 3.5
Tested up to: 4.4.2
Stable tag: 0.6
License: GPLv2 or later 
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP-Obfuscator is a plugin that let you obfuscate the code of wp-config.php, that is in readable clear text.

== Description ==
WP-Obfuscator is a plugin that let you obfuscate the code of wp-config.php, that is in readable clear text. That means that a hacker could easily read it if he hacks your website.

After obfuscate your wp-config.php, a hacker couldn\'t directly read it, and must to do a long work of reverse engineering against your obfuscated wp-config.php file.

== Installation ==
You can download and install WP-Obfuscator using the built in WordPress plugin installer. If you download WP-Obfuscator manually, make sure it is uploaded to \"/wp-content/plugins/wpobfuscator/\".

Activate WP-Obfuscator in the \"Plugins\" admin panel using the \"Activate\" link.

Be sure to make a copy of your wp-config.php file if it\'s not like the default wp-config-sample.php file.

Launch the obfuscation process when your site is ready or for testing purpose. Some plugins need to read wp-config.php file in plain text when you install them. 

== Changelog ==
version 0.6 :
I have created a better obfuscation lib

version 0.5 :
Add internationalization (fr_FR and en_EN languages)
Rewrite plugin in OOP

version 0.4 :
Add an obfuscation depth parameter. Tested on Wordpress v4.0.1

version 0.3 :
Change Seraum_Obf lib with a free non-obfuscated lib

version 0.2 :
change license of Seraum_Obf