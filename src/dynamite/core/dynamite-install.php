<?php
require_once '../dynamite-define.php';
require_once '../dynamite-utils.php';
session_start();
if(!isset($_POST['nonce']) || !verify_nonce('dynamite_install_nonce', $_POST['nonce']))die(DYNAMITE_PERMISSION_DENIED);

function db_error(){
	global $sqlite ;
	$sqlite->close();
	header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_error').'&error=db');
	die();
}

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
	if(!$response)db_error();
	$response = $sqlite->exec("INSERT INTO users_auth VALUES (0,'admin')");
	if(!$response)db_error();
	$response = $sqlite->exec("INSERT INTO users_auth VALUES (1,'developer')");
	if(!$response)db_error();
	$response = $sqlite->exec("INSERT INTO users_auth VALUES (2,'contributor')");
	if(!$response)db_error();
	$response = $sqlite->exec("INSERT INTO users_auth VALUES (3,'customer')");
	if(!$response)db_error();
	$response = $sqlite->exec("CREATE TRIGGER delete_libraries AFTER DELETE ON libraries
	BEGIN
	DELETE FROM dependencies WHERE dependencies.id_libraries = OLD.id ;
	DELETE FROM rules WHERE rules.id_libraries = OLD.id ;
	DELETE FROM codes WHERE codes.id_libraries = OLD.id ;
	END");
	if(!$response)db_error();
	$response = $sqlite->exec("INSERT INTO users (name,pwd,email,auth) VALUES ('".strtolower($_POST['user'])."','".crypt_password($_POST['pwd'])."','".$_POST['email']."',0)");
	if(!$response)db_error();
	
	$sqlite->close();
}

header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_done'));
die();
?>