<?php
/**
 * WPBakery Visual Composer shortcodes Row
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_VC_Row extends WPBakeryShortCode {
    protected $predefined_atts = array(
        'class' => ''
    );

    /* This returs block controls
   ---------------------------------------------------------- */
    public function getColumnControls($controls, $extended_css = '') {
        global $vc_row_layouts;
        $controls_start = '<div class="controls controls_row clearfix">';
        $controls_end = '</div>';

        $right_part_start = '';//'<div class="controls_right">';
        $right_part_end = '';//'</div>';

        //Create columns
        $controls_center_start = '<span class="vc_row_layouts">';
        $controls_layout = '';
        foreach($vc_row_layouts as $layout) {
            $controls_layout .= '<a class="set_columns '.$layout['icon_class'].'" data-cells="'.$layout['cells'].'" data-cells-mask="'.$layout['mask'].'" title="'.$layout['title'].'"></a> ';
        }
        $controls_layout .= '<a class="set_columns custom_columns" data-cells="custom" data-cells-mask="custom" title="'.__('Custom layout', 'js_composer').'"><i class="icon-plus"></i></a> ';
        $controls_move = ' <a class="column_move" href="#" title="'.__('Drag row to reorder', 'js_composer').'"><i class="icon-move"></i></a>';
        $controls_delete = '<a class="column_delete" href="#" title="'.__('Delete this row', 'js_composer').'"><i class="icon-trash"></i></a>';
        $controls_edit = ' <a class="column_edit first_el" href="#" title="'.__('Edit this row', 'js_composer').'"><i class="icon-pencil"></i></a>';
        $controls_clone = ' <a class="column_clone" href="#" title="'.__('Clone this row', 'js_composer').'"><i class="icon-copy"></i></a>';
        $controls_hide = ' <a class="column_hide hide_row" href="#" title="'.__('Hide this row', 'js_composer').'"><i class="icon-eye-open"></i></a>';
        $controls_center_end = '</span>';

        $row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
        $row_edit_clone_delete .= $controls_delete . $controls_clone . $controls_edit . $controls_hide;
        $row_edit_clone_delete .= '</span>';

        //$column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_delete . $controls_clone . $controls_edit . $controls_center_end . $controls_end;
        $column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_center_end . $row_edit_clone_delete . $controls_end;
        $column_controls_full =  $controls_start. $controls_move  . $row_edit_clone_delete . $controls_end;

        return $column_controls_full;
    }

    public function contentAdmin($atts, $content = null) {
        $width = $class = '';
        extract(shortcode_atts($this->predefined_atts, $atts));

        $output = '';

        $column_controls = $this->getColumnControls($this->settings('controls'));

        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div'.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_sortable">';
            $output .= str_replace("%column_size%", 1, $column_controls);
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row-fluid wpb_row_container vc_container_for_children">';
            if($content=='' && !empty($this->settings["default_content_in_template"])) {
                $output .= do_shortcode( shortcode_unautop($this->settings["default_content_in_template"]) );
            } else {
                $output .= do_shortcode( shortcode_unautop($content) );

            }
            $output .= '</div>';
            if ( isset($this->settings['params']) ) {
                $inner = '';
                foreach ($this->settings['params'] as $param) {
                    $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
                    if ( is_array($param_value)) {
                        // Get first element from the array
                        reset($param_value);
                        $first_key = key($param_value);
                        $param_value = $param_value[$first_key];
                    }
                    $inner .= $this->singleParamHtmlHolder($param, $param_value);
                }
                $output .= $inner;
            }
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }
    public function customAdminBockParams() {
        return '';
    }
}



global $element_options;

