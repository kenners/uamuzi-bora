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
?>
