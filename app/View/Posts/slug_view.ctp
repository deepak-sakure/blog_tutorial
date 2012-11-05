<?php $comments = $post['Comment'];  ?>

<h1><?php echo h($post['Post']['title']); ?></h1>

<h1><?php echo h($tags); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>

<p><?php echo $this->Html->image('/files/pictures/'.$filename, array('height' => '80', 'width' => '80')); ?></p>

<?php /*
<table>
<!-- Here is where we loop through our $comments array, printing out comments info -->

    <?php foreach ($comments as $comment): ?>
    <tr>
        <td><?php echo $comment['id']; ?></td>
        <td>          
            <?php echo $this->Html->link($comment['body'],
array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('controller' => 'comments','action' => 'delete', $comment['id'], $comment['post_id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('controller' => 'comments','action' => 'edit', $comment['id'])); ?>
        </td> 
        <td><?php echo $comment['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($comment); ?>
</table> */
?>
<h1><?php echo h('Comments'); ?></h1>
<?php foreach ($comments as $comment): ?>
<div><b><?php echo empty($comment['url'])?$comment['name']:$this->html->link($comment['name'],$comment['url']); ?></b><span style="font-size:11px;padding-left:10px;"><?php echo $comment['created']; ?></span><br/>
<?php echo $comment['body']; ?><br/>
</div><br/>
<?php endforeach; ?>
<?php unset($comment); ?>

<h1><b>Add Comment</b></h1>
<?php
echo $this->Form->create('Comment', array('url' => '/comments/add'));
//echo $this->Form->input('posts');
//echo $this->Form->input('post_id', array('options' => $posts));
if(!AuthComponent::user('id')) {
echo $this->Form->input('name', array('label' => 'Name','value' => $postData['Comment']['name']));
echo $this->Form->input('email', array('label' => 'Email','value' => $postData['Comment']['email']));
echo $this->Form->input('url', array('label' => 'url','value' => $postData['Comment']['url']));
}
echo $this->Form->input('body', array('rows' => '3', 'label' => 'Comment','value' => $postData['Comment']['body']));
echo $this->Form->input('post_id', array('type' => 'hidden','value' => $post['Post']['id']));
echo $this->Form->end('Save Comment');
?> 
