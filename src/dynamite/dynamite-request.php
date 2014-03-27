<?php
$starttime = microtime(true);
require_once 'dynamite-define.php';if(!isset($_REQUEST[DYNAMITE_LIBRARY]))permission_denied();

require_once 'dynamite-config.php';
require_once 'dynamite-utils.php';
require_once DYNAMITE_CORE_PATH . 'dynamite.php' ;
$dynamite = new Dynamite();
$headers = getallheaders();
$dynamite->set_allowed_list(array_change_key_case(unserialize(DYNAMITE_ALLOWED_LIST),CASE_UPPER));
if(	array_key_exists('DENY_ALL', $dynamite->get_allowed_list()) && 
	$dynamite->get_allowed_list()['DENY_ALL'])permission_denied();
if(	array_key_exists('ALLOW_ALL', $dynamite->get_allowed_list()) &&
$dynamite->get_allowed_list()['ALLOW_ALL']){
	echo 'questo posto e libero a tutti !<br>';
}else{
	echo 'non permetto a tutti di venire qui !<br>';
	if(	array_key_exists('DENY', $dynamite->get_allowed_list()) &&
	check_host($dynamite->get_allowed_list()['DENY']))permission_denied();
	
	if(	array_key_exists('RESTRICT', $dynamite->get_allowed_list()) &&
	check_host($dynamite->get_allowed_list()['RESTRICT'])){
		echo 'accesso con restrizioni<br>';
		$validate = false ;
		$previous_pattern = '';
		foreach (check_host($dynamite->get_allowed_list()['RESTRICT']) as $host){
			$libraries = @trim(explode(':',$host)[1]) ;
			if($libraries){
				$search = array(						
							"/\s*,\s*/",
							"/\s+/",
							"/\??\!?\(((\w+)\|?)+/",
							"/\w+/"
				);
				$replace = array(
							"|",
							"(",
							"$0)",
							"$0\b"
				);
				$pattern = '^('.preg_replace($search, $replace, trim($libraries)).')';
				var_dump($pattern);
				if(preg_match('/'.$pattern.'/i',$_REQUEST[DYNAMITE_LIBRARY])){				
					$validate = true ;
					echo 'OK ';
					if(!preg_match('/\?\!/', $pattern))break;
				}else $validate = false ;
			}else permission_denied();
		}
		if(!$validate)permission_denied();
	}else if(	array_key_exists('ALLOW', $dynamite->get_allowed_list()) &&
	check_host($dynamite->get_allowed_list()['ALLOW'])){
		echo 'via libera<br>';
	}else permission_denied();;
}

function check_host($list){
	global $headers ;
	$host_list = explode('|', $list);
	$ret_host = array();
	foreach ($host_list as $host){
		$realhost = trim(explode(':',$host)[0]);
		if(preg_match('/\b'.$headers['Host'].'\b/i', $host) || $realhost == '*'){
			array_push($ret_host, $host);
		}
	}
	if(count($ret_host)>0)return $ret_host ;
	return false ;
}
function get_execute_time(){
	global $starttime ;
	return (microtime(true) - $starttime) ;
}
function permission_denied(){
	die('PERMISSION DENIED');
}
echo 'continue...<br>';
echo 'time : '.get_execute_time();
?>
