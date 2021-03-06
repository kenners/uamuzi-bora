<?php
class UsersController extends AppController
{
	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Crumb');
	var $uses = array('User', 'ArchiveUser');
	
	function login()
	{
		// Auth magic
	}
	
	function logout()
	{
		$this->Session->setFlash('Goodbye');
		$this->redirect($this->Auth->logout());
	}
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allowedActions = array('buildAcl', 'initDB', 'logout', 'login');
		$this->layout='admin';
	}
	
	// A function to initialize the Acl table, for use one time only.
	function buildAcl()
	{
		$log = array();
		
		$aco =& $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root) {
			$aco->create(array(
				'parent_id' => null,
				'model'     => null,
				'alias'     => 'controllers'
			));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id; 
			$log[] = 'Created Aco node for controllers';
		} else {
			$root = $root[0];
		}
		
		App::import('Core', 'File');
		$Controllers = Configure::listObjects('controller');
		$appIndex = array_search('App', $Controllers);
		if ($appIndex !== false ) {
			unset($Controllers[$appIndex]);
		}
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'buildAcl';
		
		// look at each controller in app/controllers
		foreach ($Controllers as $ctrlName) {
			App::import('Controller', $ctrlName);
			$ctrlclass = $ctrlName . 'Controller';
			$methods = get_class_methods($ctrlclass);
			
			// find / make controller node
			$controllerNode = $aco->node('controllers/' . $ctrlName);
			if (!$controllerNode) {
				$aco->create(array(
					'parent_id' => $root['Aco']['id'],
					'model'     => null,
					'alias'     => $ctrlName
				));
				$controllerNode = $aco->save();
				$controllerNode['Aco']['id'] = $aco->id;
				$log[] = 'Created Aco node for ' . $ctrlName;
			} else {
				$controllerNode = $controllerNode[0];
			}
			
			// clean the methods. to remove those in Controller and private actions.
			foreach ($methods as $k => $method) {
				if (strpos($method, '_', 0) === 0) {
					unset($methods[$k]);
					continue;
				}
				if (in_array($method, $baseMethods)) {
					unset($methods[$k]);
					continue;
				}
				$methodNode = $aco->node('controllers/' . $ctrlName . '/' . $method);
				if (!$methodNode) {
					$aco->create(array(
						'parent_id' => $controllerNode['Aco']['id'],
						'model'     => null,
						'alias'     => $method
					));
					$methodNode = $aco->save();
					$log[] = 'Created Aco node for ' . $method;
				}
			}
		}
		debug($log);
		$this->Session->setFlash('Database succesfully initialised'); 
		$this->redirect(array('controller' => '/'));
	}
	
	// A one time use function to initialze the aros_acos table
	function initDB()
	{
		$group =& $this->User->Group;
		
/*		
		$aro =& $this->Acl->Aro;
		$groups = array(
			0 => array('alias' => 'admins'),
			1 => array('alias' => 'users')
		);
		foreach ($groups as $data) {
			$aro->create();
			$aro->save($data);
		}
*/		
		
		// Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');
		
		// allow members to change results
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Patients');
		$this->Acl->allow($group, 'controllers/MedicalInformations');
		$this->Acl->allow($group, 'controllers/Tests', 'view');
		$this->Acl->allow($group, 'controllers/Jambo');
		$this->Acl->deny($group, 'controllers/Jambo', 'admin');
		$this->Acl->allow($group, 'controllers/Results');
		$this->Acl->allow($group, 'controllers/ResultLookups', 'view');
		$this->Acl->allow($group, 'controllers/Reports');
		//Data entry
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Patients');
		$this->Acl->allow($group, 'controllers/MedicalInformations');
		$this->Acl->allow($group, 'controllers/Tests', 'view');
		$this->Acl->allow($group, 'controllers/Jambo');
		$this->Acl->deny($group, 'controllers/Jambo', 'admin');
		$this->Acl->allow($group, 'controllers/Results');
		$this->Acl->allow($group, 'controllers/ResultLookups', 'view');
		$this->Acl->allow($group, 'controllers/Reports');



		$this->Session->setFlash('Database succesfully initialised'); 
		$this->redirect(array('controller' => '/'));
	}
	
	function index()
	{
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	
	// Basic CRUD functions
	function view($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}
	
	function add()
	{
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
			$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
	
	function edit($id = null)
	{
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			parent::archive($id);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
	
	function delete($id = null)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action' => 'index'));
		}
		parent::archive($id);
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action' => 'index'));
		}
	}
}
?>
