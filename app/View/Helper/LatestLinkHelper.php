<?php
App::uses('AppHelper', 'View/Helper');

class LatestLinkHelper extends AppHelper {

    public function latest($title, $url) {
        $xml = Xml::build($url, array('return' => 'simplexml'));
        return $xmlArray = Xml::toArray($xml);
    }
}
?>
