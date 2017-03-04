<?php

/**
*
*	Create admin page for the plugin options.
*
**/

// Include Admin Page Framework library.
include( dirname( __FILE__ ) . '/include/library/admin-page-framework/admin-page-framework.php' );

if ( ! class_exists( 'WPFavoritePostsAdminPageFramework' ) ) {

    return;

}

class WPFavoritePosts extends WPFavoritePostsAdminPageFramework {

		/* Create Admin Page under Settings > WP Favorite Posts */
		
		public function setUp() {
		
				$this->setRootMenuPage( 'Settings' ); 

				$this->addSubMenuItems(
						array(
								'title'     => 'WP Favorite Posts',
								'page_slug' => 'wp_favorite_posts'
						)

				);


				/* Disable the page heading tabs. */
				$this->setPageHeadingTabsVisibility( false );
				
				/* Set the HTML tag used for in-page tabs titles */
				$this->setInPageTabTag( 'h2' );

				/* Add in-page tabs */

				$this->addInPageTabs(

						'wp-favorite-posts',    // target page slug
						array(
								'title'         => __( 'General', 'wp-favorite-posts'),    // tab title
								'tab_slug'      => 'general',    // tab slug
						),
						array(
								'title'         => __( 'Display', 'wp-favorite-posts'),    // tab title
								'tab_slug'      => 'display',    // tab slug
						),
						array(
								'title'         => __( 'Thumbnail', 'wp-favorite-posts'),    // tab title
								'tab_slug'      => 'thumbnail',    // tab slug
						),
						array(
								'title'         => __( 'Labels', 'wp-favorite-posts'),    // tab title
								'tab_slug'      => 'labels',    // tab slug
						),
						array(
								'title'         => __( 'Dashboard', 'wp-favorite-posts'),    // tab title
								'tab_slug'      => 'dashboard',    // tab slug
						),
						array(
								'title'         => __( 'Advanced', 'wp-favorite-posts'),    // tab title
								'tab_slug'      => 'advanced',    // tab slug
						),
						array(
								'title'         => __( 'Help', 'wp-favorite-posts'),    // tab title
								'tab_slug'      => 'help',    // tab slug
						)

				);

		}

		/**
		*
		*	Add Tab Content such as Descriptions and Form Fields
		*
		**/

