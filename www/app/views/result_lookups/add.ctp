<?php $crumb->addThisPage('Add Test Result Option', null, 'auto'); ?>
<div class="resultLookups form span-16">
<?php echo $form->create('ResultLookup', array('action'=>'add/'.$test_id));?>
	<fieldset>
 		<legend><?php __('Add Test Result Option');?></legend>
	<?php
		echo $form->input('test_id',array('type'=>'hidden','value'=>$test_id));
		echo $form->input('value',array('after'=>'<br/><em>This is the value that is stored in the database and is <strong>not</strong> displayed to the user e.g. "a"</em>'));
		echo $form->input('description',array('after'=>'<br/><em>The description <strong>is</strong> displayed to the user - it is a human-friendly representation of the value e.g. "Option A"</em>'));
		echo $form->input('comment',array('after'=>'<br/><em>This is never displayed to normal users, and is only visible to admin users editing the test.</em>'));
	
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
	</ul>
</div>
