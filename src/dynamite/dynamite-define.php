<?php
$slash = '/' ;
define('DYNAMITE','dynamite');
define('DYNAMITE_VERSION','0.0.1');
define('DYNAMITE_DB_VERSION','0.0.1');
define('DYNAMITE_LIBRARY','library');
define('DYNAMITE_PATH',dirname(__FILE__).$slash);
define('DYNAMITE_CORE_PATH',DYNAMITE_PATH.'core'.$slash);
define('DYNAMITE_SQLITE_PATH',DYNAMITE_CORE_PATH.'sqlite'.$slash);
define('DYNAMITE_ERRORS_PATH',DYNAMITE_PATH.'errors'.$slash);
define('DYNAMITE_FRONTEND_PATH',DYNAMITE_PATH.'frontend'.$slash);

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