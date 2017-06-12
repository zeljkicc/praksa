<?php
/**
 * Home Template Simple
 *
 * Template Name:  Home Page Simple
 *
 * @file           home-simple.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @version        Release: 1.2.6
 */

get_header(); ?>
<div class="container">
<?php if (!dynamic_sidebar('hero-simple')) : ?>
    <div class="widget-title-home"><h3><?php _e('Hero Simple', 'impulse-press'); ?></h3></div>
    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Hero Simple.', 'impulse-press'); ?></div>
<?php endif;  ?>
</div>

<div class="container">

     <!-- Three columns of text below the carousel -->
     <div class="row">

       <div class="col-lg-4">
            <?php if (!dynamic_sidebar('main-1')) : ?>
                <div class="widget-title-home"><h3><?php _e('Main One', 'impulse-press'); ?></h3></div>
                <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main One.', 'impulse-press'); ?></div>
			<?php endif;  ?>
       </div><!-- /.col-xs-4 -->

       <div class="col-lg-4">
         <?php if (!dynamic_sidebar('main-2')) : ?>
                <div class="widget-title-home"><h3><?php _e('Main Two', 'impulse-press'); ?></h3></div>
                <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main Two.', 'impulse-press'); ?></div>
			<?php endif;  ?>
       </div><!-- /.col-xs-4 -->


       <div class="col-lg-4">
         <?php if (!dynamic_sidebar('main-3')) : ?>
                <div class="widget-title-home"><h3><?php _e('Main Three', 'impulse-press'); ?></h3></div>
                <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Main Three.', 'impulse-press'); ?></div>
			<?php endif;  ?>
       </div><!-- /.col-xs-4 -->
     </div><!-- /.row -->



 </div>

<?php get_footer(); ?>