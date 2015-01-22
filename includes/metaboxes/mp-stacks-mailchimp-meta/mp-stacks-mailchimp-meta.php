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
				'field_id'			=> 'mailchimp_messages_showhider',
				'field_title' 	=> __( 'Messages - Custom Settings', 'mp_stacks_mailchimp'),
				'field_description' 	=> '' ,
				'field_type' 	=> 'showhider',
		),
			array(
					'field_id'			=> 'mailchimp_success_message',
					'field_title' 	=> __( 'Success Message', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What message should be shown to the user when they successfully join your mailing list. Default: "Thanks For Joining! Check your email to confirm."', 'mp_stacks_mailchimp' ) ,
					'field_type' 	=> 'textbox',
					'field_showhider' => 'mailchimp_messages_showhider'
			),
			array(
					'field_id'			=> 'mailchimp_message_color',
					'field_title' 	=> __( 'Message Color', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What color should the text be when used (for success/failure messages)', 'mp_stacks_mailchimp' ),
					'field_type' 	=> 'colorpicker',
					'field_showhider' => 'mailchimp_messages_showhider'
			),
		array(
				'field_id'			=> 'mailchimp_submit_button_color_showhider',
				'field_title' 	=> __( '"Submit" Button - Custom Settings', 'mp_stacks_mailchimp'),
				'field_description' 	=> '' ,
				'field_type' 	=> 'showhider',
		),
			array(
					'field_id'			=> 'mailchimp_submit_button_text',
					'field_title' 	=> __( 'Submit Button Text', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What should the submit button say? Default: "Join"', 'mp_stacks_mailchimp' ),
					'field_type' 	=> 'textbox',
					'field_showhider'			=> 'mailchimp_submit_button_color_showhider',
			),
			array(
					'field_id'			=> 'mailchimp_submit_button_color',
					'field_title' 	=> __( 'Submit Button Color', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What color should the submit button be?', 'mp_stacks_mailchimp' ),
					'field_type' 	=> 'colorpicker',
					'field_value' => '#5b5b5b',
					'field_showhider'			=> 'mailchimp_submit_button_color_showhider',
			),
			array(
					'field_id'			=> 'mailchimp_submit_button_text_color',
					'field_title' 	=> __( 'Submit Button Text Color', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What color should the submit button be?', 'mp_stacks_mailchimp' ),
					'field_type' 	=> 'colorpicker',
					'field_value' => '#fff',
					'field_showhider'			=> 'mailchimp_submit_button_color_showhider',
			),
			array(
					'field_id'			=> 'mailchimp_mouseover_submit_button_color',
					'field_title' 	=> __( 'Mouse Over Submit Button Color', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What color should the submit button be when the mouse is over it?', 'mp_stacks_mailchimp' ),
					'field_type' 	=> 'colorpicker',
					'field_value' => '#8d8d8d',
					'field_showhider'			=> 'mailchimp_submit_button_color_showhider',
			),
			array(
					'field_id'			=> 'mailchimp_mouseover_submit_button_text_color',
					'field_title' 	=> __( 'Mouse Over Submit Button Text Color', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What color should the submit button\'s text be when the mouse is over it?', 'mp_stacks_mailchimp' ),
					'field_type' 	=> 'colorpicker',
					'field_value' => '#fff',
					'field_showhider'			=> 'mailchimp_submit_button_color_showhider',
			),
			array(
				'field_id'			=> 'mailchimp_submit_button_fontsize',
				'field_title' 	=> __( 'Submit Button Font Size', 'mp_stacks_mailchimp'),
				'field_description' 	=> __( 'What size should the font size be for the submit button? Default: 16', 'mp_stacks_mailchimp' ) ,
				'field_type' 	=> 'number',
				'field_value' => '16',
				'field_showhider'			=> 'mailchimp_submit_button_color_showhider',
			),
		array(
				'field_id'			=> 'mailchimp_emailfield_settings_showhider',
				'field_title' 	=> __( '"Email" Field - Custom Settings', 'mp_stacks_mailchimp'),
				'field_description' 	=> '' ,
				'field_type' 	=> 'showhider',
		),
			array(
					'field_id'			=> 'mailchimp_email_input_field_fontsize',
					'field_title' 	=> __( 'Email input field font-size', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What size should the font be for the email input field in pixels. Default: 14)', 'mp_stacks_mailchimp' ) ,
					'field_type' 	=> 'number',
					'field_value' 	=> '14',
					'field_showhider'			=> 'mailchimp_emailfield_settings_showhider',
			),
			array(
					'field_id'			=> 'mailchimp_email_input_field_fontcolor',
					'field_title' 	=> __( 'Email input field font-color', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What color should the font be for the email input field?)', 'mp_stacks_mailchimp' ) ,
					'field_type' 	=> 'colorpicker',
					'field_value' 	=> '#000',
					'field_showhider'			=> 'mailchimp_emailfield_settings_showhider',
			),
			array(
					'field_id'			=> 'mailchimp_email_input_field_backgroundcolor',
					'field_title' 	=> __( 'Email input field background-color', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What color should the background be for the email input field?)', 'mp_stacks_mailchimp' ) ,
					'field_type' 	=> 'colorpicker',
					'field_value' 	=> '#FFF',
					'field_showhider'			=> 'mailchimp_emailfield_settings_showhider',
			),
		array(
				'field_id'	=> 'mailchimp_overall_size_settings_showhider',
				'field_title' 	=> __( 'Overall Size and Shape - Custom Settings', 'mp_stacks_mailchimp'),
				'field_description' => '' ,
				'field_type' 	=> 'showhider',
		),
			array(
					'field_id'			=> 'mailchimp_overall_height',
					'field_title' 	=> __( 'Overall height', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'How high should the email input field and submit button be in pixels? Default: 36px', 'mp_stacks_mailchimp' ) ,
					'field_type' 	=> 'number',
					'field_value' 	=> '36',
					'field_showhider' => 'mailchimp_overall_size_settings_showhider'
			),
			array(
					'field_id'			=> 'mailchimp_email_input_field_width',
					'field_title' 	=> __( 'Overall width', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'How wide should the email input field and submit button be in pixels? Default: 300', 'mp_stacks_mailchimp' ) ,
					'field_type' 	=> 'number',
					'field_value' 	=> '300',
					'field_showhider' => 'mailchimp_overall_size_settings_showhider',
			),
			array(
					'field_id'			=> 'mailchimp_overall_corner_radius',
					'field_title' 	=> __( 'Corner Radius', 'mp_stacks_mailchimp'),
					'field_description' 	=> __( 'What should the radius of the corners be? Tip: "0" is flat, sharp 90 degree corners. Default: 0', 'mp_stacks_mailchimp' ) ,
					'field_type' 	=> 'number',
					'field_value' 	=> '0',
					'field_showhider' => 'mailchimp_overall_size_settings_showhider'
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
add_action('mp_brick_metabox', 'mp_stacks_mailchimp_create_meta_box');