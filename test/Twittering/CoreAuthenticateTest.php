<?php

class CoreAuthenticateTest extends PHPUnit_Framework_TestCase{
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

		$this->fakeApiInfo = array(
			"api_key" => "1234",
			"api_secret" => "5678"
		);

		$this->core = new \Twittering\Core( $this->fakeApiInfo, $this->utilStub, $this->twitterOAuthWrapperStub );
	}

	protected function tearDown(){
	}

	public function testAuthenticate(){
		$fakeTokenArray = array(
			"oauth_token" => "the-access-token",
			"oauth_token_secret" => "the-access-secret",
			"user_id" => "9436992",
			"screen_name" => "abraham"
		);

		$this->twitterOAuthStub->expects($this->any())
			->method('authenticate')
			->with(array(
				$this->fakeApiInfo['api_key'],
				$this->fakeApiInfo['api_secret'],
				$fakeTokenArray['oauth_token'],
				$fakeTokenArray['oauth_token_secret'],
			));

		$this->core->authenticate( $fakeTokenArray );
	}

}

