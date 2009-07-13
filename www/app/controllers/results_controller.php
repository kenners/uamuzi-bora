<?php
class ResultsController extends AppController {

	var $name = 'Results';
	var $helpers = array('Html', 'Form', 'Crumb');
	var $uses=array('Result','ArchiveResult', 'User');
	
	function index() {
		$this->Result->recursive = 0;
		$this->set('results', $this->paginate());
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Result.', true));
			$this->redirect(array('action'=>'index'));
		}
		$result=$this->Result->find('first',array('conditions'=>array('Result.id'=>$id),'recursive'=>1));
		$this->set('result', $result);
	}

	function add($pid = null) {

	 
	  $this->Result->Patient->id=$pid;
	  $this->set('pid',$pid);
	  if(!$this->Result->Patient->exists()){
	    $this->Session->setFlash('You tried to add a result to a Patient that does not exist');
	    $this->redirect('/');
	  }
	  
	  if (!empty($this->data)) {
	  $test_id=Set::extract('\id',$this->data);
	  $this->Result->Test->id=$test_id;
	    if($test_id!=0)
	      {
		if($this->Result->Test->exists())
		  {
		    $this->set('test_id',$test_id);
		    $this->set('type',$this->Result->Test->find('first',array('conditions'=>array('Test.id'=>$test_id),'recursive'=>-1)));
		  }else{
		    $this->Session->setFlash('Not a valid test');
		  }
	      }else{

		$this->Result->create();
		$this->data=Set::insert($this->data,'Result.user_id',$this->Auth->user('id'));
		$this->data=Set::insert($this->data,'Result.pid',$pid);
			
			
		if ($this->Result->save($this->data)) {
		  $this->Session->setFlash(__('The Result has been saved', true));
		  $this->redirect(array('action'=>'index'));
		} else {
		  $this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
		}
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
			  $this->data=Set::insert($this->data,'Result.user_id',$this->Auth->user('id'));
			  
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