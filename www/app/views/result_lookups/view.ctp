<div class="breadcrumb">
	<?php echo $crumb->getHtml('View', null, 'auto'); ?>
</div>
<div class="resultLookups view">
<h2><?php  __('ResultLookup');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultLookup['ResultLookup']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Test'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($resultLookup['test']['name'], array('controller'=> 'tests', 'action'=>'view', $resultLookup['test']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultLookup['ResultLookup']['value']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultLookup['ResultLookup']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultLookup['ResultLookup']['comment']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultLookup['ResultLookup']['user_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultLookup['ResultLookup']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit ResultLookup', true), array('action'=>'edit', $resultLookup['ResultLookup']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete ResultLookup', true), array('action'=>'delete', $resultLookup['ResultLookup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultLookup['ResultLookup']['id'])); ?> </li>
		<li><?php echo $html->link(__('List ResultLookups', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New ResultLookup', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
