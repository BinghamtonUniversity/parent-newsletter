<?php 
include_once('base/include_top.php');
if(!isset($_SESSION['admin'])) {
	header("Location: index.php?error=".urlencode("Admin permission required"));
	exit;
}
?>
<html>
<head>
<?php include_once('headers.php'); ?>
</head>

<body>
<?php include_once('top.php'); ?>

<div id="wrapper">
	<?php include_once('leftbar.php'); ?>
	<div id="rightContent">
	<h3>Admins</h3>
	<?php if(isset($_GET['error'])) { ?>}
	<div class="gagal">
		 <?php echo $_GET['error']; ?>
	</div>
	<?php } ?>
		<tbody>
			<table class="data">
				<tr class="data">
					<th class="data" width="30px">No</th>
					<th class="data" width="30px">Del</th>
					<th class="data">Username</th>
				</tr>
				<?php $admins = Admin::AllAdmins(); $i=1;
						foreach($admins as $a) {
							?>
				<tr class="data">
					
					<td class="data" width="30px"><?=$i++;?></td>
					<td class="data" width="30px"><a href="services/deleteAdmin.php?user=<?=urlencode($a->getUsername())?>">X</a></td>
					<td class="data"><?=$a->getUsername();?></td>
					
				</tr>

				<?php
				}
				?>
			</table>
		</tbody>
		<div id="loginForm">
	<div class="headLoginForm">
	Add Administrator
	</div>
	<div class="fieldLogin">
	<form method="POST" action="services/addAdmin.php">
	<label>Username</label><br>
	<input name="user" id="user" type="text" class="login" value="<?php if(isset($_GET['user'])) echo $_GET['user']; ?>"><br>
	<label>Password</label><br>
	<input name="passwd" id="passwd" type="password" class="login" value=""><br>
	<input type="submit" class="button" value="Add Admin">
	</form>
	</div>
</div>
	</div>
<?php include_once('footer.php'); ?>
</div>
</body>
</html>