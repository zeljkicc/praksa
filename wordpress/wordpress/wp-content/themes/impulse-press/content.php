<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

    <?php echo impulse_press_breadcrumb_lists(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
            <?php endif; ?>

            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'impulse-press') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
        </div><!-- .entry-content -->


        <footer class="entry-meta">
            <?php edit_post_link( __( 'Edit', 'impulse-press' ), '<span class="edit-link">', '</span>' ); ?>
        </footer><!-- .entry-meta -->

         <?php if (get_the_author_meta('description') != '') : ?>

        <h3 class="post-title"><?php echo __( 'Author:', 'impulse-press'); the_author_posts_link(); ?></h3>

        <div class="author-wrap spacer10">
            <div id="author-avata spacer10r">
                <?php echo get_avatar(get_the_author_meta('email'), '80');?></div>
            <div class="author-info spacer10">
                <?php the_author_meta('description') ?></div>
        </div><!-- end of #author-meta -->

        <?php endif; // no description, no author's meta ?>
         <?php if (comments_open()) : ?>
             <?php comments_template( '', true ); ?>
        <?php endif; ?>

    </article><!-- #post -->

<?php endwhile; ?>