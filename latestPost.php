<?php 
include_once('base/include_top.php');
if(isset($_GET['id'])) {
	try {
		$post = new Posts(array(intval($_GET['id'])));
	}
	catch(Exception $e) {	
		?>
		<div>
			The Post you are trying to access is unavailable. If you think this is a mistake, please contact the web-administrator.
			<br/><br/>
			Thank you.
		</div>
		<?php
		$post = false;
	}
}
else {
	$post = Posts::LatestPost();	
}

if($post !== false) {
	?>
	<h1><?=$post->getTitle();?></h1>
	<div><?=$post->getData();?></div>
	<div>Published on: <?=$post->getPublished();?></div>
	<?php
}
?>