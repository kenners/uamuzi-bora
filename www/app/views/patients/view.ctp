<!--<div id="viewTitle" class="text-left">
<h1>View Patient's Record</h1>
</div>-->
<?php
$javascript->link('jquery.js', false);
?>
<div class="breadcrumb">
	<?php echo $crumb->getHtml('View', null, 'auto'); ?>
</div>
<div id="patientBox" class="text-left span-22 last">
	<div id="vitalInfo" class="vitalInfo span-14">
		<?php
		$patient=$patients[0];
		// Patient Name
		echo $html->tag('span', $patient['Patient']['forenames'] . ' ' . $patient['Patient']['surname'], array('class' => 'patientName'));
		$pid = str_pad($patient['Patient']['pid'], 9, '0', STR_PAD_LEFT);
		$pid = chunk_split($pid, 3, ' ');
		echo $html->div('patientId span-22 last', $html->tag('span', 'Patient ID: ', array('class'=>'patientIdLabel')) . $html->tag('span', $pid, array('class'=>'patientIdValue')));
	
		// Date of Birth
		echo $html->div('patientAge span-7', $html->tag('span', 'DoB: ', array('class'=>'patientAgeLabel')) . $html->tag('span', date('d/m/Y', strtotime($patient['Patient']['date_of_birth'])), array('class'=>'patientAgeValue')));
		// Age (really really messy)
		if(!empty($patient['Patient']['year_of_birth']) && is_numeric($patient['Patient']['year_of_birth'])){
			$age = date('Y') - $patient['Patient']['year_of_birth'];
		}else{
			$age = 'Unknown';
		};
		echo $html->div('patientAge span-7 last', $html->tag('span', 'Age: ', array('class'=>'patientAgeLabel')) . $html->tag('span', $age, array('class'=>'patientAgeValue')));
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
		<div class="tasks">
			<a class="button" href="/patients/edit/<?php echo $patient['Patient']['pid']; ?>">Edit Patient Information</a>
						<a class="button negative" href="/patients/active/">Change Status to Inactive</a>
						<a class="button positive" href="/patients/active/">Change Status to Active</a>
			
		</div>
	</div
		</div>
	</div>
	<div id="tab2">
		<h2>Medical Information</h2>
	</div>
	
	<div id="tab3">
		<?php
		//Sets the update and indicator elements by DOM ID for AJAX pagination
		$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
		?>
		<h2>Results</h2></h2>
		
		<!-- Miniform for adding results -->
		<div class="addresult">	
		<form id="testadder" method="post" action="/results/add/<?php echo $patient['Patient']['pid'];?>">
		<?php
		$testoptions=array();
		foreach ($tests as $test){
						$testoptions[$test['Test']['id']] = $test['Test']['name'];
					
		}

		//$form->create(FALSE, array('url' => array('url' => '/results/add/'.$patient['Patient']['pid'])));
		echo $form->inputs(array('legend' => 'Add New Result',
									'id' =>array('type'=>'select',
												'options' => $testoptions)));
		//echo $form->end('Add New Result');
		?>
		<input value="Submit" type="submit">
		</form>
		</div>
		<!-- End of Miniform -->
		<div id="results">
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
						<?php echo $result['value_decimal']; ?><?php echo $result['value_text']; ?><?php echo $result['value_lookup']; ?>
					</td>
					<td>
						<?php echo $result['test_performed']; ?>
					</td>
					<td>
						<?php echo $result['created']; ?>
					</td>
					<td>
						<?php echo $result['requesting_clinician']; ?>
					</td>
					<td>
						<?php echo $result['user_id']; ?>
					</td>
					<td class="actions">
						<?php echo $html->link(__('View', true), array('action'=>'view', $result['id'])); ?>
						<?php echo $html->link(__('Edit', true), array('action'=>'edit', $result['id'])); ?>
						<?php echo $html->link(__('Delete', true), array('action'=>'delete', $result['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- Paginator links -->
		<div class="paging">
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