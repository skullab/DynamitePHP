<?php
require_once 'dynamite-define.php';if(!isset($_REQUEST[DYNAMITE_LIBRARY]))die();

require_once 'dynamite-config.php';
require_once DYNAMITE_CORE_PATH . 'dynamite.php' ;
$dynamite = new Dynamite();

$dynamite->set_allowed_list(unserialize(DYNAMITE_ALLOWED_LIST));

?>
