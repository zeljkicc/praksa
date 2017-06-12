<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Nisarg
 */

get_header(); ?>

		
		

		<div class="container">		
            <div class="row">
				<div id="primary" class="col-md-9 content-area">
					<main id="main" class="site-main" role="main">

						<?php if ( have_posts() ) : ?>

						

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>									

								<?php							

									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_format() );
								?>

							<?php endwhile; ?>

							<?php nisarg_posts_navigation(); ?>

						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>																								

					</main><!-- #main -->
				</div><!-- #primary -->

	
										
				<?php get_sidebar('sidebar-1'); ?>		

			</div> <!--.row-->            
        </div><!--.container-->
        <?php get_footer(); ?>
