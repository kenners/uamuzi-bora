<?php
/**
 *This is the Test model which stores the different diagnostic tests
 */

class Test extends appModel{


  /**
   *Validation
   */
  var $hasMany=array(
		 'Result'=>array('classname'=>'Result'),
		 'ResultLookup'=>array('className'=>'ResultLookup')
		 );
	var $belongsTo = array('User' => array('className' => 'User'));
   

  var $validate = array(

			'name'=>array(
				      'unique' => array(
							'rule' => 'isUnique',
							'message' => 'This Name already exists'
							),
				      'not null' => array(
							  'rule' => 'notEmpty',
							  'message' => 'A Name must be entered'
							  )
				      ),
			'type'=>array(
				      'option'=>array(
						      'rule'=>array('customValidationFunction','validateType'),
						      'message'=>'The type has to be text, decimal or lookup'
						      ),
				      'not null'=>array(
							'rule'=>'notEmpty',
							'message'=>'The test must have a type'
							)
				      ),
			
			'upper_limit'=>array(
					     'decimal'=> array(
							       'rule'=>'numeric',
							       'allowEmpty'=> TRUE,
							       'message' => 'The Upper limit  must be a floating point number'
							       )
					     ),
			'lower_limit'=>array(
					     'decimal'=> array(
							       'rule'=>'numeric',
							       'allowEmpty'=> TRUE,
							       'message' => 'The lower limit must be a floating point number'
							       )
					       ),
			
			'active'=>array(
					'not null' => array(
							  'rule' => 'notEmpty',
							  'message' => 'A status must be entered'
							  )
					
					),
			'user_id'=>array(
					 'int' => array(
							'rule' => 'numeric',
							'message' => 'The User id should be an integer'
							),
					 'not null' => array(
							     'rule' => 'notEmpty',
							     'message' => 'The user id can\'t be empty'
							     )
					 )
			);
			// A function to check that we only have the desiganted values for the type
			function validateType($type){
			  if(($type=='text') || ($type=='decimal') || ($type=='lookup'))
			    { 
			      return true;
			    }
			  else {
			    return false;
			  }
			}

       
}
?>