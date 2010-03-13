<?php
/**
 * This is the Result model which stores information about test results
 */
class ResultValue extends AppModel
{
	var $belongsTo = array(
		'Result'=> array(
			'className'=> 'Result'
		),
		'User' => array(
			'className' => 'User'
		),
		'ResultLookup' => array(
			'className'  => 'ResultLookup',
//			'conditions' => array('Result.test_id' => 'ResultLookup.test_id')
			'foreignKey' => 'value_lookup'
		)
	);
	
	/**
	 * Validate save()
	*/
	var $validate = array(
		'result_id'=> array(
			'not null'=> array(
				'rule'=>'notEmpty',
				'message'=>'This result value has to belong to a resul'
			)
		),
		'value_decimal' => array(
			'decimal'=> array(
				'rule'       => 'numeric',
				'allowEmpty' => TRUE,
				'message'    => 'The value must be a floating point number'
			)
		),
		'value_lookup' => array(
			'int' => array(
				'rule'       => 'numeric',
				'allowEmpty' => TRUE,
				'message'    => 'The value must be an integer'
			)
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
?>
