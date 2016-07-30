<?php
@session_start();
require_once("../../../config.php");
require_once("../format_date.php");
require_once("../get_dates_array.php");
$data = get_dates_array();
$to = strtotime($_SESSION['to']);
$from = strtotime($_SESSION['from']);
unset($_SESSION['to']);
unset($_SESSION['from']);
	$values=array(
		"BA" => 0,
		"CS" => 0,
		"IDT" => 0,
		"INF" => 0,
		"GUJ-GW" => 0,
		"MF" => 0,
		"MF-H" => 0,
		"OPM-M" => 0,
		"OPM-T&G" => 0,
		"PLM-IM" => 0,
		"PLM-RE" => 0,
		"QM" => 0,
		"SPR" => 0,
		"SCM-EN" => 0,
		"SCM-DLR" => 0,
		"SCM-M" => 0,
		"SCM-P" => 0,
		"SCM-RS" => 0,
		"SCM-SRC" => 0,
		"USC" => 0
	);
for($i=0;$i<count($data);$i++) {
	global $values;
	if(strtotime($data[$i]['date'])>=$from && strtotime($data[$i]['date'])<=$to) {
		if($data[$i]['department_text']=="RC-IN H MF BA") $values["BA"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF CS") $values["CS"]++;
		elseif($data[$i]['department_text']=="RC-IN T IDT") $values["IDT"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF INF") $values["INF"]++;
		elseif($data[$i]['department_text']=="RC-IN SRE GUJ-GW") $values["GUJ-GW"]++;
		elseif($data[$i]['department_text']=="RC-IN H DX MF") $values["MF"]++;
		elseif($data[$i]['department_text']=="RC-IN HR MF-H GOA") $values["MF-H"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF OPM-M") $values["OPM-M"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF OPM-T&G") $values["OPM-T&G"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF PLM-IM") $values["PLM-IM"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF PLM-RE") $values["PLM-RE"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF QM") $values["QM"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF SPR") $values["SPR"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF SCM-EN") $values["SCM-EN"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF SCM-DLR") $values["SCM-DLR"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF SCM-M") $values["SCM-M"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF SCM-P") $values["SCM-P"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF SCM-RS") $values["SCM-RS"]++;
		elseif($data[$i]['department_text']=="RC-IN H MF SCM-SRC") $values["SCM-SRC"]++;
		elseif($data[$i]['department_text']=="RC-IN H CS USC") $values["USC"]++;
	}
}

	$img_width=850;
	$img_height=400; 
	$margins=20;

 
	# ---- Find the size of graph by substracting the size of borders
	$graph_width=$img_width - $margins * 2;
	$graph_height=$img_height - $margins * 2; 
	$img=imagecreate($img_width,$img_height);

 
	$bar_width=20;
	$total_bars=count($values);
	$gap= (($graph_width- $total_bars * $bar_width ) / ($total_bars +1));

 
	# -------  Define Colors ----------------
	$bar_color=imagecolorallocate($img,0,64,128);
	$background_color=imagecolorallocate($img,240,240,255);
	$border_color=imagecolorallocate($img,200,200,200);
	$line_color=imagecolorallocate($img,220,220,220);
 
	# ------ Create the border around the graph ------

	imagefilledrectangle($img,1,1,$img_width-2,$img_height-2,$border_color);
	imagefilledrectangle($img,$margins,$margins,$img_width-1-$margins,$img_height-1-$margins,$background_color);

 
	# ------- Max value is required to adjust the scale	-------
	$max_value=max($values);
	$ratio= $graph_height/$max_value;

 
	# -------- Create scale and draw horizontal lines  --------
	$horizontal_lines=20;
	$horizontal_gap=$graph_height/$horizontal_lines;

	for($i=1;$i<=$horizontal_lines;$i++){
		$y=$img_height - $margins - $horizontal_gap * $i ;
		imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
		$v=intval($horizontal_gap * $i /$ratio);
		imagestring($img,0,5,$y-5,$v,$bar_color);

	}
 
 
	# ----------- Draw the bars here ------
	for($i=0;$i< $total_bars; $i++){ 
		# ------ Extract key and value pair from the current pointer position
		list($key,$value)=each($values); 
		$x1= $margins + $gap + $i * ($gap+$bar_width) ;
		$x2= $x1 + $bar_width; 
		$y1=$margins +$graph_height- intval($value * $ratio) ;
		$y2=$img_height-$margins;
		imagestring($img,0,$x1+3,$y1-10,$value,$bar_color);
		imagestring($img,0,$x1+3,$img_height-15,$key,$bar_color);		
		imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color);
	}
	header("Content-type:image/png");
	imagepng($img);
	
?>