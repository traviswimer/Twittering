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
$timeline = $apiConnection->get( 'statuses/home_timeline', array('count' => '10') );
```

## Documentation

### `new \Twittering\Twittering( $api_auth_info, );`

*	**$api_auth_info** - Array containing oAuth information.
	*	"api_key" - Your app's consumer key
	*	"api_secret" - Your app's consumer secret

### requestTokens( $callback_url, $redirect );

*This method behaves differently if the $_GET variables `oauth_token` and `oauth_verifier` are set*

#### Without $_GET variables (Initial request)

>	This will send the user to Twitter to authorize your app.

*	**$callback_url** (Default: Current URL) - *String*. The URL Twitter should redirect the user back to once they have authorized your app.
*	**$redirect** (Default: true) - *Boolean*. Determines if the user should automatically be redirected to Twitter to authorize your app. If set to false, `requestTokens()` will instead return the URL where you should send the user.

#### With $_GET variables (Twitter callback request)

>	This generate the user's long-term tokens.

No parameters are needed during this second pass. This will return an array containing the user's long-term tokens that can be stored in your database. You can also pass this array directly to the `authenticate()` method.

### authenticate( $tokens );

>	This method creates an object can interact with the Twitter API on the authenticated user's behalf.

*	**$tokens** - *array*. An associative array of the user's tokens. Should contain the following keys, as obtained from the `requestTokens()` method:
	*	oauth_token
	*	oauth_token_secret

## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality.
