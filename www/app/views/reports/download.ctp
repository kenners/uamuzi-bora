<?php $crumb->addThisPage('Reports', 'reset'); ?>
<div id="viewTitle" class="text-left">
	<p><span class="welcome1">Reports</span>&nbsp;&nbsp;&nbsp;</p>
<div class="span-21 pull-6">
<table>
<tr>
<td width="200">
	<p><strong> Start Date </strong></p>
<div style="margin-top:-20px">
<?php
		 echo $form->create(null, array('url' => array('controller' => 'reports', 'action' => 'download'))); 
		echo $form->dateTime('start', 'DMY',null,$date, array(
						 'timeFormat' => 'none',
					         'monthNames' => false,
					 	 'minYear' => date('Y') - 100,
						 'maxYear' => date('Y'))
						);
?>
</div
</td>
<td width="200">
<strong> End Date </strong></p>
<div style="margin-top:-20px">
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
</div>
</td><td>
	
<strong> Report Type </strong></p>
<div style="margin-top:-20px">

 	<?php
		echo $form->input('Report',array('options'=>$reports,'label'=>''));
	?>
</div>
</td><td>	

<?php echo $form->end('Create Report');?>
</td></tr></table>	

				
		
		</div>
	</div>
</div>
