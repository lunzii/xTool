<?php

global $theme_options;

$element_options = array();


/*-----------------------------------------------------------------------------------*/
/*  General
/*-----------------------------------------------------------------------------------*/
$element_options['class'] = array(
  "type"          => "textfield",
  "heading"       => __("Custom Class", "js_composer"),
  "param_name"    => "class",
  "description"   => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
);

$element_options['id'] = array(
  "type"          => "textfield",
  "heading"       => __("Custom ID", "js_composer"),
  "param_name"    => "id",
  "description"   => __("If you wish to set a particular content element differently, then use this field to add a ID name and then refer to it in your css file.", "js_composer")
);

$element_options['text_align'] = array(
  "type"          => "radio",
  "heading"       => __("Text Align", "js_composer"),
  "param_name"    => "text_align",
  "value"         => array(
    __("Default", "js_composer") => '', 
    __("Left", "js_composer") => "textalignleft", 
    __("Center", "js_composer") => "textaligncenter", 
    __("Right", "js_composer") => "textalignright"
  ),
  "default"       => "",
  "description"   => __("Set text alignaments.", "js_composer")
);

$element_options['items_cols'] = array(
  "type"        => "dropdown",
  "heading"     => __("Items For Row", "js_composer"),
  "param_name"  => "items_cols",
  "value"       => array(
    '1 item'    => '12',
    '2 items'   => '6',
    '3 items'   => '4', 
    '4 items'   => '3', 
    '6 items'   => '2'
  ),
  "description" => __("Select how many items to show for every row.", "js_composer")
);


/*-----------------------------------------------------------------------------------*/
/*  Query Parameters
/*-----------------------------------------------------------------------------------*/
$element_options['order'] = array(
  "type"          => "radio",
  "heading"       => __("Order Direction", "js_composer"),
  "param_name"    => "order",
  "value"         => array(
    __('Descending', 'js_composer')   => 'DESC',
    __('Ascending', 'js_composer')    => 'ASC'
  ),
  "default"       => "DESC",
);

$element_options['order_by'] = array(
  "type"          => "dropdown",
  "heading"       => __("Order By", "js_composer"),
  "param_name"    => "orderby",
  "value"         => array(
    __('ID', 'js_composer')             => 'ID',
    __('Author', 'js_composer')         => 'author',
    __('Title', 'js_composer')          => 'title',
    __('Name', 'js_composer')           => 'name',
    __('Date', 'js_composer')           => 'date',
    __('Modified', 'js_composer')       => 'modified',
    __('Parent', 'js_composer')         => 'parent',
    __('Rand', 'js_composer')           => 'rand',
    __('Comment Count', 'js_composer')  => 'comment_count',
    __('Menu Order', 'js_composer')     => 'menu_order',
  ),
);

$element_options['posts_per_page'] = array(
  "type"          => "textfield",
  "heading"       => __("Items Count", "js_composer"),
  "param_name"    => "posts_per_page",
  "description"   => __("Set the number of items to show. If empty show all.", "js_composer")
);



/*-----------------------------------------------------------------------------------*/
/*  CSS Animations
/*-----------------------------------------------------------------------------------*/
$element_options['css_animation'] = array(
  "type"          => "dropdown",
  "heading"       => __("Animation", "js_composer"),
  "param_name"    => "css_animation",
  "value"         => array(
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
  ),
  "description"   => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
);

$element_options['css_animation_delay'] = array(
  "type"          => "slider",
  "heading"       => __("Animation Delay", "js_composer"),
  "param_name"    => "css_animation_delay",
  "default"       => "0",
  "max"           => "9999",
  "suffix"        => "ms",
  "description"   => __("Set animaton delay in ms. (eg: 200)", "js_composer")
);




/*-----------------------------------------------------------------------------------*/
/*  Video
/*-----------------------------------------------------------------------------------*/
$element_options['video_src'] = array(
  "type"        => "textfield",
  "heading"     => __("Video Url", "js_composer"),
  "param_name"  => "video_src",
  "description" => __("Choose Video.", "js_composer"),
);

$element_options['video_loop'] = array(
  "type"        => "radio",
  "heading"     => __("Video Loop", "js_composer"),
  "param_name"  => "video_loop",
  "value"       => array(
    __('Yes', "js_composer")     => 'loop', 
    __('No', "js_composer")      => 'no-loop'
  ),
  "default"     => "loop",
  "description" => __("Enable / Disable Video Loop.", "js_composer"),
);

$element_options['video_autoplay'] = array(
  "type"        => "radio",
  "heading"     => __("Video Autoplay", "js_composer"),
  "param_name"  => "video_autoplay",
  "value"       => array(
    __('Yes', "js_composer")     => 'autoplay', 
    __('No', "js_composer")      => 'no-autoplay'
  ),
  "default"     => "autoplay",
  "description" => __("Enable / Disable Video Autoplay.", "js_composer"),
);

$element_options['video_controls'] = array(
  "type"        => "radio",
  "heading"     => __("Video Controls", "js_composer"),
  "param_name"  => "video_controls",
  "value"       => array(
    __('Yes', "js_composer")     => 'controls', 
    __('No', "js_composer")      => 'no-controls'
  ),
  "default"     => "controls",
  "description" => __("Enable / Disable Video Controls.", "js_composer"),
);

