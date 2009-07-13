<div class="breadcrumb">
	<?php echo $crumb->getHtml('Add', null, 'auto'); ?>
</div>
<div class="tests form">
<?php echo $form->create('Test');?>
	<fieldset>
 		<legend><?php __('Add Test');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('abbreiviation');
		echo $form->input('type');
		echo $form->input('upper_limit');
		echo $form->input('lower_limit');
		echo $form->input('description');
		echo $form->input('comment');
		echo $form->input('active');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Result Lookups', true), array('controller'=> 'result_lookups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result Lookup', true), array('controller'=> 'result_lookups', 'action'=>'add')); ?> </li>
	</ul>
</div>
