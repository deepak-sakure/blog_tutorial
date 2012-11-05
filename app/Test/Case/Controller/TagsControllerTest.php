<?php 
App::uses('Controller', 'Controller');
app::uses('TagsController', 'Controller');
//App::import('Controller', 'Tags');

class TagsControllerTest extends ControllerTestCase {
    public $fixtures = array('app.tag', 'app.post', 'app.posts_tag');

    public function setUp() {
        parent::setUp();
        $this->Tags = new TagsController();
        $this->Tags->constructClasses();
    }

    public function tearDown() {
        unset($this->Tags);
        parent::tearDown();
    }

    public function testIndex() {
        $expected =  array(
			'Tag' => array(
				'id' => '1',
				'title' => 'Lorem ipsum dolor sit amet',
				'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat.',
				'created' => '2012-09-20 11:06:12',
				'modified' => '2012-09-20 11:06:12'
			),
			'Post' => array(
				(int) 0 => array(
					'id' => '1',
					'title' => 'p Lorem ipsum dolor sit amet',
					'slug' => 'Lorem ipsum dolor sit amet',
					'body' => 'p Lorem ipsum dolor sit amet, aliquet feugiat.',
					'created' => '2012-09-20 11:04:39',
					'modified' => '2012-09-20 11:04:39',
					'user_id' => '1',
					'PostsTag' => array(
						'id' => '1',
						'post_id' => '1',
						'tag_id' => '1',
						'created' => '2012-09-20 11:05:07',
						'modified' => '2012-09-20 11:05:07'
					)
				)
			)
		);
        $result = $this->testAction(
            '/tags/index',
            array('method' => 'get', 'return' => 'vars')
        );
        $this->assertEquals($expected, $result['tags'][0]);
    }        
    
    public function testViewInvalidIdDoesNotWork() {
        try {
            $result = $this->testAction(
                '/tags/view/9',
                array('method' => 'get', 'return' => 'vars')
            );
        } catch (NotFoundException $e) {
        
        }    
    }
    
    public function testView() {
        $expected = array(
		    'Tag' => array(
			    'id' => '1',
			    'title' => 'Lorem ipsum dolor sit amet',
			    'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat.',
			    'created' => '2012-09-20 11:06:12',
			    'modified' => '2012-09-20 11:06:12'
		    ),
		    'Post' => array(
			    (int) 0 => array(
				    'id' => '1',
				    'title' => 'p Lorem ipsum dolor sit amet',
				    'slug' => 'Lorem ipsum dolor sit amet',
				    'body' => 'p Lorem ipsum dolor sit amet, aliquet feugiat.',
				    'created' => '2012-09-20 11:04:39',
				    'modified' => '2012-09-20 11:04:39',
				    'user_id' => '1',
				    'PostsTag' => array(
					    'id' => '1',
					    'post_id' => '1',
					    'tag_id' => '1',
					    'created' => '2012-09-20 11:05:07',
					    'modified' => '2012-09-20 11:05:07'
				    )
			    )
		    )
		);    
        $result = $this->testAction(
            '/tags/view/1',
            array('method' => 'get', 'return' => 'vars')
        );
        $this->assertEquals($expected, $result['tag']);
    }
    
    public function testAdd() {
        $data = array(
            'Tag' => array(
                'id' => 1,
                'title' => 'test'
            )
        );
        $this->testAction(
            '/tags/add',
            array('data' => $data, 'method' => 'post', 'return' => 'vars')
        );            
        $result = $this->Tags->Session->read('Message.flash.message');
        $expected = 'Your tag has been saved.';
        $this->assertEquals($expected, $result);
    }
    
    public function testAddInvalidData() {
        $data = array(
            'Tag' => array(
                'id' => 9,
                'title' => ''
            )
        );
        $result = $this->testAction(
            '/tags/add',
            array('data' => $data, 'method' => 'post', 'return' => 'vars')
        );            
        $result = $this->Tags->Session->read('Message.flash.message');
        $expected = 'Unable to add your tag.';
        $this->assertEquals($expected, $result);
    }
    
    public function testEdit() {
        $data = array(
            'Tag' => array(
                'id' => 1,
                'title' => 'test'
            )
        );
        $result = $this->testAction(
            '/tags/edit/1',
            array('data' => $data, 'method' => 'post', 'return' => 'vars')
        );            
        $result = $this->Tags->Session->read('Message.flash.message');
        $expected = 'Your tag has been updated.';
        $this->assertEquals($expected, $result);  
    }
    
    public function testEditInvalidData() {
        $data = array(
            'Tag' => array(
                'id' => 9,
                'title' => ''
            )
        );
        $result = $this->testAction(
            '/tags/edit/1',
            array('data' => $data, 'method' => 'post', 'return' => 'vars')
        );            
        $result = $this->Tags->Session->read('Message.flash.message');
        $expected = 'Unable to update your tag.';
        $this->assertEquals($expected, $result);  
    }
    
    public function testEditGetData () {
        $result = $this->testAction(
            '/tags/edit/1',
            array('method' => 'get', 'return' => 'vars')
        );
        debug($result);
    }

    public function testDelete() {
        $this->testAction(
            '/tags/delete/1',
            array('method' => 'post', 'return' => 'vars')
        );
        $result = $this->Tags->Session->read('Message.flash.message');
        $expected = 'The tag with id: 1 has been deleted';
        $this->assertEquals($expected, $result);  
    }
    
    public function testDeleteInvalidIdDoesNotWork() {
        try {
            $result = $this->testAction(
                '/tags/delete/9',
                array('method' => 'post', 'return' => 'vars')
            );
        } catch(MethodNotAllowedException $e) {
        
        }    
    }
    
     public function testDeleteInvalidMethodNotAllowed() {
        try {
            $result = $this->testAction(
                '/tags/delete/1',
                array('method' => 'get', 'return' => 'vars')
            );    
        } catch(MethodNotAllowedException $e) {
        
        }    
    }
                                
}
?>
