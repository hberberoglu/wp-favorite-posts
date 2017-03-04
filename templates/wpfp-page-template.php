<?php

	$wpfp_before = "";
	echo "<div class='wpfp-span'>";
	
	if (!empty($user)) {
			if (wpfp_is_user_favlist_public($user)) {
					$wpfp_before = "$user's Favorite Posts.";
			} else {
					$wpfp_before = "$user's list is not public.";
			}
	}

	if ($wpfp_before) {
			echo '<div class="wpfp-page-before">'.$wpfp_before.'</div>';
	}

	if ($favorite_post_ids) {
	
			$favorite_post_ids = array_reverse($favorite_post_ids);
			$post_per_page = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'display_options', 'post_per_page' ), 'default' );
			
			$page = intval(get_query_var('paged'));

			$thumbnail_show = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_show' ), 'default' );
			$thumbnail_default = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_default' ), 'default' );
			$thumbnail_alignment = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_alignment' ), 'default' );
			$thumbnail_width = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_width' ), 'default' );
			$thumbnail_height = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_height' ), 'default' );

			$qry = array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page);
			// custom post type support can easily be added with a line of code like below.
			// $qry['post_type'] = array('post','page');
			query_posts($qry);
			
			echo "<ul>";
			while ( have_posts() ) : the_post();
					echo "<li style='list-style-type: none;'>";
					if ( $thumbnail_show == '1' && has_post_thumbnail() ) {
									$thumbnail = get_the_post_thumbnail( get_the_ID(), array( "$thumbnail_width", "$thumbnail_height" ), array( 'class' => "$thumbnail_alignment" ) );
								} else {
									$thumbnail = '<img src="' . $thumbnail_default . '" class="' . $thumbnail_alignment . '" style="width:' .$thumbnail_width. ';height="' .$thumbnail_height. '" />';
								}
					if ( $thumbnail_show == '0' ) {
						$thumbnail = '';
					}
					echo "<a href='".get_permalink()."' title='". get_the_title() ."'>$thumbnail " . get_the_title() . "</a> ";
					wpfp_remove_favorite_link(get_the_ID());
					echo "</li>";
			endwhile;
			echo "</ul>";

			echo wpfp_clear_list_link();
			wpfp_cookie_warning();

			echo '<div class="navigation">';
					if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
						echo '<div class="alignleft">' . next_posts_link( __( '&larr; Previous Entries', 'wp-favorite-posts' ) ) . '</div>';
						echo '<div class="alignright">' . previous_posts_link( __( 'Next Entries &rarr;', 'wp-favorite-posts' ) ) . '</div>';
					}
			echo '</div>';

			wp_reset_query();
	} else {
			$favorites_empty = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'favorites_empty' ), 'default' );
			echo "$favorites_empty";
	}
	
echo "</div>";