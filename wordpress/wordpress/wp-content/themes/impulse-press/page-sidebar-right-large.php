<?php
/**
 * Page Sidebar Right Large Template
 *
 * Template Name:  Page Sidebar Right Large
 *
 * @file           page-sidebar-right-large.php
 * @package        ImpulsePress
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @version        Release: 1.2.6
 */

get_header(); ?>

<div class="container">

	<div class="row">
        
        <div class="col-lg-8">
            <?php get_template_part('content'); ?>
        </div><!-- end of #col-lg-9 -->

        <div class="col-lg-4">
            <div id="widgets" class="well">
                <?php if (!dynamic_sidebar('sidebar-right')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Sidebar Right', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Sidebar Right.', 'impulse-press'); ?></div>
                <?php endif;  ?>
            </div>
        </div><!-- end of col-lg-3 -->
        
	</div><!-- end of row -->
    
</div><!-- end of container -->
<?php get_footer(); ?>