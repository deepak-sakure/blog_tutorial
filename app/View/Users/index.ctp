<h1>Users</h1>
<?php //echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add', 'slug' => '')); ?>&nbsp; &nbsp;
<?php //echo $this->Html->link('Comments', array('controller' => 'comments', 'action' => 'index')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>User</th>
        <th>Password</th>
        <th>Role</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td><?php echo $user['User']['username']; ?></td>
        <td><?php echo $user['User']['password']; ?></td>
        <td><?php echo $user['User']['role']; ?></td>
        <td><?php echo $user['User']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>

