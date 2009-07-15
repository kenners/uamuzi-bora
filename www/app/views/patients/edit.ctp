<div class="patients form">
<?php echo $form->create('Patient', array('action' => 'edit')); ?>
	<fieldset>
 		<legend><?php __('Edit Patient');?></legend>
	<?php
		echo $form->input('pid');
		echo $form->input('upn');
		echo $form->input('arvid');
		echo $form->input('vfcc');
		echo $form->input('surname');
		echo $form->input('forenames');
		echo $form->input('date_of_birth');
		echo $form->input('year_of_birth');
		echo $form->input('sex');
		echo $form->input('mother');
		echo $form->input('occupation_id');
		echo $form->input('education_id');
		echo $form->input('marital_status_id');
		echo $form->input('telephone_number');
		echo $form->input('treatment_supporter');
		echo $form->input('location_id');
		echo $form->input('village');
		echo $form->input('home');
		echo $form->input('nearest_church');
		echo $form->input('nearest_school');
		echo $form->input('nearest_health_centre');
		echo $form->input('nearest_major_landmark');
		echo $form->input('vf_testing_site');
		echo $form->input('status');
		echo $form->input('inactive_reason_id');
		echo $form->input('status_timestamp');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
