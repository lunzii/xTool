<?php 
	
function md_option_element($shortcode, $field){

	$option_element = '';

	if ($field['type'] != 'custom'){
		$option_element .= '
		<div class="label">
			<label for="shortcode-'.$shortcode.'-'.$field['param_name'].'">'.$field['heading'].'</label>
		</div>';
	}


	if ($field['type'] == 'radio') $field['type'] = 'dropdown';


	switch( $field['type'] ){
		case 'dropdown':

			$option_element .= '<div class="content">';
			$option_element .= '<select name="'.$field['param_name'].'" id="shortcode-'.$shortcode.'-'.$field['param_name'].'">';
			foreach( $field['value'] as $option => $value){
				 $option_element .= '<option value="'.$value.'"'.((isset($field['default'])) && $field['default'] == $value ? ' selected' : '').'>'.$option.'</option>';
			}
			$option_element .= '</select>';
			$option_element .= '</div>';

		break;

		case 'radio':

			$option_element .= '<div class="content">';
			foreach( $field['value'] as $option => $value){
				 $option_element .= '<label for="option-'.$field['param_name'].'-'.$value.'">'.$option.'</label>';
				 $option_element .= '<input type="radio" name="'.$field['param_name'].'" value="'.$value.'" id="option-'.$field['param_name'].'-'.$value.'"'.( $value == $field['default'] ? ' checked="checked"' : '').' />';
			}
			$option_element .= '</div>';

		break;

		case 'textarea':			

			(isset($field['value'])) ? $value = $field['value'] : $value = '';

			$option_element .= '<div class="content">';
			$option_element .= '<textarea class="textarea" name="'.$field['param_name'].'" id="shortcode-'.$shortcode.'-'.$field['param_name'].'">'.$value.'</textarea>';
			$option_element .= '</div>';
		
		break;


		case 'textarea_html':			

			(isset($field['value'])) ? $value = $field['value'] : $value = '';

			$option_element .= '<div class="content full tinymce border no-sh">';
			$option_element .= '<textarea class="md-tinyMCE" name="'.$field['param_name'].'" id="shortcode-'.$shortcode.'-'.$field['param_name'].'">'.$value.'</textarea>';
			$option_element .= '</div>';

		break;

		case 'colorpicker':			

			(isset($field['value'])) ? $value = $field['value'] : $value = '';

			$option_element .= '<div class="content">';
			$option_element .= '<input type="text" class="md-colorpicker" name="'.$field['param_name'].'" id="shortcode-'.$shortcode.'-'.$field['param_name'].'" value="'.$value.'" />';
			$option_element .= '</div>';

		break;

		case 'custom':
 
			if( $field['name'] == 'accordion' ){
				$option_element .= '
				<div class="shortcode-dynamic-items">
					<div class="shortcode-dynamic-item" data-shortcode="md_accordion">
						<div class="md-field">
							<div class="label"><label>'.__('Accordion Title', 'textdomain').'</label></div>
							<div class="content"><input class="custom" type="text" value="" name="" /></div>
						</div>
						<div class="md-field">
							<div class="label"><label>'.__('Accordion Content', 'textdomain').'</label></div>
							<div class="content"><textarea class="textarea custom" type="text" name="" /></textarea></div>
						</div>
					</div>
				</div>
				<a href="#" class="md-field-btn add-list-item"><i class="icon-plus"></i></a> <a href="#" class="md-field-btn remove-list-item"><i class="icon-minus"></i></a>
				<div class="clearfix" style="clear:both"></div>';	
			}

 
			if( $field['name'] == 'toggle' ){
				$option_element .= '
				<div class="shortcode-dynamic-items">
					<div class="shortcode-dynamic-item" data-shortcode="md_toggle">
						<div class="md-field">
							<div class="label"><label>'.__('Toggle Title', 'textdomain').'</label></div>
							<div class="content"><input class="custom" type="text" value="" name="" /></div>
						</div>
						<div class="md-field">
							<div class="label"><label>'.__('Toggle Content', 'textdomain').'</label></div>
							<div class="content"><textarea class="textarea custom" type="text" name="" /></textarea></div>
						</div>
					</div>
				</div>
				<a href="#" class="md-field-btn add-list-item"><i class="icon-plus"></i></a> <a href="#" class="md-field-btn remove-list-item"><i class="icon-minus"></i></a>
				<div class="clearfix" style="clear:both"></div>';	
			}

			if( $field['name'] == 'tour' ){
				$option_element .= '
				<div class="shortcode-dynamic-items">
					<div class="shortcode-dynamic-item" data-shortcode="md_tour">
						<div class="md-field">
							<div class="label"><label>'.__('Tour Title', 'textdomain').'</label></div>
							<div class="content"><input class="custom" type="text" value="" name="" /></div>
						</div>
						<div class="md-field">
							<div class="label"><label>'.__('Tour Content', 'textdomain').'</label></div>
							<div class="content"><textarea class="textarea custom" type="text" name="" /></textarea></div>
						</div>
					</div>
				</div>
				<a href="#" class="md-field-btn add-list-item"><i class="icon-plus"></i></a> <a href="#" class="md-field-btn remove-list-item"><i class="icon-minus"></i></a>
				<div class="clearfix" style="clear:both"></div>';	
			}

 
			if( $field['name'] == 'tab' ){
				$option_element .= '
				<div class="shortcode-dynamic-items">
					<div class="shortcode-dynamic-item" data-shortcode="md_tab">
						<div class="md-field">
							<div class="label"><label>'.__('Tab Title', 'textdomain').'</label></div>
							<div class="content"><input class="custom" type="text" value="" name="" /></div>
						</div>
						<div class="md-field">
							<div class="label"><label>'.__('Tab Content', 'textdomain').'</label></div>
							<div class="content"><textarea class="textarea custom" type="text" name="" /></textarea></div>
						</div>
					</div>
				</div>
				<a href="#" class="md-field-btn add-list-item"><i class="icon-plus"></i></a> <a href="#" class="md-field-btn remove-list-item"><i class="icon-minus"></i></a>
				<div class="clearfix" style="clear:both"></div>';	
			}

			if( $field['name'] == 'carousel' ){
				$option_element .= '
				<div class="shortcode-dynamic-items">
					<div class="shortcode-dynamic-item" data-shortcode="md_carousel_item">
						<div class="md-field">
							<div class="label"><label>'.__('Carousel Content', 'textdomain').'</label></div>
							<div class="content"><textarea class="textarea custom" type="text" name="" /></textarea></div>
						</div>
					</div>
				</div>
				<a href="#" class="md-field-btn add-list-item"><i class="icon-plus"></i></a> <a href="#" class="md-field-btn remove-list-item"><i class="icon-minus"></i></a>
				<div class="clearfix" style="clear:both"></div>';	
			}


			if( $field['name'] == 'client' ){
				$option_element .= '
				<div class="shortcode-dynamic-items">
					<div class="shortcode-dynamic-item" data-shortcode="md_client">
						<div class="md-field">
							<div class="label"><label>'.__('Client Image', 'textdomain').'</label></div>
							<div class="content">
								<input style="display:none" type="text" name="image" value="" class="custom upload_field" />
								<a href="#" class="upload_image md-button">Select File</a>
								<div class="upload_area">
									<div class="upload_img"><img src="#" alt="" class="href" /></div>
								</div>
							</div>
						</div>
						<div class="md-field">
							<div class="label"><label>'.__('Client Url', 'textdomain').'</label></div>
							<div class="content">
								<input type="text" name="" value="" class="custom href" />
							</div>
						</div>
					</div>
				</div>
				<a href="#" class="md-field-btn add-list-item"><i class="icon-plus"></i></a> <a href="#" class="md-field-btn remove-list-item"><i class="icon-minus"></i></a>
				<div class="clearfix" style="clear:both"></div>';	
			}


			if( $field['name'] == 'testimonial' ){
				$option_element .= '
				<div class="shortcode-dynamic-items">
					<div class="shortcode-dynamic-item" data-shortcode="md_testimonial">
						<div class="md-field">
							<div class="label"><label>'.__('Testimonial Image', 'textdomain').'</label></div>
							<div class="content">
								<input style="display:none" type="text" name="image" value="" class="custom upload_field" />
								<a href="#" class="upload_image md-button">Select File</a>
								<div class="upload_area">
									<div class="upload_img"><img src="#" alt="" class="href" /></div>
								</div>
							</div>
						</div>
						<div class="md-field">
							<div class="label"><label>'.__('Testimonial Text', 'textdomain').'</label></div>
							<div class="content"><textarea class="textarea custom" type="text" name="" /></textarea></div>
						</div>
						<div class="md-field">
							<div class="label"><label>'.__('Testimonial Name', 'textdomain').'</label></div>
							<div class="content"><input type="text" value="" class="custom name" /></div>
						</div>
					</div>
				</div>
				<a href="#" class="md-field-btn add-list-item"><i class="icon-plus"></i></a> <a href="#" class="md-field-btn remove-list-item"><i class="icon-minus"></i></a>
				<div class="clearfix" style="clear:both"></div>';	
			}
		break;


		case 'icons':
	        
			$option_element .= '<div class="icons-item">';
	       
	        $option_element .= '<input type="text" style="display:none" value="" name="'.$field['param_name'].'" />';
	       
	        $values = is_array($field['value']) ? $field['value'] : array();
	        foreach ( $values as $v ) {
	        
	            $option_element .= '<a href="#"><i class="'.$v.'"></i></a>';
	        }

			$option_element .= '</div>';

        break;


		case 'textfield':
		default:
			(isset($field['value'])) ? $value = $field['value'] : $value = '';

			$option_element .= '<div class="content">';
			$option_element .= '<input type="text" name="'.$field['param_name'].'" value="'.$value.'" id="shortcode-'.$shortcode.'-'.$field['param_name'].'" />';
			$option_element .= '</div>';
		
		break;
	}

	if (isset($field['description'])){
		$option_element .= '<div class="description">'.$field['description'].'</div>';
	}

	if ($field['type'] != 'custom'){
		$dependency_class = '';
		$dependency = '';
		if(isset($field['dependency'])){
			$dependency_class = ' dependency';
			$dependency = ' data-element="'.$field['dependency']['element'].'" data-value="'.$field['dependency']['value'].'"';
		}

		$option_element = '<div class="md-field'.$dependency_class.'"'.$dependency.'>'.$option_element.'</div>';
	}


	
	return $option_element;
}


?>