<?php

class AccessTest extends PHPUnit_Framework_TestCase{
	protected function setUp(){

		/*$this->connectionStub = $this->getMock(
			'TwitterOAuth',
			array(
				'getRequestToken',
				'getAuthorizeURL',
				'getAccessToken'
			)
		);*/

		$this->connectionStub = $this->getMockBuilder('TwitterOAuth')
		->disableOriginalConstructor()
		->getMock();
	}

	protected function tearDown(){
	}


	public function testInitialRequest(){

		function fakeFunction(){}

		$access = new \Twittering\Access(
			$this->connectionStub,
			array(
				"api_key" => '1234',
				"api_secret" => '1234'
			),
			'fakeURL',
			'fakeFunction',
			false
		);
	}

	public function testAuthTokens(){

		$fakeTokens = array(
			"key" => "value"
		);
		
		$this->connectionStub->expects( $this->any() )
		->method( 'getAccessToken' )
		->will( $this->returnValue( $fakeTokens ) );

		$access = new \Twittering\Access(
			$this->connectionStub,
			array(
				"api_key" => '1234',
				"api_secret" => '1234'
			),
			'fakeURL',
			'fakeFunction',
			'1234'
		);

		$this->assertEquals( $access->tokens, $fakeTokens );

	}

}

