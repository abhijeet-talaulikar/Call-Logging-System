<?php
	require_once("format_date.php");
	require_once("get_issue_detail.php");
	require_once("mail/send_mail.php");
	require_once("../../config.php");
	if(isset($_POST)) {
		send_mail_resolved(get_issue_detail($_POST['ticket'],'email'), ucwords(get_issue_detail($_POST['ticket'],'name')), $_POST['message']); //send an email to the concerned user regarding resolution of the issue
	}
	//marking a issue as resolved
		$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$stmt1 = $db->prepare("
			INSERT INTO `resolved_issues` VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);
			");
			$stmt1->execute(array(
				$_POST['ticket'],
				get_new_issue_detail($_POST['ticket'],'network_login'),
				get_new_issue_detail($_POST['ticket'],'name'),
				get_new_issue_detail($_POST['ticket'],'email'),
				get_new_issue_detail($_POST['ticket'],'telephone'),
				get_new_issue_detail($_POST['ticket'],'department'),
				get_new_issue_detail($_POST['ticket'],'department_text'),
				get_new_issue_detail($_POST['ticket'],'date'),
				get_new_issue_detail($_POST['ticket'],'time'),
				get_new_issue_detail($_POST['ticket'],'related_to'),
				get_new_issue_detail($_POST['ticket'],'location'),
				get_new_issue_detail($_POST['ticket'],'description'),
				format_date(date("Y-m-d"))
			));
			$stmt2 = $db->prepare("
			DELETE FROM `new_issues` WHERE `ticket`=?;
			");
			$stmt2->execute(array($_POST['ticket']));
			$stmt3 = $db->prepare("
			UPDATE `status` SET `status`='1' WHERE `ticket`=?;
			");
			$stmt3->execute(array($_POST['ticket']));
			$stmt4 = $db->prepare("
			UPDATE `issues` SET `resolved_date`=? WHERE `ticket`=?;
			");
			$stmt4->execute(array(format_date(date("Y-m-d")),$_POST['ticket']));
		} catch(PDOException $e) {
			return 0;
		}
?>