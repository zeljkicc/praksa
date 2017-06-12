<?php
/**
 * Archive Template
 *
 * @file           archive.php
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
                <h3 class="post-title">
                    <?php if (is_day()) : ?>
                    <?php printf(__('Daily Archives: %s', 'impulse-press'), '<span>' . get_the_date() . '</span>'); ?>
                    <?php elseif (is_month()) : ?>
                    <?php printf(__('Monthly Archives: %s', 'impulse-press'), '<span>' . get_the_date('F Y') . '</span>'); ?>
                    <?php  elseif (is_year()) : ?>
                    <?php printf(__('Yearly Archives: %s', 'impulse-press'), '<span>' . get_the_date('Y') . '</span>'); ?>
                    <?php  else : ?>
                    <?php _e('Blog Archives', 'impulse-press'); ?>
                    <?php endif; ?>
                </h3>

                <?php while (have_posts()) : the_post(); ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


                        <div class="post-entry">

                            <div class="post-image">
                                <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <?php endif; ?>

                            </div>
                            <!-- end of post-image -->

                            <div class="post-intro">
                                <h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"
                                                          title="<?php printf(__('Permanent Link to %s', 'impulse-press'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
                                </h3>


                                    <div class="post-meta">
                                        <?php
                                             printf(__('<i class="icon-time"></i> %2$s <i class="icon-user"></i> %3$s', 'impulse-press'), 'meta-prep meta-prep-author',
                                           sprintf('<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
                                                   get_permalink(),
                                                   esc_attr(get_the_time()),
                                                   get_the_date()
                                           ),
                                           sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                                                   get_author_posts_url(get_the_author_meta('ID')),
                                                   sprintf(esc_attr__('View all posts by %s', 'impulse-press'), get_the_author()),
                                                   get_the_author()
                                           )
                                         );
                                         ?>
                                                <?php if (comments_open()) : ?>
                                                <span class="comments-link">
                                                    <span class="mdash">&mdash;</span>
                                                                <?php comments_popup_link(__('No Comments <i class="icon-arrow-down"></i>', 'impulse-press'), __('1 Comment <i class="icon-arrow-down"></i>', 'impulse-press'), __('% Comments <i class="icon-arrow-down"></i>', 'impulse-press')); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                <!-- end of .post-meta -->


                                <div class="post-excerpt spacer10">
                                    <?php the_excerpt(); ?>
                                     <a href="<?php echo get_permalink(); ?>"><button type="button" class="readmore btn btn-default"><?php echo __('Read more...','impulse-press')?></button> </a>
                                 </div>


                            </div>
                            <!-- end of .post-entry -->

                        </div>


                        <div class="post-edit"><?php edit_post_link(__('Edit', 'impulse-press')); ?></div>
                    </div><!-- end of #post-<?php the_ID(); ?> -->


                <?php endwhile; ?>

                <?php if ($wp_query->max_num_pages > 1) : ?>
                    <div class="navigation">
                        <div class="previous"><?php next_posts_link(__('&#8249; Older posts', 'impulse-press')); ?></div>
                        <div class="next"><?php previous_posts_link(__('Newer posts &#8250;', 'impulse-press')); ?></div>
                    </div><!-- end of .navigation -->
                <?php endif; ?>



            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>