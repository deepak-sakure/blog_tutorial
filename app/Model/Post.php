<?php
class Post extends AppModel {
     
    public $name = 'Post';
    public $actsAs = array(
        'Tag' => array(
            'separator' => ',',
	        'tag_label' => 'title',
  	        'table_label' => 'tags' 
        ),
        /*'ImageUpload' => array(
            'dirFormat'        => 'pictures',
            'fileField'        => 'filename',
            //'allowedSize'      => '5',
            //'allowedSizeUnits' => 'MB',
        )*/
    );    
    
    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'dependent'    => true
        ),
    );
   
    public $hasAndBelongsToMany = array(
        'Tag' =>
            array(
                'className'              => 'Tag',
                'joinTable'              => 'posts_tags',
                'foreignKey'             => 'post_id',
                'associationForeignKey'  => 'tag_id',
                'unique'                 => true
            )
    );
    
    public $hasOne = array(
        'Image' => array(
            'className' => 'Image',
            'dependent' => true
        )
    );        
  
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );	
    
    //required for authorization
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
    }
}
?>
