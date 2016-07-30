<?php
//check if all fields are filled
function validate_form($entry) {
	@session_start();
	if((empty($entry['name']) || empty($entry['email']) || 
		empty($entry['department']) || empty($entry['related_to']) || empty($entry['location']) || empty($entry['description']))
		|| (empty($_POST["captcha"]) || $_SESSION["code"]!=$_POST["captcha"])
		) {
		unset($_SESSION['code']);
		return 0;
	} else return 1;
}
?>