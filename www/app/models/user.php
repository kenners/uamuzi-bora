<?php
/**
 *A model to keep track of all users and to enable ACL
 */

class User extends AppModel {

  var $name = 'User';
  var $actsAs = array('Acl' => array('requester'));
  //A function that updates the aro-table after we cedit/create a user
  function afterSave($created) {
        if (!$created) {
            $parent = $this->parentNode();
            $parent = $this->node($parent);
            $node = $this->node();
            $aro = $node[0];
            $aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
            $this->Aro->save($aro);
        }
  }
  function parentNode() {// This function returns the group that the user belongs to. This is neseasary for ACL to work
    if (!$this->id && empty($this->data)) {
      return null;
    }
    $data = $this->data;
    if (empty($this->data)) {
      $data = $this->read();
    }
    if (!$data['User']['group_id']) {
      return null;
    } else {
      return array('Group' => array('id' => $data['User']['group_id']));
    }
  }
  //The Associations below have been created with all possible keys, those that are not needed can be removed
  var $belongsTo = array(
			 'Group' => array(
					  'className' => 'Group',
					  'foreignKey' => 'group_id',
					   )
			 );

			 var $hasMany = array(
					      'Test' => array(
							      'className' => 'Test',
							      'foreignKey' => 'user_id',
							      'dependent' => false,
							      
							      ),
					      'Result' => array(
								'className' => 'Result',
								'foreignKey' => 'user_id',
								'dependent' => false,
								
								),
					      'ResultLookup' => array(
								      'className' => 'ResultLookup',
								      'foreignKey' => 'user_id',
								      'dependent' => false,
								      
								      )
					      );
}
?>