<?php

function paginate($table, $filter, $order) {
	if(!empty($filter)) $where = "WHERE `department_text`='".$filter."';";
	else $where =";";
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
		$stmt = $db->prepare("SELECT * FROM `".$table."` ".$where);
		$stmt->execute();
		$row_count = $stmt->rowCount();
		if(!isset($_GET['d']) || empty($_GET['d'])) $d = ''; else $d = '&d='.$_GET['d'];
		$string='';
		for($i=1;$i<=($row_count/10)+1;$i++) {
			if(!isset($_GET['page']) || empty($_GET['page'])) {
				if($i==1) {
					$attr = ' pure-button-active';
				} else $attr='';
			} else {
				if($_GET['page']==$i) {
					$attr = ' pure-button-active';
				} else $attr = '';
			}
			$string.= '<li><a class="pure-button'.$attr.'" href="admin.php?p='.$_GET['p'].$d.'&order='.$order.'&page='.$i.'">'.$i.'</a></li>';
		}
		return $string;
	} catch(PDOException $e) {
		die("Error");
	}
}

function paginate_search($status) {
	if(!empty($status) && $status!='All') {
		if($status=="in_process") $where = "WHERE `resolved_date`='';";
		elseif($status=="resolved") $where = "WHERE `resolved_date`!='';";
	} else $where =";";
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	try {
		$stmt = $db->prepare("SELECT * FROM `issues` ".$where);
		$stmt->execute();
		$row_count = $stmt->rowCount();
		$string='';
		for($i=1;$i<=($row_count/10)+1;$i++) {
			if(!isset($_GET['page']) || empty($_GET['page'])) {
				if($i==1) {
					$attr = ' pure-button-active';
				} else $attr='';
			} else {
				if($_GET['page']==$i) {
					$attr = ' pure-button-active';
				} else $attr = '';
			}
			$string.= '<li><a class="pure-button'.$attr.'" href="admin.php?p=search_by_name&name='.$_GET['name'].'&page='.$i.'&status='.$status.'">'.$i.'</a></li>';
		}
		return $string;
	} catch(PDOException $e) {
		die("Error");
	}
}

?>