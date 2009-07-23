<?php $crumb->addThisPage('Edit Patient Details', null, 'auto'); ?>
<div id="viewTitle" class="text-left">
</div>		
<div class="span-19">
	<h3 class="text-center">COMPREHENSIVE CLINIC PATIENT CARD</h3>

</div>
<div class="span-3 last text-right"><h3>MOH 257</h3></div>
<h4><strong>Patient:</strong> <?php echo $fullname;?></h4>
<div class="span-11 text-left">
<?php
echo $form->create('Patient', array('controller' => 'Patient', 'action' => 'edit'));
echo $form->hidden('pid');
echo $form->inputs(array('legend' => 'Patient Profile',
						'upn'=>array('label'=>'Unique Patient Number',
									'maxLength'=>11),
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
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Modify Patient Details
	</button>
</div>
</form>
</div>

