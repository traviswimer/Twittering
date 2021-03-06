<?php
////////////////////////////////////////////////////////////
// The sole purpose of this file is to wrap Core.php in a //
// class that does nothing and therefore requires no unit //
// testing.                                               //
////////////////////////////////////////////////////////////

namespace Twittering;

class Twittering{
	private $coreObject;

	function __construct( array $app_auth_info ){
		$this->coreObject = new Core( $app_auth_info, new Util(), new TwitterOAuthWrapper() );
	}

	public function requestTokens( $url=NULL, $redirect=true ){
		return $this->coreObject->requestTokens( $url, $redirect );
	}

	public function authenticate( $tokens ){
		return $this->coreObject->authenticate( $tokens );
	}

}
