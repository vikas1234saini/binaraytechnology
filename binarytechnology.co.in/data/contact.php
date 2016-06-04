<?php
include ("../include/config.inc.php");
include ("../classes/main.php");
	
$mainObj = new mainClass($attributes,$config);

$action = isset($attributes["action"]) ? $attributes["action"] : "";
if (empty($action)) {

	$output = "<div style='display:none'>
	<div class='contact-top'></div>
	<div class='contact-content'>
		<h1 class='contact-title'>".$attributes['title']."</h1>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form action='#' style='display:none'>
			<label for='contact-name'>*Name:</label>
			<input type='text' id='contact-name' class='contact-input' name='txtYourName' tabindex='1001' />
			<label for='contact-email'>*Email:</label>
			<input type='text' id='contact-email' class='contact-input' name='txtEmail' tabindex='1002' />";
		$output .= "
			<label for='contact-subject'>Contact No.:</label>
			<input type='text' id='contact-subject' class='contact-input' name='txtPhone' value='' tabindex='1003' />";

		$output .= "
			<label for='contact-subject'>Subject:</label>
			<input type='text' id='contact-phone' class='contact-input' name='txtSubject' value='' tabindex='1004' />";

	$output .= "
			<label for='contact-message'>*Message:</label>
			<textarea id='contact-message' class='contact-input' name='txtMessge' cols='40' rows='4' tabindex='1005'></textarea>
			<br/>";

	$output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>Send</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Cancel</button>
			<br/>
			<input name='addcontact' value='addcontact' id='addcontact' type='hidden' /> 
			<input name='contactFor' value='".$attributes['title']."' type='hidden' /> 
		</form>
	</div>
</div>";

	echo $output;
}
else if ($action == "send") {
	$data = $mainObj->addEditContactUs();
	// make sure the token matches
	if (isset($data['msg']) && $data['msg']!='') {
		echo $data['msg'];
	} else {
		echo "Your message could not be sent.";
	}
}
exit;

?>