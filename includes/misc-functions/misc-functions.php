<?php
/**
 * This file contains the enqueue scripts function for the mailchimp plugin
 *
 * @since 1.0.0
 *
 * @package    MP Stacks Features
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */

 function mp_stacks_mailchimp_maybe_add_member( $data, $api_key, $list_id ) {

	$member_id = md5( strtolower( $data['email'] ) );

	//Mail chimp
 	$mailchimp_sever_number = explode( '-', $api_key );
 	$mailchimp_sever_number = $mailchimp_sever_number[1];

	//Check if the user is already on the list
	$url = 'https://' . $mailchimp_sever_number . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . $member_id;

	$get_request_args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'username:' . $api_key )
		),
		'sslverify'   => true,
	);

	$response_1 = wp_remote_get( $url, $get_request_args );

	if ( is_wp_error( $response_1 ) ){
		return __( 'There was a problem with the request. Please try again.', 'mp_stacks_mailchimp' );
	}

	$response_1 = json_decode( wp_remote_retrieve_body( $response_1 ), true );

	if ( !isset( $response_1['status'] ) ){
		return array(
			'error' => __( 'No status found. Please try again.', 'mp_stacks_mailchimp' )
		);
	}

	if ( $response_1['status'] == 'subscribed' ){
		return array(
			'error' => __( 'You are already subscribed to this list', 'mp_stacks_mailchimp' )
		);
	}

	if ( $response_1['status'] == 'unsubscribed' ){
		return array(
			'error' => __( 'You unsubscribed from this list. Unfortunately, you can not re-join it.', 'mp_stacks_mailchimp' )
		);
	}

	if ( $response_1['status'] == 'pending' ){
		return __( 'Check your email to confirm!', 'mp_stacks_mailchimp' );
	}

	// If the user's status is something other than 404 at this time
	if ( $response_1['status'] != '404' ){
		return __( 'Something went wrong with the request. Please try again. User status: ', 'mp_stacks_mailchimp' ) . $response_1['status'];
	}

	// The user's status is 404 so we know they are not on this list
	$json = json_encode( array(
		'email_address' => $data['email'],
		'status'        => 'pending', // "subscribed","unsubscribed","cleaned","pending"
	) );

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
	curl_setopt($ch, CURLOPT_HTTPHEADER, 'content-type: application/json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

	$result = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	$result = json_decode( $result, true );

	if ( $result['status'] == 'pending' ){
		return __( 'Check your email to confirm!', 'mp_stacks_mailchimp' );
	}

	if ( $response_1['status'] == 'subscribed' ){
		return array(
			'error' => __( 'You are already subscribed to this list', 'mp_stacks_mailchimp' )
		);
	}

	if ( $response_1['status'] == 'unsubscribed' ){
		return array(
			'error' => __( 'You unsubscribed from this list. Unfortunately, you can not re-join it.', 'mp_stacks_mailchimp' )
		);
	}

	return __( 'Something went wrong. Please try again.', 'mp_stacks_mailchimp' );

 }
