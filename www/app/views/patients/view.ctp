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
		
		echo $html->div('patientId span-14 last', $html->tag('span', 'Patient ID: ', array('class'=>'patientIdLabel')) . $html->tag('span', $this->element('prettyPID', array('pid' => $patient['Patient']['pid'])), array('class'=>'patientIdValue')));
	
		
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
		echo $html->div('patientIdentifier span-6', $html->tag('span', 'CCCP UPN: ', array('class'=>'patientIdentiferLabel')) . $html->tag('span', $patient['Patient']['upn'], array('class'=>'patientIdentifierValue')));
		echo $html->div('patientIdentifier span-6', $html->tag('span', 'ARVID: ', array('class'=>'patientIdentiferLabel')) . $html->tag('span', $patient['Patient']['arvid'], array('class'=>'patientIdentifierValue')));
		echo $html->div('patientIdentifier span-6', $html->tag('span', 'VFCC: ', array('class'=>'patientIdentiferLabel')) . $html->tag('span', $patient['Patient']['vfcc'], array('class'=>'patientIdentifierValue')));
	?>
	</div>

</div>

<div id="tab-set" class="span-22 prepend-top last">
		<ul class="tabs">
			<li><a href="#tab1" class="selected">Demographics</a></li>
			<li><a href="#tab2">Medical Information</a></li>
			<li><a href="#tab3">Results</a></li>
		</ul>

	<div id="tab1">
		<h2>Demographic Information</h2>
		<div class="tasks span-22 last">
			<a class="button" href="/patients/edit/<?php echo $patient['Patient']['pid']; ?>">Edit Patient Information</a>
				<?php if ($patient['Patient']['status']) { ?>
			<a class="button negative" href="/patients/toggleStatus/<?php echo $patient['Patient']['pid']; ?>">Change Status to Inactive</a>
				<?php } else { ?>
			<a class="button positive" href="/patients/toggleStatus/<?php echo $patient['Patient']['pid']; ?>">Change Status to Active</a>
				<?php } ?>
		</div>
		<div class="demographicInformation large span-22 last">

			<div class="span-11">
				<div>
					<strong>Sex: </strong>
					<?php if(!empty($patient['Patient']['sex'])){echo $patient['Patient']['sex'];} ?>
				</div>
				<div>
					<strong>Mother: </strong>
					<?php if(!empty($patient['Patient']['mother'])){echo $patient['Patient']['mother'];} ?>
				</div>
				<div>
					<strong>Occupation: </strong>
					<?php if(!empty($patient['Occupation']['name'])){echo $patient['Occupation']['name'];} ?>
				</div>
				<div>
					<strong>Education: </strong>
					<?php if(!empty($patient['Education']['name'])){echo $patient['Education']['name'];} ?>
				</div>
				<div>
					<strong>Marital Status: </strong>
					<?php if(!empty($patient['MaritalStatus']['name'])){echo $patient['MaritalStatus']['name'];} ?>
				</div>
				<div>
					<strong>Telephone Number: </strong>
					<?php if(!empty($patient['Patient']['telephone_number'])){echo $patient['Patient']['telephone_number'];} ?>
				</div>		
			</div>
			<div class="span-11 last">
				<div>
					<strong>Location: </strong>
					<?php if(!empty($patient['Location']['name'])){echo $patient['Location']['name'];} ?>
				</div>
				<div>
					<strong>Village: </strong>
					<?php if(!empty($patient['Patient']['village'])){echo $patient['Patient']['village'];} ?>
				</div>
				<div>
					<strong>Home: </strong>
					<?php if(!empty($patient['Patient']['home'])){echo $patient['Patient']['home'];} ?>
				</div>
				<div>
					<strong>Nearest Church: </strong>
					<?php if(!empty($patient['Patient']['nearest_church'])){echo $patient['Patient']['nearest_church'];} ?>
				</div>
				<div>
					<strong>Nearest School: </strong>
					<?php if(!empty($patient['Patient']['nearest_school'])){echo $patient['Patient']['nearest_school'];} ?>
				</div>
				<div>
					<strong>Nearest Health Centre: </strong>
					<?php if(!empty($patient['Patient']['nearest_health_centre'])){echo $patient['Patient']['nearest_health_centre'];} ?>
				</div>
				<div>
					<strong>Nearest Major Landmark: </strong>
					<?php if(!empty($patient['Patient']['nearest_major_landmark'])){echo $patient['Patient']['nearest_major_landmark'];} ?>
				</div>
				<div>
					<strong>VF Testing Site: </strong>
					<?php if(!empty($patient['VfTestingSite']['site_name'])){echo $patient['Patient']['site_name'].' ('.$patient['VfTestingSite']['site_name'].')';} ?>
				</div>
				<h4>Status Info</h4>
				<div>
					<strong>Status: </strong>
					<?php echo $this->element('prettyStatus', array('status'=>$patient['Patient']['status'])); ?>
				</div>
				<div>
					<strong>Status Last Changed: </strong>
					<?php if(!empty($patient['Patient']['status_timestamp'])){echo $this->element('prettyDate', array('date' => $patient['Patient']['status_timestamp']));} ?>
				</div>
				<div>
					<strong>Status Reason: </strong>
					<?php if(!empty($patient['InactiveReason']['name'])){echo $patient['InactiveReason']['name'];} ?>
				</div>
				

			</div>
		</div>
	</div>
	<div id="tab2">
		<h2>Medical Information</h2>
		<div class="tasks span-22 last">
			<a class="button" href="/medicalInformations/edit/<?php echo $patient['Patient']['pid']; ?>">Edit Medical Information</a>
		</div>
			
	<pre>
	<?php var_dump($patient); ?>
	</pre>
	<?php
	$patient['MedicalInformation']['patient_source_id'];
	$patient['MedicalInformation']['funding_id'];
	$patient['MedicalInformation']['hiv_positive_date'];
	$patient['MedicalInformation']['hiv_positive'];
	$patient['hiv_positive_test_location']['name'];
	$patient['MedicalInformation']['hiv_positive_clinic_start_date'];
	$patient['MedicalInformation']['hiv_positive_who_stage'];
	$patient['MedicalInformation']['art_naive'];
	$patient['MedicalInformation']['art_service_type_id'];
	$patient['MedicalInformation']['art_starting_regimen_id'];
	$patient['MedicalInformation']['art_start_date'];
	$patient['MedicalInformation']['art_eligibility_date'];
	$patient['MedicalInformation']['art_indication_id'];
	$patient['MedicalInformation']['transfer_in_date'];
	$patient['MedicalInformation']['transfer_in_district_id'];
	$patient['MedicalInformation']['transfer_in_facility'];
	$patient['MedicalInformation']['transfer_out_date'];
	?>
	
	
	</div>
	
	<div id="tab3">
		<?php
		//Sets the update and indicator elements by DOM ID for AJAX pagination
		$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
		?>
		<h2>Results</h2></h2>
		
		<!-- Miniform for adding results -->
		<div class="addresult box span-14 rim last">
			<div class="span-5"><p class="large"><strong>Add New Test Result:</strong></p></div>
			<?php
			// Start the form ('FALSE' simply tells the controller that this form is not associated with any model)
			echo $form->create(FALSE, array('url' => '/results/add/'.$patient['Patient']['pid']));
			?>
			<div class="span-4">
				<?php
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
												'label'=>'Create Result for Test:'));
				//echo $form->end('Add New Result');
				?>
			</div>
			<div class="span-5 last">
				<button type="submit" class="button positive">
					<img src="/img/icons/add.png" alt=""/> Add New Result
				</button>
			</div>
			</form>
		</div>
		<!-- End of Miniform -->
		<div id="results" class="span-22 prepend-top last">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th><?php echo $paginator->sort('Result ID','id');?></th>
					<th><?php echo $paginator->sort('Test','test_id');?></th>
					<th>Result</th>
					<th><?php echo $paginator->sort('Test Date','test_performed');?></th>
					<th><?php echo $paginator->sort('Requested By','requesting_clinician');?></th>
					<th><?php echo $paginator->sort('Added On','created');?></th>
					<th><?php echo $paginator->sort('Added By','user_id');?></th>
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
						<?php echo $result['value_decimal']; ?> <?php echo $result['Test']['units']; ?><?php echo $result['value_text']; ?><?php echo $result['ResultLookup']['description']; ?> [<?php echo $result['ResultLookup']['value']; ?>]
					</td>
					<td>
						<?php echo date('d/m/Y', strtotime($result['test_performed'])); ?>
					</td>
					<td>
						<?php echo $result['requesting_clinician']; ?>
					</td>
					<td>
						<?php echo date('d/m/Y', strtotime($result['created'])); ?>
					</td>
					<td>
						<?php echo $result['User']['username']; ?>
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