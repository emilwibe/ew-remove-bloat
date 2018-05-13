<?php
/*
Plugin Name: EW Remove bloat
Author: Emil Wibe
Author URI: https://ew.dk
Description: Disables standard code from WordPress such as emojis and more
Version: 1.0
License: GPLv3
*/
// disable edituri
remove_action('wp_head', 'rsd_link');
// disable wlwmanifest
remove_action('wp_head', 'wlwmanifest_link');
// disable shortlink
remove_action('wp_head', 'wp_shortlink_wp_head');
// disable generator
remove_action('wp_head', 'wp_generator');
// disable wp-json
remove_action('wp_head', 'rest_output_link_wp_head');
// disable oembed
remove_action('wp_head', 'wp_oembed_add_discovery_links');
// disable canonical
remove_filter('template_redirect', 'redirect_canonical');
// disable wp-embed
function ew_deregister_scripts(){
	wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'ew_deregister_scripts');
function disable_wp_emojicons() {
 // all actions related to emojis
 remove_action('admin_print_styles', 'print_emoji_styles');
 remove_action('wp_head', 'print_emoji_detection_script', 7);
 remove_action('admin_print_scripts', 'print_emoji_detection_script');
 remove_action('wp_print_styles', 'print_emoji_styles');
 remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
 remove_filter('the_content_feed', 'wp_staticize_emoji');
 remove_filter('comment_text_rss', 'wp_staticize_emoji');
 // filter to remove TinyMCE emojis
 add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');
function disable_emojicons_tinymce($plugins){
	if(is_array($plugins)){
  	return array_diff($plugins, array('wpemoji'));
    } else{
      return array();
    }
  }
?>