$element_options['video_preload'] = array(
  "type"        => "radio",
  "heading"     => __("Video Preload", "js_composer"),
  "param_name"  => "video_preload",
  "value"       => array(
    __('None', "js_composer") => 'none', 
    __('Auto', "js_composer") => 'auto', 
    __('Metadata', "js_composer") => 'metadata', 
  ),
  "default"     => "none",
  "description" => __("Select Video Preload.", "js_composer"),
);

$element_options['video_poster'] = array(
  "type"        => "attach_image",
  "heading"     => __("Video Poster", "js_composer"),
  "param_name"  => "video_poster",
  "description" => __("Set Video Poster Image.", "js_composer"),
);

$element_options['video_mask'] = array(
  "type"        => "radio",
  "heading"     => __("Video Mask", "js_composer"),
  "param_name"  => "video_mask",
  "value"       => array(
    __('Yes', "js_composer")   => 'mask', 
    __('No', "js_composer")    => 'no-mask'
  ),
  "default"     => "msk",
  "description" => __("Enable / Disable Video Mask.", "js_composer"),
);

$element_options['video_mask_color'] = array(
  "type"        => "colorpicker",
  "heading"     => __("Video Mask Background Color", "js_composer"),
  "param_name"  => "video_mask_color",
  "description" => __("Set Video Mask Background Color.", "js_composer"),
  "dependency"  => array('element' => "video_mask", 'value' => array('mask')),
);

$element_options['video_mask_image'] = array(
  "type"        => "attach_image",
  "heading"     => __("Video Mask Background Image", "js_composer"),
  "param_name"  => "video_mask_image",
  "description" => __("Set Video Mask Background Image.", "js_composer"),
  "dependency"  => array('element' => "video_mask", 'value' => array('mask')),
);



/*-----------------------------------------------------------------------------------*/
/*  Icons
/*-----------------------------------------------------------------------------------*/
$element_options['icon_size'] = array(
  "type"        => "slider",
  "heading"     => __("Icon Size", "js_composer"),
  "param_name"  => 'icon_size',
  "default"     => $theme_options['font-body']['font-size']
);

$element_options['icon_style'] = array(
  "type"        => "radio",
  "heading"     => __("Icon Style", "js_composer"),
  "param_name"  => 'icon_style',
  "value"       => array(
  __('Normal', "js_composer")            => "style-normal",
  __('Circle', "js_composer")            => "style-circle", 
  __('Circle Fill', "js_composer")       => "style-circle fill", 
  __('Rhombus', "js_composer")           => "style-rhombus", 
  __('Rhombus Fill', "js_composer")      => "style-rhombus fill", 
  __('Round', "js_composer")             => "style-round",
  __('Round Fill', "js_composer")        => "style-round fill",
  __('Square', "js_composer")            => "style-square", 
  __('Square Fill', "js_composer")       => "style-square fill", 
  ),
  "default"     => "icon-normal"
);

$element_options['icon_color'] = array(
  "type"        => "colorpicker",
  "heading"     => __("Icon Color", "js_composer"),
  "param_name"  => "icon_color",
  "value"       => $theme_options['accent-color']
);

$element_options['icon_color_hover'] = array(
  "type"        => "colorpicker",
  "heading"     => __("Icon Color Hover", "js_composer"),
  "param_name"  => "icon_color_hover",
  "value"       => $theme_options['accent-color']
);

$element_options['icon_border_color'] = array(
  "type"        => "colorpicker",
  "heading"     => __("Icon Border Color", "js_composer"),
  "param_name"  => "icon_border_color",
  "value"       => $theme_options['accent-color'],
  "dependency"  => array('element' => 'icon_style', 'value' => array('style-circle', 'style-circle fill', 'style-rhombus', 'style-rhombus fill', 'style-round', 'style-round fill', 'style-square', 'style-square fill'))
);

$element_options['icon_border_color_hover'] = array(
  "type"        => "colorpicker",
  "heading"     => __("Icon Border Color Hover", "js_composer"),
  "param_name"  => "icon_border_color_hover",
  "value"       => $theme_options['accent-color'],
  "dependency"  => array('element' => 'icon_style', 'value' => array('style-circle', 'style-circle fill', 'style-rhombus', 'style-rhombus fill', 'style-round', 'style-round fill', 'style-square', 'style-square fill'))
);

$element_options['icon_bg_color'] = array(
  "type"        => "colorpicker",
  "heading"     => __("Icon Background Color", "js_composer"),
  "param_name"  => "icon_bg_color",
  "value"       => '#ffffff',
  "dependency"  => array('element' => 'icon_style', 'value' => array('style-circle fill', 'style-rhombus fill', 'style-round fill', 'style-square fill'))
);

$element_options['icon_bg_color_hover'] = array(
  "type"        => "colorpicker",
  "heading"     => __("Icon Background Color Hover", "js_composer"),
  "param_name"  => "icon_bg_color_hover",
  "value"       => '#ffffff',
  "dependency"  => array('element' => 'icon_style', 'value' => array('style-circle', 'style-circle fill', 'style-rhombus', 'style-rhombus fill', 'style-round', 'style-round fill', 'style-square', 'style-square fill'))
);



