<!--<div id="viewTitle" class="text-left">
<h1>View Patient's Record</h1>
</div>-->
<?php
$javascript->link('jquery.js', false);
$crumb->addThisPage('View Patient', null, 'auto'); ?>
<div id="patientBox" class="text-left span-22 last">
	<div id="vitalInfo" class="vitalInfo span-14">
		<?php
		$patient=$patients[0];
		// Patient Name
		echo $html->tag('span', $patient['Patient']['forenames'] . ' ' . $patient['Patient']['surname'], array('class' => 'patientName'));
		
		echo $html->div('patientId span-14 last', $html->tag('span', 'UPN: ', array('class'=>'patientIdLabel')) . $html->tag('span', $this->element('prettyUPN', array('pid' => $patient['Patient']['upn'])), array('class'=>'patientIdValue')));
	
		
		// Date of Birth
		echo $html->div('patientAge span-5', $html->tag('span', 'DoB: ', array('class'=>'patientAgeLabel')) . $html->tag('span', $this->element('prettyDate', array('date' => $patient['Patient']['date_of_birth'])), array('class'=>'patientAgeValue')));
		// Age (really really messy)
		if(!empty($patient['Patient']['year_of_birth']) && is_numeric($patient['Patient']['year_of_birth'])){
			$age = date('Y') - $patient['Patient']['year_of_birth'];
		}else{
			$age = 'Unknown';
		};
		echo $html->div('patientAge span-5', $html->tag('span', 'Age: ', array('class'=>'patientAgeLabel')) . $html->tag('span', $age, array('class'=>'patientAgeValue')));
		// Patient Status
		if(($patient['Patient']['status'] == FALSE)){
			$statusClass = 'patientAgeValue error';
		} else {
			$statusClass = 'patientAgeValue';
		}
		echo $html->div('patientAge span-4 last', $html->tag('span', 'Status: ', array('class'=>'patientAgeLabel')) . $html->tag('span', $this->element('prettyStatus', array('status' => $patient['Patient']['status'])), array('class'=>$statusClass)));
		?>
	</div>
	<div id="otherIdentifier" class="otherIdentifier span-6 last">
		<h3>Other Identifiers</h3>
		<?php
		echo $html->div('patientIdentifier span-6', $html->tag('span', 'PID: ', array('class'=>'patientIdentiferLabel')) . $html->tag('span', $this->element('prettyPID', array('pid' => $patient['Patient']['pid'])), array('class'=>'patientIdentifierValue')));
		echo $html->div('patientIdentifier span-6', $html->tag('span', 'VFCC: ', array('class'=>'patientIdentiferLabel')) . $html->tag('span', $patient['Patient']['vfcc'], array('class'=>'patientIdentifierValue')));
	?>
	</div>

</div>
<!-- Button toolbar -->
<div class="span-21 prepend-1 shove-top last">
	<div class="span-14">
		<div class="span-9">
			<div class="span-4 shove-top2">
				<h4>Create Result for Test:</h4>
			</div>
			<div class="span-5 shove-top last">
			<?php
				// Start the form ('FALSE' simply tells the controller that this form is not associated with any model)
				echo $form->create(FALSE, array('url' => '/results/add/'.$patient['Patient']['pid']));
				// Parse the array of Test & Test IDs sent by the controller into an array we can use to make
				// <SELECT> elements for our miniform.	
				$testoptions=array();
				foreach ($tests as $test)
				{
					$testoptions[$test['Test']['id']] = $test['Test']['name'];
				}
				// Build the Select box
				echo $form->input('id',array('type'=>'select',
					'options'=> $testoptions,
					'label'=>''));
			?>
			</div>
		</div>
		<div class="span-5 last">
			<button type="submit" class="button positive">
				<img src="/img/icons/add.png" alt=""/> Add New Result
			</button>
		</div>
	</div>
	<div class="span-5 pull-1 last">
		<a href="/results/batch_add/<?php echo $patient['Patient']['pid']; ?>" class="button positive">
			<img src="/img/icons/add.png" alt=""/> Batch Add Results</a>
	</div>
</div>

