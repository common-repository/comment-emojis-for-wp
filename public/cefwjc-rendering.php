<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'CEFWJC_General_Hooks' ) ) {

	class CEFWJC_General_Hooks {

		/**
		 * Constructor
		 *
		 * @mvc Controller
		 */
		public function __construct() {
			add_filter( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_resources' );
		}

		/**
		 * Enqueue Scripts and Styles to theme front
		 */
		public static function enqueue_resources() {


			wp_enqueue_style( 'cefwjc-emoji', plugins_url( 'css/emoji.min.css', __FILE__ ), CEFWJC_PLUGIN_VERSION, true );
			wp_enqueue_style( 'cefwjc-front', plugins_url( 'css/cefwjc-front.css', __FILE__ ), CEFWJC_PLUGIN_VERSION, true );

			wp_enqueue_script( 'cefwjc-emoji', plugins_url( 'js/emojionearea.js', __FILE__ ), array( 'jquery' ), CEFWJC_PLUGIN_VERSION, true );
			wp_enqueue_script( 'cefwjc-front', plugins_url( 'js/cefwjc-front.js', __FILE__ ), array( 'jquery' ), CEFWJC_PLUGIN_VERSION, true );
			$emoji_data = array(
		        'position_emojis' => get_option( 'cefwjc_position_emojis' ),
		        'filter_position' => get_option( 'cefwjc_filter_position' ),
		        'skintone' => get_option( 'cefwjc_skintone' ),
		        'skintone_style' => get_option( 'cefwjc_skintone_style' ),
		        'search' => get_option( 'cefwjc_search' ),
		        'search_position' => get_option( 'cefwjc_search_position' ),
		        'recent_emojis' => get_option( 'cefwjc_recent_emojis' ),
		    );
		    wp_localize_script('cefwjc-front', 'emojisData', $emoji_data);

		}
	}
	new CEFWJC_General_Hooks();
}
