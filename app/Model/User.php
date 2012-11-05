<?php 
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $name = 'User';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )        
        ),
        'name' => array(
            'required' => array(
                'rule' =>array('notEmpty'),
                'message' => 'Name is required'
            )
        ),
        'email' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank'                
            ),
            'rule2' => array(
                'rule' => 'email',
                'message' => 'Please Enter valide Email'
            )
        )                    
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
}
?>