$element_options['icon_margin'] = array(
  "type"        => "textfield",
  "heading"     => __("Icon Margin", "js_composer"),
  "param_name"  => "icon_margin",
  "value"       => "",
  "description" => __("Set specific margin for the icon(eg. 0px 5px 5px 0).", "js_composer")
);

$element_options['icon_family'] = array(
  "type"        => "dropdown",
  "heading"     => __("Icon Family", "js_composer"),
  "param_name"  => 'icon_family',
  "value"       => array(
  __('Typicons', "js_composer")          => "typicons",
  __('FontAwesome', "js_composer")       => "fontawesome",
  __('Entypo', "js_composer")            => "entypo",
  __('Lineicons', "js_composer")         => "lineicons",
  ),
  "default"     => "typicons"
);


$element_options['icon_fontawesome'] = array(
  "type"        => "icons",
  "heading"     => __("Icon FontAwesome", "js_composer"),
  "param_name"  => "icon_fontawesome",
  "value"       => array(
      'icon-glass','icon-music','icon-search','icon-envelope-alt','icon-heart','icon-star','icon-star-empty','icon-user','icon-film','icon-th-large','icon-th','icon-th-list','icon-ok','icon-remove','icon-zoom-in','icon-zoom-out','icon-off','icon-signal','icon-cog','icon-trash','icon-home','icon-file-alt','icon-time','icon-road','icon-download-alt','icon-download','icon-upload','icon-inbox','icon-play-circle','icon-repeat','icon-refresh','icon-list-alt','icon-lock','icon-flag','icon-headphones','icon-volume-off','icon-volume-down','icon-volume-up','icon-qrcode','icon-barcode','icon-tag','icon-tags','icon-book','icon-bookmark','icon-print','icon-camera','icon-font','icon-bold','icon-italic','icon-text-height','icon-text-width','icon-align-left','icon-align-center','icon-align-right','icon-align-justify','icon-list','icon-indent-left','icon-indent-right','icon-facetime-video','icon-picture','icon-pencil','icon-map-marker','icon-adjust','icon-tint','icon-edit','icon-share','icon-check','icon-move','icon-step-backward','icon-fast-backward','icon-backward','icon-play','icon-pause','icon-stop','icon-forward','icon-fast-forward','icon-step-forward','icon-eject','icon-chevron-left','icon-chevron-right','icon-plus-sign','icon-minus-sign','icon-remove-sign','icon-ok-sign','icon-question-sign','icon-info-sign','icon-screenshot','icon-remove-circle','icon-ok-circle','icon-ban-circle','icon-arrow-left','icon-arrow-right','icon-arrow-up','icon-arrow-down','icon-share-alt','icon-resize-full','icon-resize-small','icon-plus','icon-minus','icon-asterisk','icon-exclamation-sign','icon-gift','icon-leaf','icon-fire','icon-eye-open','icon-eye-close','icon-warning-sign','icon-plane','icon-calendar','icon-random','icon-comment','icon-magnet','icon-chevron-up','icon-chevron-down','icon-retweet','icon-shopping-cart','icon-folder-close','icon-folder-open','icon-resize-vertical','icon-resize-horizontal','icon-bar-chart','icon-twitter-sign','icon-facebook-sign','icon-camera-retro','icon-key','icon-cogs','icon-comments','icon-thumbs-up-alt','icon-thumbs-down-alt','icon-star-half','icon-heart-empty','icon-signout','icon-linkedin-sign','icon-pushpin','icon-external-link','icon-signin','icon-trophy','icon-github-sign','icon-upload-alt','icon-lemon','icon-phone','icon-check-empty','icon-bookmark-empty','icon-phone-sign','icon-twitter','icon-facebook','icon-github','icon-unlock','icon-credit-card','icon-rss','icon-hdd','icon-bullhorn','icon-bell','icon-certificate','icon-hand-right','icon-hand-left','icon-hand-up','icon-hand-down','icon-circle-arrow-left','icon-circle-arrow-right','icon-circle-arrow-up','icon-circle-arrow-down','icon-globe','icon-wrench','icon-tasks','icon-filter','icon-briefcase','icon-fullscreen','icon-group','icon-link','icon-cloud','icon-beaker','icon-cut','icon-copy','icon-paper-clip','icon-save','icon-sign-blank','icon-reorder','icon-list-ul','icon-list-ol','icon-strikethrough','icon-underline','icon-table','icon-magic','icon-truck','icon-pinterest','icon-pinterest-sign','icon-google-plus-sign','icon-google-plus','icon-money','icon-caret-down','icon-caret-up','icon-caret-left','icon-caret-right','icon-columns','icon-sort','icon-sort-down','icon-sort-up','icon-envelope','icon-linkedin','icon-undo','icon-legal','icon-dashboard','icon-comment-alt','icon-comments-alt','icon-bolt','icon-sitemap','icon-umbrella','icon-paste','icon-lightbulb','icon-exchange','icon-cloud-download','icon-cloud-upload','icon-user-md','icon-stethoscope','icon-suitcase','icon-bell-alt','icon-coffee','icon-food','icon-file-text-alt','icon-building','icon-hospital','icon-ambulance','icon-medkit','icon-fighter-jet','icon-beer','icon-h-sign','icon-plus-sign-alt','icon-double-angle-left','icon-double-angle-right','icon-double-angle-up','icon-double-angle-down','icon-angle-left','icon-angle-right','icon-angle-up','icon-angle-down','icon-desktop','icon-laptop','icon-tablet','icon-mobile-phone','icon-circle-blank','icon-quote-left','icon-quote-right','icon-spinner','icon-circle','icon-reply','icon-github-alt','icon-folder-close-alt','icon-folder-open-alt','icon-expand-alt','icon-collapse-alt','icon-smile','icon-frown','icon-meh','icon-gamepad','icon-keyboard','icon-flag-alt','icon-flag-checkered','icon-terminal','icon-code','icon-reply-all','icon-mail-reply-all','icon-star-half-empty','icon-location-arrow','icon-crop','icon-code-fork','icon-unlink','icon-question','icon-info','icon-exclamation','icon-superscript','icon-subscript','icon-eraser','icon-puzzle-piece','icon-microphone','icon-microphone-off','icon-shield','icon-calendar-empty','icon-fire-extinguisher','icon-rocket','icon-maxcdn','icon-chevron-sign-left','icon-chevron-sign-right','icon-chevron-sign-up','icon-chevron-sign-down','icon-html5','icon-css3','icon-anchor','icon-unlock-alt','icon-bullseye','icon-ellipsis-horizontal','icon-ellipsis-vertical','icon-rss-sign','icon-play-sign','icon-ticket','icon-minus-sign-alt','icon-check-minus','icon-level-up','icon-level-down','icon-check-sign','icon-edit-sign','icon-external-link-sign','icon-share-sign','icon-compass','icon-collapse','icon-collapse-top','icon-expand','icon-eur','icon-gbp','icon-usd','icon-inr','icon-jpy','icon-cny','icon-krw','icon-btc','icon-file','icon-file-text','icon-sort-by-alphabet','icon-sort-by-alphabet-alt','icon-sort-by-attributes','icon-sort-by-attributes-alt','icon-sort-by-order','icon-sort-by-order-alt','icon-thumbs-up','icon-thumbs-down','icon-youtube-sign','icon-youtube','icon-xing','icon-xing-sign','icon-youtube-play','icon-dropbox','icon-stackexchange','icon-instagram','icon-flickr','icon-adn','icon-bitbucket','icon-bitbucket-sign','icon-tumblr','icon-tumblr-sign','icon-long-arrow-down','icon-long-arrow-up','icon-long-arrow-left','icon-long-arrow-right','icon-apple','icon-windows','icon-android','icon-linux','icon-dribbble','icon-skype','icon-foursquare','icon-trello','icon-female','icon-male','icon-gittip','icon-sun','icon-moon','icon-archive','icon-bug','icon-vk','icon-weibo','icon-renren'
  ),
  "dependency"  => array('element' => 'icon_family', 'value' => 'fontawesome')
);

