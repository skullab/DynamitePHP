<?php
require_once '../dynamite-define.php' ;
require_once DYNAMITE_PATH.'dynamite-utils.php' ;
require_once DYNAMITE_CORE_PATH.'dynamite.php';
session_start();
/*if(!isset($_POST['nonce']) || !verify_nonce('dynamite_login', $_POST['nonce'])){
	header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_error').'&error=invalid_session');
	die();
}*/
$dynamite = new Dynamite();
if(!$dynamite->check_user($_POST['user'],$_POST['pwd'])){
	header('Location: ../dynamite-login.php?nonce='.create_nonce('dynamite_install_error').'&error=auth');
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dynamite</title>
<link href="css/dynamite-board.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery-menu.js"></script>
</head>
<body>
<div class="headerbar">
&nbsp;<img src="img/user_small.png" width="25px" height="25px"/>&nbsp;<div><?php echo strtoupper($dynamite->get_user_info('name'));?></div>
</div>

<div class="layout">
	<div class="sidebar">
	<div id='cssmenu'>
	<ul>
	   <li class='active'><a href='#'><span>Dashboard</span></a></li>
	   <li><a href='#'><span>Users</span></a></li>
	   <li class='has-sub'><a href='#'><span>Repository</span></a>
	      <ul>
	         <li><a href='#'><span>Manage js code</span></a></li>
	         <li class='last'><a href='#'><span>Database</span></a></li>
	      </ul>
	   </li>
	   <li class='has-sub last'><a href='#'><span>Plugins</span></a>
	      <ul>
	         <li><a href='#'><span>Installed</span></a></li>
	         <li class='last'><a href='#'><span>Search new</span></a></li>
	      </ul>
	   </li>
	</ul>
	</div>
	</div>

	<div class="page">
		<div id="position">
			<div>Dynamite</div>
			<div id="arrow-right" style="float:left;"></div>
			<div style="float:left;margin-left:10px;margin-top:5px;"><a href="#">Dashboard</a>&#9658;</div>
		</div>
		<div id="content" style="clear:left;">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris imperdiet eleifend lacus aliquet ullamcorper. 
		Pellentesque sit amet nisl laoreet, fermentum est in, aliquet justo. Vivamus at nisl varius, ullamcorper felis quis, 
		ultricies lacus. Nam gravida metus at lacus tempus laoreet. Etiam congue pulvinar massa, dapibus luctus dolor pharetra 
		vel. Nam tempus porttitor nisi malesuada dictum. In faucibus quis eros aliquam ullamcorper. Nullam volutpat nisl 
		consectetur, sollicitudin justo et, porttitor dui. Vivamus dictum blandit neque, eu molestie sem sagittis a. 
		</div>
	</div>
</div>

</body>
</html>