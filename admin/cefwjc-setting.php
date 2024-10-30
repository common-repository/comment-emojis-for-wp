<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'CEFWJC_COMMENT_SETTING' ) ) {

	class CEFWJC_COMMENT_SETTING {

		/**
		 * Constructor
		 *
		 * @mvc Controller
		 */
		public function __construct() {
	        add_action('admin_menu', array($this, 'wp_comment_emojis_setup'));
	        add_action('admin_init', array( $this, 'update_wp_comment_emojis_options'));
	        add_filter('plugin_action_links_' .CEFWJC_PLUGIN_BASE, array( $this, 'comment_emojis_settings_link'));
	        add_filter('admin_enqueue_scripts', __CLASS__ . '::enqueue_admin_script');
	    }

	     public function wp_comment_emojis_setup() {
	        add_options_page('Comment Emojis for WP', 'Comment Emojis', 'manage_options',  'comment-emojis-settings', array($this, 'wp_comment_emojis_callback'));
	    }

	    /**
		 * Enqueue Scripts and Styles to theme front
		 */
		public static function enqueue_admin_script() {
			wp_enqueue_style('cefwjc-emoji', plugins_url('css/cefwjc-admin.css', __FILE__), CEFWJC_PLUGIN_VERSION, true);
		}

	    public function wp_comment_emojis_callback() {
	        wp_enqueue_media();
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');

	        echo '<div class="comment-emojis-title">
					<h1>Comment Emojis for WP</h1>
				</div>
		        <div class="wrap tab_wrapper wp_comment_emojis_aria">
					<div class="main-panel">
						<div id="tab_dashbord" class="cefwjc_main_tabs active"><a href="#dashbord">Dashboard</a></div>
						<div id="tab_info" class="cefwjc_main_tabs"><a href="#info">Info</a></div>
					</div>

					<div class="boxed" id="percentage_form">
						<div class="cefwjc_tabs tab_dashbord">
							<div class="wrap">
								<form method="post" action="options.php">';
									$hide_field_serch = '';
									$hide_field_skin = '';
									if(get_option('cefwjc_search' ) == 'yes'){
										$hide_field_serch = 'display:none';
									}
									if(get_option('cefwjc_skintone' ) == 'yes'){
										$hide_field_skin = 'display:none';
									}
									settings_fields('cefwjc_comment_emojis_options');
									do_settings_sections('cefwjc_comment_emojis_options');
									echo ' <h2>WP Comment Emojis Settings</h2>
									<div id="wc_prd_vid_slider-description">
										<p>The following options are used to configure WP Comment Emojis</p>
									</div>

									<table class="form-table">
										<tbody>
											<tr valign="top">
												<th scope="row" class="titledesc">
													<label for="cefwjc_position_emojis">Position of the emojis picker</label>
												</th>
												<td class="forminp forminp-select">
													<select name="cefwjc_position_emojis" id="cefwjc_position_emojis" style="">
														<option value="top"'.selected('top', get_option('cefwjc_position_emojis'), false).'>Top</option>
														<option value="right"'.selected('right', get_option('cefwjc_position_emojis'), false).'>Right</option>
														<option value="bottom"'.selected('bottom', get_option('cefwjc_position_emojis'), false).'>Bottom</option>
													</select>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row" class="titledesc">
													<label for="cefwjc_filter_position">Position of the filters header in the emojis picker</label>
												</th>
												<td class="forminp forminp-select">
													<select name="cefwjc_filter_position" id="cefwjc_filter_position" style="">
														<option value="top"'.selected('top', get_option('cefwjc_filter_position'), false).'>Top</option>
														<option value="bottom"'.selected('bottom', get_option('cefwjc_filter_position'), false).'>Bottom</option>
													</select>
												</td>
											</tr>
											<tr valign="top">
												<th scope="row" class="titledesc"><label for="cefwjc_skintone">Hide skin tone buttons emoji</label></th>
												<td class="forminp forminp-checkbox">
													<input name="cefwjc_skintone" id="cefwjc_skintone" class="toggle-checkbox" type="checkbox" value="yes"'.checked('yes', get_option('cefwjc_skintone'), false).'>
													<samll class="lbl_tc">Whether to show and hide the skin tone buttons in the emoji picker.</samll>
												</td>
											</tr>';
											echo '<tr valign="top" id="skintone_hide" style='.esc_html($hide_field_skin).'>
													<th scope="row" class="titledesc">
														<label for="cefwjc_skintone_style">Style of the skin tones selector</label>
													</th>
													<td class="forminp forminp-select">
														<select name="cefwjc_skintone_style" id="cefwjc_skintone_style" style="">
															<option value="bullet"'.selected('bullet', get_option('cefwjc_skintone_style'), false) .'>Bullet</option>
															<option value="radio"'.selected('radio', get_option('cefwjc_skintone_style'), false). '>Radio</option>
															<option value="square"'.selected('square', get_option('cefwjc_skintone_style'), false) .'>Square</option>
															<option value="checkbox"'.selected('checkbox', get_option('cefwjc_skintone_style'), false ).'>Checkbox</option>
														</select>
													</td>
												</tr>';
											echo '<tr valign="top">
												<th scope="row" class="titledesc"><label for="cefwjc_search">Disable search emojis</label></th>
												<td class="forminp forminp-checkbox">
													<input name="cefwjc_search" id="cefwjc_search" class="toggle-checkbox" type="checkbox" value="yes"'.checked('yes', get_option('cefwjc_search'), false).'>
													<samll class="lbl_tc">Whether is enabled or disable search emojis in the picker.</samll>
												</td>
											</tr>';
											echo '<tr valign="top" id="search_hide" style='.esc_html($hide_field_serch).'>
													<th scope="row" class="titledesc">
														<label for="cefwjc_search_position">Search panel position</label>
													</th>
													<td class="forminp forminp-select">
														<select name="cefwjc_search_position" id="cefwjc_search_position" style="">
															<option value="top"'.selected('top', get_option('cefwjc_search_position'), false) . '>Top</option>
															<option value="bottom"'.selected('bottom', get_option('cefwjc_search_position'), false).'>Bottom</option>
														</select>
													</td>
												</tr>';
											echo '<tr valign="top">
												<th scope="row" class="titledesc"><label for="cefwjc_recent_emojis">Hide recently selected emojis</label></th>
												<td class="forminp forminp-checkbox">
													<input name="cefwjc_recent_emojis" id="cefwjc_recent_emojis" class="toggle-checkbox" type="checkbox" value="yes"'.checked('yes', get_option('cefwjc_recent_emojis'), false). '>
													<samll class="lbl_tc">Whether to show or hide recently selected emojis in the picker.</samll>
												</td>
											</tr>											
										</tbody>
										<tfoot>
											<tr>
												<td class="submit_btn_cls">';
													submit_button();
												echo ' </td>
											</tr>
										</tfoot>
									</table>
								</form>
							</div>
						</div>

						<div class="cefwjc_tabs tab_info" style="display:none;">
							<h2>Comment Emojis for WP</h2>
							<p>01. React with emojis to any post or comment.</p>
							<p>02. Allow guests reaction or logged-in user reaction on comments.</p>
							<p>03. User will see recent react emojis in the picker.</p>
							<p>04. Search emojis in the picker with standalone emojis name.</p>
							<p>05. User will filter emojis in the picker with diffrent category emojis and also using scroll on picker box.</p>
							<p>06. User allow to add multiple emojis on comments textarea to submit post comment.</p>

							<h4 style="color: red;margin: 0 0px 5px 0px;">Compatibility Note:</h4> <p style="color: red; font-size: 12px;margin: 0;">1). Comment Emojis for WP Plugin only work with default comment textarea HTML structure. If you have custom textarea for comment plugin will not support for that post textarea.</p>
							<p style="color: red; font-size: 12px;margin: 0;">2). Comment Emojis for WP Plugin comments will support if SQL database Collation(utf8mb4) or similar in database table.</p> 
							
						</div>
					</div>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function(e)
					{
						jQuery("div.cefwjc_main_tabs").click(function(e)
						{
							jQuery(".cefwjc_main_tabs").removeClass("active");
							jQuery(this).addClass("active");
							jQuery(".cefwjc_tabs").hide();
							jQuery("."+this.id).show();
						});
					});
					jQuery("#cefwjc_skintone").change(function(){
					    if(jQuery(this).is(":checked")) {
					    	jQuery("#skintone_hide").hide();					      
					    } else {
					      	jQuery("#skintone_hide").show();
					    }
					});
					jQuery("#cefwjc_search").change(function(){
					    if(jQuery(this).is(":checked")) {
					    	jQuery("#search_hide").hide();					      
					    } else {
					      	jQuery("#search_hide").show();
					    }
					});
				</script>';
	    }

	    public function update_wp_comment_emojis_options( $value = '' ) {
			register_setting( 'cefwjc_comment_emojis_options', 'cefwjc_position_emojis' );
			register_setting( 'cefwjc_comment_emojis_options', 'cefwjc_filter_position' );
			register_setting( 'cefwjc_comment_emojis_options', 'cefwjc_skintone' );
			register_setting( 'cefwjc_comment_emojis_options', 'cefwjc_skintone_style' );
			register_setting( 'cefwjc_comment_emojis_options', 'cefwjc_search' );
			register_setting( 'cefwjc_comment_emojis_options', 'cefwjc_search_position' );
			register_setting( 'cefwjc_comment_emojis_options', 'cefwjc_recent_emojis' );
		}
	    
	    public function comment_emojis_settings_link( $links ) {
			$links[] = '<a href="' . esc_url( admin_url() ) . 'options-general.php?page=comment-emojis-settings">Settings</a>';
			return $links;
		}
	}
}