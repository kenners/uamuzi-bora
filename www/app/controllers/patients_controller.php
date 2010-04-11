<?php
class PatientsController extends AppController
{
	var $name = 'Patients';
	
	// Stuff to make javascript work
	var $helpers = array('Html', 'Javascript', 'Ajax', 'Crumb');
	
	// Setting the limit for paginator
	var $paginate = array(
			'limit' => 25
			);
	
	/**
	 * Tell the controller about the lookup table models
	 */
	var $uses = array(
		'Patient',
		'Occupation',
		'Education',
		'MaritalStatus',
		'Location',
		'MedicalInformation',
		'ArchivePatient',
		'InactiveReason',
		'VfTestingSite',
		'Result'
	);
	
	/**
	 * Debugging list all patients function
	 * PLEASE REPLACE WITH SOMETHING PRETTIER
	 */
	function index()
	{
		$this->Patient->recursive = 0;
		$this->set('patients', $this->paginate());
	}
	
	function search()
	{
		//$this->Patient->recursive = 0;
		//$this->set('patients', $this->paginate());
		$this->paginate();
		$paginate = array('recursive' => -1);
		if (!empty($this->data)) {
			$active_key = 'status';
			$location_key = 'Patient.location_id';
			
			// extract data from form
			$search_key_1 = array_pop(Set::extract('/Patient/search_key_1', $this->data));
			$search_value_1 = array_pop(Set::extract('/Patient/search_value_1', $this->data));
			$active = array_pop(Set::extract('/Patient/status', $this->data));
			
			
			$search_key_1 = $search_key_1 . ' ~~*';
			$search_value_1 = " '%" . $search_value_1 . "%'";
			// fix active value
			if (strcmp($active, '2') == 0) {
				$active = false;
			} else if (strcmp($active, '1') == 0) {
				$active = true;
			} else if ($active == null) {
				$active = array(true, false);
			}
			
				 
			
			// Check how many $search_keys we have, and the call with 1,2 or 3 conditions
					// Add results with just one of the conditions to the bottom
				$result = $this->paginate('Patient', array(
					'Patient.' . $search_key_1.$search_value_1,
					$active_key   => $active));
				$this->set('patients', $result);
				
				if(count($result) == 0) {
					$this->Session->setFlash('Cannot find patients');
				}
			
		}
		//$this->paginate('Patient');
	}
	
	/**
	 * Populate the Patient model with data for a new patient
	 */
	function add()
	{
		
		// What to do if we have been sent data (i.e. the form has been filled
		// out)
		if (!empty($this->data)) {
			// Generate a new PID
			$this->data['Patient']['pid'] = $this->Patient->newPID();
			
			// Make the input how the database is expecting it
			$this->data = $this->__prettyInput($this->data);
			// Save the new row
			if ($this->Patient->save($this->data)) {
//				$this->Session->setFlash('<strong>' . Inflector::humanize($this->data['Patient']['forenames']) . ' ' . Inflector::humanize($this->data['Patient']['surname']) . '</strong>'
//					. ' has been added with Patient ID '
//					. '<strong>' . chunk_split(str_pad($this->data['Patient']['pid'], 9, '0', STR_PAD_LEFT), 3, ' ') . '</strong>', 'default', array('class' => 'success large text-centre'));
				$this->redirect('/medical_informations/add/' . $this->data['Patient']['pid']);
			} else {
				$this->Session->setFlash('Please try again');
//				$this->redirect(array('controller' => 'patients', 'action' => 'add'));
			}
		}
		
		// Pass information to the view
		$this->set(array(
			'occupations'      => $this->Occupation->find('list'),
			'educations'       => $this->Education->find('list'),
			'marital_statuses' => $this->MaritalStatus->find('list'),
			'locations'        => $this->Location->generatetreelist(null, null, null, '-'),
			'vf_testing_sites' => $this->VfTestingSite->find('list', array('fields' => array('VfTestingSite.site_code', 'VfTestingSite.site_name')))
		));
	}
	
