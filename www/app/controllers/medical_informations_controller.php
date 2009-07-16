<?php
class MedicalInformationsController extends AppController {
	var $name = 'MedicalInformations';
	var $uses = array(
		'MedicalInformation',
		'ArchiveMedicalInformation',
		'Patient',
		'PatientSource',
		'Funding',
		'Location',
		'ArtServiceType',
		'Regimen',
		'ArtIndication'
		);
	
	/**
	 * index() doesn't make sense from a UI perspective, so just redirect to /
	 */
	function index() {
		$this->redirect('/');
	}
	
	/**
	 * This function should only ever be referred from PatientsController::add.
	 * It is used firstly to display the flash message (information on the
	 * patient just added), and secondly to create a row in the
	 * medical_informations table).  It then prompts the user to either
	 * go to MedicalInformations::edit or Patients::index.
	 */
	function add($pid = NULL) {
		// If $pid is mangled, it's likely this action is being accessed via
		// an astandard route so just redirect to Patients::index.  The same
		// goes for if it doesn't exist in the `patients' table or if it
		// already exists in the `medical_informations' table.
		if (empty($pid) || !$this->Patient->isValidPID($pid) ||
		!$this->Patient->valueExists($pid, 'Patient', 'pid') ||
		$this->MedicalInformation->valueExists($pid, 'MedicalInformation', 'pid')) {
			$this->redirect(array('controller' => 'patients', 'action' => 'index'));
		}
		
		// Create the new row.  In the unlikely event that something went wrong,
		// redirect to PatientssController::view which will also try and create
		// the row in its check at the beginning.
		if (!$this->MedicalInformation->save(array('MedicalInformation' => array('pid' => $pid)))) {
			$this->redirect('/patients/view/' . $pid);
		}
		
		// Send $pid to the view so that it can create the necesssary links
		$this->set('pid', $pid);
	}
	
	/**
	 * Edit a row in the MedicalInformation table, with appropriate auditing
	 */
	function edit($pid = NULL) {
		// Check $pid is okay
		if (empty($pid) || !$this->Patient->isValidPID($pid) || !$this->Patient->valueExists($pid, 'Patient', 'pid')) {
			$this->redirect(array('controller' => 'patients', 'action' => 'index'));
		}
		
		// If there's somehow not a row in the medical_informations table, then
		// create it now.  Hopefully this will never happen, but it might if, say
		// the connection was lost in the middle of adding a new patient.
		if (!$this->MedicalInformation->valueExists($pid, 'MedicalInformation', 'pid')) {
			$this->MedicalInformation->save(array('MedicalInformation' => array('pid' => $pid)));
		}
		
		// If some data has been sent, then archive and edit the database table,
		// then redirect to PatientsController::view
		if (isset($this->data)) {
			// Necessary because if validation fails we want $this->data to be
			// pristine
			$data = $this->data;
			
			// Fix all of the dates to ISO 8601
			foreach (array('hiv_positive_date', 'hiv_positive_clinic_start_date', 'art_start_date', 'art_eligibility_date', 'transfer_in_date', 'transfer_out_date') as $dateField) {
				if (!empty($data['MedicalInformation'][$dateField]['day']) && !empty($data['MedicalInformation'][$dateField]['month']) && !empty($data['MedicalInformation'][$dateField]['year'])) {
					$data['MedicalInformation'][$dateField] = $data['MedicalInformation'][$dateField]['year'] . '-'
															. $data['MedicalInformation'][$dateField]['month'] . '-'
															. $data['MedicalInformation'][$dateField]['day'];
				} else {
					$data['MedicalInformation'][$dateField] = NULL;
				}
			}
			
			// Archive the existing data
			parent::archive($pid);
			
			// Save the new row
			if ($this->MedicalInformation->save($data)) {
				$this->Session->setFlash('Medical information successfully updated');
				$this->redirect(array('controller' => 'patients', 'action' => 'view/' . $pid));
			}
		}
		
		// We need to set some stuff before the form can be displayed
		if (!isset($this->data)) {
			// if condition required in case validation has failed
			$this->data = $this->MedicalInformation->findByPid($pid);
		}
		$this->set(array(
			'fullname' => $this->Patient->field('forenames', array('pid' => $pid)) . ' ' . $this->Patient->field('surname', array('pid' => $pid)),
			'medical_information' => $this->MedicalInformation->read(NULL, $pid),
			'patient_sources' => $this->PatientSource->find('list'),
			'fundings' => $this->Funding->find('list'),
			'hiv_positive_test_locations' => $this->Location->generatetreelist(null, null, null, '-'),
			'art_service_types' => $this->ArtServiceType->find('list'),
			'art_starting_regimens' => $this->Regimen->find('list'),
			'art_indications' => $this->ArtIndication->find('list'),
			'transfer_in_districts' => $this->Location->generatetreelist(null, null, null, '-')
			));
	}
}
?>
