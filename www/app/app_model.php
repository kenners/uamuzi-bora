<?php
class AppModel extends Model {
	/**
	 * Custom validation function to determine whether or not a value is unique
	 * in a given field in a case insensitive manner.  Uses $this->find i.e.
	 * the current model.  Returns TRUE if it is unique (i.e. passes
	 * validation).
	 */
	function isUniqueCaseInsensitive($data, $field) {
		// What is the prospective name?
		$name = array_values($data);
		$name = $name[0];
		
		// How many are there already with this name?
		$conditions = "WHERE UPPER(" . $field . ") = UPPER('" . $name . "')";
		$count = $this->find('count', array('conditions' => $conditions));
		
		return $count == 0;
	}
}

/**
 * Model for lookup tables, so create models like so:
 *     class Something extends LookupTableModel {...
 */
class LookupTableModel extends AppModel {
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
				'message' => 'This value already exists'
			)
		)
	);
}
?>
