<?php $crumb->addThisPage('Batch Add Result', null, 'auto'); ?>
<div class="results form span-16">
<?php echo $form->create('Result', array('action'=>'batch_add/'.$pid));?>
	<fieldset>
 		<legend><?php __('Batch Add Results');?></legend>
 		<table>
			<?php
 
				// Let Cake build the table headers for us
				echo $html->tableHeaders(
					array('Title','Set 1','Set 2','Set 3','Set 4','Set 5')
				);
				//debug($batchOfTests);
			        $cells= array();
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
				foreach($batchOfTests as $test){
					//debug($test);
					if ($test['type']!='lookup'){
						$t=array($test['name']);
						
						for($i=0;$i<5;$i++){
						$t[]=$form->input('value',array('label'=>'','name'=>'data[Result]['.$counter.'][value]'));					
						$counter++;
						}
						$cells[]=$t;
					}else{
						$t=array($test['name']);
						$opt=array(' ');
						foreach($test['options'] as $o){
							$opt[$o['id']]=$o['value'];
						}
						for($i=0;$i<5;$i++){
							$t[]=$form->input('id',array('label'=>'','name'=>'data[Result]['.$counter.'][value]','options'=>$opt));
						$counter++;
						}
						$cells[]=$t;
					}

		
				}
	
				// Likewise, same again for the contents of the cells
				echo $html->tableCells($cells);
 
				// ARRAYS OF FIELDS BY TEST TO GO HERE
 
				//));
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
 

