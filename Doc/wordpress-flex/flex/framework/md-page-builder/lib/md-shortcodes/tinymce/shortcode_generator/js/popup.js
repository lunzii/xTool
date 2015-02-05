jQuery(document).ready(function($){
	var ed = tinyMCE.activeEditor;
    var content = ed.selection.getContent();
    
    $('#shortcode-content textarea').val(content);
    
	
    function update_shortcode(){
    	var code = '';
    	var code_wrapped = '';
		var name = $('#md-shortcodes a.active').data('shortcode');

		$('#options-'+name+' input').not('.custom').not('[name="content"]').not('[name="undefined"]').each(function(){
			if( $(this).attr('type') == 'text' ){ code += ' '+ $(this).attr('name')+'="'+ $(this).val()+'"'; }
			else { if($(this).attr('checked') == 'checked') code += ' '+ $(this).attr('name')+'="'+ $(this).val()+'"'; }
		});

		$('#options-'+name+' select').not('.custom').each(function(){
			 code += ' ' + $(this).attr('name')+'="' + $(this).attr('value') + '"';	
		});
		
		code = '[' + name + ' ' + code + ']';
		var $close_sh = false;

		/*
		$('#options-'+name+' [name="cont"]').not('.custom').each(function(){
			code_wrapped += $(this).val();
			$close_sh = true;
		});
		*/

		$('#options-'+name+' textarea.md-tinyMCE').not('.custom').each(function(){
			var $tiny_id = $(this).attr('id');
			var $tiny_val = tinyMCE.get($tiny_id).getContent()

			code_wrapped = $tiny_val;

			$close_sh = true;
		});


		$('#options-'+name+' [name="content"]').not('.custom').each(function(){
			code_wrapped = $(this).val();
			$close_sh = true;
		});

		$('#options-'+name+' textarea.textarea').not('.custom').each(function(){
			code_wrapped = $(this).val();
			$close_sh = true;
		});

		$('#options-'+name+' [data-shortcode="md_accordion"]').each(function(){
			if($(this).find('textarea').val()){
				code_wrapped += '[md_accordion title="'+$(this).find('input').val()+'"]'+$(this).find('textarea').val()+'[/md_accordion]';
				$close_sh = true;
			}
		});

		$('#options-'+name+' [data-shortcode="md_toggle"]').each(function(){
			if($(this).find('textarea').val()){
				code_wrapped += '[md_toggle title="'+$(this).find('input').val()+'"]'+$(this).find('textarea').val()+'[/md_toggle]';
				$close_sh = true;
			}
		});


		$('#options-'+name+' [data-shortcode="md_tour"]').each(function(){
			if($(this).find('textarea').val()){
				code_wrapped += '[md_tour title="'+$(this).find('input').val()+'"]'+$(this).find('textarea').val()+'[/md_tour]';
				$close_sh = true;
			}
		});

		$('#options-'+name+' [data-shortcode="md_tab"]').each(function(){
			if($(this).find('textarea').val()){
				code_wrapped += '[md_tab title="'+$(this).find('input').val()+'"]'+$(this).find('textarea').val()+'[/md_tab]';
				$close_sh = true;
			}
		});

		$('#options-'+name+' [data-shortcode="md_carousel_item"]').each(function(){
			if($(this).find('textarea').val()){
				code_wrapped += '[md_carousel_item]'+$(this).find('textarea').val()+'[/md_carousel_item]';
				$close_sh = true;
			}
		});

		$('#options-'+name+' [data-shortcode="md_client"]').each(function(){
			if($(this).find('input.upload_field').val()){
				code_wrapped += '[md_client image="'+$(this).find('input.upload_field').val()+'" href="'+$(this).find('input.href').val()+'"]';
				$close_sh = true;
			}
		});

		$('#options-'+name+' [data-shortcode="md_testimonial"]').each(function(){
			if($(this).find('textarea').val()){
				code_wrapped += '[md_testimonial image="'+$(this).find('input.upload_field').val()+'" name="'+$(this).find('input.name').val()+'"]'+$(this).find('textarea').val()+'[/md_testimonial]';
				$close_sh = true;
			}
		});


		if($close_sh) code += code_wrapped + '[/'+name+']';

		if($('.wpb-element-edit-modal .md-sh-only').length){
			code = code_wrapped;
		}

		$('#shortcode-storage-o').html(code);
	 }
     
    $('#add-shortcode').click(function(e){

    	e.preventDefault();
    	
    	var name = $('#md-shortcodes').val();
    	update_shortcode();
		

		ed.selection.setContent( $('#shortcode-storage-o').html() );

		tb_remove();

		return false;
    });

    $('#md-shortcodes li a').on('click', function(e){

    	e.preventDefault();

		$('.shortcode-options').hide();
		$('#options-'+$(this).data('shortcode')).show();

		$('#md-shortcodes li a').removeClass('active');

		$(this).addClass('active');

		return false;
    });
 	
    $('.add-list-item').click(function(){
    	
    	if(!$(this).parent().find('.remove-list-item').is(':visible')) $(this).parent().find('.remove-list-item').show();
    	
    	var $clone = $(this).parent().find('.shortcode-dynamic-item:first').clone();
    	$clone.find('input[type=text],textarea').attr('value','');
    	
		$(this).prevAll('div').append($clone);
	
		return false;
    });
	
    $('.remove-list-item').live('click', function(){
    	if($(this).parent().find('.shortcode-dynamic-item').length > 1){
    		$(this).parent().find('.shortcode-dynamic-item:last').remove();
    	}
    	if($(this).parent().find('.shortcode-dynamic-item').length == 1) $(this).hide();
    	
    	
		return false;
    });
    
	
	$('.icon-option i').click(function(){
		$('.icon-option i').removeClass('selected');
		$(this).addClass('selected');
	});

	function checkDependency(){
		$('.dependency').each(function(){
			var $el = $(this).data('element');
			var $el_val = $(this).data('value');

			$val = $(this).parents('.shortcode-options').find('[name="'+$el+'"]').val();

			if($val == $el_val){
				$(this).show();
			}

			else{
				$(this).hide();
			}
		});
	}
	$('.dependency').each(function(){
		var $el = $(this).data('element');
		$(this).parents('.shortcode-options').find('[name="' + $el + '"]').addClass('depender');
	});

	$('.depender').on('change', function(){
		checkDependency();
	});
	checkDependency();


	function addTinyMCE(){
		$('.md-tinyMCE').each(function(){
			var $tiny_id = $(this).attr('id');
			var $oldEditor = tinyMCE.get($tiny_id);
			

			if ($oldEditor != undefined) {
			     tinymce.remove($oldEditor);
			}

			tinymce.execCommand('mceAddEditor', true, $tiny_id);
		});
	}
	addTinyMCE();


	function detectPageBuilder(){
		if($('.wpb-element-edit-modal').length){
			$('#md-shortcodes li a').eq(0).click();

			var $pb_sh = $('.md-sh-only').data('sh');

			if($pb_sh){
				$('#md-shortcodes li').hide();
				$('#md-shortcodes li a[data-shortcode="'+$pb_sh+'"]').click().parent('li').show();

				$('.wpb-element-edit-modal input, .wpb-element-edit-modal select, .wpb-element-edit-modal textarea').each(function(){
					var $el_name = $(this).attr('name');
					$('#options-'+$pb_sh).find('[name="'+$el_name+'"]').parents('.md-field').hide();
				});

				if($pb_sh == 'md_accordions' || $pb_sh == 'md_toggles' || $pb_sh == 'md_tours' || $pb_sh == 'md_tabs' || $pb_sh == 'md_carousel' || $pb_sh == 'md_clients' || $pb_sh == 'md_testimonials'){

					switch($pb_sh){
						case 'md_accordions':
							$pb_sh_child = 'md_accordion';
						break;

						case 'md_toggles':
							$pb_sh_child = 'md_toggle';
						break;

						case 'md_tours':
							$pb_sh_child = 'md_tour';
						break;

						case 'md_tabs':
							$pb_sh_child = 'md_tab';
						break;

						case 'md_carousel':
							$pb_sh_child = 'md_carousel_item';
						break;

						case 'md_clients':
							$pb_sh_child = 'md_client';
						break;

						case 'md_testimonials':
							$pb_sh_child = 'md_testimonial';
						break;
					}


					var $el_cont = tinyMCE.get('wpb_tinymce_content').getContent({format : 'html'}).split('['+$pb_sh_child+'').join('<code').split(']').join('>').split('[/'+$pb_sh_child+'').join('</code');


					if($('#generate-sh').length)
					$('#generate-sh').remove();

					$('body').append('<div id="generate-sh" style="display:none">'+$el_cont+'</div>');
					   				
    				for($x = 0; $x < $('#generate-sh').find('code').length; $x++){
						$clone = $('#options-'+$pb_sh).find('.shortcode-dynamic-item:first').clone();

    					if($x == 0) $('#options-'+$pb_sh).find('.shortcode-dynamic-item:first').remove();

    					$('#options-'+$pb_sh+' .shortcode-dynamic-items').append($clone);
    					$('#options-'+$pb_sh).find('.shortcode-dynamic-item').eq($x).find('input').val($('#generate-sh').find('code').eq($x).attr('title'));
    					$('#options-'+$pb_sh).find('.shortcode-dynamic-item').eq($x).find('textarea').val($('#generate-sh').find('code').eq($x).html());
					}
				}
			}
		}
		else{

			$('#md-shortcodes li a').eq(0).click();
		}
	}

	detectPageBuilder();


	function uploadFile(){
		$('#shortcode-generator').delegate('.upload_image', 'click', function(e){
			var $uploadArea = $(this).parent('div.content');
			var $uploadPath = $uploadArea.data('path');
			var $uploadMedia = $uploadArea.data('media');
			var $uploadField = $uploadArea.find('.upload_field');
		 	var $uploadImage = $uploadArea.find('.upload_img');			

			var custom_uploader = wp.media({
				title: 'Select File',
				multiple: false,
				button: {
				    text: 'Insert'
				},
				library : { 
					type : 'image'
				}
			});

			custom_uploader.on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				$uploadField.val(attachment.id);
				$uploadImage.find('img').attr('src', attachment.url);
				$uploadImage.fadeIn();
			});

			/*
			custom_uploader.on('open', function(){

				var selection = custom_uploader.state().get('selection');

				if(selection.length){
					ids = $uploadField.val().split(',');
				    ids.forEach(function(id) {
						attachment = wp.media.attachment(id);
						attachment.fetch();
						selection.add( attachment ? [ attachment ] : [] );
					});
				}

			});
			*/
			custom_uploader.open();
		});
	}
	uploadFile();




	function mdColorPicker(){
		var myOptions = {
		    hide: true,
		    palettes: false
		};
		 
		$('.md-colorpicker').wpColorPicker(myOptions);
	}
	mdColorPicker();

});