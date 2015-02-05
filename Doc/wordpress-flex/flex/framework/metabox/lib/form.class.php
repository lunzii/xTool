<?php 

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Form Helper Class
/* ----------------------------------------------------------------------------------*/
class FORM_HELPER{
		
	function __construct($post_id, $metabox, $taxonomy = false){

		$this->post_id = $post_id;
		$this->metabox = $metabox;
		$this->taxonomy = $taxonomy;

		if(!$taxonomy)
		$this->post_values = get_post_custom( $this->post_id );

		else
		$this->post_values = get_option( "taxonomy_".$this->post_id );			
	}

	public function metabox_init(){

		echo '<div id="mt-metabox">';
			echo '<ul id="mt-tabs">';
				foreach ($this->metabox as $metabox):
					$class = (isset($metabox['class'])) ? ' '.$metabox['class'] : '';
					echo '<li class="mt-tab'.$class.'" id="tab-'.$metabox['id'].'"><a href="#">'.$metabox['title'].'</a></li>';
				endforeach;
			echo '</ul>';


			foreach ($this->metabox as $metabox):
				$class = (isset($metabox['class'])) ? ' '.$metabox['class'] : '';
				echo '<div class="mt-panel'.$class.'" id="'.$metabox['id'].'">';
				#echo '<h4><i class="icon-'.$metabox['icon'].'"></i> '.$metabox['title'].'</h4>';
				foreach($metabox['fields'] as $field):
					$this->field($field);
				endforeach;
				echo '</div>';
			endforeach;

		echo '</div>';
	}

	function metabox_save(){

		foreach ($this->metabox as $metabox):

			foreach ($metabox['fields'] as $field):
				if (isset($_POST[$field['name']]))
					add_post_meta($this->post_id, $field['name'], $_POST[$field['name']], 1) or update_post_meta($this->post_id, $field['name'], $_POST[$field['name']]);			
				else
					add_post_meta($this->post_id, $field['name'], false, 1) or update_post_meta($this->post_id, $field['name'], false);
			endforeach;
		endforeach;		
	}

	function field($field){
		if(!$this->taxonomy)
		$value = isset( $this->post_values[$field['name']] ) ? ( $this->post_values[$field['name']][0] ) : "";

		else{
			$term_meta = get_option( "taxonomy_$this->post_id" );

			$value = isset( $term_meta[$field['name']] ) ? ( $term_meta[$field['name']] ) : "";

			$field['name'] = "term_meta[".$field['name']."]";
		}



		$args = array(
				'value' 	=> $value,
				'name'		=> isset($field['name']) ? $field['name'] : '',
				'label'		=> isset($field['label']) ? $field['label'] : '',
				'desc'		=> isset($field['desc']) ? $field['desc'] : '',
				'default'	=> isset($field['default']) ? $field['default'] : '',
				'class'		=> isset($field['class']) ? ' '.$field['class'] : ''
			);


		switch($field['type']){
			case 'textfield':
				$this->textfield($args);
			break;

			case 'textarea_html':
				$this->textarea_html($args);
			break;

			case 'textarea':
				$this->textarea($args);
			break;

			case 'upload':
				$args['media'] = $field['media'];
				$this->upload($args);
			break;

			case 'gallery':
				$this->gallery($args);
			break;

			case 'checkbox':
				$this->checkbox($args);
			break;

			case 'dropdown':
				$args['options'] = $field['options'];
				if(isset($field['chosen']))
				$args['chosen']  = true;

				$this->dropdown($args);
			break;

			case 'colorpicker':
				$args['default'] = $field['default'];

				$this->colorpicker($args);
			break;

			case 'toggle':
				$this->toggle($args);
			break;


			case 'animations':
				$this->animations($args);
			break;
		}		
	}


	
	function textfield($args){
		echo '<div class="field'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				echo '<input type="text" name="'.$args['name'].'" value="'.$args['value'].'" class="custom" />';
			echo '</div>';
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}


	function textarea_html($args){
		echo '<div class="field editor'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				wp_editor($args['value'], $args['name']);
				if(isset($args['desc']) && $args['desc'] != '')
			echo '</div>';
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}


	function textarea($args){
		echo '<div class="field'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				echo '<textarea name="'.$args['name'].'" class="custom">'.$args['value'].'</textarea>';
			echo '</div>';
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}


