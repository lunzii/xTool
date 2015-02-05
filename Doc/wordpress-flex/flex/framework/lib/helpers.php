<?php 

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Set Class
/* ----------------------------------------------------------------------------------*/
if(!function_exists('setClass')) {
  function setClass($classes){

    if($classes){
      $return = '';
      foreach($classes as $class)
      {
          if(trim($class))
          $return .= trim($class).' ';
      }
      if(trim($return) != '')
      return ' class="'.trim($return).'"';
   }

  }
}



/*-----------------------------------------------------------------------------------*/
/*  Set ID
/* ----------------------------------------------------------------------------------*/
if(!function_exists('setId')) {
  function setId($id = false, $fallback_id = false){

    if($id)
      return ' id="'.trim($id).'"';

    if(!$id && $fallback_id)
      return ' id="'.trim($fallback_id).'"';
    
  }
}



/*-----------------------------------------------------------------------------------*/
/*  Set Animation
/* ----------------------------------------------------------------------------------*/
if(!function_exists('setAnimation')) {
  function setAnimation($animation = false){

    if($animation && !md_detect_mobile())
      return ' data-animation="'.$animation.'"';

  }
}


/*-----------------------------------------------------------------------------------*/
/*  Hex 2 Rgb
/*-----------------------------------------------------------------------------------*/
function hex2rgb($hex, $opacity) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return 'rgba('.$r.', '.$g.', '.$b.', '.$opacity.')'; // returns an array with the rgb values
}


/*-----------------------------------------------------------------------------------*/
/*  Detect Mobile
/* ----------------------------------------------------------------------------------*/
if(!function_exists('md_detect_mobile')) {
  function md_detect_mobile() {
    require_once('mobile-detect.php');
    $detect = new Mobile_Detect;

    if($detect->isMobile() || $detect->isTablet())
      return true;

    else return false;
  }
}


/*-----------------------------------------------------------------------------------*/
/*  MD Thumbnail
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_thumbnail')) {
    function md_thumbnail($size = 'md-half', $post_id, $fallback = true, $link = true, $return = false){
        
        if (!has_post_thumbnail($post_id) && !$fallback) return false;

        $post_type = (get_post_type($post_id)) ? get_post_type($post_id) : 'post';

        $output = '<div class="featured-image">';
            if($link)
            $output.= '<a href="'.get_the_permalink($post_id).'" title="'.esc_attr(get_the_title($post_id)).'">';
                
                if (has_post_thumbnail($post_id)):
                    $output.= get_the_post_thumbnail($post_id, $size);
                elseif ($fallback):
                    $output.= '<img src="'.MD_THEME_URI.'/assets/img/placeholder/image-'.$size.'.png" alt="" />';
                else: 
                    return false;
                endif;
                
                $output.= '<div class="featured-image-overlay"><span></span></div>';

            if($link)
            $output.= '</a>';
        $output.= '</div>';

        if(!$return)
        echo $output;

        else
        return $output;
    }
}






/*-----------------------------------------------------------------------------------*/
/*  Get Taxonomy Terms
/*-----------------------------------------------------------------------------------*/
function get_custom_post_categories($taxonomy){
  $cats = array();
  $cats['All'] = 'all';

  $categories = get_categories( array('taxonomy' => $taxonomy) );

  foreach($categories as $category):
   
    $cats[$category->name] = $category->slug;

  endforeach;

  return $cats;
}