<?php		

$baseUrl  = $this->baseUrl;	

$l10n = array(
	'confirm_and_run'    => __('Confirm & Run Export', 'wp_all_export_plugin'),
	'save_configuration' => __('Save Export Configuration', 'wp_all_export_plugin')	
);

?>
<script type="text/javascript">	
	var wp_all_export_L10n = <?php echo json_encode($l10n); ?>;
</script>


<div class="wpallexport-step-4 wpallexport-re-run-export">
	
	<h2 class="wpallexport-wp-notices"></h2>

	<div class="wpallexport-wrapper">
		<h2 class="wpallexport-wp-notices"></h2>
		<div class="wpallexport-header">
			<div class="wpallexport-logo"></div>
			<div class="wpallexport-title">
				<p><?php _e('WP All Export', 'wp_all_export_plugin'); ?></p>
				<h2><?php _e('Export to XML / CSV', 'wp_all_export_plugin'); ?></h2>					
			</div>
			<div class="wpallexport-links">
				<a href="http://www.wpallimport.com/support/" target="_blank"><?php _e('Support', 'wp_all_export_plugin'); ?></a> | <a href="http://www.wpallimport.com/documentation/" target="_blank"><?php _e('Documentation', 'wp_all_export_plugin'); ?></a>
			</div>
		</div>	
		<div class="clear"></div>		
	</div>			

	<table class="wpallexport-layout">
		<tr>
			<td class="left" style="width: 100%;">		
	
				<?php do_action('pmxe_options_header', $isWizard, $post); ?>
				
				<div class="ajax-console">					
					<?php if ($this->errors->get_error_codes()): ?>
						<?php $this->error() ?>
					<?php endif ?>					
				</div>														

				<div class="wpallexport-content-section" style="padding: 0 30px 0 0; overflow: hidden; margin-bottom: 0;">

					<div id="filtering_result" class="wpallexport-ready-to-go <?php if (empty(PMXE_Plugin::$session->found_posts)):?>nothing_to_export<?php endif;?>">																		
						<?php if (empty(PMXE_Plugin::$session->found_posts)):?>
						<h3><?php _e('Nothing to export.', 'wp_all_export_plugin'); ?></h3>
						<h4><?php printf(__("No matching %s found for selected filter rules.", "wp_all_export_plugin"), wp_all_export_get_cpt_name($post['cpt'])); ?></h4>
						<?php else: ?>
						<h3><?php _e('Your export is ready to run.', 'wp_all_export_plugin'); ?></h3>							
						<h4><?php printf(__('WP All Export will export %d %s.'), PMXE_Plugin::$session->found_posts, wp_all_export_get_cpt_name($post['cpt'])); ?></h4>
						<?php endif; ?>				
					</div>	

					<form class="confirm <?php echo ! $isWizard ? 'edit' : '' ?>" method="post" style="float:right;">							

						<?php wp_nonce_field('update-export', '_wpnonce_update-export') ?>
						<input type="hidden" name="is_confirmed" value="1" />	

						<input type="submit" class="rad10 wp_all_export_confirm_and_run" value="<?php _e('Confirm & Run Export', 'wp_all_export_plugin') ?>" <?php if (empty(PMXE_Plugin::$session->found_posts)):?>style="display:none;"<?php endif;?>/>
					</form>	

				</div>					

				<div class="clear"></div>

				<form class="<?php echo ! $isWizard ? 'edit' : 'options' ?> choose-export-options" method="post" enctype="multipart/form-data" autocomplete="off" <?php echo ! $isWizard ? 'style="overflow:visible;"' : '' ?>>

					<?php if ( ! $isWizard and $post['export_type'] == 'specific'): ?>

					<div class="wpallexport-collapsed wpallexport-section closed">
						<div class="wpallexport-content-section">
							<div class="wpallexport-collapsed-header" style="padding-left: 25px;">
								<h3><?php _e('Filters','wp_all_export_plugin');?></h3>	
							</div>
							<div class="wpallexport-collapsed-content" style="padding: 0;">
								<div class="wpallexport-collapsed-content-inner">	
									<div class="wpallexport-free-edition-notice" style="padding: 20px; margin-bottom: 10px;">
										<a class="upgrade_link" target="_blank" href="http://www.wpallimport.com/upgrade-to-pro/?utm_source=free-plugin&amp;utm_medium=in-plugin&amp;utm_campaign=download-from-url"><?php _e('Upgrade to the professional edition of WP All Export to add filtering rules.','wp_all_export_plugin');?></a>
									</div>									
									<input type="hidden" name="selected_post_type" value="<?php echo $post['cpt'][0]; ?>"/>
									<div class="wp_all_export_rule_inputs">
										<table>
											<tr>
												<th><?php _e('Element', 'wp_all_export_plugin'); ?></th>
												<th><?php _e('Rule', 'wp_all_export_plugin'); ?></th>
												<th><?php _e('Value', 'wp_all_export_plugin'); ?></th>
												<th>&nbsp;</th>
											</tr>
											<tr>
												<td style="width: 25%;">
													<select id="wp_all_export_xml_element">
														<option value=""><?php _e('Select Element', 'wp_all_export_plugin'); ?></option>																
														<?php echo $engine->render_filters(); ?>						
													</select>
												</td>
												<td style="width: 25%;" id="wp_all_export_available_rules">
													<select id="wp_all_export_rule">
														<option value=""><?php _e('Select Rule', 'wp_all_export_plugin'); ?></option>							
													</select>
												</td>
												<td style="width: 25%;">
													<input id="wp_all_export_value" type="text" placeholder="value" value=""  disabled="disabled"/>
												</td>
												<td style="width: 15%;">
													<a id="wp_all_export_add_rule" href="javascript:void(0);"><?php _e('Add Rule', 'wp_all_export_plugin');?></a>
												</td>
											</tr>
										</table>						
									</div>	
									<div id="wpallexport-filters" style="padding:0;">								
										<div class="wpallexport-content-section" style="padding:0; border: none;">					
											<fieldset id="wp_all_export_filtering_rules">					
												<?php
												$filter_rules = $post['filter_rules_hierarhy'];
												$filter_rules_hierarhy = json_decode($filter_rules);
												if ( empty($filter_rules_hierarhy) or ! is_array($filter_rules_hierarhy) ): 
													?>
													<p style="margin:20px 0 5px; text-align:center;"><?php _e('No filtering options. Add filtering options to only export records matching some specified criteria.', 'wp_all_export_plugin');?></p>					
													<?php
												endif;												
												?>
												<ol class="wp_all_export_filtering_rules">
													<?php							
														if ( ! empty($filter_rules_hierarhy) and is_array($filter_rules_hierarhy) ): 
															$rulenumber = 0;
															foreach ($filter_rules_hierarhy as $rule) { 
																
																if ( is_null($rule->parent_id) )
																{
																	$rulenumber++;
																	?>
																	<li id="item_<?php echo $rulenumber;?>" class="dragging">
																		<div class="drag-element">
								    										<input type="hidden" value="<?php echo $rule->element; ?>" class="wp_all_export_xml_element" name="wp_all_export_xml_element[<?php echo $rulenumber; ?>]"/>
								    										<input type="hidden" value="<?php echo $rule->title; ?>" class="wp_all_export_xml_element_title" name="wp_all_export_xml_element_title[<?php echo $rulenumber; ?>]"/>
																    		<input type="hidden" value="<?php echo $rule->condition; ?>" class="wp_all_export_rule" name="wp_all_export_rule[<?php echo $rulenumber; ?>]"/>
								    										<input type="hidden" value="<?php echo $rule->value; ?>" class="wp_all_export_value" name="wp_all_export_value[<?php echo $rulenumber; ?>]"/>
								    										<span class="rule_element"><?php echo $rule->title; ?></span> 
								    										<span class="rule_as_is"><?php echo $rule->condition; ?></span> 
								    										<span class="rule_condition_value"><?php echo $rule->value; ?></span>	    										
								    										<span class="condition <?php if ($rulenumber == count($filter_rules_hierarhy)):?>last_condition<?php endif; ?>"> 
								    											<label for="rule_and_<?php echo $rulenumber; ?>">AND</label>
								    											<input id="rule_and_<?php echo $rulenumber; ?>" type="radio" value="and" name="rule[<?php echo $rulenumber; ?>]" <?php if ($rule->clause == 'AND'): ?>checked="checked"<?php endif; ?> class="rule_condition"/>
								    											<label for="rule_or_<?php echo $rulenumber; ?>">OR</label>
								    											<input id="rule_or_<?php echo $rulenumber; ?>" type="radio" value="or" name="rule[<?php echo $rulenumber; ?>]" <?php if ($rule->clause == 'OR'): ?>checked="checked"<?php endif; ?> class="rule_condition"/> 
								    										</span>
								    									</div>
								    									<a href="javascript:void(0);" class="icon-item remove-ico"></a>
								    									<?php echo wp_all_export_reverse_rules_html($filter_rules_hierarhy, $rule, $rulenumber); ?>
								    								</li>
								    								<?php
																}
															}
														endif;
													?>
												</ol>	
												<div class="clear"></div>				
												<div class="wp_all_export_filter_preloader"></div>		
											</fieldset>

											<?php if ( @in_array("product", $post["cpt"]) and class_exists('WooCommerce')) : ?>

											<div class="input wp_all_export_product_matching_mode" <?php if (empty($filter_rules_hierarhy)): ?>style="display:none;"<?php endif; ?>>
												<?php $product_matching_mode = $post['product_matching_mode']; ?>
												<label><?php _e("Variable product matching rules: ", "wp_all_export_plugin"); ?></label>
												<select name="product_matching_mode">
													<option value="strict" <?php echo ( $product_matching_mode == 'strict' ) ? 'selected="selected"' : ''; ?>><?php _e("Strict", "wp_all_export_plugin"); ?></option>
													<option value="permissive" <?php echo ( $product_matching_mode == 'permissive' ) ? 'selected="selected"' : ''; ?>><?php _e("Permissive", "wp_all_export_plugin"); ?></option>
												</select>
												<a href="#help" class="wpallexport-help" style="position: relative; top: 0px;" title="<?php _e('Strict matching requires all variations to pass in order for the product to be exported. Permissive matching allows the product to be exported if any of the variations pass.', 'wp_all_export_plugin'); ?>">?</a>							
											</div>

											<?php endif; ?>

										</div>	
									</div>
								</div>

								<input type="hidden" class="hierarhy-output" name="filter_rules_hierarhy" value="<?php echo esc_html($post['filter_rules_hierarhy']);?>"/>
								
							</div>
						</div>
					</div>		

					<?php endif; ?>

					<?php include_once PMXE_ROOT_DIR . '/views/admin/export/options/settings.php'; ?>						

					<p class="wpallexport-submit-buttons" style="text-align: center;">
						<?php wp_nonce_field('update-export', '_wpnonce_update-export') ?>
						<input type="hidden" name="is_confirmed" value="1" />					
						
						<a href="<?php echo apply_filters('pmxi_options_back_link', add_query_arg('id', $item->id, add_query_arg('action', 'template', $this->baseUrl)), $isWizard); ?>" class="back rad3"><?php _e('Edit Template', 'wp_all_export_plugin') ?></a>							
						<?php if (empty(PMXE_Plugin::$session->found_posts)):?>
						<input type="submit" class="button button-primary button-hero wpallexport-large-button confirm_and_run_bottom" value="<?php _e('Save Export Configuration', 'wp_all_export_plugin') ?>" />								
						<?php else:?>
						<input type="submit" class="button button-primary button-hero wpallexport-large-button confirm_and_run_bottom" value="<?php _e('Confirm & Run Export', 'wp_all_export_plugin') ?>" />								
						<?php endif;?>
					</p>


				</form>					
								
				<a href="http://soflyy.com/" target="_blank" class="wpallexport-created-by"><?php _e('Created by', 'wp_all_export_plugin'); ?> <span></span></a>
					
			</td>			
		</tr>
	</table>

</div>

<div class="wpallexport-overlay"></div>