$element_options['icon_typicons'] = array(
  "type"        => "icons",
  "heading"     => __("Icon TypIcons", "js_composer"),
  "param_name"  => "icon_typicons",
  "value"       => array(
      'typcn-adjust-brightness', 'typcn-adjust-contrast', 'typcn-anchor-outline', 'typcn-anchor', 'typcn-archive', 'typcn-arrow-back-outline', 'typcn-arrow-back', 'typcn-arrow-down-outline', 'typcn-arrow-down-thick', 'typcn-arrow-down', 'typcn-arrow-forward-outline', 'typcn-arrow-forward', 'typcn-arrow-left-outline', 'typcn-arrow-left-thick', 'typcn-arrow-left', 'typcn-arrow-loop-outline', 'typcn-arrow-loop', 'typcn-arrow-maximise-outline', 'typcn-arrow-maximise', 'typcn-arrow-minimise-outline', 'typcn-arrow-minimise', 'typcn-arrow-move-outline', 'typcn-arrow-move', 'typcn-arrow-repeat-outline', 'typcn-arrow-repeat', 'typcn-arrow-right-outline', 'typcn-arrow-right-thick', 'typcn-arrow-right', 'typcn-arrow-shuffle', 'typcn-arrow-sorted-down', 'typcn-arrow-sorted-up', 'typcn-arrow-sync-outline', 'typcn-arrow-sync', 'typcn-arrow-unsorted', 'typcn-arrow-up-outline', 'typcn-arrow-up-thick', 'typcn-arrow-up', 'typcn-at', 'typcn-attachment-outline', 'typcn-attachment', 'typcn-backspace-outline', 'typcn-backspace', 'typcn-battery-charge', 'typcn-battery-full', 'typcn-battery-high', 'typcn-battery-low', 'typcn-battery-mid', 'typcn-beaker', 'typcn-beer', 'typcn-bell', 'typcn-book', 'typcn-bookmark', 'typcn-briefcase', 'typcn-brush', 'typcn-business-card', 'typcn-calculator', 'typcn-calender-outline', 'typcn-calender', 'typcn-camera-outline', 'typcn-camera', 'typcn-cancel-outline', 'typcn-cancel', 'typcn-chart-area-outline', 'typcn-chart-area', 'typcn-chart-bar-outline', 'typcn-chart-bar', 'typcn-chart-line-outline', 'typcn-chart-line', 'typcn-chart-pie-outline', 'typcn-chart-pie', 'typcn-chevron-left-outline', 'typcn-chevron-left', 'typcn-chevron-right-outline', 'typcn-chevron-right', 'typcn-clipboard', 'typcn-cloud-storage', 'typcn-code-outline', 'typcn-code', 'typcn-coffee', 'typcn-cog-outline', 'typcn-cog', 'typcn-compass', 'typcn-contacts', 'typcn-credit-card', 'typcn-cross', 'typcn-css3', 'typcn-database', 'typcn-delete-outline', 'typcn-delete', 'typcn-device-desktop', 'typcn-device-laptop', 'typcn-device-phone', 'typcn-device-tablet', 'typcn-directions', 'typcn-divide-outline', 'typcn-divide', 'typcn-document-add', 'typcn-document-delete', 'typcn-document-text', 'typcn-document', 'typcn-download-outline', 'typcn-download', 'typcn-dropbox', 'typcn-edit', 'typcn-eject-outline', 'typcn-eject', 'typcn-equals-outline', 'typcn-equals', 'typcn-export-outline', 'typcn-export', 'typcn-eye-outline', 'typcn-eye', 'typcn-feather', 'typcn-film', 'typcn-filter', 'typcn-flag-outline', 'typcn-flag', 'typcn-flash-outline', 'typcn-flash', 'typcn-flow-children', 'typcn-flow-merge', 'typcn-flow-parallel', 'typcn-flow-switch', 'typcn-folder-add', 'typcn-folder-delete', 'typcn-folder-open', 'typcn-folder', 'typcn-gift', 'typcn-globe-outline', 'typcn-globe', 'typcn-group-outline', 'typcn-group', 'typcn-headphones', 'typcn-heart-full-outline', 'typcn-heart-half-outline', 'typcn-heart-outline', 'typcn-heart', 'typcn-home-outline', 'typcn-home', 'typcn-html5', 'typcn-image-outline', 'typcn-image', 'typcn-infinity-outline', 'typcn-infinity', 'typcn-info-large-outline', 'typcn-info-large', 'typcn-info-outline', 'typcn-info', 'typcn-input-checked-outline', 'typcn-input-checked', 'typcn-key-outline', 'typcn-key', 'typcn-keyboard', 'typcn-leaf', 'typcn-lightbulb', 'typcn-link-outline', 'typcn-link', 'typcn-location-arrow-outline', 'typcn-location-arrow', 'typcn-location-outline', 'typcn-location', 'typcn-lock-closed-outline', 'typcn-lock-closed', 'typcn-lock-open-outline', 'typcn-lock-open', 'typcn-mail', 'typcn-map', 'typcn-media-eject-outline', 'typcn-media-eject', 'typcn-media-fast-forward-outline', 'typcn-media-fast-forward', 'typcn-media-pause-outline', 'typcn-media-pause', 'typcn-media-play-outline', 'typcn-media-play-reverse-outline', 'typcn-media-play-reverse', 'typcn-media-play', 'typcn-media-record-outline', 'typcn-media-record', 'typcn-media-rewind-outline', 'typcn-media-rewind', 'typcn-media-stop-outline', 'typcn-media-stop', 'typcn-message-typing', 'typcn-message', 'typcn-messages', 'typcn-microphone-outline', 'typcn-microphone', 'typcn-minus-outline', 'typcn-minus', 'typcn-mortar-board', 'typcn-news', 'typcn-notes-outline', 'typcn-notes', 'typcn-pen', 'typcn-pencil', 'typcn-phone-outline', 'typcn-phone', 'typcn-pi-outline', 'typcn-pi', 'typcn-pin-outline', 'typcn-pin', 'typcn-pipette', 'typcn-plane-outline', 'typcn-plane', 'typcn-plug', 'typcn-plus-outline', 'typcn-plus', 'typcn-point-of-interest-outline', 'typcn-point-of-interest', 'typcn-power-outline', 'typcn-power', 'typcn-printer', 'typcn-puzzle-outline', 'typcn-puzzle', 'typcn-radar-outline', 'typcn-radar', 'typcn-refresh-outline', 'typcn-refresh', 'typcn-rss-outline', 'typcn-rss', 'typcn-scissors-outline', 'typcn-scissors', 'typcn-shopping-bag', 'typcn-shopping-cart', 'typcn-social-at-circular', 'typcn-social-dribbble-circular', 'typcn-social-dribbble', 'typcn-social-facebook-circular', 'typcn-social-facebook', 'typcn-social-flickr-circular', 'typcn-social-flickr', 'typcn-social-github-circular', 'typcn-social-github', 'typcn-social-google-plus-circular', 'typcn-social-google-plus', 'typcn-social-instagram-circular', 'typcn-social-instagram', 'typcn-social-last-fm-circular', 'typcn-social-last-fm', 'typcn-social-linkedin-circular', 'typcn-social-linkedin', 'typcn-social-pinterest-circular', 'typcn-social-pinterest', 'typcn-social-skype-outline', 'typcn-social-skype', 'typcn-social-tumbler-circular', 'typcn-social-tumbler', 'typcn-social-twitter-circular', 'typcn-social-twitter', 'typcn-social-vimeo-circular', 'typcn-social-vimeo', 'typcn-social-youtube-circular', 'typcn-social-youtube', 'typcn-sort-alphabetically-outline', 'typcn-sort-alphabetically', 'typcn-sort-numerically-outline', 'typcn-sort-numerically', 'typcn-spanner-outline', 'typcn-spanner', 'typcn-spiral', 'typcn-star-full-outline', 'typcn-star-half-outline', 'typcn-star-half', 'typcn-star-outline', 'typcn-star', 'typcn-starburst-outline', 'typcn-starburst', 'typcn-stopwatch', 'typcn-support', 'typcn-tabs-outline', 'typcn-tag', 'typcn-tags', 'typcn-th-large-outline', 'typcn-th-large', 'typcn-th-list-outline', 'typcn-th-list', 'typcn-th-menu-outline', 'typcn-th-menu', 'typcn-th-small-outline', 'typcn-th-small', 'typcn-thermometer', 'typcn-thumbs-down', 'typcn-thumbs-ok', 'typcn-thumbs-up', 'typcn-tick-outline', 'typcn-tick', 'typcn-ticket', 'typcn-time', 'typcn-times-outline', 'typcn-times', 'typcn-trash', 'typcn-tree', 'typcn-upload-outline', 'typcn-upload', 'typcn-user-add-outline', 'typcn-user-add', 'typcn-user-delete-outline', 'typcn-user-delete', 'typcn-user-outline', 'typcn-user', 'typcn-vendor-android', 'typcn-vendor-apple', 'typcn-vendor-microsoft', 'typcn-video-outline', 'typcn-video', 'typcn-volume-down', 'typcn-volume-mute', 'typcn-volume-up', 'typcn-volume', 'typcn-warning-outline', 'typcn-warning', 'typcn-watch', 'typcn-waves-outline', 'typcn-waves', 'typcn-weather-cloudy', 'typcn-weather-downpour', 'typcn-weather-night', 'typcn-weather-partly-sunny', 'typcn-weather-shower', 'typcn-weather-snow', 'typcn-weather-stormy', 'typcn-weather-sunny', 'typcn-weather-windy-cloudy', 'typcn-weather-windy', 'typcn-wi-fi-outline', 'typcn-wi-fi', 'typcn-wine', 'typcn-world-outline', 'typcn-world', 'typcn-zoom-in-outline', 'typcn-zoom-in', 'typcn-zoom-out-outline', 'typcn-zoom-out', 'typcn-zoom-outline', 'typcn-zoom'
  ),
  "dependency"  => array('element' => 'icon_family', 'value' => 'typicons')
);


