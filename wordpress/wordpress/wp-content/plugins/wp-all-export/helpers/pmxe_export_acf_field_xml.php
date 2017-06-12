<?php

function pmxe_export_acf_field_xml($field_value, $exportOptions, $ID, $recordID, &$xmlWriter, $element_name = '', $element_name_ns = '', $fieldSnipped = '', $group_id = ''){	

	if ( ! empty($field_value) ) {	

		global $acf;		

		$field_value = maybe_unserialize($field_value);				

		$field_name = ($ID) ? $exportOptions['cc_label'][$ID] : $exportOptions['name'];														

		$field_options = ($ID) ? unserialize($exportOptions['cc_options'][$ID]) : $exportOptions;

		//$element_name = 'acf_' . $element_name;										

		$put_to_xml = true;	

		// switch ACF field type
		switch ($field_options['type']) {

			case 'date_time_picker':
			case 'date_picker':

				$field_value = date('Ymd', strtotime($field_value));

				break;
			
			case 'file':
			case 'image':

				if (is_numeric($field_value)){
					$field_value = wp_get_attachment_url($field_value);
				}
				elseif(is_array($field_value)){
					$field_value = $field_value['url'];
				}

				break;
														
			case 'gallery':											
				
				$v = array();
				foreach ($field_value as $key => $item) {
					$v[] = $item['url'];											
				}
				$field_value = implode(",", $v);

				break;																																										
			case 'location-field':

				$localion_parts = explode("|", $field_value);

				if (!empty($localion_parts)){

					$xmlWriter->beginElement($element_name_ns, $element_name, null);
						$xmlWriter->startElement('address');
							$xmlWriter->writeData($localion_parts[0]);
						$xmlWriter->endElement();

						if (!empty($localion_parts[1])){
							$coordinates = explode(",", $localion_parts[1]);
							if (!empty($coordinates)){
								$xmlWriter->startElement('lat');
									$xmlWriter->writeData($coordinates[0]);
								$xmlWriter->endElement();
								$xmlWriter->startElement('lng');
									$xmlWriter->writeData($coordinates[1]);
								$xmlWriter->endElement();
							}
						}
					$xmlWriter->endElement();

				}												

				$put_to_xml = false;

				break;
			case 'paypal_item':																																																								

				$xmlWriter->beginElement($element_name_ns, $element_name, null);
					if ( is_array($field_value) ){
						foreach ($field_value as $key => $value) {
							$xmlWriter->beginElement($element_name_ns, $key, null);
								$xmlWriter->writeData($value);
							$xmlWriter->endElement();
						}
					}													
				$xmlWriter->endElement();

				$put_to_xml = false;

				break;
			case 'google_map':

				$xmlWriter->beginElement($element_name_ns, $element_name, null);
					$xmlWriter->startElement('address');
						$xmlWriter->writeData($field_value['address']);
					$xmlWriter->endElement();
					$xmlWriter->startElement('lat');
						$xmlWriter->writeData($field_value['lat']);
					$xmlWriter->endElement();
					$xmlWriter->startElement('lng');
						$xmlWriter->writeData($field_value['lng']);
					$xmlWriter->endElement();
				$xmlWriter->endElement();

				$put_to_xml = false;

				break;

			case 'acf_cf7':
			case 'gravity_forms_field':
				
				if ( ! empty($field_options['multiple']) )
					$field_value = implode(",", $field_value);

				break;											

			case 'page_link':

				if (is_array($field_value))
					$field_value = implode(",", $field_value);

				break;
			case 'post_object':													

				if ( ! empty($field_options['multiple'])){
					$v = array();
					foreach ($field_value as $key => $pid) {														

						if (is_numeric($pid)){
							$entry = get_post($pid);
							if ($entry)
							{
								$v[] = $entry->post_name;
							}
						}
						else{
							$v[] = $pid->post_name;
						}
					}
					$field_value = implode(",", $v);
				}
				else{							
					if (is_numeric($field_value)){
						$entry = get_post($field_value);
						if ($entry)
						{
							$field_value = $entry->post_name;
						}
					}
					else{
						$field_value = $field_value->post_name;
					}
				}

				break;				
			case 'relationship':

				$v = array();
				foreach ($field_value as $key => $pid) {
					$entry = get_post($pid);
					if ($entry)
					{
						$v[] = $entry->post_title;
					}
				}
				$field_value = implode(",", $v);

				break;																													
			case 'user':	

				if ( ! empty($field_options['multiple'])){
					$v = array();
					foreach ($field_value as $key => $user) {																												
						if (is_numeric($user)){
							$entry = get_user_by('ID', $user);
							if ($entry)
							{
								$v[] = $entry->user_email;
							}
						}				
						else{
							$v[] = $user['user_email'];
						}										
					}
					$field_value = implode(",", $v);
				}
				else{													
					if (is_numeric($field_value)){
						$entry = get_user_by('ID', $field_value);
						if ($entry)
						{
							$field_value = $entry->user_email;
						}
					}
					else{
						$field_value = $field_value['user_email'];
					}
				}	

				break;									
			case 'taxonomy':

				$xmlWriter->beginElement($element_name_ns, $element_name, null);

					if ( ! in_array($field_options['field_type'], array('radio', 'select'))){						
						foreach ($field_value as $key => $tid) {
							$entry = get_term($tid , $field_options['taxonomy']);
							if ($entry and !is_wp_error($entry))
							{
								$xmlWriter->startElement('term');
									$xmlWriter->writeData($entry->name);
								$xmlWriter->endElement();
							}
						}						
					}
					else{
						$entry = get_term($field_value, $field_options['taxonomy']);
						if ($entry)
						{
							$xmlWriter->startElement('term');
								$xmlWriter->writeData($entry->name);
							$xmlWriter->endElement();
						}
					}

				$xmlWriter->endElement();

				$put_to_xml = false;

				break;
			case 'select':

				if ( ! empty($field_options['multiple'])){
					$field_value = implode(",", $field_value);
				}

				break;
			case 'checkbox':		
				
				$field_value = implode(",", $field_value);																							

				//var_dump($field_value);

				break;
			
			case 'repeater':		

				$xmlWriter->beginElement($element_name_ns, $element_name, null);																			
				
				if( have_rows($field_name, $recordID) ): 
 										
				    while( have_rows($field_name, $recordID) ): 				    	
				    	
				    	the_row(); 									    	

				    	$row = XmlExportACF::acf_get_row();						

				    	$xmlWriter->startElement('row');				

				    	foreach ($row['field']['sub_fields'] as $sub_field) {						    				    					    	

				    		if ($acf and version_compare($acf->settings['version'], '5.0.0') >= 0)
				    		{
				    			// get
								$v = acf_format_value($row['value'][ $row['i'] ][ $sub_field['key'] ], $row['post_id'], $sub_field);
				    		}
				    		else
				    		{
								$v = get_sub_field($sub_field['name']);				    			
				    		}				    		
							
							pmxe_export_acf_field_xml($v, $sub_field, false, $recordID, $xmlWriter, $sub_field['name'], $element_name_ns, '', '');																						

				    	}						    	

			    		$xmlWriter->endElement();				    		    				    					       				    	
				        				        				        				        				    
				    endwhile;	
				 
				endif; 

				$xmlWriter->endElement();

				$put_to_xml = false;

				break;

			case 'flexible_content':													

				$xmlWriter->beginElement($element_name_ns, $element_name, null);	

				// check if the flexible content field has rows of data
				if( have_rows($field_name) ):					

				 	// loop through the rows of data
				    while ( have_rows($field_name) ) : the_row();				

						$row = XmlExportACF::acf_get_row();						

						foreach ($row['field']['layouts'] as $layout) {	

							if ($layout['name'] == $row['value'][ $row['i'] ]['acf_fc_layout']){	

								$xmlWriter->startElement($row['value'][ $row['i'] ]['acf_fc_layout'] . '_' . $row['i']);		

						    	foreach ($layout['sub_fields'] as $sub_field) {				    					    		
						    		
						    		if (isset($row['value'][ $row['i'] ][ $sub_field['key'] ])){
							    		// get
										$v = acf_format_value($row['value'][ $row['i'] ][ $sub_field['key'] ], $row['post_id'], $sub_field);
									
										pmxe_export_acf_field_xml($v, $sub_field, false, $recordID, $xmlWriter, $sub_field['name'], $element_name_ns, '', '');													
									}

						    	}

						    	$xmlWriter->endElement();	
						    }						    
					    	
					    }

				    endwhile;

				else :

				    // no layouts found

				endif;	

				$xmlWriter->endElement();	

				$put_to_xml = false;
				
				break;											
			
			default:
				
				break;
		}

		if ($put_to_xml){
		
			$xmlWriter->beginElement($element_name_ns, $element_name, null);
				$xmlWriter->writeData(apply_filters('pmxe_acf_field', pmxe_filter( maybe_serialize($field_value), $fieldSnipped), $field_name, $recordID));
			$xmlWriter->endElement();

		}
		
	}

}