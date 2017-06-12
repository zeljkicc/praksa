<?php
/**
 * Home Template Large
 *
 * Template Name:  Home Page Large
 *
 * @file           home-large.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @version        Release: 1.2.6
 */

get_header(); ?>

    <?php if (!dynamic_sidebar('hero-large')) : ?>
        <div class="widget-title-home"><h3><?php _e('Hero Large', 'impulse-press'); ?></h3></div>
        <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Hero Large.', 'impulse-press'); ?></div>
    <?php endif;  ?>


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

     <div class="row">

       <div class="col-lg-12">
            <?php if (!dynamic_sidebar('home-featurette-1')) : ?>
                <div class="widget-title-home"><h3><?php _e('Home Featurette One', 'impulse-press'); ?></h3></div>
                <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Home Featurette One.', 'impulse-press'); ?></div>
			<?php endif;  ?>
       </div><!-- /.col-xs-4 -->
     </div><!-- /.row -->

    <div class="row">

       <div class="col-lg-12">
            <?php if (!dynamic_sidebar('home-featurette-2')) : ?>
                <div class="widget-title-home"><h3><?php _e('Home Featurette Two', 'impulse-press'); ?></h3></div>
                <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Home Featurette Teo.', 'impulse-press'); ?></div>
			<?php endif;  ?>
       </div><!-- /.col-xs-4 -->
     </div><!-- /.row -->

    <div class="row">
    <div class="col-lg-12">
            <?php if (!dynamic_sidebar('home-featurette-3')) : ?>
                <div class="widget-title-home"><h3><?php _e('Home Featurette Three', 'impulse-press'); ?></h3></div>
                <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Home Featurette Three.', 'impulse-press'); ?></div>
			<?php endif;  ?>
       </div><!-- /.col-xs-4 -->
     </div><!-- /.row -->

 </div>

<?php get_footer(); ?>