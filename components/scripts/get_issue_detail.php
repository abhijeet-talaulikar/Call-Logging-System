<?php
//get details about a issue based on ticket number
function get_issue_detail($t,$detail) {
		$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$ticket = $db->query("SELECT `".$detail."` FROM `issues` WHERE `ticket`='".$t."';");
			$row = $ticket->fetchAll(PDO::FETCH_ASSOC);
			return @$row[0][$detail];
		} catch(PDOException $e) {
			return 0;
		}
}

//get details about a new issue
function get_new_issue_detail($t,$detail) {
		$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$ticket = $db->query("SELECT `".$detail."` FROM `new_issues` WHERE `ticket`='".$t."';");
			$row = $ticket->fetchAll(PDO::FETCH_ASSOC);
			return @$row[0][$detail];
		} catch(PDOException $e) {
			return 0;
		}
}

//get details about a resolved issue
function get_resolved_issue_detail($t,$detail) {
		$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$ticket = $db->query("SELECT `".$detail."` FROM `resolved_issues` WHERE `ticket`='".$t."';");
			$row = $ticket->fetchAll(PDO::FETCH_ASSOC);
			return @$row[0][$detail];
		} catch(PDOException $e) {
			return 0;
		}
}

//check if issue exists
function issue_exists($t) {
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
		$stmt = $db->prepare("SELECT * FROM `issues` WHERE `ticket`=?");
		$stmt->execute(array($t));
		$row_count = $stmt->rowCount();
		return $row_count;
	} catch(PDOException $e) {
		die("Error");
	}
}

?>