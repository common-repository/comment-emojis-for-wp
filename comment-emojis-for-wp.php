<?php
/*
Plugin Name:  		Comment Emojis for WP
Description:  		Comment Emojis for Wordpress - Reactive emoji and provides a Lighweight Emoji box to the Comment textarea of your site, and your users will be able to add these emojis inside their comments with just one touch.
Version:      		1.0.0
Requires at least: 	4.7
Requires PHP:      	7.0
Author:       		Jayesh Chopda
Author URI:   		https://profiles.wordpress.org/jayeshchopda/
License:      		GPLv2 or later
License URI:  		https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  		comment-emojis-for-wp
Domain Path:  		/languages
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! defined( 'CEFWJC_PLUGIN_BASE' ) ) {
    define( 'CEFWJC_PLUGIN_BASE', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'CEFWJC_PLUGIN_VERSION' ) ) {
    define( 'CEFWJC_PLUGIN_VERSION', '1.0.0' );
}

/**
* Activation
*
* @since 1.0.0
*/
function cefwjc_activation_hook_callback() {
	if ( empty( get_option( 'cefwjc_position_emojis' ) ) ) {
		update_option( 'cefwjc_position_emojis', 'bottom' );
		update_option( 'cefwjc_filter_position', 'top' );
		update_option( 'cefwjc_skintone', 'no' );
		update_option( 'cefwjc_skintone_style', 'bullet' );
		update_option( 'cefwjc_search', 'no' );
		update_option( 'cefwjc_search_position', 'top' );
		update_option( 'cefwjc_recent_emojis', 'no' );
	}
}

register_activation_hook( __FILE__, 'cefwjc_activation_hook_callback' );
if ( is_admin() ) {
    require_once __DIR__ . '/admin/cefwjc-setting.php';
    new CEFWJC_COMMENT_SETTING();
} else {
    require_once __DIR__ . '/public/cefwjc-rendering.php';
}