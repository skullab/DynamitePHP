<?php
require_once 'dynamite-define.php'; 
require_once 'dynamite-utils.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Dynamite</title>
<link href="frontend\css\dynamite-style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
<a href="">Dynamite</a>
</header>

<?php
	if(isset($_GET['nonce'])){
		if(isset($_SESSION['dynamite_install_error'])){
			if(verify_nonce('dynamite_install_error', $_GET['nonce'])){
				switch ($_GET['error']){
					case 'user':
						echo '<div>WRONG USER NAME</div>';
						break;
					case 'pwd':
						echo '<div>INCORRECT PASSWORD</div>';
						break;
					case 'email':
						echo '<div>NOT VALID EMAIL ADDRESS</div>';
						break;
					case 'db':
						echo '<div>ERROR DURING CREATE DB</div>';
						break;
				}
			}
		}
		if(isset($_SESSION['dynamite_install_done'])){
			if(verify_nonce('dynamite_install_done', $_GET['nonce'])){
				echo '<script>alert("Installation complete!");</script>';
			}else{
				echo '<b>An error occurred...please refresh the page</b>';
				die();
			}
		}
	}
	try {
		$sqlite = new SQLite3(DYNAMITE_SQLITE_PATH.'dynamite.db', SQLITE3_OPEN_READONLY);
		$sqlite->close();
		?>
		<div>
		<table class="border-blue border-radius login-box">
		<tr><th>User</th>
		<td><input class="border-blue border-radius" type="text" name="user"></td>
		</tr>
		<tr><th>Password</th>
		<td><input class="border-blue border-radius" type="password" name="pwd"></td>
		</tr>
		<tr>
		<td colspan="2" align="center"><input class="button-primary" style="margin-top:20px;" type="button" value="LOGIN"></td>
		</tr>
		</table>
		</div>
		<?php
	} catch (Exception $e) {
		?>
		<div class="border-radius welcome-box">
		Welcome to Dynamite !<br>
		This is your first install, follow the instructions below to install Dynamite to your website.<br><br>
		<form action="core/dynamite-install.php" method="post" autocomplete="on">
		<input type="hidden" name="nonce" value="<?php echo create_nonce('dynamite_install_nonce');?>">
		
		<table class="install-box">
		<tr><th>1</th>
		<td>
			INSERT A USER NAME<br>
			<span>This is your admin user name for this repo.</span>
		</td>
		<td>
			<input class="border-blue border-radius input-box" type="text" name="user" required>
		</td>
		</tr>
		<tr><th>2</th>
		<td>
			INSERT A PASSWORD<br>
			<span>Choose your password.</span>
		</td>
		<td>
			<input class="border-blue border-radius input-box" type="password" name="pwd" required>
		</td>
		</tr>
		<tr><th>3</th>
		<td>
			REPEAT A PASSWORD<br>
			<span>Rewrite your choosed password.</span>
		</td>
		<td>
			<input class="border-blue border-radius input-box" type="password" name="pwd2" required>
		</td>
		</tr>
		<tr><th>4</th>
		<td>
			INSERT AN E-MAIL<br>
			<span>Your e-mail is used to restore your credentials.</span>
		</td>
		<td>
			<input class="border-blue border-radius input-box" type="email" name="email" required>
		</td>
		</tr>
		<tr>
		<td colspan="3" align="center"><input class="button-primary" style="margin-top:20px;" type="submit" value="INSTALL"></td>
		</tr>
		</table>
		</form>
		</div>
		<?php 
	} 
?>

<footer>Dynamite (c) 2014</footer>

</body></html>