	/**
	 * Skeleton view method
	 * PLEASE BUILD/REPLACE AS NEEDED
	 */
	function view($pid = null)
	{
		if (!$pid || !$this->Patient->isValidPID($pid) || !$this->Patient->valueExists($pid, 'Patient', 'pid')) {
			$this->Session->setFlash(__('Invalid Patient.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		// Check that there is a corresponding row in the MedicalInformation
		// model.  If there isn't, Something Bad has happened; silently
		// create it.
		if (!$this->MedicalInformation->valueExists($pid, 'MedicalInformation', 'pid')) {
			$this->MedicalInformation->save(array('MedicalInformation' => array('pid' => $pid)));
		}
		
		$tests=$this->Patient->Result->Test->find('all', array('recursive' => -1, 'conditions' => array('active' => true)));
		//set all test info to build adding form
		$batchOfTestInfo=array();
		foreach(array_keys($tests) as $test) {
			// Setup a temporary array for this loop
			$testInfo = array();
			// Set the Test ID
			$testInfo['test_id'] = $test;
			// Find out the Test type
			
			$t = $this->Patient->Result->Test->find('first',array('conditions'=>array('Test.id'=>$test),'recursive'=>-1));
			$testInfo['name']=$t['Test']['name'];	
			$testInfo['type']=$t['Test']['type'];
			$testInfo['multival']=$t['Test']['multival'];
			$testInfo['units']=$t['Test']['units'];
			$testInfo['abbreviation']=$t['Test']['abbreiviation'];
										
			// Get Test answers/options if required
			if($testInfo['type'] == 'lookup') {
				$opt=$this->Patient->Result->ResultValue->ResultLookup->find('all',array('conditions'=>array('Test.id'=>$test),'recursive'=>0));
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

		$this->set('tests',$batchOfTestInfo);


		//Find all the results, and put them into format of array(date=>results_for_that_date)
		$results=$this->Patient->Result->find('all',array('conditions'=>array('Result.pid'=>$pid),'contain'=>array('ResultValue'),'order'=>array('Result.test_performed'=>'desc')));
		$this->set('lookup',$this->Patient->Result->ResultValue->ResultLookup->find('all',array('recursive'=>-1)));

		$result_dates=array();
		foreach($results as $result)
		{
			$date=$result['Result']['test_performed'];
		
			$result_dates[$date][$result['Result']['test_id']]=$result['ResultValue'];
		}
		$this->set('results',$result_dates);
		// Super-duper containable to the rescue of database recursion hell!
		$this->set('patients', $this->Patient->find('all', array(
			'conditions' => array('Patient.pid' => $pid),
			'contain' => array(
				'Education',
				'MaritalStatus',
				'Location',
				'InactiveReason',
				'VfTestingSite',
				'Result' => array(
					'Test',
					'ResultValue'=> array('ResultLookup'),
					'User'  => array('fields' => 'username'),
					'order' => 'id ASC'
				)
			)
		)));
		$this->set('medical_informations', $this->paginate('MedicalInformation', array('MedicalInformation.pid' => $pid)));
	}
	
	function attendance()
	{
		$results = $this->Patient->Result->find('all', array(
			'fields' => array('Result.pid'),
			'conditions' => array(
				'Result.test_id'   => 1,
				'Result.created >' => date('Y-m-d', strtotime('today'))
			)
		));
		$pids = array();
		foreach ($results as $result) {
			array_push($pids, array_pop(Set::extract('/Result/pid', $result)));
		}
		$patients=array();
		foreach($pids as $pid){
			$patients[]=$this->Patient->find('first',array(
				'conditions'=>array(
					'Patient.pid'=>$pid
				),
				'recursive'=>-1
			));
		}
		$attendence = array();
		foreach ($pids as $pid) {
			array_push($attendence, $this->Patient->Result->find('first', array(
				'order'=>'Result.created DESC',
				'conditions' => array(
					'Result.test_id' => 1,
					'Result.pid'     => $pid
				),
				'recursive'=>-1
			)));
		}
		$values=array();
		foreach ($attendence as $id){
			$values[]=$this->Patient->Result->ResultValue->find('first',array(
				'conditions'=>array(
					'ResultValue.result_id'=>$id['Result']['id']
					),
				'recursive'=>0
				
				));
			}
		$this->set('patients',$patients);
		$this->set('values', $values);
		$this->set('tests', $this->Patient->Result->Test->find('all', array(
			'recursive'  => -1,
			'conditions' => array('active' => true)
		)));
		if (!empty($pids)) {
			$this->set('patients', $this->paginate('Patient', array('Patient.pid' => $pids)));
		} else {
			$this->paginate();
			$this->set('patients', null);
		}
	}
	
	/**
	 * Edit a row in the `patients' table
	 */
	function edit($pid = NULL)
	{
		// Check PID is good
		if (empty($pid) || !$this->Patient->isValidPID($pid) || !$this->Patient->valueExists($pid, 'Patient', 'pid')) {
			$this->redirect(array('controller' => 'patients', 'action' => 'index'));
		}
		
		if (isset($this->data)) {
		// What to do if we've submitted new data (i.e. the edit form has been
		// submitted)
			
			// Don't mess with $this->data in case validation fails
			$data = $this->data;
			
			// The input needs a bit of fiddling to rearrange things to how the
			// the database table is expecting them to be
			$data = $this->__prettyInput($data);
			
			// Update the row
			parent::archive($pid);
			if ($this->Patient->save($data)) {
				$this->Session->setFlash('Record Updated');
				$this->redirect('/patients/view/' . $this->data['Patient']['pid']);
			}
		}
		
		// We need to display the form
		if (!isset($this->data)) {
			$this->data = $this->Patient->findByPid($pid);
		}
		$this->set(array(
			'fullname'         => $this->Patient->field('forenames', array('pid' => $pid)) . ' ' . $this->Patient->field('surname', array('pid' => $pid)),
			'occupations'      => $this->Occupation->find('list'),
			'educations'       => $this->Education->find('list'),
			'marital_statuses' => $this->MaritalStatus->find('list'),
			'locations'        => $this->Location->generatetreelist(null, null, null, '-'),
			'vf_testing_sites' => $this->VfTestingSite->find('list', array('fields' => array('VfTestingSite.site_code', 'VfTestingSite.site_name')))
		));
	}
	
	/**
	 * If the status of the row with PID $pid is FALSE (i.e. the patient is
	 * inactive) then toggle to active (with appropriate auditing) and redirect
	 * to the referring page.  Otherwise, show a form for InactiveReason which, 
	 * when submitted and written to database, redirects to the original
	 * referer.
	 */
	function toggleStatus($pid = NULL)
	{
		// Check $pid is valid
		if (!$pid || !$this->Patient->isValidPID($pid) || !$this->Patient->valueExists($pid, 'Patient', 'pid')) {
			$this->redirect(array('action' => 'index'));
		}
		$this->Patient->id = $pid;
		
		if ($this->Patient->field('status')) {
		// `status' is currently TRUE, so we either need to display the form to
		// choose an inactive reason, or receive the submission of said form
			if (isset($this->data)) {
				// Archive the current row
				parent::archive($pid);
				
				// Perform the toggle
				$data['Patient']['pid'] = $pid;
				$data['Patient']['status'] = FALSE;
				$data['Patient']['inactive_reason_id'] = $this->data['Patient']['inactive_reason_id'];
				$data['Patient']['status_timestamp'] = date('c');
				$this->Patient->save($data);
				
				// Redirect back to where you came from
				$this->redirect($this->data['Patient']['referer']);
			} else {
				$this->set(array(
					'pid'              => $pid,
					'referer'          => $this->referer(),
					'inactive_reasons' => $this->InactiveReason->find('list')
				));
			}
		} else {
		// `status' is currently FALSE, so toggle it to true
			// Archive the current row
			parent::archive($pid);
			
			// Perform the toggle
			$data['Patient']['pid'] = $pid;
			$data['Patient']['status'] = TRUE;
			$data['Patient']['inactive_reason_id'] = NULL;
			$data['Patient']['status_timestamp'] = date('c');
			$this->Patient->save($data);
			
			// Redirect back to where you came from
			$this->redirect($this->referer());
		}
	}
	
	/**
	 * This takes $this->data that gets submitted to the controller via the
	 * add and edit actions, and performs some cosmetic changes that are
	 * common to both actions (so that everything is how PostgreSQL expects it)
	 */
	private function __prettyInput($data)
	{
		// Humanize (i.e. capitalise) the patients name
		if (!empty($data['Patient']['forenames'])) {
			$data['Patient']['forenames'] = Inflector::humanize($data['Patient']['forenames']);
		}
		if (!empty($data['Patient']['surname'])) {
			$data['Patient']['surname'] = Inflector::humanize($data['Patient']['surname']);
		}		
		
		// Get year_of_birth from date_of_birth
		if (!empty($data['Patient']['date_of_birth']['year'])) {
			$data['Patient']['year_of_birth'] = $data['Patient']['date_of_birth']['year'];
		} else {
			$data['Patient']['year_of_birth'] = NULL;
		}
		
		// Generate an ISO 8601 input for date_of_birth
		if (!empty($data['Patient']['date_of_birth']['day']) && !empty($data['Patient']['date_of_birth']['month']) && !empty($data['Patient']['date_of_birth']['year'])) {
			$data['Patient']['date_of_birth'] = $data['Patient']['date_of_birth']['year'] . '-'
											  . $data['Patient']['date_of_birth']['month'] . '-'
											  . $data['Patient']['date_of_birth']['day'];
		} else {
			$data['Patient']['date_of_birth'] = NULL;
		}
		
		// Normalise sex to Male, Female or NULL
		switch (trim(strtolower($data['Patient']['sex']))) {
			case 'm':
			case 'male':
				$data['Patient']['sex'] = 'Male';
				break;
			case 'f':
			case 'female':
				$data['Patient']['sex'] = 'Female';
				break;
			default:
				$data['Patient']['sex'] =  NULL;
		}
		
		// Remove all non-digit characters from telephone_number
		$data['Patient']['telephone_number'] = preg_replace('/[^\d]/', '', $data['Patient']['telephone_number']);
		
		// For some fields, when an empty string is submitted we want it to be NULL
		foreach (array('upn', 'arvid', 'vfcc', 'mother', 'telephone_number', 'village', 'home', 'nearest_church', 'nearest_school', 'nearest_health_centre', 'nearest_major_landmark', 'vf_testing_site') as $field) {
			if ($data['Patient'][$field] == '') {
				$data['Patient'][$field] = NULL;
			}
		}
		
		// Set $this->data['Patient']['treatment_supporter'], which is either
		// a serialised array or NULL
		$TSNull = TRUE;
		foreach (array('name', 'address', 'relationship', 'telephone') as $TSField) {
			if (!empty($data['Patient']['treatment_supporter_' . $TSField])) {
				$TSArray[$TSField] = $data['Patient']['treatment_supporter_' . $TSField];
				$TSNull = FALSE;
			} else {
				$TSArray[$TSField] = ' ';
			}
		}	
		if (!$TSNull) {
			$data['Patient']['treatment_supporter'] = serialize($TSArray);
		} else {
			$data['Patient']['treatment_supporter'] = NULL;
		}
		
		return $data;
	}
}
?>
