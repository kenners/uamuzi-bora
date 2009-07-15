<?php
class TestsController extends AppController {

	var $name = 'Tests';
	var $helpers = array('Html', 'Form', 'Crumb');
	var $uses= array('Test','ArchiveTest','User');
	
	function index() {
	    	$this->Test->recursive = 0;
		$this->set('tests', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Test.', true));
			$this->redirect(array('action'=>'index'));
		}
		$test=$this->Test->find('first',array('conditions'=>array('Test.id'=>$id),'recursive'=>2));
		$this->set('test', $test);
		
	}

	function add() {
		if (!empty($this->data)) {
			$this->Test->create();
			//Insert the user_id from session
			$this->data=Set::insert($this->data,'Test.user_id',$this->Auth->user('id'));
			
			if ($this->Test->save($this->data)) {
			        $this->Session->setFlash(__('The Test has been saved', true));
				$type=Set::extract('/Test/type',$this->data);//get the test type
				$name=Set::extract('/Test/name',$this->data);//get the name
				//pull the id from the database
				$test_id=Set::extract('/Test/id',$this->Test->find('first',array('conditions'=>array('Test.name'=>$name),'recursive'=>-1)));
				//Fix arrays
				$type=$type[0];
				$test_id=$test_id[0];
				//If type=lookup redirect to add resultLookups
				if(strcmp($type,'lookup')==0)
				  {
				    $this->redirect(array('controller'=>'ResultLookups','action'=>'add/'.$test_id));
				  }
				else
				  {
				    $this->redirect(array('action'=>'index'));
				  }
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
		  $this->data=Set::insert($this->data,'Test.user_id',$this->Auth->user('id'));
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



}
?>