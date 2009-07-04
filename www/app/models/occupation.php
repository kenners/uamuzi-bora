<?php
/**
 * The Occupation model, which describes the lookup table of occupations.
 */

class Occupation extends AppModel {
	var $name = 'Occupation';
	
	/**
	 * Validation suite (essentially this is what is checked when save() is
	 * is called)
	 */
	var $validate = array(
		'id' => array(
			'int' => array(
				'rule' => array('decimal', 0),
				'allowEmpty' => TRUE,
				'message' => 'The ID should be an integer'
			),
			'positive' => array(
				'rule' => array('comparison', 'greater or equal', 0),
				'allowEmpty' => TRUE,
				'message' => 'The ID should be positive'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'allowEmpty' => TRUE,
				'message' => 'This ID is already in use'
			)
		),
		'name' => array(
			'not null' => array(
				'rule' => 'notEmpty',
				'message' => 'This field must not be left empty'
			),
			'unique' => array(
				'rule' => array('isUniqueCaseInsensitive', 'name'),
				'message' => 'This occupation already exists'
			)
		)
	);
}
?>
