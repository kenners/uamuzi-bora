<div class="breadcrumb">
	<?php echo $crumb->getHtml('Add Result', null, 'auto'); ?>
</div>
<div class="results form span-16">
<?php echo $form->create('Result', array('action'=>'add/'.$pid));?>
	<fieldset>
 		<legend><?php __('Add Result');?></legend>
	<?php
		//echo $form->input('pid');
		echo $form->input('test_id',array('type'=>'hidden','value'=>$test_id));
		echo $form->input('value_decimal');
		echo $form->input('value_text');
		echo $form->input('value_lookup');
		echo $form->input('test_performed');
		echo $form->input('requesting_clinician');
		
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('List Results', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
