<?php
App::uses('Controller', 'Controller');
App::import('Controller', 'Users');

class UsersControllerTest extends ControllerTestCase {
    public $fixtures = array('app.user');
    
    public function setUp() {
        parent::setUp();
        $this->Users = new UsersController();
        $this->Users->constructClasses();
    }
    
    public function tearDown() {
        unset($this->Users);
        parent::tearDown();
    }
    
    public function testLoginFailed() {
        //$this->Users->Session->write('Auth', array('User' => array('id' => '3451')));
        $data = array(
        'User' => array(
            'username' => 'Loremasdf',
            'password' => 'Lorem',
            )
        ); 
        $this->testAction(
        '/users/login',
        array('data' => $data, 'method' => 'post')
        );         
        $result = $this->Users->Session->read('Message.flash.message');
        $expected = 'Invalid username or password, try again';
        $this->assertEquals($expected, $result);
    }

    public function testLoginSuccess() {
        $this->Users->Session->write('Auth', array('User' => array('id' => '1')));
        $data = array(
        'User' => array(
            'username' => 'Lorem',
            'password' => 'Lorem',
            )
        ); 
        $result = $this->testAction(
        '/users/login',
        array('data' => $data, 'method' => 'post')
        ); 
    }
    
    
    public function testLogout() {
        $result = $this->testAction(
            '/users/logout',
            array('method' => 'post', 'return' => 'vars')
        );
    }
    
    
    public function testIndexViewData() {
        $expected = array(
			'User' => array(
				'password' => 'Lorem',
				'id' => '1',
				'username' => 'Lorem',
				'role' => 'admin',
				'name' => 'Lorem ipsum dolor sit amet',
				'email' => 'Lorem@gmail.com',
				'url' => 'Lorem.com',
				'created' => '2012-09-20 11:06:23',
				'modified' => '2012-09-20 11:06:23'
			)
		);
			
        $result = $this->testAction(
            '/users/index',
            array('method' => 'get', 'return' => 'vars')
        );
        $this->assertEquals($expected, $result['users'][0]);
    }
    
    public function testViewValidId() {
        $expected = array(
            'User' => array(
				'password' => 'Lorem',
				'id' => '1',
				'username' => 'Lorem',
				'role' => 'admin',
				'name' => 'Lorem ipsum dolor sit amet',
				'email' => 'Lorem@gmail.com',
				'url' => 'Lorem.com',
				'created' => '2012-09-20 11:06:23',
				'modified' => '2012-09-20 11:06:23'
		    )
		);    
        $result = $this->testAction(
            '/users/view/1',
            array('method' => 'get', 'return' => 'vars')
        );
        $this->assertEquals($expected, $result['user']);
        //debug($result);    
    }
    
    public function testViewInvalidIdNotFound() {
        try {
            $result = $this->testAction(
                '/users/view/9',
                array('method' => 'get', 'return' => 'vars')
            );
        } catch (NotFoundException $e){
            $result = $e->getMessage();
            debug($result);
        }    
    }
    
    public function testAddValidData() {
        $data = array(
            'User' => array(
                'username' => 'test',
                'password' => 'test',
                'role' => 'admin',
                'name' => 'test',
                'email' => 'test@gmail.com',
                'url' => 'test.com'
            )
        );
        $this->testAction(
            '/users/add',
            array('data' => $data, 'method' => 'post')
        );    
        $expected = 'The user has been saved';
        $result   = $this->Users->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }
    
    public function testAddInvalidDataNotSave() {
        $data = array(
            'User' => array(
                'username' => 'test',
                'password' => '',
                'role' => 'admin',
                'name' => '',
                'email' => 'test@gmail.com',
                'url' => 'test.com'
            )
        );
        $this->testAction(
            '/users/add',
            array('data' => $data, 'method' => 'post')
        );    
        $expected = 'The user could not be saved. Please, try again.';
        $result   = $this->Users->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }
   
    public function testEditInvalidIdDoesNotWork() {
        try {
            $result = $this->testAction(
                '/users/edit/9',
                array('method' => 'get', 'return' => 'vars')
            );
        } catch (NotFoundException $e) {
            debug($e->getMessage());
        }    
    }

    public function testEdit() {
        $data = array(
            'User' => array(
                'username' => 'test',
                'password' => 'test',
                'role' => 'admin',
                'name' => 'test',
                'email' => 'test@gmail.com',
                'url' => 'test.com'
            )
        );
        $this->testAction(
            '/users/edit/1',
            array('data' => $data, 'method' => 'post')
        );    
        $expected = 'The user has been saved';
        $result   = $this->Users->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }
    
    public function testEditGetData() {
        $result = $this->testAction(
            '/users/edit/1',
            array('method' => 'get', 'return' => 'vars')
        );
        debug($result);
    }
    
    public function testEditInvalidDataNotSave() {
        $data = array(
            'User' => array(
                'username' => 'test',
                'password' => '',
                'role' => 'admin',
                'name' => '',
                'email' => 'test@gmail.com',
                'url' => 'test.com'
            )
        );
        $this->testAction(
            '/users/edit/1',
            array('data' => $data, 'method' => 'post')
        );    
        $expected = 'The user could not be saved. Please, try again.';
        $result = $this->Users->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }
    
    public function testDelete() {
        $result = $this->testAction(
            '/users/delete/1', 
            array('method' => 'post', 'return' => 'result')
        );
        $expected = 'User was not deleted';
        $result = $this->Users->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }

    public function testDeleteInvalidIdNotFound() {    
        try {
            $result = $this->testAction(
                '/users/delete/9', 
                array('method' => 'post', 'return' => 'vars')
            );
        } catch (MethodNotAllowedException $e) {
        
        }
    }
    
     public function testDeleteInvalidMethodNotAllowed() {    
        try {
            $result = $this->testAction(
                '/users/delete/1', 
                array('method' => 'get', 'return' => 'vars')
            );
        } catch (MethodNotAllowedException $e) {
            debug($e->getMessage());
        }
    }
}    
?>


