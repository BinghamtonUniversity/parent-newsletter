<?php 
include_once('base/include_top.php');
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
	<?php if(isset($_GET['error'])) { ?>}
	<div class="gagal">
		 <?php echo $_GET['error']; ?>
	</div>
	<?php } ?>

	<h3>Enter the new post:</h3>
	<textarea class="ckeditor" name="editor1"></textarea>
	<script type="text/javascript">
		CKEDITOR.replace( 'editor1',{
			height: '600px'
		} );
	</script>
	</div>
<?php include_once('footer.php'); ?>
</div>
</body>
</html>