<?php

function vc_textarea_html_form_field($settings, $value) {
    $settings_line = '';
    if ( function_exists('wp_editor') ) {
        $default_content = __($value, "js_composer");
        $output_value = '';
        // WP 3.3+
        $is_sh = "";
        if (isset($settings['shortcode'])){
            $is_sh = ' is-sh';
        //    $args['media_buttons'] = false;
        //   $args['tinymce'] = false;
        }

        $args = array('editor_class' => 'wpb_vc_param_value wpb-textarea visual_composer_tinymce '.$settings['param_name'].' '.$settings['type'].' '.$is_sh, 'media_buttons' => true, 'wpautop' => false, 'textarea_rows' => 2);

        if (isset($settings['shortcode'])){
            $args['media_buttons'] = false;
        }

        ob_start();
        wp_editor('', 'wpb_tinymce_'.$settings['param_name'], $args );
        $output_value = ob_get_contents();
        ob_end_clean();
        $settings_line .= $output_value.'<input type="hidden" name="vc_textarea_html_content" class="vc_textarea_html_content" value="'.htmlspecialchars($default_content).'"/>';
    }
    // $settings_line = '<textarea name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textarea visual_composer_tinymce '.$settings['param_name'].' '.$settings['type'].' '.$settings['param_name'].'_tinymce"' . $dependency . '>'.$settings_value.'</textarea>';
    return $settings_line;
}