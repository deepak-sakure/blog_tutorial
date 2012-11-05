<?php
class AllTestsTest extends CakeTestSuite {
    public static function suite() {
        $suite = new CakeTestSuite('All Tests');
        $suite->addTestDirectory(TESTS . 'Case' . DS . 'Model');
        $suite->addTestDirectory(TESTS . 'Case' . DS . 'Controller');
        return $suite;
    }
}
?>
