<?php
/**
 * Template part for displaying posts.
 *
 * @package Nisarg
 */

?>

<article id="post-<?php the_ID(); ?>"  <?php post_class('post-content'); ?>>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'nisarg' ) );
	} ?>

	<?php nisarg_featured_image_disaplay(); ?>
	
	<header class="entry-header">	
	
		<span class="screen-reader-text"><?php the_title();?> ?></span>

		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		<?php endif; // is_single() ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<h5 class="entry-date"><?php nisarg_posted_on(); ?></h5>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	
		<?php if ( is_search() || is_home() || is_archive() || is_author()) : // Only display Excerpts for Search ?>
		    <div class="entry-summary">
		        <?php the_excerpt(); ?>
		    </div><!-- .entry-summary -->
		 

    	<?php else : ?>
    		<div class="entry-content">
				<?php
					the_content();
	
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nisarg' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php endif; ?>


	<footer class="entry-footer">
		<?php nisarg_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
