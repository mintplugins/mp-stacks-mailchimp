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
function mp_stacks_brick_content_output_css_mailchimp( $css_output, $post_id ){
				
	//Get the color our text should be
	$mailchimp_message_color = get_post_meta($post_id, 'mailchimp_message_color', true);
	
	//Get Button Colors and Styles
	$mailchimp_submit_button_color = get_post_meta($post_id, 'mailchimp_submit_button_color', true);
	$mailchimp_submit_button_text_color = get_post_meta($post_id, 'mailchimp_submit_button_text_color', true);
	$mailchimp_mouseover_submit_button_color = get_post_meta($post_id, 'mailchimp_mouseover_submit_button_color', true);
	$mailchimp_mouseover_submit_button_text_color = get_post_meta($post_id, 'mailchimp_mouseover_submit_button_text_color', true);
	

	
	//Get Features Output
	$css_mailchimp_output = '
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup,
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup a{ 
			color: ' . $mailchimp_message_color  . ';
		}
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .button{
			background-color: ' . $mailchimp_submit_button_color .';
			color: ' . $mailchimp_submit_button_text_color .';
		}
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .button:hover{
			background-color: ' . $mailchimp_mouseover_submit_button_color .';
			color: ' . $mailchimp_mouseover_submit_button_text_color .';
		}
	';
	
	return $css_mailchimp_output . $css_output;
		
}
add_filter('mp_brick_additional_css', 'mp_stacks_brick_content_output_css_mailchimp', 10, 3);

/**
 * This function hooks to the brick output. If it is supposed to be a 'mailchimp', then it will output the mailchimp
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
function mp_stacks_brick_content_output_mailchimp($default_content_output, $mp_stacks_content_type, $post_id){
	
	//If this stack content type is set to be an image	
	if ($mp_stacks_content_type == 'mailchimp'){
		
		//Get the message we should put on the submit button
		$submit_button_text = get_post_meta( $post_id, 'mailchimp_submit_button_text', true );
		$submit_button_text = empty( $submit_button_text ) ? __( 'Join', 'mp_stacks_mailchimp' ) : $submit_button_text;
				
		$mailchimp_output = '
		<form id="mp_stacks_mailchimp_signup_' . $post_id. '" class="mp_stacks_mailchimp_signup" method="post">
			<fieldset>
				<div class="mp-stacks-mailchimp-sign-up-container">
					<input value="" class="mp-stacks-mailchimp-email" name="mp_stacks_mailchimp_email" type="text" placeholder="' . __('Email Address', 'mp_stacks_mailchimp' ) . '"/>
					<input value="' . $post_id . '" class="mp-stacks-mailchimp-brick-id" name="mp_stacks_mailchimp_brick_id" type="hidden" />
				</div>
				<input type="submit" class="button" value="' . $submit_button_text . '" />
			</fieldset>
		</form>';
		
		//Return
		return $mailchimp_output;
	}
	else{
		//Return
		return $default_content_output;
	}
}
add_filter('mp_stacks_brick_content_output', 'mp_stacks_brick_content_output_mailchimp', 10, 3);