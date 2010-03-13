<?php $crumb->addThisPage('Edit Result', null, 'auto');
?>
<div class="results form span-16">
<?php echo $form->create(null, array('url'=>'edit/'.$results['Result']['id']));?>
	<fieldset>
 		<legend><?php __('Edit Result for '.$results['Test']['name']);?></legend>
 		<p><strong>Test:</strong> <?php echo $results['Test']['name'];?><br/><strong>Description:</strong> <?php echo $results['Test']['description'];?></p>
	<?php
		//echo $form->input('pid');
		echo $form->input('Result.test_id',array('type'=>'hidden','value'=>$results['Test']['id']));
		echo $form->input('Result.pid',array('type'=>'hidden','default'=>$results['Result']['pid']));
		
		$counter=0;
		foreach($results['ResultValue'] as $resultValue){
			echo ' Result value '.($counter+1).' :';
			echo $form->input('ResultValue.'.$counter.'.result_id',array('type'=>'hidden','default'=>$resultValue['result_id']));
			echo $form->input('ResultValue.'.$counter.'.id',array('type'=>'hidden','default'=>$resultValue['id']));

			switch($results['Test']['type']) {
  				case "decimal":
					echo $form->input('ResultValue.'.$counter.'.value_decimal', array('label'=>'Value',
													'after'=>$results['Test']['units'],
													'default'=>$resultValue['value_decimal']));
        			break;
    			case "text":
        			echo $form->textarea('ResultValue.'.$counter.'.value_text',array('default'=>$resultValue['value_text']));

	        		break;
    			case "lookup":
				$valueoptions=array();
					foreach ($options as $option)
					{
						$valueoptions[$option['ResultLookup']['id']] = $option['ResultLookup']['description'];
											                        
					}

						// Build the Select box
					echo $form->input('ResultValue.'.$counter.'.value_lookup',array('type'=>'select',
												'default'=>$resultValue['value_lookup']
												,'options'=>$valueoptions,
												'label'=>'Value:'));
								
        		
        			break;
       			}
			$counter++;
		}
		echo $form->input('Result.test_performed', array('dateFormat' => 'DMY',
												'timeFormat' => 'none',
												'minYear' => date('Y') - 100,
												'maxYear' => date('Y')));
		echo $form->input('Result.requesting_clinician',array('default'=>$results['Result']['requesting_clinician']));
		
	?>
	</fieldset>
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Add Result
</button>
</div>

