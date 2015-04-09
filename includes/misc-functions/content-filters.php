<?php 
/**
 * This file contains the function which hooks to a brick's content output
 *
 * @since 1.0.0
 *
 * @package    MP Stacks MailChimp
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

/**
 * This function hooks to the brick css output. If it is supposed to be a 'feature', then it will add the css for those features to the brick's css
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
function mp_stacks_brick_content_output_css_mailchimp( $css_output, $post_id, $first_content_type, $second_content_type ){
	
	if ( $first_content_type != 'mailchimp' && $second_content_type != 'mailchimp' ){
		return $css_output;	
	}
	
	$css_mailchimp_output = NULL;
	
	//Set the color our text and messages should be
	$css_mailchimp_output .= '
	#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup,
	#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup a{';
					
		$mailchimp_message_color = get_post_meta($post_id, 'mailchimp_message_color', true);
		if ( !empty( $mailchimp_message_color ) ) {
			$css_mailchimp_output .= 'color: ' . $mailchimp_message_color  . ';';
		}
		
	$css_mailchimp_output .= '}';
	
	//Get Submit Button Colors and Styles
	$css_mailchimp_output .= '#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp_stacks_mailchimp_submit{ ';
		
		//Submit Button Color
		$mailchimp_submit_button_color = mp_core_get_post_meta($post_id, 'mailchimp_submit_button_color', '#5b5b5b');
		if ( !empty( $mailchimp_submit_button_color ) ) {
			$css_mailchimp_output .= 'background-color: ' . $mailchimp_submit_button_color  . ';';
		}
		
		//Submit Button Text Color
		$mailchimp_submit_button_text_color = mp_core_get_post_meta($post_id, 'mailchimp_submit_button_text_color', '#fff');
		if ( !empty( $mailchimp_submit_button_text_color ) ) {
			$css_mailchimp_output .= 'color: ' . $mailchimp_submit_button_text_color  . ';';
		}
		
		//Submit Button Font Size
		$mailchimp_submit_button_fontsize = mp_core_get_post_meta($post_id, 'mailchimp_submit_button_fontsize', '16');
		if ( !empty( $mailchimp_submit_button_fontsize ) ) {
			$css_mailchimp_output .= 'font-size: ' . $mailchimp_submit_button_fontsize  . 'px;';
		}
		
		//Submit Button Border Radius
		$mailchimp_overall_corner_radius = mp_core_get_post_meta($post_id, 'mailchimp_overall_corner_radius', '0');
		if ( $mailchimp_overall_corner_radius == 0  || !empty( $mailchimp_overall_corner_radius ) ) {
			$css_mailchimp_output .= 'border-radius: 0px ' . $mailchimp_overall_corner_radius . 'px ' . $mailchimp_overall_corner_radius . 'px 0px;';
		}
		
		//Submit Button Height
		$mailchimp_overall_height = get_post_meta($post_id, 'mailchimp_overall_height', true);
		$mailchimp_overall_height = empty($mailchimp_overall_height) ? 36 : $mailchimp_overall_height;
		if ( !empty( $mailchimp_overall_height ) ) {
			$css_mailchimp_output .= 'height: ' . $mailchimp_overall_height . 'px;';
		}
	
	$css_mailchimp_output .= '}';
	
	//Get hover settings for submit button
	$css_mailchimp_output .= '#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp_stacks_mailchimp_submit:hover{ ';
		
		//Button Color Hover
		$mailchimp_mouseover_submit_button_color = mp_core_get_post_meta($post_id, 'mailchimp_mouseover_submit_button_color', '#5b5b5b');
		if ( !empty( $mailchimp_mouseover_submit_button_color ) ) {
			$css_mailchimp_output .= 'background-color: ' . $mailchimp_mouseover_submit_button_color  . ';';
		}
		
		//Button Text Color Hover
		$mailchimp_mouseover_submit_button_text_color = mp_core_get_post_meta($post_id, 'mailchimp_mouseover_submit_button_text_color', '#8d8d8d');
		if ( !empty( $mailchimp_mouseover_submit_button_text_color ) ) {
			$css_mailchimp_output .= 'color: ' . $mailchimp_mouseover_submit_button_text_color  . ';';
		}
	
	$css_mailchimp_output .= '}';
	
	//Email Field-Container Styling
	$css_mailchimp_output .= '#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp-stacks-mailchimp-sign-up-container{ ';
	
		$mailchimp_email_input_field_width = mp_core_get_post_meta($post_id, 'mailchimp_email_input_field_width', '300');
		if ( !empty( $mailchimp_email_input_field_width ) ) {
			$css_mailchimp_output .= 'max-width: ' . $mailchimp_email_input_field_width  . 'px;';
		}
	
	$css_mailchimp_output .= '}';
		
	//Email Field Styling
	$css_mailchimp_output .= '#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp-stacks-mailchimp-email{ ';
		
		//Email Field Height
		if ( !empty( $mailchimp_overall_height ) ) {
			$css_mailchimp_output .= 'height: ' . $mailchimp_overall_height  . 'px;';
		}
		
		//Email Field Font Size
		$mailchimp_email_input_field_fontsize = mp_core_get_post_meta($post_id, 'mailchimp_email_input_field_fontsize', '14');
		if ( !empty( $mailchimp_email_input_field_fontsize ) ) {
			$css_mailchimp_output .= 'font-size: ' . $mailchimp_email_input_field_fontsize  . 'px;';
		}
		
		//Email Field Font Color
		$mailchimp_email_input_field_fontcolor = mp_core_get_post_meta($post_id, 'mailchimp_email_input_field_fontcolor', '#000');
		if ( !empty( $mailchimp_email_input_field_fontcolor ) ) {
			$css_mailchimp_output .= 'color: ' . $mailchimp_email_input_field_fontcolor  . ';';
		}
		
		//Email Field Background Color
		$mailchimp_email_input_field_backgroundcolor = mp_core_get_post_meta($post_id, 'mailchimp_email_input_field_backgroundcolor', '#FFF');
		if ( !empty( $mailchimp_email_input_field_backgroundcolor ) ) {
			$css_mailchimp_output .= 'background-color: ' . $mailchimp_email_input_field_backgroundcolor  . ';';
		}
		
		//Email Field Border Radius
		if ( $mailchimp_overall_corner_radius == 0  || !empty( $mailchimp_overall_corner_radius ) ) {
			$css_mailchimp_output .= 'border-radius: ' . $mailchimp_overall_corner_radius . 'px';
		}
	
	$css_mailchimp_output .= '}';
	
	return $css_mailchimp_output . $css_output;
		
}
add_filter('mp_brick_additional_css', 'mp_stacks_brick_content_output_css_mailchimp', 10, 4);

/**
 * This function hooks to the brick output. If it is supposed to be a 'mailchimp', then it will output the mailchimp
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
function mp_stacks_brick_content_output_mailchimp($default_content_output, $mp_stacks_content_type, $post_id){
	
	//If this stack content type is set to be an image	
	if ($mp_stacks_content_type != 'mailchimp'){
		
		//Return Default
		return $default_content_output;
	}
		
	//Get the message we should put on the submit button
	$submit_button_text = get_post_meta( $post_id, 'mailchimp_submit_button_text', true );
	$submit_button_text = empty( $submit_button_text ) ? __( 'Join', 'mp_stacks_mailchimp' ) : $submit_button_text;
			
	$mailchimp_output = '
	<form id="mp_stacks_mailchimp_signup_' . $post_id. '" class="mp_stacks_mailchimp_signup" method="post">
		<fieldset>
			<div class="mp-stacks-mailchimp-sign-up-container">
				<input value="" class="mp-stacks-mailchimp-email" name="mp_stacks_mailchimp_email" size="100" type="text" placeholder="' . __('Email Address', 'mp_stacks_mailchimp' ) . '"/>
				<input value="' . $post_id . '" class="mp-stacks-mailchimp-brick-id" name="mp_stacks_mailchimp_brick_id" type="hidden" />
				<div class="mp_stacks_mailchimp_submit"><div class="mp_stacks_mailchimp_submit_text">' . $submit_button_text . '</div></div>
			</div>
		</fieldset>
	</form>';
	
	//Return
	return $mailchimp_output;
	
}
add_filter('mp_stacks_brick_content_output', 'mp_stacks_brick_content_output_mailchimp', 10, 3);