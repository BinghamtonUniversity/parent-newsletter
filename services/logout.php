<?php
require_once '../base/include_top.php';

session_destroy();
header("Location: ../index.php");
?>