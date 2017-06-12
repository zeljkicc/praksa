<?php
/**
 * Page Sidebar Left Template
 *
 * Template Name:  Page Sidebar Left
 *
 * @file           page-sidebar-left.php
 * @package        ImpulsePress
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @version        Release: 1.2.6
 */

get_header(); ?>

<div class="container">

	<div class="row">
    
    	<div class="col-lg-3">
          	<div id="widgets" class="well">
                <?php if (!dynamic_sidebar('sidebar-left')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Sidebar Left', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Sidebar Left.', 'impulse-press'); ?></div>
                <?php endif;  ?>
            </div>
        </div><!-- end of col-lg-3 -->

        <div class="col-lg-9">
		    <?php get_template_part('content'); ?>
        </div><!-- end of #col-lg-9 -->

          
        
	</div><!-- end of row -->
    
</div><!-- end of container -->
<?php get_footer(); ?>