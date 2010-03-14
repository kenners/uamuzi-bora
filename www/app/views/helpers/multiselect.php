<?php 
/**
 * Multiselect Preview Helper by Pietro Brignola.
 *
 * Provide realtime list preview of the selected items of a multiple select control.
 *
 * PHP versions 4 and 5
 *
 * Comments and bug reports welcome at pietro.brignola AT unipa DOT it
 *
 * Licensed under The MIT License
 *
 * @writtenby      Pietro Brignola
 * @lastmodified   Date: July 31, 2009
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class MultiselectHelper extends AppHelper {
	
	var $helpers = array('Html', 'Form');
	
	/**
	 * Generates multiple select input element complete with realtime selection preview
	 *
	 * @param string $fieldName Model.Field (Model.Model) name (same as FormHelper::input() options param)
	 * @param array $options Options array (same as FormHelper::input() options param)
	 * @return string Completed multiple select input widget
	 */
	function display($fieldName, $options = array()) {
		$items = MultiselectHelper::getSelectedItems($this->Form->input($fieldName, $options));
		$label = '';
		foreach($items as $item)
			$label .= '<input type="checkbox" disabled checked/>'.$item.'<br/>';
		$options['type'] = 'select';
		$options['multiple'] = 'multiple';
		$options['between'] = $this->Form->label($fieldName.'.Preview', $label, array('id' => $fieldName.'.Preview'));
		$options['onchange'] = 'previewSelectedOptionsText(document.getElementById(this.id), document.getElementById("'.$fieldName.'.Preview"));';
		return $this->output($this->Form->input($fieldName, $options));
	}
	
	/**
	 * Extract selected items array from html multiselect tag
	 *
	 * @param array Html multiselect tag
	 * @return array Selected items array
	 */
	
	private function getSelectedItems($html) {
		$dom = new domDocument();
		$dom->loadHTML($html);
		$dom->preserveWhiteSpace = false;
		$options = $dom->getElementsByTagname('option');
		$items = array();
		foreach($options as $option) {
			if($option->hasAttribute('selected'))
				$items[] = $option->nodeValue;
		}
		return $items;
	}
	
}
?>