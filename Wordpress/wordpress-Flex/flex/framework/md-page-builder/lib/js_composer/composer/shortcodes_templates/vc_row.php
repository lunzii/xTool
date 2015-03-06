<?php
extract(shortcode_atts(array(
    'class'                 => '',
    'id'                    => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'container_type'        => '',
    'shadow'                => '',
    'padding'               => '',
    'padding_top'           => '',
    'padding_bottom'        => '',
    'fixed_height'          => '',
    'bgtype'                => 'bg-default',
    'bgcolor'               => '',
    'section_arrow'         => '',
    'bgimage'               => '',
    'bgvideo'               => '',
    'video_mp4'             => '',
    'video_webm'            => '',
    'video_ogv'             => '',
    'video_poster'          => '',
    'slider_images'         => '',
    'map_type'              => '',
    'map_latitude'          => '',
    'map_longitude'         => '',
    'map_zoom'              => '',
    'map_pin'               => '',
    'map_title'             => '',
    'map_info'              => '',
    'map_height'            => '',
    'map_scroll'            => '',
    'map_drag'              => '',
    'map_zoom_control'      => '',
    'map_disable_doubleclick'   => '',
    'map_streetview'        => '',
    'bgparallax'            => '',
    'bgmask'                => '',
    'bgmask_color'          => '',
    'bgmask_color_opacity'  => '',
    'bgmask_image'          => '',
    'bgimage_position'      => '',
    'bgimage_repeat'        => '',
    'bgimage_size'          => '',
    'bgimage_attach'        => '',
), $atts));


$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$bgparallax = ($bgparallax == 'bg-parallax' && $bgtype == 'bg-image') ? 'bg-parallax' : '';

if($container_type == 'container'){
    $container_type = '';
}

$class  = setClass(array('page-section', $class, $animated, $css_animation, $container_type, $shadow, $padding, $bgtype, $bgparallax, $section_arrow));
$id     = setId($id);

$s_height = ($fixed_height) ? 'height:'.$fixed_height.'px; ' : '';
$s_padding = '';
if($padding == 'padding-custom'){
    $s_padding = 'padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px;';
}


$s_bgimage = '';
$s_parallax = '';
$s_bgposition = '';
$s_bgrepeat = '';
$s_bgsize = '';
$s_bgattachment = '';
if ($bgtype == 'bg-image') {

    $bgimage = wp_get_attachment_image_src( $bgimage, 'full');    
    $s_bgimage = 'background-image:url('.$bgimage[0].');';
    
    if($bgparallax){
        $s_parallax = ' data-type="background" data-speed="3"';
    }
    else{
        $s_bgposition = 'background-position:'.$bgimage_position.';';
        $s_bgrepeat = 'background-repeat:'.$bgimage_repeat.';';
        $s_bgsize = 'background-size:'.$bgimage_size.';';
        $s_bgattachment = 'background-attachment:'.$bgimage_attach.';';
    }
}
$s_bgcolor = ($bgtype == 'bg-custom-color') ? 'background-color:'.$bgcolor.';' : '';


$style = ' style="'.$s_padding.$s_height.$s_bgcolor.$s_bgimage.$s_bgposition.$s_bgrepeat.$s_bgsize.$s_bgattachment.'"';
$output = '<div'.$class.$id.$css_animation_delay.$style.$s_parallax.'>';
$output .= '<div class="container">';


if($section_arrow && $bgtype == 'bg-default' || $section_arrow && $bgtype == 'bg-custom-color'){

    $arrow_left_style = '';
    $arrow_right_style = '';

    if($bgtype == 'bg-custom-color'){
        if($section_arrow == 'arrow-down'){
            $arrow_left_style = ' style="border-top-color:'.$bgcolor.'; border-bottom-color:'.$bgcolor.'; border-left-color:'.$bgcolor.';"';

            $arrow_right_style = ' style="border-top-color:'.$bgcolor.'; border-bottom-color:'.$bgcolor.'; border-right-color:'.$bgcolor.';"';
        }

        if($section_arrow == 'arrow-up'){
            $arrow_left_style = ' style="border-right-color:'.$bgcolor.';"';

            $arrow_right_style = ' style="border-left-color:'.$bgcolor.';"';
        }

    }

    $output .= '<div class="section-arrow-left"'.$arrow_left_style.'></div>';
    $output .= '<div class="section-arrow-right"'.$arrow_right_style.'></div>';
}

if($bgmask){

    $bgmask_image = ($bgmask_image) ? wp_get_attachment_image_src( $bgmask_image, 'full') : '';
    $bgmask_image = ($bgmask_image) ? 'background-image:url('.$bgmask_image[0].');' : '';
    $bgmask_hex = hex2rgb($bgmask_color, $bgmask_color_opacity);

    $output .= '<div class="section-mask" style="background-color:'.$bgmask_hex.'; '.$bgmask_image.'"></div>';
}


if($bgtype == 'bg-video'){

    $videotype = 'hosted';


    if($videotype = 'hosted'){
        $poster = ($video_poster) ? $video_poster : '';
        if($poster)
        {
            $poster = wp_get_attachment_image_src( $poster, 'full');    
            $poster = ' poster="'.$poster[0].'"';
        }
        $output .= '<div class="section-video">';

        $output .= '<video'.$poster.' class="hosted" loop style="width: 100%; height: 100%;">';
        if($video_mp4)
        $output .= '<source type="video/mp4" src="'.$video_mp4.'" />';

        if($video_webm)
        $output .= '<source type="video/webm" src="'.$video_webm.'" />';

        if($video_ogv)
        $output .= '<source type="video/ogg" src="'.$video_ogv.'" />';
        $output .= '</video>';
        
    }
    $output .= '</div>';
}

if($bgtype == 'bg-slider'){
    $output .= '<div class="section-slider">';
        $images = explode(',', $slider_images);
        $output .= '<div class="flexslider" data-effect="fade" data-navigation="false" data-pagination="false"><ul class="slides">';
            foreach($images as $image):
                $image_big  = wp_get_attachment_image_src( $image, 'full');  
                $alt    = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : '';
                $output .= '<li><img src="'.$image_big[0].'" alt="'.esc_attr($alt).'" /></li>';
            endforeach;
        $output .= '</ul></div>';
    $output .= '</div>';
}


if($bgtype == 'bg-map'){
    $map_id  = setId('map_'.uniqid());

    $output .= '<div class="section-map">';

        $output .= '<div class="md-map" id="'.$map_id.'"';

        $output .= ' data-map-type="'.$map_type.'"';

        if($map_latitude)
        $output .= ' data-map-lat="'.$map_latitude.'"';

        if($map_longitude)
        $output .= ' data-map-lon="'.$map_longitude.'"';

        if($map_zoom)
        $output .= ' data-map-zoom="'.$map_zoom.'"';

        if($map_pin)
        $output .= ' data-map-pin="'.$map_pin[0].'"';

        if($map_title)
        $output .= ' data-map-title="'.$map_title.'"';

        if($map_info)
        $output .= ' data-map-info="'.$map_info.'"';

        $output .= ' data-map-scroll="'.$map_scroll.'"';
        $output .= ' data-map-drag="'.$map_drag.'"';
        $output .= ' data-map-zoom-control="'.$map_zoom_control.'"';
        $output .= ' data-map-disable-doubleclick="'.$map_disable_doubleclick.'"';
        $output .= ' data-map-streetview="'.$map_streetview.'"';

        $output .= '></div>';

    $output .= '</div>';
}

$output .= '<div class="section-content">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

$output .= '</div>';
$output .= '</div>';



echo $output;

