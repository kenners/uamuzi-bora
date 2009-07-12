<?php
class ResultLookupsController extends AppController {

	var $name = 'ResultLookups';
	var $helpers = array('Html', 'Form');
  var $uses=array('ResultLookup','ArchiveResultLookup');

	function index() {
		$this->ResultLookup->recursive = 0;
		$this->set('resultLookups', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ResultLookup.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('resultLookup', $this->ResultLookup->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ResultLookup->create();
			if ($this->ResultLookup->save($this->data)) {
				$this->Session->setFlash(__('The ResultLookup has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ResultLookup could not be saved. Please, try again.', true));
			}
		}
		$tests = $this->ResultLookup->Test->find('list');
		$this->set(compact('tests'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ResultLookup', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
		  parent::archive($id);
			if ($this->ResultLookup->save($this->data)) {
				$this->Session->setFlash(__('The ResultLookup has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ResultLookup could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ResultLookup->read(null, $id);
		}
		$tests = $this->ResultLookup->Test->find('list');
		$this->set(compact('tests'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ResultLookup', true));
			$this->redirect(array('action'=>'index'));
		}
		parent::archive($id);
		if ($this->ResultLookup->del($id)) {
			$this->Session->setFlash(__('ResultLookup deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>