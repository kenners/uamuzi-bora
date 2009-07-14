<?php $crumb->addThisPage('Search Patients', null, 'auto'); ?>
<div id="viewTitle" class="text-left">
<h1>Search Patient</h1>
</div>
<p>To search for a patient in the database, select what you wish to search for (e.g. Patient ID, Forename, Surname etc.) in the drop-down box below, and then type into the Search box what you wish to find.</p>
<p>You may add further details into the additional search boxes to perform a more precise search.</p>
<div class="span-22">
<?php
$searchoptions = array('pid'=>'Patient ID',
						'surname'=>'Surname',
						'forenames'=>'Forenames',
						'age'=>'Age',
						'telephone_number'=>'Telephone Number',
						'upn'=>'CCCP Card Unique Patient Number',
						'arvid'=>'ARV Database ID',
						'vfcc'=>'Vestergaard Frandsen Client Code');

echo $form->create('Patient', array('action' => 'search'));
?>
<div class="span-7">
<?php
echo $form->inputs(array('legend' => 'Search Field 1',
						'search_key_1'=>array('type' => 'select',
												'empty' => TRUE,
												'options'=>$searchoptions),
						'search_value_1'=>array('type'=>'text')));
?>
</div>
<div class="span-7">
<?php
echo $form->inputs(array('legend' => 'Search Field 2',
						'search_key_2'=>array('type' => 'select',
												'empty' => TRUE,
												'options'=>$searchoptions),
						'search_value_2'=>array('type'=>'text')));
					
?>
</div>
<div class="span-7 last">
<?php
echo $form->inputs(array('legend' => 'Search Field 3',
						'search_key_3'=>array('type' => 'select',
												'empty' => TRUE,
												'options'=>$searchoptions),
						'search_value_3'=>array('type'=>'text')));
?>
</div>
<div class="span-7">
<?php
echo $form->radio('status', array('1'=>'Active','2'=>'Inactive',''=>'Any'), array('value'=>'1'));
?>
</div>

<div class="span-7">
<?php
echo $form->inputs(array('legend' => 'Location',
						'location_id'=>array('label' => FALSE)));
												
?>
</div>
<div class="span-4 prepend-2 prepend-top last">
	<button type="submit" class="button">
		<img src="/img/icons/magnifier.png" alt=""/> Search
	</button>
</div>
</form>
</div>
<!-- Here be Search Results -->
					
<?php
//Sets the update and indicator elements by DOM ID for AJAX pagination
$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
?>
<div id="patientSearch" class="patients search span-22 prepend-top last">
	

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Patient ID','pid');?></th>
	<th><?php echo $paginator->sort('Surname','surname');?></th>
	<th><?php echo $paginator->sort('Forenames','forenames');?></th>
	<th><?php echo $paginator->sort('Status','status');?></th>
	<th><?php echo $paginator->sort('DoB','date_of_birth');?></th>
	<th><?php echo $paginator->sort('Sex','sex');?></th>
	<th><?php echo $paginator->sort('Telephone','telephone_number');?></th>
	<th><?php echo $paginator->sort('Location','location_id');?></th>
	<th><?php echo $paginator->sort('CCCP UPN','upn');?></th>
	<th><?php echo $paginator->sort('ARV ID','arvid');?></th>
	<th><?php echo $paginator->sort('VF Client Code','vfcc');?></th>
	
	

	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
if (!empty($patients)):
$i = 0;
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

			<?php echo $this->element('prettyStatus', array('status' =>$patient['Patient']['status'])); ?>

		</td>
		<td>
			<?php echo $this->element('prettyDate', array('date' => $patient['Patient']['date_of_birth'])); ?>
		</td>
		<td>
			<?php echo $patient['Patient']['sex']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['telephone_number']; ?>
		</td>

		<td>
			<?php echo $patient['Location']['name']; ?>
		</td>
				<td>
			<?php echo $patient['Patient']['upn']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['arvid']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['vfcc']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $patient['Patient']['pid'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $patient['Patient']['pid']), null, sprintf(__('Are you sure you want to delete # %s?', true), $patient['Patient']['pid'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php endif; ?>
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