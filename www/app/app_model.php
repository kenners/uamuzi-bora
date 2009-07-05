<?php
class AppModel extends Model {
	/**
	 * A wrapper for custom validation functions.  This abstracts the logic of
	 * extracting the value to be tested from $data.  This means that we don't
	 * end up writing two rules for every custom validation function, such as
	 * isValidPID, which is reusable from controllers etc, and isValidPIDRule
	 * which accepts subtely different input (i.e. the array $data).
	 * 
	 * The first argument should be $data, and the second the name of the
	 * function to pass the putative value on to.  Any arguments after that are
	 * treated as arguments to the called validation function.  For example:
	 *     rule => array('customValidationFunction', 'foo', 'bar')
	 * will return the result of:
	 *     foo($data, 'bar')
	 */
	function customValidationFunction() {
		// func_get_arg() and func_get_args() can't be used as function
		// parameters because they rely on the current scope
		$args = func_get_args();
		
		// Are there at least two arguments?
		if (count($args) <= 1) {
			return FALSE;
		}
		
		// Set $value, the value to be tested (and therefore the first argument
		// to the called function)
		$value = array_values($args[0]);
		$value = $value[0];
		
		// Set $function, the function to be called
		$function = $args[1];
		
		// Set $params, an array of the parameters to be passed to $function
		// (the first of which will obviously be $value)
		$params[] = $value;
		for ($i = 3; $i <= count($args); $i++) {
			$params[] = $args[$i - 1];
		}
		
		// Call $this->function() and return the result
		return call_user_func_array(array(&$this, $function), $params);
	}
		
	/**
	 * Custom validation function to determine whether or not a value is unique
	 * in a given field in a case insensitive manner.  Uses $this->find i.e.
	 * the current model.  Returns TRUE if it is unique (i.e. passes
	 * validation).
	 */
	function isUniqueCaseInsensitive($value, $field) {
		// How many are there already with this value?
		$conditions = "WHERE UPPER(" . $field . ") = UPPER('" . $value . "')";
		$count = $this->find('count', array('conditions' => $conditions));
		
		return $count == 0;
	}
	
	/**
	 * Custom validation function to determine that a year is not in the future.
	 * Returns TRUE if it passes validation (i.e this year or the past).
	 */
	function isNotFutureYear($year) {
		// Check it is a year
		if (!is_numeric($year)) {
			return FALSE;
		}
		
		// Check if it is in the future
		if ($year > date('Y')) {
			return FALSE;
		} else {
			return TRUE;
		}
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
				'rule' => array('customValidationFunction', 'isUniqueCaseInsensitive', 'name'),
				'message' => 'This value already exists'
			)
		)
	);
}
?>
