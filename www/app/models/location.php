<?php
/**
 * The Location model, which describes the lookup table of locations.  As this
 * table is more complex than the other tables, it shall inherit directly
 * from AppModel, not LookupTableModel.
 *
 * The 'locations' table has a tree structure, as described on the wiki here:
 *     https://github.com/kenners/uamuzi-bora/wikis/kenyan-geographical-areas
 * This is mapped to the database table 'location' using a nested set model
 * using CakePHP's Tree behaviour.  There is also a parent_id column for 
 * convenience (required by CakePHP too).
 */
class Location extends AppModel
{
	var $name = 'Location';
	
	/**
	 * Use CakePHP's Tree behaviour
	 */
	var $actsAs = array(
		'Tree' => array(
			'left'  => 'tree_left',
			'right' => 'tree_right'
		)
	);
	
	/**
	 * Validation rules
	 */
	var $validate = array(
		'id' => array(
			'positive integer' => array(
				'rule'       => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message'    => 'The ID should be a positive integer'
			),
			'unique' => array(
				'rule'       => 'isUnique',
				'allowEmpty' => TRUE,
				'message'    => 'This ID is already in use'
			)
		),
		'name' => array(
			'not null' => array(
				'rule'    => 'notEmpty',
				'message' => 'This field must not be left empty',
			),
			'unique node' => array(
				'rule'    => array('customValidationFunction', 'isUniqueNodeAmongstPeers', 'name'),
				'message' => 'This location already exists'
			)
		),
		'parent_id' => array(
			'positive integer' => array(
				'rule'       => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message'    => 'The parent_id should be a positive integer'
			),
			'valid parent_id' => array(
				'rule'       => array('customValidationFunction', 'valueExists', 'Location', 'id'),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid parent'
			)
		),
		'vf_code' => array(
			'valid vf_code' => array(
				'rule'       => array('customValidationFunction', 'isUniqueNodeAmongstPeers', 'vf_code'),
				'allowEmpty' => TRUE,
				'message'    => 'This VF code already exists at this level'
			)
		),
		'latitude' => array(
			'float' => array(
				'rule'       => 'numeric',
				'allowEmpty' => TRUE,
				'message'    => 'Latitude must be a number'
			),
			'valid latitude range' => array(
				'rule'       => array('between', -90, 90),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid latitude'
			)
		),
		'longitude' => array(
			'float' => array(
				'rule'       => 'numeric',
				'allowEmpty' => TRUE,
				'message'    => 'Longitude must be a number'
			),
			'valid longitude range' => array(
				'rule'       => array('between', -180, 180),
				'allowEmpty' => TRUE,
				'message'    => 'This is not a valid longitude'
			)
		)
	);
}
?>
