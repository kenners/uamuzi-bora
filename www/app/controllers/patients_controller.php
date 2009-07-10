<?php
class PatientsController extends AppController {
	var $name = 'Patients';
	
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
	 * Populate the Patient model with data for a new patient
	 */
	function add() {
		// What to do if we have been sent data (i.e. the form has been filled
		// out)
		if (!empty($this->data)) {
			// Generate a new PID
			$this->data['pid'] = $this->Patient->newPID();
			
			// Skeleton filling out of year_of_birth (temporary whilst we work
			// out how this will work in the view)
			$this->data['year_of_birth'] = date('Y', strtotime($this->data['date_of_birth']));
			
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
}
?>
