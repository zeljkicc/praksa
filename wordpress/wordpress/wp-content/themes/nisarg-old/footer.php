<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Nisarg
 */
$mylocale = get_bloginfo('language');
?>

	</div><!-- #content -->
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row site-info">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
		        <div class="row">
			<?php echo '&copy; '.date("Y"); ?> 
			<span class="sep"> | </span>
			<?php// printf( esc_html__( 'Proudly Powered by ','nisarg')); ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nisarg' ) ); ?>">САНУ</a>
			</div> 
			</br>
			<?php
			if($mylocale == "sr-RS"){
			
echo "<div class='row' style='text-align:center'>Повежите се са нама:</div>";

}
else{
echo "<div class='row'>Connect with us:</div>";
} ?>
			<div class="row" style='margin-top:10px; margin-bottom:10px'>
					<?php the_social_links();?>
			</div>

			<a href="mailto:sasadir@sanu.ac.rs">sasadir@sanu.ac.rs</a>
			</div>
			<div class="col-md-4">
			
			
			
			</div>

		</div><!-- .site-info -->
		
			
			</br>
			<?php
			
			//var $mylocale = $locale;
			if($mylocale == "sr-RS"){
			
echo "<div class='row' style='text-align:center'>Српска академија наука и уметности - Кнез Михаилова 35 -
      11001 Београд - Србија</div>";

}
else{
echo "<div class='row' style='text-align:center'>Serbian Academy of Science and Arts</div>";
}

?>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
