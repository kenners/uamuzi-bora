
<div class="span-16">

	<div class="span-15 push-2" style="margin-top:-10px">
		<table cellpadding="0">
		<tr><td width=190">
		<?php
		$searchoptions = array(				'upn'=>'UPN',
						'surname'=>'Surname',
						'forenames'=>'Forenames');

		echo $form->create('Patient', array('action' => 'search'));
		echo $form->input('search_value_1',array('type'=>'text','label'=> FALSE, 'style'=>'width:200px')); ?>
		</td><td>

		<?php
		echo $form->input('search_key_1',array('type' => 'select','label' => FALSE, 'options'=>$searchoptions));					
		?>
		</td></tr></table>
	</div>
	

	<div style="margin-top:-40px;margin-left:150px;float:left;position:relative;">
		<button type="submit" class="button">
			<img src="/img/icons/magnifier.png" alt=""/> Search for Patient
		</button>
	</div>


</div>
</form>
</div>
<!-- Here be Search Results -->
					
<?php
//Sets the update and indicator elements by DOM ID for AJAX pagination
$paginator->options(array('update' => 'container', 'indicator' => 'spinner'));
?>
<div id="patientIndex" class="patients push-1 search span-22 prepend-top last">

<?php
if (!empty($patients)):
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('UPN','upn');?></th>
	<th><?php echo $paginator->sort('Surname','surname');?></th>
	<th><?php echo $paginator->sort('Forenames','forenames');?></th>
	<th><?php echo $paginator->sort('Status','status');?></th>
	<th><?php echo $paginator->sort('DoB','date_of_birth');?></th>
	<th><?php echo $paginator->sort('Sex','sex');?></th>
	
	<th><?php echo $paginator->sort('Location','location_id');?></th>
	
	
	
	

	<th></th>
</tr>
<?php
$i = 0;
foreach ($patients as $patient):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->element('prettyUPN', array('pid' => $patient['Patient']['upn'])); ?>
		</td>
		<td>
			<?php echo $patient['Patient']['surname']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['forenames']; ?>
		</td>
		<td>
			<?php echo $this->element('prettyStatus', array('status' =>$patient['Patient']['status'])); ?>
		</td>
		<td>
			<?php echo $this->element('prettyDate', array('date' => $patient['Patient']['date_of_birth'])); ?>
		</td>
		<td>
			<?php echo $patient['Patient']['sex']; ?>
		</td>

		<td>
			<?php echo $patient['Location']['name']; ?>
		</td>
		
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $patient['Patient']['pid']), array('class'=>'smallbutton')); ?>
	
		</td>
	</tr>
<?php endforeach; ?>

</table>

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
<?php endif; ?>
</div>
