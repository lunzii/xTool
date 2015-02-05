<?php
/**
 *
 * MD Shortcodes Social sHARE
 *
 */

$md_shortcodes['md_social_share'] = array(
  "name"            => __("Social Share", "js_composer"),
  "base"            => "md_social_share",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "radio",
      "heading"     => __("Facebook", "js_composer"),
      "param_name"  => "facebook",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Twitter", "js_composer"),
      "param_name"  => "twitter",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Google Plus", "js_composer"),
      "param_name"  => "googleplus",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Pinterest", "js_composer"),
      "param_name"  => "pinterest",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_social_share'] );

class WPBakeryShortCode_MD_Social_share extends WPBakeryShortCode {}


class shareCount {
  private $url,$timeout;
  function __construct($url,$timeout=10) {
    $this->url=rawurlencode($url);
    $this->timeout=$timeout;
  }
  function get_tweets() { 
    $json_string = $this->file_get_contents_curl('http://urls.api.twitter.com/1/urls/count.json?url=' . $this->url);
    $json = json_decode($json_string, true);
    return isset($json['count'])?intval($json['count']):0;
  }
  function get_linkedin() { 
    $json_string = $this->file_get_contents_curl("http://www.linkedin.com/countserv/count/share?url=$this->url&format=json");
    $json = json_decode($json_string, true);
    return isset($json['count'])?intval($json['count']):0;
  }
  function get_fb() {
    $json_string = $this->file_get_contents_curl('http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls='.$this->url);
    $json = json_decode($json_string, true);
    return isset($json[0]['total_count'])?intval($json[0]['total_count']):0;
  }
  function get_plusones()  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($this->url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    $curl_results = curl_exec ($curl);
    curl_close ($curl);
    $json = json_decode($curl_results, true);
    return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
  }
  function get_stumble() {
    $json_string = $this->file_get_contents_curl('http://www.stumbleupon.com/services/1.01/badge.getinfo?url='.$this->url);
    $json = json_decode($json_string, true);
    return isset($json['result']['views'])?intval($json['result']['views']):0;
  }
  function get_delicious() {
    $json_string = $this->file_get_contents_curl('http://feeds.delicious.com/v2/json/urlinfo/data?url='.$this->url);
    $json = json_decode($json_string, true);
    return isset($json[0]['total_posts'])?intval($json[0]['total_posts']):0;
  }
  function get_pinterest() {
    $return_data = $this->file_get_contents_curl('http://api.pinterest.com/v1/urls/count.json?url='.$this->url);
    $json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $return_data);
    $json = json_decode($json_string, true);
    return isset($json['count'])?intval($json['count']):0;
  }
  private function file_get_contents_curl($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    $cont = curl_exec($ch);
    if(curl_error($ch))
    {
      die(curl_error($ch));
    }
    return $cont;
  }
}