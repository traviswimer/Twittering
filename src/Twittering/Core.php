<?php
namespace Twittering;

class Core{
	private $api_key;
	private $api_secret;
	private $util;
	private $connector;

	function __construct( array $app_auth_info, Util $util, TwitterOAuthWrapper $connector ){

		// Make sure app's authentication parameters were included
		if( empty($app_auth_info['api_key']) || empty($app_auth_info['api_secret']) ){
			throw new \Exception("No app api_key or api_secret specified.");
		}

		// App API info
		$this->api_key = $app_auth_info['api_key'];
		$this->api_secret = $app_auth_info['api_secret'];

		// utility object
		$this->util = $util;

		// TwitterOAuth connector wrapper
		$this->connector = $connector;

	}

	// Redirects user to Twitter auth page with the current URL as the callback.
	// When tokens are sent with the callback, it will return the tokens/user info
	public function requestTokens( $url=NULL, $redirect=true ){

		if( !isset($_GET['oauth_token']) || !isset($_GET['oauth_verifier']) ){
			// this is the initial request, so the user needs redirected to twitter

			$connection = $this->connector->connect(
				$this->api_key,
				$this->api_secret
			);

			// If a callback URL is not specified, use current URL
			if( empty( $url ) ){
				$url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			}

			// Create temporary tokens
			$temporary_credentials = $connection->getRequestToken($url);

			// Generate Twitter authorization URL
			$redirect_url = $connection->getAuthorizeURL($temporary_credentials, false);

			// Check if user wants immediate redirect or URL returned as string
			if( $redirect===true ){
				$this->util->redirect( $redirect_url );
			}else{
				return $redirect_url;
			}

		}else{
			// This is the callback request, so the tokens/user account info should be returned

			$connection = $this->connector->connect(
				$this->api_key,
				$this->api_secret,
				$_GET['oauth_token'],
				$_GET['oauth_verifier']
			);

			// Generate long term tokens
			$token_credentials = $connection->getAccessToken( $_GET['oauth_verifier'] );
			return $token_credentials;
		}

	}

	// Uses user tokens to authenticate account for API requests
	public function authenticate( $tokens ){
		$connection = $this->connector->connect(
				$this->api_key,
				$this->api_secret,
				$tokens['oauth_token'],
				$tokens['oauth_token_secret']
		);

		return $connection;
	}

}
