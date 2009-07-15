<div id="viewTitle" class="text-left">
<h1>Modify Patient Status</h1>
</div>

<?php
echo $form->create('Patient', array('url' => '/patients/toggleStatus/' . $pid));
echo $form->hidden('referer', array('value' => $referer));
echo $form->input('inactive_reason_id');
?>
	<button type="submit" class="button positive">
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Confirm Status Change
	</button>
</div>
</form>
