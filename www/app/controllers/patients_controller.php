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
		'Location',
		'MedicalInformation'
		);
	/**
	 * Debugging list all patients function
	 * PLEASE REPLACE WITH SOMETHING PRETTIER
	 */
	function index() {
		$this->Patient->recursive = 0;
		$this->set('patients', $this->paginate());
	}

  function search(){
    $paginate=array('recursive'=>-1);
    $this->set(array('locations' => $this->Location->generatetreelist(null, null, null, '-')));
    if(!empty($this->data))
      {
	$active_key='status';
	$location_key='Patient.location_id';
	//extract data from form
	$search_key_1=array_pop(Set::extract('/Patient/search_key_1',$this->data));
	$search_value_1=array_pop(Set::extract('/Patient/search_value_1',$this->data));
	$search_key_2=array_pop(Set::extract('/Patient/search_key_2',$this->data));
	$search_value_2=array_pop(Set::extract('/Patient/search_value_2',$this->data));
	$search_key_3=array_pop(Set::extract('/Patient/search_key_3',$this->data));
	$search_value_3=array_pop(Set::extract('/Patient/search_value_3',$this->data));
	$active=array_pop(Set::extract('/Patient/status',$this->data));
	$location=array_pop(Set::extract('/Patient/location_id',$this->data));
       
      
	// If we have a test field want to use LIKE
	switch($search_key_1)
	  {
	  case 'surname':
	    $search_key_1=$search_key_1.' LIKE';
	    break;
	  case '.forenames':
	    $search_key_1=$search_key_1.' LIKE';
	    break;
	  case 'telephone_number':
	    $search_key_1=$search_key_1.' LIKE';
	    break;
	  case 'upn':
	    $search_key_1=$search_key_1.' LIKE';
	    break;
	  case 'arvid':
	    $search_key_1=$search_key_1.' LIKE';
	    break;
	  case 'vfcc':
	    $search_key_1=$search_key_1.' LIKE';
	    break;
	  }
	switch($search_key_2)
	  {
	  case 'surname':
	    $search_key_2=$search_key_2.' LIKE';
	    break;
	  case 'forenames':
	    $search_key_2=$search_key_2.' LIKE';
	    break;
	  case 'telephone_number':
	    $search_key_2=$search_key_2.' LIKE';
	    break;
	  case '.upn':
	    $search_key_2=$search_key_2.' LIKE';
	    break;
	  case 'arvid':
	    $search_key_2=$search_key_2.' LIKE';
	    break;
	  case 'vfcc':
	    $search_key_2=$search_key_2.' LIKE';
	    break;
	  }
	switch($search_key_3)
	  {
	  case 'surname':
	    $search_key_3=$search_key_3.' LIKE';
	    break;
	  case '.forenames':
	    $search_key_3=$search_key_3.' LIKE';
	    break;
	  case 'telephone_number':
	    $search_key_3=$search_key_3.' LIKE';
	    break;
	  case 'upn':
	    $search_key_3=$search_key_3.' LIKE';
	    break;
	  case 'arvid':
	    $search_key_3=$search_key_3.' LIKE';
	    break;
	  case 'vfcc':
	    $search_key_3=$search_key_3.' LIKE';
	    break;
	  }

       
	//fix active value
	if(strcmp($active,'2')==0){
	 
	  $active=false;
	}else if(strcmp($active,'1')==0){
	  $active=true;
	}
	else if($active==null){
	  $active=array(true,false);
	 
	}
	//Get all the sublocations so we can include alle of them
	$location_arr=$this->Patient->Location->children($location);
	$locations=array();
	foreach($location_arr as $loc){
	  array_push($locations,$loc['Location']['id']);
	}
       
	array_push($locations,$location);
	$result=array();
	//Check how many $search_keys we have, and the call with 1,2 or 3 conditions
	if($search_key_1!=null)
	  {
	    if($search_key_2 != null)
	      {
		if($search_key_3 != null)
		  {
		    $result=$this->paginate('Patient',array('Patient.'.$search_key_1=>$search_value_1,'Patient.'.$search_key_2=>$search_value_2,'Patient.'.$search_key_3=>$search_value_3,$active_key=>$active,$location_key=>$locations));
		 
		   		     
		  }else{
	       
		    $result=$this->paginate('Patient',array('Patient.'.$search_key_1=>$search_value_1,'Patient.'.$search_key_2=>$search_value_2,$active_key=>$active,$location_key=>$locations));
		   
		      
		  }
	      }
	    //Add results with just one of the conditions to the bottom
	    $result=parent::__combine_array($result,$this->paginate('Patient',array('Patient.'.$search_key_1=>$search_value_1,$active_key=>$active,$location_key=>$locations)));
		 
	 
	    //Want to add results where just one of the conditions was fullfilled
	    if($search_key_2 != null)
	      {
		   
		$result=parent::__combine_array($result,$this->paginate('Patient',array('Patient.'.$search_key_2=>$search_value_2,$active_key=>$active,$location_key=>$locations)));
		 
	       
	      }
	    if($search_key_3 != null)
	      {
		$result=parent::__combine_array($result,$this->paginate('Patient',array('Patient.'.$search_key_3=>$search_value_3,$active_key=>$active,$location_key=>$locations)));
	      }
	     	   
	    $this->set('patients',$result);
	    if(count($result)==0)
	      {
		$this->Session->setFlash('Couldn\'t find any patients fullfilling those conditions');
	      }
	    
	     
	  }else{
	    $this->Session->setFlash('You need to specify at least one search criteria');
	  }
	
      }
    $this->paginate('Patient');
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
			
			// Make the input how the database is expecting it
			$this->data = $this->__prettyInput($this->data);
			
			// Save the new row
			if ($this->Patient->save($this->data)) {
				$this->Session->setFlash('<strong>' . $this->data['Patient']['forenames'] . ' ' . $this->data['Patient']['surname'] . '</strong>'
					. ' has been added with Patient ID '
					. '<strong>' . chunk_split(str_pad($this->data['Patient']['pid'], 9, '0', STR_PAD_LEFT), 3, ' ') . '</strong>');
				$this->redirect('/medical_informations/add/' . $this->data['Patient']['pid']);
			} else {
				$this->Session->setFlash('There was a problem adding this patient.  Please try again');
				$this->redirect(array('controller' => 'Patient', 'action' => 'add'));
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

		$this->Patient->recursive = 2;

		$this->set('tests',$this->Patient->Result->Test->find('all',array('recursive'=>-1,'conditions'=>array('active'=>true))));

		//$paginate=array('Result'=>array('order'=>'created DESC'));
		$this->set('patients',$this->paginate('Patient',array('Patient.pid'=>$pid)));
	
	}
	
	/**
	 * Edit a row in the `patients' table
	 */
	function edit($pid = NULL) {
		if (isset($this->data)) {
		// What to do if we've submitted new data (i.e. the edit form has been
		// submitted)
			
			// The input needs a bit of fiddling to rearrange things to how the
			// the database table is expecting them to be
			$this->data = $this->__prettyInput($this->data);
			
			// Update the row
			if ($this->Patient->save($this->data)) {
				$this->Session->setFlash('The patient details were successfully updated');
			} else {
				$this->Session->setFlash('There was a problem updating this patient\'s details.  Please try again');
			}
			$this->redirect('/patients/view/' . $this->data['Patient']['pid']);
			
		} elseif ($this->Patient->isValidPID($pid) && $this->Patient->valueExists($pid, 'Patient', 'pid')) {
		// What to do if a valid $pid has been passed (i.e. we want to show the
		// edit form)
			
			$this->data = $this->Patient->read(NULL, $pid);
			
		} else {
		// Something funny is going on via an astandard route
		
			$this->Session->setFlash('That is not a valid patient');
			$this->redirect(array('action' => 'index'));
			
		}
	}
	
	/**
	 * This takes $this->data that gets submitted to the controller via the
	 * add and edit actions, and performs some cosmetic changes that are
	 * common to both actions (so that everything is how PostgreSQL expects it)
	 */
	private function __prettyInput($data) {
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
		foreach (array('upn', 'mother', 'telephone_number', 'village', 'home', 'nearest_church', 'nearest_school', 'nearest_health_centre', 'nearest_major_landmark') as $field) {
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
