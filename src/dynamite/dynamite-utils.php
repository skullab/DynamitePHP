<?php
if (! function_exists ( 'getallheaders' )) {
	function getallheaders() {
		$headers = '';
		foreach ( $_SERVER as $name => $value ) {
			if (substr ( $name, 0, 5 ) == 'HTTP_') {
				$headers [str_replace ( ' ', '-', ucwords ( strtolower ( str_replace ( '_', ' ', substr ( $name, 5 ) ) ) ) )] = $value;
			}
		}
		return $headers;
	}
}

function create_nonce($reference){
	$nonce = substr(md5(rand(0, 1000000)), 0, 10);
	if(isset($_SESSION))$_SESSION[$reference] = $nonce ;
	return $nonce ;
}

function verify_nonce($reference,$nonce){
	if(!isset($_SESSION[$reference]))return false ;
	$check = $_SESSION[$reference] == $nonce ;
	unset($_SESSION[$reference]);
	return $check ;
}

function crypt_password($password){
	return crypt($password);
}

function check_password($password,$hash){
	return (crypt($password, $hash) == $hash) ;
}
?>