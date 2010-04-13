<?php
/**
 * This is the Patient model which maps to the database table 'patients' and
 * contains basic demographic data.
 */

class Patient extends AppModel
{
	var $name = 'Patient';
	
	/**
	 * pid is the primary key
	 */
	var $primaryKey = 'pid';
	
	/**
	 * Define relationships with lookup tables
	 */
	var $belongsTo = array(
		'Occupation' => array('className' => 'Occupation'),
		'Education' => array('className' => 'Education'),
		'MaritalStatus' => array('className' => 'MaritalStatus'),
		'Location' => array('className' => 'Location'),
		'VfTestingSite' => array(
			'className'  => 'VfTestingSite',
			'foreignKey' => FALSE,
			'conditions' => array('Patient.vf_testing_site = VfTestingSite.site_code')
		),
		'InactiveReason' => array('className' => 'InactiveReason'),
	);
	
	var $hasMany = array(
		'Result' => array(
			'className'  => 'Result',
			'foreignKey' => 'pid'
		)
	);
	
	/**
	 * Each row here has a one-to-one mapping with a row in the 
	 * MedicalInformation model
	 */
	var $hasOne = array(
		'MedicalInformation' => array(
			'className'  => 'MedicalInformation',
			'foreignKey' => FALSE,
			'conditions' => array('Patient.pid = MedicalInformation.pid'),
			'dependent'  => TRUE
		)
	);
	
	/**
	 * Validate save()
	 */
	var $validate = array(
		'pid' => array(
			'check_luhn' => array(
				'rule'    => array('customValidationFunction', 'isValidPID'),
				'message' => 'That is not a valid Patient ID'
			),
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'This Patient ID already exists'
			),
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'A Patient ID must be entered'
			)
		),
		'upn' => array(
			
			'unique' => array(
				'rule'       => 'isUnique',
				'allowEmpty' => FALSE,
				'message'    => 'This Unique Patient Number already exists'
			)
		),
		'arvid' => array(
			'positive integer' => array(
				'rule'       => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message'    => 'The ARV Patient ID should be a positive integer'
			),
			'unique' => array(
				'rule'       => 'isUnique',
				'allowEmpty' => TRUE,
				'message'    => 'This ARV Patient ID already exists'
			)
		),
		'vfcc' => array(
			'positive integer' => array(
				'rule'       => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message'    => 'The VF Client Code should be a positive integer'
			),
			'unique' => array(
				'rule'       => 'isUnique',
				'allowEmpty' => TRUE,
				'message'    => 'This VF Client Code already exists'
			)
		),
		'surname' => array(
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'The surname must be filled in'
			)
		),
		'forenames' => array(
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'The forename(s) must be filled in'
			)
		),
		'date_of_birth' => array(
			'ISO 8601' => array(
				'rule'       => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a well-formatted date'
			)
		),
		'year_of_birth' => array(
			'positive integer' => array(
				'rule'       => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message'    => 'The year of birth should be a positive integer'
			),
			'not in the future' => array(
				'rule'       => array('customValidationFunction', 'isNotFutureYear'),
				'allowEmpty' => TRUE,
				'message'    => 'The year of birth is in the future'
			)
		),
		'occupation_id' => array(
			'valid occupation_id' => array(
				'rule'       => array('customValidationFunction', 'valueExists', 'Occupation', 'id'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid occupation_id'
			)
		),
		'education_id' => array(
			'valid education_id' => array(
				'rule'       => array('customValidationFunction', 'valueExists', 'Education', 'id'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid education_id'
			)
		),
		'marital_status_id' => array(
			'valid marital_status_id' => array(
				'rule'       => array('customValidationFunction', 'valueExists', 'MaritalStatus', 'id'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid marital_status_id'
			)
		),
		'telephone_number' => array(
			'ten digits' => array(
				'rule'       => array('custom', '/^\d{10}$/'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a well-formatted telephone number'
			)
		),
		'location_id' => array(
			'valid location_id' => array(
				'rule'    => array('customValidationFunction', 'valueExists', 'Location', 'id'),
				'message' => 'This is not a valid location_id'
			)
		),
		'vf_testing_site' => array(
			'valid vf_testing_site' => array(
				'rule'       => array('customValidationFunction', 'valueExists', 'VfTestingSite', 'site_code'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid VF Testing site code'
			)
		),
		'status' => array(
			'boolean' => array(
				'rule'       => 'boolean',
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid value for status'
			)
		),
		'inactive_reason_id' => array(
			'positive integer' => array(
				'rule'       => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message'    => 'inactive_reason_id should be a positive integer'
			),
			'valid inactive_reason_id' => array(
				'rule'       => array('customValidationFunction', 'valueExists', 'InactiveReason', 'id'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid inactive_reason_id'
			)
		)
	);
	
	/**
	 * This function takes a PID and validates its LUHN control character (i.e.
	 * it is a valid PID).  Note that it does not check the list of valid PIDs
	 * for uniqueness -- there is no interaction with the database)
	 */
	function isValidPID($pid)
	{
		// Check to see that it is formatted correctly (at least two digits long
		// and a positive integer, essentially)
		if (!preg_match('/^\d{2,9}$/', $pid)) {
			return FALSE;
		}
		
		// Split the PID into an array in a right-to-left fashion
		$pidArray = array_reverse(str_split($pid));
		
		// Starting with the penultimate digit, double every other digit
		for ($i = 1; $i < count($pidArray); $i += 2) {
			$pidArray[$i] = $pidArray[$i] * 2;
		}
		
		// Add all of the digits up
		$digits = '';
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
	
	/**
	 * Generate a new PID
	 */
	function newPID()
	{
		// The PID is split into two parts.  $checksum is appended to $prefix
		// to make the full number.
		if ($this->find('count') > 0) {
			// Get the last PID, work out its prefix and increment by one
			$lastPid = $this->find('first', array(
				'fields' => array('Patient.pid'),
				'order' => array('Patient.pid DESC')
				));
			$lastPid = $lastPid['Patient']['pid'];
			$prefix = substr($lastPid, 0, strlen($lastPid) - 1) + 1;
		} else {
			// This is the prefix to the first PID we will ever assign
			$prefix = 1;
		}
		
		// Split the prefix into an array in a right-to-left fashion
		$prefixArray = array_reverse(str_split($prefix));
		
		// Starting with the first digit, double every other number
		for ($i = 0; $i < count($prefixArray); $i += 2) {
			$prefixArray[$i] = $prefixArray[$i] * 2;
		}
		
		// Add all of the digits up
		$digits = '';
		foreach ($prefixArray as $value) {
			$digits .= $value;
		}
		$sum = array_sum(str_split($digits));
		
		// When $checksum is added modulo ten, it should equal zero
		$checksum = (10 - ($sum % 10)) % 10;
		
		return $prefix . $checksum;
	}
}
?>