	function upload($args){
		$path = MD_THEME_URI.'/framework/assets/img';

		$thumb = '';
		$title = '';
		$preview = '';

		if($args['value'])
		{
			switch($args['media']){
				case 'image':
					$thumb = wp_get_attachment_image_src( $args['value'], 'thumb');
					$thumb = $thumb[0];
					$title = '';
				break;

				default:
					$thumb = $path.'/upload-'.$args['media'].'.png';

					$metadata = get_post($args['value']);
					$title = $metadata->post_title;
				break;
			}

			$preview = ' show';

			$metadata = get_post($args['value']);
		}

		echo '<div class="field'.$args['class'].'" data-path="'.$path.'" data-media="'.$args['media'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				echo '<input type="hidden" name="'.$args['name'].'" value="'.$args['value'].'" class="upload_field custom" />';
				echo '<button class="upload_single md-button">Select File</button> ';
				echo '<a href="#" class="upload_remove_single md-button md-remove">Remove</a>';
				
				echo '<div class="upload_area'.$preview.'">';
					echo '<div class="upload_img"><img src="'.$thumb.'" alt="" class="" /></div>';
					echo '<span class="upload_title">'.$title.'</span>';
				echo '</div>';
			echo '</div>';
		
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}


	function gallery($args){
		$path = MD_THEME_URI.'/framework/assets/img';

		$thumb = '';
		$title = '';

		$preview_imgs = '';
		if($args['value']){
			$imgs = explode(',', $args['value']);

			foreach ($imgs as $img){
				$thumb = wp_get_attachment_image_src( $img, 'thumb');
				$preview_imgs .= '<img src="'.$thumb[0].'" alt="" />';
			}
		}

		echo '<div class="field'.$args['class'].'" data-path="'.$path.'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				echo '<input type="hidden" name="'.$args['name'].'" value="'.$args['value'].'" class="upload_field custom" />';
				echo '<button class="upload_multi md-button">Select Files</button> ';
				echo '<a href="#" class="upload_remove_multi md-button md-remove">Remove</a>';
			
				echo '<div class="upload_area">';
					echo '<div class="upload_img multi">'.$preview_imgs.'</div>';
					echo '<span class="upload_title">'.$title.'</span>';
				echo '</div>';
			echo '</div>';
			
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}


	function checkbox($args){
		($args['value']) ? $checked = ' checked' : $checked = '';
		
		echo '<div class="field'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				echo '<input type="checkbox" name="'.$args['name'].'" class="checkbox"'.$checked.' />';
			echo '</div>';
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}


	function dropdown($args){

		(isset($args['chosen'])) ? $chosen = ' chosen' : $chosen = '';
		(isset($args['class'])) ? $class = $args['class'].' '.$chosen : $class = $chosen;

		echo '<div class="field'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				echo '<select name="'.$args['name'].'" class="'.$class.'">';
				foreach($args['options'] as $option):
					
					if($args['value']){
						($option['value'] == $args['value']) ? $selected = ' selected="selected"' : $selected = '';
					}
					else if($args['default']){
						($option['value'] == $args['default']) ? $selected = ' selected="selected"' : $selected = '';
					}

					echo '<option value="'.$option['value'].'"'.$selected.'>'.$option['label'].'</option>';
				endforeach;
				echo '</select>';
			echo '</div>';
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}


	function colorpicker($args){
		($args['value']) ? $value = $args['value'] : $value = $args['default'];
		echo '<div class="field cpicker'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
			echo '<input type="text" name="'.$args['name'].'" value="'.$value.'" class="md-colorpicker" data-default-color="'.$args['default'].'" />';
			echo '</div>';
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}

	function toggle($args){
		

		/*
		$checked = '';
		$toggle = '';
		if($args['value'] || $args['default']){
			$checked = ' checked';
			$toggle = ' active';
		}

		echo '<div class="field toggled'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label><br />';
			//echo '<div class="input">';
			//echo '<a href="#" class="checkbox-toggle'.$toggle.'"><span class="yes">YES</span><span class="no">NO</span><span class="move"></span></a>';
			echo '<input type="checkbox" name="'.$args['name'].'" class="checkbox"'.$checked.' />';
			//echo '</div>';
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
		*/
	}

	function animations($args){
		$md_animations = array(
				__("No Animation", "js_composer") => '',

			    __("Flash", "js_composer")      => "flash", 
			    __("Bounce", "js_composer")     => "bounce", 
			    __("Shake", "js_composer")      => "shake", 
			    __("Tada", "js_composer")       => "tada", 
			    __("Swing", "js_composer")      => "swing", 
			    __("Wobble", "js_composer")     => "wobble", 
			    __("Pulse", "js_composer")      => "pulse", 

			    __("Flip", "js_composer")       => "flip", 
			    __("FlipInX", "js_composer")    => "flipInX", 
			    __("FlipOutX", "js_composer")   => "flipOutX", 
			    __("FlipInY", "js_composer")    => "flipInY", 
			    __("FlipOutY", "js_composer")   => "flipOutY", 

			    __("FadeIn", "js_composer")         => "fadeIn", 
			    __("FadeInUp", "js_composer")       => "fadeInUp", 
			    __("FadeInDown", "js_composer")     => "fadeInDown", 
			    __("FadeInLeft", "js_composer")     => "fadeInLeft", 
			    __("FadeInRight", "js_composer")    => "fadeInRight", 
			    __("FadeInUpBig", "js_composer")    => "fadeInUpBig", 
			    __("FadeInDownBig", "js_composer")  => "fadeInDownBig", 
			    __("FadeInLeftBig", "js_composer")  => "fadeInLeftBig", 
			    __("FadeInRightBig", "js_composer") => "fadeInRightBig", 

			    __("SlideInDown", "js_composer")    => "slideInDown", 
			    __("SlideInLeft", "js_composer")    => "slideInLeft", 
			    __("SlideInRight", "js_composer")   => "slideInRight", 
			    __("SlideOutUp", "js_composer")     => "slideOutUp", 
			    __("SlideOutLeft", "js_composer")   => "slideOutLeft", 
			    __("SlideOutRight", "js_composer")  => "slideOutRight", 

			    __("BounceIn", "js_composer")       => "bounceIn", 
			    __("BounceInDown", "js_composer")   => "bounceInDown", 
			    __("BounceInUp", "js_composer")     => "bounceInUp", 
			    __("BounceInLeft", "js_composer")   => "bounceInLeft", 
			    __("BounceInRight", "js_composer")  => "bounceInRight", 

			    __("BounceOut", "js_composer")      => "bounceOut", 
			    __("BounceOutDown", "js_composer")  => "bounceOutDown", 
			    __("BounceOutUp", "js_composer")    => "bounceOutUp", 
			    __("BounceOutLeft", "js_composer")  => "bounceOutLeft", 
			    __("BounceOutRight", "js_composer") => "bounceOutRight", 

			    __("RotateIn", "js_composer")           => "rotateIn", 
			    __("RotateInDownLeft", "js_composer")   => "rotateInDownLeft", 
			    __("RotateInDownRight", "js_composer")  => "rotateInDownRight", 
			    __("RotateInUpLeft", "js_composer")     => "rotateInUpLeft", 
			    __("RotateInUpRight", "js_composer")    => "rotateInUpRight", 

			    __("RotateOut", "js_composer")          => "rotateOut", 
			    __("RotateOutDownLeft", "js_composer")  => "rotateOutDownLeft", 
			    __("RotateOutDownRight", "js_composer") => "rotateOutDownRight", 
			    __("RotateOutUpLeft", "js_composer")    => "rotateOutUpLeft", 
			    __("RotateOutUpRight", "js_composer")   => "rotateOutUpRight", 

			    __("LightSpeedIn", "js_composer")   => "lightSpeedIn", 
			    __("LightSpeedOut", "js_composer")  => "lightSpeedOut",

			    __("Hinge", "js_composer")   => "hinge", 
			    __("RollIn", "js_composer")  => "rollIn", 
			    __("RollOut", "js_composer") => "rollOut", 
			  );

		(isset($args['class'])) ? $class = $args['class'] : $class = '';

		echo '<div class="field'.$args['class'].'">';
			echo '<label>'.$args['label'].'</label>';
			echo '<div class="input">';
				echo '<select name="'.$args['name'].'" class="chosen">';
					foreach ($md_animations as $label => $value):
						
						if($args['value']){
							($value == $args['value']) ? $selected = ' selected="selected"' : $selected = '';
						}
						else if($args['default']){
							($value == $args['default']) ? $selected = ' selected="selected"' : $selected = '';
						}

						echo '<option value="'.$value.'"'.$selected.'>'.$label.'</option>';
					endforeach;
				echo '</select>';
			echo '</div>';
			if(isset($args['desc']) && $args['desc'] != '')
			echo '<div class="desc">'.$args['desc'].'</div>';
		echo '</div>';
	}

}
?>