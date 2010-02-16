<?php
/**
 * A model for user groups, used to manage acl permissions
 */
class Group extends AppModel
{
	var $name = 'Group';
	var $actsAs = array('Acl' => array('requester'));
	var $validate = array(
		'name' => array(
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'This group already exists'
			),
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'A name must be entered'
			)
		)
	);
	
	function parentNode()
	{
		return null;
	}
	
	// The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'User' => array(
			'className'  => 'User',
			'foreignKey' => 'group_id',
			'dependent'  => false,
		)
	);
}
?>