$element_options['icon_entypo'] = array(
  "type"        => "icons",
  "heading"     => __("Icon Entypo", "js_composer"),
  "param_name"  => "icon_entypo",
  "value"       => array(
      'entypo-note', 'entypo-logo-db', 'entypo-music', 'entypo-search', 'entypo-flashlight', 'entypo-mail', 'entypo-heart', 'entypo-heart-empty', 'entypo-star', 'entypo-star-empty', 'entypo-user', 'entypo-users', 'entypo-user-add', 'entypo-video', 'entypo-picture', 'entypo-camera', 'entypo-layout', 'entypo-menu', 'entypo-check', 'entypo-cancel', 'entypo-cancel-circled', 'entypo-cancel-squared', 'entypo-plus', 'entypo-plus-circled', 'entypo-plus-squared', 'entypo-minus', 'entypo-minus-circled', 'entypo-minus-squared', 'entypo-help', 'entypo-help-circled', 'entypo-info', 'entypo-info-circled', 'entypo-back', 'entypo-home', 'entypo-link', 'entypo-attach', 'entypo-lock', 'entypo-lock-open', 'entypo-eye', 'entypo-tag', 'entypo-bookmark', 'entypo-bookmarks', 'entypo-flag', 'entypo-thumbs-up', 'entypo-thumbs-down', 'entypo-download', 'entypo-upload', 'entypo-upload-cloud', 'entypo-reply', 'entypo-reply-all', 'entypo-forward', 'entypo-quote', 'entypo-code', 'entypo-export', 'entypo-pencil', 'entypo-feather', 'entypo-print', 'entypo-retweet', 'entypo-keyboard', 'entypo-comment', 'entypo-chat', 'entypo-bell', 'entypo-attention', 'entypo-alert', 'entypo-vcard', 'entypo-address', 'entypo-location', 'entypo-map', 'entypo-direction', 'entypo-compass', 'entypo-cup', 'entypo-trash', 'entypo-doc', 'entypo-docs', 'entypo-doc-landscape', 'entypo-doc-text', 'entypo-doc-text-inv', 'entypo-newspaper', 'entypo-book-open', 'entypo-book', 'entypo-folder', 'entypo-archive', 'entypo-box', 'entypo-rss', 'entypo-phone', 'entypo-cog', 'entypo-tools', 'entypo-share', 'entypo-shareable', 'entypo-basket', 'entypo-bag', 'entypo-calendar', 'entypo-login', 'entypo-logout', 'entypo-mic', 'entypo-mute', 'entypo-sound', 'entypo-volume', 'entypo-clock', 'entypo-hourglass', 'entypo-lamp', 'entypo-light-down', 'entypo-light-up', 'entypo-adjust', 'entypo-block', 'entypo-resize-full', 'entypo-resize-small', 'entypo-popup', 'entypo-publish', 'entypo-window', 'entypo-arrow-combo', 'entypo-down-circled', 'entypo-left-circled', 'entypo-right-circled', 'entypo-up-circled', 'entypo-down-open', 'entypo-left-open', 'entypo-right-open', 'entypo-up-open', 'entypo-down-open-mini', 'entypo-left-open-mini', 'entypo-right-open-mini', 'entypo-up-open-mini', 'entypo-down-open-big', 'entypo-left-open-big', 'entypo-right-open-big', 'entypo-up-open-big', 'entypo-down', 'entypo-left', 'entypo-right', 'entypo-up', 'entypo-down-dir', 'entypo-left-dir', 'entypo-right-dir', 'entypo-up-dir', 'entypo-down-bold', 'entypo-left-bold', 'entypo-right-bold', 'entypo-up-bold', 'entypo-down-thin', 'entypo-left-thin', 'entypo-right-thin', 'entypo-note-beamed', 'entypo-ccw', 'entypo-cw', 'entypo-arrows-ccw', 'entypo-level-down', 'entypo-level-up', 'entypo-shuffle', 'entypo-loop', 'entypo-switch', 'entypo-play', 'entypo-stop', 'entypo-pause', 'entypo-record', 'entypo-to-end', 'entypo-to-start', 'entypo-fast-forward', 'entypo-fast-backward', 'entypo-progress-0', 'entypo-progress-1', 'entypo-progress-2', 'entypo-progress-3', 'entypo-target', 'entypo-palette', 'entypo-list', 'entypo-list-add', 'entypo-signal', 'entypo-trophy', 'entypo-battery', 'entypo-back-in-time', 'entypo-monitor', 'entypo-mobile', 'entypo-network', 'entypo-cd', 'entypo-inbox', 'entypo-install', 'entypo-globe', 'entypo-cloud', 'entypo-cloud-thunder', 'entypo-flash', 'entypo-moon', 'entypo-flight', 'entypo-paper-plane', 'entypo-leaf', 'entypo-lifebuoy', 'entypo-mouse', 'entypo-briefcase', 'entypo-suitcase', 'entypo-dot', 'entypo-dot-2', 'entypo-dot-3', 'entypo-brush', 'entypo-magnet', 'entypo-infinity', 'entypo-erase', 'entypo-chart-pie', 'entypo-chart-line', 'entypo-chart-bar', 'entypo-chart-area', 'entypo-tape', 'entypo-graduation-cap', 'entypo-language', 'entypo-ticket', 'entypo-water', 'entypo-droplet', 'entypo-air', 'entypo-credit-card', 'entypo-floppy', 'entypo-clipboard', 'entypo-megaphone', 'entypo-database', 'entypo-drive', 'entypo-bucket', 'entypo-thermometer', 'entypo-key', 'entypo-flow-cascade', 'entypo-flow-branch', 'entypo-flow-tree', 'entypo-flow-line', 'entypo-flow-parallel', 'entypo-rocket', 'entypo-gauge', 'entypo-traffic-cone', 'entypo-cc', 'entypo-cc-by', 'entypo-cc-nc', 'entypo-cc-nc-eu', 'entypo-cc-nc-jp', 'entypo-cc-sa', 'entypo-cc-nd', 'entypo-cc-pd', 'entypo-cc-zero', 'entypo-cc-share', 'entypo-cc-remix', 'entypo-github', 'entypo-github-circled', 'entypo-flickr', 'entypo-flickr-circled', 'entypo-vimeo', 'entypo-vimeo-circled', 'entypo-twitter', 'entypo-twitter-circled', 'entypo-facebook', 'entypo-facebook-circled', 'entypo-facebook-squared', 'entypo-gplus', 'entypo-gplus-circled', 'entypo-pinterest', 'entypo-pinterest-circled', 'entypo-tumblr', 'entypo-tumblr-circled', 'entypo-linkedin', 'entypo-linkedin-circled', 'entypo-dribbble', 'entypo-dribbble-circled', 'entypo-stumbleupon', 'entypo-stumbleupon-circled', 'entypo-lastfm', 'entypo-lastfm-circled', 'entypo-rdio', 'entypo-rdio-circled', 'entypo-spotify', 'entypo-spotify-circled', 'entypo-qq', 'entypo-instagram', 'entypo-dropbox', 'entypo-evernote', 'entypo-flattr', 'entypo-skype', 'entypo-skype-circled', 'entypo-renren', 'entypo-sina-weibo', 'entypo-paypal', 'entypo-picasa', 'entypo-soundcloud', 'entypo-mixi', 'entypo-behance', 'entypo-google-circles', 'entypo-vkontakte', 'entypo-smashing', 'entypo-sweden', 'entypo-db-shape', 'entypo-up-thin'
  ),
  "dependency"  => array('element' => 'icon_family', 'value' => 'entypo')
);

