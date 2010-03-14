<?php $crumb->addThisPage('Batch Add Result', null, 'auto'); ?>
<div class="results form span-16">
<?php echo $form->create(null, array('action'=>'batch_add/'.$pid));?>
	<div class="bluebox span-22 last">
		<?php
		echo $html->tag('span', $Patient['Patient']['forenames'] . ' ' . $Patient['Patient']['surname'], array('class' => 'patientName'));
		echo $html->div('patientId', $html->tag('span', 'UPN: ', array('class'=>'patientIdLabel')) . $html->tag('span', $this->element('prettyUPN', array('pid' => $Patient['Patient']['upn'])), array('class'=>'patientIdValue')));
		echo $html->div('patientIdentifier span-6', $html->tag('span', 'PID: ', array('class'=>'patientIdentiferLabel')) . $html->tag('span', $this->element('prettyPID', array('pid' => $Patient['Patient']['pid'])), array('class'=>'patientIdentifierValue')));
		?>
	</div>
	<div class="span-22 last">
	<fieldset>
 		<legend><?php __('Batch Add Results');?></legend>
 		<table>
			<?php
				// Let Cake build the table headers for us
				echo $html->tableHeaders(
					array('Title','Batch 1','Batch 2','Batch 3','Batch 4')
				);
				// Setting up $cells to hold all the input fields we want
				$cells= array();
				// Adding the dates
				$cells[]=array('Date',
							$form->dateTime(
								'0.test_performed',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									false
								),
							$form->dateTime(
								'1.test_performed',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									false
								),
							$form->dateTime(
								'2.test_performed',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									false
								),
							$form->dateTime(
								'3.test_performed',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									false
								)
							);

				$counter=4;
				// Adding all the tests 5 times, using a new number for each test.	
				foreach($batchOfTests as $test){
					
					if($test['type']!='lookup'){
						// If not a lookup test we put the name and the textboxes into cells
						$t=array($test['name']);
						
						for($i=0;$i<4;$i++){
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
							$opt[$o['id']]=$o['description'];
						}
						for($i=0;$i<4;$i++){
							if($test['multival']==TRUE){
								$t[]=$form->input('ResultValue.'.$counter.'.value_lookup',array('label'=>'','options'=>$opt,'multiple'=>true));
							}else{
								$t[]=$form->input('ResultValue.'.$counter.'.value_lookup',array('label'=>'','options'=>$opt));
							}
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
	</div>
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/>Batch Add Results
</button>
</div>
 

