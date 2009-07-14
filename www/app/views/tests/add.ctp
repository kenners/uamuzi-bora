<div class="breadcrumb">
	<?php echo $crumb->getHtml('Add', null, 'auto'); ?>
</div>
<div class="tests form span-16">
<?php
echo $form->create('Test');
echo $form->inputs(array('legend' => 'Add Test',
						'name'=>array('label' => 'Test Name',
									'after'=>'<br/><em>What is the name of the test? (e.g. Haemaglobin)</em>'),
						'abbreiviation'=>array('label' => 'Test Abbreviation',
												'after'=>'<br/><em>Optional. What is the abbreviation for the test? (e.g. Hb)</em>'),
						'type'=>array('label'=>'Results Type',
									'type'=>'select',
									'options'=>array('decimal'=>'Decimal', 'text'=>'Text', 'lookup'=>'Options'),
									'empty' => '(choose one)',
									'after' => '<br/><em>What type of data will the test results be? (e.g. Blood tests will usually be <strong>Decimal</strong>, whilst disease stages (e.g. WHO Stage) will have have discrete <strong>Options</strong>)</em>'),
						'units'=>array('label'=>'Units','after'=>'<br/><em>Optional. What are the units of this test? (if appropriate)</em>'),
						'description'=>array('label' => 'Test Description',
											'after'=> '<br/><em>Optional. Provide a description of the test that is displayed to normal users</em>'),
						'comment'=>array('label' => 'Comment',
											'after'=> '<br/><em>Optional. You may add a comment here that is only displayed to users editing the Test (such as yourself)</em>'),
						'active'=>array('label' => 'Active?',
										'checked'=> TRUE,
										'after'=> '<br/><em>Should this test be available for users to use?</em>'),
						));
						//echo $form->end('Submit');
						?>
	<div class="span-6 prepend-5 append-5">
		<button type="submit" class="button positive">
			<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Add Test
		</button>
	</div>

</div>
<div class="actions span-5 last">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index'));?></li>
	</ul>
</div>