<div id="tab-set" class="span-22 prepend-top last">
		<ul class="tabs">
			<li><a href="#tab1" class="selected">Results</a></li>
			<li><a href="#tab2">Patient Profile</a></li>
			<li><a href="#tab3">ART History</a></li>
		</ul>
	
	<div id="tab1">
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
						$i=0;
						foreach($result['ResultValue'] as $value){
							echo $value['value_decimal']; 
							echo $result['Test']['units']; 
							echo $value['value_text']; 
							if(!empty($value['ResultLookup']['description'])){
								echo '<span class="multival">'.$value['ResultLookup']['description'].'</span>';
							}
							$i++;
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

	<div id="tab2">	
		<div class="tasks span-22 last">
			<div class="span-6">
				<h2>Patient Profile</h2>
			</div>
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
						Sex:
						<strong><?php if(!empty($patient['Patient']['sex'])){echo $patient['Patient']['sex'];} ?></strong>
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
				<div class="rimmer prepend-top">
					<h4>Status Info</h4>
					<div>
						Status: 
						<strong><?php echo $this->element('prettyStatus', array('status'=>$patient['Patient']['status'])); ?></strong>
					</div>
					<div>
						Status Last Changed: 
						<strong><?php if(!empty($patient['Patient']['status_timestamp'])){echo $this->element('prettyDate', array('date' => $patient['Patient']['status_timestamp']));} ?></strong>
					</div>
					<div>
						Status Reason: 
						<strong><?php if(!empty($patient['InactiveReason']['name'])){echo $patient['InactiveReason']['name'];} ?></strong>
					</div>	
				</div>
			</div>

			<div class="span-10 push-1 last rimmer">
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
	</div>
	<div id="tab3">
		<div class="tasks span-22 last">
			<div class="span-6">
				<h2>ART History</h2>
			</div>
			<div class="span-10 last">
				<a class="button" href="/medicalInformations/edit/<?php echo $patient['Patient']['pid']; ?>">Edit ART History</a>
			</div>
		</div>
		<div class="demographicInformation large span-22 last">
		<?php $medical_information = $medical_informations[0]; ?>
			<div class="span-9 rimmer">
				<h4>Patient Source</h4>
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
			</div>
			<div class="span-10 push-1 last rimmer">
				<h4>ARV Therapy</h4>
				<div>
					Date Medically Eligible: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['art_eligibility_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['art_eligibility_date']));} ?></strong>
				</div>				
				<div>
					Eligible Thru: 
					<strong><?php if(!empty($medical_information['ArtIndication']['name'])){echo $medical_information['ArtIndication']['name'];} ?></strong>
				</div>				
				<div>
					Date Started on 1st Line Regimen: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['art_start_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['art_start_date']));} ?></strong>
				</div>
				<div>
					ART Starting Regimen: 
					<strong><?php if(!empty($medical_information['art_starting_regimen']['name'])){echo $medical_information['art_starting_regimen']['name'];} ?></strong>
				</div>
			</div>
			<div class="span-9 rimmer">
				<h4>ART History</h4>	
				<div>
					Previously on ARVs (PMCT included)? </strong>
					<strong><?php if ($medical_information['MedicalInformation']['art_naive'] == TRUE || $medical_information['MedicalInformation']['art_naive'] == 1) {
								echo 'Yes';
							} else {
									echo 'No';
								} ?></strong>
				</div>
				<div>
					Date Confirmed HIV +: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['hiv_positive_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['hiv_positive_date']));} ?></strong>
				</div>	
				<div>
					HIV + Test Location: 
					<strong><?php if(!empty($medical_information['hiv_positive_test_location']['name'])){echo $medical_information['hiv_positive_test_location']['name'];} ?></strong>
				</div>	
				<div>
					Date Enrolled in HIV Care: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['hiv_positive_clinic_start_date'])){echo $this->element('prettyDate', array('date' => $medical_information['MedicalInformation']['hiv_positive_clinic_start_date']));} ?></strong>
				</div>	
				<div>
					WHO Stage on HIV+ Diagnosis: 
					<strong><?php if(!empty($medical_information['MedicalInformation']['hiv_positive_who_stage'])){echo $medical_information['MedicalInformation']['hiv_positive_who_stage'];} ?></strong>
				</div>	
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
	$("ul.tabs li.label").hide(); 
	$("#tab-set > div").hide(); 
	$("#tab-set > div").eq(0).show(); 
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
