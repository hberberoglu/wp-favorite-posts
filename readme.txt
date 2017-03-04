=== WP Favorite Posts ===
Contributors: leehodson,hberberoglu
Donate link: https://www.paypal.me/vr51
Tags: favorite posts, favorite, favourite, posts, favorites,
wp-favorite-posts, reading list, post list, post lists, lists
Requires at least: 3.5
Tested up to: 4.7.3
Stable tag: 2.1.2

Let users add posts to their personal favorite list. Registered users can keep lists permanently. Unregistered users can keep lists for their session lifetime. Display the buttons automatically above or below posts, or add manually. Show the favorites list in a page that includes the shortcode <code>[wp-favorite-posts]</code>. See readme for version details.

== Description ==

Let users add posts to their personal favorite list. Registered users can keep lists permanently. Unregistered users can keep lists for their session lifetime. Display the 'favorite' buttons automatically above or below posts, or add the buttons manually. Show the favorites list in a page that includes the shortcode <code>[wp-favorite-posts]</code> or display favorites in a sidebar widget. View total post favorite stats in admin dashboard.

- If a user is logged in their favorites will be saved to the WordPress database in their user profile.
- If user is not logged in their data will saved to their active session cookie.
- Statistical data for each post is stored in the post meta.
- Select whether favorite lists can be saved by registered users only.
- Display a users favorite list in a 'favorites' page using shortcode [wp-favorite-posts].
- Use the "Most Favorited Posts" widget to display favorite lists in a sidebar.
- Create your own display template to customize the display of the shortcode or any of the widgets if you desire.

<h2>How to Display a Users Most Favorite Post List</h2>

Use the plugin settings under <strong>Settings > WP Favorite Posts</strong> to configure where the favorite buttons display and how they display or use the shortcode [wpfp-link] to add the buttons manually in a page or post.

List a users favorite posts using the shortcode [wp-favorite-posts] in a page. There is a widget for this too.

List the most favorite posts ever (statistics need to be enabled) using the shortcode [wpfp-most number='5'] where number='5' is the number of favorite posts to show.

Text labels can be configured in the plugin settings or you can use a translation file if you prefer.

<h2>Developers</h2>

Add the favorite post buttons and lists to template files using the following functions.

Use `<?php if (function_exists('wpfp_link')) { wpfp_link(); } ?>` to manually add the favorite post buttons to post and page templates.

Use `<?php if (function_exists('wpfp_list_most_favorited')) {wpfp_list_most_favorited( $number ); } ?>` in your theme template to display the most favorited posts ever. The number determines the number of items displayed.

Use the code `<?php if (function_exists('wpfp_list_favorite_posts()')) { wpfp_list_favorite_posts()(); } ?>`

Place custom display templates into your theme or child theme's root directory. Existing templates are in wp-favorite-posts/templates/. They are:

- wpfp-page-template.php
- wpfp-most-favorited-template.php
- wpfp-widget-template.php
- wpfp-most-favorited-dashboard-widget-template.php

<h2>History of This Version</h2>

This is a fork of the original code.

Code and plugin package for this fork is found at http://github.com/vr51/wp-favorite-posts/.

The original WP Favorite Posts is found at http://wordpress.org/extend/plugins/wp-favorite-posts/changelog/.

This fork is maintained by Lee Hodson @vr51.

Please submit pull requests for this fork to https://github.com/vr51/wp-favorite-posts

Please submit pull requests for the original code to https://github.com/hberberoglu/wp-favorite-posts


== Installation ==

