<h1>Add Tag</h1>
<?php
echo $this->Form->create('Tag');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Tag');
?>
