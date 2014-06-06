<?php

class CoreConstructorTest extends PHPUnit_Framework_TestCase{
	protected function setUp(){
		$this->utilStub = $this->getMockBuilder('Twittering\Util')
		->disableOriginalConstructor()
		->getMock();

		$this->twitterOAuthWrapperStub = $this->getMockBuilder('Twittering\TwitterOAuthWrapper')
			->disableOriginalConstructor()
			->getMock();
		$this->twitterOAuthStub = $this->getMockBuilder('\TwitterOAuth')
			->disableOriginalConstructor()
			->getMock();

		$this->twitterOAuthWrapperStub->expects($this->any())
			->method('connect')
			->will($this->returnValue($this->twitterOAuthStub));
	}

	protected function tearDown(){
	}

	/**
	* @expectedException Exception
	*/
	public function testNoParametersException(){
		$twittering = new \Twittering\Core();
	}

	/**
	* @expectedException Exception
	*/
	public function testEmptyArrayParameterException(){
		$twittering = new \Twittering\Core(array(), $this->utilStub, $this->twitterOAuthWrapperStub);
	}

	/**
	* @expectedException Exception
	*/
	public function testNoApiKeyException(){
		$twittering = new \Twittering\Core(array(
			"api_secret" => "1234"
		), $this->utilStub, $this->twitterOAuthWrapperStub);
	}

	/**
	* @expectedException Exception
	*/
	public function testNoApiSecretException(){
		$twittering = new \Twittering\Core(array(
			"api_key" => "1234"
		), $this->utilStub, $this->twitterOAuthWrapperStub);
	}

	// This shouldn't throw any exceptions
	public function testValidConstructorParameter(){
		$twittering = new \Twittering\Core(array(
			"api_key" => "1234",
			"api_secret" => "1234"
		), $this->utilStub, $this->twitterOAuthWrapperStub);
	}
}

