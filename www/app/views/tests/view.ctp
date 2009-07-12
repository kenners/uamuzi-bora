<div class="breadcrumb">
	<?php echo $crumb->getHtml('View', null, 'auto'); ?>
</div>
<div class="tests view">
<h2><?php  __('Test');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Abbreiviation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['abbreiviation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Upper Limit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['upper_limit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lower Limit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['lower_limit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['comment']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['user_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Test', true), array('action'=>'edit', $test['Test']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Test', true), array('action'=>'delete', $test['Test']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $test['Test']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Result Lookups', true), array('controller'=> 'result_lookups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result Lookup', true), array('controller'=> 'result_lookups', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Results');?></h3>
	<?php if (!empty($test['result'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Pid'); ?></th>
		<th><?php __('Test Id'); ?></th>
		<th><?php __('Value Decimal'); ?></th>
		<th><?php __('Value Text'); ?></th>
		<th><?php __('Value Lookup'); ?></th>
		<th><?php __('Test Performed'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Requesting Clinician'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($test['result'] as $result):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $result['id'];?></td>
			<td><?php echo $result['pid'];?></td>
			<td><?php echo $result['test_id'];?></td>
			<td><?php echo $result['value_decimal'];?></td>
			<td><?php echo $result['value_text'];?></td>
			<td><?php echo $result['value_lookup'];?></td>
			<td><?php echo $result['test_performed'];?></td>
			<td><?php echo $result['created'];?></td>
			<td><?php echo $result['requesting_clinician'];?></td>
			<td><?php echo $result['user_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'results', 'action'=>'view', $result['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'results', 'action'=>'edit', $result['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'results', 'action'=>'delete', $result['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Result Lookups');?></h3>
	<?php if (!empty($test['result_lookup'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Test Id'); ?></th>
		<th><?php __('Value'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Comment'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($test['result_lookup'] as $resultLookup):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $resultLookup['id'];?></td>
			<td><?php echo $resultLookup['test_id'];?></td>
			<td><?php echo $resultLookup['value'];?></td>
			<td><?php echo $resultLookup['description'];?></td>
			<td><?php echo $resultLookup['comment'];?></td>
			<td><?php echo $resultLookup['user_id'];?></td>
			<td><?php echo $resultLookup['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'result_lookups', 'action'=>'view', $resultLookup['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'result_lookups', 'action'=>'edit', $resultLookup['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'result_lookups', 'action'=>'delete', $resultLookup['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultLookup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Result Lookup', true), array('controller'=> 'result_lookups', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
