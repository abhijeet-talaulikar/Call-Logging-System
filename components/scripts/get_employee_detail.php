<?php
	require_once("../../config.php");
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
		foreach($db->query("SELECT * FROM `employees` WHERE `network_login`='".$_POST['login']."';") as $row) {
			echo $row[$_POST['detail']];
		}
	} catch(PDOException $e) {
		echo '';
	}
?>