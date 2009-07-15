<div id="viewTitle" class="text-left">
<h1>Skeleton view for Patients::edit</h1>
</div>

<?php
echo $form->create('Patient', array('controller' => 'Patient', 'action' => 'edit'));

echo $form->inputs(array(
	'legend' => 'Identifiers',
	'upn',
	'arvid',
	'vfcc'
));

echo $form->inputs(array(
	'legend' => 'Basic Demographics',
	'surname',
	'forenames',
	'date_of_birth',
	'sex' => array('type'=>'select', 'options' => array('Unknown' => 'Unknown', 'Male' => 'Male', 'Female' => 'Female')),
	'mother',
	'occupation_id',
	'education_id',
	'marital_status_id',
	'telephone_number'
));

echo $form->inputs(array(
	'legend' => 'Location',
	'location_id',
	'village',
	'home',
	'nearest_church',
	'nearest_school',
	'nearest_health_centre',
	'nearest_major_landmark'
));

echo $form->inputs(array(
	'legend' => 'Treatment supporter',
	'treatment_supporter'
));

echo $form->end('Submit');


?>
