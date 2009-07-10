<?php
class ResultsController extends AppController {

	var $name = 'Results';
	var $helpers = array('Html', 'Form');
  var $uses=array('Result','ArchiveResult');
	function index() {
		$this->Result->recursive = 0;
		$this->set('results', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Result.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('result', $this->Result->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Result->create();
			if ($this->Result->save($this->data)) {
				$this->Session->setFlash(__('The Result has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
			}
		}
		$tests = $this->Result->Test->find('list');
		$this->set(compact('tests'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Result', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
		  parent::archive($id);
			if ($this->Result->save($this->data)) {
				$this->Session->setFlash(__('The Result has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Result->read(null, $id);
		}
		$tests = $this->Result->Test->find('list');
		$this->set(compact('tests'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Result', true));
			$this->redirect(array('action'=>'index'));
		}
		parent::archive($id);
		if ($this->Result->del($id)) {
			$this->Session->setFlash(__('Result deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>