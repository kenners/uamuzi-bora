<?php $crumb->addThisPage('Tests', 'reset' ); ?>
<div class="tests index">
<h2><?php __('Tests');?></h2>
<p>
<?php

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('Abbreviation','abbreiviation');?></th>
	<th><?php echo $paginator->sort('type');?></th>
	<th><?php echo $paginator->sort('units');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('comment');?></th>
	<th><?php echo $paginator->sort('active');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($tests as $test):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $test['Test']['id']; ?>
		</td>
		<td>
			<?php echo $test['Test']['name']; ?>
		</td>
		<td>
			<?php echo $test['Test']['abbreiviation']; ?>
		</td>
		<td>
			<?php echo $test['Test']['type']; ?>
		</td>
		<td>
			<?php echo $test['Test']['units']; ?>
		</td>
		<td>
			<?php echo $test['Test']['description']; ?>
		</td>
		<td>
			<?php echo $test['Test']['comment']; ?>
		</td>
		<td>
			<?php echo $this->element('prettyStatus', array('status' =>$test['Test']['active'])); ?>
		</td>
		<td>
			<?php echo $test['User']['username']; ?>
		</td>
		<td>
			<?php echo $test['Test']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $test['Test']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $test['Test']['id'])); ?>
			
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
<div class="actions span-5">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('New Test', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Result Lookups', true), array('controller'=> 'result_lookups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result Lookup', true), array('controller'=> 'result_lookups', 'action'=>'add')); ?> </li>
	</ul>
</div>
