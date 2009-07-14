<?php $crumb->addThisPage('Add Patient', null, 'auto'); ?>
<div id="viewTitle" class="text-left">
<h1>Add New Patient</h1>
</div>
<p>To add a new patient to the database, please complete the details below.</p>
<p><strong>Surname</strong> and <strong>Forenames</strong> are Required Fields (i.e. you must provide values for them).</p>

<div class="span-11 text-left">
<?php
echo $form->create('Patient');
echo $form->inputs(array('legend' => 'Basic Demographics',
						'surname'=>array('label'=>'Surname*'),
						'forenames'=>array('label'=>'Forenames*'),
						'date_of_birth'=>array('label' => 'Date of Birth',
												'dateFormat' => 'DMY',
												'empty' => TRUE,
												'minYear' => date('Y') - 100,
												'maxYear' => date('Y')),
						'sex'=>array('type'=>'select',
									'options'=>array('Unknown'=>'Unknown', 'Male'=>'Male', 'Female'=>'Female'),
									'selected'=>'Unknown'),
						'mother',
						'occupation_id'=>array('empty' => '(Choose an Option)'),
						'education_id'=>array('empty' => '(Choose an Option)'),
						'marital_status_id'=>array('empty'=> '(Choose an Option)'),
						'telephone_number'=>array('maxLength'=>10)
						));
// New fieldset for other patient identifiers
echo $form->inputs(array('legend' => 'Other Patient Identification Codes',
						'upn'=>array('label'=>'CCCP Form Unique Patient Number',
									'maxLength'=>11)));
?>
</div>
<!-- New 'column' on other side of page -->
<div class="span-11 last text-left">
<?php			
echo $form->inputs(array('legend' => 'Location Information',
						'location_id',
						'village',
						'home',
						'nearest_church',
						'nearest_school',
						'nearest_health_centre',
						'nearest_major_landmark'));
echo $form->inputs(array('legend' => 'Treatment Supporter',
						'treatment_supporter_name' => array('type'=>'text',
															'label'=>'Name'),
						'treatment_supporter_address' => array('type'=>'text',
															'label'=>'Address'),
						'treatment_supporter_relationship' => array('type'=>'text',
															'label'=>'Relationship'),
						'treatment_supporter_telephone' => array('type'=>'text',
															'label'=>'Telephone Number')));
// End the form
// Not using CakePHP's built-in functions to do this as we want prettified Blueprint buttons
//echo $form->end('Add');
?>
<!-- Pretty Blueprint submit button -->
<div class="span-5 prepend-3 append-3">
	<button type="submit" class="button positive">
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Add Patient
	</button>
</div>
</form>
</div>
