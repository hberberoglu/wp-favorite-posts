<?php
/*
Plugin Name: WP Favorite Posts
Plugin URI: https://github.com/vr51/wp-favorite-posts
Description: Let users add posts to personal favorite lists. Registered users can keep lists permanently. Unregistered users can keep lists for their session lifetime. Display favorite buttons automatically above or below posts, or add manually. Show the favorites list in a page that includes the shortcode <code>[wp-favorite-posts]</code>. View total stats in dashboard widget. See readme for version details.
Version: 2.1.2
Stable tag: 2.1.2
Requires at least: 3.5
Tested up to: 4.7.3
Author: leehodson
Contributors: Huseyin Berberoglu,leehodson
Author URI: https://github.com/vr51

*/

/*
    Copyright (c) 2009 Hüseyin Berberoğlu (hberberoglu@gmail.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

define('WPFP_PATH', plugins_url( '', __FILE__ ) );
define('WPFP_META_KEY', "wpfp_favorites");
define('WPFP_USER_OPTION_KEY', "wpfp_useroptions");
define('WPFP_COOKIE_KEY', "wp-favorite-posts");

// manage default privacy of users favorite post lists by adding this constant to wp-config.php
if ( !defined( 'WPFP_DEFAULT_PRIVACY_SETTING' ) )
    define( 'WPFP_DEFAULT_PRIVACY_SETTING', false );

$ajax_mode = 1;

function wpfp_load_translation() {
    load_plugin_textdomain(
        "wp-favorite-posts",
        false,
        realpath(dirname(__FILE__)) . '/lang'
    );
}

add_action( 'plugins_loaded', 'wpfp_load_translation' );

function wp_favorite_posts() {
    if (isset($_REQUEST['wpfpaction'])) {
        global $ajax_mode;
        $ajax_mode = isset($_REQUEST['ajax']) ? $_REQUEST['ajax'] : false;
        if ($_REQUEST['wpfpaction'] == 'add') {
            wpfp_add_favorite();
        } else if ($_REQUEST['wpfpaction'] == 'remove') {
            wpfp_remove_favorite();
        } else if ($_REQUEST['wpfpaction'] == 'clear') {
						$cleared = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'cleared' ), 'default' );
            if (wpfp_clear_favorites()) wpfp_die_or_go( $cleared );
            else wpfp_die_or_go("ERROR");
        }
    }
}
add_action('wp_loaded', 'wp_favorite_posts');

function wpfp_add_favorite($post_id = "") {

		$registered = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'general_options', 'opt_only_registered' ), 'default' );
		$registeredText = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'text_only_registered' ), 'default' );
		$statistics = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'advanced_options', 'statistics' ), 'default' );
		$added = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'added' ), 'default' );
		$show_remove_link = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'show_remove_link' ), 'default' );
		
    if ( empty($post_id) ) $post_id = $_REQUEST['postid'];
    
    if ( $registered && !is_user_logged_in() ) {
        wpfp_die_or_go( $registeredText );
        return false;
    }

    if (wpfp_do_add_to_list($post_id)) {
        // added, now?
        do_action('wpfp_after_add', $post_id);
        if ( $statistics ) wpfp_update_post_meta($post_id, 1);
        if ( $show_remove_link ) {
            $str = wpfp_link(1, "remove", 0, array( 'post_id' => $post_id ) );
            wpfp_die_or_go($str);
        } else {
            wpfp_die_or_go( $added );
        }
    }
}

function wpfp_do_add_to_list($post_id) {
    if (wpfp_check_favorited($post_id))
        return false;
    if (is_user_logged_in()) {
        return wpfp_add_to_usermeta($post_id);
    } else {
        return wpfp_set_cookie($post_id, "added");
    }
}

function wpfp_remove_favorite($post_id = "") {

		$statistics = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'advanced_options', 'statistics' ), 'default' );
		$removed = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'removed' ), 'default' );
		$show_add_link = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'show_add_link' ), 'default' );
		
    if (empty($post_id)) $post_id = $_REQUEST['postid'];
    if (wpfp_do_remove_favorite($post_id)) {
        // removed, now?
        do_action('wpfp_after_remove', $post_id);
        if ( $statistics ) wpfp_update_post_meta($post_id, -1);
        if ( $show_add_link ) {
            if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 1 ):
                $str = '';
            else:
                $str = wpfp_link(1, "add", 0, array( 'post_id' => $post_id ) );
            endif;
            wpfp_die_or_go($str);
        } else {
            wpfp_die_or_go( $removed );
        }
    }
    else return false;
}

function wpfp_die_or_go($str) {
    global $ajax_mode;
    if ($ajax_mode):
        die($str);
    else:
        wp_redirect($_SERVER['HTTP_REFERER']);
    endif;
}

function wpfp_add_to_usermeta($post_id) {
    $wpfp_favorites = wpfp_get_user_meta();
    $wpfp_favorites[] = $post_id;
    wpfp_update_user_meta($wpfp_favorites);
    return true;
}

function wpfp_check_favorited($cid) {
    if (is_user_logged_in()) {
        $favorite_post_ids = wpfp_get_user_meta();
        if ($favorite_post_ids)
            foreach ($favorite_post_ids as $fpost_id)
                if ($fpost_id == $cid) return true;
	} else {
	    if (wpfp_get_cookie()) {
	        foreach (wpfp_get_cookie() as $fpost_id => $val)
	            if ($fpost_id == $cid) return true;
	    }
	}
    return false;
}

function wpfp_link( $return = 0, $action = "", $show_span = 1, $args = array() ) {

		$remove = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'remove_favorite' ), 'default' );
		$add = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'add_favorite' ), 'default' );

    global $post;
    $post_id = &$post->ID;
    extract($args);
    $str = "";
		$loadingImage = wpfp_loading_img();
		$beforeLinkImage = wpfp_before_link_img();
		
    if ($show_span) {
				$str = "<span class='wpfp-span'>";
		}
    if ($action == "remove") {
        $str .= wpfp_link_html($post_id, $remove, "remove");
    } elseif ($action == "add") {
        $str .= $loadingImage . $beforeLinkImage . wpfp_link_html($post_id, $add, "add");
    } elseif (wpfp_check_favorited($post_id)) {
        $str .= $loadingImage . $beforeLinkImage . wpfp_link_html($post_id, $remove, "remove");
    } else {
        $str .= $loadingImage . $beforeLinkImage . wpfp_link_html($post_id, $add, "add");
    }
    if ($show_span) {
        $str .= "</span>";
		}
    if ($return) { return $str; } else { echo $str; }
}

function wpfp_link_html($post_id, $opt, $action, $title = null) {
    $title = $title === null ? trim(esc_attr(wp_strip_all_tags($opt, true))) : $title;
    $link = "<a class='wpfp-link' href='?wpfpaction=".$action."&amp;postid=". esc_attr($post_id) . "' title='". $title ."' rel='nofollow'>". $opt ."</a>";
    $link = apply_filters( 'wpfp_link_html', $link );
    return $link;
}

function wpfp_get_users_favorites($user = "") {
    $favorite_post_ids = array();

    if (!empty($user)) {
        return wpfp_get_user_meta($user);
    }

    # collect favorites from cookie and if user is logged in from database.
    if (is_user_logged_in()) {
        $favorite_post_ids = wpfp_get_user_meta();
		} else {
	    if (wpfp_get_cookie()) {
	        foreach (wpfp_get_cookie() as $post_id => $post_title) {
	            array_push($favorite_post_ids, $post_id);
	        }
			}
		}

    return $favorite_post_ids;
}

function wpfp_list_favorite_posts( $args = array() ) {
    $user = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
    extract($args);
    global $favorite_post_ids;
    if ( !empty($user) ) {
        if ( wpfp_is_user_favlist_public($user) )
            $favorite_post_ids = wpfp_get_users_favorites($user);

    } else {
        $favorite_post_ids = wpfp_get_users_favorites();
    }

	if ( @file_exists(TEMPLATEPATH.'/wpfp-page-template.php') || @file_exists(STYLESHEETPATH.'/wpfp-page-template.php') ) {
			if(@file_exists(TEMPLATEPATH.'/wpfp-page-template.php')) {
					include(TEMPLATEPATH.'/wpfp-page-template.php');
			} else {
					include(STYLESHEETPATH.'/wpfp-page-template.php');
			}
	} else {
			include( realpath(dirname(__FILE__)) . "/templates/wpfp-page-template.php" );
	}
	
}

function wpfp_list_users_most_favorite_shortcode() {
	ob_start();
		wpfp_list_favorite_posts();
	return ob_get_clean();
}
add_shortcode('wp-favorite-posts', 'wpfp_list_users_most_favorite_shortcode');


// Display THE most favorited posts of all time.
function wpfp_list_most_favorited($limit=5) {

	if ( !is_admin() ) {
			if ( @file_exists(TEMPLATEPATH.'/wpfp-most-favorited-template.php') || @file_exists(STYLESHEETPATH.'/wpfp-most-favorited-template.php') ) {
					if(@file_exists(TEMPLATEPATH.'/wpfp-most-favorited-template.php')) {
							include(TEMPLATEPATH.'/wpfp-most-favorited-template.php');
					} else {
							include(STYLESHEETPATH.'/wpfp-most-favorited-template.php');
					}
			} else {
					include( realpath(dirname(__FILE__)) . "/templates/wpfp-most-favorited-template.php" );
			}
		} else {
			if ( @file_exists(TEMPLATEPATH.'/wpfp-most-favorited-dashboard-widget-template.php') || @file_exists(STYLESHEETPATH.'/wpfp-most-favorited-dashboard-widget-template.php') ) {
					if(@file_exists(TEMPLATEPATH.'/wpfp-most-favorited-dashboard-widget-template.php')) {
							include(TEMPLATEPATH.'/wpfp-most-favorited-dashboard-widget-template.php');
					} else {
							include(STYLESHEETPATH.'/wpfp-most-favorited-dashboard-widget-template.php');
					}
			} else {
					include( realpath(dirname(__FILE__)) . "/templates/wpfp-most-favorited-dashboard-widget-template.php" );
			}
		}
    
}
include_once( realpath(dirname(__FILE__)) . "/wpfp-admin-dashboard-widget.php" );

function wpfp_list_most_favorited_ever_shortcode( $atts ) {

	$atts = shortcode_atts(
				array(
						'number' => '5'
				), $atts
			);

	$number = sanitize_text_field($atts['number']);

	ob_start();
		wpfp_list_most_favorited("$number");
	return ob_get_clean();
	
}
add_shortcode('wpfp-most', 'wpfp_list_most_favorited_ever_shortcode');


include_once("wpfp-widgets.php");

function wpfp_loading_img() {
    return "<img src='".WPFP_PATH."/img/loading.gif' alt='Loading' title='Loading' class='wpfp-hide wpfp-img' />";
}

function wpfp_before_link_img() {

		$beforeImage = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'display_options', 'before_image' ), 'default' );
		$customImage = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'display_options', 'custom_before_image' ), 'default' );

    if ($beforeImage == '') {
        return "";
    } elseif ($beforeImage == 'custom') {
        return "<img src='" . $customImage . "' alt='Favorite' title='Favorite' class='wpfp-img' />";
    } else {
        return "<img src='". WPFP_PATH . "/img/" . $beforeImage . ".png' alt='Favorite' title='Favorite' class='wpfp-img' />";
    }
}

function wpfp_clear_favorites() {
    if (wpfp_get_cookie()) {
        foreach (wpfp_get_cookie() as $post_id => $val) {
            wpfp_set_cookie($post_id, "");
            wpfp_update_post_meta($post_id, -1);
        }
    }
    
    if (is_user_logged_in()) {
        $favorite_post_ids = wpfp_get_user_meta();
        if ($favorite_post_ids) {
            foreach ($favorite_post_ids as $post_id) {
                wpfp_update_post_meta($post_id, -1);
            }
        }
        if (!delete_user_meta(wpfp_get_user_id(), WPFP_META_KEY)) {
            return false;
        }
    }
    return true;
}

function wpfp_do_remove_favorite($post_id) {
    if (!wpfp_check_favorited($post_id)) {
        return true;
		}
		
    $a = true;
    if (is_user_logged_in()) {
        $user_favorites = wpfp_get_user_meta();
        $user_favorites = array_diff($user_favorites, array($post_id));
        $user_favorites = array_values($user_favorites);
        $a = wpfp_update_user_meta($user_favorites);
    }
    if ($a) $a = wpfp_set_cookie($_REQUEST['postid'], "");
    return $a;
}

function wpfp_content_filter($content) {

		$autoshow = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'display_options', 'autoshow' ), 'default' );

    if (is_page()) {
        if (strpos($content,'{{wp-favorite-posts}}')!== false) {
            $content = str_replace('{{wp-favorite-posts}}', wpfp_list_favorite_posts(), $content);
        }
    }

    if (strpos($content,'[wpfp-link]')!== false) {
        $content = str_replace('[wpfp-link]', wpfp_link(1), $content);
    }

    if (is_single()) {
        if ( $autoshow == 'before') {
            $content = '<div class="wpfp-link-wrap">' . wpfp_link(1) . '</div>' . $content;
        } elseif ( $autoshow == 'after') {
            $content .= '<div class="wpfp-link-wrap">' . wpfp_link(1) . '</div>';
        }
    }
    return $content;
}
add_filter('the_content','wpfp_content_filter');

function wpfp_add_js_script() {

	$disableJS = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'advanced_options', 'dont_load_js_file' ), 'default' );

	if ( !$disableJS ) {
		wp_enqueue_script( "wp-favorite-posts", WPFP_PATH . "/include/wpfp.js", array( 'jquery' ) );
	}
}
add_action('wp_print_scripts', 'wpfp_add_js_script');

function wpfp_wp_print_styles() {

	$disableCSS = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'advanced_options', 'dont_load_css_file' ), 'default' );

	if ( !$disableCSS ) {
		echo "<link rel='stylesheet' id='wpfp-css' href='" . WPFP_PATH . "/include/wpfp.css' type='text/css' />" . "\n";
	}
}
add_action('wp_print_styles', 'wpfp_wp_print_styles');



function wpfp_init() {
	// Activation code removed
}
register_activation_hook( __FILE__, 'wpfp_init' );

include_once('wpfp-admin.php');

function wpfp_update_user_meta($arr) {
    return update_user_meta(wpfp_get_user_id(),WPFP_META_KEY,$arr);
}

function wpfp_update_post_meta($post_id, $val) {
	$oldval = wpfp_get_post_meta($post_id);
	if ($val == -1 && $oldval == 0) {
    	$val = 0;
	} else {
		$val = $oldval + $val;
	}
    return add_post_meta($post_id, WPFP_META_KEY, $val, true) or update_post_meta($post_id, WPFP_META_KEY, $val);
}

function wpfp_delete_post_meta($post_id) {
    return delete_post_meta($post_id, WPFP_META_KEY);
}

function wpfp_get_cookie() {
    if (!isset($_COOKIE[WPFP_COOKIE_KEY])) return;
    return $_COOKIE[WPFP_COOKIE_KEY];
}

function wpfp_get_user_id() {
    global $current_user;
    wp_get_current_user();
    return $current_user->ID;
}

function wpfp_get_user_meta($user = "") {
    if (!empty($user)):
        $userdata = get_user_by( 'login', $user );
        $user_id = $userdata->ID;
        return get_user_meta($user_id, WPFP_META_KEY, true);
    else:
        return get_user_meta(wpfp_get_user_id(), WPFP_META_KEY, true);
    endif;
}

function wpfp_get_post_meta($post_id) {
    $val = get_post_meta($post_id, WPFP_META_KEY, true);
    if ($val < 0) $val = 0;
    return $val;
}

function wpfp_set_cookie($post_id, $str) {
    $expire = time()+60*60*24*30;
    return setcookie("wp-favorite-posts[$post_id]", $str, $expire, "/");
}

function wpfp_is_user_favlist_public($user) {
    $user_opts = wpfp_get_user_options($user);
    if (empty($user_opts)) return WPFP_DEFAULT_PRIVACY_SETTING;
    if ($user_opts["is_wpfp_list_public"])
        return true;
    else
        return false;
}

function wpfp_get_user_options($user) {
    $userdata = get_user_by( 'login', $user );
    $user_id = $userdata->ID;
    return get_user_meta($user_id, WPFP_USER_OPTION_KEY, true);
}

function wpfp_is_user_can_edit() {
    if (isset($_REQUEST['user']) && $_REQUEST['user'])
        return false;
    return true;
}

function wpfp_remove_favorite_link($post_id) {
    if (wpfp_is_user_can_edit()) {
        
        $rem = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'rem' ), 'default' );
        
        $class = 'wpfp-link remove-parent';
        $link = "<a id='rem_$post_id' class='$class' href='?wpfpaction=remove&amp;page=1&amp;postid=". $post_id ."' title='$rem' rel='nofollow'>$rem</a>";
        $link = apply_filters( 'wpfp_remove_favorite_link', $link );
        echo $link;
    }
}

function wpfp_clear_list_link() {

    if (wpfp_is_user_can_edit()) {
				$clear = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'clear' ), 'default' );
        echo "<a class='wpfp-link' href='?wpfpaction=clear' rel='nofollow'>" . wpfp_before_link_img() . "$clear</a>";
        echo wpfp_loading_img();
    }
}

function wpfp_cookie_warning() {
    if (!is_user_logged_in() && !isset($_GET['user']) ) {
				$cookieWarning = WPFavoritePostsAdminPageFramework::getOption( 'WPFavoritePosts', array( 'label_options', 'cookie_warning' ), 'default' );
        echo "$cookieWarning";
    }
}
