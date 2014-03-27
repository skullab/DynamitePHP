<?php
if(!defined('DYNAMITE'))die();
/*
 * START TO CHANGE FROM HERE
 */

define('DYNAMITE_DEBUG',// <- DO NOT TOUCH THIS !
//############ CHANGE THIS ############
true
//#####################################
);

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

define('DYNAMITE_ALLOWED_LIST',serialize(array(// <- DO NOT TOUCH THIS !
//############ CHANGE THIS ############
//	The syntax ?! lib1,lib2..libN means "allow all except" lib1,lib2..libN
//	without ?! the meaning becomes "allow only" lib1,lib2..libN
'DENY'		=> 'www.example.com | www.example2.com ' ,
'ALLOW' 	=> '*' ,
'RESTRICT'	=> '* : ?! jquery-ver1.8 | localhost : .',
//'DENY_ALL'	=> true ,
//'ALLOW_ALL' => true ,
//#####################################
)));
/*
 * STOP ! 
*/
?>