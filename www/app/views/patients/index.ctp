<div class="breadcrumb">
	<?php echo $crumb->getHtml('Patients', 'reset'); ?>
</div>
<div id="viewTitle" class="text-left">
<h1>Add New Patient</h1>
</div>
<p>All the patients currently in the database are listed below.</p>

<?php
//Sets the update and indicator elements by DOM ID for AJAX pagination
$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
?>
 
<div id="patientIndex" class="patients index">
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% patients out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Patient ID','pid');?></th>
	<th><?php echo $paginator->sort('CCCP UPN','upn');?></th>
	<th><?php echo $paginator->sort('ARV ID','arvid');?></th>
	<th><?php echo $paginator->sort('VF Client Code','vfcc');?></th>
	<th><?php echo $paginator->sort('Surname','surname');?></th>
	<th><?php echo $paginator->sort('Forenames','forenames');?></th>
	<th><?php echo $paginator->sort('DoB','date_of_birth');?></th>
	<th><?php echo $paginator->sort('Sex','sex');?></th>
	<th><?php echo $paginator->sort('Mother','mother');?></th>
	<th><?php echo $paginator->sort('Telephone Number','telephone_number');?></th>
	<th><?php echo $paginator->sort('Location','location_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($patients as $patient):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $patient['Patient']['pid']; ?>
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
		<td>
			<?php echo $patient['Patient']['surname']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['forenames']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['date_of_birth']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['sex']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['mother']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['telephone_number']; ?>
		</td>

		<td>
			<?php echo $patient['location']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $patient['Patient']['pid'])); ?>
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
<!-- Actions Box -->
<div class="actions span-5">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('New Patient', true), array('action'=>'add')); ?></li>
<!--		<li><?php echo $html->link(__('List Occupations', true), array('controller'=> 'occupations', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Occupation', true), array('controller'=> 'occupations', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Educations', true), array('controller'=> 'educations', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Education', true), array('controller'=> 'educations', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Marital Statuses', true), array('controller'=> 'marital_statuses', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Marital Status', true), array('controller'=> 'marital_statuses', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Locations', true), array('controller'=> 'locations', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Location', true), array('controller'=> 'locations', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Vf Testing Sites', true), array('controller'=> 'vf_testing_sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Vf Testing Site', true), array('controller'=> 'vf_testing_sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Medical Informations', true), array('controller'=> 'medical_informations', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Medical Information', true), array('controller'=> 'medical_informations', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>-->
	</ul>
</div>
