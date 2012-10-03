<?php
require_once '../base/include_top.php';

if(!isset($_SESSION['admin'])) {
	header("Location: ../index.php?error=".urlencode("Admin permission required"));
	exit;
}	
$error = null;

if(isset($_POST['id']) && isset($_POST['editor1']) && isset($_POST['title']) && (isset($_POST['draft']) || isset($_POST['publish']))) {
	try {
		$p = new Posts(array(intval($_POST['id'])));
		$p->setData($_POST['editor1']);
		$p->setTitle($_POST['title']);
		if(isset($_POST['draft']))
			$p->setStatus(Posts::STATUS_DRAFT);
		else
			$p->setStatus(Posts::STATUS_PUBLISHED);
		$p->save();
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
	header("Location: ../editPost.php?id=".$p->getPostID()."&error=".urlencode($error));
else
	header("Location: ../editPost.php?id=".$p->getPostID())."$success=true";
?>