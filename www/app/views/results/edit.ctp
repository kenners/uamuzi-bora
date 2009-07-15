<?php $crumb->addThisPage('Edit', null, 'auto'); ?>
<div class="results form span-16">
<?php echo $form->create('Result');?>
	<fieldset>
 		<legend><?php __('Edit Result for '.$type['Test']['name']);?></legend>
 		<p><strong>Test:</strong> <?php echo $type['Test']['name'];?><br/><strong>Description:</strong> <?php echo $type['Test']['description'];?></p>
	<?php
		echo $form->input('pid',array('type'=>'hidden'));
		echo $form->input('test_id',array('type'=>'hidden'));
		switch($type['Test']['type']) {
  			case "decimal":
				echo $form->input('value_decimal', array('label'=>'Value','after'=>$type['Test']['units']));
        		break;
    		case "text":
        		echo $form->textarea('value_text');
        		break;
    		case "lookup":
        		$valueoptions=array();
			foreach ($options as $option)
				{
					$valueoptions[$option['ResultLookup']['id']] = $option['ResultLookup']['value'];
				}

				// Build the Select box
		       	echo $form->input('value_lookup',array('type'=>'select','options'=>$valueoptions,'label'=>'Value:'));

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
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Submit Changes
</button>
</div>