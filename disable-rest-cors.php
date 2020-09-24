<?php
/*
Plugin Name: Disable REST CORS
Plugin URI: https://github.com/Zorrodelaarena/wp-disable-rest-cors/
Description: A WordPress plugin that blocks cross-origin requests made to the REST API
Version: 0.0.1
Author: Ryan Cramer
Author URI: https://secularcoding.com/
License: GPLv2 or later
*/

class DisableRestCors {
	// method from https://linguinecode.com/post/enable-wordpress-rest-api-cors
	public static function DisableCors( $value ) {
		header( 'Access-Control-Allow-Origin: ' . get_site_url());
		header( 'Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, PATCH, DELETE' );
		header( 'Access-Control-Allow-Credentials: true' );
		return $value;
	}

	public static function Init() {
		add_action( 'rest_api_init', function() {
			remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
			add_filter( 'rest_pre_serve_request', __CLASS__ . '::DisableCors');
		}, 15 );
	}
}
DisableRestCors::Init();