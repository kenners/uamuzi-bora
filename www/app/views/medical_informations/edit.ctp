<div id="viewTitle" class="text-left">
<h1>Skeleton view for MedicalInformation::edit</h1>
</div>

<?php
echo $form->create('MedicalInformation', array('controller' => 'MedicalInformation', 'action' => 'edit'));

echo $form->inputs(array(
	'legend' => 'General',
	'patient_source_id',
	'funding_id'
	));

echo $form->inputs(array(
	'legend' => 'HIV positive information',
	'hiv_positive_date',
	'hiv_positive_test_location_id',
	'hiv_positive_clinic_start_date',
	'hiv_positive_who_stage' => array('type' => 'select', 'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4))
));

echo $form->inputs(array(
	'legend' => 'ART information',
	'art_naive',
	'art_service_type_id',
	'art_starting_regimen_id',
	'art_start_date',
	'art_eligibility_date',
	'art_indication_id'
));

echo $form->inputs(array(
	'legend' => 'Transfer information',
	'transfer_in_date',
	'transfer_in_district_id',
	'transfer_in_facility',
	'transfer_out_date',
	'transfer_out_event'
));

echo $form->end('Submit');
?>
