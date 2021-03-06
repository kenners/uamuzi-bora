<!--<div id="viewTitle" class="text-left">
<h1>View Patient's Record</h1>
</div>-->

<?php

$javascript->link('jquery.js', false);
//logic to chose add multiple results as the selcted tab if user is in data group
$userinfo=$session->read('Auth.User');
if ($userinfo['group_id']==3){
	$class1=NULL;
	$class2='"selected"';
	$selected=4;
}else{
	$class2=NULL;
	$class1='"selected"';
	$selected=0;
}
?>

<div id="patientBox" class="text-left span-22 last" style="margin-top:-20px">
	<div id="vitalInfo" class="vitalInfo span-15">
		<?php
		$patient=$patients[0];
		// Patient Name
		echo $html->tag('span', $patient['Patient']['forenames'] . ' ' . $patient['Patient']['surname'], array('class' => 'patientName'));
		
		echo $html->div('patientId span-14 last', $html->tag('span', 'UPN: ', array('class'=>'patientIdLabel')) . $html->tag('span', $this->element('prettyUPN', array('pid' => $patient['Patient']['upn'])), array('class'=>'patientIdValue')));
	
		?>
	</div>


</div>


<div id="tab-set" class="span-22  last pull-6">
		<ul class="tabs">
			
			<li><a href="#tab1" class=<?php echo $class1;?>>Patient Profile</a></li>
			<li><a href="#tab2"> Medical Information</a></li>
			<li><a href="#tab3" >Results</a></li>
			<li><a href="#tab4">|</a></li>
			<li><a href="#tab5" class=<?php echo $class2;?>>Add Multiple Results</a></li>
			
		</ul>
	
	
	
		
		


	<div id="tab1">	
		<div class="tasks span-22 last">
			
			<div class="span-10 last">
				<a class="button" href="/patients/edit/<?php echo $patient['Patient']['pid']; ?>">Edit Patient Profile</a>
				<?php if ($patient['Patient']['status']) { ?>
			<a class="button negative" href="/patients/toggleStatus/<?php echo $patient['Patient']['pid']; ?>">Change Status to Inactive</a>
				<?php } else { ?>
				<a class="button positive" href="/patients/toggleStatus/<?php echo $patient['Patient']['pid']; ?>">Change Status to Active</a>
				<?php } ?>
		
			</div>
			
		</div>
		<div class="demographicInformation large span-22 last">

			<div class="span-9">
				<div class="rimmer">
					<h4>Patient Profile</h4>
					<div>
						Old UPN:
						<strong><?php if(!empty($patient['Patient']['old_upn'])){echo $patient['Patient']['old_upn'];} ?></strong>


					</div>
					<div>
						Sex:
						<strong><?php if(!empty($patient['Patient']['sex'])){echo $patient['Patient']['sex'];} ?></strong>


					</div>
					<div>
						Date of Birth:
						<strong><?php if(!empty($patient['Patient']['date_of_birth'])){echo $this->element('prettyDate', array('date' => $patient['Patient']['date_of_birth']));} ?></strong>


					</div>


					
					<div>
						Age:
						<strong>
<?php
		// Age (really really messy)
		if(!empty($patient['Patient']['year_of_birth']) && is_numeric($patient['Patient']['year_of_birth'])){
			$age = date('Y') - $patient['Patient']['year_of_birth'];
		}else{
			$age = 'Unknown';
		};
		echo  $age;
