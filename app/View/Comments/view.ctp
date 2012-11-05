<?php //print_r($comment);?>
<h1><?php echo h($comment['Post']['title']); ?></h1>

<p><small>Created: <?php echo $comment['Comment']['created']; ?></small></p>

<p>Name : <?php echo h($comment['Comment']['name']); ?></p>
<p>Email : <?php echo h($comment['Comment']['email']); ?></p>
<p>Url : <?php echo h($comment['Comment']['url']); ?></p>
<p>Comment : <?php echo h($comment['Comment']['body']); ?></p>

