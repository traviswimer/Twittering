<?php
namespace Twittering;
require_once('Util.php');

class Access{
	private $auth_info;
	public $tokens;

	function __construct( \TwitterOAuth $connection, array $auth_info, $url, callable $util, $requestAccess=false ){

		if( !$requestAccess ){
			// If initial request, redirect user to twitter auth page
			//$connection = new \TwitterOAuth( $auth_info['api_key'], $auth_info['api_secret'] );

			//$current_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$temporary_credentials = $connection->getRequestToken($url);
			$redirect_url = $connection->getAuthorizeURL($temporary_credentials, false);
			
			call_user_func( $util, $redirect_url );

		}else{
			// if recieved oauth tokens, request long-term tokens
			/*$connection = new \TwitterOAuth(
				$auth_info['api_key'],
				$auth_info['api_secret'],
				$_GET['oauth_token'],
				$_GET['oauth_verifier']
			);*/

			$token_credentials = $connection->getAccessToken( $requestAccess );

			$this->tokens = $token_credentials;
		}

	}


}
