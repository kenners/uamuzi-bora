<?php
/**
 * This is the Result model which stores information about test results
 */
class Result extends AppModel
{
	var $belongsTo = array(
		'Test' => array(
			'className' => 'Test'
		),
		'Patient' => array(
			'className'  => 'Patient',
			'foreignKey' => 'pid'
		),
		'User' => array(
			'className' => 'User'
		)
	);
	var $hasMany = array(
		'ResultValue'=>array(
			'className' => 'ResultValue'
		)
	);
	
	/**
	 * Validate save()
	*/
	var $validate = array(
		'pid' => array(
			'int' => array(
				'rule'    => 'numeric',
				'message' => 'The PID id must be an integer'
			),
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'The user id can\'t be empty'
			),
		),
		'user_id' => array(
			'int' => array(
				'rule'    => 'numeric',
				'message' => 'The user id must be an integer'
			),
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'The user id can\'t be empty'
			)
		)
	);
}
