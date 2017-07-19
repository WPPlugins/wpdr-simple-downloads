=== WP Document Revisions Simple Downloads ===
Contributors: daveshine, deckerweb
Donate link: http://genesisthemes.de/en/donate/
Tags: downloads, download manager, file manager, files, documents, revisions, widgets, add-on, wp document revisions, easy downloads, simple downloads, deckerweb
Requires at least: 3.4+
Tested up to: 3.5
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.opensource.org/licenses/gpl-license.php

Use the WP Document Revisions plugin as very basic & simple download manager with this additional add-on plugin.

== Description ==

= ADD-ON PLUGIN for "WP Document Revisions" (WPDR)! =
Want to offer public file downloads? Just use "WP Document Revisions" plus this little add-on plugin! This **small and lightweight** add-on plugin just adds a few specific additions to the **awesome WPDR base plugin which does all the heavy lifting for you!**

For my own projects I needed a new but robust and future-proof plugin with a custom post type solution to replace an old, unsupported download counter plugin. With its many benefits I wanted WPDR as a base foundation for that. Now, that I've finally found my solution, I hope it may help you as well :-).

= What this Add-On does - General Features =
* All the benefits of "WP Document Revisions" plugin! (see below)
* Simple, basic download counter included!
* Use "Downloads" wording instead of "Documents" (changeable via options); plus Downloads icon.
* 2 additional taxonomies for download files: "File Categories" and "File Tags".
* *3 additional Widgets:*
 * Display most popular/ accessed Downloads with "Popular Downloads".
 * Simple taxonomy listings with "Download File Categories / Tags".
 * To Downloads restricted search with "Search Downloads".
* Own plugin settings page.
* Help tabs included.
* Fully internationalized!
* Fully Multisite compatible!

= Special Features of this Add-On =
* Ability to load fully custom translations for WPDR!
* Load "Downloads" specific translations/ wording - formal/ informal variants supported!
* Full German translations included, formal and informal versions - you can choose via options (default is 'formal').

= Benefits of using "WP Document Revisions" as the base plugin =
* *In general: fantastic plugin, awesome developer! :)*
* Really simple, yet very effective! Does just one thing, but does it right!
* Really secure & robust!
* Revision management by default.
* Workflow Status management by default.
* Uses known WordPress interface - just concentrate on file management :).
* Extendable via Hooks & Filters - very developer friendly.
* Support for "Edit Flow" plugin already included.
* Well developed and coded with Coding Standards and WordPress best practices.

