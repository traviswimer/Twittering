<?php
namespace Twittering;

class Util{
	public function redirect( $url ){
		header( "Location: ".$url );
		die();
	}
}