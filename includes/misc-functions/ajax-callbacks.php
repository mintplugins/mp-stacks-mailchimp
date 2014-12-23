<?php 
/**
 * Ajax callback functions for the MP Stacks Mailchimp add-on
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
 * Callback function which adds a user's email to a mailchimp email list
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
function mp_stacks_mailchimp_add_user(){
	
	if ( !isset( $_POST['mp_stacks_mailchimp_email'] ) || !isset( $_POST['mp_stacks_mailchimp_brick_id'] ) ){
		
		echo __( "Oops! Something went wrong", 'mp_stacks_mailchimp' );
		die();
			
	}
	
	$post_id = $_POST['mp_stacks_mailchimp_brick_id'];
	$mailchimp_email = $_POST['mp_stacks_mailchimp_email'];
	
	//Mailchimp list info stored in post
	$mailchimp_api_key = get_post_meta($post_id, 'mailchimp_api_key', true);
	$mailchimp_list_id = get_post_meta($post_id, 'mailchimp_list_id', true);
	$mailchimp_success_message = mp_core_get_post_meta($post_id, 'mailchimp_success_message', __( 'Thanks for joining! Check your email to confirm.', 'mp_stacks_mailchimp' ) );
	$submit_button_text = mp_core_get_post_meta( $post_id, 'mailchimp_submit_button_text', __('Join', 'mp_stacks_mailchimp' ) );
	
	//Get the size of the email input field
	$mailchimp_email_input_field_size = get_post_meta( $post_id, 'mailchimp_email_input_field_size', true);
	$mailchimp_email_input_field_size = empty( $mailchimp_email_input_field_size ) ? '35' : $mailchimp_email_input_field_size;
			
	//Mail chimp
	$mailchimp_sever_number = substr($mailchimp_api_key, -3); 
	$mailchimp_url = sprintf('http://'.$mailchimp_sever_number.'.api.mailchimp.com/1.3/?method=listSubscribe&apikey=%s&id=%s&email_address=%s&merge_vars[OPTINIP]=%s&double_optin=true&merge_vars[MMERGE1]=webdev_tutorials&output=json', $mailchimp_api_key, $mailchimp_list_id, $mailchimp_email, $_SERVER['REMOTE_ADDR']);
	
	$response = wp_remote_post( $mailchimp_url, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 'username' => 'bob', 'password' => '1234xyz' ),
		'cookies' => array()
		)
	);
	
	if ( is_wp_error( $response ) ){
		
		echo __('OOPS! API and List Keys for this mailinglist have not yet been configured. Please notify the website owner.', 'mp_stacks_mailchimp');
		die();
			
	}
	
	$response = json_decode($response['body']);
	
	if ( isset( $response->error ) ){
		
		echo '<div class="mp-stacks-mailchimp-error">' . $response->error . '</div>
	
		<fieldset>
			<div class="mp-stacks-mailchimp-sign-up-container">
				<input value="" class="mp-stacks-mailchimp-email" name="mp_stacks_mailchimp_email" size="100" type="text" placeholder="' . __('Email Address', 'mp_stacks_mailchimp' ) . '"/>
				<input value="' . $post_id . '" class="mp-stacks-mailchimp-brick-id" name="mp_stacks_mailchimp_brick_id" type="hidden" />
				<div class="mp_stacks_mailchimp_submit"><div class="mp_stacks_mailchimp_submit_text">' . $submit_button_text . '</div></div>
			</div>
		</fieldset>';
		
	}
	else{
		
		echo '<div class="mp-stacks-mailchimp-success">' . $mailchimp_success_message . '</div>';
	}
	
	die();
		
}
add_action('wp_ajax_mp_stacks_mailchimp', 'mp_stacks_mailchimp_add_user');
add_action('wp_ajax_nopriv_mp_stacks_mailchimp', 'mp_stacks_mailchimp_add_user');