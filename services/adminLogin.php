<?php
require_once '../base/include_top.php';

$error = null;

if(isset($_POST['user']) && isset ($_POST['passwd'])) {
	$usr = $_POST['user'];
	$passwd = $_POST['passwd'];
	try {
		$admin = new Admin(array($usr));
		
		if(md5($passwd) == $admin->getPassword()) {
			$_SESSION['admin'] = $admin->getUsername();
			header('Location: ../panel.php');
			exit;
		}
		else{
			$error = "Wrong password";
		}
	}
	catch(Exception $e) {
		$error = "Wrong username";
	}
}
else {
	$error = "Username/password has not been specified.";
}

if(isset($_POST['user']))
header ("Location: ../index.php?error=".urlencode($error)."&user=".urlencode($_POST['user']));
else
header ("Location: ../index.php?error=".urlencode($error));

?>