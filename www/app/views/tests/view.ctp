<?php $crumb->addThisPage('View Test', null, 'auto'); ?>
<div class="tests view span-16">
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Abbreviation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['abbreiviation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['type']; ?>
			&nbsp;
		</dd>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Units'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['units']; ?>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Multiple result values'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['multival']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Edited By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('Add New Test Result Option', true), array('controller'=> 'result_lookups', 'action'=>'add/'.$test['Test']['id']));?> </li>
		<li><?php echo $html->link(__('Edit Test', true), array('action'=>'edit', $test['Test']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index')); ?> </li>
	</ul>
</div>
<?php if ($test['Test']['type'] == 'lookup'):?>
<div class="related span-22 last">
	<hr />
	<h3><?php __('Test Result Options');?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Value'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Comment'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		$test['Test']['id'];
		foreach ($test['ResultLookup'] as $resultLookup):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="even"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $resultLookup['value'];?></td>
			<td><?php echo $resultLookup['description'];?></td>
			<td><?php echo $resultLookup['comment'];?></td>
			<td><?php echo $resultLookup['User']['username'];?></td>
			<td><?php echo $resultLookup['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('Edit', true), array('controller'=> 'result_lookups', 'action'=>'edit', $resultLookup['id'])); ?>
				
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

