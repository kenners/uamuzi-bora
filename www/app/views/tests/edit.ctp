<div class="breadcrumb">
	<?php echo $crumb->getHtml('Edit', null, 'auto'); ?>
</div>

<div class="tests form span-16">
<?php echo $form->create('Test');?>
	<fieldset>
 		<legend><?php __('Edit Test');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('abbreiviation');
		echo $form->input('type');
		echo $form->input('description');
		echo $form->input('comment');
		echo $form->input('active');
		echo $form->input('archive_reason');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Test.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Test.id'))); ?></li>
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Result Lookups', true), array('controller'=> 'result_lookups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result Lookup', true), array('controller'=> 'result_lookups', 'action'=>'add')); ?> </li>
	</ul>
</div>