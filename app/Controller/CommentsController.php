<?php
class CommentsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session', 'Text', 'Rss');
    public $components = array('Session', 'RequestHandler');
    
    public function isAuthorized($user) {
        // The owner of a post can edit and delete posts comments
        if (in_array($this->action, array('edit', 'delete','publish'))) {
            $commentId = $this->request->params['pass'][0];
            //debug($this->request->params);exit;
            if ($this->Comment->isPostOwnedBy($commentId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add'); // Letting users register themselves
    }

    
    public function index() {        
        if ($this->RequestHandler->isRss() ) {
        //debug($this->RequestHandler);exit;
            $comments = $this->Comment->find('all', array('limit' => 5, 'conditions' => array('published' => '1'), 'order' => 'Comment.created DESC'));
            return $this->set(compact('comments'));
        }
        
        $this->paginate = array(
            //'conditions' => array('Comment.name LIKE' => 'd%'),
            'order' => 'Comment.created ASC',
            'limit' => 10
        );
        $comments = $this->paginate('Comment');
        $this->set(compact('comments'));

	    //$this->set('comments', $this->Comment->find('all'));        	
	}


    public function view($id = null) {
        $this->Comment->id = $id;
        $this->set('comment', $this->Comment->read());
    } 	
    

    public function add($id = null) {
        $this->set('posts', $this->Comment->Post->find('list'));
        if ($this->request->is('post')) {
            if ($this->Auth->user('id')) {
                $this->request->data['Comment']['name'] = $this->Auth->user('name');
                $this->request->data['Comment']['email'] = $this->Auth->user('email');
                $this->request->data['Comment']['url'] = $this->Auth->user('url');
            }
            
            $this->Comment->Post->id = $this->request->data['Comment']['post_id'];                        
            if (AuthComponent::user('id') == $this->Comment->Post->field('user_id')) {
                $this->request->data['Comment']['published'] = 1;
            }
                                    
            //print_r($this->request->data);exit;
	        if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('Your Comment has been saved.');
                //$this->redirect(array('action' => 'index'));
	            $this->redirect(array('controller' => 'posts','action' => 'view', $this->request->data['Comment']['post_id']));
            } else {                
                //debug($this->Comment->validation);exit;
                $this->Session->setFlash('Unable to add your comment.');
                $this->Session->write('ValidationErrors', $this->Comment->validationErrors);
                $this->Session->write('PostData', $this->request->data);  
                $this->redirect(array('controller' => 'posts','action' => 'view', $this->request->data['Comment']['post_id']));
            }
        }
    }

    public function edit($id = null) {
        $this->Comment->id = $id;
        if ($this->request->is('get')) {
            $this->set('posts', $this->Comment->Post->find('list'));
            $this->request->data = $this->Comment->read();            
        } else {
            $this->set('posts', $this->Comment->Post->find('list'));
            //$this->request->data['Comment']['post_id'] = $this->request->data['Comment']['post_id1'];
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('Your Comment has been updated.');
                //debug($this->request->data['Comment']);exit;
                return $this->redirect(array('controller' => 'posts','action' => 'view', $this->request->data['Comment']['post_id']));
            } else {
                $this->Session->setFlash('Unable to update your comment.');
            }
        }
    }
    
    public function publish($id = null, $post_id = null) {
        $this->Comment->id = $id;
        //debug($this->params->pass);exit;
        $this->request->data['Comment']['id'] = $this->params->pass[0];
        $this->request->data['Comment']['published'] = 1;
            
        if($this->Comment->save($this->request->data)) {
            $this->Session->setFlash('Your Comment has been published');
            return $this->redirect(array('controller' => 'posts', 'action' => 'view', $this->params->pass[1]));
        } else {
            $this->Session->setFlash('Unable to publish your comment');
            return $this->redirect(array('controller' => 'posts', 'action' => 'view', $this->params->pass[1]));
        }
    }

    public function delete($id = null, $post_id = null) {
        if ($this->request->is('get')){
            throw new MethodNotAllowedException();
        }
        if ($this->Comment->delete($id)) {
            $this->Session->setFlash('The comment with id: '.$id.' has been deleted');
            //$this->redirect(array('action' => 'index'));
  	        return $this->redirect(array('controller' => 'posts','action' => 'view', $post_id));
        } 
    }

}
?>
