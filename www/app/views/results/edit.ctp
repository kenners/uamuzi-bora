<div class="results form">
<?php echo $form->create('Result');?>
	<fieldset>
 		<legend><?php __('Edit Result');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('pid');
		echo $form->input('test_id');
		echo $form->input('value_decimal');
		echo $form->input('value_text');
		echo $form->input('value_lookup');
		echo $form->input('test_performed');
		echo $form->input('requesting_clinician');
		echo $form->input('user_id');
		echo $form->input('archive_reason');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Result.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Result.id'))); ?></li>
		<li><?php echo $html->link(__('List Results', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
