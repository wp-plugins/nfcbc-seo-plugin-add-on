=== NFCBC SEO Plugin Add-on ===
Tags: comments, links, author, spam, follow, nofollow, dofollow, plugin
Contributors: alexkingorg, fob
Requires at least: 2.2
Tested up to: 2.8.4
Stable tag: 1.1

== Description ==

**NFCBC SEO Plugin Add-on** is an administration tool for follow and nofollow comment moderation. 

[NFCBC SEO Plugin Add-on](http://www.fob-marketing.de/marketing-seo-blog/nfcbc-seo-plugin-add-on.html "NFCBC SEO Plugin Add-on") requires a Follow-/Nofollow-Plugin like 
[NFCBC SEO Light](http://www.fob-marketing.de/marketing-seo-blog/nfcbc-seo-light-the-light-version-of-nofollow-case-by-case.html "NFCBC SEO Light") or 
[Nofollow Case by Case](http://www.fob-marketing.de/marketing-seo-blog/wordpress-nofollow-seo-plugin-nofollow-case-by-case.html "Nofollow Case by Case").
It gives you the ability to modify the link a commenter left as their URL without removing the entire comment.

== Installation ==

1. Download the plugin archive and expand it (you've likely already done this).
2. Put the 'nfcbc-seo-plugin-add-on.php' file into your wp-content/plugins/ directory.
3. Go to the Plugins page in your WordPress Administration area and click 'Activate' for NFCBC SEO Plugin Add-on.


== Usage ==

Click on the link in your comment e-mail notification or in the comment list to make follow links nofollow for their comment.


== Known Issues ==

Adding the link to the comment list requires jQuery, which is included in WordPress 2.2 and later. 
An e-mail link for direct moderation might not work for everybody, too. 


== Frequently Asked Questions ==

= Why does my Recent Comments Plugin add /dontfollow to external links? = 

This happens only if you allow those links. Nofollow Case by Case has an output filter that can not modify author links generated from other plugins if they grab those links directly from the database. 

= Why doesn't the link appear in my comment list? =

See the Known Issues above.

= Do you plan to release a version compatible with versions of WordPress prior to 2.2? =

No. Sorry. For security reasons it is always a good idea to keep your version of WordPress up to date.

= Anything else? =

Nothing. Enjoy!

This comment management plugin is based on the idea of Alex King. 
Find his [original delink plugin](http://alexking.org/projects/wordpress "Delink Plugin") here. You might want to use this, too. 

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 


== Screenshots == 

1. Do you want nofollow for this link?

2. Done!

== Changelog == 

= NFCBC SEO PLUGIN ADD-ON 1.0 =
Initial NFCBC version 

= NFCBC SEO PLUGIN ADD-ON 1.1 =
Nofollow can be removed now without having to edit the link directly (added FCBC option) and /dontfollow can not be added multiple times anymore. 



**NFCBC** = Nofollow Case by Case, 
**FCBC** = Follow Case by Case
