<?php
//get status from database
function show_status($ticket) {
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$status = $db->query("
SELECT `status` FROM `status` 
WHERE `ticket`='".$ticket."';
			");
			$t = $status->fetchAll(PDO::FETCH_ASSOC);
			return @$t[0]['status'];
		} catch(PDOException $e) {
			return 0;
		}
}
?>