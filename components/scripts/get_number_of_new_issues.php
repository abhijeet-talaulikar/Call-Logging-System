<?php

//get the number of new issues
function get_number_of_new_issues() {
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
	$stmt = $db->prepare("SELECT * FROM `new_issues`");
	$stmt->execute();
	$row_count = $stmt->rowCount();
	return $row_count;
	} catch(PDOException $e) {
		die("Error");
	}
}

?>