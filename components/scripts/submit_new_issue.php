<?php
//feed new issue into database
@session_start();
function submit_new_issue($entry) {
		$entry['name'] = strtolower($entry['name']);
		send_mail_submitted($entry['email'],ucwords($entry['name'])); //send an email to the user confirming submission
		send_mail_new_issue(); //send a notification to all the admins
		if($entry['related_to'] == "facility management") {
			//set the following to match the info of the concerned persons of facility management
			send_mail_fm("vijay.rana@siemens.com","Vijay Rana"); //send an email to the concerned persons of facility management
			send_mail_fm("paresh.narvekar@siemens.com","Paresh Narvekar");
		}
		if(empty($entry['date'])) $entry['date']=date("Y-m-d");
		$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$stmt = $db->prepare("
INSERT INTO `new_issues`
VALUES ('',?,?,?,?,?,?,?,?,?,?,?);
			");
			$stmt->execute(array($entry['network_login'],$entry['name'],$entry['email'],$entry['telephone'],$entry['department'],$entry['department_text'],
			@format_date(date("Y-m-d")),
			date("h:i"),$entry['related_to'],$entry['location'],$entry['description']));
			$stmt2 = $db->prepare("
INSERT INTO `status`
VALUES (?,'0');
			");
			$stmt2->execute(array($entry['ticket']));
			$stmt3 = $db->prepare("
INSERT INTO `issues`
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,'');
			");
			$stmt3->execute(array($entry['ticket'],$entry['network_login'],$entry['name'],$entry['email'],$entry['telephone'],
			$entry['department'],$entry['department_text'],@format_date(date("Y-m-d")),
			date("h:i"),$entry['related_to'],$entry['location'],$entry['description']));
			
		} catch(PDOException $e) {
			die("Error ".$e->getMessage());
		}
}

function set_ticket() {
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$ticket = $db->query("
SELECT `ticket` FROM `issues`
ORDER BY `ticket` DESC
LIMIT 1;
			");
			$t = $ticket->fetchAll(PDO::FETCH_ASSOC);
			return @$t[0]['ticket']+1;
		} catch(PDOException $e) {
			return 0;
		}
}
?>