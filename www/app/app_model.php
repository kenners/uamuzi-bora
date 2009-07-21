<?php
class AppModel extends Model {
	// Allows us to use Contain in all find/paginate queries, helping to improve
	// query speed and reduce db load.
	var $actsAs = array('Containable');
	
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
		
		// Are there at least three arguments?
		if (count($args) <= 2) {
			return FALSE;
		}
		
		// Get rid of the last element, as it is an array of the validation
		// rule information
		array_pop($args);
		
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
	
	/**
	 * Custom validation function that checks if a field is unique amongst its
	 * peers (i.e. amongst those with the same direct parent) in a case 
	 * insensitive manner.  The first argument is the value to be tested, the 
	 * second is the name of the field to check, and the second is the 
	 * parent_id.  If FALSE, then this will be looked up from $this->data.
	 *
	 * Note that this is for models using the Tree behaviour.
	 */
	function isUniqueNodeAmongstPeers($value, $field, $parent_id = FALSE) {
		// What is the current model?
		$model = array_keys($this->data);
		$model = $model[0];
		
		// If parent_id has been passed as NULL, look this up from $this->data
		if ($parent_id === FALSE) {
			if (isset($this->data[$model]['parent_id'])) {
				$parent_id = $this->data[$model]['parent_id'];
			} else {
				return FALSE;
			}
		}
		
		// Fetch the direct children of $parent_id into an array
		$peers = $this->children($parent_id, TRUE);
		
		// Loop through $peers and return FALSE if any of them match
		foreach ($peers as $peer) {
			if (strcasecmp($peer[$model][$field], $value) == 0) {
				return FALSE;
			}
		}
		
		// If we've come this far, then there's been no match
		return TRUE;
	}
	
	/**
	 * Custom validation function that returns TRUE if $value exists in the 
	 * column $column ('id' by default) of the model $model
	 */
	function valueExists($value, $model, $column = 'id') {
		// Set the conditions
		$conditions = array($model . '.' . $column => $value);

		// Set $count, the number of rows with $value in $column, calling
		// ClassRegistry to access the model
		$this->$model =& ClassRegistry::init($model);
		$count = $this->$model->find('count', array('conditions' => $conditions));
		
		// If $count is at least 1, then return TRUE
		return $count >= 1;
	}
	
	/**
	 * Custom validation function that returns TRUE if $value is composed of
	 * only digits (i.e it is a positive integer or 0).
	 *
	 * This is actually the equivalent of preg_match('/^\d+$/', $value) but is
	 * processed significantly faster
	 */
	function isPositiveInteger($value) {
		return (ctype_digit($value) || (is_int($value) && $value >= 0));
	}
	
	/**
	 * Custom validation function that returns TRUE if node with id $id has
	 * $depth levels above it in the model $model.  For example:
	 *     isDepth('Kenya', 'Location', 0) returns TRUE
	 *     isDepth('Kakamega', 'Location', 2) returns TRUE
	 */
	function isDepth($id, $model, $depth) {
		$this->$model =& ClassRegistry::init($model);
		if (count($this->$model->getpath($id)) - 1 == $depth) {
			return TRUE;
		} else {
			return FALSE;
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
			'positive integer' => array(
				'rule' => array('customValidationFunction', 'isPositiveInteger'),
				'allowEmpty' => TRUE,
				'message' => 'The ID should be a positive integer'
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
