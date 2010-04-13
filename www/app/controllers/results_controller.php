<?php
class ResultsController extends AppController {

	var $name = 'Results';
	var $helpers = array('Html', 'Form', 'Multiselect');

	function index() {
		$this->Result->recursive = 0;
		$this->set('results', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Result.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('result', $this->Result->read(null, $id));
	}
	
	function autoComplete()
	{
		//Partial strings will come from the autocomplete field as
		//$this->data['Post']['subject'] 
		$this->set('posts', $this->Post->find('all', array(
			'conditions' => array(
				'Post.subject LIKE' => $this->data['ResultValue'].'%'
				),
			'fields' => array('subject')
		)));
	$this->layout = 'ajax';
	}


	
	function add($pid = null)
	{
		$this->Result->Patient->id = $pid;
		$this->set('pid', $pid);
		if(!$this->Result->Patient->exists()) {
			$this->Session->setFlash('You tried to add a result to a Patient that does not exist');
			$this->redirect($this->referer());
		}
		
		// Check that we are dealing with data from a form, either from the miniform in the Patients::View view or
		// from an earlier submission of this controller's form.
		if (!empty($this->data)) {
		
			// But which form are we coming from?
			if (array_key_exists('Result', $this->data)) {
				// So this method has been called by the view, with the new result form data having been submitted.
				// need to get the id of the result we are about to add
		

				//insert pid, user and test id
				$this->data = Set::insert($this->data, 'Result.user_id', $this->Auth->user('id'));
				$this->data = Set::insert($this->data, 'Result.pid', $pid);
				
				$invalid=array();
				//find out if the test allows multival to be added
				$multi = $this->Result->Test->find('first',
						array('conditions' => array('Test.id' => $this->data['Result']['test_id']),
									 'recursive' => -1, 'fields' => array('Test.multival')));
				if($multi['Test']['multival']==TRUE){
					$i=0;
					while( $i < count($this->data['ResultValue']['value_lookup']) ){
						// Reprocess submitted data into an array structure suitable for insertion into the db
						$this->data = Set::insert($this->data, 'ResultValue.'.$i.'.user_id', $this->Auth->user('id'));
						$this->data = Set::insert($this->data, 'ResultValue.'.$i.'.value_lookup', $this->data['ResultValue']['value_lookup'][$i]);
						// Check all of the multiple fields validate
						$this->Result->ResultValue->set(array('ResultValue'=>$this->data['ResultValue']['value_lookup'][$i]));
						if(!$this->Result->ResultValue->validates()){
							$invalid[$i]=$this->Result->ResultValue->validationErrors;
							unset($this->Result->ResultValue->validationErrors);
							}
						$i++;
					}
					unset($this->data['ResultValue']['value_lookup']);
				}else{//Only one value to be added
					$this->data = Set::insert($this->data, 'ResultValue.user_id', $this->Auth->user('id'));
				
					if(!empty($this->data['ResultValue']['value_lookup'])){
						$this->data = Set::insert($this->data, 'ResultValue.value_lookup', $this->data['ResultValue']['value_lookup'][0]);
						}
					$this->Result->ResultValue->set(array('ResultValue'=>$this->data['ResultValue']));
					//check that the result validates
					if(!$this->Result->ResultValue->validates()){
						$invalid[$i]=$this->Result->ResultValue->validationErrors;
						unset($this->Result->ResultValue->validationErrors);
					}
				}
				
				// validate both inputs
				//debug($this->data);	
				$this->Result->set($this->data);
				if(!$this->Result->validates()){
					$invalid[]=$this->Result->validationErrors;
				}

				if (empty($invalid)){
					//save
					$this->Result->create();		
					$this->Result->save($this->data);
					//get result Id so resultValue can be stored with the correct id
					$result_id=$this->Result->id;

					if(array_key_exists(0,$this->data['ResultValue'])){//If we have multiple values to store!

						foreach($this->data['ResultValue'] as $val){
							$val= Set::insert($val,'result_id', $result_id);
							$this->Result->ResultValue->create();
							$this->Result->ResultValue->save(array('ResultValue'=>$val));
							}
					}else{//Only one ResultValue to store
						$this->data = Set::insert($this->data, 'ResultValue.result_id', $result_id);

						$this->Result->ResultValue->create();
						$this->Result->ResultValue->save(array('ResultValue'=>$this->data['ResultValue']));
					}


					$this->Session->setFlash(__('The Result has been saved', true));
					$this->redirect(array('controller' => 'patients', 'action' => 'view/' . $pid));
				}else{
					$this->Result->value_lookup->validationErrors=$invalid;
					$this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
					// Set up the form variables again for the reloaded view, as we've probably failed validation
					$test_id = $this->data['Result']['test_id'];
					$this->set('test_id', $test_id);
					$this->set('type', $this->Result->Test->find('first', array(
						'conditions' => array('Test.id' => $test_id),
						'recursive'  => -1
					)));
				}
				
	
			
			} else {
			// So we're coming from the miniform
				
				$test_id = $this->data['id'];
				$this->Result->Test->id = $test_id;
				
				// Let's check to see if the Test ID submitted via the miniform actually exists as a Test
				if ($this->Result->Test->exists()) {
					// Yes, it appears that the Test does exist
					$this->set('test_id', $test_id);
					$multi = $this->Result->Test->find('first',
						array('conditions' => array('Test.id' => $test_id), 'recursive' => -1, 'fields' => array('Test.multival')));
					$this->set('testMultival',$multi);

						
						
						
					// Let's find out what Type (decimal,lookup,text etc) of test it is
					$this->set('type', $this->Result->Test->find('first', array(
						'conditions' => array('Test.id' => $test_id),
						'recursive'  => -1
					)));
					
					// Get all the options :
					$this->set('options', $this->Result->ResultValue->ResultLookup->find('all',
						array('conditions' => array('Test.id' => $test_id))));
					
					// Now get the data to send to the view to build the add results form
					//$tests = $this->Result->Test->find('list');
					//$patients = $this->Result->Patient->find('list');
					//$users = $this->Result->User->find('list');
					//$resultLookups = $this->Result->ResultValue->ResultLookup->find('list');
					
					//$this->set(compact('tests', 'patients', 'users', 'resultLookups'));
				} else {
					// Nope, the Test ID is not valid.
					$this->Session->setFlash('Not a valid test');
					// Go back to whence ye came...
					$this->redirect($this->referer());
				}
			}
		} else {
			$this->redirect('/');
		}
	}




	function edit($id = null) {
		$this->layout="default2";
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Result', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			//insert pid, user and test id
			$this->data = Set::insert($this->data, 'Result.user_id', $this->Auth->user('id'));
			//find if multival is enabled
			$multi = $this->Result->Test->find('first',
				array('conditions' => array('Test.id' => $this->data['Result']['test_id']), 'recursive' => -1, 
											'fields' => array('Test.multival')));
			
			$result_id = $this->data['Result']['id'];

			if($multi['Test']['multival']==TRUE){
				$i=0;
				$invalid=array();
				if(!empty($this->data['ResultValue']['value_lookup'])){//There are values to be stored(Not all unchecked)
					while($i<count($this->data['ResultValue']['value_lookup'])){//Loop over all the values we need to add
					
						if(!empty($this->data['ResultValue'][$i])){
							//As long as we have an existing databse record with an id we edit this record
						// If we run out of ids we will leave that field empty so a new row is added to the result_values table
							$this->data = Set::insert($this->data, 'ResultValue.'.$i.'.id',$this->data['ResultValue'][$i]['id'] );

						}
						// Insert data to be stored
						$this->data = Set::insert($this->data, 'ResultValue.'.$i.'.user_id', $this->Auth->user('id'));
						$this->data = Set::insert($this->data, 'ResultValue.'.$i.'.result_id', $result_id);
						$this->data = Set::insert($this->data, 'ResultValue.'.$i.'.value_lookup', $this->data['ResultValue']['value_lookup'][$i]);
						$this->Result->ResultValue->set(array('ResultValue'=>$this->data['ResultValue']['value_lookup'][$i]));
						if(!$this->Result->ResultValue->validates()){
							$invalid[$i]=$this->Result->ResultValue->validationErrors;
							unset($this->Result->ResultValue->validationErrors);
						}
						$i++;
					}
					while(!empty($this->data['ResultValue'][$i]['id'])){
						// If we have fewer values than existing ids, we delete the remaing rows in the database table
						$this->Result->ResultValue->del($this->data['ResultValue'][$i]['id']);
						unset($this->data['ResultValue'][$i]);

						$i++;	
					}
				
					unset($this->data['ResultValue']['value_lookup']);
				}else{
					unset($this->data['ResultValue']['value_lookup']);

					//All result values have been deselected so we delete the result.
				
					$this->Result->del($result_id);
					
					foreach( $this->data['ResultValue'] as $id){
						$this->Result->ResultValue->del($id['id']);
					}
					$this->Session->setFlash(__('All values deselected so result deleted', true));
					$this->redirect(array('controller' => 'patients', 'action' => 'view/' . $this->data['Result']['pid']));
				}
						
			}else{	//Only one value to edit
				$this->data = Set::insert($this->data, 'ResultValue.user_id', $this->Auth->user('id'));
				$this->data = Set::insert($this->data, 'ResultValue.result_id', $result_id);
				if(!empty($this->data['ResultValue']['value_lookup'])){
					$this->data = Set::insert($this->data, 'ResultValue.value_lookup', $this->data['ResultValue']['value_lookup'][0]);
				}
				$this->Result->ResultValue->set(array('ResultValue'=>$this->data['ResultValue']));
			
				if(!$this->Result->ResultValue->validates()){
					$invalid=$this->Result->ResultValue->validationErrors;
					unset($this->Result->ResultValue->validationErrors);
				}
			}
			


			if (empty($invalid)){
				//save
				$this->Result->save($this->data);
				if(array_key_exists(0,$this->data['ResultValue'])){//If we have multiple values to store!
					foreach($this->data['ResultValue'] as $val){
						if(!array_key_exists('id',$val)){
							$this->Result->ResultValue->create();
						}
						$this->Result->ResultValue->save(array('ResultValue'=>$val));
					}
				}else{
					$this->Result->ResultValue->save(array('ResultValue'=>$this->data['ResultValue']));
				}

				$this->Session->setFlash(__('The Result has been saved', true));
				
				$this->redirect(array('controller' => 'patients', 'action' => 'view/' . $this->data['Result']['pid']));
			}else{
				
				$this->Result->ResultValue->validationErrors=$invalid;
				$this->Session->setFlash(__('The Result could not be saved. Please, try again.', true));
				// Set up the form variables again for the reloaded view, as we've probably failed validation
				$test_id = $this->data['Result']['test_id'];
				$this->set('test_id', $test_id);
				$this->set('type', $this->Result->Test->find('first', array(
					'conditions' => array('Test.id' => $test_id),
					'recursive'  => -1
				)));
			}


	}
	// Set up nescesary info for the view
	$resultValues=$this->Result->ResultValue->find('all',array('conditions'=>array('ResultValue.result_id'=>$id)));
	$results=$this->Result->read(null,$id);
	$tests = $this->Result->Test->find('list');
	$patients = $this->Result->Patient->find('list');
	$users = $this->Result->User->find('list');
	$this->set(compact('tests','patients','users'));
	$this->set('resultValues',$resultValues);
	$this->set('results',$results);
	$multi = $this->Result->Test->find('first',
						array('conditions' => array('Test.id' => $results['Result']['test_id']), 'recursive' => -1, 'fields' => array('Test.multival')));
	$this->set('testMultival',$multi);
	
	$this->set('options', $this->Result->ResultValue->ResultLookup->find('all',
							 array('conditions' => array('Test.id' => $results['Result']['test_id']))));


	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Result', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Result->del($id)) {
			$resultValues=$this->Result->ResultValue->find('all',array('fields'=>'ResultValue.id',
										'conditions'=>array('ResultValue.result_id'=>$id)));
			foreach($resultValues as $val){
					$this->Result->ResultValue->del($val['ResultValue']['id']);
			}
			$this->Session->setFlash(__('Result deleted', true));
			$this->redirect($this->referer());
		}
	}

	
	function batch_add($pid){
		$this->Result->Patient->id = $pid;
		$this->set('pid', $pid);
		if(!$this->Result->Patient->exists()) {//Checking that patient exists
			$this->Session->setFlash('You tried to add results to a Patient that does not exist');
			$this->redirect($this->referer());
		}

		$patient=$this->Result->Patient->find('first',array('conditions'=>array('Patient.pid'=>$pid),'recurcive'=>-2,'fields'=>array('pid','surname','forenames','upn','sex')));
		$this->set('Patient',$patient);


		//The tests with the following ids are in the form
		$batchOfTestIDs = array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26);
			// Loop to pull the relevent info for each of our tests and put them in an array
		//If we have a mail patient we don't ask about pregnacy etc.	
		if($patient['Patient']['sex']=='Male'){
			unset($batchOfTestIDs[5],$batchOfTestIDs[6],$batchOfTestIDs[7]);
			$batchOfTestIDs=array_values($batchOfTestIDs);

		}
		$batchOfTestInfo = array();
		foreach($batchOfTestIDs as $test) {
			// Setup a temporary array for this loop
			$testInfo = array();
			// Set the Test ID
			$testInfo['test_id'] = $test;
			// Find out the Test type
			
			$t = $this->Result->Test->find('first',array('conditions'=>array('Test.id'=>$test),'recursive'=>-1));
			$testInfo['name']=$t['Test']['name'];	
			$testInfo['type']=$t['Test']['type'];
			$testInfo['multival']=$t['Test']['multival'];
			$testInfo['units']=$t['Test']['units'];
										
			// Get Test answers/options if required
			if($testInfo['type'] == 'lookup') {
				$opt=$this->Result->ResultValue->ResultLookup->find('all',array('conditions'=>array('Test.id'=>$test),'recursive'=>0));
				$options=array();
				foreach($opt as $o){
					$value=$o['ResultLookup']['value'];
					$id=$o['ResultLookup']['id'];
					$desc=$o['ResultLookup']['description'];
					$r=array_keys($o);
					$options[]=array('id'=>$id,'value'=>$value,'description'=>$desc);
				}
				$testInfo['options']=$options;				
			}
				// Add this temp array onto the main array we're building
			$batchOfTestInfo[] = $testInfo;
			unset($testInfo);
		}
			// Make our fresh array of test info available to the view
		$this->set('batchOfTests', $batchOfTestInfo);
				// Is this a new form i.e. is there data in our object?
		if (!empty($this->data)){
			//$contr used to determine if we are coming from the patients or results views
			list($i,$contr,$action,$pid)=explode('/',$this->referer());
			
		
				
			$tests=array();
			$data=$this->data;
			//Create an array with testid and type
			foreach($batchOfTestIDs as $test) {
				$t = $this->Result->Test->find('first',array('conditions'=>array('Test.id'=>$test),'recursive'=>-1));
				$tests[$test]=$t['Test']['type'];
			}
			//get dates 
			$date=array();
			$date[]=$data['Result'][0];
			if(count($data['Result'])>1){// If we are coming from the batch_add view , in the patient view only one date
				$date[]=$data['Result'][1];
				$date[]=$data['Result'][2];
				$date[]=$data['Result'][3];
			
				unset($data['Result'][1],$data['Result'][2],$data['Result'][3]);
			}
			unset($data['Result'][0]);
			
			$result_id=0;

			// loop through all the results and add any fields that have been filled out
		//	$counter=4;//Since The dates are the first 4 fields.
			//Arrays to store the data to be added and the validation errors
			$invalidResults=array();
			$invalidResultValues=array();
			$resultArray=array();
			$resultValueArray=array();//This will be an array of arrays
				
			foreach(array_keys($data['ResultValue']) as $counter){
				$result=$data['ResultValue'][$counter];
				//find test it by using the fact that there are 4 columns
				$test_id=$batchOfTestIDs[intval($counter/4) -1];
				//check that we have a value, so that we only add fields that are filled out
				if(!empty($result['value_'.$tests[$test_id]])){
					//get the data to add, $counter%  gives us the right date
					$value=$result['value_'.$tests[$test_id]];
					$d=$date[$counter % 4];
					//This is what we add to the result table
					$to_addRes=array('Result'=>array('pid'=>$pid,
									'test_id'=>$test_id,
									'test_performed'=>$d['test_performed'],
									//'requesting_clinician'=>$clin,
									'user_id'=>$this->Auth->user('id')
									));
					$this->Result->create();
					// Set an validate every field, and keep all validation errors
				        $this->Result->set($to_addRes);
					if($this->Result->validates()){
						
						
					} else {
						$invalidResults[$counter]=$this->Result->validationErrors;
						unset($this->Result->validationErrors);
					}
				
					$resultArray[]=$to_addRes;
					//Check if multiplevalues have been entered for one result
					if(!is_array($value)){
						//Single value
						$to_addResVal=array('ResultValue'=> array(
											'value_'.$tests[$test_id]=>$value,
											'user_id'=>$this->Auth->user('id')));
				
				

					
						// Set an validate every field, and keep all validation errors
				      	  	$this->Result->ResultValue->set($to_addResVal);
						if($this->Result->ResultValue->validates()){
						
							
						} else {
							$invalidResultValues[$counter]=$this->Result->ResultValue->validationErrors;
							unset($this->Result->ResultValue->validationErrors);
						}
				
						$resultValueArray[]=array($to_addResVal);
						
					}else{
						//multiple values for one result
						$one_result=array();
						
						//prepare all the resultValues that should be linked to one result
						foreach($value as $val){
							$to_addResVal=array('ResultValue'=> array(
											'value_'.$tests[$test_id]=>$val,
											'user_id'=>$this->Auth->user('id')));
							$one_result[]=$to_addResVal;
							}
						$resultValueArray[]=$one_result;
					}
					

					
				}
				
				//$counter++;
			}
			// If no validation problems save
			
			if (empty($invalidResults) and empty($invalidResultValues)){

				//Add attendance to all dates where we are adding results
				$dates=array();
				foreach($resultArray as $result)
				{
					if(!in_array($result['Result']['test_performed'], $dates))
					{
						$dates[]=$result['Result']['test_performed'];
					}
				}
				foreach($dates as $d){
					$resultArray[]=array('Result'=>array('pid'=>$pid,
										'test_id'=>1,
										'test_performed'=>$d,
										'user_id'=>$this->Auth->user('id')));
					$resultValueArray[]=array(array('ResultValue'=>array('value_lookup'=>2,'user_id'=>$this->Auth->user('id'))));
				}
					
				$counter=0;
				//If we are coming from the patients view we want to delete all the results from the same day
				//So if we already have a weight for a day and try to add another one we will just delete the old one
				if($contr=='patients'){
				
					$date=$date[0]['test_performed']['year'].'-'.$date[0]['test_performed']['month'].'-'.$date[0]['test_performed']['day'];
					$existing=$this->Result->find('all',array('fields'=>array('id','test_id'),
										'recursive'=>-1,

									'conditions'=>array('Result.test_performed'=>$date,'pid'=>$pid))); 
					}

				// Run through all the results we need to add
				while ($counter<count($resultValueArray)){
					if($contr=='patients'){//Deleting the values we don't want if coming from patients

						$testId=$resultArray[$counter]['Result']['test_id'];
						
						foreach($existing as $e){
							if($e['Result']['test_id']==$testId){
								$id=$e['Result']['id'];
								if ($this->Result->del($id)) {
									$resultValues=$this->Result->ResultValue->find('all',array('fields'=>'ResultValue.id',
										'conditions'=>array('ResultValue.result_id'=>$id)));
									foreach($resultValues as $val){
									$this->Result->ResultValue->del($val['ResultValue']['id']);
									}
								}

							}
						}

					}
					$this->Result->create();
					$this->Result->save($resultArray[$counter]);
					// Need the result_id so we can add the ResultValue to the correct result
					$id=$this->Result->id;
					foreach ($resultValueArray[$counter] as $value){
						$this->Result->ResultValue->create();
						$value = Set::insert($value, 'ResultValue.result_id', $id);
						$this->Result->ResultValue->save($value);
					}
					$counter++;
				}
	
				$this->Session->setFlash(__('The Results have been saved', true));
				$this->redirect(array('controller'=>'patients','action' => 'view/'.$pid));	
			}else{//If validation problems disply them.
				
				$this->Result->validationErrors = $invalidResults;
				$this->Result->ResultValue->validationErrors=$invalidResultValues;
				$this->Session->setFlash(__('The Results could not be saved', true));
				
			}		
		}


	}
	function add_attendance($pid=null){
    
   		$this->Result->Patient->id=$pid;
   		$this->set('pid',$pid);
    		if(!$this->Result->Patient->exists())
   		{
			$this->Session->setFlash('You tried to book in a patient that does not exist in this database.');
			$this->redirect($this->referer());
		}
   		$Result=array('Result'=>array('pid'=>$pid,'test_id'=>1,'user_id'=>$this->Auth->user('id'),'test_performed'=> date('Y-m-d',strtotime('now'))));
		
    		$this->Result->create();
   		if ($this->Result->save($Result)) 
    		{
			$result_id=$this->Result->id;
			$ResultValue=array('ResultValue'=>array('result_id'=>$result_id,'user_id'=>$this->Auth->user('id'),'value_lookup'=>1));
			$this->Result->ResultValue->create();
			
			if($this->Result->ResultValue->save($ResultValue)){
			

				$this->Session->setFlash(__('Patient booked in.', true));
				$this->redirect($this->referer());
			}
     		} else {
			$this->Session->setFlash(__('This patient could now be booked in. Please, try again.', true));
      		}  
	}


}
?>
