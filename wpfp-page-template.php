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

    echo "<ul>";
    if ($favorite_post_ids) {
		$favorite_post_ids = array_reverse($favorite_post_ids);
        $post_per_page = wpfp_get_option("post_per_page");
        $page = intval(get_query_var('paged'));

        $qry = array('post__in' => $favorite_post_ids, 'posts_per_page'=> $post_per_page, 'orderby' => 'post__in', 'paged' => $page);
        // custom post type support can easily be added with a line of code like below.
        // $qry['post_type'] = array('post','page');
        query_posts($qry);

        while ( have_posts() ) : the_post();
            echo "<li><a href='".get_permalink()."' title='". get_the_title() ."'>" . get_the_title() . "</a> ";
            wpfp_remove_favorite_link(get_the_ID());
            echo "</li>";
        endwhile;

        echo '<div class="navigation">';
            if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
            <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
            <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
            <?php }
        echo '</div>';

        wp_reset_query();
    } else {
        $wpfp_options = wpfp_get_options();
        echo "<li>";
        echo $wpfp_options['favorites_empty'];
        echo "</li>";
    }
    echo "</ul>";

    echo '<p>'.wpfp_clear_list_link().'</p>';
    echo "</div>";
    wpfp_cookie_warning();