		public function load() {

				/* General */

				$this->addSettingSections(
						array(
								'section_id'	=>	'general_options',
								'page_slug'		=>	'wp_favorite_posts',
								'tab_slug'		=>	'general',
								'title'				=>	__( 'General Options', 'wp-favorite-posts' ),
								'description'	=>	__( '<p>Miscellaneous options that fit into no other better defined category.</p>', 'wp-favorite-posts' ),
								'order'				=>	'1',
						)
				);

				$this->addSettingFields(
						'general_options',	// target section ID
						array(
								'field_id'	=>	'opt_only_registered',
								'type'			=>	'checkbox',
								'title'			=>	__( 'Enable favorite lists for registered users only?', 'wp-favorite-posts' ),
								'label'			=>	__( 'Select this option to prevent the creation of favorite lists by anonymous visitors.', 'wp-favorite-posts' ),
								'description'	=>	__( '', 'wp-favorite-posts' ),
								'default'		=>	false,
						),
						array(
								'field_id'	=>	'statistics',
								'type'			=>	'select',
								'title'			=>	__( 'Statistics', 'wp-favorite-posts' ),
								'description'	=>	__( 'Enable statistics to count the total number of times each post has been added to a favorites list.', 'wp-favorite-posts' ),
								'label'			=>	array(
										'enabled'		=>	__( 'Enabled', 'wp-favorite-posts' ),
										'disabled'	=>	__( 'Disabled', 'wp-favorite-posts' ),
								),
								'default'		=>	'enabled',
						),
						array(
								'field_id'	=>	'submit_button',
								'type'			=>	'submit',
								'title'			=>	__( 'Save Settings', 'wp-favorite-posts' ),
								'description'	=>	__( 'Save before you switch tabs.', 'wp-favorite-posts' ),
								'label'			=>	__( 'Save', 'wp-favorite-posts' ),
						) 
				);
				
				
				/* Display */

				$this->addSettingSections(
						array(
								'section_id'	=>	'display_options',
								'page_slug'		=>	'wp_favorite_posts',
								'tab_slug'		=>	'display',
								'title'				=>	__( 'Display Options', 'wp-favorite-posts' ),
								'description'	=>	__( '<p>Control the way WP Favorite Posts displays buttons and lists.</p>', 'wp-favorite-posts' ),
								'order'				=>	'1',
						)
				);

				$this->addSettingFields(
						'display_options',	// target section ID
						array(
								'field_id'	=>	'autoshow',
								'type'			=>	'select',
								'title'			=>	__( 'Show WP Favorite Posts buttons', 'wp-favorite-posts' ),
								'description'	=>	__( 'Automatically show buttons before or after post content, or add the buttons manually per page or post with the shortcode with <strong>[wpfp-link]</strong>', 'wp-favorite-posts' ),
								'label'			=>	array(
										'before'	=>	__( 'Before content', 'wp-favorite-posts' ),
										'after'		=>	__( 'After content', 'wp-favorite-posts' ),
										'custom'	=>	__( 'Manual placement', 'wp-favorite-posts' ),
								),
								'default'		=>	'before',
						),
						array(
								'field_id'	=>	'before_image',
								'title'			=>	 __( 'Show which icon before the button title', 'wp-favorite-posts' ),
								'type'			=>	'radio',
								'label'			=>	array(
										'star'				=>	"<img src='".WPFP_PATH."/img/star.png' alt='Big Star' title='Big Star' class='wpfp-img' />",
										'bulletstar'	=>	"<img src='".WPFP_PATH."/img/bullet_star.png' alt='Big Star' title='Bullet Star' class='wpfp-img' />",
										'heart'				=>	"<img src='".WPFP_PATH."/img/heart.png' alt='Heart' title='Heart' class='wpfp-img' />",
										'custom'			=>	__( 'Custom Icon', 'wp-favorite-posts' ),
										'noicon'			=>	__( 'No Icon', 'wp-favorite-posts' ),
								),
								'default'		=>	'star',    // yields Cherry; its key is specified.
								'after_label'	=>	'<br />',
						),
						array(
								'field_id'	=>	'custom_before_image',
								'type'			=>	'image',
								'title'			=>	__( 'Add custom icon', 'wp-favorite-posts' ),
								'description'	=>	__( 'This icon is shown next to buttons only when <strong>Custom Icon</strong> is selected above.', 'wp-favorite-posts' ),
								'attributes'	=>	array(
										'style'	=>	'max-width: 150px;',
								)
						),
						array(
								'field_id'	=> 'post_per_page',
								'type'			=> 'number',
								'title'			=>	__( 'Favorite posts per page', 'wp-favorite-posts' ),
								'description'	=>	__( 'This only works with the default favorite post list page template (wpfp-page-template.php).' ),
								'label_min_width'	=> '',
								'default'		=> 20,
								'attributes'	=> array(
										'style'	 => 'width: 80px',
								),
						),
						array(
								'field_id'	=>	'submit_button',
								'type'			=>	'submit',
								'title'			=>	__( 'Save Settings', 'wp-favorite-posts' ),
								'description'	=>	__( 'Save before you switch tabs.', 'wp-favorite-posts' ),
								'label'			=>	__( 'Save', 'wp-favorite-posts' ),
						) 
				);

				/* Thumbnail */

				$this->addSettingSections(
						array(
								'section_id'	=>	'thumbnail_options',
								'page_slug'		=>	'wp_favorite_posts',
								'tab_slug'		=>	'thumbnail',
								'title'				=>	__( 'Thumbnail Options', 'wp-favorite-posts' ),
								'description'	=>	__( '<p>Configure the display of the post feature image thumbnail.</p>', 'wp-favorite-posts' ),
								'order'				=>	'1',
						)
				);

				$this->addSettingFields(
						'thumbnail_options',	// target section ID
						array(
								'field_id'	=>	'thumbnail_show',
								'type'			=>	'checkbox',
								'title'			=>	__( 'Show feature image thumbnail?', 'wp-favorite-posts' ),
								'label'			=>	__( 'Enable', 'wp-favorite-posts' ),
								'description'	=>	__( 'Select this option to show the feature image of a post next to the post\'s title in the favorite list table.', 'wp-favorite-posts' ),
								'default'		=>	true,
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
								'field_id'	=> 'thumbnail_width',
								'type'			=> 'number',
								'title'			=>	__( 'Thumbnail width (pixels)', 'wp-favorite-posts' ),
								'description'	=>	__( 'Set a preferred width for the thumbnail.' ),
								'label_min_width'	=> '',
								'default'		=> 150,
								'attributes'	=> array(
										'style'	 => 'width: 80px',
								),
						),
						array(
								'field_id'	=> 'thumbnail_height',
								'type'			=> 'number',
								'title'			=>	__( 'Thumbnail height (pixels)', 'wp-favorite-posts' ),
								'description'	=>	__( 'Set a preferred height for the thumbnail.' ),
								'label_min_width'	=> '',
								'default'		=> 150,
								'attributes'	=> array(
										'style'	 => 'width: 80px',
								),
						),
						array(
								'field_id'	=>	'submit_button',
								'type'			=>	'submit',
								'title'			=>	__( 'Save Settings', 'wp-favorite-posts' ),
								'description'	=>	__( 'Save before you switch tabs.', 'wp-favorite-posts' ),
								'label'			=>	__( 'Save', 'wp-favorite-posts' ),
						) 
				);
				
				/* Labels */

				$this->addSettingSections(
						array(
								'section_id'	=>	'label_options',
								'page_slug'		=>	'wp_favorite_posts',
								'tab_slug'		=>	'labels',
								'title'				=>	__( 'Button Label Options', 'wp-favorite-posts' ),
								'description'	=>	__( '<p>Set the text labels and text strings used by WP Favorite Posts.</p>', 'wp-favorite-posts' ),
								'order'				=>	'1',
						)
				);

				$this->addSettingFields(
						'label_options',	// target section ID
						array(
								'field_id'	=>	'add_favorite',
								'type'			=>	'text',
								'title'			=>	__( 'Add to favorites link text', 'wp-favorite-posts' ),
								'default'		=>	'Add to favorites',
								'attributes'	=>	array(
										'size'		=>	60,
								),
						),
						array(
								'field_id'      => 'added_show_remove_check_text',
								'title'         => __( 'Favorite added', 'admin-page-framework-loader' ),
								'content'       => array(
												array(
														'field_id'	=>	'added',
														'type'			=>	'text',
														'title'			=>	__( 'Favorite added text', 'wp-favorite-posts' ),
														'default'		=>	'Added to favorites!',
														'attributes'	=>	array(
																'size'		=>	60,
														),
												),
												array(
														'field_id'	=>	'show_remove_link',
														'type'			=>	'checkbox',
														'title'			=>	__( 'Show remove link?', 'wp-favorite-posts' ),
														'label'			=>	__( 'Enable', 'wp-favorite-posts' ),
														'default'		=>	true,
												),
								),
						),
						array(
								'field_id'	=>	'remove_favorite',
								'type'			=>	'text',
								'title'			=>	__( 'Remove from favorites link text', 'wp-favorite-posts' ),
								'default'		=>	'Remove from favorites',
								'attributes'	=>	array(
										'size'		=>	60,
								),
						),
						array(
								'field_id'      => 'removed_show_add_check_text',
								'title'         => __( 'Favorite removed', 'admin-page-framework-loader' ),
								'content'       => array(
												array(
														'field_id'	=>	'removed',
														'type'			=>	'text',
														'title'			=>	__( 'Favorite removed text', 'wp-favorite-posts' ),
														'default'		=>	'Removed from favorites!',
														'attributes'	=>	array(
																'size'		=>	60,
														),
												),
												array(
														'field_id'	=>	'show_add_link',
														'type'			=>	'checkbox',
														'title'			=>	__( 'Show add link?', 'wp-favorite-posts' ),
														'label'			=>	__( 'Enable', 'wp-favorite-posts' ),
														'default'		=>	true,
												),
								),
						),
						array(
								'field_id'	=>	'clear',
								'type'			=>	'text',
								'title'			=>	__( 'Clear all favorites link text', 'wp-favorite-posts' ),
								'default'		=>	'<p>Clear all favorites?</p>',
								'attributes'	=>	array(
										'size'		=>	60,
								),
						),
						array(
								'field_id'	=>	'cleared',
								'type'			=>	'text',
								'title'			=>	__( 'Favorites cleared text', 'wp-favorite-posts' ),
								'default'		=>	'<p>Favorites cleared!</p>',
								'attributes'	=>	array(
										'size'		=>	60,
								),
						),
						array(
								'field_id'	=>	'favorites_empty',
								'type'			=>	'textarea',
								'title'			=>	__( 'Favorites are empty text', 'wp-favorite-posts' ),
								'default'		=>	'<p>No favorites to show! Add some.</p>',
								'rich'		=>	true,
								'attributes'	=>	array(
										'rows'		=>	6,
										'cols'		=>	60,
								),
						),
						array(
								'field_id'	=>	'rem',
								'type'			=>	'text',
								'title'			=>	__( '[remove] link text', 'wp-favorite-posts' ),
								'description'	=>	'The text shown next to a favorited post to indicate the item can be removed from the favorites list.',
								'default'		=>	'remove',
								'attributes'	=>	array(
										'size'		=>	60,
								),
						),
						array(
								'field_id'	=>	'cookie_warning',
								'type'			=>	'textarea',
								'title'			=>	__( 'Favorites saved to cookies text', 'wp-favorite-posts' ),
								'default'		=>	'<p>Your favorite posts have been saved to your browsers cookies. If you clear cookies your list of favorite posts will be deleted also.<p>',
								'rich'		=>	true,
								'attributes'	=>	array(
										'rows'		=>	6,
										'cols'		=>	60,
								),
						),
						array(
								'field_id'	=>	'statistics_warning',
								'type'			=>	'textarea',
								'title'			=>	__( 'Statistics disabled text', 'wp-favorite-posts' ),
								'default'		=>	'<p>You must enable statistics from favorite posts <a href="plugins.php?page=wp_favorite_posts" title="Favorite Posts Configuration">configuration page</a>.</p>',
								'rich'		=>	true,
								'attributes'	=>	array(
										'rows'		=>	6,
										'cols'		=>	60,
								),
						),
						array(
								'field_id'	=>	'text_only_registered',
								'type'			=>	'textarea',
								'title'			=>	__( 'Registered users only text.', 'wp-favorite-posts' ),
								'default'		=>	'<p>Only registered users can create favorite lists. Please register then create a favorites list.</p>',
								'rich'		=>	true,
								'attributes'	=>	array(
										'rows'		=>	6,
										'cols'		=>	60,
								),
						),
						array(
								'field_id'	=>	'submit_button',
								'type'			=>	'submit',
								'title'			=>	__( 'Save Settings', 'wp-favorite-posts' ),
								'description'	=>	__( 'Save before you switch tabs.', 'wp-favorite-posts' ),
								'label'			=>	__( 'Save', 'wp-favorite-posts' ),
						) 

				);
				
				
				/* Dashboard Widget */

				$this->addSettingSections(
						array(
								'section_id'	=>	'dashboard_options',
								'page_slug'		=>	'wp_favorite_posts',
								'tab_slug'		=>	'dashboard',
								'title'				=>	__( 'Dashboard Options', 'wp-favorite-posts' ),
								'description'	=>	__( '<p>Configure the display of the dashboard widget.</p>', 'wp-favorite-posts' ),
								'order'				=>	'1',
						)
				);

				$this->addSettingFields(
						'dashboard_options',	// target section ID
						array(
								'field_id'	=> 'favorites_show',
								'type'			=> 'number',
								'title'			=>	__( 'Favorites to show', 'wp-favorite-posts' ),
								'description'	=>	__( 'Number of favorited post links to show.' ),
								'label_min_width'	=> '',
								'default'		=> 20,
								'attributes'	=> array(
										'style'	 => 'width: 80px',
								),
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
								'field_id'	=>	'thumbnail_default',
								'type'			=>	'image',
								'title'			=>	__( 'Add default image', 'wp-favorite-posts' ),
								'description'	=>	__( 'This image displays alongside posts that have no set feature image.', 'wp-favorite-posts' ),
								'attributes'	=>	array(
										'style'	=>	'max-width: 150px;',
								)
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
								'field_id'	=> 'thumbnail_width',
								'type'			=> 'number',
								'title'			=>	__( 'Thumbnail width (pixels)', 'wp-favorite-posts' ),
								'description'	=>	__( 'Set a preferred width for the thumbnail.' ),
								'label_min_width'	=> '',
								'default'		=> 35,
								'attributes'	=> array(
										'style'	 => 'width: 80px',
								),
						),
						array(
								'field_id'	=> 'thumbnail_height',
								'type'			=> 'number',
								'title'			=>	__( 'Thumbnail height (pixels)', 'wp-favorite-posts' ),
								'description'	=>	__( 'Set a preferred height for the thumbnail.' ),
								'label_min_width'	=> '',
								'default'		=> 35,
								'attributes'	=> array(
										'style'	 => 'width: 80px',
								),
						),
						array(
								'field_id'	=>	'submit_button',
								'type'			=>	'submit',
								'title'			=>	__( 'Save Settings', 'wp-favorite-posts' ),
								'description'	=>	__( 'Save before you switch tabs.', 'wp-favorite-posts' ),
								'label'			=>	__( 'Save', 'wp-favorite-posts' ),
						) 
				);
				
				/* Advanced */

				$this->addSettingSections(
						array(
								'section_id'	=>	'advanced_options',
								'page_slug'		=>	'wp_favorite_posts',
								'tab_slug'		=>	'advanced',
								'title'				=>	__( 'Advanced Options', 'wp-favorite-posts' ),
								'description'	=>	__( '<p>Other advanced settings that affect the performance of WP Favorite Posts.</p>', 'wp-favorite-posts' ),
								'order'				=>	'1',
						)
				);

				$this->addSettingFields(
						'advanced_options',	// target section ID
						array(
								'field_id'	=>	'dont_load_js_file',
								'type'			=>	'checkbox',
								'title'			=>	__( 'Disable the plugin\'s JS file', 'wp-favorite-posts' ),
								'label'			=>	__( 'Disable', 'wp-favorite-posts' ),
								'description'	=>	__( 'Select this option to stop the plugin loading its JS file. Could help to resolve JS conflicts. Disables ajax button text updates.', 'wp-favorite-posts' ),
								'default'		=>	false,
						),
						array(
								'field_id'	=>	'dont_load_css_file',
								'type'			=>	'checkbox',
								'title'			=>	__( 'Disable the plugin\'s CSS file', 'wp-favorite-posts' ),
								'label'			=>	__( 'Disable', 'wp-favorite-posts' ),
								'description'	=>	__( 'Select this option to stop the plugin loading its own CSS file. Could help to resolve CSS conflicts.', 'wp-favorite-posts' ),
								'default'		=>	false,
						),
						array(
								'field_id'	=>	'submit_button',
								'type'			=>	'submit',
								'title'			=>	__( 'Save Settings', 'wp-favorite-posts' ),
								'label'			=>	__( 'Save', 'wp-favorite-posts' ),
								'description'	=>	__( 'Save before you switch tabs.', 'wp-favorite-posts' ),
						),
            array(
                'field_id'      => 'submit_button_reset',
                'title'         => __( 'Reset All Settings', 'wp-favorite-posts' ),
								'label'			=>	__( 'Click to reset.', 'wp-favorite-posts' ),
                'type'          => 'submit',
                'value'         => __( 'Reset', 'wp-favorite-posts' ),
                'reset'         => true,
                'description'   => __( 'This resets all WP Favorite Post options. This will not reset individual post statistics.', 'wp-favorite-posts' ),
            ), 
						array(
								'field_id'	=>	'export_single',
								'type'			=>	'export',
								'title'			=>	__( 'Export Settings', 'wp-favorite-posts' ),
								'label'			=> __( 'Export settings', 'wp-favorite-posts' ),
								'description'	=>	__( 'Export settings to use in another installation of WP Favorite Posts.', 'wp-favorite-posts' ),
						),
						array(
								'field_id'	=>	'import_single',
								'type'			=>	'import',
								'title'			=>	__( 'Import Settings', 'wp-favorite-posts' ),
								'label'			=>	__( 'Import Settings', 'wp-favorite-posts' ),
								'description'	=>	__( 'Import settings from another installation of WP Favorite Posts.', 'wp-favorite-posts' ),
						)
				);

				/* Help */

				$this->addSettingSections(
						array(
								'section_id'	=>	'help_options',
								'page_slug'		=>	'wp_favorite_posts',
								'tab_slug'		=>	'help',
								'capability'	=>	'update_core',
								'title'				=>	__( 'Help and Debug Information', 'wp-favorite-posts' ),
								'description'	=>	__( '<p>Help links, useful information and system debug information. This is only visible to site administrators.</p><ol><li>Decide whether to show the Add to Favorites buttons automatically or manually. If manually you can use the shortcode <strong>[wpfp-link]</strong>.</li>Create a page and add the shortcode <strong>[wp-favorite-posts]</strong> to display the visitor his favorite posts.<li>You can show a list of all time favorite posts as collected over time by using the shortcode <strong>[wpfp-most number=\'5\']</strong></li><li>Visit <a href="https://github.com/vr51/wp-favorite-posts/" target="_blank">https://github.com/vr51/wp-favorite-posts</a> For help and support.</li><li>Send donations with <a href="https://paypal.me/vr51/" target="_blank">PayPal</a></li></ol>', 'wp-favorite-posts' ),
								'order'				=>	'1',
						)
				);
				
				// Get information about the current Admin Page Framework stored option values
				$optionKeyValues = $this->oDebug->get( get_option( 'WPFavoritePosts' ) );
				
				$this->addSettingFields(
						'help_options',	// target section ID
						array(
								'field_id'	=>	'system_information',
								'type'			=>	'system',
								'title'			=>	__( 'System Information', 'wp-favorite-posts' ),
								'data'			=>	array(
										'Custom Data'	=>	$optionKeyValues,
										// To remove items, set empty values
										'Current Time'          => '',
										'Admin Page Framework'  => '',
								),
								'save'          => false,
						)
				);

		}
		
}

new WPFavoritePosts;