<?php $crumb->addThisPage('Reports', 'reset'); ?>
<div id="viewTitle" class="text-left">
	<p><span class="welcome1">Reports</span>&nbsp;&nbsp;&nbsp;<span class="welcome2">Which report do you want to download?</span></p>

<?php echo $form->create(null, array('url' => array('controller' => 'reports', 'action' => 'download'))); ?>
	<fieldset>
 		<legend><?php __('Download report');?></legend>
	<?php
		echo $form->input('Report',array('options'=>$reports));
	?><p><strong> Choose the time period to generate a report for:</strong> </p>
	<p><strong> Start </strong></p>
<?php
		
		echo $form->dateTime('start', 'DMY',null,$date, array(
						 'timeFormat' => 'none',
					         'monthNames' => false,
					 	 'minYear' => date('Y') - 100,
						 'maxYear' => date('Y'))
						);
?><p><strong> End </strong></p>
<?php
		echo $form->dateTime('end',
								'DMY',
								'none',
								null,
								array(
									'minYear' => date('Y') - 100,
									'maxYear' => date('Y'),
									'label'=>'',
									'monthNames' => false
									),
									false
							);
		

	?>
		
	</fieldset>
<?php echo $form->end('Download file');?>
	<p> Please note that it can take some time to generate the report</p>


				
		
		</div>
	</div>
</div>
