<div class="resultLookups index">
<h2><?php __('ResultLookups');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('test_id');?></th>
	<th><?php echo $paginator->sort('value');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('comment');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($resultLookups as $resultLookup):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $resultLookup['ResultLookup']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($resultLookup['test']['name'], array('controller'=> 'tests', 'action'=>'view', $resultLookup['test']['id'])); ?>
		</td>
		<td>
			<?php echo $resultLookup['ResultLookup']['value']; ?>
		</td>
		<td>
			<?php echo $resultLookup['ResultLookup']['description']; ?>
		</td>
		<td>
			<?php echo $resultLookup['ResultLookup']['comment']; ?>
		</td>
		<td>
			<?php echo $resultLookup['ResultLookup']['user_id']; ?>
		</td>
		<td>
			<?php echo $resultLookup['ResultLookup']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $resultLookup['ResultLookup']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $resultLookup['ResultLookup']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $resultLookup['ResultLookup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultLookup['ResultLookup']['id'])); ?>
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
		<li><?php echo $html->link(__('New ResultLookup', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
