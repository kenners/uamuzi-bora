<?php
class ResultsController extends AppController
{

	var $name = 'Results';
	var $helpers = array('Html', 'Form', 'Crumb');
	var $uses = array('Result', 'ArchiveResult', 'User');
	
	/**
	 * index() doesn't make sense from a UI perspective, so just redirect to /
	 */
	function index()
	{
		$this->redirect('/');
	}
	
	function view($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid Result.', true));
			$this->redirect(array('action' => 'index'));
		}
		$result = $this->Result->find('first', array(
			'conditions' => array('Result.id' => $id),
			'recursive'  => 1
		));
		$this->set('result', $result);
	}
	
	function add($pid = null)
	{
		$this->Result->Patient->id = $pid;
		$this->set('pid', $pid);
		if(!$this->Result->Patient->exists()) {
			$this->Session->setFlash('You tried to add a result to a Patient that does not exist');
			$this->redirect($this->referer());
		}
		
		// Check that we are dealing with data from a form, either from the miniform in the Patients::View view or
		// from an earlier submission of this controller's form.
		if (!empty($this->data)) {
			// But which form are we coming from?
			if (array_key_exists('Result', $this->data)) {
			// So this method has been called by the view, with the new result form data having been submitted.
				
				// Let's save it.
				$this->Result->create();
				
				// IN case we nedd to reload the form, we set the test_id and type
				$test_id = Set::extract('\Result\test_id', $this->data);
				
				// Let's find out what Type (decimal,lookup,text etc) of test it is
				$this->set('type', $this->Result->Test->find('first', array(
					'conditions' => array('Test.id' => $test_id),
					'recursive'  => -1
				)));
				
				$this->data = Set::insert($this->data, 'Result.user_id', $this->Auth->user('id'));
				$this->data = Set::insert($this->data, 'Result.pid', $pid);
				
				if ($this->Result->save($this->data)) {
					$this->Session->setFlash(__('The Result has been saved', true));
					$this->redirect(array('controller' => 'patients', 'action' => 'view/' . $pid));
				} else {
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
				$this->Result->Test->id = $test_id;
				
				// Let's check to see if the Test ID submitted via the miniform actually exists as a Test
				if ($this->Result->Test->exists()) {
					// Yes, it appears that the Test does exist
					$this->set('test_id', $test_id);
					
					// Let's find out what Type (decimal,lookup,text etc) of test it is
					$this->set('type', $this->Result->Test->find('first', array(
						'conditions' => array('Test.id' => $test_id),
						'recursive'  => -1
					)));
					
					// Get all the options :
					$this->set('options', $this->Result->ResultLookup->find('all', array('conditions' => array('Test.id' => $test_id))));
					
					// Now get the data to send to the view to build the add results form
					$tests = $this->Result->Test->find('list');
					$patients = $this->Result->Patient->find('list');
					$users = $this->Result->User->find('list');
					$resultLookups = $this->Result->ResultLookup->find('list');
					
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
	
	function batch_add($pid){ 
		$this->Result->Patient->id = $pid;
		$this->set('pid', $pid);
		if(!$this->Result->Patient->exists()) {
			$this->Session->setFlash('You tried to add results to a Patient that does not exist');
			$this->redirect($this->referer());
		}
		$batchOfTestIDs = array(2,3,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);

		// Is this a new form i.e. is there data in our object?
		if (empty($this->data)) {
			// Loop to pull the relevent info for each of our tests and put them in an array	
			$batchOfTestInfo = array();
			foreach($batchOfTestIDs as $test) {
				// Setup a temporary array for this loop
				$testInfo = array();
				// Set the Test ID
				$testInfo['test_id'] = $test;
				// Find out the Test type
				
				$t = $this->Result->Test->find('first',array('conditions'=>array('Test.id'=>$test),'recursive'=>-1));
				$testInfo['name']=$t['Test']['name'];	
				$testInfo['type']=$t['Test']['type'];
				
										
				// Get Test answers/options if required
				if($testInfo['type'] == 'lookup') {
					$opt=$this->Result->ResultLookup->find('all',array('conditions'=>array('Test.id'=>$test),'recursive'=>0));
					$options=array();
					foreach($opt as $o){
						$value=$o['ResultLookup']['value'];
						$id=$o['ResultLookup']['id'];
						$desc=$o['ResultLookup']['description'];
						$r=array_keys($o);
						$options[]=array('id'=>$id,'value'=>$value,'description'=>$desc);
					}
					$testInfo['options']=$options;				
				}
				// Add this temp array onto the main array we're building
				$batchOfTestInfo[] = $testInfo;
				unset($testInfo);
			}
			// Make our fresh array of test info available to the view
			$this->set('batchOfTests', $batchOfTestInfo);
			$this->set('pid', $this->Result->Patient->id=$pid);
		}else {
			//debug($this->data);
			$tests=array();
			$data=$this->data;
			//Create an array with testid and type
			foreach($batchOfTestIDs as $test) {
				$t = $this->Result->Test->find('first',array('conditions'=>array('Test.id'=>$test),'recursive'=>-1));
				$tests[$test]=$t['Test']['type'];
			}
			//get dates and Requesting Clinician
			$date=array();
			$date[]=$data['Result'][0];
			$date[]=$data['Result'][1];
			$date[]=$data['Result'][2];
			$date[]=$data['Result'][3];
			$date[]=$data['Result'][4];
			unset($data['Result'][0]);
			unset($data['Result'][1]);
			unset($data['Result'][2]);
			unset($data['Result'][3]);
			unset($data['Result'][4]);
			$clin=$data['Result']['requesting_clinician'];
			unset($data['Result']['requesting_clinician']);
			
			// loop through all the results and add any fields that have been filled out
			$counter=5;
			foreach($data['Result'] as $result){
				//debug($result);
				if($result['value']!='' and $result['value']!=0){
					$value=$result['value'];
					$test_id=$batchOfTestIDs[intval($counter/5) -1];
					$d=$date[$counter % 5];
					
					$to_add=array('Result'=>array(  'pid'=>$pid,
									'test_id'=>$test_id,
									'value_'.$tests[$test_id]=>$value,
									'test_performed'=>$d['test_performed'],
									'requesting_clinician'=>$clin,
									'user_id'=>$this->Auth->user('id')
									));
					$this->Result->create();
					if ($this->Result->save($to_add)) {
						} else {
						$this->Session->setFlash(__('The Results could not be saved. Please, try again.', true));
					}
				}
				$counter++;
			}	
			$this->Session->setFlash(__('The Results have been saved', true));
			$this->redirect(array('controller'=>'patients','action' => 'index'));			
		}


	}
	
	

	function edit($id = null)
	{
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
			} else {
				$this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
				$this->set('pid', $pid);
			}
		
		
		if (empty($this->data)) {
			$this->data = $this->Result->read(null, $id);
			$pid = array_pop(Set::extract($this->data, '/Result/pid'));
			$this->set('pid', $pid);
		}
		
		$this->set('result_id', $id);
		$tests = $this->Result->Test->find('list');
		$type = $this->Result->find('first', array('conditions' => array('Result.id' => $id)));
		$test_id = array_pop(Set::extract('/Result/test_id', $type));
		$this->set('type', $type);
		$this->set(compact('tests'));
		// Get all the options :
		$this->set('options', $this->Result->ResultLookup->find('all', array('conditions' => array('Test.id' => $test_id))));
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Result', true));
			$this->redirect($this->referer());
		}
		parent::archive($id);
		if ($this->Result->del($id)) {
			$this->Session->setFlash(__('Result deleted', true));
			$this->redirect($this->referer());
		}
	}
	function add_attendance($pid = null)
	{
		$this->Result->Patient->id = $pid;
		$this->set('pid', $pid);
		if (!$this->Result->Patient->exists()) {
			$this->Session->setFlash('You tried to book in a patient that does not exist in this database.');
			$this->redirect($this->referer());
		}
		
		$data = array(
			'Result' => array(
				'pid'            => $pid,
				'test_id'        => 1,
				'user_id'        => $this->Auth->user('id'),
				'value_lookup'   => 1,
				'test_performed' => date('Y-m-d',strtotime('now'))
			)
		);
		$this->Result->create();
		if ($this->Result->save($data)) {
			$this->Session->setFlash(__('Patient booked in.', true));
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('This patient could now be booked in. Please, try again.', true));
		}  
	}
	
	function ad_attendence($pid = null)
	{
		$this->Result->Patient->id = $pid;
		$this->set('pid', $pid);
		if (!$this->Result->Patient->exists()) {
			$this->Session->setFlash('You tried to add attendence to a Patient that does not exist');
			$this->redirect($this->referer());
		}
		
		$data = array(
			'Result' => array(
				'pid'          => $pid,
				'test_id'      => 1,
				'user_id'      => $this->Auth->user('id'),
				'value_lookup' => 2
			)
		);
		$this->Result->create();
		if ($this->Result->save($data)) {
			$this->Session->setFlash(__('The Attendence has been saved', true));
			$this->redirect(array('controller' => 'patients', 'action' => 'search'));
		} else {
			$this->Session->setFlash(__('The Attendence could not be saved. Please, try again.', true));
		}  
	}
}
?>
