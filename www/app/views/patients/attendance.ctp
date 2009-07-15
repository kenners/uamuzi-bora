<?php $crumb->addThisPage('Patients', 'reset'); ?>
<div id="viewTitle" class="text-left">
<h1>Patient List</h1>
</div>



<?php
//Sets the update and indicator elements by DOM ID for AJAX pagination
$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
?>
<div class="span-22 last"><?php echo $html->link('Add New Patient', array('action'=>'add'), array('class'=>'button')); ?></div>
<div class="span-12 append-10 last"><em>Before adding a new patient, please <?php echo $html->link(__('Search', true), array('action'=>'search')); ?> or browse the list of patients in the database below to check that they do not already have a record in this database.</em></div>
 
<div id="patientIndex" class="patients index span-22 prepend-top last">
	

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Patient ID','pid');?></th>
	<th><?php echo $paginator->sort('Surname','surname');?></th>
	<th><?php echo $paginator->sort('Forenames','forenames');?></th>
	<th><?php echo $paginator->sort('DoB','date_of_birth');?></th>
	<th><?php echo $paginator->sort('Sex','sex');?></th>
	<th><?php echo $paginator->sort('Attendence','value_lookup');?></th>
	
	

	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
$counter=0;
foreach ($patients as $patient):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->element('prettyPID', array('pid' => $patient['Patient']['pid'])); ?>
		</td>
		<td>
			<?php echo $patient['Patient']['surname']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['forenames']; ?>
		</td>
		<td>
			<?php echo $this->element('prettyDate', array('date' => $patient['Patient']['date_of_birth']));?>
		</td>
		<td>
			<?php echo $patient['Patient']['sex']; ?>
		</td>
		<td>
			<?php echo $values[$counter]['ResultLookup']['value']; 
			$counter++;
			?>
		</td>
		
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $patient['Patient']['pid'])); ?>
			<?php echo $html->link(__('Edit attendance status', true), array('controller'=>'results', 'action'=>'edit', $values[$counter]['Result']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $patient['Patient']['pid']), null, sprintf(__('Are you sure you want to delete # %s?', true), $patient['Patient']['pid'])); ?>
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
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% patients out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>