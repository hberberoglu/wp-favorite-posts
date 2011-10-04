<?php
echo "<ul>";
if ($favorite_post_ids):
    foreach ($favorite_post_ids as $post_id) {
        $p = get_post($post_id);
        echo "<li>";
        echo "<a href='".get_permalink($post_id)."' title='". $p->post_title ."'>" . $p->post_title . "</a> ";
        echo "</li>";
    }
else:
    echo "<li>";
    echo "Your favorites will be here.";
    echo "</li>";
endif;
echo "</ul>";
?>
