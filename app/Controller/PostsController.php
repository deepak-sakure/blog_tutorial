<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session', 'Text', 'Rss');
    public $components = array('Session', 'RequestHandler');
    
    
    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('latest');
    }

    public function index() {
       $this->Post->Behaviors->attach('Containable');
        //debug(Controller::set('rss') );exit;
        if ($this->RequestHandler->isRss()) {    
            $posts = $this->Post->find('all', array('contain' => true, 'limit' => 5, 'order' => 'Post.created DESC'));
            return $this->set(compact('posts'));
        }
  
        //$this->Post->recursive = -1;       
        $this->paginate = array(
            'contain' => false,  //array('Tag.title = "tag2"', 'Comment.name = "deepak1"'),
            'order' => 'Post.created DESC',
            'limit' => 5
        );
        $posts = $this->paginate('Post');    
        $this->set(compact('posts'));
        //$this->set('posts', $this->Post->find('all'));        
    }
    
    public function view($id = null) {
        $this->Post->id = $id;
        if(!$this->Post->exists()){
            throw new NotFoundException(__('Invalid Id'));
        }
        $this->Post->Behaviors->attach('Containable');
        $this->Post->contain(array(
            'Image.filename', 
            'Tag' => array(
                'fields' => array('title')
            ), 
            'Comment'
        ));
        $post = $this->Post->read();
        //debug($post);
        $this->set(compact('post'));        
        $this->set('filename', $post['Image']['filename']);
        if(!empty($post['Tag'])){
            foreach($post['Tag'] as $tag){
                $tags[] = $tag['title'];
            }
            $this->set('tags', implode(', ', $tags));
        }else{
            $this->set('tags', '');
        }
        /*$this->set('comments', $this->Post->Comment->find('all', array(
            'Comment.post_id' => $this->Post->id)));*/
      
        $this->Post->Comment->validationErrors = $this->Session->read('ValidationErrors');
        $this->Session->delete('ValidationErrors');
        $this->set('postData', $this->Session->read('PostData'));
        $this->Session->delete('PostData');
    }
    
    public function slug_view($slug = null) {
    //debug($this->request->params);exit;
        //$this->Post->id = $id;
        //$this->set('post', $this->Post->read());
        $this->set('post', $this->Post->findBySlug($slug));
        $post = $this->Post->read();
        $this->set('filename', $post['Image']['filename']);
        if(!empty($post['Tag'])){
            $tags = Set::extract('/Tag/title',$post);
            $this->set('tags', implode(', ', $tags));            
        }else{
            $this->set('tags', '');
        }        
        
        $this->Post->Comment->validationErrors = $this->Session->read('ValidationErrors');
        $this->Session->delete('ValidationErrors');
        $this->set('postData', $this->Session->read('PostData'));
        $this->Session->delete('PostData');
    }
     	

    public function add() {
        //$this->set('tags', $this->Post->Tag->find('list'));

        if ($this->request->is('post')) {
            $this->Post->Behaviors->load('Slug', array(
                'length' => 255,
                'slug' => 'slug',
                'separator' => '',
                'label' => array('title')                    
            ));    
        
            if($this->request->data['Post']['filename']['error'] == 0){ 
                $this->Post->Behaviors->load('ImageUpload', array(
                    'dirFormat' => 'pictures',
                    'fileField' => 'filename'
                ));
                $this->request->data['Image']['filename'] = $this->request->data['Post']['filename']['name'];   
            } 
            //print_r($this->request->data['Post']);exit;            
            
            $this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Added this line
            
            if ($this->Post->saveAssociated($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else { 
                //debug($this->Post->validationErrors);
                $this->Session->setFlash('Unable to add your post.');
            }
            $this->Post->Behaviors->unload('ImageUpload');
            $this->Post->Behaviors->unload('Slug');
        }
    }

    public function edit($id = null) {
        if ($this->request->is('post')){
            $this->Post->Behaviors->load('Slug', array(
                'length' => 255,
                'slug' => 'slug',
                'separator' => '',
                'overwrite' => true,
                'label' => array('title')                    
            ));    
            
            if($this->request->data['Post']['filename']['error'] == 0){ 
                $this->Post->Behaviors->load('ImageUpload', array(
                    'dirFormat' => 'pictures',
                    'fileField' => 'filename'
                ));
                $this->request->data['Image']['filename'] = $this->request->data['Post']['filename']['name'];   
            } 
            if ($this->Post->saveAssociated($this->request->data)) {
                $this->Session->setFlash('Your post has been updated.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
            $this->Post->Behaviors->unload('ImageUpload');
            $this->Post->Behaviors->unload('Slug');
        }else{
            //debug($this->request->data);    
            $this->Post->id = $id;
            //$this->set('tags', $this->Post->Tag->find('list'));
            $this->Post->Behaviors->attach('Containable');
            $this->Post->contain(array('Tag.title','Image' => array(
                'fields' => array('id', 'filename')
            )));
            $this->request->data = $this->Post->read();
            $this->request->data['Post']['filename1'] = $this->request->data['Image']['filename'];
            
            if(!empty($this->request->data['Tag'])){
                /*foreach($this->request->data['Tag'] as $tag){
                    $tags[] = $tag['title'];
                }*/
                $tags = Set::extract('/Tag/title', $this->request->data);
                $this->request->data['Post']['tags'] = implode(', ', $tags);
            }else{
                $this->request->data['Post']['tags'] = '';                
            }
        }    
    }

    public function delete($id) {
        //$this->Post->Behaviors->unload('ImageUpload');
        if ($this->request->is('get')){
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The post with id: '.$id.' has been deleted');
            $this->redirect(array('action' => 'index'));
        } 
    }
    
    /* public function latest() {
        $xml = Xml::build('http://localhost/deepak/blog_tutorial/posts/index.rss', array('return' => 'simplexml'));
        return $xmlArray = Xml::toArray($xml);
        //debug($xmlArray);
        //$this->set('posts',$xmlArray); 
    }*/
}
?>
