<?php
/**
 * Error 404 Template
 *
 *
 * @file           404.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse

 * @version        Release: 1.2.6
 */
?>
<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div id="content-full">
                <div id="post-0" class="error404">
                    <div class="post-entry">
                        <h1 class="title-404"><?php _e('404 &#8212; Whoopsie!', 'impulse-press'); ?></h1>
                        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'impulse-press'); ?></p>
                        <h6><?php _e( 'You can return', 'impulse-press' ); ?> <a href="<?php echo esc_url( home_url() ); ?>/" title="<?php esc_attr_e( 'Home', 'impulse-press' ); ?>"><?php _e( '&larr; Home', 'impulse-press' ); ?></a> <?php _e( 'or search for the page you were looking for', 'impulse-press' ); ?></h6>
                        <?php get_search_form(); ?>
                    </div><!-- end of .post-entry -->
                </div><!-- end of #post-0 -->
            </div><!-- end of #content-full -->
        </div>
    </div>
</div>
<?php get_footer(); ?>