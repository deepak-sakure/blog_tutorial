<h1>Add Post</h1>
<?php
echo $this->Form->create('Post', array('enctype' => 'multipart/form-data'));
//echo $this->Form->input('Tag');
echo $this->Form->input('tags');
//echo $this->Form->input('tag_id', array('options' => $tags, 'lable' => 'Tag'));
echo $this->Form->input('filename', array('type' => 'file'));
//echo $this->Form->input('Image.filename');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post');
?>
