<?php

namespace Twittering;

class TwitterOAuthWrapper{
	public $connection;

	public function connect( $consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL ){
		$this->connection = new \TwitterOAuth\Api(
			$consumer_key,
			$consumer_secret,
			$oauth_token,
			$oauth_token_secret
		);
		$this->connection->host = "https://api.twitter.com/1.1/";

		return $this->connection;
	}

}
