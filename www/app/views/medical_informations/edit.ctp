
<div id="viewTitle" class="text-left span-16 push-1" >
<h2 style="margin-top:10px">COMPREHENSIVE CLINIC PATIENT CARD</h2>
<?php echo $form->create(null, array('controller' => 'MedicalInformation', 'action' => 'edit'));?>
</div>
<div class="span-23 pull-6" style="margin-top:30px;">
<div class="span-8 text-left">

<?php
echo $form->hidden('pid');
echo $form->inputs(array(
	'legend' => 'Patient Source',
	'MedicalInformation.patient_source_id'=>array('label'=>'Entry Point','empty' => '(Choose an Option)'),
	'MedicalInformation.transfer_in_date' => array('label'=>'Transfer In Date',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'monthNames' => false ),
	'MedicalInformation.transfer_in_district_id' => array('label'=>'From District','empty' =>TRUE),
	'MedicalInformation.transfer_in_facility' => array('label'=>'Facility')
	));



echo $form->inputs(array(
	'legend' => 'ART History',
	'MedicalInformation.art_naive'=>array('type'=>'radio',
						'legend'=>FALSE,
						'before'=>'<strong>Previously on ARVs?</strong> ',
						'options'=>array(1=>'Yes',0=>'No'),
						'selected'=>FALSE
						),
	'MedicalInformation.hiv_positive_date' => array('label'=>'Date HIV+',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'monthNames' => false ),					
	'MedicalInformation.hiv_positive_test_location_id' => array('label'=>'Where?',
												'empty' => TRUE),
	'MedicalInformation.hiv_positive_clinic_start_date' => array('label'=>'Date Enrolled',
								'dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'monthNames' => false),											
	'MedicalInformation.hiv_positive_who_stage' => array('type' => 'select','label'=>'WHO Stage','empty' => TRUE, 'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4)),
	'MedicalInformation.date_pep_start'=>array('label'=>'Date PEP offered','dateFormat' => 'DMY',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'monthNames' => false ),
	'MedicalInformation.pep_reason_id'=>array('label'=>'Reason for PEP', 'empty'=>'Choose an option'),
	'MedicalInformation.drug_allergies'=>array('label'=>'Drug allergies')
	));


?>
<?php

echo $form->inputs(array(
	'legend' => 'ARV Therapy',
	'MedicalInformation.art_eligibility_date'=>array('dateFormat' => 'DMY',
								'label'=>'Medically Eligible',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'monthNames'=>false),
	'MedicalInformation.art_indication_id'=>array('label'=>'Eligible thru.?','empty' => '(Choose an Option)'),
	'MedicalInformation.art_eligible_who_stage'=> array('type' => 'select','label'=>'WHO Stage','empty' => TRUE, 'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4)),
	'MedicalInformation.art_eligible_cd4'=>array('label'=>'CD4 Count')));

		

	//'MedicalInformation.art_service_type_id'=>array('label'=>'ART Service Type','empty' => '(Choose an Option)'),


?>

</div>
<div class="span-15 last text-left">
<?php
echo $form->inputs(array('legend'=>'1st Line Regimen',					
	'MedicalInformation.art_first_start_date'=>array('dateFormat' => 'DMY',
								'label'=>'Date Started',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'monthNames' => false),
	'ArtRegimen.0.regimen_id'=>array('label'=>'Regimen','empty' => '(Choose an Option)'),
	'ArtRegimen.0.art_line'=>array('type'=>'hidden','default' => 1),
	'ArtRegimen.0.id'=>array('type'=>'hidden'),	
	'MedicalInformation.art_start_weight'=>array('label'=>'Weight','style'=>'width:40px'),
	'MedicalInformation.art_start_height'=>array('label'=>'Height','style'=>'width:40px' ),
	'MedicalInformation.art_start_who_stage'=>array('type' => 'select','label'=>' WHO Stage','empty' => TRUE, 'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4))));
?>

<p>Substitutions of ARV's within 1st Line Regimen</p>
<table>
<?php
	$cells=array();
	$cells[]=array('Date','Regimen','Reason','');
	for($i=0;$i<2;$i++){
		$cells[]=array($form->dateTime(
								'ArtSubstitution.'.$i.'.date',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									true
								),
							
		$form->input('ArtSubstitution.'.$i.'.regimen_id',array('label'=>'','empty' => '(Choose an Option)','style'=>'width:150px')),
		$form->input('ArtSubstitution.'.$i.'.art_substitution_reason_id',array('label'=>'','empty' => '(Choose an Option)','style'=>'width:150px')),
		$form->input('ArtSubstitution.'.$i.'.id',array('type'=>'hidden')),

		$form->input('ArtSubstitution.'.$i.'.art_line',array('label'=>'','type'=>'hidden','default'=>1)));

	}
	echo $html->tableCells($cells);
	
?>

</table>

<?php
echo $form->inputs(array('legend'=>'2nd Line Regimen','MedicalInformation.art_second_start_date'=>array('dateFormat' => 'DMY',
								'label'=>'Date Started ',
								'empty' => TRUE,
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'monthNames' => false),
	'ArtRegimen.1.regimen_id'=>array('label'=>'Regimen','empty' => '(Choose an Option)'),
	'ArtRegimen.1.art_line'=>array('type'=>'hidden','default' => 2),
	'ArtRegimen.1.id'=>array('type'=>'hidden'),	
	'MedicalInformation.art_second_line_reason_id'=>array('label'=>'Reason','empty' => '(Choose an Option)')));

?>

<p>Substitutions of ARV's within 2nd Line Regimen</p>
<table>
<?php
	$cells=array();
	$cells[]=array('Date','Regimen','Reason','');
	for($i=2;$i<4;$i++){
		$cells[]=array($form->dateTime(
								'ArtSubstitution.'.$i.'.date',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									true
								),
		$form->input('ArtSubstitution.'.$i.'.regimen_id',array('label'=>'','empty' => '(Choose an Option)','style'=>'width:150px')),
		$form->input('ArtSubstitution.'.$i.'.art_substitution_reason_id',array('label'=>'','empty' => '(Choose an Option)','style'=>'width:150px')),
		$form->input('ArtSubstitution.'.$i.'.id',array('type'=>'hidden')),
		$form->input('ArtSubstitution.'.$i.'.art_line',array('label'=>'','type'=>'hidden','default'=>2)));
			
	}
	echo $html->tableCells($cells);
?>
</table>

<p>ART Treatment Interruptions</p>
<table>
<?php
	$cells=array();
	$cells[]=array('Dates','Reason for interruption','Date restarted');
	for($i=0;$i<3;$i++){
		$cells[]=array($form->dateTime(
								'ArtInterruption.'.$i.'.interruption_date',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									true
								),
		$form->input('ArtInterruption.'.$i.'.art_interruption_reason_id',array('label'=>'','empty' => '(Choose an Option)','style'=>'width:170px')),
		$form->input('ArtInterruption.'.$i.'.id',array('type'=>'hidden')),
		$form->dateTime(
								'ArtInterruption.'.$i.'.restart_date',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									true
								));

	}
	echo $html->tableCells($cells);
?>
</table>


<div class="span-5 prepend-3 append-3">
	<button type="submit" class="button positive">
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Update Record
	</button>
</div>
</form>
</div>
</div>
</div>
