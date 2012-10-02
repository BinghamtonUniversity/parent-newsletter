<?php
require_once '../base/include_top.php';

if(!isset($_SESSION['admin'])) {
	header("Location: ../index.php?error=".urlencode("Admin permission required"));
	exit;
}	
$error = null;

if(isset($_GET['user'])) { 
	$usr = $_GET['user'];
	try {
		$admin = new Admin(array($usr));
		$admin->markForDeletion();
		$admin = null; //destroy object
		header("Location: ../admin.php");;
		exit;
	}
	catch(Exception $e) {
		header("Location: ../admin.php?error=".urlencode($e->getMessage()));
		exit;
	}
}
echo "Something went wrong!"; exit;
?>