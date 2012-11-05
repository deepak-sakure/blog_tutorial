<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('url');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
