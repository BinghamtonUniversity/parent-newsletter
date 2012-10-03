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
					<th class="data" width="10px">No</th>
					<th class="data" width="10px">Del</th>
					<th class="data" width="300px">Title</th>
					<th class="data">Status</th>
					<th class="data">User</th>
					<th class="data">Created</th>
					<th class="data">Updated</th>
					<th class="data">First published</th>
					<th class="data">Latest published</th>
				</tr>
				<?php $posts = Posts::AllPosts(true);
						foreach($posts as $a) {
							?>
				<tr class="data">
					
					<td class="data" width="10px"><?=$a->getPostID();?></td>
					<td class="data" width="10px"><a href="services/deletePost.php?id=<?=urlencode($a->getPostID())?>">X</a></td>
					<td class="data" width="300px"><a href="editPost.php?id=<?=urlencode($a->getPostID())?>"><?=$a->getTitle();?></a></td>
					<td class="data"><?php 
					if($a->getStatus() == Posts::STATUS_DRAFT) echo "Draft";
					else echo "Published";
					?></td>
					<td class="data"><?=$a->getUser();?></td>
					<td class="data" width="30px"><?=$a->getCreated();?></td>
					<td class="data" width="30px"><?=$a->getUpdated();?></td>
					<td class="data" width="30px"><?=$a->getFirstPublished();?></td>
					<td class="data" width="30px"><?=$a->getPublished();?></td>
				</tr>

				<?php
				}
				?>
			</table>
		</tbody>
	</div>
<?php include_once('footer.php'); ?>
</div>
</body>
</html>