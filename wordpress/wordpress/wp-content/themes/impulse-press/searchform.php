<?php
/**
 * Search Form Template
 *
 *
 * @file           searchform.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @version        Release: 1.2.6
 */
?>
	<form method="get" class="form-search" action="<?php echo esc_url( home_url() ); ?>">
		<div class="row">
			<div class="col-lg-12">
				<div class="input-group">
		<input type="text" class="form-control search-query" name="s" placeholder="<?php esc_attr_e('search here &hellip;', 'impulse-press'); ?>" />
		<span class="input-group-btn">
		<button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="<?php esc_attr_e('Go', 'impulse-press'); ?>"><?php echo __( 'Search', 'impulse-press');?></button>
		</span>
	</div>
</div>
	</form>