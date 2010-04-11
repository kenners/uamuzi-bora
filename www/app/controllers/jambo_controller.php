<?php
class JamboController extends AppController
{
/**
 * Jambo (Swahili for "hello") is the controller for generating the welcome/home screen views
 * according to the privileges of the logged in user.
 */
	var $name = 'Jambo';
	var $helpers = array('Html', 'Form', 'Crumb');
	
	// We need this to stop it complaining that it hasn't got an associated model.
	var $uses = NULL;
	function beforeFilter()
	{	
		parent::beforeFilter();
		$this->layout='admin';
	}	
	
	/**
	 * Displays the main home page with different options depending on the group of the
	 * logged in user.
	 */
	
	
	/**
	 * Displays the admin functions
	 */	
	function admin() {}
	
}
?>
