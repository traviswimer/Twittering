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
		$this->coreObject = new Core( $app_auth_info );
	}

	public function requestAccess(){
		$coreObject->requestAccess();
	}

	public function authenticate(){
		$coreObject->authenticate();
	}

}
