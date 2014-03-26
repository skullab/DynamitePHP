<?php
if(!defined('DYNAMITE')){
	if(!isset($_REQUEST[DYNAMITE_LIBRARY])){
		die('<b>Access denied !</b>');
	}else die();
}
/*
 * START TO CHANGE FROM HERE
 */
define('DYNAMITE_USER',// <- DO NOT TOUCH THIS !
//############ CHANGE THIS ############
'REPLACE WITH YOUR DYNAMITE USER'
//#####################################		
);
define('DYNAMITE_DOMAIN',// <- DO NOT TOUCH THIS !
//############ CHANGE THIS ############
//	example : http://www.mysite.com
//	If you are trying Dynamite in a local machine change it with 'LOCALHOST'
'LOCALHOST' 
//#####################################
);
require_once DYNAMITE_CORE_PATH . 'dynamite.php' ;
$dynamite = new Dynamite();
/*
 * STOP ! 
*/
?>