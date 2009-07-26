<div id="viewTitle" class="text-left">
</div>
<div class="span-19">
	<h3 class="text-center">COMPREHENSIVE CLINIC PATIENT CARD</h3>

</div>
<div class="span-3 last text-right"><h3>MOH 257</h3></div>
<div>
<h4><strong>Patient:</strong> <?php echo $fullname;?></h4>
</div>
<?php echo $form->create('MedicalInformation', array('controller' => 'MedicalInformation', 'action' => 'edit'));?>
<div class="span-11 text-left">

<?php
$crumb->addThisPage('Edit Patient Medical Information', null, 'auto');
echo $form->hidden('pid');
echo $form->inputs(array(
	'legend' => 'Patient Source',
	'patient_source_id'=>array('label'=>'Entry Point','empty' => '(Choose an Option)'),
	'transfer_in_date' => array('label'=>'Transfer In Date',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'transfer_in_district_id' => array('label'=>'From District','empty' =>TRUE),
	'transfer_in_facility' => array('label'=>'Facility')
	));



echo $form->inputs(array(
	'legend' => 'ART History',
	'art_naive'=>array('type'=>'radio',
						'legend'=>FALSE,
						'before'=>'<strong>Previously on ARVs?</strong> ',
						'options'=>array(1=>'Yes',0=>'No'),
						'selected'=>FALSE
						),
	'hiv_positive_date' => array('label'=>'Date Confirmed HIV +',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),					
	'hiv_positive_test_location_id' => array('label'=>'Where?',
												'empty' => TRUE),
	'hiv_positive_clinic_start_date' => array('label'=>'Date Enrolled in HIV Care',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),											
	'hiv_positive_who_stage' => array('type' => 'select','label'=>'WHO Stage','empty' => TRUE, 'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4))));

?>


</div>
<div class="span-11 last text-left">
<?php

echo $form->inputs(array(
	'legend' => 'ARV Therapy',
	'art_eligibility_date'=>array('dateFormat' => 'DMY',
								'label'=>'Date Medically Eligible',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'art_indication_id'=>array('label'=>'Eligible thru.?','empty' => '(Choose an Option)'),							
	'art_start_date'=>array('dateFormat' => 'DMY',
								'label'=>'Date Started on 1st Line Regimen',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y')),
	'art_starting_regimen_id'=>array('label'=>'Regimen','empty' => '(Choose an Option)'),
	//'art_service_type_id'=>array('label'=>'ART Service Type','empty' => '(Choose an Option)'),
));

?>
<div class="span-5 prepend-3 append-3">
	<button type="submit" class="button positive">
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Submit Changes
	</button>
</div>
</form>
</div>