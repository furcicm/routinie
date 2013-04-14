<?php
session_start();
/*
 * SimpleModal Contact Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: contact-dist.php 254 2010-07-23 05:14:44Z emartin24 $
 *
 */

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none'>
		<script type='text/javascript' src='js/jquery.js'></script>
		<script type='text/javascript' src='js/jquery.placeholder.min.js'></script>
	<script>$(function() {
				$('input, textarea').placeholder(); 
			});</script>
	<div class='contact-content'>
		<div id='feedback-center'>
			<h1 class='contact-title custom-title'>Feedback</h1>
			<div class='contact-loading' style='display:none'></div>
			<div class='contact-message' style='display:none'></div>
			<form action='#' style='display:none'>
				<textarea id='contact-message' class='contact-input' name='message' cols='40' rows='4' tabindex='1004' style=\"resize:'none'\" placeholder='Describe Issue'></textarea>
				<br/>
				<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Back</button>
				<button type='submit' class='contact-send contact-button' tabindex='1006'>Send Feedback</button>
				<br/>
			</form>
		</div>
	</div>
</div>";

	echo $output;
}
else if ($action == "send") {
	$message = isset($_POST["message"]) ? $_POST["message"] : "";
	if (!empty($message)) {
		$file = "../feedback/{$_SESSION['name']}.txt";
		// Open the file to get existing content
		if (file_exists($file)) {
			$current = file_get_contents($file);
			// Append a new person to the file
			$current .= "\n\n" . date('m/d/Y h:i:s a', time()) . " -\n{$message}";
		}
		else {
			$current = date('m/d/Y h:i:s a', time()) . " -\n{$message}";
		}
		// Write the contents back to the file
		file_put_contents($file, $current);
	}
}

exit;

?>