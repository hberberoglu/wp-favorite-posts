=== WP Favorite Posts ===
Contributors: hberberoglu
Donate link: http://nxsn.com/donate/
Tags: favorite posts, favorite, favourite, posts, favorites,
wp-favorite-posts, reading list, post list, post lists, lists
Requires at least: 3.5
Tested up to: 3.8
Stable tag: 1.6.0

Allows visitors to add favorite posts. This plugin use cookies for saving data so
unregistered users can favorite a post.

== Description ==

Allows users to add favorite posts. This plugin use cookies and database for
saving data.

- If a user logged in then favorites data will saved in database instead of cookies.
- If user not logged in data will saved in cookies.

You can choose "only registered users can favorite a post" option, if you want.
Also there is a widget named "Most Favorited Posts". And you can use this template
tag for listing most favorited posts;

<h2>Most Favorited Posts</h2>
<?php wpfp_list_most_favorited(5); ?>

If you use WP Super Cache you must add page (which you show favorites) URI to "Accepted Filenames &
Rejected URIs".

If you need support [create a topic on support forum](http://wordpress.org/support/plugin/wp-favorite-posts)

For thank me [go here](http://nxsn.com/projects/wp-favorite-posts/) or [make a donation](http://nxsn.com/donate/)

== Installation ==

1. Unzip into your `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php if (function_exists('wpfp_link')) { wpfp_link(); } ?>` in your
single.php or page.php template file. Then favorite this post link will appear in all posts.
1. OR if you DO NOT want the favorite link to appear in every post/page, DO NOT
use the code above. Just type in [wpfp-link] into the selected post/page
content and it will embed the print link into that post/page only.
1. Create a page e.g. "Your Favorites" and insert `{{wp-favorite-posts}}`
text into content section. This page will contain users favorite posts.
1. That's it :)

== Screenshots ==
1. Options
2. Label Settings
3. Advanced Settings

== Changelog ==

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
