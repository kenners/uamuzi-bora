<div class="breadcrumb">
	<?php echo $crumb->getHtml('Results', 'reset'); ?>
</div>
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
	<th><?php echo $paginator->sort('value_decimal');?></th>
	<th><?php echo $paginator->sort('value_text');?></th>
	<th><?php echo $paginator->sort('value_lookup');?></th>
	<th><?php echo $paginator->sort('test_performed');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('requesting_clinician');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php

$i = 0;
foreach ($results as $result):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $result['Result']['id']; ?>
		</td>
		<td>
			<?php echo $result['Result']['pid']; ?>
		</td>
		<td>
			<?php echo $html->link($result['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $result['Test']['id'])); ?>
		</td>
		<td>
			<?php echo $result['Result']['value_decimal']; ?>
		</td>
		<td>
			<?php echo $result['Result']['value_text']; ?>
		</td>
		<td>
			<?php echo $result['Result']['value_lookup']; ?>
		</td>
		<td>
			<?php echo $result['Result']['test_performed']; ?>
		</td>
		<td>
			<?php echo $result['Result']['created']; ?>
		</td>
		<td>
			<?php echo $result['Result']['requesting_clinician']; ?>
		</td>
		<td>
			<?php echo $result['Result']['user_id']; ?>
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
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('New Result', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