$element_options['icon_lineicons'] = array(
  "type"        => "icons",
  "heading"     => __("Icon LineIcons", "js_composer"),
  "param_name"  => "icon_lineicons",
  "value"       => array(
      'lineicon-banknote', 'lineicon-big58', 'lineicon-big59', 'lineicon-big60', 'lineicon-blockade', 'lineicon-bubble1', 'lineicon-camera6', 'lineicon-camera7', 'lineicon-cup4', 'lineicon-data3', 'lineicon-diamons', 'lineicon-display14', 'lineicon-fire', 'lineicon-heart3', 'lineicon-lab', 'lineicon-leaf5', 'lineicon-like', 'lineicon-location4', 'lineicon-news', 'lineicon-noodle', 'lineicon-note2', 'lineicon-packet', 'lineicon-paperclip2', 'lineicon-paperplane', 'lineicon-parameters', 'lineicon-pen3', 'lineicon-phone12', 'lineicon-photo3', 'lineicon-search3', 'lineicon-see', 'lineicon-settings3', 'lineicon-shop1', 'lineicon-small56', 'lineicon-small57', 'lineicon-small58', 'lineicon-small59', 'lineicon-small60', 'lineicon-small61', 'lineicon-sound', 'lineicon-stack', 'lineicon-study', 'lineicon-t1', 'lineicon-tag6', 'lineicon-tv1', 'lineicon-user12', 'lineicon-vynil', 'lineicon-wallet', 'lineicon-world5'
  ),
  "dependency"  => array('element' => 'icon_family', 'value' => 'lineicons')
);



