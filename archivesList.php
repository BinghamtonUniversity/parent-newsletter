<?php 
include_once('base/include_top.php');
if(isset($_GET['search']) && strlen(trim($_GET['search'])) > 0 )
	$posts = Posts::search($_GET['search']);
else
	$posts = Posts::AllPosts(true,true);

$monthName = array(
	1 => "Jan",
	2 => "Feb",
	3 => "Mar",
	4 => "Apr",
	5 => "May",
	6 => "Jun",
	7 => "Jul",
	8 => "Aug",
	9 => "Sep",
	10 => "Oct",
	11 => "Nov",
	12 => "Dec"
	);

if(isset($_GET['search']) && strlen(trim($_GET['search'])) > 0 ) {
	$_GET['search'] = trim($_GET['search']);
?>
<h1> Search Result for <?=$_GET['search']?> </h1>
<?php 
}
else {
?>
<h1> Archives list </h1>
<?php
} ?>
<dl>
	<?php
	$currentYear = null;
	$currentMonth = null;
	$changeMonth = false;
	foreach ($posts as $post) {
		$published = getdate(date($post->getPublishedTimeStamp()));
		if($published['year'] !== $currentYear || $published['mon'] !== $currentMonth) 
		{		
			$currentYear = $published['year'];
			$currentMonth = $published['mon'];
			$changeMonth = true;
	?>
	<dt> <?=$published['year'];?> - <?=$monthName[$published['mon']];?>
		<?php
		} ?>
		<dd>
			<a href="latestPost.php?id=<?=$post->getPostID();?>"><?=$post->getTitle();?></a>
		</dd>
	<?php
	if($changeMonth) { ?>
	</dt>
	<?php }
	$changeMonth = false;
	}
	?>
</dl>
