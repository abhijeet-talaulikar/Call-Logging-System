<?php
//formats date of the form YYYY-MM-DD. E.g 2014-05-16 becomes 16 May 2014
function format_date($d) {
	$month = array("January","February","March","April","May","June","July","August","September","October","November","December");
	$date = explode("-",$d);
	if(($date[1]-1) != 10) $index = str_replace("0","",$date[1]-1);
	else $index = $date[1]-1;
	return $date[2]." ".$month[$index]." ".$date[0];
}

function deformat_date($d) {
	$date = explode(" ",$d);
	if($date[1]=="January") $month='01';
	elseif($date[1]=="February") $month='02';
	elseif($date[1]=="March") $month='03';
	elseif($date[1]=="April") $month='04';
	elseif($date[1]=="May") $month='05';
	elseif($date[1]=="June") $month='06';
	elseif($date[1]=="July") $month='07';
	elseif($date[1]=="August") $month='08';
	elseif($date[1]=="September") $month='09';
	elseif($date[1]=="October") $month='10';
	elseif($date[1]=="November") $month='11';
	elseif($date[1]=="December") $month='12';
	return $date[0]."-".$month."-".$date[2];
}
?>