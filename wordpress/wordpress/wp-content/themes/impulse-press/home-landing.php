<?php
/**
 * Home Template Landing
 *
 * Template Name:  Home Page Landing 
 *
 * @file           home-landing.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */

get_header(); ?>

<style type="text/css">
    .back-img-fullscreen {
        background: url(<?php echo impulse_page_options($post->ID, 'ip_home_landing_background');?>) no-repeat scroll center center / cover rgba(0, 0, 0, 0);
    }
</style>

<div class="back-img-fullscreen"></div>

<div class="covering">
    <div class="slogan-center">
        <?php if (!dynamic_sidebar('hero-landing')) : ?>
            <div class="widget-title-home"><h3><?php _e('Hero Landing', 'impulse-press'); ?></h3></div>
            <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Hero Landing.', 'impulse-press'); ?></div>
        <?php endif;  ?>
    </div>
</div>


<div class="content-scroll">
<a class="scroll-button" href="#"><?php _e('Scroll down <i class="fa fa-angle-down fa-2x"></i> to discover', 'impulse-press'); ?></a>
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

    <div class="container">

        <!-- START THE FEATURETTES -->
        <div class="row">
            <div class="col-lg-12">
                <?php if (!dynamic_sidebar('featurette-1')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Featurette One', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette One.', 'impulse-press'); ?></div>
                <?php endif;  ?>

                <?php if (!dynamic_sidebar('featurette-2')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Featurette Two', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette Two.', 'impulse-press'); ?></div>
                <?php endif;  ?>

                <?php if (!dynamic_sidebar('featurette-3')) : ?>
                    <div class="widget-title-home"><h3><?php _e('Featurette Three', 'impulse-press'); ?></h3></div>
                    <div class="textwidget"><?php _e('To edit please go to Appearance > Widgets and choose Featurette Three.', 'impulse-press'); ?></div>
                <?php endif;  ?>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->


        <!-- /END THE FEATURETTES -->
    </div><!--end Container-->

     
</div>

<?php wp_footer(); ?>

