<div class="breadcrumb">
	<?php echo $crumb->getHtml('Add', null, 'auto'); ?>
</div>
<div id="viewTitle" class="text-left">
<h1>Add New Patient</h1>
</div>
<p>To add a new patient to the database, please complete the details below.</p>
<p>Required information is marked by an asterisk (*).</p>

<div class="span-11 text-left">
<?php
echo $form->create('Patient');
echo $form->inputs(array('legend' => 'Basic Demographics',
						'surname'=>array('label'=>'Surname*'),
						'forenames'=>array('label'=>'Forenames*'),
						'date_of_birth'=>array('label' => 'Date of Birth*',
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
</div>
