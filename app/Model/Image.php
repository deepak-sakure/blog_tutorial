<?php
class Image extends AppModel {
     
    public $name = 'Image';
    
    public $belongsTo = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey'   => 'post_id'
        )
    );
}
?>
