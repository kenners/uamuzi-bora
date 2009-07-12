<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>

	<?php
		echo $html->meta('icon');
		// Set up which CSS files we're calling for our layout
		// We're not including print.css from Blueprint in this array as we want it to override the others if media=print
		$css = array('blueprint/screen', 'blueprint/ie', 'blueprint/plugins/tabsplugin/screen');
		// Echo our print.css first so it takes precedence if media=print
		echo $html->css('blueprint/print', 'stylesheet', 'media="print"');
		// Echo our array of CSS sheets we set up above
		echo $html->css($css, 'stylesheet', 'media="screen, projection"');
		//echo $html->css('cake.generic');


		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<!-- Header -->
		<div class="prepend-top span-24 last">
			<!-- Title -->
			<div class="span-18">
				<h1>Uamuzi Bora</h1>
			</div>
			<!-- User box -->
			<div class="span-6 last">
			<?php if($session->check('Auth.User.id'))
				{
				echo $html->link('Logout', array('controller' => 'Users', 'action' => 'logout'));
				}
			?>
			</div>
		</div>
		<!-- Content -->
		<div class="prepend-1 span-22 append-1">

			<?php $session->flash('auth'); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<!-- Footer -->
		<div class="prepend-top prepend-1 span-22 append-1 last">
			<p>&copy; 2009 The Uamuzi Bora Project. Some Rights Reserved. Email: hello@uamuzibora.com</p>
		</div>
	</div>
	<!-- Debug Stuff - REMEMBER TO REMOVE BEFORE DEPLOYING!!! -->
	<?php echo $cakeDebug; ?>
</body>
</html>