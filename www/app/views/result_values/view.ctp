<?php $crumb->addThisPage('View Result', null, 'auto'); 
$resultValue=$resultValue[0];?>
<h2>Viewing <?php echo $resultValue['Result']['Test']['name']; ?> Result </h2>
<div class="results view span-16 large">
	<div>
		<strong>Result ID: </strong>
		<?php echo $resultValue['ResultValue']['id']; ?>
	</div>
	<div>
		<strong>Patient ID: </strong>
		<?php echo $this->element('prettyPID', array('pid' =>$resultValue['Result']['pid'])); ?>
	</div>
	<div>
		<strong>Patient Name: </strong>
		<?php echo $resultValue['Result']['Patient']['forenames'] .' '. $resultValue['Result']['Patient']['surname']; ?>
	</div>
	<div>
		<strong>Test: </strong>
		<?php echo $html->link($resultValue['Result']['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $resultValue['Result']['Test']['id'])); ?>
	</div>
	<div>
		<strong>Value: </strong>
		<?php echo $resultValue['ResultValue']['value_lookup']; ?><?php echo $resultValue['ResultValue']['value_text']; ?><?php echo $resultValue['ResultValue']['value_decimal']; ?>
	</div>
	<div>
		<strong>Test Date: </strong>
		<?php echo $this->element('prettyDate', array('date' =>$resultValue['Result']['test_performed'])); ?>
	</div>
	<div>
		<strong>Result Added to Database: </strong>
		<?php echo $this->element('prettyDate', array('date' =>$resultValue['Result']['created'])); ?>
	</div>
	<div>
		<strong>Requesting Clinician: </strong>
		<?php echo $resultValue['Result']['requesting_clinician']; ?>
	</div>
	<div>
		<strong>Last Edited By: </strong>
		<?php echo $resultValue['Result']['User']['username']; ?>
	</div>
</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('Edit Result', true), array('action'=>'edit', $resultValue['Result']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Result', true), array('action'=>'delete', $resultValue['Result']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultValue['Result']['id'])); ?> </li>
	</ul>
</div>
