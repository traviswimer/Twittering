<?php

class CoreRequestTokensTest extends PHPUnit_Framework_TestCase{
	protected function setUp(){
		$_SERVER['HTTPS'] = false;
		$_SERVER['HTTP_HOST'] = "host.com";
		$_SERVER['REQUEST_URI'] = "/uri";

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

		$fakeApiInfo = array(
			"api_key" => "1234",
			"api_secret" => "5678"
		);

		$this->core = new \Twittering\Core( $fakeApiInfo, $this->utilStub, $this->twitterOAuthWrapperStub );
	}

	protected function tearDown(){
	}

	public function testNoParameters(){
		$this->twitterOAuthStub->expects($this->any())
			->method('getAuthorizeURL')
			->will($this->returnValue("http://fake.url"));

		$this->core->requestTokens();
	}

	public function testURLParameter(){
		$fakeURL = "http://fake.url";
		$fakeTwitterURL = "http://twitter.com/api?u=".$fakeURL;
		$this->twitterOAuthStub->expects($this->any())
			->method('getAuthorizeURL')
			->will($this->returnValue($fakeTwitterURL));

		// Redirect should be called with correct URL
		$this->utilStub->expects($this->once())
			->method('redirect')
			->with( $fakeTwitterURL );

		$redirectURL = $this->core->requestTokens( $fakeURL );

	}

	public function testNoRedirectParameter(){
		$fakeURL = "http://fake.url";
		$fakeTwitterURL = "http://twitter.com/api?u=".$fakeURL;
		$this->twitterOAuthStub->expects($this->any())
			->method('getAuthorizeURL')
			->will($this->returnValue($fakeTwitterURL));

		$redirectURL = $this->core->requestTokens( $fakeURL, false );

		$this->assertEquals( $redirectURL, $fakeTwitterURL );
	}

	public function testCallbackRequest(){

		$fakeTokenArray = array(
			"oauth_token" => "the-access-token",
			"oauth_token_secret" => "the-access-secret",
			"user_id" => "9436992",
			"screen_name" => "abraham"
		);

		$_GET['oauth_token'] = "1234";
		$_GET['oauth_verifier'] = "5678";
		$this->twitterOAuthStub->expects($this->any())
			->method('getAccessToken')
			->with( $_GET['oauth_verifier'] )
			->will($this->returnValue($fakeTokenArray));

		$tokens = $this->core->requestTokens();

		$this->assertEquals( $tokens, $fakeTokenArray );
	}

}

