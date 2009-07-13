<div class="patients index">
<h2><?php __('Patients');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('pid');?></th>
	<th><?php echo $paginator->sort('upn');?></th>
	<th><?php echo $paginator->sort('arvid');?></th>
	<th><?php echo $paginator->sort('vfcc');?></th>
	<th><?php echo $paginator->sort('surname');?></th>
	<th><?php echo $paginator->sort('forenames');?></th>
	<th><?php echo $paginator->sort('date_of_birth');?></th>
	<th><?php echo $paginator->sort('year_of_birth');?></th>
	<th><?php echo $paginator->sort('sex');?></th>
	<th><?php echo $paginator->sort('mother');?></th>
	<th><?php echo $paginator->sort('occupation_id');?></th>
	<th><?php echo $paginator->sort('education_id');?></th>
	<th><?php echo $paginator->sort('marital_status_id');?></th>
	<th><?php echo $paginator->sort('telephone_number');?></th>
	<th><?php echo $paginator->sort('treatment_supporter');?></th>
	<th><?php echo $paginator->sort('location_id');?></th>
	<th><?php echo $paginator->sort('village');?></th>
	<th><?php echo $paginator->sort('home');?></th>
	<th><?php echo $paginator->sort('nearest_church');?></th>
	<th><?php echo $paginator->sort('nearest_school');?></th>
	<th><?php echo $paginator->sort('nearest_health_centre');?></th>
	<th><?php echo $paginator->sort('nearest_major_landmark');?></th>
	<th><?php echo $paginator->sort('vf_testing_site');?></th>
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
			<?php echo $patient['Patient']['year_of_birth']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['sex']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['mother']; ?>
		</td>
		<td>
			<?php echo $html->link($patient['occupation']['name'], array('controller'=> 'occupations', 'action'=>'view', $patient['occupation']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($patient['education']['name'], array('controller'=> 'educations', 'action'=>'view', $patient['education']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($patient['marital_status']['name'], array('controller'=> 'marital_statuses', 'action'=>'view', $patient['marital_status']['id'])); ?>
		</td>
		<td>
			<?php echo $patient['Patient']['telephone_number']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['treatment_supporter']; ?>
		</td>
		<td>
			<?php echo $html->link($patient['location']['name'], array('controller'=> 'locations', 'action'=>'view', $patient['location']['id'])); ?>
		</td>
		<td>
			<?php echo $patient['Patient']['village']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['home']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['nearest_church']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['nearest_school']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['nearest_health_centre']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['nearest_major_landmark']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['vf_testing_site']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $patient['Patient']['pid'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $patient['Patient']['pid'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $patient['Patient']['pid']), null, sprintf(__('Are you sure you want to delete # %s?', true), $patient['Patient']['pid'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Patient', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Occupations', true), array('controller'=> 'occupations', 'action'=>'index')); ?> </li>
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
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
