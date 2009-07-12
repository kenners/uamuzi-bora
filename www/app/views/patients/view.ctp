<!--<div id="viewTitle" class="text-left">
<h1>View Patient's Record</h1>
</div>-->
<?php
$javascript->link('jquery.js', false);
?>
<div id="patientBox" class="text-left span-22 last">
	<div id="vitalInfo" class="vitalInfo span-14">
		<?php
		// Patient Name
		echo $html->tag('span', $patient['Patient']['forenames'] . ' ' . $patient['Patient']['surname'], array('class' => 'patientName'));
		$pid = str_pad($patient['Patient']['pid'], 9, '0', STR_PAD_LEFT);
		$pid = chunk_split($pid, 3, ' ');
		echo $html->div('patientId span-22 last', $html->tag('span', 'Patient ID: ', array('class'=>'patientIdLabel')) . $html->tag('span', $pid, array('class'=>'patientIdValue')));
	
		// Date of Birth
		echo $html->div('patientAge span-7', $html->tag('span', 'DoB: ', array('class'=>'patientAgeLabel')) . $html->tag('span', $patient['Patient']['date_of_birth'], array('class'=>'patientAgeValue')));
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
	</div>
	<div id="tab2">
		<h2>Medical Information</h2>
	</div>
	
	<div id="tab3">
		<h2>Results</h2></h2>
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