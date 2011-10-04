<?php
$wpfp_options = get_option('wpfp_options');
if ( isset($_POST['submit']) ) {
	if ( function_exists('current_user_can') && !current_user_can('manage_options') )
		die(__('Cheatin&#8217; uh?'));
    if ($_POST['show_remove_link'] == 'show_remove_link') $_POST['added'] = 'show remove link';
    if ($_POST['show_add_link'] == 'show_add_link') $_POST['removed'] = 'show add link';
	$wpfp_options['add_favorite'] = htmlspecialchars($_POST['add_favorite']);
	$wpfp_options['added'] = htmlspecialchars($_POST['added']);
	$wpfp_options['remove_favorite'] = htmlspecialchars($_POST['remove_favorite']);
	$wpfp_options['removed'] = htmlspecialchars($_POST['removed']);
	$wpfp_options['clear'] = htmlspecialchars($_POST['clear']);
	$wpfp_options['cleared'] = htmlspecialchars($_POST['cleared']);
	$wpfp_options['favorites_empty'] = htmlspecialchars($_POST['favorites_empty']);
	$wpfp_options['rem'] = htmlspecialchars($_POST['rem']);
	$wpfp_options['cookie_warning'] = htmlspecialchars($_POST['cookie_warning']);
	$wpfp_options['opt_only_registered'] = htmlspecialchars($_POST['opt_only_registered']);
	$wpfp_options['text_only_registered'] = htmlspecialchars($_POST['text_only_registered']);
	$wpfp_options['statics'] = htmlspecialchars($_POST['statics']);
	$wpfp_options['before_image'] = htmlspecialchars($_POST['before_image']);
	$wpfp_options['custom_before_image'] = htmlspecialchars($_POST['custom_before_image']);

	update_option('wpfp_options', $wpfp_options);
}
?>
<?php if ( !empty($_POST ) ) : ?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
<?php screen_icon(); ?>
<h2><?php _e('Favorite Posts Configuration', 'wp-favorite-posts'); ?></h2>

<div class="metabox-holder" id="poststuff">
<div class="meta-box-sortables">
<script>
jQuery(document).ready(function($) { $('.postbox').children('h3, .handlediv').click(function(){ $(this).siblings('.inside').toggle();});});
</script>
<div class="postbox">
    <div title="<?php _e("Click to open/close", "wp-favorite-posts"); ?>" class="handlediv">
      <br>
    </div>
    <h3 class="hndle"><span><?php _e("Do you use it ?", "wp-favorite-posts"); ?></span></h3>
    <div class="inside" style="display: block;">
        <img src="../wp-content/plugins/wp-favorite-posts/img/icon_coffee.png" alt="buy me a coffee" style=" margin: 5px; float:left;" />
        <p>Hi! I'm <a href="http://nxsn.com?f=wpfp" target="_blank" title="Huseyin Berberoglu">Huseyin Berberoglu</a>, developer of this plugin.</p>
        <p>I've been spending many hours to develop this plugin. <br />If you like and use this plugin, you can <strong>buy me a cup of coffee</strong>.</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
            ">
            <input type="image" src="../wp-content/plugins/wp-favorite-posts/img/donate.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
        </form>
        <div style="clear:both;"></div>
    </div>
</div>
<form action="" method="post">


<div class="postbox">
    <div title="<?php _e("Click to open/close", "wp-favorite-posts"); ?>" class="handlediv">
      <br>
    </div>
    <h3 class="hndle"><span><?php _e("Options", "wp-favorite-posts"); ?></span></h3>
    <div class="inside" style="display: block;">

        <table class="form-table">
            <tr>
                <th><?php _e("Only <strong>registered users</strong> can favorite", "wp-favorite-posts") ?></th><td><input type="checkbox" name="opt_only_registered" value="1" <?php if (stripslashes($wpfp_options['opt_only_registered']) == "1") echo "checked='checked'"; ?> /></td>
            </tr>

            <tr>
                <th><?php _e("Before Link Image", "wp-favorite-posts") ?></th>
                <td>
                    <p>
                    <?php
                    $images[] = "star.png";
                    $images[] = "heart.png";
                    $images[] = "bullet_star.png";
                    foreach ($images as $img):
                    ?>
                    <label for="<?php echo $img ?>">
                        <input type="radio" name="before_image" id="<?php echo $img ?>" value="<?php echo $img ?>" <?php if ($wpfp_options['before_image'] == $img) echo "checked='checked'" ?> />
                        <img src="<?php echo WPFP_PATH; ?>/img/<?php echo $img; ?>" alt="<?php echo $img; ?>" title="<?php echo $img; ?>" class="wpfp-img" />
                    </label>
                    <br />
                    <?php
                    endforeach;
                    ?>
                    <label for="custom">
                        <input type="radio" name="before_image" id="custom" value="custom" <?php if ($wpfp_options['before_image'] == 'custom') echo "checked='checked'" ?> />
                        Custom Image URL :
                    </label>
                    <input type="custom_before_image" name="custom_before_image" value="<?php echo stripslashes($wpfp_options['custom_before_image']); ?>" />
                    <br />
                    <label for="none">
                        <input type="radio" name="before_image" id="none" value="" <?php if ($wpfp_options['before_image'] == '') echo "checked='checked'" ?> />
                        No Image
                    </label>
                </td>
            </tr>

            <tr>
                <th><?php _e("Most favorited posts statics", "wp-favorite-posts") ?>*</th>
                <td>
                    <label for="stats-enabled"><input type="radio" name="statics" id="stats-enabled" value="1" <?php if ($wpfp_options['statics']) echo "checked='checked'" ?> /> Enabled</label>
                    <label for="stats-disabled"><input type="radio" name="statics" id="stats-disabled" value="0" <?php if (!$wpfp_options['statics']) echo "checked='checked'" ?> /> Disabled</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>* If statics enabled plugin will count how much a post added to favorites.<br />
                        You can show this statics with <a href="widgets.php" title="Go to widgets">"Most Favorited Posts" widget</a>.</p>
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button" value="<?php _e('Update options &raquo;'); ?>" />
                </td>
            </tr>
        </table>

    </div>
