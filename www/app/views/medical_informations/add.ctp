<?php $crumb->addThisPage('Add Medical Information', null, 'auto'); ?>
<!--<div id="viewTitle" class="text-left">
<h1>Skeletal view: please refactor</h1>
</div>-->
<div class="span-16 prepend-3 append-3 notice large"
	<p>What would you like to do now?</p>
	<ol>
		<li><a href="/patients/view/<?php echo $pid; ?>">view this patient's record</a></li>
		<li><a href="/medical_informations/edit/<?php echo $pid; ?>">add some medical information</a></li>
		<li><a href="/patients/add">add another patient</a></li>
	</ol>
</div>