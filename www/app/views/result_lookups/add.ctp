<div class="breadcrumb">
	<?php echo $crumb->getHtml('Add', null, 'auto'); ?>
</div>
<div class="resultLookups form">
<?php echo $form->create('ResultLookup');?>
	<fieldset>
 		<legend><?php __('Add ResultLookup');?></legend>
	<?php
		echo $form->input('test_id');
		echo $form->input('value');
		echo $form->input('description');
		echo $form->input('comment');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ResultLookups', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
