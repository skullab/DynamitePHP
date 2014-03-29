<?php
$backslash = '\\' ;
define('DYNAMITE','dynamite');
define('DYNAMITE_VERSION','0.0.1');
define('DYNAMITE_LIBRARY','library');
define('DYNAMITE_PATH',dirname(__FILE__).$backslash);
define('DYNAMITE_CORE_PATH',DYNAMITE_PATH.'core'.$backslash);
define('DYNAMITE_SQLITE_PATH',DYNAMITE_CORE_PATH.'sqlite'.$backslash);
define('DYNAMITE_ERRORS_PATH',DYNAMITE_PATH.'errors'.$backslash);
define('DYNAMITE_FRONTEND_PATH',DYNAMITE_PATH.'frontend'.$backslash);

define('DYNAMITE_PERMISSION_DENIED','PERMISSION DENIED');
define('DYNAMITE_NOT_READY','NOT READY');

define('DYNAMITE_KEYWORDS',serialize(array(
	'ALLOW_ALL',
	'DENY_ALL' ,
	'ALLOW' ,
	'RESTRICT' ,
	'DENY'
)));
?>