<?php echo $crumb->getHtml('Edit Test', null, 'auto'); ?>
<div class="tests form span-16">
<?php echo $form->create('Test');?>
	<fieldset>
 		<legend><?php __('Edit Test');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('abbreiviation');
		echo $form->input('type', array('type'=>'hidden'));
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
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index'));?></li>
	</ul>
</div>