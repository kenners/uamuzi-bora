<?php
class TestsController extends AppController {

	var $name = 'Tests';
	var $helpers = array('Html', 'Form');
  var $uses= array('Test','ArchiveTest');

	function index() {
		$this->Test->recursive = 0;
		$this->set('tests', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Test.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('test', $this->Test->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Test->create();
			if ($this->Test->save($this->data)) {
				$this->Session->setFlash(__('The Test has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Test could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Test', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
		  parent::archive($id);
			if ($this->Test->save($this->data)) {
				$this->Session->setFlash(__('The Test has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Test could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Test->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Test', true));
			$this->redirect(array('action'=>'index'));
		}
		parent::archive($id);
		if ($this->Test->del($id)) {
			$this->Session->setFlash(__('Test deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>