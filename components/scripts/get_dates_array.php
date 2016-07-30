<?php
//get all issues in a certain interval
function get_dates_array() {
		$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try {
			$stmt = $db->query("SELECT * FROM `issues`;");
			$issues = array();
			$i=0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				global $issues;
				$issues[$i]['department'] = $row['department'];
				$issues[$i]['department_text'] = $row['department_text'];
				$issues[$i]['date'] = deformat_date($row['date']);
				$i++;
			}
			return $issues;
		} catch(PDOException $e) {
			return 0;
		}
}
?>