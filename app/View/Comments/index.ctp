<?php //print_r($comments);//print_r($post_id); echo $post_id ?>
<h1>Comments</h1>
<?php echo $this->Html->link('Add Comment', array('controller' => 'comments', 'action' => 'add')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Comments</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $comments array, printing out comments info -->

    <?php foreach ($comments as $comment): ?>
    <tr>
        <td><?php echo $comment['Comment']['id']; ?></td>
        <td>          
            <?php echo $this->Html->link($comment['Comment']['body'],
array('controller' => 'comments', 'action' => 'view', $comment['Comment']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $comment['Comment']['id'], $comment['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $comment['Comment']['id'], $comment['Post']['id'])); ?>
        </td> 
        <td><?php echo $comment['Comment']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($comment); ?> 
</table>

<div align="center">
<?php echo $this->Paginator->first('First'); ?>&nbsp;&nbsp;
<?php echo $this->Paginator->prev(' << ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>&nbsp;&nbsp;
<?php echo $this->Paginator->numbers();?>&nbsp;&nbsp;
<?php echo $this->Paginator->next($title = 'Next >>', $options = array(), $disabledTitle = null, $disabledOptions = array()); ?>&nbsp;&nbsp;
<?php echo $this->Paginator->last($title = 'Last');?><br/>
</div>