/*-----------------------------------------------------------------------------------*/
/*  Carousel
/*-----------------------------------------------------------------------------------*/
$element_options['carousel'] = array(
    "type"        => "radio",
    "heading"     => __("Carousel", "js_composer"),
    "param_name"  => "carousel",
    "value"       => array(
      'No'        => '',
      'Yes'       => 'true',
    ),
    "default"     => ""
);

$element_options['carousel_navigation'] = array(
  "type"        => "radio",
  "heading"     => __("Carousel Navigation", "js_composer"),
  "param_name"  => "carousel_navigation",
  "value"       => array(
    'No'        => '',
    'Yes'       => 'true',
  ),
  "default"     => "",
  "dependency"  => array('element' => 'carousel', 'value' => 'true')
);

$element_options['carousel_pagination'] = array(
  "type"        => "radio",
  "heading"     => __("Carousel Pagination", "js_composer"),
  "param_name"  => "carousel_pagination",
  "value"       => array(
    'No'        => '',
    'Yes'       => 'true',
  ),
  "default"     => "",
  "dependency"  => array('element' => 'carousel', 'value' => 'true')
);

$element_options['carousel_autoplay'] = array(
  "type"        => "radio",
  "heading"     => __("Carousel Autoplay", "js_composer"),
  "param_name"  => "carousel_autoplay",
  "value"       => array(
    'No'        => '',
    'Yes'       => 'true',
  ),
  "default"     => "",
  "dependency"  => array('element' => 'carousel', 'value' => 'true')
);



