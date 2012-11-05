<?php //echo $comm = $this->requestAction('/posts/edit/3', array('return'));?>
<?php 
//echo AuthComponent::user('id');
?>
<?php //debug($posts); ?>
<h1>Blog posts</h1>
<?php echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add', 'slug' => '')); ?>&nbsp; &nbsp;
<?php //echo $this->Html->link('Comments', array('controller' => 'comments', 'action' => 'index')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id'];//."/".$post['Post']['user_id']; ?></td>
        <td>          
            <?php echo $this->Html->link($post['Post']['title'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php if(AuthComponent::user('id') == $post['Post']['user_id'] || AuthComponent::user('role') == 'admin')  
                  echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>&nbsp;
            <?php if(AuthComponent::user('id') == $post['Post']['user_id'] || AuthComponent::user('role') == 'admin')  
                  echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>&nbsp;
            
            <?php echo $this->Html->link('SlugView', array('action' => 'slug_view','slug' => $post['Post']['slug'])); ?>            
            
            <?php //echo $this->Html->link('SlugView', array('action' => 'slug_view', $post['Post']['slug'] => $post['Post']['id'])); ?>            
            
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>

<div align="center">
<?php echo $this->Paginator->first('First'); 
      echo "&nbsp;&nbsp".$this->Paginator->prev("<< Prev", array(), null, array('class' => 'prev disabled'));
      echo "&nbsp;&nbsp".$this->Paginator->numbers();
      echo "&nbsp;&nbsp".$this->Paginator->next($title = 'Next >>', $options = array(), $disabledTitle = null, $disabledOptions = array()); 
      echo "&nbsp;&nbsp".$this->Paginator->last($title = 'Last');
?>      
</div>
<?php //echo $this->requestAction(array('controller' => 'posts', 'action' => 'latest'), array('return')); ?>
<div style="float:left;">
<?php //echo $this->element('latest_posts'); ?>
</div>
<div style="float:left;">
<?php //echo $this->element('latest_comments'); ?>
</div>

