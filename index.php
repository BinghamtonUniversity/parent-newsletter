<html>
<head>
<title>Admin MOS Template</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Copyright" content="arirusmanto.com">
<meta name="description" content="Admin MOS Template">
<meta name="keywords" content="Admin Page">
<meta name="author" content="Ari Rusmanto">
<meta name="language" content="Bahasa Indonesia">

<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeaderLogin"></div>
</div>

<div id="loginForm">
	<div class="headLoginForm">
	Login Administrator
	</div>
	<div class="fieldLogin">
	<form method="POST" action="services/adminLogin.php">
	<label>Username</label><br>
	<input name="user" id="user" type="text" class="login" value="<?php if(isset($_GET['user'])) echo $_GET['user']; ?>"><br>
	<label>Password</label><br>
	<input name="passwd" id="passwd" type="password" class="login" value=""><br>
	<input type="submit" class="button" value="Login">
	</form>
	<?php if(isset($_GET['error'])) echo "<b>".$_GET['error']."</b>"; ?>
	</div>
</div>
</body>
</html>