# Twittering [![Build Status](https://travis-ci.org/traviswimer/Twittering.png?branch=master)](https://travis-ci.org/traviswimer/Twittering)

> PHP class for simple Twitter oAuth token requests, authentication, and API v1.1 requests. (Built on the [TwitterOAuth package](https://github.com/abraham/twitteroauth))

## Getting Started

Install with [Composer](https://getcomposer.org/) by adding this to your `composer.json` file:

```json
"require": {
	"traviswimer/twittering": "dev-master"
}
```
Then run `compsoser install` or `php composer.phar install`, depending on your setup.

## Example usage

```php
// Include Composer autoloader
require_once __DIR__.'/vendor/autoload.php';

// First create initialize a Twittering object with you API key/secret
$twittering = new \Twittering\Twittering(array(
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
$timeline = $apiConnection->get( 'statuses/home_timeline.json', array('count' => '10') );
```

## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality.
