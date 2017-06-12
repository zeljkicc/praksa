<?php
/**
 * Single Posts Template
 *
 * @file           single.php
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

            <?php if (have_posts()) : ?>

                        <?php echo impulse_press_breadcrumb_lists(); ?>

            <?php while (have_posts()) : the_post(); ?>


                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="page-header">
                        <h3 class="post-title"><?php the_title(); ?></h3>
                    </div>
                    <div class="post-image">
                                    <?php if ( has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                              <?php the_post_thumbnail(); ?>
                                        </a>
                                    <?php endif; ?>
                     </div><!-- end of post-image -->

                            <div class="post-meta">
                                <?php
                                printf(__('<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'impulse-press'),
                                       esc_url(get_permalink()),
                                       esc_attr(get_the_time()),
                                       esc_attr(get_the_date('c')),
                                       esc_html(get_the_date()),
                                       esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                                       esc_attr(sprintf(__('View all posts by %s', 'impulse-press'), get_the_author())),
                                       get_the_author()
                                );
                                ?>

                                <?php if (comments_open()) : ?>
                                <span class="comments-link">
                                <span class="mdash">&mdash;</span>
                                    <?php comments_popup_link(__('No Comments', 'impulse-press'), __('1 Comment', 'impulse-press'), __('% Comments', 'impulse-press')); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- end of .post-meta -->

                    <div class="post-entry spacer10">
                        <?php the_content(__('Read more &#8250;', 'impulse-press')); ?>
                        <?php wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'impulse-press' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) );
                        ?>

                    </div>
                    <!-- end of .post-entry -->


                    <div class="post-data">
                        <?php the_tags(__('Tagged with:', 'impulse-press') . ' ', ' ', '<br />'); ?>
                    </div>
                    <!-- end of .post-data -->

                    <div class="post-edit"><?php edit_post_link(__('Edit', 'impulse-press')); ?></div>
                </div><!-- end of #post-<?php the_ID(); ?> -->

                <?php if (get_the_author_meta('description') != '') : ?>

                    <h3 class="post-title">Author: <?php the_author_posts_link(); ?></h3>

                    <div class="author-wrap spacer10">
                        <div id="author-avata spacer10r">
                            <?php
                            echo get_avatar(get_the_author_meta('email'), '80');?>
                        </div>
                        <div class="author-info spacer10">
                            <?php the_author_meta('description') ?></div>
                    </div><!-- end of #author-meta -->

                    <?php endif; // no description, no author's meta ?>
                     <?php if (comments_open()) : ?>
                         <?php comments_template( '', true ); ?>
                    <?php endif; ?>
                <?php endwhile; ?>

            <?php if ($wp_query->max_num_pages > 1) : ?>
                <div class="navigation">
                    <div class="previous"><?php next_posts_link(__('&#8249; Older posts', 'impulse-press')); ?></div>
                    <div class="next"><?php previous_posts_link(__('Newer posts &#8250;', 'impulse-press')); ?></div>
                </div><!-- end of .navigation -->
                <?php endif; ?>

            <?php else : ?>

            <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'impulse-press'); ?></h1>
            <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'impulse-press'); ?></p>
            <h6><?php _e('You can return', 'impulse-press'); ?> <a href="<?php echo esc_url( home_url() ); ?>/"
                                                                title="<?php esc_attr_e('Home', 'impulse-press'); ?>"><?php _e('&#9166; Home', 'impulse-press'); ?></a> <?php _e('or search for the page you were looking for', 'impulse-press'); ?>
            </h6>
            <?php get_search_form(); ?>

            <?php endif; ?>

        </div>
    </div>
</div>
<?php get_footer(); ?>