= Requirements =
* WordPress 3.4+ -- latest version 3.5+ always recommended!
* Already installed plugin ["WP Document Revisions"](http://wordpress.org/extend/plugins/wp-document-revisions/)

= Recommended Settings & Usage Instructions =
* See ["Installation" section here](http://wordpress.org/extend/plugins/wpdr-simple-downloads/installation/)
* Plus, see ["FAQ" section here](http://wordpress.org/extend/plugins/wpdr-simple-downloads/faq/)

= Third-party compatibility included =
* *Genesis Framework:* For Child Themes - Display post meta on the frontend for the post type.

= Localization =
* English (default) - always included
* German (de_DE) - always included
* .pot file (`wpdr-simple-downloads.pot`) for translators is also always included :)
* Easy plugin translation platform with GlotPress tool: [Translate "WP Document Revisions Simple Downloads"...](http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/wpdr-simple-downloads)
* *Your translation? - [Just send it in](http://genesisthemes.de/en/contact/)*

[A plugin from deckerweb.de and GenesisThemes](http://genesisthemes.de/en/)

= Feedback =
* I am open for your suggestions and feedback - Thank you for using or trying out one of my plugins!
* Drop me a line [@deckerweb](http://twitter.com/deckerweb) on Twitter
* Follow me on [my Facebook page](http://www.facebook.com/deckerweb.service)
* Or follow me on [+David Decker](http://deckerweb.de/gplus) on Google Plus ;-)

= More =
* [Also see my other plugins](http://genesisthemes.de/en/wp-plugins/) or see [my WordPress.org profile page](http://profiles.wordpress.org/daveshine/)
* Tip: [*GenesisFinder* - Find then create. Your Genesis Framework Search Engine.](http://genesisfinder.com/)

== Installation ==

1. Upload the entire `wpdr-simple-downloads` folder to the `/wp-content/plugins/` directory -- or just upload the ZIP package via 'Plugins > Add New > Upload' in your WP Admin
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Documents"/ "Downloads" > Download Settings to set a few options - or just be happy with the default settings :)
4. Go and manage your downloas files :)

*Please note, this plugin requires WordPress 3.5 or higher in order to work!*

= Recommended Settings: =
*Go the add-on plugin's settings page (located under "Documents"/ "Downloads" > Download Settings):*

* Set downloads slug -- via WPDR
* Set upload directory for download files/ documents -- via WPDR
* Use "Downloads" wording instead of "Documents"
* Use additional taxonomies and widgets
* Set the preffered translations variant to load

= Basic Usage: =
* To insert a download file link into a Post, Page or Custom Post Type, use the regular "Insert Link" feature, search for your Download/ Document file (searches for title!) and insert the actual link. Really simple, yeah!
* To display Download files on the frontend you can also use the included widgets or the shortcodes of WPDR (see [the WPDR Wiki](https://github.com/benbalter/WP-Document-Revisions/wiki/Frequently-Asked-Questions) for the shortcode documentation - scroll down a bit there...).
* To update an existing file/ document just open the existing item and upload a new version (revision). The file/ document peramlink will always point to the latest revision! Yeah, it's so easy :)
* You can also use third-party plugins or widgets that support custom post types to query, display or do anything you want with the "Document" post type, that we use for the download files. Pretty simple again, yet very effective and standards compliant.
* *List of reccommended third-party plugins:*
 * [Count Shortcode](http://wordpress.org/extend/plugins/count-shortcode/) - simple count posts or post types
 * [Faceted Search Widget](http://wordpress.org/extend/plugins/faceted-search-widget/) - sidebar widget to allow filtering indexes by builtin and custom taxonomies
 * [Display Posts Shortcode](http://wordpress.org/extend/plugins/display-posts-shortcode/) - display a listing of posts or post types using the `[display-posts]` shortcode 
 * [Edit Flow](http://wordpress.org/extend/plugins/edit-flow/) - for even more workflow & team/staff management
 * [Members](http://wordpress.org/extend/plugins/members/) - for user roles & capability management

= Other Stuff: =

**Multisite install:** Of course, it's fully compatible but have a look in the [FAQ section here](http://wordpress.org/extend/plugins/wpdr-simple-downloads/faq/) for more info :)

**Own translation/wording:** For custom and update-secure language files please upload them to `/wp-content/languages/wpdr-simple-downloads/` (just create this folder) - This enables you to use fully custom translations that won't be overridden on plugin updates. Also, complete custom English wording is possible with that, just use a language file like `wpdr-simple-downloads-en_US.mo/.po` to achieve that (for creating one see the tools on "Other Notes").

= Deinstallation =
If you ever want to uninstall the add-on (i.e. "WP Document Revisions Simple Downloads") you can use your stuff like before. All will work like normal as **this plugin does NOT make any permanent modifications!** Good to know, right?! :)

== Frequently Asked Questions ==

= Does this plugin work with latest WP version and also older versions? =
Yes, this plugin works really fine with the LATEST WordPress branch 3.5+! :-)
It was also tested with WordPress version 3.4.2 and worked like a charm! It may work with versions before but this was NOT tested. I always recommend to run the latest version of WordPress anyways :).

= Why on earth do I need this plugin along with WPDR? =
Good question, hehe :). -- "WP Document Revision" (WPDR) already does all the heavy lifting for you, and in reality is your actual *download manager*! This add-on plugin here (a.k.a. "WP Document Revisions Simple Downloads") does minor adjustments and additions for more comfort, even easier (admin) usage and provides specific "Downloads" specific wording/ translations. The add-on fully leverages the existing hooks & filters of its base plugin as well as from WordPress itself. So, in reality it does not make any (permanent) modifications. With this approach we avoid performance issues and load things only where and when needed. -- Also, the add-on adds 3 nice little widgets which may help to improve your site/ download manager on the front end.

= Alternatives for inserting downloads/ documents? =
To insert download files (URLs) into posts, pages, other post types, sidebars or templates just use any of the following alternatives:

1) The easiest one: WordPress' built-in "Insert Link" feature which is there in both editors, "Visual" and "Text". -- [see screenshot 1](https://www.dropbox.com/s/duwf83239bl813c/screenshot-5.png), plus [screenshot 2](https://www.dropbox.com/s/34skmbvvdzmz0ra/screenshot-6.png)...

2) 2 base shortcodes of WPDR: `[documents]` and `[document_revisions]` -- [see Wiki for more info (scroll down a bit...)](https://github.com/benbalter/WP-Document-Revisions/wiki/Frequently-Asked-Questions)

3) 4 available widgets: 1 from WPDR, plus 3 from this add-on plugin.

4) Any third-party plugin or widget that does support custom post types by WordPress. I highly recommend one of these: [Display Posts Shortcode](http://wordpress.org/extend/plugins/display-posts-shortcode/) - display a listing of posts or post types using the `[display-posts]` shortcode // [Count Shortcode](http://wordpress.org/extend/plugins/count-shortcode/) - simple count posts or post types

5) For developers: shortcodes can also be used with their template tag equivalent: `<?php do_shortcode( '[your_shortcode ...]' ); ?>`

= What's going on, "Downloads" or "Documents"? =
You decide, which wording or which translations will be loaded! In my opinion it's better to use purpose-specific and consistent wording throughout both plugins which will avoid confusions in day to day usage with your team.

The add-on DOESN'T modifiy the actual post type that's used as the base. This post type is by WPDR and has the ID "document", therefore some admin urls and such still reflect this ID. But in the end *this* just doesn't matter :).

= Is this plugin Multisite compatible? =
Of course it is! :) Works really fine in Multisite invironment.

= In Multisite, can I "network activate" this plugin? =
Yes, you can! Activating on a per-site basis is also possible. -- I recommend activating on a per-site basis in combination with "WP Document Revisions" plugin.

= Where are the Hooks & Filters documented? =
Currently as [Gist on GitHub](https://gist.github.com/4395899). They will also be published on my own Knowledge Base Site coming soon.


**Final note:** I DON'T recommend to add customization code snippets to your main theme's/child theme's `functions.php` file! **Please use a functionality plugin or an MU-plugin instead!** This way you can also use this better for Multisite environments. In general you are then more independent from theme/child theme changes etc. If you don't know how to create such a plugin yourself just use one of my recommended 'Code Snippets' plugins. Read & bookmark these Sites:

* [**"What is a functionality plugin and how to create one?"**](http://wpcandy.com/teaches/how-to-create-a-functionality-plugin) - *blog post by WPCandy*
* [**"Creating a custom functions plugin for end users"**](http://justintadlock.com/archives/2011/02/02/creating-a-custom-functions-plugin-for-end-users) - *blog post by Justin Tadlock*
* DON'T hack your `functions.php` file: [Resource One](http://thomasgriffinmedia.com/custom-snippets-plugin/) - [Resource Two](http://thomasgriffinmedia.com/blog/2012/09/calling-on-the-wordpress-community/) *(both by Thomas Griffin Media)*
* [**"Code Snippets"** plugin by Shea Bunge](http://wordpress.org/extend/plugins/code-snippets/) - also network wide!
* [**"Code With WP Code Snippets"** plugin by Thomas Griffin](https://github.com/thomasgriffin/CWWP-Custom-Snippets) - Note: Plugin currently in development at GitHub.
* [**"Toolbox Modules"** plugin by Sergej Müller](http://wordpress.org/extend/plugins/toolbox/) - see also his [plugin instructions](http://playground.ebiene.de/toolbox-wordpress-plugin/).

All the custom & branding stuff code above can also be found as a Gist on Github: https://gist.github.com/4395899 (you can also add your questions/ feedback there :)

== Screenshots ==

01. WPDR Simple Downloads: Add-On plugin's settings page. ([Click here for larger version of screenshot](https://www.dropbox.com/s/7f8suebiz5z2r7j/screenshot-1.png))
02. WPDR Simple Downloads: Settings page - "Usage" tab. ([Click here for larger version of screenshot](https://www.dropbox.com/s/ozmp4yhnn3n4jsq/screenshot-2.png))
03. WPDR Simple Downloads: Admin "Downloads" table with additional stuff added by add-on. ([Click here for larger version of screenshot](https://www.dropbox.com/s/kmiwjymdx2xfo6i/screenshot-03.png))
04. WPDR Simple Downloads: Edit "Download" view with additional stuff added by add-on. ([Click here for larger version of screenshot](https://www.dropbox.com/s/gcnl9lpy5xor19l/screenshot-4.png))
05. WPDR Simple Downloads: Insert Download link via Visual Editor. ([Click here for larger version of screenshot](https://www.dropbox.com/s/duwf83239bl813c/screenshot-5.png))
06. WPDR Simple Downloads: Insert Download link via Text Editor (HTML). ([Click here for larger version of screenshot](https://www.dropbox.com/s/34skmbvvdzmz0ra/screenshot-6.png))
07. WPDR Simple Downloads: Popular Downloads widget. ([Click here for larger version of screenshot](https://www.dropbox.com/s/g9lmccdo3yl3vy1/screenshot-7.png))
08. WPDR Simple Downloads: Search Downloads widget. ([Click here for larger version of screenshot](https://www.dropbox.com/s/6762dkha9mjhl89/screenshot-8.png))
09. WPDR Simple Downloads: Taxonomy Widget - used for "File Categories". ([Click here for larger version of screenshot](https://www.dropbox.com/s/k60osdmx6znakdv/screenshot-9.png))
10. WPDR Simple Downloads: Taxonomy Widget - used for "File Tags". ([Click here for larger version of screenshot](https://www.dropbox.com/s/9x5y28r84bwcytj/screenshot-10.png))
11. WPDR Simple Downloads: Original "Recently Revised Downloads" (Documents) widget - by base plugin WPDR :). ([Click here for larger version of screenshot](https://www.dropbox.com/s/3zx3tg6m11ll9yv/screenshot-11.png))
12. WPDR Simple Downloads: Help tab user guidance included. ([Click here for larger version of screenshot](https://www.dropbox.com/s/m9mz4usyr8xgm5m/screenshot-12.png))

== Changelog ==

= 1.0.0 (2012-12-28) =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Just released into the wild.

== Plugin Links ==
* [Translations (GlotPress)](http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/wpdr-simple-downloads)
* [User support forums](http://wordpress.org/support/plugin/wpdr-simple-downloads)
* [Code snippets archive for customizing, GitHub Gist](https://gist.github.com/4395899)

== Donate ==
Enjoy using *WP Document Revisions Simple Downloads*? Please consider [making a small donation](http://genesisthemes.de/en/donate/) to support the project's continued development.

== Translations ==

* English - default, always included
* German (de_DE): Deutsch - immer dabei! [Download auch via deckerweb.de](http://deckerweb.de/sprachdateien/wordpress-plugins/#wpdr-simple-downloads)
* For custom and update-secure language files please upload them to `/wp-content/languages/wpdr-simple-downloads/` (just create this folder) - This enables you to use fully custom translations that won't be overridden on plugin updates. Also, complete custom English wording is possible with that as well, just use a language file like `wpdr-simple-downloads-en_US.mo/.po` to achieve that (for creating one see the following tools).

**Easy plugin translation platform with GlotPress tool:** [**Translate "WP Document Revisions Simple Downloads"...**](http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/wpdr-simple-downloads)

*Note:* All my plugins are internationalized/ translateable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful. For translating I recommend the awesome ["Codestyling Localization" plugin](http://wordpress.org/extend/plugins/codestyling-localization/) and for validating the ["Poedit Editor"](http://www.poedit.net/), which works fine on Windows, Mac and Linux.

== Additional Info ==
**Idea Behind / Philosophy:** I just needed a simple downloads/ file manager plugin that used a custom post type for management. Since there are no such good download managers out there yet, but with the "WP Document Revisions" plugin there was an awesome solution. It only had few things missing in my opinion if used for public downloads/ file management. So finally, this add-on plugin was born. I hope you also find it useful somehow... :)

== Credits ==
* [**Ben Balter**](http://ben.balter.com/) for an amazing plugin with [**WP Document Revisions** - see WP.org plugin page](http://wordpress.org/extend/plugins/wp-document-revisions/) -- [see GitHub plugin development page](https://github.com/benbalter/WP-Document-Revisions/)!
* [**iconmonstr**®](http://iconmonstr.com/) for their amazing free icons.