/*-----------------------------------------------------------------------------------*/
/*  Buttons
/*-----------------------------------------------------------------------------------*/
$element_options['href'] = array(
      "type"        => "textfield",
      "heading"     => __("Link URL", "js_composer"),
      "param_name"  => "href",
      "value"       => __("#", "js_composer"),
);

$element_options['target'] =  array(
  "type"        => "radio",
  "heading"     => __("Open in", "js_composer"),
  "param_name"  => "target",
  "value"       => array(
    __("Same window", "js_composer") => "",
    __("New window", "js_composer") => "_blank"
  ),
  'default' => ''
);

$element_options['button_size'] = array(
      "type"        => "radio",
      "heading"     => __("Size", "js_composer"),
      "param_name"  => "size",
      "value"       => array(
        __('Medium', "js_composer")         => "medium", 
        __('Large', "js_composer")          => "large", 
        __('Small', "js_composer")          => "small", 
        __('Extra Small', "js_composer")    => "extra-small", 
        __('Block', "js_composer")          => "block", 
      ),
      "default"     => 'medium',
);

$element_options['button_style'] = array(
      "type"        => "radio",
      "heading"     => __("Button Style", "js_composer"),
      "param_name"  => "style",
      "value"       => array(
        __('Style 1', "js_composer")  => "style-1", 
        __('Style 2', "js_composer")  => "style-2", 
      ),
      "default"     => "style-1"
);

$element_options['button_color'] = array(
      "type"        => "colorpicker",
      "heading"     => __("Text Color", "js_composer"),
      "param_name"  => "color",
      "value"       => '#ffffff',
);

$element_options['button_color_hover'] = array(
      "type"        => "colorpicker",
      "heading"     => __("Text Color Hover", "js_composer"),
      "param_name"  => "colorhover",
      "value"       => "#ffffff"
);

$element_options['button_bgcolor'] = array(
      "type"        => "colorpicker",
      "heading"     => __("Background Color", "js_composer"),
      "param_name"  => "bgcolor",
      "value"       => $theme_options['accent-color'],
      "dependency"  => array('element' => 'style', 'value' => 'style-1')
);

$element_options['button_icon_show'] = array(
      "type"        => "radio",
      "heading"     => __("With Icon?", "js_composer"),
      "param_name"  => "icon_show",
      "value"       => array(
        __('No', "js_composer") => "", 
        __('Yes', "js_composer") => "with-icon", 
      ),
      "default"     => ""
);

