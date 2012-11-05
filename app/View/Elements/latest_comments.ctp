<?php

$comments = $this->LatestLink->latest('Latest comments', 'http://localhost/deepak/blog_tutorial/comments/index.rss'); 
$latest_comments = $comments['rss']['channel']['item'];
//debug($comments);
?>

<div style="background:#ccc; padding:15px; width:400px; margin:5px;">
<p><b>Latests Comments : </b></p>
<?php foreach($latest_comments as $comment) { ?>
<div><b><?php echo $comment['name']; ?></b>&nbsp;&nbsp;<?php echo $comment['pubDate'];?> </div>
<div><?php echo $comment['description'];?></div>
<?php } ?>
</div>


