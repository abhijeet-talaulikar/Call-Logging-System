<?php

//display new issues in tabulated form
function display_new_issues($d, $order, $offset) {
	$order = strtoupper($order);
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	if($d == "nofilter") {
		$stmt = $db->query("SELECT * FROM `new_issues` ORDER BY `ticket` ".$order." LIMIT ".($offset*10).",10;");
		$i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$i++;
			if($i%2 !=0 ) $attr = ' class="pure-table-odd"'; else $attr = '';
			echo "<tr".$attr.">";
			echo '<td>'.$row['ticket'].'</td>';
			echo '<td><a href="admin.php?p=issue&ticket='.$row['ticket'].'" title="Click to view synopsis">'.
				ucwords(strtolower($row['name']))
				.'</a></td>';
			echo '<td>'.$row['date'].'</td>';
			echo '<td>'.$row['department_text'].'</td>';
			echo "</tr>";
		}
	} else {
		$stmt = $db->query("
		SELECT * FROM `new_issues` WHERE `department_text`='".str_replace('and','&',str_replace('_',' ',$d))."' ORDER BY `ticket` ".$order." LIMIT ".($offset*10).",10;"
		);
		$i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$i++;
			if($i%2 !=0 ) $attr = ' class="pure-table-odd"'; else $attr = '';
			echo "<tr".$attr.">";
			echo '<td>'.$row['ticket'].'</td>';
			echo '<td><a href="admin.php?p=issue&ticket='.$row['ticket'].'" title="Click to view synopsis">'.
				ucwords(strtolower($row['name']))
				.'</a></td>';
			echo '<td>'.$row['date'].'</td>';
			echo '<td>'.$row['department_text'].'</td>';
			echo "</tr>";
		}
	}
}

//display resolved issues in tabulated form
function display_resolved_issues($d, $order, $offset) {
	$order = strtoupper($order);
	$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	if($d == "nofilter") {
		$stmt = $db->query("SELECT * FROM `resolved_issues` ORDER BY `ticket` ".$order." LIMIT ".($offset*10).",10;");
		$i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$i++;
			if($i%2 !=0 ) $attr = ' class="pure-table-odd"'; else $attr = '';
			echo "<tr".$attr.">";
			echo '<td>'.$row['ticket'].'</td>';
			echo '<td><a href="admin.php?p=issue&ticket='.$row['ticket'].'" title="Click to view synopsis">'.
				ucwords(strtolower($row['name']))
				.'</a></td>';
			echo '<td>'.$row['resolved_date'].'</td>';
			echo '<td>'.$row['department_text'].'</td>';
			echo "</tr>";
		}
	} else {
		$stmt = $db->query("
		SELECT * FROM `resolved_issues` WHERE `department_text`='".str_replace('and','&',str_replace('_',' ',$d))."' ORDER BY `ticket` ".$order." LIMIT ".($offset*10).",10;"
		);
		$i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$i++;
			if($i%2 !=0 ) $attr = ' class="pure-table-odd"'; else $attr = '';
			echo "<tr".$attr.">";
			echo '<td>'.$row['ticket'].'</td>';
			echo '<td><a href="admin.php?p=issue&ticket='.$row['ticket'].'" title="Click to view synopsis">'.
				ucwords(strtolower($row['name']))
				.'</a></td>';
			echo '<td>'.$row['resolved_date'].'</td>';
			echo '<td>'.$row['department_text'].'</td>';
			echo "</tr>";
		}
	}
}

?>