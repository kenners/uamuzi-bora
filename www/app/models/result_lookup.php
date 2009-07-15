<?php
/**
 * A central model to store all results from all the different tests.
 */

class ResultLookup extends appModel{
  

  var $belongsTo=array(
		       'User'=>array('className'=>'User'),
		       'Test'=>array('className'=>'Test')
		       );
		       var $hasMany=array('Result'=>array(
							  'className'=>'Result',
							  'foreignKey'=>'value_lookup'
							  //'condition'=> array('ResultLookup.test_id ='=>'Result.test_id')
							   )
					  );

  var $validate = array(
			'test_id'=>array(
					'int'=>array(
						     'rule'=>'numeric',
						     'message'=> 'The user id must be an integer'
						     ),
					'not null' => array(
							    'rule' => 'notEmpty',
							    'message' => 'The user id can\'t be empty'
							    )
					),
				      
			'value'=>array(
				      'not null' => array(
							  'rule' => 'notEmpty',
							  'message' => 'The user id can\'t be empty'
							  )

				    ),
			'description'=>array(
				       'not null' => array(
							   'rule' => 'notEmpty',
							   'message' => 'The user id can\'t be empty'
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
?>