<?php

$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
$favorite_post_ids = wpfp_get_users_favorites( "$user" );

echo "<ul class='wpfp-widget-ul'>";
if ($favorite_post_ids) {

	$_sTitle = $this->oUtil->getElement( $aFormData, 'title' );
	$_sNumber = $this->oUtil->getElement( $aFormData, 'number' );
	$_sThumbnailShow = $this->oUtil->getElement( $aFormData, 'thumbnail_show' );
	$_sThumbnailDefault = esc_url( $this->oUtil->getElement( $aFormData, 'thumbnail_default' ) );
	$_sThumbnailAlignment = $this->oUtil->getElement( $aFormData, 'thumbnail_alignment' );
	$_sThumbnailWidth = $this->oUtil->getElement( $aFormData, 'thumbnail_width' );
	$_sThumbnailHeight = $this->oUtil->getElement( $aFormData, 'thumbnail_height' );
	$_sClear = $this->oUtil->getElement( $aFormData, 'clear' );
	$_sCleared = $this->oUtil->getElement( $aFormData, 'cleared' );
	$_sCookieWarning = $this->oUtil->getElement( $aFormData, 'cookie_warning' );
	
	
	$c = 0;
	$favorite_post_ids = array_reverse($favorite_post_ids);
		foreach ($favorite_post_ids as $post_id) {
			if ($c++ == $_sNumber) break;

			echo "<li style='list-style-type: none;'>";
			if ( $_sThumbnailShow == '1' && has_post_thumbnail($post_id) ) {
				$thumbnail = get_the_post_thumbnail( "$post_id", array( "$_sThumbnailWidth", "$_sThumbnailHeight" ), array( 'class' => "$_sThumbnailAlignment" ) );
			} else {
				$thumbnail = '<img src="' . $_sThumbnailDefault . '" class="' . $_sThumbnailAlignment . '" style="width:' .$_sThumbnailWidth. ';height="' .$_sThumbnailHeight. '" />';
			}
			if ( $_sThumbnailShow == '0' ) {
				$thumbnail = '';
			}
			echo "<a href='".get_permalink($post_id)."' title='". get_the_title($post_id) ."'>$thumbnail " . get_the_title($post_id) . "</a> ";
			wpfp_remove_favorite_link($post_id);
			echo "</li>";
		}
		echo "<li style='list-style-type: none;'>" . wpfp_clear_list_link() . "</li>";
		wpfp_cookie_warning();			
} else {

		$_sFavoritesEmpty = $this->oUtil->getElement( $aFormData, 'favorites_empty' );
		
		echo "<li style='list-style-type: none;'>";
		echo "$_sFavoritesEmpty";
		echo "</li>";
		
}

echo "</ul>";

wp_reset_query();