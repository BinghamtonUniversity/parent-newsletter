<?
session_start();

function __autoload($className) {
	if(file_exists("../base/$className.php"))
	include_once "../base/$className.php";
	if(file_exists("$className.php"))
	include_once "$className.php";
	if(file_exists("base/$className.php"))
	include_once "base/$className.php";
}
?>