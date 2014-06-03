<?php

class TwitteringTest extends PHPUnit_Framework_TestCase{
	protected function setUp(){
	}

	protected function tearDown(){
	}

	/**
	* @expectedException Exception
	*/
	public function testNoParametersException(){
		$twittering = new \Twittering\Twittering();
	}

	/**
	* @expectedException Exception
	*/
	public function testEmptyArrayParameterException(){
		$twittering = new \Twittering\Twittering(array());
	}

	/**
	* @expectedException Exception
	*/
	public function testNoApiKeyException(){
		$twittering = new \Twittering\Twittering(array(
			"api_secret" => "1234"
		));
	}

	/**
	* @expectedException Exception
	*/
	public function testNoApiSecretException(){
		$twittering = new \Twittering\Twittering(array(
			"api_key" => "1234"
		));
	}

	// This shouldn't throw any exceptions
	public function testValidConstructorParameter(){
		$twittering = new \Twittering\Twittering(array(
			"api_key" => "1234",
			"api_secret" => "1234"
		));
	}
}

