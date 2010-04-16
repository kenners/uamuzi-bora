<?php $crumb->addThisPage('Batch Add Result', null, 'auto'); ?>


<div id="patientBox" class="text-left span-22 last" style="margin-top:-20px">
	<div id="vitalInfo" class="vitalInfo span-15">
		<?php
		
		// Patient Name
		echo $html->tag('span', $Patient['Patient']['forenames'] . ' ' . $Patient['Patient']['surname'], array('class' => 'patientName'));
		
		echo $html->div('patientId span-14 last', $html->tag('span', 'UPN: ', array('class'=>'patientIdLabel')) . $html->tag('span', $this->element('prettyUPN', array('pid' => $Patient['Patient']['upn'])), array('class'=>'patientIdValue')));
	
		?>
	</div>


</div><?php echo $form->create(null, array('action'=>'batch_add/'.$pid));?>
	</div>	<div class="span-22 push-1">
	 <fieldset>		
 		<table>
			<?php
				// Let Cake build the table headers for us
				
				// Setting up $cells to hold all the input fields we want
				$cells= array();
				// Adding the dates
				$cells[]=array('<strong>Date</strong>',
							$form->dateTime(
								'Result.0.test_performed',
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
								'Result.1.test_performed',
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
								'Result.2.test_performed',
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
								'Result.3.test_performed',
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

						if(strlen($test['name'])>13 and  !empty($test['abbreviation'])){
							$name=$test['abbreviation'];
						

						}else{
						$name=$test['name'];
						} 

					$t=array('<strong>'.$name.'</strong>');
					if($test['type']!='lookup'){
						// If not a lookup test we put the name and the textboxes into cells
						
						
						for($i=0;$i<4;$i++){
						$t[]=$form->input('ResultValue.'.$counter.'.value_'.$test['type'],array('label'=>'', 'style'=>'width:210px'));					
						$counter++;
						}
						$cells[]=$t;
					}else{
						// If we have a lookup test we add dropdown boxes with the options and a blank options in case 
						// that result is missing
						
						$opt=array(' ');
						foreach($test['options'] as $o){
							$opt[$o['id']]=$o['description'];
						}
						for($i=0;$i<4;$i++){
							if($test['multival']==TRUE){
								$t[]=$form->input('ResultValue.'.$counter.'.value_lookup',array('label'=>'','options'=>$opt,'multiple'=>true,'style'=>'width:210px'));
							}else{
								$t[]=$form->input('ResultValue.'.$counter.'.value_lookup',array('label'=>'','options'=>$opt,'style'=>'width:210px'));
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
	
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/>Update Results
</button>
</div>|
