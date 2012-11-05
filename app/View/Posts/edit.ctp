<?php //debug($this->request->data);
$filename = $this->request->data['Post']['filename1'];
?>
<h1>Edit Post</h1>
<?php
    echo $this->Form->create('Post', array('action' => 'edit', 'enctype' => 'multipart/form-data'));
    echo $this->Form->input('tags', array('type' => 'text'));
    echo $this->Form->input('filename', array('type' => 'file')); 
    echo $this->Html->image('/files/pictures/'.$filename, array('height' => '80', 'width' => '80'));
    echo $this->Form->input('title');
    echo $this->Form->input('body', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->input('Image.id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');
?>
