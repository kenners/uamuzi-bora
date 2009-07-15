<div id="viewTitle" class="text-left">
<h1>Skeleton view for choosing an inactive reason</h1>
</div>

<?php
echo $form->create('Patient', array('url' => '/patients/toggleStatus/' . $pid));
echo $form->hidden('referer', array('value' => $referer));
echo $form->input('inactive_reason_id');
echo $form->end('Submit');
?>
