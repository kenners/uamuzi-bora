<?php
class ResultLookupsController extends AppController {

	var $name = 'ResultLookups';
	var $helpers = array('Html', 'Form','Crumb');
	var $uses=array('ResultLookup','ArchiveResultLookup', 'User');
	
	function index() {
	  $this->redirect(array('controller'=>'tests','action'=>'index'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ResultLookup.', true));
			$this->redirect(array('action'=>'index'));
		}
		$resultLookup=$this->ResultLookup->find('first',array('conditions'=>array('ResultLookup.id'=>$id),'recursive'=>1));
		$this->set('resultLookup', $resultLookup);
		
	}

  function add($test_id=null) {
    if($test_id==null)
      {
	$this->Session->setFlash('You have to specify a test to add a result option to');
	$this->redirect($this->referer());
      }
    $this->ResultLookup->Test->id=$test_id;
    $this->set('test_id',$test_id);
    $test=$this->ResultLookup->Test->read(null,$test_id);
    $type=Set::extract('/Test/type',$test);
    if (!empty($this->data))
      {
	$test_id=array_pop(Set::extract('/ResultLookup/test_id',$this->data));
	$this->set('test_id',$test_id);
	$test=$this->ResultLookup->Test->read(null,$test_id);
	$type=array_pop(Set::extract('/Test/type',$test));
      if($this->ResultLookup->Test->exists())
	{
	      
	      
	  if(strcmp($type,'lookup')==0) {
		
	    $this->ResultLookup->create();
	    //Insert the user-id from session and test_id from the url
	    $this->data=Set::insert($this->data,'ResultLookup.user_id',$this->Auth->user('id'));
	    
	    if ($this->ResultLookup->save($this->data)) {
	      $this->Session->setFlash(__('The ResultLookup has been saved', true));
	      $this->redirect(array('controller'=>'tests','action'=>'view/'.$test_id));//redirec to tests/index
	    } else {
	      $this->Session->setFlash(__('The ResultLookup could not be saved. Please, try again.', true));
	    }
	  }else {
	    $this->Session->setFlash('You have tried to add an option to a test that shall not have options');
	  }
	}else{
	  $this->Session->setFlash("The test you try to add options too don't exist");
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
		  $this->data=Set::insert($this->data,'ResultLookup.user_id',$this->Auth->user('id'));
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