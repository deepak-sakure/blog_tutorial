<h1>Blog Tags</h1>
<?php echo $this->Html->link('Add Tag', array('controller' => 'tags', 'action' => 'add')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($tags as $tag): ?>
    <tr>
        <td><?php echo $tag['Tag']['id']; ?></td>
        <td>          
            <?php echo $this->Html->link($tag['Tag']['title'],
array('controller' => 'tags', 'action' => 'view', $tag['Tag']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $tag['Tag']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $tag['Tag']['id'])); ?>            
        </td> 
        <td><?php echo $tag['Tag']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($tag); ?>
</table>

