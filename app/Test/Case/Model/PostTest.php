<?php 
App::uses('Post', 'Model');

class PostTest extends CakeTestCase {
    public $fixtures = array('app.post');
    
    public function setUp() {
        parent::setUp();
        $this->Post = ClassRegistry::init('Post');
    }
    
    public function testIsOwnedBy() {
        $result = $this->Post->isOwnedBy(1,1);
        //$expected = true;
        //$this->assertEquals($expected, $result);
        debug($result);
    }
}
?>