vc_map( array(
  "name"            => __("Section", "js_composer"),
  "base"            => "vc_row",
  "is_container"    => true,
  "content_element" => false,
  "show_settings_on_create" => false,
  "category"        => __('Content', 'js_composer'),
  "params"          => array(
    array(
      "type"        => "dropdown",
      "heading"     => __("Container Width", "js_composer"),
      "param_name"  => "container_type",
      "value"       => array(
        __('Fixed Content', "js_composer")   => "content-fixed",
        __('Full Content', "js_composer")   => "content-full"
      ),
      "description" => __("Choose Layout Mode. Fixed width have 1140px Container. Full Width have 100% Container.", "js_composer")
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Border/Shadow", "js_composer"),
      "param_name"  => "shadow",
      "value"       => array(
        __('No Shadow', "js_composer")                    => "",
        __('Border Top', "js_composer")                   => "border-top",
        __('Border Bottom', "js_composer")                => "border-bottom",
        __('Border Top+Bottom', "js_composer")            => "border-top-bottom",
        __('Shadow Inside Top', "js_composer")            => "shadow-inside-top",
        __('Shadow Inside Bottom', "js_composer")         => "shadow-inside-bottom",
        __('Shadow Inside Top+Bottom', "js_composer")     => "shadow-inside-top-bottom",
        __('Shadow Outside Top', "js_composer")           => "shadow-outside-top",
        __('Shadow Outside Bottom', "js_composer")        => "shadow-outside-bottom",
        __('Shadow Outside Top+Bottom', "js_composer")    => "shadow-outside-top-bottom",
      )
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Padding", "js_composer"),
      "param_name"  => "padding",
      "value"       => array(
        __('Small', "js_composer")        => "padding-small",
        __('Medium', "js_composer")       => "padding-medium", 
        __('Large', "js_composer")        => "padding-large",
        __('No Padding', "js_composer")   => "padding-no", 
        __('Custom', "js_composer")       => "padding-custom",
      ),
      "description" => __("Choose Padding Top / Bottom.", "js_composer")
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Custom Padding Top", "js_composer"),
      "param_name"  => "padding_top",
      "default"     => "0",
      "dependency"  => array('element' => "padding", 'value' => array('padding-custom'))
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Custom Padding Bottom", "js_composer"),
      "param_name"  => "padding_bottom",
      "default"     => "0",
      "dependency"  => array('element' => "padding", 'value' => array('padding-custom'))
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Fixed Height", "js_composer"),
      "param_name"  => "fixed_height",
      "default"     => "0",
      "max"         => "3000"
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Background", "js_composer"),
      "param_name"  => "bgtype",
      "value"       => array(
        __('Default', "js_composer")  => "bg-default", 
        __('Custom Color', "js_composer") => "bg-custom-color",
        __('Image', "js_composer") => "bg-image",
        __('Video', "js_composer") => "bg-video",
        __('Slider', "js_composer") => "bg-slider",
        __('Map', "js_composer") => "bg-map",
      ),
      "default"     => "bg-default",
      "description" => __("Choose Background.", "js_composer")
    ),
    array(
      "type"        => "colorpicker",
      "class"       => "color",
      "heading"     => __("Custom Background Color", "js_composer"),
      "param_name"  => "bgcolor",
      "description" => __("Set custom background color.", "js_composer"),
      "value"       => "#ffffff",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-custom-color'))
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Show Arrow", "js_composer"),
      "param_name"  => "section_arrow",
      "value"       => array(
        __('None', "js_composer")       => "",
        __('Arrow Down', "js_composer") => "arrow-down", 
        __('Arrow Up', "js_composer") => "arrow-up", 
      ),
      "description" => __("Enable/disable Arrow.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-default', 'bg-custom-color'))
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Custom Background Image", "js_composer"),
      "param_name"  => "bgimage",
      "description" => __("Set custom background image.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-image'))
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Background Parallax", "js_composer"),
      "param_name"  => "bgparallax",
      "value"       => array(
        __('Yes', "js_composer")          => 'bg-parallax', 
        __('No', "js_composer")           => 'bg-no-parallax'
      ),
      "description" => __("Enable / Disable Background Parallax.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-image'))
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Video MP4 Format", "js_composer"),
      "param_name"  => "video_mp4",
      "description" => __("Set Url MP4 Video.", "js_composer"),
      "value"       => "",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-video'))
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Video WEBM Format", "js_composer"),
      "param_name"  => "video_webm",
      "description" => __("Set Url WEBM Video.", "js_composer"),
      "value"       => "",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-video'))
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Video OGV Format", "js_composer"),
      "param_name"  => "video_ogv",
      "description" => __("Set Url OGV Video.", "js_composer"),
      "value"       => "",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-video'))
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Video Poster Image", "js_composer"),
      "param_name"  => "video_poster",
      "description" => __("Set Poster Image.", "js_composer"),
      "value"       => "",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-video'))
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Video Poster Image", "js_composer"),
      "param_name"  => "video_poster",
      "description" => __("Set Poster Image.", "js_composer"),
      "value"       => "",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-video'))
    ),
    array(
      "type"        => "attach_images",
      "heading"     => __("Slider Images", "js_composer"),
      "param_name"  => "slider_images",
      "description" => __("Choose your images.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-slider'))
    ),

    array(
      "type"        => "radio",
      "heading"     => __("Type", "js_composer"),
      "param_name"  => "map_type",
      "value"       => array(
        __("Roadmap", "js_composer") => "ROADMAP",
        __("Satellite", "js_composer") => "SATELLITE",
        __("Hybrid", "js_composer") => "HYBRID",
        __("Terrain", "js_composer") => "TERRAIN",
      ),
      "default"     => "ROADMAP",
      "description" => __("Select map type.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Latitude", "js_composer"),
      "param_name"  => "map_latitude",
      "description" => __("Set the latitude (eg. 45.46545).", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Longitude", "js_composer"),
      "param_name"  => "map_longitude",
      "description" => __("Set the longitude (eg. 9.18652).", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Zoom Level", "js_composer"),
      "param_name"  => "map_zoom",
      "min"         => "1",
      "max"         => "18",
      "default"     => "12",
      "suffix"      => " ",
      "description" => __("Enter the map zoom level (1 to 18).", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Pin Image", "js_composer"),
      "param_name"  => "map_pin",
      "description" => __("Select a Pin.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Title", "js_composer"),
      "param_name"  => "map_title",
      "description" => __("Enter a title.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "textarea",
      "heading"     => __("Description", "js_composer"),
      "param_name"  => "map_info",
      "description" => __("Enter a description.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Scroll", "js_composer"),
      "param_name"  => "map_scroll",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable scroll.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Draggable", "js_composer"),
      "param_name"  => "map_drag",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable drag.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Zoom Control", "js_composer"),
      "param_name"  => "map_zoom_control",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable zoom control.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Double Click", "js_composer"),
      "param_name"  => "map_disable_doubleclick",
      "value"       => array(
        __("No", "js_composer") => "true",
        __("Yes", "js_composer") => "false",
      ),
      "default"     => "true",
      "description" => __("Enable / disable double click.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Street View", "js_composer"),
      "param_name"  => "map_streetview",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable Street View.", "js_composer"),
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-map'))
    ),

    array(
      "type"        => "dropdown",
      "heading"     => __("Background Mask", "js_composer"),
      "param_name"  => "bgmask",
      "value"       => array(
        __('No', "js_composer")           => '',
        __('Yes', "js_composer")          => 'yes', 
      ),
      "default"     => '',
      "description" => __("Enable / Disable Background Mask.", "js_composer")
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Background Mask Color", "js_composer"),
      "param_name"  => "bgmask_color",
      "value"       => "#000000",
      "description" => __("Choose Background Mask Color.", "js_composer"),
      "dependency"  => array('element' => "bgmask", 'value' => 'yes')
    ),

    array(
      "type"        => "dropdown",
      "heading"     => __("Background Mask Color Opacity", "js_composer"),
      "param_name"  => "bgmask_color_opacity",
      "value"       => array(
        __('90%', "js_composer")          => '0.9',
        __('80%', "js_composer")          => '0.8',
        __('70%', "js_composer")          => '0.7',
        __('60%', "js_composer")          => '0.6',
        __('50%', "js_composer")          => '0.5',
        __('40%', "js_composer")          => '0.4',
        __('30%', "js_composer")          => '0.3',
        __('20%', "js_composer")          => '0.2',
        __('10%', "js_composer")          => '0.1',
      ),
      "default"     => '0.8',
      "description" => __("Choose Background Mask Color Opacity.", "js_composer"),
      "dependency"  => array('element' => "bgmask", 'value' => 'yes')
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Background Mask Image", "js_composer"),
      "param_name"  => "bgmask_image",
      "description" => __("Choose Background Mask Image.", "js_composer"),
      "value"       => "",
      "dependency"  => array('element' => "bgmask", 'value' => 'yes')
    ),

    array(
      "type"        => "dropdown",
      "heading"     => __("Background Image Position", "js_composer"),
      "param_name"  => "bgimage_position",
      "value"       => array(
        __('Top Left', "js_composer")     => 'top left', 
        __('Top Center', "js_composer")   => 'top center', 
        __('Top Right', "js_composer")    => 'top right', 
        __('Center Left', "js_composer")     => 'center left', 
        __('Center Center', "js_composer")   => 'center center', 
        __('Center Right', "js_composer")    => 'center right', 
        __('Bottom Left', "js_composer")     => 'bottom left', 
        __('Bottom Center', "js_composer")   => 'bottom center', 
        __('Bottom Right', "js_composer")    => 'bottom right', 
      ),
      "description" => __("Set Background Image Position.", "js_composer"),
      "dependency"  => array('element' => "bgparallax", 'value' => array('bg-no-parallax'))
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Background Image Repeat", "js_composer"),
      "param_name"  => "bgimage_repeat",
      "value"       => array(
        __('No Repeat', "js_composer")     => 'no-repeat', 
        __('Repeat', "js_composer")        => 'repeat', 
        __('Repeat Horizontally', "js_composer")  => 'repeat-x', 
        __('Repeat Vertically', "js_composer")  => 'repeat-y', 
        ),
      "description" => __("Set Background Position.", "js_composer"),
      "dependency"  => array('element' => "bgparallax", 'value' => array('bg-no-parallax'))
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Background Size", "js_composer"),
      "param_name"  => "bgimage_size",
      "value"       => array(
        __('Auto', "js_composer")    => '', 
        __('Cover', "js_composer")      => 'cover', 
        __('Contain', "js_composer")    => 'contain'
      ),
      "description" => __("Set Background Size.", "js_composer"),
      "dependency"  => array('element' => "bgparallax", 'value' => array('bg-no-parallax'))
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Background Attachment", "js_composer"),
      "param_name"  => "bgimage_attach",
      "value"       => array(
        __('Scroll', "js_composer")     => 'scroll', 
        __('Fixed', "js_composer")      => 'fixed'
      ),
      "description" => __("Set Background Attachment.", "js_composer"),
      "dependency"  => array('element' => "bgparallax", 'value' => array('bg-no-parallax'))
    ),

    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  ),
  "js_view" => 'VcRowView'
) );