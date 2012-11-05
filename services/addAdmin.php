<?php
require_once '../base/include_top.php';
if(!isset($_SESSION['admin'])) {
	header("Location: ../index.php?error=".urlencode("Admin permission required"));
	exit;
}	

/* The AJAX Part commented out
$output = new SimpleXMLElement('<Result></Result>');
$msg = $output->addChild("message");
$msg->addAttribute('type','');

if(isset($_GET['user']) && isset ($_GET['passwd'])) {
	$usr = $_GET['user'];
	$passwd = $_GET['passwd'];
	try {
		$admin = new Admin();
		$admin->setUsername($usr);
		$admin->setPassword($passwd);
		$admin->insert();

		$msg->attributes()->type = 'success';
		$output->msg = "Sucessfully added ".$admin->getUsername()." user.";
	}
	catch(Exception $e) {
		$msg->attributes()->type = 'error';
		$output->msg = $e->getMessage();
	}
}
else {
	$msg->attributes()->type = 'error';
	$output->msg = "Username/password has not reached us.";
}

header ("content-type: text/xml");
echo $output->asXML();
*/



$error = null;

if(isset($_POST['user']) && isset ($_POST['passwd'])) {
	$usr = $_POST['user'];
	$passwd = $_POST['passwd'];
	try {
		$admin = new Admin();
		$admin->setUsername($usr);
		$admin->setPassword($passwd);
		$admin->insert();

		header('Location: ../admin.php');
		exit;
	}
	catch(Exception $e) {
		$error = "Username already exist";
	}
}
else {
	$error = "Username/password has not reached us.";
}
header ("Location: ../admin.php?error=".urlencode($error));
?>