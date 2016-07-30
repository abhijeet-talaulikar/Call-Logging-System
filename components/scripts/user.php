<?php
//check if a user exists with certain username and password
function user_exists($username, $password) {
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
	$stmt = $db->prepare("SELECT * FROM `admins` WHERE `username`=? AND `password`=?");
	$stmt->execute(array($username, $password));
	$row_count = $stmt->rowCount();
	return $row_count;
	
	} catch(PDOException $e) {
		die("Error");
	}
}

//get a particular user's detail
function get_user_detail($id, $detail) {
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
		foreach($db->query("SELECT * FROM `admins` WHERE `id`='".$id."'") as $row) {
			return $row[$detail];
		}
	} catch(PDOException $e) {
		die("Error");
	}
}

//get a particular detail based on username
function get_user_detail_by_username($username, $detail) {
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
		foreach($db->query("SELECT * FROM `admins` WHERE `username`='".mysql_real_escape_string($username)."';") as $row) {
			return $row[$detail];
		}
	} catch(PDOException $e) {
		die("Error");
	}
}

?>