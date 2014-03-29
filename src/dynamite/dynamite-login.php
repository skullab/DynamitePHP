<?php
require_once 'dynamite-define.php'; 
require_once 'dynamite-utils.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Dynamite</title>
<link href="frontend/css/dynamite-style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="headerbar">
Dynamite
</div>

<div class="wrap">
<?php
	if(isset($_GET['nonce'])){
		if(isset($_SESSION['dynamite_install_error'])){
			if(verify_nonce('dynamite_install_error', $_GET['nonce'])){
				switch ($_GET['error']){
					case 'user':
						echo '<div class="advice"><img src="frontend/img/warning_small.png" />&nbsp;WRONG USER NAME</div>';
						break;
					case 'pwd':
						echo '<div class="advice"><img src="frontend/img/warning_small.png" />&nbsp;INCORRECT PASSWORD</div>';
						break;
					case 'email':
						echo '<div class="advice"><img src="frontend/img/warning_small.png" />&nbsp;INVALID EMAIL ADDRESS</div>';
						break;
					case 'db':
						echo '<div class="advice"><img src="frontend/img/warning_small.png" />&nbsp;ERROR DURING CREATING DATABASE</div>';
						break;
					case 'invalid_session':
						echo '<div class="advice"><img src="frontend/img/warning_small.png" />&nbsp;INVALID SESSION, PLEASE LOGIN AGAIN</div>';
						break;
					case 'auth':
						echo '<div class="advice"><img src="frontend/img/warning_small.png" />&nbsp;INVALID USER NAME OR PASSWORD</div>';
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
		<form action="frontend/dynamite-dashboard.php" method="post">
		<input type="hidden" name="nonce" value="<?php echo create_nonce('dynamite_login');?>">
		<table class="border-blue border-radius login-box">
		<tr><th>User</th>
		<td>&nbsp;&nbsp;&nbsp;<input class="border-blue border-radius input-box" type="text" name="user" required></td>
		</tr>
		<tr><th>Password</th>
		<td>&nbsp;&nbsp;&nbsp;<input class="border-blue border-radius input-box" type="password" name="pwd" required></td>
		</tr>
		<tr><th></th>
		<td>&nbsp;&nbsp;&nbsp;<span><a href="">I forgot my password</a></span></td>
		</tr>
		<tr>
		<td colspan="2" align="center"><input class="button-primary" style="margin-top:20px;" type="submit" value="LOGIN"></td>
		</tr>
		</table>
		</form>
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
</div>

<div id="footer">
<div>Dynamite (c) 2014 ver. <?php echo DYNAMITE_VERSION ;?></div>
</div>

</body></html>
