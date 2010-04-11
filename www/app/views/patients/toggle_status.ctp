<div id="viewTitle" class="text-center span-16" style="height:100px;margin-top:-10px;">

</div>
<div class="pull-6 span-21">
<?php

echo $form->create('Patient', array('url' => '/patients/toggleStatus/' . $pid));
echo $form->hidden('referer', array('value' => $referer));
echo $form->input('inactive_reason_id');
?>
	<button type="submit" class="button positive">
		<img src="/css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Confirm 
	</button>
</div>
</form>
