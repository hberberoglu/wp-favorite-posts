<?php

$thumbnail_show = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_show' ), 'default' );
$thumbnail_default = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_default' ), 'default' );
$thumbnail_alignment = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_alignment' ), 'default' );
$thumbnail_width = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_width' ), 'default' );
$thumbnail_height = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'thumbnail_options', 'thumbnail_height' ), 'default' );

echo "<ul>";
if ($favorite_post_ids):
	$c = 0;
	$favorite_post_ids = array_reverse($favorite_post_ids);
    foreach ($favorite_post_ids as $post_id) {
    	if ($c++ == $limit) break;
        $p = get_post($post_id);

	if ( $thumbnail_show == '1' && has_post_thumbnail($post_id) ) {
		$thumbnail = get_the_post_thumbnail( "$post_id", array( "$thumbnail_width", "$thumbnail_height" ), array( 'class' => "$thumbnail_alignment" ) );
	} else {
		$thumbnail = '<img src="' . $thumbnail_default . '" class="' . $thumbnail_alignment . '" style="width:' .$thumbnail_width. ';height="' .$thumbnail_height. '" />';
	}
	if ( $thumbnail_show == '0' ) {
		$thumbnail = '';
	}

	echo "<li style='display:block;width:90%;'><a href='".get_permalink($post_id)."' title='". get_the_title($post_id) ."'>$thumbnail " . get_the_title($post_id) . "</a> ";
	wpfp_remove_favorite_link(get_the_ID());
	echo "</li>";

    }
else:
    echo "<li>";
    echo "Your favorites will be here.";
    echo "</li>";
endif;
echo "</ul>";
?>
