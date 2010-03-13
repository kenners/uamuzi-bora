<?php
class ResultValuesController extends AppController {

	var $name = 'ResultValues';
	var $helpers = array('Html', 'Form');
	var $uses = array('ResultValue','Result','ResultLookup','ArchiveResultValue','User','Patient');

	function index() {
		$this->ResultValue->recursive = 0;
		$this->set('resultValues', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ResultValue.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('resultValue', $this->ResultValue->find('all', array(
			'conditions' => array('ResultValue.id' => $id),
			'contain' => array(
				'ResultLookup',
				'Result' => array(
					'Test',
					'User'  => array('fields' => 'username'),
					'Patient'=> array('fields'=>array('forenames','surname'))
						)
			)
		)));
	}


	
	function add($pid = null)
	{
		$this->Result->Patient->id = $pid;
		$this->set('pid', $pid);
		
		if(!$this->ResultValue->Result->Patient->exists()) {
			$this->Session->setFlash('You tried to add a result to a Patient that does not exist');
			$this->redirect($this->referer());
		}
		
		// Check that we are dealing with data from a form, either from the miniform in the Patients::View view or
		// from an earlier submission of this controller's form.
		if (!empty($this->data)) {
			// But which form are we coming from?
			if (array_key_exists('ResultValue', $this->data)) {
			// So this method has been called by the view, with the new result form data having been submitted.
				// need to get the id of the result we are about to add
				$result_id=$this->ResultValue->Result->field('id',null,'id DESC')+1;
				// IN case we nedd to reload the form, we set the test_id and type
								

				//insert pid, user and test id
				$this->data = Set::insert($this->data, 'Result.user_id', $this->Auth->user('id'));
				$this->data = Set::insert($this->data, 'ResultValue.user_id', $this->Auth->user('id'));
				$this->data = Set::insert($this->data, 'ResultValue.result_id', $result_id);
				$this->data = Set::insert($this->data, 'Result.pid', $pid);
				// validate both inputs
				$this->ResultValue->set($this->data);
				$this->ResultValue->validates();
				$invalid=array($this->ResultValue->validationErrors);
				$this->ResultValue->Result->set($this->data);
				$this->ResultValue->Result->validates();
				$invalid[]=$this->ResultValue->Result->validationErrors;

				if (empty($invalid[0]) and empty($invalid[1])){
					//save
					$this->ResultValue->Result->save($this->data);
					$this->ResultValue->save($this->data);
					$this->Session->setFlash(__('The Result has been saved', true));
					$this->redirect(array('controller' => 'patients', 'action' => 'view/' . $pid));
				}else{
					$this->ResultValues->validationErrors=$invalid;
					$this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
					// Set up the form variables again for the reloaded view, as we've probably failed validation
					$test_id = $this->data['Result']['test_id'];
					$this->set('test_id', $test_id);
					$this->set('type', $this->Result->Test->find('first', array(
						'conditions' => array('Test.id' => $test_id),
						'recursive'  => -1
					)));
				}


									
	
			
			} else {
			// So we're coming from the miniform
				
				$test_id = $this->data['id'];
				$this->ResultValue->Result->Test->id = $test_id;
				
				// Let's check to see if the Test ID submitted via the miniform actually exists as a Test
				if ($this->ResultValue->Result->Test->exists()) {
					// Yes, it appears that the Test does exist
					$this->set('test_id', $test_id);
					
					// Let's find out what Type (decimal,lookup,text etc) of test it is
					$this->set('type', $this->ResultValue->Result->Test->find('first', array(
						'conditions' => array('Test.id' => $test_id),
						'recursive'  => -1
					)));
					
					// Get all the options :
					$this->set('options', $this->ResultValue->ResultLookup->find('all', array('conditions' => array('Test.id' => $test_id))));
					
					// Now get the data to send to the view to build the add results form
					$tests = $this->ResultValue->Result->Test->find('list');
					$patients = $this->ResultValue->Result->Patient->find('list');
					$users = $this->ResultValue->Result->User->find('list');
					$resultLookups = $this->ResultValue->ResultLookup->find('list');
					
					$this->set(compact('tests', 'patients', 'users', 'resultLookups'));
				} else {
					// Nope, the Test ID is not valid.
					$this->Session->setFlash('Not a valid test');
					// Go back to whence ye came...
					$this->redirect($this->referer());
				}
			}
		} else {
			$this->redirect('/');
		}
	}




	function edit($id = null)
	{
		debug($id);
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Result', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if (!empty($this->data)) {
			parent::archive($id);
			$pid = array_pop(Set::extract($this->data, '/Result/pid'));
			$this->data = Set::insert($this->data, 'Result.user_id', $this->Auth->user('id'));
			$this->Session->setFlash(__('The Result has been saved', true));
			$this->redirect('/patients/view/' . $pid);
			} /*else {
				$this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
				$this->set('pid', $pid);
			}
		*/
		
		if (empty($this->data)) {
			$this->data = $this->Result->read(null, $id);
			$pid = array_pop(Set::extract($this->data, '/Result/pid'));
			$this->set('pid', $pid);
		}
		
		$this->set('resultValue_id', $id);
		$tests = $this->ResultValue->Result->Test->find('list');
		$type = $this->ResultValue->find('all',array('conditions'=>array('ResultValue.id'=>$id)));//,array('conditions'=>array('ResultValue.id'=>$id)));
		debug($type);
		$test_id = array_pop(Set::extract('ResultValue/Result/test_id', $type));
		$this->set('type', $type);
		$this->set(compact('tests'));
		$this->set('test_id',$test_id);
		// Get all the options :
		$this->set('options', $this->ResultValue->ResultLookup->find('all', array('conditions' => array('Test.id' => $test_id))));
	}
	






	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ResultValue', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ResultValue->del($id)) {
			$this->Session->setFlash(__('ResultValue deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
