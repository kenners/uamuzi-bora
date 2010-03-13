<?php $crumb->addThisPage('Add Result', null, 'auto'); ?>
<div class="results form span-16">
<?php echo $form->create(null, array('url'=>'add/'.$pid));?>
	<fieldset>
 		<legend><?php __('Add Result for '.$type['Test']['name']);?></legend>
 		<p><strong>Test:</strong> <?php echo $type['Test']['name'];?><br/><strong>Description:</strong> <?php echo $type['Test']['description'];?></p>
	<?php
		//echo $form->input('pid');
		for($i=0;$i<3;$i++){
			echo $form->input('Result.test_id',array('type'=>'hidden','value'=>$test_id));
			switch($type['Test']['type']) {
  				case "decimal":
					echo $form->input('ResultValue.'.$i.'.value_decimal', array('label'=>'Value','after'=>$type['Test']['units']));
        			break;
    			case "text":
        			echo $form->textarea('ResultValue.'.$i.'.value_text');
	        		break;
    			case "lookup":
				$valueoptions=array();
					foreach ($options as $option)
					{
						$valueoptions[$option['ResultLookup']['id']] = $option['ResultLookup']['description'];
											                        
					}

					// Build the Select box
					echo $form->input('ResultValue.'.$i.'.value_lookup',array('type'=>'select','options'=>$valueoptions,'label'=>'Value:'));
								
        		
        			break;
       			}
		}
		echo $form->input('Result.test_performed', array('dateFormat' => 'DMY',
												'timeFormat' => 'none',
												'minYear' => date('Y') - 100,
												'maxYear' => date('Y')));
		echo $form->input('Result.requesting_clinician');
		
	?>
	</fieldset>
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Add Result
</button>
</div>

