<?php
/**
 * This page contains functions for modifying the metabox for mailchimp as a media type
 *
 * @link http://mintplugins.com/doc/
 * @since 1.0.0
 *
 * @package    MP Stacks MailChimp
 * @subpackage Functions
 *
 * @copyright   Copyright (c) 2014, Mint Plugins
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author      Philip Johnston
 */
 
/**
 * Add PostGrid as a Media Type to the dropdown
 *
 * @since    1.0.0
 * @link     http://mintplugins.com/doc/
 * @param    array $args See link for description.
 * @return   void
 */
function mp_stacks_mailchimp_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_stacks_mailchimp_add_meta_box = array(
		'metabox_id' => 'mp_stacks_mailchimp_metabox', 
		'metabox_title' => __( '"MailChimp Sign-Up" Content-Type', 'mp_stacks_mailchimp'), 
		'metabox_posttype' => 'mp_brick', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'low' 
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_stacks_mailchimp_items_array = array(
		array(
			'field_id'			=> 'mailchimp_api_key',
			'field_title' 	=> __( 'Enter your MailChimp API Key', 'mp_stacks_mailchimp'),
			'field_description' 	=> '<br /><a href="https://admin.mailchimp.com/account/api-key-popup" target="_blank">' . __('Find Your MailChimp API Key Here', 'mp_stacks_mailchimp' ) . '</a>' ,
			'field_type' 	=> 'textbox',
		),
		array(
				'field_id'			=> 'mailchimp_list_id',
				'field_title' 	=> __( 'Enter your MailChimp List ID', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br /><a href="http://kb.mailchimp.com/article/how-can-i-find-my-list-id/" target="_blank">' . __('Find your MailChimp List ID', 'mp_stacks_mailchimp' ) . '</a>' ,
				'field_type' 	=> 'textbox',
		),
		array(
				'field_id'			=> 'mailchimp_success_message',
				'field_title' 	=> __( 'Success Message', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br />What message should be shown to the user when they successfully join your mailing list. Example: "Thanks For Joining! Check your email to confirm.' ,
				'field_type' 	=> 'textbox',
		),
		array(
				'field_id'			=> 'mailchimp_message_color',
				'field_title' 	=> __( 'Message Color', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br />What color should the text be when used (for success/failure messages)' ,
				'field_type' 	=> 'colorpicker',
		),
		array(
				'field_id'			=> 'mailchimp_submit_button_text',
				'field_title' 	=> __( 'Submit Button Text', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br />What should the submit button say? Default: "Join"' ,
				'field_type' 	=> 'textbox',
		),
		array(
				'field_id'			=> 'mailchimp_submit_button_color',
				'field_title' 	=> __( 'Submit Button Color', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br />What color should the submit button be?' ,
				'field_type' 	=> 'colorpicker',
		),
		array(
				'field_id'			=> 'mailchimp_submit_button_text_color',
				'field_title' 	=> __( 'Submit Button Text Color', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br />What color should the submit button be?' ,
				'field_type' 	=> 'colorpicker',
		),
		array(
				'field_id'			=> 'mailchimp_mouseover_submit_button_color',
				'field_title' 	=> __( 'Mouse Over Submit Button Color', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br />What color should the submit button be when the mouse is over it?' ,
				'field_type' 	=> 'colorpicker',
		),
		array(
				'field_id'			=> 'mailchimp_mouseover_submit_button_text_color',
				'field_title' 	=> __( 'Mouse Over Submit Button Text Color', 'mp_stacks_mailchimp'),
				'field_description' 	=> '<br />What color should the submit button\'s text be when the mouse is over it?' ,
				'field_type' 	=> 'colorpicker',
		),
		
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_stacks_mailchimp_add_meta_box = has_filter('mp_stacks_mailchimp_meta_box_array') ? apply_filters( 'mp_stacks_mailchimp_meta_box_array', $mp_stacks_mailchimp_add_meta_box) : $mp_stacks_mailchimp_add_meta_box;
	
	//Globalize the and populate mp_stacks_features_items_array (do this before filter hooks are run)
	global $global_mp_stacks_mailchimp_items_array;
	$global_mp_stacks_mailchimp_items_array = $mp_stacks_mailchimp_items_array;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_stacks_mailchimp_items_array = has_filter('mp_stacks_mailchimp_items_array') ? apply_filters( 'mp_stacks_mailchimp_items_array', $mp_stacks_mailchimp_items_array) : $mp_stacks_mailchimp_items_array;
	
	/**
	 * Create Metabox class
	 */
	global $mp_stacks_mailchimp_meta_box;
	$mp_stacks_mailchimp_meta_box = new MP_CORE_Metabox($mp_stacks_mailchimp_add_meta_box, $mp_stacks_mailchimp_items_array);
}
add_action('widgets_init', 'mp_stacks_mailchimp_create_meta_box');