<?php
//debug($this->Rss);exit;

$this->set('channelData', array(
    'title' => __("Most Recent Comments"),
    'link' => $this->Html->url('/', true),
    'description' => __("Most recent comments."),
    'language' => 'en-us'
));
?>

<?php
// You should import Sanitize
App::uses('Sanitize', 'Utility');

//debug($comments);exit;
foreach ($comments as $comment) {
//debug($comment);exit;
    $commentTime = strtotime($comment['Comment']['created']);

    $commentLink = array(
        'controller' => 'comments',
        'action' => 'view',
        //'year' => date('Y', $commentTime),
        //'month' => date('m', $commentTime),
        //'day' => date('d', $commentTime)
        $comment['Comment']['id']
    );
    

    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = preg_replace('=\(.*?\)=is', '', $comment['Comment']['body']);
    $bodyText = $this->Text->stripLinks($bodyText);
    $bodyText = Sanitize::stripAll($bodyText);
    $bodyText = $this->Text->truncate($bodyText, 400, array(
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    ));    

    echo  $this->Rss->item(array(), array(
        'name' => $comment['Comment']['name'],
        'link' => $commentLink,
        'guid' => array('url' => $commentLink, 'isPermaLink' => 'true'),
        'description' => $bodyText,
        'pubDate' => $comment['Comment']['created']
    ));
}
