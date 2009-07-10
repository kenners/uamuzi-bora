<?php
/**
 * The MedicalInformation model
 */

class MedicalInformation extends AppModel {
	var $name = 'MedicalInformation';
	
	/**
	 * Tell CakePHP that `pid' is the primary key
	 */
	var $primaryKey = 'pid';
	
	/**
	 * Define relationships: lookup tables, but also note that there is a
	 * one-to-one mapping for each row up to the Patient model
	 */
	var $belongsTo = array(
		'pid' => array(
			'className' => 'Patient',
			'foreignKey' => FALSE,
			'conditions' => array('MedicalInformation.pid' => 'Patient.pid')
			),
		'inactive_reason' => array('className' => 'InactiveReason'),
		'patient_source' => array('className' => 'PatientSource'),
		'funding' => array('className' => 'Funding'),
		'hiv_positive_test_location' => array(
			'className' => 'Location',
			'foreignKey' => FALSE,
			'conditions' => array('MedicalInformation.hiv_positive_test_location_id' => 'Location.id')
			),
		'art_service_type' => array('className' => 'ArtServiceType'),
		'art_starting_regimen' => array(
			'className' => 'Regimen',
			'foreignKey' => FALSE,
			'conditions' => array('MedicalInformation.art_starting_regimen_id' => 'Regimen.id')
			),
		'art_indication' => array('className' => 'ArtIndication'),
		'transfer_in_district' => array(
			'className' => 'Location',
			'foreignKey' => FALSE,
			'conditions' => array('MedicalInformation.transfer_in_district_id' => 'Location.id')
			)
		);
	
	/**
	 * Validate fields
	 */
	var $validate = array(
		'pid' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'message' => 'The Patient ID must be a positive integer'
				),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'There is already an entry for this Patient ID.  Has the audit system gone wonky?',
				),
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'This field must not be left empty'
				),
			'valid PID' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'Patient', 'pid'),
				'message' => 'This Patient ID does not exist'
				)
			),
		'status' => array(
			'boolean' => array(
				'rule' => 'boolean',
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid value for status'
				)
			),
		'inactive_reason_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'inactive_reason_id should be a positive integer'
				),
			'valid inactive_reason_id' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'InactiveReason', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid inactive_reason_id'
				)
			),
		'patient_source_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'patient_source_id should be a positive integer'
				),
			'patient_sources.id exists' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'PatientSource', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid patient_source_id'
				)
			),
		'funding_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'funding_id should be a positive integer'
				),
			'fundings.id exists' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'Funding', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid funding_id'
				)
			),
		'hiv_positive_date' => array(
			'ISO8601' => array(
				'rule' => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted date'
				)
			),
		'hiv_positive_test_location_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'hiv_positive_test_location_id should be a positive integer'
				),
			'locations.id exists' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'Location', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid hiv_positive_test_location_id'
				)
			),
		'hiv_positive_clinic_start_date' => array(
			'ISO8601' => array(
				'rule' => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted date'
				)
			),
		'hiv_positive_who_stage' => array(
			'(positive) integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'HIV+ WHO Stage should be an integer between 1 and 4'
				),
			'>= 1' => array(
				'rule' => array('comparison', 'greater or equal', 1),
				'allowEmpty' => TRUE,
				'message' => 'HIV+ WHO Stage should be an integer between 1 and 4'
				),
			'<= 4' => array(
				'rule' => array('comparison', 'less or equal', 4),
				'allowEmpty' => TRUE,
				'message' => 'HIV+ WHO Stage should be an integer between 1 and 4'
				),
			),
		'art_naive' => array(
			'boolean' => array(
				'rule' => 'boolean',
				'allowEmpty' => TRUE,
				'message' => 'That is not a valid value for art_naive'
				)
			),
		'art_service_type_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'art_service_type_id should be a positive integer'
				),
			'art_service_types.id exists' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'ArtServiceType', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid art_service_type_id'
				)
			),
		'art_starting_regimen_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'art_starting_regimen_id should be a positive integer'
				),
			'regimens.id exists' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'Regimen', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid art_starting_regimen_id'
				)
			),
		'art_start_date' => array(
			'ISO8601' => array(
				'rule' => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted date'
				)
			),
		'art_eligibility_date' => array(
			'ISO8601' => array(
				'rule' => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted date'
				)
			),
		'art_indication_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'art_indication_id should be a positive integer'
				),
			'art_indications.id exists' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'ArtIndication', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid art_indication_id'
				)
			),
		'transfer_in_date' => array(
			'ISO8601' => array(
				'rule' => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted date'
				)
			),
		'transfer_in_district_id' => array(
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'transfer_in_district_id should be a positive integer'
				),
			'locations.id exists' => array(
				'rule' => array('customValidationFunction', 'valueExists', 'Location', 'id'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid transfer_in_district_id'
				),
			'is a district' => array(
				'rule' => array('customValidationFunction', 'isDepth', 'Location', 2),
				'allowEmpty' => TRUE,
				'message' => 'This is not a district'
				)
			),
		'transfer_out_date' => array(
			'ISO8601' => array(
				'rule' => array('date', 'ymd'),
				'allowEmpty' => TRUE,
				'message' => 'This is not a well-formatted date'
				)
			),
		);
}
?>
