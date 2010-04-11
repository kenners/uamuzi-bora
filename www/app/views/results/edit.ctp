<?php $crumb->addThisPage('Edit Result', null, 'auto'); ?>
<div class="results form span-16">
<?php echo $form->create(null, array('url'=>'edit/'.$results['Result']['id']));?>
	<fieldset>
 		<legend><?php __('Edit Result for '.$results['Test']['name']);?></legend>
 		<p><strong>Test:</strong> <?php echo $results['Test']['name'];?><br/><strong>Description:</strong> <?php echo $results['Test']['description'];?></p>
	<?php
		echo $form->input('Result.test_id',array('type'=>'hidden','value'=>$results['Test']['id']));
		echo $form->input('Result.pid',array('type'=>'hidden','default'=>$results['Result']['pid']));
		echo $form->input('Result.id',array('type'=>'hidden','default'=>$results['Result']['id']));
			switch($results['Test']['type']) {
  				case "decimal":
					echo $form->input('ResultValue.id',array('type'=>'hidden','value'=>$results['ResultValue'][0]['id']));
					echo $form->input('ResultValue.value_decimal', array('label'=>'Value',
													'after'=>$results['Test']['units'],
													'default'=>$resultValues[0]['ResultValue']['value_decimal']));
        			break;
    			case "text":
				echo $form->input('ResultValue.id',array('type'=>'hidden','value'=>$results['ResultValue'][0]['id']));

        			echo $form->textarea('ResultValue.value_text',array('default'=>$resultValues[0]['ResultValue']['value_text']));

	        		break;
    			case "lookup":
			
				
				$valueoptions=array();
					foreach ($options as $option)
					{
						$valueoptions[$option['ResultLookup']['id']] = $option['ResultLookup']['description'];
											                        
					}

						// Build the Select box	
					$counter=0;					
					if($testMultival['Test']['multival'] == TRUE){
						foreach($results['ResultValue'] as $resultid){
							$selectedOptions[] = $resultid['value_lookup'];
						echo $form->input('ResultValue.'.$counter.'.id',array('type'=>'hidden','value'=>$results['ResultValue'][$counter]['id']));
						
					$counter++;}

				
					echo $form->input('ResultValue.value_lookup',array('type'=>'select','options'=>$valueoptions, 'multiple'=>'checkbox', 'selected' => $selectedOptions, 'label'=>'Value:'));
						}else{
						echo $form->input('ResultValue.id',array('type'=>'hidden','value'=>$results['ResultValue'][0]['id']));
						echo $form->input('ResultValue.value_lookup',array('type'=>'select','options'=>$valueoptions, 'multiple'=>false,'label'=>'Value:', 'selected'=>$results['ResultValue'][0]['value_lookup']));
					}					
								
        		
        			break;
       			}
	
		echo $form->input('Result.test_performed',array('label' => 'Test Performed',
												'dateFormat' => 'DMY',
												'timeFormat' =>'empty',	
												'minYear' => date('Y') - 100,
												'maxYear' => date('Y'),
												'selected'=>$results['Result']['test_performed']));	
		echo $form->input('Result.requesting_clinician',array('default'=>$results['Result']['requesting_clinician']));
		
	?>
	</fieldset>
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Add Result
</button>
</div>

