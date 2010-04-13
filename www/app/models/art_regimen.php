<?php
 
class ArtRegimen extends AppModel
{
	var $name = 'ArtRegimen';
	
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
			'conditions' => array('ArtRegimen.pid = MedicalInformation.pid ')
		),
		'Regimen' => array(
			'className'  => 'Regimen',
			'foreignKey' => FALSE,
			'conditions' => array('ArtRegimen.art_starting_regimen_id = Regimen.id')
			)
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
		'regimen_id'=>array(
			'positive integer' => array(
				'rule'    => array('customValidationFunction', 'isPositiveInteger'),
				'message' => 'The Patient ID must be a positive integer'
			),
				'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
			),
		'art_line'=>array(
			'positive integer' => array(
				'rule'    => array('customValidationFunction', 'isPositiveInteger'),
				'message' => 'The Patient ID must be a positive integer'
			),
				'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
			)


		);
}

