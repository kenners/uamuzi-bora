<?php
/**
 * The lookup table of VF testing sites.  Note the exact case of this model
 * name: it is VfTestingSite not VFTestingSite due to oddities in the way
 * CakePHP's camelCase conventions and $useTable interact.
 */

class VfTestingSite extends AppModel {
	var $name = 'VfTestingSite';
	
	/**
	 * The primary key is called 'site_code' not 'id' in this table as that 
	 * better describes what the field represents.
	 */
	var $primaryKey = 'site_code';
	
	/**
	 * Associate with Location model
	 */
	var $belongsTo = array(
		'location' => array('className' => 'Location')
	);
	
	/**
	 * Validation
	 */
	var $validate = array(
		'site_code' => array(
			'int' => array(
				'rule' => array('decimal', 0),
				'message' => 'The VF site code must be an integer'
			),
			'positive' => array(
				'rule' => array('comparison', 'greater or equal', 0),
				'message' => 'The VF site code must be positive'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This VF site code is already in use'
			),
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
		),
		'site_name' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This VF site name is already in use'
			),
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
		),
		'type' => array(
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
		),
		'location_id' => array(
			'int' => array(
				'rule' => array('decimal', 0),
				'message' => 'The location_id must be an integer'
			),
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'This field must not be left empty'
			)
		),
		'latitude' => array(
			'float' => array(
				'rule' => 'numeric',
				'allowEmpty' => TRUE,
				'message' => 'Latitude must be a number'
			),
			'valid latitude range' => array(
				'rule' => array('between', -90, 90),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid latitude'
			)
		),
		'longitude' => array(
			'float' => array(
				'rule' => 'numeric',
				'allowEmpty' => TRUE,
				'message' => 'Longitude must be a number'
			),
			'valid longitude range' => array(
				'rule' => array('between', -180, 180),
				'allowEmpty' => TRUE,
				'message' => 'This is not a valid longitude'
			)
		)
	);
}
?>
