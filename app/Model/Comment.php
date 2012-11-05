<?php
class Comment extends AppModel {
    public $name = 'Comment';
    public $belongsTo = array(
        'Post' => array(
            'className'    => 'Post',
            'foreignKey'   => 'post_id'
        )
    );

    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        ),
        'email' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank'
            ),
            'rule2' => array(
                'rule' => 'email',
                'message' => 'Please Enter valide Email'  
            ),
        ),
        'url' => array(
            'rule1' => array(
                'rule' => 'url',
                'message' => 'Please Enter valide url',  
                'allowEmpty' => true
            )
        ),                 
        'body' => array(
            'rule' => 'notEmpty'
        ) 
    );	
    
    //required for authorization
    public function isPostOwnedBy($comment, $user) {
        //$post = $this->field('post_id', array('id' =>$comment));
        //return $this->Post->field('id', array('id' => $post, 'user_id' => $user)) === $post;
        return $this->find('first', array('conditions' => array('Comment.id =' => $comment, 'user_id' => $user)));
        //debug($test);exit;
    }
}
?>
