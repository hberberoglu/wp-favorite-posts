<?php
    echo "<div class='wpfp-span'>";
    if (!empty($user)):
        if (!wpfp_is_user_favlist_public($user)):
            echo "$user's Favorite Posts.";
        else:
            echo "$user's list is not public.";
        endif;
    endif;

    if ($wpfp_before):
        echo "<p>".$wpfp_before."</p>";
    endif;

    echo "<ul>";
    if ($favorite_post_ids):
        foreach ($favorite_post_ids as $post_id) {
            $p = get_post($post_id);
            echo "<li>";
            echo "<a href='".get_permalink($post_id)."' title='". $p->post_title ."'>" . $p->post_title . "</a> ";
            wpfp_remove_favorite_link($post_id);
            echo "</li>";
        }
    else:
        echo "<li>";
        echo $wpfp_options['favorites_empty'];
        echo "</li>";
    endif;
    echo "</ul>";
    wpfp_clear_list_link();
    echo "</div>";
    wpfp_cookie_warning();
?>
