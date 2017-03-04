<?php

global $wpdb;
$query = "SELECT post_id, meta_value, post_status FROM $wpdb->postmeta";
$query .= " LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID";
$query .= " WHERE post_status='publish' AND meta_key='".WPFP_META_KEY."' AND meta_value > 0 ORDER BY ROUND(meta_value) DESC LIMIT 0, $limit";
$results = $wpdb->get_results($query);

if ($results) {

	$thumbnail_show = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'dashboard_options', 'thumbnail_show' ), 'default' );
	$thumbnail_default = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'dashboard_options', 'thumbnail_default' ), 'default' );
	$thumbnail_alignment = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'dashboard_options', 'thumbnail_alignment' ), 'default' );
	$thumbnail_width = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'dashboard_options', 'thumbnail_width' ), 'default' );
	$thumbnail_height = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'dashboard_options', 'thumbnail_height' ), 'default' );
	
	/*
	*
	* Old simple loop. Replaced with table. Retained as a comment in case you want to use it.
	**/
	/*
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
	*/
	
	// Build loop table
	echo "<table class='wp-list-table widefat striped posts'>";
	echo "<thead><tr>";
	// Build column headers
	echo "<th scope='col' id='number' class='column-primary' style='width: auto;text-align:left;'>#</th>";
	if ( $thumbnail_show == '1' ) {
		echo "<th scope='col' id='thumbnail' class='column-thumb thumbnail' style='width: auto;'>Thumbnail</th>";
	}
	echo "<th scope='col' id='title' class='column-title' style='width: auto;'>Title</th>";
	echo "<th scope='col' id='favorited' class='column-favorited num' style='width: auto;'>Favorited</th>";
	echo "</tr></thead>";
	echo "<tbody>";
	
	$c = 1; // Count row numbers
	foreach ($results as $o) {
	
			$post_id = $o->post_id;
			$count = wpfp_get_post_meta($post_id);
			
			$permalink = get_permalink($post_id);
			$title = get_the_title($post_id);
			
			// Get thumbnail
			
			if ( $thumbnail_show == '1' && has_post_thumbnail( $post_id ) ) {
				$thumbnail = get_the_post_thumbnail( $post_id, array( "$thumbnail_width", "$thumbnail_height" ), array( 'class' => "$thumbnail_alignment" ) );
			} elseif ( $thumbnail_show == '1' &! has_post_thumbnail( $post_id ) ) {
				$thumbnail = '<img src="' . $thumbnail_default . '" class="' . $thumbnail_alignment . '" style="width:' .$thumbnail_width. ';height="' .$thumbnail_height. '" />';
			}
			
			if ($c & 1) { $row = 'odd';	} else { $row = 'even';	} // Check whether odd/even row
			
			// Build rows
			echo "<tr class='$row'>";
				echo "<td class='column-primary' data-colname='Number'>$c</td>";
				$c++;
				
				if ( $thumbnail_show == '1' ) {
					echo "<td class='thumbnail column-thumbnail' style='text-align:center;' data-colname='Thumbnail'>";
					echo "<a href='$permalink' title='$title'>$thumbnail</a>";
					echo "</td>";
				}
				
				echo "<td class='title column-title page-title' data-colname='Title'>";
				echo "<a href='$permalink' title='$title'>$title</a>";
				echo "</td>";
				
				echo "<td class='count num column-count' data-colname='Count'>";
				echo "<a href='$permalink' title='$title'>$count</li>";
				echo "</td>";
				
			echo "</tr>";
	}
	echo "</tbody></table>";
	
}

wp_reset_query();