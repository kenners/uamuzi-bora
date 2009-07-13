<div class="prepend-top prepend-6 span-10 append-6 text-center">

	<?php
	echo $html->tag('h3','Jambo! Please login to continue.');
	$session->flash('auth');
	echo $form->create('User', array('action' => 'login'));
	echo $form->inputs(array(
	    'legend' => __('Login', true),
	    'username',
	    'password'
	));
	//echo $form->end('Login');
	?>
	<div class="prepend-4 span-3 append-3 last">
		<button type="submit" class="button">
			<img src="/css/blueprint/plugins/buttons/icons/key.png" alt=""/> Login
		</button>
	</div>
</div>
