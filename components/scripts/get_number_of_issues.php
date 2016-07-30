<?php

//get the count of issues in a certain interval of time
function get_number_of_issues($from, $to) {
	require_once("config.php");
	require_once("components/scripts/format_date.php");
	require_once("components/scripts/get_dates_array.php");
	$data = get_dates_array();
	$num = 0;
	for($i=0;$i<count($data);$i++) {
		if(strtotime($data[$i]['date'])<=strtotime($to) && strtotime($data[$i]['date'])>=strtotime($from)) {
			$num++;
		}
	}
	return $num;
}

?>