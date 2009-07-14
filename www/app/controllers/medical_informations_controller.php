<?php
class MedicalInformationsController extends AppController {
	var $name = 'MedicalInformations';
	var $uses = array('MedicalInformation', 'Patient');
	
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
}
?>
