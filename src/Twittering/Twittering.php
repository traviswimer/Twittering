<?php
namespace Twittering;

class Twittering{
	private $api_key;
	private $api_secret;

	function __construct( array $app_auth_info ){

		// Make sure app's authentication parameters were included
		if( empty($app_auth_info['api_key']) || empty($app_auth_info['api_secret']) ){
			throw new \Exception("No app api_key or api_secret specified.");
		}

		$this->api_key = $app_auth_info['api_key'];
		$this->api_secret = $app_auth_info['api_secret'];
	}

}
