<?php

global $wpdb;
$query = "SELECT post_id, meta_value, post_status FROM $wpdb->postmeta";
$query .= " LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID";
$query .= " WHERE post_status='publish' AND meta_key='".WPFP_META_KEY."' AND meta_value > 0 ORDER BY ROUND(meta_value) DESC LIMIT 0, $limit";
$results = $wpdb->get_results($query);

if ($results) {

	$thumbnail_show = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_show' ), 'default' );
	$thumbnail_default = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_default' ), 'default' );
	$thumbnail_alignment = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_alignment' ), 'default' );
	$thumbnail_width = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_width' ), 'default' );
	$thumbnail_height = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_height' ), 'default' );
	
	echo "<ul>";
	foreach ($results as $o) {
	
			$post_id = $o->post_id;
			$count = wpfp_get_post_meta($post_id);
			
			echo "<li style='list-style-type: none;'>";
			if ( $thumbnail_show == '1' && has_post_thumbnail( $post_id ) ) {
							$thumbnail = get_the_post_thumbnail( $post_id, array( "$thumbnail_width", "$thumbnail_height" ), array( 'class' => "$thumbnail_alignment" ) );
						} else {
							$thumbnail = '<img src="' . $thumbnail_default . '" class="' . $thumbnail_alignment . '" style="width:' .$thumbnail_width. ';height="' .$thumbnail_height. '" />';
						}
			if ( $thumbnail_show == '0' ) {
				$thumbnail = '';
			}
			echo "<a href='".get_permalink($post_id)."' title='". get_the_title($post_id) ."'>$thumbnail " . get_the_title($post_id) . "</a> ($count)</li>";
	}
	echo "</ul>";

}

wp_reset_query();