<?php
class PatientsController extends AppController {
	var $name = 'Patients';
	// Stuff to make javascript work
	var $helpers = array('Html','Javascript','Ajax', 'Crumb');
	
	// Setting the limit for paginator
	var $paginate = array('limit' => 25);
	
	
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
		$this->set('patients', $this->paginate());
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
			
			// Generate an ISO 8601 input for date_of_birth
			if (!empty($this->data['Patient']['date_of_birth']['day']) && !empty($this->data['Patient']['date_of_birth']['month']) && !empty($this->data['Patient']['date_of_birth']['year'])) {
				$this->data['Patient']['date_of_birth'] = $this->data['Patient']['date_of_birth']['year'] . '-'
														. $this->data['Patient']['date_of_birth']['month'] . '-'
														. $this->data['Patient']['date_of_birth']['day'];
			} else {
				$this->data['Patient']['date_of_birth'] = NULL;
			}
			
			// Normalise sex to Male, Female or NULL
			switch (trim(strtolower($this->data['Patient']['sex']))) {
				case 'm':
				case 'male':
					$this->data['Patient']['sex'] = 'Male';
					break;
				case 'f':
				case 'female':
					$this->data['Patient']['sex'] = 'Female';
					break;
				default:
					$this->data['Patient']['sex'] =  NULL;
			}
			
			// Remove all non-digit characters from telephone_number
			$this->data['Patient']['telephone_number'] = preg_replace('/[^\d]/', '', $this->data['Patient']['telephone_number']);
			
			// For some fields, when an empty string is submitted we want it to be NULL
			foreach (array('upn', 'mother', 'telephone_number', 'village', 'home', 'nearest_church', 'nearest_school', 'nearest_health_centre', 'nearest_major_landmark') as $field) {
				if ($this->data['Patient'][$field] == '') {
					$this->data['Patient'][$field] = NULL;
				}
			}
			
			// Save the new row
			if ($this->Patient->save($this->data)) {
				// Send confirmation page (we'll want to create a row in the
				// MedicalInformation table here too)
				// PLEASE INSERT CODE HERE AS NEEDED
				exit;
			}
		}
		
		// Pass information to the view
		$this->set(array(
			'occupations' => $this->Occupation->find('list'),
			'educations' => $this->Education->find('list'),
			'marital_statuses' => $this->MaritalStatus->find('list'),
			'locations' => $this->Location->generatetreelist(null, null, null, '-')
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

		$this->Patient->recursive = 2;
		
		//$paginate=array('Result'=>array('order'=>'created DESC'));
		$this->set('patients',$this->paginate('Patient',array('Patient.pid'=>$pid)));
	
	}
}
?>
