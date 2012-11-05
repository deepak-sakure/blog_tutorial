<?php
App::uses('Controller', 'Controller');
App::uses('CommentsController', 'Controller');
//or App::import('Controller', 'Comments');


class CommentsControllerTest extends ControllerTestCase {
    public $fixtures = array('app.post', 'app.comment', 'app.image', 'app.tag', 'app.posts_tag');
    
    public function setUp() {
        parent::setUp();
        $this->Comments = new CommentsController();
        $this->Comments->constructClasses();
    }
    
    public function tearDown() {
        unset($this->Comments);
        parent::tearDown();
    }
    
    public function testIsAuthorized() {
        $result = $this->testAction('/comments/isAuthorized/156', array('return' => 'result'));
        $this->assertFalse($result);
    }
    
    public function testIndex() {
        $result = $this->testAction('/comments/index', array('return' => 'vars'));
        $expected = array(
			'Comment' => array(
				'id' => '1',
				'post_id' => '1',
				'name' => 'c Lorem ipsum dolor sit amet',
				'email' => 'c Lorem ipsum dolor sit amet',
				'url' => 'c Lorem ipsum dolor sit amet',
				'body' => 'c Lorem ipsum dolor sit amet, aliquet feugiat.',
				'published' => true,
				'created' => '2012-09-20 11:04:08',
				'modified' => '2012-09-20 11:04:08'
			),
			'Post' => array(
				'id' => '1',
				'title' => 'p Lorem ipsum dolor sit amet',
				'slug' => 'Lorem ipsum dolor sit amet',
				'body' => 'p Lorem ipsum dolor sit amet, aliquet feugiat.',
				'created' => '2012-09-20 11:04:39',
				'modified' => '2012-09-20 11:04:39',
				'user_id' => '1'
			)
		);
		$this->assertEquals($expected, $result['comments'][0]);	
    }  
    
    
    public function testIndexRss() {
        $result = $this->testAction('/comments/index.rss', array('return' => 'vars'));
        $expected = array(
			'Comment' => array(
				'id' => '1',
				'post_id' => '1',
				'name' => 'c Lorem ipsum dolor sit amet',
				'email' => 'c Lorem ipsum dolor sit amet',
				'url' => 'c Lorem ipsum dolor sit amet',
				'body' => 'c Lorem ipsum dolor sit amet, aliquet feugiat.',
				'published' => true,
				'created' => '2012-09-20 11:04:08',
				'modified' => '2012-09-20 11:04:08'
			),
			'Post' => array(
				'id' => '1',
				'title' => 'p Lorem ipsum dolor sit amet',
				'slug' => 'Lorem ipsum dolor sit amet',
				'body' => 'p Lorem ipsum dolor sit amet, aliquet feugiat.',
				'created' => '2012-09-20 11:04:39',
				'modified' => '2012-09-20 11:04:39',
				'user_id' => '1'
			)
		);
		$this->assertEquals($expected, $result['comments'][0]);
    }
    
    public function testAdd() {
        $this->Comments->Session->write(
            'Auth', 
            array('user' => array(
                'id' => '1',
                'name' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem',
                'email' => 'Lorem@gmail.com',
                'url' => 'Lorem.com'
            ))
        );
        debug($this->Comments->Session->read('Auth.user.email'));
        $data = array(
            'Comment' => array(
                'post_id' => 1,
                'name' => 'test',
                'email' => 'test@gmail.com',
                'url' => 'blogs.com',
                'body' => 'test',                
            )
        );        
        $this->testAction(
            '/comments/add',
            array('data' => $data, 'method' => 'post')            
        );    
        $expected = 'Your Comment has been saved.';
        $result = $this->Comments->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }
    
    public function testAddNotSave() {
        $data = array(
            'Comment' => array(
                'post_id' => 1,
                'name' => 'test',
                'email' => 'test@gmail.com',
                'url' => 'blogs.com',
                'body' => '',                
            )
        );        
        $this->testAction(
            '/comments/add',
            array('data' => $data, 'method' => 'post')            
        );    
        $expected = 'Unable to add your comment.';
        $result = $this->Comments->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    } 
   
   public function testEditValidData() {
       $data = array(
            'Comment' => array(
                'post_id' => 1,
                'name' => 'deepak',
                'email' => 'deepak@gmail.com',
                'url' => 'blogs.com',
                'body' => 'test',                
            )
        );        
        $this->testAction(
            '/comments/edit/1',
            array('data' => $data, 'method' => 'post')            
        );    
        $expected = 'Your Comment has been updated.';
        $result = $this->Comments->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
   }
   
   public function testEditNotSave() {
       $data = array(
            'Comment' => array(
                'post_id' => 1,
                'name' => 'test',
                'email' => 'test@gmail.com',
                'url' => 'blogs.com',
                'body' => ''
            )
        );        
        $this->testAction(
            '/comments/edit/1',
            array('data' => $data, 'method' => 'post')            
        );    
        $expected = 'Unable to update your comment.';
        $result = $this->Comments->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
   }
   
   public function testEditGet() {   
       $result = $this->testAction('/comments/edit/6', array('method' => 'get', 'return' => 'vars'));
       $expected = array(
           'posts' => array(
		        (int) 1 => 'p Lorem ipsum dolor sit amet'
	        )
       );
       $this->assertEquals($expected, $result);
       debug($result);
   }
   
   public function testViewValidId() {
       $result = $this->testAction('/comments/view/4', array('return' => 'vars'));
       $expected = array(
	        'comment' => false
        );
        $this->assertEquals($expected, $result);
   }
   
   public function testPublish() {
       $this->testAction('/comments/publish/1/1', array('return' => 'result'));
       $result = $this->Comments->Session->read('Message.flash.message');
       $expected = 'Your Comment has been published';
       $this->assertEquals($expected, $result);
   }
   
   public function testDelete() {
       $this->testAction('/comments/delete/1/1', array('return' => 'result'));
       $result = $this->Comments->Session->read('Message.flash.message');
       $expected = 'The comment with id: 1 has been deleted';
       $this->assertEquals($expected, $result);
   }   
   
   public function testDeleteMethodNotAllowed() {
       try {
           $result = $this->testAction('/comments/delete/1/1', array('method' => 'get'));
       } catch (MethodNotAllowedException $e) {
           debug($e->getMessage());       
       }
   }
}
?>

