<?php
if(isset($_POST['submit'])) {
	require_once("components/scripts/employee.php");
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$stmt = $db->query("SELECT * FROM `issues` WHERE `network_login`='".mysql_real_escape_string($_POST['network_login'])."';");
	if($stmt->rowCount()) {
		$string = '';
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			if(!empty($row['resolved_date'])) $status=$row['resolved_date']; else $status="In process";
			$string.=
					'<tr>
						<td>'.$row['ticket'].'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['department'].'</td>
						<td>'.$row['location'].'</td>
						<td>'.$status.'</td></tr>';
		}
		send_mail_record(get_employee_detail($_POST['network_login'], 'email'),ucwords(get_employee_detail($_POST['network_login'], 'firstname')),$string);
	}
	echo "
	<h1 class="content-subhead">Success</h1>
	<h4>Your record has been emailed to you.</h4><br />
	";
}
?>
