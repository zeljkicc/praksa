<?php

/**

 * The header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="content">

 *

 * @package Nisarg

 */



?>

<!DOCTYPE html>



<!--[if IE 8]>

<html id="ie8" <?php language_attributes(); ?>>

<![endif]-->

<!--[if !(IE 8) ]><!-->

<html <?php language_attributes(); ?>>

<!--<![endif]-->



<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width" />



<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />



<?php wp_head(); ?>

</head>

 

<body <?php body_class(); ?>>



<!--

<div class="site-header row">

	<div class="col-md-3">

      <img src="http://proba878.net16.net/wordpress/wordpress/wp-content/uploads/2016/05/SANU-logo.png"  title="SANU-logo" width="50px" height="50px"  />

     </div>

	 <div class="site-branding col-md-6" style="text-align:center">   

        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

          <p class="site-title"><?php bloginfo( 'name' ); ?></p>

          <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

        </a>

      </div><!--.site-branding-->

	<!--  <div class="col-md-3">

      <img src="http://proba878.net16.net/wordpress/wordpress/wp-content/uploads/2016/05/SANU-logo.png"  title="SANU-logo" width="50px" height="50px"  />

     </div>

 </div> <!--.site-header-->

  

<div id="page" class="hfeed site">



<div class="site-header" style="margin-right:0px; margin-left:0px;">

<div class="row">
	<div class="col-sm-2" style="text-align:right; padding-top:30px; padding-right:0px">

      <img src="http://localhost:10000/wordpress/wordpress/wp-content/uploads/2016/04/2016JubilejSANU_logo.jpg"  title="SANU-logo" width="150px" height="150px"  />

     </div>
	 <div class="col-sm-3" >

	 <div class=" site-branding " style="text-align:left; margin-top:75px">   

        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		
		<img src="http://localhost:10000/wordpress/wordpress/wp-content/uploads/2016/05/imageedit_6_5186119098.png" width="50px"/>

          <p class="site-title" style="font-family:'Times New Roman', Times, serif; color:#8A0808; font-weight: normal; font-size: 25px;"><?php bloginfo( 'name' ); ?></p>

          <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

		  
        </a> 

      </div><!--.site-branding-->
	  
	 </div>  
	  
	 <div class="col-sm-7" style="padding-left:0px">
	<!--	<img src='http://localhost:10000/wordpress/wordpress/wp-content/uploads/2016/05/SANUHeader.jpg' />  -->
			<div  style="background-image:url('http://localhost:10000/wordpress/wordpress/wp-content/uploads/2016/05/SANUHeader.jpg'); background-repeat:no-repeat; height:200px; text-align:right" >
				<div class="row">
				<div class="col-md-7">
				
				</div>
				<div class="col-md-5" style="padding-top:10px">
			
			<div class="col-sm-2">
			
			</div>
			<div class="col-sm-8" style="padding-right:0px">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				</div>
				
			<div class="col-sm-2" style="padding-top:7px">
				<?php pll_the_languages(array('show_flags'=>1, 'show_names'=>0, 'hide_current'=>1)); ?>
				</div>
				
				
				
				</div>
				
				</div>
				
				
			</div>
	   
	   </div>
	  
	<!--  <div class="col-sm-2">

		<div class="row " style="margin-top:15px">
		<div class="col-sm-8">
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>
	   </div>
	  
	  <div class="col-sm-4">
	  <?php pll_the_languages(array('show_flags'=>1, 'show_names'=>0, 'hide_current'=>1)); ?>
	</div>
	  
	  </div>
	  
     </div> -->

	 </div>
 </div> <!--.site-header-->


 

  

<header id="masthead"  role="banner">







  

<!--navbar-fixed-top navbar-left-->

    <nav class="navbar navbar-default  " role="navigation"> 

	

	    



      <!-- Brand and toggle get grouped for better mobile display --> 

      <div class="container" id="navigation_menu">

        <div class="navbar-header"> 

          <?php if ( has_nav_menu( 'primary' ) ) { ?>

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 

            <span class="sr-only">Toggle navigation</span> 

            <span class="icon-bar"></span> 

            <span class="icon-bar"></span> 

            <span class="icon-bar"></span> 

          </button> 

          <?php } ?>

           <!--<a class="navbar-brand" href="<?php echo esc_url( home_url('/'));?>"><?php bloginfo('name')?></a> -->

        </div> 

        



          <?php if ( has_nav_menu( 'primary' ) ) {

              nisarg_header_menu(); // main navigation 

            }

          ?>

        

      </div><!--#container-->

    </nav>

 



  <!-- <div id="cc_spacer"></div><!-- used to clear fixed navigation by the themes js --> 

  

 



   

  

  

  <!--carousel-->

  <!-- <br/> 

   <br/> -->

   

  <?php 

  

  if(is_page('2') || is_page('99')){

  ?> <br/> 

   <br/>

  <?php

  echo do_shortcode('[wonderplugin_slider id="1"]'); ?>

  <br/>
	 <?php }

	?>

  

  <br/>

   <br/>

                   <!--/carousel-->

  

  

  

</header>    



<div id="content" class="site-content" style="background-image:url('http://localhost:10000/wordpress/wordpress/wp-content/uploads/2016/05/White-Paper-Texture-Background-520x390.jpg');">

    

    

    