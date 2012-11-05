<?php //print_r($this->request->data[0]['Post']);//print_r($post_id); echo $post_id ?>
<h1>Add Comment</h1>
<?php
echo $this->Form->create('Comment');
//echo $this->Form->input('posts');
echo $this->Form->input('post_id', array('options' => $posts));
echo $this->Form->input('body', array('rows' => '3', 'label' => 'Comment Body'));
echo $this->Form->end('Save Comment');
?> 
