<?php
require_once '../base/include_top.php';

if(!isset($_SESSION['admin'])) {
	header("Location: ../index.php?error=".urlencode("Admin permission required"));
	exit;
}	
$error = null;

if(isset($_GET['id'])) {
	try {
		$p = new Posts(array(intval($_GET['id'])));
		$p->markForDeletion();
		$p=null;
	}
	catch(Exception $e) {
		$error = $e->getMessage();
	}
}
else {
	$error = "Data didnot reach the server";
	header("Location: ../display.php?error=".urlencode($error));
	exit;
}
	

if($error != null)
	header("Location: ../display.php?&error=".urlencode($error));
else
	header("Location: ../display.php");
?>