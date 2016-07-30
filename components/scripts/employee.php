<?php

//get an employee's detail
function get_employee_detail($login, $detail) {
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
		foreach($db->query("SELECT * FROM `employees` WHERE `network_login`='".mysql_real_escape_string($login)."';") as $row) {
			return $row[$detail];
		}
	} catch(PDOException $e) {
		die("Error");
	}
}

?>