</div>




<div class="postbox">
    <div title="" class="handlediv">
      <br>
    </div>
    <h3 class="hndle"><span><?php _e("Label Settings", "wp-favorite-posts") ?></span></h3>
    <div class="inside" style="display: block;">


        <table class="form-table">
            <tr>
                <th><?php _e("Text for add link", "wp-favorite-posts") ?></th><td><input type="text" name="add_favorite" value="<?php echo stripslashes($wpfp_options['add_favorite']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for added", "wp-favorite-posts") ?></th><td><input type="checkbox"  <?php if ($wpfp_options['added'] == 'show remove link') echo "checked='cheked'"; ?> name="show_remove_link" onclick="jQuery('#added').val(''); jQuery('#added').toggle();" value="show_remove_link" />Show remove link<br /><input id="added" type="text" name="added" <?php if ($wpfp_options['added'] == 'show remove link') echo "style='display:none;'"; ?> value="<?php echo stripslashes($wpfp_options['added']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for remove link", "wp-favorite-posts") ?></th><td><input type="text" name="remove_favorite" value="<?php echo stripslashes($wpfp_options['remove_favorite']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for removed", "wp-favorite-posts") ?></th><td><input type="checkbox" <?php if ($wpfp_options['removed'] == 'show add link') echo "checked='checked'"; ?> name="show_add_link" onclick="jQuery('#removed').val(''); jQuery('#removed').toggle();" value='show_add_link' />Show add link<br /><input id="removed" type="text" name="removed" <?php if ($wpfp_options['removed'] == 'show add link') echo "style='display:none;'"; ?> value="<?php echo stripslashes($wpfp_options['removed']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for clear link", "wp-favorite-posts") ?></th><td><input type="text" name="clear" value="<?php echo stripslashes($wpfp_options['clear']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for cleared", "wp-favorite-posts") ?></th><td><input type="text" name="cleared" value="<?php echo stripslashes($wpfp_options['cleared']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for favorites are empty", "wp-favorite-posts") ?></th><td><input type="text" name="favorites_empty" value="<?php echo stripslashes($wpfp_options['favorites_empty']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for [remove] link", "wp-favorite-posts") ?></th><td><input type="text" name="rem" value="<?php echo stripslashes($wpfp_options['rem']); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e("Text for favorites saved to cookies", "wp-favorite-posts") ?></th><td><textarea name="cookie_warning" rows="3" cols="35"><?php echo stripslashes($wpfp_options['cookie_warning']); ?></textarea></td>
            </tr>
            <tr>
                <th><?php _e("Text for \"only registered users can favorite\" error message", "wp-favorite-posts") ?></th><td><textarea name="text_only_registered" rows="2" cols="35"><?php echo stripslashes($wpfp_options['text_only_registered']); ?></textarea></td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" name="submit" class="button" value="<?php _e('Update options &raquo;'); ?>" />
                </td>
            </tr>

        </table>
    </div>
</div>
<div class="postbox">
    <div title="<?php _e("Click to open/close", "wp-favorite-posts"); ?>" class="handlediv">
      <br>
    </div>
    <h3 class="hndle"><span><?php _e('Help', 'wp-favorite-posts'); ?></span></h3>
    <div class="inside" style="display: block;">
        If you need help you can go <a href="http://nxsn.com/my-projects/wp-favorite-posts-plugin/" target="_blank">plugin's page</a>.
    </div>
</div>
</form>
</div>
</div>