1. Unzip into your `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Visit Settings > WP Favorite Posts to configure plugin.
1. Visit Settings > WP Favorite Posts to read help information.

== Screenshots ==
1. General Settings
2. Display Settings
3. Thumbnail Settings
4. Label Settings
5. Advanced Settings
6. Help and Debug Information

== Changelog ==

= Coming up...

Import old plugin settings from prior to 1.7.1, if exist (automatic) and new not already set.

Stats admin dashboard widget.

Thumbnail image montage (if thumb used)

	Make file name on click of View Favourite's button.
	Insert file name as feature image for favourite's page (requires ability to select page used for favourites).
	Make feature image (PHP). Store image in Feature Montage Gallery

= 2.1.1 (2017-03-04) =

* Enhancement: Improved dashboard widget's appearance
	
= 2.1.1 (2017-03-02) =

* New: Added dashboard stats widget
* Updated: Updated Admin Page Framework files to latest release.

= 2.1.0 (2016-11-15) =

Released by leehodson

*	Enhancement: Moved templates into /templates directory.
* Enhancement: Moved Most Favorite Posts list into its own template ()
* Enhancement: Converted WP Favorite Posts widget to Admin Page Framework.
* Enhancement: Added ajax action to widget buttons.
* Feature: WP Favorite Posts widget has new options to configure.
* Feature: Added new shortcode for listing most favorited posts of all time: [wpfp-most number='5']
*	Fix: Fixed bug in the widget that prevented proper functioning of 'remove favorite'.
* Fix: Fixed display of 'most favorited posts' list (shows total favorites for posts as opposed to favorites of the current visitor).
* Fix: Fixed another display error in the user's 'Favorite Posts' list.
* Fixes: Several other unrecorded fixes made along the way.

= 2.0.1 (2016-11-14) =

Released by leehodson.

* Enhancement: Made some previously non configurable text labels user editable. See the Labels section of the admin page.
* Fix: Fixed ajax calls. I had previously added an edit that used 'velocity' if available. This edit broke things so reverted this edit.
* Enhancement: Other minor changes.
* Cleanup: Removed some code made redundant by the introduction of Admin Page Framework.

= 2.0.0 (2016-11-13) =

Released by leehodson.

* Rewrite: Converted to Admin Page Framework. Changes made to provide greater scope for feature enhancements and for new features to be added. (leehodson).
* Added: Export setttings.
* Added Import settings.
* Added Reset All Data (resets version 2.0 data only. Actually, this deletes all > 2.x options data from the database).

= 1.7.1 (2016-11-13) =

Released by leehodson.

* Feature: Include thumbnails alongside post title (leehodson).
* Fix: Changed plugin directory variable and removed hardcoded URLs & directory paths.
*	Fix: Fixed shortcode display bug that forced the shortcode output out of its container under some circumstances.
* Updates: Introduced various other changes to the code. Some changes came from edits made in other GitHub listed code forks.

= 1.6.6 (2016-03-16) =
* Security update: Fix cross-site scripting (XSS) vulnerability props: JPCERT/CC Vulnerability Handling Team & Gen Sato

= 1.6.2 (2014-04-28) =
* Tested with WordPress 3.9.

= 1.6.1 (2014-02-01) =
* Fixed: not loggedin user were able to add favorite even if "only registered users can favorite" option true.

= 1.5.9.1 (2014-01-07) =
* Fix php warnings and deprecated thing.

= 1.5.9.1 (2014-01-04) =
* fix php warnings
* do wpfp actions on wp_loaded instead of template_redirect

= 1.5.9 (2014-01-03) =
* Version bump
* Added isset checks

= 1.5.8.4 (2014-01-03) =
* Replace deprecated functions
* Various fixes

= 1.5.8.1 (2013-01-14) =
* Widgets functions updated


= 1.5.8 (2012-12-31) =
* BUGFIX: fixed fake favorite possiblity bug. Thanks to Marian (http://nxsn.com/projects/wp-favorite-posts/comment-page-11/#comment-16505)

= 1.5.7 (2012-12-29) =
* Automatic show option added to settings screen. You can configure to show "add/remove favorite" link before or after post content.
* Pagination added to default user's favorite posts template. Also you can configure favorite post per page number from settings screen.
* deprecated methods fixed.

= 1.5.6 (2011-12-04) =
* BUGFIX: Fixed user's favorites widget post limit bug, it works from now.
* NEW FEATURE: Added "Reset Statistic Data" option to admin page. You can remove all statistic data by clicking this link.
* NEW FEATURE: Added sorting, last added posts will be shown first.
* FIX: Changed WP_PLUGIN_URL --> plugins_url()

= 1.5.5 (2011-11-23) =
* BUGFIX: related with 1.5.4

= 1.5.4 (2011-11-23) =
* BUGFIX: Thanks to @spectrus http://wordpress.org/support/topic/plugin-wp-favorite-posts-major-bug-getting-user-favourites?replies=1#post-2465141

= 1.5.3 (2011-11-23) =
* NEW FEATURE: Added don't load js/css file option. If you don't want to load wp favorite post's js/css file, use these options. 

= 1.5.2 (2010-12-27) =
* FIX: Change the user's favorites wigdet title bug fixed.

= 1.5.1 (2010-06-04) =
* Little JS fix. Thanks to Heather Wallace.

= 1.4.3.2 (2010-04-23) =
* Show only published posts on most favorited posts widget

= 1.4.3 (2010-04-13) =
* Admin can write html codes to label settings (on admin page)
* Added "wpfp_link_html" and "wpfp_remove_favorite_link" filters.

= 1.4.3 (2010-04-09) =
* Fix: same remove link for all posts on index
* better wpfp.js: remove li which on favorites page.

= 1.4.1 (2010-04-05) =
* code refactor, add do_action for add and remove to list (#225575)
* update admin page
* Fix plugin path, fixes image loading problems (#222902)

= 1.4 (2010-03-20) =
* Override page template if wpfp-page-template.php exists on template directory.
* Add [wp-favorite-posts] shortcode. Use shortcode instead of {{wp-favorite-posts}}

= 1.3.5 (2010-03-17) =
* Fix meta key issue.

= 1.3.4 (2010-03-16) =
* Fix wpfp-span issue

= 1.3.3 (2010-03-16) =
* Fixed regression: if javascript doesn't work change to non-ajax mode.
This fixes 'only text' pages. 
* If user logged in don't show cookie warning at "your favorites" page.
* Added "show remove link" and "show add link" options. 
You can show remove link when someone add a favorite.
Similary You can show add link when someone remove a favorite.

= 1.3.1 (2009-06-10) =
* Added Before Link Image feature.
* Refactor code and imporve DRY
* Fixed bug: Most favorite list's string sorting problem 2 > 11
* Fixed bug: Clear link not updating post's favorited count

= 1.3 (2009-05-31) =
* Fixed bug: Plugin was working wrong in pages with links includes # character.
* Added template tag for Most Favorite Posts. There was already a widget for this.

= 1.2.1 (2009-05-14) =
* Added "Most Favorited Posts" widget.
* Added "buy me a beer" section to admin page.
* Added favorite statistic feature.

= 1.2 (2009-04-26) =
* Added database integration. 
- If a user logged in then favorites data will save to database instead of cookies.
- If user not logged in data will save to cookies.
* Added "only registered users can favorite" option.

= 1.1.7 (2009-03-10) =
* Fixed duplicate loading image problem
* Added [wpfp-link] feature;
You can show favorite link only in preferred posts with writing
[wpfp-link] to the post content.

= 1.1.6 (2009-03-05) =
* Fixed ajax problem.

= 1.1.5 (2009-03-02) =
* Added rel="nofollow" to links.
* Favorite posts title language problem solved.
* ajax.js file renamed to wpfp.js
* Use XHTML valid links.
* Use class instead of id for html elements.
* Use more unique function names. All functions starts with wpfp.

= 1.2.1 (2009-05-14) =
* Added "Most Favorited Posts" widget.
* Added "buy me a beer" section to admin page.
* Added favorite statistic feature.

= 1.2 (2009-04-26) =
* Added database integration. 
- If a user logged in then favorites data will save to database instead of cookies.
- If user not logged in data will save to cookies.
* Added "only registered users can favorite" option.

= 1.1.7 (2009-03-10) =
* Fixed duplicate loading image problem
* Added [wpfp-link] feature;
You can show favorite link only in preferred posts with writing
[wpfp-link] to the post content.

= 1.1.6 (2009-03-05) =
* Fixed ajax problem.

= 1.1.5 (2009-03-02) =
* Added rel="nofollow" to links.
* Favorite posts title language problem solved.
* ajax.js file renamed to wpfp.js
* Use XHTML valid links.
* Use class instead of id for html elements.
* Use more unique function names. All functions starts with wpfp.

= 1.1.4 (2009-02-24) =
* Use permalinks favorite links.
* Users can remove a single favorite post from favorite posts page.

= 1.1.3 (2009-02-24) =
* Clear Favorites now works.
* Favorite list is xhtml valid now.

= 1.1.2 (2009-02-24) =
* Save button fixed which in options page.

= 1.1.1 (2009-02-24) =
* Cleared wrong code.

= 1.1 (2009-02-24) =
* Fixed permalink problem. Now works with all types of permalink.

= 1.0 (2009-02-23) =
* First Release of WP-Favorite Posts
