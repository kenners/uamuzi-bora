<?php

class ArtInterruption extends AppModel
{
	var $name = 'ArtInterruption';
	
	/**
	 * Tell CakePHP that `pid' is the primary key
	 */
		
	/**
	 * Define relationships: lookup tables, but also note that there is a
	 * one-to-one mapping for each row up to the Patient model
	 */
	var $belongsTo = array(
		'MedicalInformation' => array(
			'className'  => 'MedicalInformation',
			'foreignKey' => FALSE,
			'conditions' => array('ArtInterruption.pid = MedicalInformation.pid ')
		),
		'ArtInterruptionReason' => array('className'=>'ArtInterruptionReason')
		);
			
	/**
	 * Validate fields
	 */
	var $validate = array(
		'pid' => array(
			'positive integer' => array(
				'rule'    => array('customValidationFunction', 'isPositiveInteger'),
				'message' => 'The Patient ID must be a positive integer'
			),
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'This field must not be left empty'
			),
			'valid PID' => array(
				'rule'    => array('customValidationFunction', 'valueExists', 'Patient', 'pid'),
				'message' => 'This Patient ID does not exist'
			)
		),
		'interruption_reason_id'=>array(
			'positive integer' => array(
				'rule'    => array('customValidationFunction', 'isPositiveInteger'),
				'message' => 'The Patient ID must be a positive integer'
			),
				'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
		),
		'start_date'=>array(
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
			)


		);
}
