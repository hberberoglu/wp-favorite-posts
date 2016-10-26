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

    if ($wpfp_before):
        echo '<div class="wpfp-page-before">'.$wpfp_before.'</div>';
    endif;

    if ($favorite_post_ids) {
	$favorite_post_ids = array_reverse($favorite_post_ids);
        $post_per_page = wpfp_get_option("post_per_page");
        $page = intval(get_query_var('paged'));

	$thumbnail_show = wpfp_get_option('thumbnail_show');
	$thumbnail_default = wpfp_get_option('thumbnail_default');
	$thumbnail_alignment = wpfp_get_option('thumbnail_alignment');
	$thumbnail_width = wpfp_get_option('thumbnail_width');
	$thumbnail_height = wpfp_get_option('thumbnail_height');

        $qry = array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page);
        // custom post type support can easily be added with a line of code like below.
        // $qry['post_type'] = array('post','page');
        query_posts($qry);
        
        echo "<ul>";
        while ( have_posts() ) : the_post();
	    if ( $thumbnail_show == '1' && has_post_thumbnail() ) {
              $thumbnail = get_the_post_thumbnail( get_the_ID(), array( "$thumbnail_width", "$thumbnail_height" ), array( 'class' => "$thumbnail_alignment" ) );
            } else {
              $thumbnail = '<img src="' . $thumbnail_default . '" class="' . $thumbnail_alignment . '" style="width:' .$thumbnail_width. ';height="' .$thumbnail_height. '" />';
            }
	    if ( $thumbnail_show == '0' ) {
	      $thumbnail = '';
	    }
            echo "<li style='display:block;width:90%;'><a href='".get_permalink()."' title='". get_the_title() ."'>$thumbnail " . get_the_title() . "</a> ";
            wpfp_remove_favorite_link(get_the_ID());
            echo "</li>";
        endwhile;
        echo "</ul>";

        echo '<div class="navigation">';
            if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
            <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
            <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
            <?php }
        echo '</div>';

        wp_reset_query();
    } else {
        $wpfp_options = wpfp_get_options();
        echo "<ul><li>";
        echo $wpfp_options['favorites_empty'];
        echo "</li></ul>";
    }

    echo '<p>'.wpfp_clear_list_link().'</p>';
    echo "</div>";
    wpfp_cookie_warning();
