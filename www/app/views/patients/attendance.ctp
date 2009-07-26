<?php $crumb->addThisPage('Today\'s Patients', 'reset'); ?>
<div id="viewTitle" class="text-left">

<h1>Clinic Patients for <?php echo date('l jS F Y') ?></h1>

</div>



<?php
//Sets the update and indicator elements by DOM ID for AJAX pagination
$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
?>


<div class="span-12 append-10 last">Patients who have been logged as arriving for clinic today are listed below.</div>

 
<div id="patientIndex" class="patients index span-22 prepend-top last">
	

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('UPN','upn');?></th>
	<th><?php echo $paginator->sort('Surname','surname');?></th>
	<th><?php echo $paginator->sort('Forenames','forenames');?></th>
	<th><?php echo $paginator->sort('DoB','date_of_birth');?></th>
	<th><?php echo $paginator->sort('Sex','sex');?></th>
	<th><?php echo $paginator->sort('Attendance Status','value_lookup');?></th>
	<th class="actions"><?php __('Actions');?></th>
	<th class="actions"><?php __('Add Results');?></th>
	<th class="actions"></th>
</tr>
<?php
// Parse the array of Test & Test IDs sent by the controller into an array we can use to make
// <SELECT> elements for our miniform.
$testoptions=array();
foreach ($tests as $test) {
	if($test['Test']['id'] == 1){
		continue;
	} else {
		$testoptions[$test['Test']['id']] = $test['Test']['name'];
	}
}


$i = 0;
$counter=0;
if(!empty($patients)):
foreach ($patients as $patient):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->element('prettyUPN', array('pid' => $values[$counter]['Patient']['upn'])); ?>
		</td>
		<td>
			<?php echo $values[$counter]['Patient']['surname']; ?>
		</td>
		<td>
			<?php echo $values[$counter]['Patient']['forenames']; ?>
		</td>
		<td>
			<?php echo $this->element('prettyDate', array('date' => $values[$counter]['Patient']['date_of_birth']));?>
		</td>
		<td>
			<?php echo $values[$counter]['Patient']['sex']; ?>
		</td>
		<td>
			<?php echo $html->link(__($values[$counter]['ResultLookup']['description'], true), array('controller'=>'results', 'action'=>'edit', $values[$counter]['Result']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $values[$counter]['Patient']['pid']), array('class'=>'smallbutton')); ?>
			
		</td>
		<td class="actions">
			<?php
			echo $form->create(FALSE, array('url' => '/results/add/'.$values[$counter]['Patient']['pid']));
			// Build the Select box
			echo $form->input('id',array('type'=>'select',
										'options'=> $testoptions,
										'label'=>FALSE));
			?>
		</td>
		<td>
			<?php
			//echo $form->end('Add Result');
			?>
		<button type="submit" class="smallbutton positive">
			<img src="/img/icons/add.png" alt=""/> Add Result
		</button>
		</form>
		</td>
		
		<?php
		$counter++;
		?>
	</tr>
<?php endforeach; ?>
<?php endif; ?>
</table>
</div>
<!-- Paginator links -->
<div class="paging">
<?php echo $paginator->prev('<< Previous', null, null, array('class' => 'disabled'));?>
 | 	<?php echo $paginator->numbers(); ?>
 |  <?php echo $paginator->next('Next >>', null, null, array('class' => 'disabled'));?> 

</div>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% patients out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>