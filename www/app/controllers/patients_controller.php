<?php
class PatientsController extends AppController {
	var $name = 'Patients';
	// Stuff to make javascript work
	var $helpers = array('Html','Javascript','Ajax');
	/**
	 * Tell the controller about the lookup table models
	 */
	var $uses = array(
		'Patient',
		'Occupation',
		'Education',
		'MaritalStatus',
		'Location'
		);
	/**
	 * Debugging list all patients function
	 * PLEASE REPLACE WITH SOMETHING PRETTIER
	 */
	function index() {
		$this->Patient->recursive = 0;
		$this->set('patient', $this->paginate());
	}
	
	/**
	 * Populate the Patient model with data for a new patient
	 */
	function add() {
		// What to do if we have been sent data (i.e. the form has been filled
		// out)
		if (!empty($this->data)) {
			// Generate a new PID
			$this->data['Patient']['pid'] = $this->Patient->newPID();
			// Get year_of_birth from date_of_birth
			$this->data['Patient']['year_of_birth'] = $this->data['Patient']['date_of_birth']['year'];
			// Save the new row
			if ($this->Patient->save($this->data)) {
				// Send confirmation page (we'll want to create a row in the
				// MedicalInformation table here too)
				exit;
			}
		}
		
		// Pass information to the view
		$this->set(array(
			'occupations' => $this->Occupation->find('list'),
			'educations' => $this->Education->find('list'),
			'marital_statuses' => $this->MaritalStatus->find('list'),
			'locations' => $this->Location->generatetreelist()
			));
	}
	/**
	 * Skeleton view method
	 * PLEASE BUILD/REPLACE AS NEEDED
	 */
	function view($pid = null) {
		if (!$pid) {
			$this->Session->setFlash(__('Invalid Patient.', true));
			$this->redirect(array('action'=>'index'));
		}
		//$this->set('patient', $this->Patient->find('first',array('conditions'=>array('Patient.pid'=>$pid))));
		$this->set('patient',$this->Patient->read(null,$pid));
		$this->set('result',$this->Patient->Result->find('all',array('conditions'=>array('Result.pid'=>$pid),'order'=>'Result.created DESC','recursive'=>-1)));
		  
	}
}
?>
