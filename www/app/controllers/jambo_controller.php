<?php
class JamboController extends AppController {
/**
 * Jambo (Swahili for "hello") is the controller for generating the welcome/home screen views
 * according to the privileges of the logged in user.
 */
	var $name = 'Jambo';
	var $helpers = array('Html', 'Form', 'Crumb');

}
?>