<?php
/**
 * Comments Template
 *
 * @file           comments.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse

 * @version        Release: 1.2.6
 */
?>
<?php if (post_password_required()) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view any comments.', 'impulse-press'); ?></p>

	<?php return; } ?>


<?php if (comments_open()) : ?>

<?php
    $fields = array(
        'author' =>
            '<div class="form-group">' .
            '<label for="author"> '.  __('Name','impulse-press') .'</label>'.
            '<input type="text" class="form-control" id="author" name="author" placeholder="' . __('Enter Name','impulse-press').'">'.
            '</div>',
        'email' =>
                '<div class="form-group">'.
                '<label for="email">'.__('Email','impulse-press')  .'</label>'.
                '<input type="text" class="form-control" id="email" name="email" placeholder="'. __('Enter Email address','impulse-press') .'">'.
                '</div>',

    );

    $args = array(
        'id_form'           => 'commentform',
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field'  =>
                '<div class="form-group">'.
                '<label for="comment">'.__('Comment','impulse-press') . '</label>'.
                '<textarea class="form-control" id="comment" name="comment" rows="3" placeholder="'. __('Enter Comment','impulse-press') .'"></textarea>'.
                '</div>'
    );

    comment_form($args);
?>




<?php endif; ?>

<?php if (have_comments()) : ?>
    <hr>
    <h6 id="comments"><?php comments_number(__('No Comments &#187;', 'impulse-press'), __('1 Comment &#187;', 'impulse-press'), __('% Comments &#187;', 'impulse-press')); ?> for <?php the_title(); ?></h6>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','impulse-press' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','impulse-press', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

    <ol class="commentlist">
        <?php wp_list_comments('avatar_size=60&type=comment'); ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','impulse-press' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','impulse-press', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

<?php else : ?>

<?php endif; ?>

<?php
if (!empty($comments_by_type['pings'])) : // let's seperate pings/trackbacks from comments
    $count = count($comments_by_type['pings']);
    ($count !== 1) ? $txt = __('Pings&#47;Trackbacks','impulse-press') : $txt = __('Pings&#47;Trackbacks','impulse-press');
?>

    <h6 id="pings"><?php echo $count . " " . $txt; ?> <?php _e('for','impulse-press'); ?> "<?php the_title(); ?>"</h6>

    <ol class="commentlist">
        <?php wp_list_comments('type=pings&max_depth=<em>'); ?>
    </ol>


<?php endif; ?>


