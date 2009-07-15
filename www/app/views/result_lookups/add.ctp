<?php $crumb->addThisPage('Add', null, 'auto'); ?>
<div class="resultLookups form span-16">
<?php echo $form->create('ResultLookup', array('action'=>'add/'.$test_id));?>
	<fieldset>
 		<legend><?php __('Add ResultLookup');?></legend>
	<?php
		echo $form->input('test_id',array('type'=>'hidden','value'=>$test_id));
		echo $form->input('value');
		echo $form->input('description');
		echo $form->input('comment');
	
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('List ResultLookups', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
