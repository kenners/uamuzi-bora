<?php
/* SVN FILE: $Id: app_controller.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	//Enabling Ajax for all controllers, as we're going to be using it for our Index views
	var $helpers = array('Javascript','Ajax','Crumb');
	
  var $components =array('Acl','Auth');// Components for ACL
  function beforeFilter() {
        Security::setHash('sha256');
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login'); // The action to login
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');// Where we redirect after logout
        $this->Auth->loginRedirect = array('controller' => 'results', 'action' => 'index'); // Where we redirect after login
  }

  // A function to archive a record given by $id, the function asumes a model
  // called archive_modelName which has to be included via the var $uses=
  function archive($id = null){
    $modelClass=$this->modelClass;//get the name of the current model

    $user_id=$this->Auth->user('id');//get user id from session
    $archive_model="Archive".$modelClass;
    //get the record from the database
    eval('$data=  $this->'.$modelClass.'->read(null, '.$id.');');
    //Because of the formatting of the return , need this to get the values
    $data=$data[$modelClass];
    $data_out=array();
    
    //go trough all the records and changing the names so that they get the prefix archive_
    foreach(array_keys($data) as $keys)
      {
	$key='archive_'.$keys;
	$data_out[$key] = $data[$keys];
      }
    $data_out['user_id']=$user_id;//add the user id
   
     
    if(!empty($this->data)){// If edited we want to get the archive reason
      // Extract the reason field from the $this->data array
      eval('$reason=Set::extract("/'.$modelClass.'/archive_reason", $this->data);');
      $data_out['archive_reason']=array_pop($reason);
      }
    //Need to format the array we want to save this way
    $save[$archive_model]=$data_out;
    //create a new record and save the data
    eval('$this->'.$archive_model.'->create();');
    eval('$this->'.$archive_model.'->save($save);');
    
  }
      
}
?>