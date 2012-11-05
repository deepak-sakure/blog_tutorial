<?php 
App::uses('Comment', 'Model');

class CommentTest extends CakeTestCase {
    public $fixtures = array('app.comment', 'app.post');
    
    public function setUp() {
        parent::setUp();
        $this->Comment = ClassRegistry::init('Comment');        
    }
    
    public function testIsPostOwnedBy() {
        $result = $this->Comment->isPostOwnedBy(1,1);
        //$expected = true;
        //$this->assertEquals($expected, $result);
        debug($result);
    }
}
?>

