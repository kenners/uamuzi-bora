<?php
/**
 * This is the Patient model which maps to the database table 'patients' and
 * contains basic demographic data.
 */

class Patient extends AppModel {
	var $name = 'Patient';
	
	/**
	 * pid is the primary key
	 */
	var $primaryKey = 'pid';
	
	/**
	 * Define relationships with lookup tables
	 */
	var $belongsTo = array(
		'occupation' => array('className' => 'Occupation'),
		'education' => array('className' => 'Education'),
		'marital_status' => array('className' => 'MaritalStatus'),
		'location' => array('className' => 'Location'),
		'vf_testing_site' => array(
			'className' => 'VfTestingSite',
			'foreignKey' => FALSE,
			'conditions' => array('Patient.vf_testing_site' => 'Location.id')
		)
	);
	
	/**
	 * Validate save()
	 */
	var $validate = array(
		'pid' => array(
			'check_luhn' => array(
				'rule' => array('customValidationFunction', 'isValidPID'),
				'message' => 'That is not a valid Patient ID'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This Patient ID already exists'
			),
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'A Patient ID must be entered'
			)
		),
		'upn' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'The Unique Patient Number should be a positive integer'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'allowEmpty' => TRUE,
				'message' => 'This Unique Patient Number already exists'
			)
		),
		'arvid' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'The ARV Patient ID should be a positive integer'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'allowEmpty' => TRUE,
				'message' => 'This ARV Patient ID already exists'
			)
		),
		'vfcc' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'The VF Client Code should be a positive integer'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'allowEmpty' => TRUE,
				'message' => 'This VF Client Code already exists'
			)
		),
		'surname' => array(
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'The surname must be filled in'
			)
		),
		'forenames' => array(
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'The forename(s) must be filled in'
			)
		),
		'date_of_birth' => array(
			'ISO8601' => array(
				'rule' => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted date'
			)
		),
		'year_of_birth' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'message' => 'The year of birth should be a positive integer'
			),
			'not in the future' => array(
				'rule' => array('customValidationFunction', 'isNotFutureYear'),
				'message' => 'The year of birth is in the future'
			),
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'The year of birth must not be left empty'
			)
		),
		'telephone_number' => array(
			'ten digits' => array(
				'rule' => array('custom', '/^\d{10}$/'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted telephone number'
			)
		),
		'location_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'The location_id should be a positive integer'
			),
			'valid location_id' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'Location', 'id'),
				'message' => 'This is not a valid location_id'
			)
		),
		'vf_testing_site' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'The vf_testing_site should be a positive integer'
			)
		)
	);
	
	/**
	 * This function takes a PID and validates its LUHN control character (i.e.
	 * it is a valid PID).  Note that it does not check the list of valid PIDs
	 * for uniqueness -- there is no interaction with the database)
	 */
	function isValidPID($pid) {
		// Check to see that it is formatted correctly (at least two digits long
		// and a positive integer, essentially)
		if (!preg_match('/^\d{2,9}$/', $pid)) {
			return FALSE;
		}
	
		// Split the PID into an array in a right-to-left fashion
		$pidArray = array_reverse(str_split($pid));
	
		// Starting from the last (check) digit, double every other number
		for ($i = 1; $i <= count($pidArray); $i += 2) {
			$pidArray[$i] = $pidArray[$i] * 2;
		}
	
		// Add all of the digits up
		foreach ($pidArray as $value) {
			$digits .= $value;
		}
		$sum = array_sum(str_split($digits));
	
		// Is it 0 modulo 10?
		if (($sum % 10) == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
