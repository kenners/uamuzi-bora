<?php

/**
 * This is the Result model which stores information about test results
 */


class Result extends AppModel {
  

  var $belongsTo=array(
		   'Test'=>array('className'=>'Test'),
		   'Patient'=>array('className'=>'Patient',
				    'foreignKey'=>'pid'),
		   'User'=>array('className'=>'User')
		   );

  /**
   * Validate save()
   */

  var $validate = array(
			'pid'=>array(
				     'int'=>array(
						'rule'=>'numeric',
						'message'=> 'The PID id must be an integer'
						),
				     'not null' => array(
							 'rule' => 'notEmpty',
							 'message' => 'The user id can\'t be empty'
							 ),
				     ),
						     
				     
			'value_decimal'=>array(
					       'decimal'=> array(
								 'rule'=>'numeric',
								 'allowEmpty'=> TRUE,
								 'message' => 'The value must be a floating point number'
								 )
					       ),
					    
			'value_lookup'=>array(
					      'int'=> array(
							    'rule'=>'numeric',
							    'allowEmpty'=> TRUE,
							    'message'=> 'The value must be an integer'
							    )
					      ),
			
			'requesting_clinician'=>array(
						      'text'=>array(
								    'rule'=>'alphaNumeric',
								    'allowEmpty'=>TRUE,
								    'message'=> 'The Requesting clinician must be a text'
								    )
						      ),
			'user_id'=>array(
					 'int'=>array(
						      'rule'=>'numeric',
						      'message'=> 'The user id must be an integer'
						      ),
					 'not null' => array(
							     'rule' => 'notEmpty',
							     'message' => 'The user id can\'t be empty'
							     )
					 )
			);
}
								
			
						    
