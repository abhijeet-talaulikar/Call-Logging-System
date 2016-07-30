<?php

//sends an email to the user that submits a new issue
function send_mail_submitted($email,$name) {
	require_once('PHPMailer-master/class.phpmailer.php');
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = true;
	$mail->Username = SMTP_USER;
	$mail->Password = SMTP_PASS;
	$mail->SMTPSecure = 'tls';
	$mail->Port = SMTP_PORT;
	$mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
	$mail->addAddress($email, $name);
	$mail->WordWrap = 50;
	$mail->isHTML(true);
	$mail->Subject = 'Your issue has been registered.';
	$mail->Body    = '';
	$mail->AltBody = '';
	$addr =
	str_replace('Employee', ucwords($name),
	str_replace('Ticket no:', 'Ticket no: '.$_REQUEST['ticket'], file_get_contents('C:\wamp\www\crs\data\mail_html\submitted.html'))
	);
	$mail->msgHTML($addr);
	$mail->send();
}

//send a notification to the admins when a new issue is registered
function send_mail_new_issue() {
	require_once('PHPMailer-master/class.phpmailer.php');
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = true;
	$mail->Username = SMTP_USER;
	$mail->Password = SMTP_PASS;
	$mail->SMTPSecure = 'tls';
	$mail->Port = SMTP_PORT;  
	$mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
	
	//get all admin email addresses
	$db = new PDO('mysql:host=localhost;dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
	$stmt = $db->prepare("SELECT * FROM `admins`");
	$stmt->execute();
	$num_users = $stmt->rowCount();
	} catch(PDOException $e) {
		die("Error");
	}
	require_once("components/scripts/user.php");
	$email = array(); //stores the names of the admins
	$name = array(); //stores the email addresses of the admins
	for($i=0; $i < $num_users; $i++) {
		$email[$i] = get_user_detail($i+1,'email');
		$name[$i] = ucwords(get_user_detail($i+1,'firstname').' '.get_user_detail($i+1,'lastname'));
	}
	//end get email addresses
	
	for($i=0; $i < count($email); $i++) {
		$mail->addAddress($email[$i],$name[$i]);
	}
	$mail->WordWrap = 50;
	$mail->isHTML(true);
	$mail->Subject = 'New issue has been registered.';
	$mail->Body    = '';
	$mail->AltBody = '';
	$addr =
	str_replace('Name: ', 'Name: '.ucwords($_REQUEST['name']),
	str_replace('Ticket no:', 'Ticket no: '.$_REQUEST['ticket'], file_get_contents('C:\wamp\www\crs\data\mail_html\new_issue.html'))
	);
	$mail->msgHTML($addr);
	$mail->send();
}

//sends a record to an employee
function send_mail_record($email,$name,$string) {
	require_once('PHPMailer-master/class.phpmailer.php');
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = true;
	$mail->Username = SMTP_USER;
	$mail->Password = SMTP_PASS;
	$mail->SMTPSecure = 'tls';
	$mail->Port = SMTP_PORT;  
	$mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
	$mail->addAddress($email, $name);
	$mail->WordWrap = 50;
	$mail->isHTML(true);
	$mail->Subject = 'Your record of issues.';
	$mail->Body    = '';
	$mail->AltBody = '';
	$addr =
	str_replace('Employee', $name,
	str_replace('<tr>data</tr>', $string, file_get_contents('C:\wamp\www\crs\data\mail_html\record.html'))
				);
	$mail->msgHTML($addr);
	$mail->send();
}

//send an email to the concerned persons of facility management
function send_mail_fm($email, $name) {
	require_once('PHPMailer-master/class.phpmailer.php');
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = true;
	$mail->Username = SMTP_USER;
	$mail->Password = SMTP_PASS;
	$mail->SMTPSecure = 'tls';
	$mail->Port = SMTP_PORT;
	$mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
	$mail->addAddress($email, $name);
	$mail->WordWrap = 50;
	$mail->isHTML(true);
	$mail->Subject = 'New issue related to facility management';
	$mail->Body    = '';
	$mail->AltBody = '';
	$name = explode(" ",$name);
	$addr =
	str_replace('Admin',ucwords($name[0]),
	str_replace('Name: ', 'Name: '.ucwords($_REQUEST['name']),
	str_replace('Ticket no:', 'Ticket no: '.$_REQUEST['ticket'], file_get_contents('C:\wamp\www\crs\data\mail_html\fm.html'))
	));
	$mail->msgHTML($addr);
	$mail->send();
}

//sends an email to the user whose issue is resolved
function send_mail_resolved($email,$name,$msg) {
	require_once('PHPMailer-master/class.phpmailer.php');
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = true;
	$mail->Username = SMTP_USER;
	$mail->Password = SMTP_PASS;
	$mail->SMTPSecure = 'tls';
	$mail->Port = SMTP_PORT;  
	$mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
	$mail->addAddress($email, $name);
	$mail->WordWrap = 50;
	$mail->isHTML(true);
	$mail->Subject = 'Your issue has been resolved.';
	$mail->Body    = '';
	$mail->AltBody = '';
	$addr =
	str_replace('something',$msg,
	str_replace('Employee', $name,
	str_replace('Ticket no:', 'Ticket no: '.$_REQUEST['ticket'], file_get_contents('C:\wamp\www\crs\data\mail_html\resolved.html'))
	));
	$mail->msgHTML($addr);
	$mail->send();
}

?>