<?php
require_once '../dynamite-define.php';
require_once '../dynamite-utils.php';
session_start();
if(!isset($_POST['nonce']) || !verify_nonce('dynamite_install_nonce', $_POST['nonce']))die(DYNAMITE_PERMISSION_DENIED);

$_POST['user'] = trim(preg_replace('/\t+/', '', $_POST['user']));
if($_POST['user'] == ''){
	header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_error').'&error=user');
	die();
}
if($_POST['pwd'] != $_POST['pwd2']){
	header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_error').'&error=pwd');
	die();
}
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
	header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_error').'&error=email');
	die();
}

try {
	$sqlite = new SQLite3(DYNAMITE_SQLITE_PATH.'dynamite.db', SQLITE3_OPEN_READONLY);
	$sqlite->close();
} catch (Exception $e) {
	$sqlite = new SQLite3(DYNAMITE_SQLITE_PATH.'dynamite.db');
	$query = file_get_contents(DYNAMITE_SQLITE_PATH.'db-install.txt');
	$response = $sqlite->exec($query);
	
	if(!$response){
		$sqlite->close();
		header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_error').'&error=db');
		die();
	}
	
	$sqlite->close();
}

header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_done'));
die();
?>