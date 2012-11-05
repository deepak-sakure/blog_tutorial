<?php
class TagsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
        $this->set('tags', $this->Tag->find('all'));        
    }

    public function view($id = null) {
        $this->Tag->id = $id;
        if(!$this->Tag->exists()) {
            throw new NotFoundEXception(__('Invalid Id'));
        }
        $this->set('tag', $this->Tag->read());
    } 	

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash('Your tag has been saved.');
                $this->redirect(array('action' => 'index'));
            } else { 
                //debug($this->Post->validationErrors);
                $this->Session->setFlash('Unable to add your tag.');
            }
        }
    }

    public function edit($id = null) {
        $this->Tag->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Tag->read();
        } else {
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash('Your tag has been updated.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update your tag.');
            }
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')){
            throw new MethodNotAllowedException();
        }
        $this->Tag->id = $id;
        if (!$this->Tag->exists()) {
            throw new MethodNotAllowedException(__('Invalid Tag'));
        }        
        if ($this->Tag->delete($id)) {
            $this->Session->setFlash('The tag with id: '.$id.' has been deleted');
            $this->redirect(array('action' => 'index'));
        } 
    }

}
?>
