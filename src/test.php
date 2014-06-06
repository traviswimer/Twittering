<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__.'/../vendor/autoload.php';

include('Twittering/Access.php');

function redirectToAuth( $url ){
	header("Location: ".$url);
	die();
}

function complete( $tokens ){
	header("Location: ".$url);
	die();
}


if( empty($_GET['oauth_token']) || empty($_GET['oauth_verifier']) ){
	$connection = new \TwitterOAuth(
		'kuBzGWwKHZ8RDoqgbHC5uA',
		'gGT4grux87MOEi549imz1UKwjAsq6CTmK9gJLdyVWkg'
	);
	$requestAccess = false;

}else{
	$connection = new \TwitterOAuth(
		'kuBzGWwKHZ8RDoqgbHC5uA',
		'gGT4grux87MOEi549imz1UKwjAsq6CTmK9gJLdyVWkg',
		$_GET['oauth_token'],
		$_GET['oauth_verifier']
	);
	$requestAccess = true;
}

$access = new \Twittering\Access(
	$connection,
	array(
		"api_key" => 'kuBzGWwKHZ8RDoqgbHC5uA',
		"api_secret" => 'gGT4grux87MOEi549imz1UKwjAsq6CTmK9gJLdyVWkg'
	),
	$requestAccess
);


print_r($access->tokens);


?>