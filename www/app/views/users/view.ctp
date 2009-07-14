<?php echo $crumb->addThisPage('View', null, 'auto'); ?>
<div class="users view span-16">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($user['Group']['name'], array('controller'=> 'groups', 'action'=>'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('Edit User', true), array('action'=>'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete User', true), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Groups', true), array('controller'=> 'groups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Group', true), array('controller'=> 'groups', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Result Lookups', true), array('controller'=> 'result_lookups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result Lookup', true), array('controller'=> 'result_lookups', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Tests');?></h3>
	<?php if (!empty($user['Test'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Abbreiviation'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Upper Limit'); ?></th>
		<th><?php __('Lower Limit'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Comment'); ?></th>
		<th><?php __('Active'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Test'] as $test):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $test['id'];?></td>
			<td><?php echo $test['name'];?></td>
			<td><?php echo $test['abbreiviation'];?></td>
			<td><?php echo $test['type'];?></td>
			<td><?php echo $test['upper_limit'];?></td>
			<td><?php echo $test['lower_limit'];?></td>
			<td><?php echo $test['description'];?></td>
			<td><?php echo $test['comment'];?></td>
			<td><?php echo $test['active'];?></td>
			<td><?php echo $test['user_id'];?></td>
			<td><?php echo $test['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'tests', 'action'=>'view', $test['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'tests', 'action'=>'edit', $test['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'tests', 'action'=>'delete', $test['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $test['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Results');?></h3>
	<?php if (!empty($user['Result'])):?>
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
		foreach ($user['Result'] as $result):
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
	<?php if (!empty($user['ResultLookup'])):?>
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
		foreach ($user['ResultLookup'] as $resultLookup):
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
