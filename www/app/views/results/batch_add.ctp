<?php $crumb->addThisPage('Batch Add Result', null, 'auto'); ?>
<div class="results form span-16">
<?php echo $form->create(null, array('action'=>'batch_add/'.$pid));?>
	<fieldset>
 		<legend><?php __('Batch Add Results');?></legend>
 		<table>
			<?php
 
				// Let Cake build the table headers for us
				echo $html->tableHeaders(
					array('Title','Set 1','Set 2','Set 3','Set 4','Set 5')
				);
				// Setting up $cells to hold all the input fields we want
				$cells= array();
				// Adding the dates
				$cells[]=array('Date',$form->input('0.test_performed', array('dateFormat' => 'DMY',
								'timeFormat' => 'none',
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'label'=>'',
								))
							,
							$form->input('1.test_performed', array('dateFormat' => 'DMY',
								'timeFormat' => 'none',
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'label'=>'',
								)),
							$form->input('2.test_performed', array('dateFormat' => 'DMY',
								'timeFormat' => 'none',
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'label'=>'',
								)),
							$form->input('3.test_performed', array('dateFormat' => 'DMY',
								'timeFormat' => 'none',
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'label'=>'',
								)),
							$form->input('4.test_performed', array('dateFormat' => 'DMY',
								'timeFormat' => 'none',
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
								'label'=> '',
								))
							);

				$counter=5;
				// Adding all the tests 5 times, using a new number for each test.		
				foreach($batchOfTests as $test){
					
					if ($test['type']!='lookup'){
						// If not a lookup test we put the name and the textboxes into cells
						$t=array($test['name']);
						
						for($i=0;$i<5;$i++){
						$t[]=$form->input('ResultValue.'.$counter.'.value_'.$test['type'],array('label'=>''));					
						$counter++;
						}
						$cells[]=$t;
					}else{
						// If we have a lookup test we add dropdown boxes with the options and a blank options in case 
						// that result is missing
						$t=array($test['name']);
						$opt=array(' ');
						foreach($test['options'] as $o){
							$opt[$o['id']]=$o['value'];
						}
						for($i=0;$i<5;$i++){
							$t[]=$form->input('ResultValue.'.$counter.'.value_lookup',array('label'=>'','options'=>$opt));
						$counter++;
						}
						$cells[]=$t;
					}

		
				}
	
				// Likewise, same again for the contents of the cells
				echo $html->tableCells($cells);
 
				
			?>
 		</table>
	</fieldset>
<?php

echo $form->input('requesting_clinician');
?>
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/>Batch Add Results
</button>
</div>
 

