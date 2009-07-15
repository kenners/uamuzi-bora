<div id="viewTitle" class="text-left">
<h1>Modify Patient Medical Information</h1>
</div>

<?php echo $form->create('MedicalInformation', array('controller' => 'MedicalInformation', 'action' => 'edit'));?>
<div class="span-11 text-left">

<?php
echo $form->inputs(array(
	'legend' => 'General',
	'patient_source_id'=>array('empty' => '(Choose an Option)'),
	'funding_id'=>array('empty' => '(Choose an Option)')
	));



echo $form->inputs(array(
	'legend' => 'ART information',
	'art_naive',
	'art_service_type_id'=>array('label'=>'ART Service Type','empty' => '(Choose an Option)'),
	'art_starting_regimen_id'=>array('label'=>'ART Starting Regimen','empty' => '(Choose an Option)'),
	'art_start_date'=>array('dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'art_eligibility_date'=>array('dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'art_indication_id'=>array('label'=>'ART Indication','empty' => '(Choose an Option)')
));

?>


</div>
<div class="span-11 last text-left">
<?php

echo $form->inputs(array(
	'legend' => 'HIV Status Information',
	'hiv_positive_date' => array('label'=>'HIV+ Test Date',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'hiv_positive_test_location_id' => array('label'=>'HIV+ Test Location'),
	'hiv_positive_clinic_start_date' => array('label'=>'HIV Clinic Start Date',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'hiv_positive_who_stage' => array('type' => 'select','label'=>'WHO Stage on HIV+ Diagnosis','empty' => TRUE, 'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4))
));

echo $form->inputs(array(
	'legend' => 'Transfer Information',
	'transfer_in_date' => array('label'=>'Transfer In Date',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'transfer_in_district_id' => array('empty' =>TRUE),
	'transfer_in_facility',
	'transfer_out_date' => array('label'=>'Transfer Out Date',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'))));
?>
<div class="span-5 prepend-3 append-3">
	<button type="submit" class="button positive">
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Submit Changes
	</button>
</div>
</form>
</div>