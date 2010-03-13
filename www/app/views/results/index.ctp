<div class="results index">
<h2><?php __('Results');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('pid');?></th>
	<th><?php echo $paginator->sort('test_id');?></th>
	<th><?php echo $paginator->sort('test_performed');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('requesting_clinician');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($results as $result):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $result['Result']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($result['Patient']['pid'], array('controller'=> 'patients', 'action'=>'view', $result['Patient']['pid'])); ?>
		</td>
		<td>
			<?php echo $html->link($result['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $result['Test']['id'])); ?>
		</td>
		<td>
			<?php echo $result['Result']['test_performed']; ?>
		</td>
		<td>
			<?php echo $result['Result']['created']; ?>
		</td>
		<td>
			<?php echo $result['Result']['modified']; ?>
		</td>
		<td>
			<?php echo $result['Result']['requesting_clinician']; ?>
		</td>
		<td>
			<?php echo $html->link($result['User']['name'], array('controller'=> 'users', 'action'=>'view', $result['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $result['Result']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $result['Result']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $result['Result']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['Result']['id'])); ?>
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
		<li><?php echo $html->link(__('New Result', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Patients', true), array('controller'=> 'patients', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Patient', true), array('controller'=> 'patients', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Result Values', true), array('controller'=> 'result_values', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result Value', true), array('controller'=> 'result_values', 'action'=>'add')); ?> </li>
	</ul>
</div>
