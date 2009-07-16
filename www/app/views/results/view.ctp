<?php $crumb->addThisPage('View Result', null, 'auto'); ?>
<h2>Viewing <?php echo $result['Test']['name']; ?> Result </h2>
<div class="results view span-16 large">
	<div>
		<strong>Result ID: </strong>
		<?php echo $result['Result']['id']; ?>
	</div>
	<div>
		<strong>Patient ID: </strong>
		<?php echo $this->element('prettyPID', array('pid' =>$result['Result']['pid'])); ?>
	</div>
	<div>
		<strong>Patient Name: </strong>
		<?php echo $result['Patient']['forenames'] .' '. $result['Patient']['surname']; ?>
	</div>
	<div>
		<strong>Test: </strong>
		<?php echo $html->link($result['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $result['Test']['id'])); ?>
	</div>
	<div>
		<strong>Value: </strong>
		<?php echo $result['Result']['value_lookup']; ?><?php echo $result['Result']['value_text']; ?><?php echo $result['Result']['value_decimal']; ?>
	</div>
	<div>
		<strong>Test Date: </strong>
		<?php echo $this->element('prettyDate', array('date' =>$result['Result']['test_performed'])); ?>
	</div>
	<div>
		<strong>Result Added to Database: </strong>
		<?php echo $this->element('prettyDate', array('date' =>$result['Result']['created'])); ?>
	</div>
	<div>
		<strong>Requesting Clinician: </strong>
		<?php echo $result['Result']['requesting_clinician']; ?>
	</div>
	<div>
		<strong>Last Edited By: </strong>
		<?php echo $result['User']['username']; ?>
	</div>
</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('Edit Result', true), array('action'=>'edit', $result['Result']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Result', true), array('action'=>'delete', $result['Result']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['Result']['id'])); ?> </li>
	</ul>
</div>
