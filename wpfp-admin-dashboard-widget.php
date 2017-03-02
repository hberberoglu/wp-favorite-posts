<?php

/**
 * WP Favorite Posts Dashboard Widget Setup
 *
 */
function wp_favorite_posts_add_dashboard_widget() {

	wp_add_dashboard_widget(
                 'wp_favorite_posts_dashboard_widget',         // Widget slug.
                 'WP Favorite Posts',         // Title.
                 'wp_favorite_posts_dashboard_widget_content' // Display function.
        );	
}

/**
 * WP Favorite's Dashboard Widget Content.
 */
function wp_favorite_posts_dashboard_widget_content() {

	$favorites_show = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'dashboard_options', 'favorites_show' ), 'default' );
	wpfp_list_most_favorited($favorites_show);
}

if ( is_admin() ) {
	add_action( 'wp_dashboard_setup', 'wp_favorite_posts_add_dashboard_widget' );
}