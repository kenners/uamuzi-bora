<?php $crumb->addThisPage('Add Patient', null, 'auto'); ?>
<div id="viewTitle" class="text-left">
<h1>Add New Patient</h1>
</div>
<div class="span-19">
	<h3 class="text-center">COMPREHENSIVE CLINIC PATIENT CARD</h3>

</div>
<div class="span-3 last text-right"><h3>MOH 257</h3></div>
<!--
<p>To add a new patient to the database, please complete the details below. You can <?php echo $html->link('Search', array('action'=>'search')); ?> or <?php echo $html->link('Browse', array('action'=>'index')); ?> to check that this patient doesn't already have a record in the database. <strong>Surname</strong> and <strong>Forenames</strong> are Required Fields (i.e. you must provide values for them).</p>-->

<div class="span-11 text-left">
<?php
echo $form->create('Patient', array('action' => 'add'));
echo $form->inputs(array('legend' => 'Patient Profile',
						'upn'=>array('label'=>'Unique Patient Number',
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
									'options'=>array('Male'=>'Male', 'Female'=>'Female'),
									'selected'=>FALSE),
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
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Add Patient
	</button>
</div>
</form>
</div>
