<?php
//debug($posts['rss']['channel']['item']);
//$latest_posts = $posts['rss']['channel']['item'];
//debug($this->Post);
$posts = $this->LatestLink->latest('Latest Posts', 'http://localhost/deepak/blog_tutorial/posts/index.rss'); 

//$posts = $this->requestAction('posts/latest');
$latest_posts = $posts['rss']['channel']['item'];
//debug($latest_posts);
?>

<div style="background:#ccc; padding:15px; width:400px; margin:5px;">
<p><b>Latests Posts : </b></p>
<?php foreach($latest_posts as $post) { ?>
<div><?php echo $this->html->link($post['title'], $post['link']); ?>&nbsp;&nbsp;<?php echo $post['pubDate'];?> </div>
<div><?php echo $post['description'];?></div>
<?php } ?>
</div>


