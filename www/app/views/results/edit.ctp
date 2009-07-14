<div class="breadcrumb">
	<?php echo $crumb->getHtml('Edit', null, 'auto'); ?>
</div>
<div class="results form span-16">
<?php echo $form->create('Result', array('action'=>'edit/'.$pid));?>
	<fieldset>
 		<legend><?php __('Edit Result for '.$type['Test']['name']);?></legend>
 		<p><strong>Test:</strong> <?php echo $type['Test']['name'];?><br/><strong>Description:</strong> <?php echo $type['Test']['description'];?></p>
	<?php
		//echo $form->input('pid');
		echo $form->input('test_id',array('type'=>'hidden','value'=>$test_id));
		switch($type['Test']['type']) {
  			case "decimal":
				echo $form->input('value_decimal', array('label'=>'Value','after'=>$type['Test']['units']));
        		break;
    		case "text":
        		echo $form->textarea('value_text');
        		break;
    		case "lookup":
        		echo $form->input('value_lookup', array('label'=>'Value'));
        		break;
       	}
		echo $form->input('test_performed', array('dateFormat' => 'DMY',
												'timeFormat' => 'none',
												'minYear' => date('Y') - 100,
												'maxYear' => date('Y')));
		echo $form->input('requesting_clinician');
		
	?>
	</fieldset>
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Add Patient
</button>
</div>