# Twittering [![Build Status](https://travis-ci.org/traviswimer/twittering.png?branch=master)](https://travis-ci.org/traviswimer/twittering)

> PHP class that makes Twitter oAuth token requests and authentication as simple as possible. (Built on the [TwitterOAuth package](https://github.com/abraham/twitteroauth))

## Getting Started

Install with [Composer](https://getcomposer.org/) by adding this to your `composer.json` file:

```json
"require": {
	"traviswimer/twittering": "dev-master"
}
```
Then run `php composer.phar install`

## Example usage

```php
// First create initialize a Twittering object with you API key/secret
$twittering = new Twittering(array(
	"api_key" => "YOUR_CONSUMER_KEY",
	"api_secret" => "YOUR_CONSUMER_SECRET",
));

// Then the requestTokens() method can be used to redirect the user to Twitter
// for authentication. The user will then be sent back to the URL of your script.
// This time, when requestTokens() is called, it will detect the $_GET parameters
// sent from Twitter and continue with the authorization process.
$tokens = $twittering->requestTokens();

// Now that you have the tokens, you can save them to a database for future use.

// To make API requests, call the authenticate() method.
$apiConnection = $twittering->authenticate( $tokens );

// You are now ready to make API requests
$status = $apiConnection->post('statuses/update', array('status' => 'Text of status here', 'in_reply_to_status_id' => 123456));
```

## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality.
