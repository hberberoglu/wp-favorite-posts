<?php

// Include Admin Page Framework library.
include( dirname( __FILE__ ) . '/include/library/admin-page-framework/admin-page-framework.php' );

if ( ! class_exists( 'WPFavoritePostsAdminPageFramework_Widget' ) ) {

    return;

}

// WP Favorite Posts Widget

class WPFavoritePostsWidget extends WPFavoritePostsAdminPageFramework_Widget {

		public function load( $oAdminWidget = null ) {

				$this->addSettingFields(
						array(
								'field_id'			=>	'title',
								'type'					=>	'text',
								'title'					=>	'Title',
								'default'				=>	'Your Favorite Posts',
						),
						array(
								'field_id'			=>	'number',
								'type'					=>	'number',
								'title'					=>	'Number',
								'description'		=>	'Number of posts to display.',
								'default'				=>	'5',
						),
						array(
								'field_id'	=>	'thumbnail_show',
								'type'			=>	'checkbox',
								'title'			=>	__( 'Show feature image thumbnail?', 'wp-favorite-posts' ),
								'label'			=>	__( 'Enable', 'wp-favorite-posts' ),
								'description'	=>	__( 'Select this option to show the feature image of a post next to the post\'s title in the favorite list table.', 'wp-favorite-posts' ),
								'default'		=>	true,
						),
						array(
								'field_id'	=>	'thumbnail_alignment',
								'type'			=>	'select',
								'title'			=>	__( 'Thumbnail alignment relative to post title', 'wp-favorite-posts' ),
								'description'	=>	__( 'Thumbnail alignment uses the default WordPress image CSS classes. Select \'Natural\' to apply no CSS alignment class.', 'wp-favorite-posts' ),
								'label'			=>	array(
										'left'	=>	__( 'Left', 'wp-favorite-posts' ),
										'right'		=>	__( 'Right', 'wp-favorite-posts' ),
										'center'		=>	__( 'Center', 'wp-favorite-posts' ),
										'none'	=>	__( 'None', 'wp-favorite-posts' ),
										'natural'	=>	__( 'Natural', 'wp-favorite-posts' ),
								),
								'default'		=>	'none',
						),
						array(
								'field_id'	=>	'thumbnail_default',
								'type'			=>	'image',
								'title'			=>	__( 'Add default image', 'wp-favorite-posts' ),
								'description'	=>	__( 'This image displays alongside posts that have no set feature image.', 'wp-favorite-posts' ),
								'attributes'	=>	array(
										'style'	=>	'max-width: 150px;',
								)
						),
						array(
								'field_id'	=> 'thumbnail_width',
								'type'			=> 'number',
								'title'			=>	__( 'Thumbnail width (pixels)', 'wp-favorite-posts' ),
								'description'	=>	__( 'Set a preferred width for the thumbnail.' ),
								'label_min_width'	=> '',
								'default'		=> 50,
								'attributes'	=> array(
										'style'	 => 'width: 60px',
								),
						),
						array(
								'field_id'	=> 'thumbnail_height',
								'type'			=> 'number',
								'title'			=>	__( 'Thumbnail height (pixels)', 'wp-favorite-posts' ),
								'description'	=>	__( 'Set a preferred height for the thumbnail.' ),
								'label_min_width'	=> '',
								'default'		=> 50,
								'attributes'	=> array(
										'style'	 => 'width: 60px',
								),
						),
						array(
								'field_id'	=>	'clear',
								'type'			=>	'text',
								'title'			=>	__( 'Clear all favorites link text', 'wp-favorite-posts' ),
								'default'		=>	'Clear all favorites?',
						),
						array(
								'field_id'	=>	'cleared',
								'type'			=>	'text',
								'title'			=>	__( 'Favorites cleared text', 'wp-favorite-posts' ),
								'default'		=>	'Favorites cleared!',
						),
						array(
								'field_id'	=>	'favorites_empty',
								'type'			=>	'textarea',
								'title'			=>	__( 'Favorites are empty text', 'wp-favorite-posts' ),
								'default'		=>	'There are no favorites to show! Add some.',
								'attributes'	=>	array(
										'rows'		=>	6,
										'style'		=>	'100%',
								),
						),
						array(
								'field_id'	=>	'cookie_warning',
								'type'			=>	'textarea',
								'title'			=>	__( 'Favorites saved to cookies text', 'wp-favorite-posts' ),
								'default'		=>	'Your favorite posts have been saved to your browsers cookies. If you clear cookies your list of favorite posts will be deleted also.',
								'attributes'	=>	array(
										'rows'		=>	6,
										'style'		=>	'100%',
								)
						)
				);

		}

		public function content( $sContent, $aArguments, $aFormData ) {

			ob_start();
				if ( @file_exists(TEMPLATEPATH.'/wpfp-widget-template.php') || @file_exists(STYLESHEETPATH.'/wpfp-widget-template.php') ):
						if(@file_exists(TEMPLATEPATH.'/wpfp-widget-template.php')) :
								include(TEMPLATEPATH.'/wpfp-widget-template.php');
						else :
								include(STYLESHEETPATH.'/wpfp-widget-template.php');
						endif;
				else:
						include( realpath(dirname(__FILE__)) . "/templates/wpfp-widget-template.php");
				endif;
			$list = ob_get_clean();
			
			return $sContent . $list;

		}

}
new WPFavoritePostsWidget(
		'WP Favorite Posts',    // widget title
		array(
				'description'   => 'Shows a visitors favorite posts.',
		)
);