?>			
					</strong>
					</div>
					<div>
						Marital Status: 
						<strong><?php if(!empty($patient['MaritalStatus']['name'])){echo $patient['MaritalStatus']['name'];} ?></strong>
					</div>



					<div>
						Telephone Number: 
						<strong><?php if(!empty($patient['Patient']['telephone_number'])){echo $patient['Patient']['telephone_number'];} ?></strong>
					</div>
				</div>
				<div class="span-9  last rimmer">
					<h4>Location Information</h4>
					<div>
						Location: 
						<strong><?php if(!empty($patient['Location']['name'])){echo $patient['Location']['name'];} ?></strong>
					</div>
					<div>
						Village: 
						<strong><?php if(!empty($patient['Patient']['village'])){echo $patient['Patient']['village'];} ?></strong>
					</div>
					<div>
						Postal Address: <br/>
						<strong><?php if(!empty($patient['Patient']['home'])){echo $patient['Patient']['home'];} ?></strong>
					</div>
					<div>
						Nearest School: 
						<strong><?php if(!empty($patient['Patient']['nearest_school'])){echo $patient['Patient']['nearest_school'];} ?></strong>
					</div>
					<div>
						Nearest Health Centre: 
						<strong><?php if(!empty($patient['Patient']['nearest_health_centre'])){echo $patient['Patient']['nearest_health_centre'];} ?></strong>
					</div>

					<div>
					VF Testing Site: 
					<strong><?php if(!empty($patient['VfTestingSite']['site_name'])){echo $patient['VfTestingSite']['site_name'].' ('.$patient['VfTestingSite']['site_code'].')';} ?> </strong>
					</div>
				
				</div>
				</div>

				<div class="rimmer push-1 span-10">
					<h4>
					
						Status
						<strong><?php echo $this->element('prettyStatus', array('status'=>$patient['Patient']['status'])); ?></strong>
					
					
					</h4>
					<div>
						Date: 
						<strong><?php if(!empty($patient['Patient']['status_timestamp'])){echo $this->element('prettyDate', array('date' => $patient['Patient']['status_timestamp']));} ?></strong>
					</div>
					<div>
						Reason: 
						<strong><?php if(!empty($patient['InactiveReason']['name'])){echo $patient['InactiveReason']['name'];} ?></strong>
					</div>	
				</div>
			
			<div class="span-10 push-1 rimmer">
				<h4>Treatment Supporter</h4>
				<div>
					Name: 
					<strong><?php if(!empty($patient['Patient']['treatment_supporter_name'])){echo $patient['Patient']['treatment_supporter_name'];} ?></strong>
				</div>
				<div>
					Relationship 
					<strong><?php if(!empty($patient['Patient']['treatment_supporter_relationship'])){echo $patient['Patient']['treatment_supporter_relationship'];} ?></strong>
				</div>
				<div>
					Postal Address: 
					<strong><?php if(!empty($patient['Patient']['treatment_supporter_address'])){echo $patient['Patient']['treatment_supporter_address'];} ?></strong>
				</div>
					<div>
					Telephone Number: 
					<strong><?php if(!empty($patient['Patient']['treatment_supporter_telephone_number'])){echo $patient['Patient']['treatment_supporter_telephone_number'];} ?></strong>
				</div>
			

							
			</div>

		</div>
	</div>

	<div id="tab2">
		<div class="tasks span-22 last">
			<div class="span-10 last" >
				<a class="button" href="/medicalInformations/edit/<?php echo $patient['Patient']['pid']; ?>">Edit ART History</a>
			</div>
		</div>
		<div class="demographicInformation large span-22 last">
		<?php $medical_information = $medical_informations[0];
		?>	
			<div class="span-9 rimmer">
				
				<div>
					Entry Point: 
					<strong><?php if(!empty($medical_information['PatientSource']['name'])){echo $medical_information['PatientSource']['name'];} ?></strong>
				</div>
				<div>
					Transfer In Date: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['transfer_in_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['transfer_in_date']));} ?></strong>
				</div>
				<div>
					Transfer In District: 
					<strong><?php if(!empty($medical_information['transfer_in_district']['name'])){echo $medical_information['transfer_in_district']['name'];} ?></strong>
				</div>
				<div>
					Transfer In Facility: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['transfer_in_facility'])){echo $medical_information['MedicalInformation']['transfer_in_facility'];} ?></strong>
				</div>
			<div>
				Previously on ARVs? </strong>
					<strong><?php if ($medical_information['MedicalInformation']['art_naive'] == TRUE || $medical_information['MedicalInformation']['art_naive'] == 1) {
								echo 'Yes';
							} else {
									echo 'No';
								} ?></strong>
				</div>
				<div>
					Date Confirmed HIV+: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['hiv_positive_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['hiv_positive_date']));} ?></strong>
				</div>	
				<div>
					Where?
					<strong><?php if(!empty($medical_information['hiv_positive_test_location']['name'])){echo $medical_information['hiv_positive_test_location']['name'];} ?></strong>
				</div>	
				<div>
					Date Enrolled in HIV Care: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['hiv_positive_clinic_start_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['hiv_positive_clinic_start_date']));} ?></strong>
				</div>	
				<div>
					WHO Stage: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['hiv_positive_who_stage'])){echo $medical_information['MedicalInformation']['hiv_positive_who_stage'];} ?></strong>
				</div>	
				
				<div>
					Date PEP offered: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['date_pep_start'])){echo$this->element('prettyDate', array('date' =>  $medical_information['MedicalInformation']['date_pep_start']));} ?></strong>
				</div>	
				<div>
					Reason for PEP: 
					<strong><?php if(!empty($medical_information['PepReason']['name'])){echo $medical_information['PepReason']['name'];} ?></strong>
				</div>	
				<div>
					Any known Drug Allergies? 
					<strong><?php if(!empty($medical_information['MedicalInformation']['drug_allergies'])){echo $medical_information['MedicalInformation']['drug_allergies'];} ?></strong>
				</div>	
				<div>
					Date Medically Eligible: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['art_eligibility_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['art_eligibility_date']));} ?></strong>
				</div>				
				<div>
					Eligible Thru: 
					<strong><?php if(!empty($medical_information['ArtIndication']['name'])){echo $medical_information['ArtIndication']['name'];} 
	if($medical_information['ArtIndication']['id']==1){
	echo '  '.$medical_information['MedicalInformation']['art_eligible_who_stage'];
	}
	if($medical_information['ArtIndication']['id']==3){
	echo '  '.$medical_information['MedicalInformation']['art_eligible_cd4'].' /μl';
	}
	
	
	 ?></strong>
				</div>	
		
			</div>

			<div class="span-11 last rimmer">				
				<div>
					Date Started on 1st Line Regimen: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['art_first_start_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['art_first_start_date']));} ?></strong>
				</div>
				<div>
					Regimen: 
					<strong><?php foreach($medical_information['ArtRegimen'] as $i){
						if($i['art_line']==1){
							echo $regimens[$i['regimen_id']];}
						
						} ?></strong>
				</div>
				<div>
				Weight(kg) <strong><?php if(!empty($medical_information['MedicalInformation']['art_start_weight'])){echo $medical_information['MedicalInformation']['art_start_weight'];}?> </strong> Height(cm)<strong> <?php if(!empty($medical_information['MedicalInformation']['art_start_height'])){echo $medical_information['MedicalInformation']['art_start_height'];}?>  </strong> WHO stage: <strong> <?php if(!empty($medical_information['MedicalInformation']['art_start_who_stage'])){echo $medical_information['MedicalInformation']['art_start_who_stage'];}?> </strong> 
				</div>
				<div> Substitution of ARVs within 1st line Regimen
			<div style="font-size:0.8em">
				<table>
				<?php
					$cells=array();
					
					foreach($medical_information['ArtSubstitution'] as $i){
						if($i['art_line']==1){
							$cells[]=array($this->element('prettyDate', array('date' => $i['date'])),$regimens[$i['regimen_id']],$subReasons[$i['art_substitution_reason_id']]);
						}
					}
					echo $html->tableCells($cells);
				?>
				</table>
				</div>
				</div>

<div>
					Date Started on 2nd Line Regimen: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['art_second_start_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['art_second_start_date']));} ?></strong>
				</div>
				<div>
					Regimen: 
					<strong><?php foreach($medical_information['ArtRegimen'] as $i){
						if($i['art_line']==2){
							echo $regimens[$i['regimen_id']];}
						
						} ?></strong>
				</div>
				<div>
					Reason:
					<strong><?php if(!empty($medical_information['ArtSecondLineReason']['name'])){echo $medical_information['ArtSecondLineReason']['name'];} ?></strong>

			
				<div> Substitution of ARVs within 2nd line Regimen
				<div style="font-size:0.8em">
				<table>
				<?php
					$cells=array();
					
					foreach($medical_information['ArtSubstitution'] as $i){
						if($i['art_line']==2){
							$cells[]=array($this->element('prettyDate', array('date' => $i['date'])),$regimens[$i['regimen_id']],$subReasons[$i['art_substitution_reason_id']]);
						}
					}
					echo $html->tableCells($cells);
				?>
				</table>
				</div>
				</div>
				<div> ART Treatment Interruptions
				<div style="font-size:0.8em">

				<table>
				<?php
					$cells=array();
					
					foreach($medical_information['ArtInterruption'] as $i){
						$cells[]=array($this->element('prettyDate', array('date' => $i['interruption_date'])),$intReasons[$i['art_interruption_reason_id']],$this->element('prettyDate', array('date' => $i['restart_date'])));
						
					}
					echo $html->tableCells($cells);
				?>
				</table>
				</div>
				</div>
				</div>

				</div>
			</div>
	</div>

<div id="tab3">
	<!-- Button toolbar -->
	<?php echo $form->create(null, array('url'=>'/results/batch_add/'.$patients[0]['Patient']['pid']));?>
		
				
		<?php
		
		// All the tests we want to display

		$testIDs = array(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,26,28,25);
		if($patients[0]['Patient']['sex']=='Male'){//If paitent is male we don't show the pregnancy etc.
			unset($testIDs[5],$testIDs[6],$testIDs[7]);
		
		}
		
		//Create a table with the first column beeing inputs to add results and the rest of the coumns are previous results
		
		?>
		<div id="results" class="span-22 ">
			
			<table cellpadding="0" cellspacing="0" border="23" bordercolor="black">
				<tr>
					<th>Date</th>
					<td>
					<div style="width:230px;height:50px">
					<div style="margin:10px 0px 0 0px;float:left;position:relative;">

					<?php
						//input the date
						echo $form->dateTime(
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
								);
					?>
						</div>
						<div style="margin:5px 15px 0 -15px;float:right;position:relative;">
						<button type="submit" class="button positive">
							<img src="/img/icons/add.png" alt="" />
						</button>
						</div>
									
					</div>
					</td>
					
					<?php
					//display dates for all results
					
					foreach (array_keys($results) as $result):

					
					?>
				
				
					<th>
					<div style="width:90px">
					<?php
				
					echo date('j M y',strtotime($result));
						 ?>
					</div>
					</th>

					<?php endforeach; ?>
					</tr>
					<?php 
					//counter needed to add results
					$counter=4;
					$i=0;
					foreach($testIDs as $id):
						$class = null;
						if ($i++ % 2 == 0) {
						$class = ' class="even"';
						}
					?>
					<tr<?php echo $class;?>>
				
					
					<th>
						<?php
						 
						if(strlen($tests[$id]['name'])>13 and  !empty($tests[$id]['abbreviation'])){
							echo $tests[$id]['abbreviation'];
						}else{
						echo $tests[$id]['name'];
						} ?>
	
					</th>
					<td>
					<?php
					$test=$tests[$id];
								
					if($test['type']!='lookup'){
						// If not a lookup test we write the name and the textboxes 												
						
						echo $form->input('ResultValue.'.$counter.'.value_'.$test['type'],array('label'=>'','style'=>'width:210px'));												
						
						
						
					}else{
						// If we have a lookup test we add dropdown boxes with the options and a blank options in case 
						// that result is missing
						$opt=array(' ');
						foreach($test['options'] as $o){
							$opt[$o['id']]=$o['description'];
						}
						
							if($test['multival']==TRUE){
								$t=$form->input('ResultValue.'.$counter.'.value_lookup',array('label'=>'','options'=>$opt,'multiple'=>true,'style'=>'width:210px'));
							}else{
								$t=$form->input('ResultValue.'.$counter.'.value_lookup',array('label'=>'','options'=>$opt,'style'=>'width:210px'));
							}
							
						echo $t;
					}
				
					?>
					
					</td>	
						<?php foreach($results as $result): ?>
						<td>
					
							<?php
							if(array_key_exists($id,$result)){
								foreach($result[$id] as $value){
									echo $html->link(__($value['value_decimal'].' '.$test['units'], true), array('controller'=>'results', 'action'=>'edit', $value['result_id'])); 
									echo $html->link(__($value['value_text'], true), array('controller'=>'results', 'action'=>'edit', $value['result_id'])); 
									

									if(!empty($value['value_lookup'])){
										echo '<span class="multival" >';
											
									
										
										echo '<a href=/results/edit/'.$value['result_id'].' class="white" >'.$lookup[$value['value_lookup']-1]['ResultLookup']['description'].'</a>';			
										echo '</span>';

									}
									
								}
							}?>
						</td>
						<?php endforeach; ?>
					</tr>
					<?php
					$counter+=4;
					 endforeach; ?>
					
					</table>
		</div>
			
		<div class="span-5 push-3 last" style="margin-top:-20px">
		<button type="submit" class="button positive">
			<img src="/img/icons/add.png" alt=""/> Update Results
		</button>
		</div>
		</form>
	</div>
	<div id="tab4">

		<?php
		//Sets the update and indicator elements by DOM ID for AJAX pagination
		$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
		?>
		<div id="results" class="span-22 prepend-top last">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th><?php echo $paginator->sort('Result ID','id');?></th>
					<th><?php echo $paginator->sort('Test','test_id');?></th>
					<th>Result</th>
					<th><?php echo $paginator->sort('Test Date','test_performed');?></th>
					<th class="actions"><?php __('Actions');?></th>
				</tr>
				<?php
					$i = 0;
					$results=$patient['Result'];
					foreach ($results as $result):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="even"';
						
						}
				?>
				<tr<?php echo $class;?>>
					<td>
						<?php echo $result['id']; ?>
				
					</td>
					<td>
						<?php echo $html->link($result['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $result['Test']['id'])); ?>
					</td>
					<td>
					
						<?php
						
						foreach($result['ResultValue'] as $value){
							echo $value['value_decimal']; 
							echo $result['Test']['units']; 
							echo $value['value_text']; 
							if(!empty($value['ResultLookup']['description'])){
								echo '<span class="multival">'.$value['ResultLookup']['description'].'</span>';
							}
							
						}?>
					</td>
					<td>
						<?php echo $this->element('prettyDate', array('date' => $result['test_performed'])); ?>
					</td>
					<td class="actions">
						<!--<?php echo $html->link(__('View', true), array('controller'=>'results', 'action'=>'view', $result['id'])); ?>-->
						<?php echo $html->link(__('Edit', true), array('controller'=>'results', 'action'=>'edit', $result['id'])); ?>
						<?php echo $html->link(__('Delete', true), array('controller'=>'results', 'action'=>'delete', $result['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- Paginator links -->
		<div class="paging span-22 last">
			<?php echo $paginator->prev('<< Previous', null, null, array('class' => 'disabled'));?>
			 | 	<?php echo $paginator->numbers(); ?>
			 |  <?php echo $paginator->next('Next >>', null, null, array('class' => 'disabled'));?> 
		</div>
	</div>
	<div id="tab5">
	<div class="span-22 ">
	<?php echo $form->create(null, array('url'=>'/results/batch_add/'.$patients[0]['Patient']['pid']));?>
 		
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
				foreach($testIDs as $id){

						if(strlen($tests[$id]['name'])>13 and  !empty($tests[$id]['abbreviation'])){
							$name=$tests[$id]['abbreviation'];
						

						}else{
						$name=$tests[$id]['name'];
						} 

					$t=array('<strong>'.$name.'</strong>');
					if($tests[$id]['type']!='lookup'){
						// If not a lookup test we put the name and the textboxes into cells
						
						
						for($i=0;$i<4;$i++){
						$t[]=$form->input('ResultValue.'.$counter.'.value_'.$tests[$id]['type'],array('label'=>'', 'style'=>'width:210px'));					
						$counter++;
						}
						$cells[]=$t;
					}else{
						// If we have a lookup test we add dropdown boxes with the options and a blank options in case 
						// that result is missing
						
						$opt=array(' ');
						foreach($tests[$id]['options'] as $o){
							$opt[$o['id']]=$o['description'];
						}
						for($i=0;$i<4;$i++){
							if($tests[$id]['multival']==TRUE){
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
	
	</div>
<div class="push-3" style="margin-top:-20px">
<button type="submit" class="button positive">
	<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/>Update Results
</button>
</div
</div>


	</div>


</div>
<script type="text/javascript">

	$("ul.tabs li.label").hide(); 
	$("#tab-set > div").hide(); 
	$("#tab-set > div").eq(<?php echo $selected;?>).show(); 
	$("ul.tabs a").click( 
		function() { 
 			$("ul.tabs a.selected").removeClass('selected'); 
  			$("#tab-set > div").hide();
  			$(""+$(this).attr("href")).fadeIn('slow'); 
  			$(this).addClass('selected'); 
			return false;
			}
	);


</script>
