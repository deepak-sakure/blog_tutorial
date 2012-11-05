<?php
App::uses('Controller', 'Controller');
app::uses('PostsController', 'Controller');
//or App::import('Controller', 'Posts');

class PostsControllerTest extends ControllerTestCase {
    public $fixtures = array('app.post','app.image', 'app.comment', 'app.tag', 'app.posts_tag');
        
    /*$Posts = $this->generate('Posts', array(
        'components' => array(
            'Session',
            'Auth' => array('user')
        )
    ));
    $Posts->Auth->staticExpects($this->any())
        ->method('user')
        ->with('id')
        ->will($this->returnValue(1));*/
        
         
    public function setUp() {
        parent::setUp();
        $this->Posts = new PostsController();
        $this->Posts->constructClasses();
    }

    public function tearDown() {
        unset($this->Posts);
        parent::tearDown();
    }

    
    public function testIsAuthorized() {
        $result = $this->testAction('/posts/isAuthorized/1', array('return' => 'result'));
        $this->assertFalse($result);
        //debug($result);
    }
    
    public function testIndex() {
        $expected = array(
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
        $result = $this->testAction('/posts/index', array('return' => 'vars'));
        $this->assertEquals($expected, $result['posts'][0]);
        //debug($result);
    }   
    
    public function testIndexRss() {        
        $expected = array(
            'Post' => array(
				'id' => '1',
				'title' => 'p Lorem ipsum dolor sit amet',
				'slug' => 'Lorem ipsum dolor sit amet',
				'body' => 'p Lorem ipsum dolor sit amet, aliquet feugiat.',
				'created' => '2012-09-20 11:04:39',
				'modified' => '2012-09-20 11:04:39',
				'user_id' => '1'
			),
			'Image' => array(
				'id' => '1',
				'post_id' => '1',
				'filename' => 'Lorem ipsum dolor sit amet, aliquet feugiat.',
				'created' => '2012-09-20 11:04:25',
				'modified' => '2012-09-20 11:04:25'
			)
        );
        $result = $this->testAction('/posts/index.rss', array('return' => 'vars'));
        $this->assertEquals($expected, $result['posts'][0]);
        //debug($result);
    }
        
    public function testViewValidId() {
        $result = $this->testAction(
            '/posts/view/1', 
            array('return' => 'vars'));
        $expected = array(
	        'postData' => null,
	        'tags' => 'Lorem ipsum dolor sit amet',
	        'filename' => 'Lorem ipsum dolor sit amet, aliquet feugiat.',
	        'post' => array(
		        'Post' => array(
			        'id' => '1',
			        'title' => 'p Lorem ipsum dolor sit amet',
			        'slug' => 'Lorem ipsum dolor sit amet',
			        'body' => 'p Lorem ipsum dolor sit amet, aliquet feugiat.',
			        'created' => '2012-09-20 11:04:39',
			        'modified' => '2012-09-20 11:04:39',
			        'user_id' => '1'
		        ),
		        'Image' => array(
			        'filename' => 'Lorem ipsum dolor sit amet, aliquet feugiat.'
		        ),
		        'Comment' => array(
			        (int) 0 => array(
				        'id' => '1',
				        'post_id' => '1',
				        'name' => 'c Lorem ipsum dolor sit amet',
				        'email' => 'c Lorem ipsum dolor sit amet',
				        'url' => 'c Lorem ipsum dolor sit amet',
				        'body' => 'c Lorem ipsum dolor sit amet, aliquet feugiat.',
				        'published' => true,
				        'created' => '2012-09-20 11:04:08',
				        'modified' => '2012-09-20 11:04:08'
			        )
		        ),
		        'Tag' => array(
			        (int) 0 => array(
				        'title' => 'Lorem ipsum dolor sit amet',
				        'PostsTag' => array(
					        'id' => '1',
					        'post_id' => '1',
					        'tag_id' => '1',
					        'created' => '2012-09-20 11:05:07',
					        'modified' => '2012-09-20 11:05:07'
				        )
			        )
		        )
	        )
        );   
        $this->assertEquals($expected, $result); 
    }
    
    public function testViewInvalidIdDoesNotWork() {
        try {
            $this->testAction('/posts/view/9', array('return' => 'vars'));
        } catch (NotFoundException $e) {            
            $expected = $e->getMessage();
            debug($expected);
        }           
    }
    
    public function testSlugViewValidSlug() {
        $expected = array(
	    'postData' => null,
	    'tags' => '',
	    'filename' => null,
	    'post' => array(
		    'Post' => array(
			    'id' => '1',
			    'title' => 'p Lorem ipsum dolor sit amet',
			    'slug' => 'Lorem ipsum dolor sit amet',
			    'body' => 'p Lorem ipsum dolor sit amet, aliquet feugiat.',
			    'created' => '2012-09-20 11:04:39',
			    'modified' => '2012-09-20 11:04:39',
			    'user_id' => '1'
		    ),
		    'Image' => array(
			    'id' => '1',
			    'post_id' => '1',
			    'filename' => 'Lorem ipsum dolor sit amet, aliquet feugiat.',
			    'created' => '2012-09-20 11:04:25',
			    'modified' => '2012-09-20 11:04:25'
		    ),
		    'Comment' => array(
			    (int) 0 => array(
				    'id' => '1',
				    'post_id' => '1',
				    'name' => 'c Lorem ipsum dolor sit amet',
				    'email' => 'c Lorem ipsum dolor sit amet',
				    'url' => 'c Lorem ipsum dolor sit amet',
				    'body' => 'c Lorem ipsum dolor sit amet, aliquet feugiat.',
				    'published' => true,
				    'created' => '2012-09-20 11:04:08',
				    'modified' => '2012-09-20 11:04:08'
			    )
		    ),
		    'Tag' => array(
			    (int) 0 => array(
				    'id' => '1',
				    'title' => 'Lorem ipsum dolor sit amet',
				    'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat.',
				    'created' => '2012-09-20 11:06:12',
				    'modified' => '2012-09-20 11:06:12',
				    'PostsTag' => array(
					    'id' => '1',
					    'post_id' => '1',
					    'tag_id' => '1',
					    'created' => '2012-09-20 11:05:07',
					    'modified' => '2012-09-20 11:05:07'
				    )
			    )
		    )
	    )
    );
        $result = $this->testAction('/posts/slug_view/Lorem ipsum dolor sit amet', array('return' => 'vars'));
        $this->assertEquals($expected, $result);
        //debug($result);
    }
    
    public function testAdd() {               
        $data = array(
            'Post' => array(
                'user_id' => 1,
                'published' => 1,
                'slug' => 'new-article',             
                'title' => 'test title',              
                'body' => 'test body',
                'filename' => array(
                    'error' => 1
                ),
                'tags' => 'test tag'   
            )    
        );        
        $result = $this->testAction(
            '/posts/add/1', 
            array('data' => $data, 'method' => 'post', 'return' => 'vars')
        );
        $expected = 'Your post has been saved.';
        $result   = $this->Posts->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }
  
    public function testAddNotSave() {     
        $data = array(
            'Post' => array(
                'user_id' => 1,
                'published' => 1,
                'slug' => 'new-article',             
                'title' => 'test title',              
                'body' => 'test body',
                'filename' => array(
                    'error' => 0,
                    'name' => 'test',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpicNCON',
                    'size' => 999
                ),
                'tags' => 'test tag'   
            )    
        );        
        $result = $this->testAction(
            '/posts/add/1', 
            array('data' => $data, 'method' => 'post')
        );
        $expected = 'Unable to add your post.';
        $result = $this->Posts->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
        
        /*$Posts = $this->generate('Posts', array(
            'components' => array(
                'Session'
            )
        ));         
        $Posts->Session
            ->expects($this->once())
            ->method('setFlash');             */
    }   
     
    public function testEditPost() {
        $data = array(
            'Post' => array(
                'title' => 'test title',
                'slug' => 'test slug',
                'body' => 'test body',
                'filename' => array(
                    'error' => 1
                ),
                'tags' => 'test tag'   
            )
        );        
        $this->testAction(
            '/posts/edit/1', 
            array('data' => $data, 'method' => 'post')
        );
        $expected = 'Your post has been updated.';
        $result = $this->Posts->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    } 
    
    public function testEditPostNotSave() {
         $data = array(
            'Post' => array(
                'user_id' => 1,
                'published' => 1,
                'slug' => 'new-article',             
                'title' => 'test title',              
                'body' => 'test body',
                'filename' => array(
                    'error' => (int)0,
                    'name' => 'test',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpicNCON',
                    'size' => 999
                ),
                'tags' => 'test tag'   
            )    
        );        
        $result = $this->testAction(
            '/posts/edit/1',
            array('data' => $data, 'method' => 'post')
        );
        $expected = 'Unable to update your post.';
        $result = $this->Posts->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }  
    
    public function testEditGetData() {
        $result = $this->testAction(
            '/posts/edit/1', 
            array('method' => 'get', 'return' => 'vars')
        );
        debug($result);
    } 
           
    public function testDelete() {
        $this->testAction('/posts/delete/1', array('return' => 'vars'));
        $expected = 'The post with id: 1 has been deleted';
        $result = $this->Posts->Session->read('Message.flash.message');
        $this->assertEquals($expected, $result);
    }

    public function testDeleteInvalidMethodNotAllowed() {
        try {
            $result = $this->testAction('/posts/delete/1', array('method' => 'get', 'return' => 'result'));
        } catch(MethodNotAllowedException $e){
            debug($e->getMessage());
        }
    }
   
}
?>

