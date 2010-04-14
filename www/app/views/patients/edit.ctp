<?php $crumb->addThisPage('Edit Patient Details', null, 'auto'); ?>

<div id="viewTitle" class="text-left span-16 push-1" >
<h2 style="margin-top:10px">COMPREHENSIVE CLINIC PATIENT CARD</h2>
</div>
<div class="span-21 pull-6" style="margin-top:30px">
<div class="span-10 text-left">
<?php
echo $form->create('Patient', array('controller' => 'Patient', 'action' => 'edit'));
echo $form->hidden('pid');
echo $form->inputs(array('legend' => 'Patient Profile',
						'upn'=>array('label'=>'New Unique Patient Number',
									'maxLength'=>13),
						'old_upn'=>array('label'=>'Old Unique Patient Number',
									'maxLength'=>20),
						'forenames'=>array('label'=>'Patient Forenames*'),
						'surname'=>array('label'=>'Patient Surname*'),
						'date_of_birth'=>array('label' => 'Date of Birth',
												'dateFormat' => 'DMY',
												'empty' => TRUE,
												'minYear' => date('Y') - 100,
												'maxYear' => date('Y')),
						'sex'=>array('type'=>'radio',
									'legend'=>FALSE,
									'before'=>'<strong>Sex </strong>',
									'options'=>array('Male'=>'Male', 'Female'=>'Female')),
						'telephone_number'=>array('maxLength'=>10, 'label'=>'Tel Contact'),
						'home'=>array('label'=>'Postal Address'),
						'location_id'=>array('label'=>'District/Location/Sub-Location'),
						'nearest_school',
						'nearest_health_centre'=>array('label'=>'Nearest H/Centre'),
						'marital_status_id'=>array('empty'=> '(Choose an Option)'),

						'arvid'=>array('type'=>'hidden'),
						'mother'=>array('type'=>'hidden'),
						'village'=>array('type'=>'hidden'),
						'nearest_church'=>array('type'=>'hidden'),
						'nearest_major_landmark'=>array('type'=>'hidden')
						));
// New fieldset for other patient identifiers
?>
</div>
<!-- New 'column' on other side of page -->
<div class="span-11 last text-left">
<?php	
echo $form->inputs(array('legend'=>'Treatment Supporter',
						'treatment_supporter_name'=>array('label'=>'Name'),
						'treatment_supporter_relationship'=>array('label'=>'Relationship'),
						'treatment_supporter_address'=>array('label'=>'Postal address'),
						'treatment_supporter_telephone_number'=>array('label'=>'Telephone number')));		
echo $form->inputs(array('legend' => 'VF Information',
						'vfcc'=>array('label'=>'Vestergaard Frandsen Client Code (VFCC)'),
						'vf_testing_site'=>array('empty' => '(Choose an Option)')));

// End the form
// Not using CakePHP's built-in functions to do this as we want prettified Blueprint buttons
//echo $form->end('Add');
?>
<!-- Pretty Blueprint submit button -->
<div class="span-5 prepend-3 append-3">
	<button type="submit" class="button positive">
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Update Record
	</button>
</div>
</form>
</div>
</div>
</div>
