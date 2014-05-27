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
	
	$css_mailchimp_output = NULL;
				
	//Get the color our text should be
	$mailchimp_message_color = get_post_meta($post_id, 'mailchimp_message_color', true);
	if ( !empty( $mailchimp_message_color ) ) {
		$css_mailchimp_output .= '
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup,
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup q{ 
			color: ' . $mailchimp_message_color  . ';
		}';
	}
	
	//Get Button Colors and Styles
	$mailchimp_submit_button_color = get_post_meta($post_id, 'mailchimp_submit_button_color', true);
	if ( !empty( $mailchimp_submit_button_color ) ) {
		$css_mailchimp_output .= '
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp_stacks_mailchimp_submit{ 
			background-color: ' . $mailchimp_submit_button_color  . ';
		}';
	}
	
	$mailchimp_submit_button_text_color = get_post_meta($post_id, 'mailchimp_submit_button_text_color', true);
	if ( !empty( $mailchimp_submit_button_text_color ) ) {
		$css_mailchimp_output .= '
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp_stacks_mailchimp_submit{ 
			color: ' . $mailchimp_submit_button_text_color  . ';
		}';
	}
	
	$mailchimp_mouseover_submit_button_color = get_post_meta($post_id, 'mailchimp_mouseover_submit_button_color', true);
	if ( !empty( $mailchimp_mouseover_submit_button_color ) ) {
		$css_mailchimp_output .= '
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp_stacks_mailchimp_submit:hover{ 
			background-color: ' . $mailchimp_mouseover_submit_button_color  . ';
		}';
	}
	
	$mailchimp_mouseover_submit_button_text_color = get_post_meta($post_id, 'mailchimp_mouseover_submit_button_text_color', true);
	if ( !empty( $mailchimp_mouseover_submit_button_text_color ) ) {
		$css_mailchimp_output .= '
		#mp-brick-' . $post_id . ' .mp_stacks_mailchimp_signup .mp_stacks_mailchimp_submit:hover{ 
			color: ' . $mailchimp_mouseover_submit_button_text_color  . ';
		}';
	}

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
		
		//Get the size of the email input gield
		$mailchimp_email_input_field_size = get_post_meta( $post_id, 'mailchimp_email_input_field_size', true);
		$mailchimp_email_input_field_size = empty( $mailchimp_email_input_field_size ) ? '35' : $mailchimp_email_input_field_size;
				
		$mailchimp_output = '
		<form id="mp_stacks_mailchimp_signup_' . $post_id. '" class="mp_stacks_mailchimp_signup" method="post">
			<fieldset>
				<div class="mp-stacks-mailchimp-sign-up-container">
					<input value="" class="mp-stacks-mailchimp-email" name="mp_stacks_mailchimp_email" size="' . $mailchimp_email_input_field_size . '" type="text" placeholder="' . __('Email Address', 'mp_stacks_mailchimp' ) . '"/>
					<input value="' . $post_id . '" class="mp-stacks-mailchimp-brick-id" name="mp_stacks_mailchimp_brick_id" type="hidden" />
				</div>
				<div class="mp_stacks_mailchimp_submit button">' . $submit_button_text . '</div>
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