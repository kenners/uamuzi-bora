<?php $crumb->addThisPage('Add Medical Information', null, 'auto'); ?>
<!--<div id="viewTitle" class="text-left">
<h1>Skeletal view: please refactor</h1>
</div>-->
<h2>What would you like to do now?</h2>
<div class="span-16 prepend-3 append-3 last">
	<div>
		<a href="/patients/view/<?php echo $pid; ?>" class="button"><img src="/img/icons/magnifier.png">View this patient's record</a>
	</div>
	<div>
		<a href="/medical_informations/edit/<?php echo $pid; ?>" class="button"><img src="/img/icons/add.png">Add some medical information</a>
	</div>
	<div>
		<a href="/patients/add" class="button"><img src="/img/icons/application_form_add.png">Add another patient</a>
	</div>
</div>