<?php
@session_start();
require_once("../../../config.php");
require_once("../format_date.php");
require_once("../get_dates_array.php");
$data = get_dates_array();
$to = strtotime($_SESSION['to']);
$from = strtotime($_SESSION['from']);
	$values=array(
		"Jan" => 0,
		"Feb" => 0,
		"Mar" => 0,
		"Apr" => 0,
		"May" => 0,
		"Jun" => 0,
		"Jul" => 0,
		"Aug" => 0,
		"Sep" => 0,
		"Oct" => 0,
		"Nov" => 0,
		"Dec" => 0
	);
	global $values;
	for($i=0;$i<count($data);$i++) {
		if(strtotime($data[$i]['date'])<=$to && strtotime($data[$i]['date'])>=$from) {
			$date = explode("-",$data[$i]['date']);
			switch($date[1]) {
				case 1:
					$values["Jan"]++;
					break;
				case 2:
					$values["Feb"]++;
					break;
				case 3:
					$values["Mar"]++;
					break;
				case 4:
					$values["Apr"]++;
					break;
				case 5:
					$values["May"]++;
					break;
				case 6:
					$values["Jun"]++;
					break;
				case 7:
					$values["Jul"]++;
					break;
				case 8:
					$values["Aug"]++;
					break;
				case 9:
					$values["Sep"]++;
					break;
				case 10:
					$values["Oct"]++;
					break;
				case 11:
					$values["Nov"]++;
					break;
				case 12:
					$values["Dec"]++;
					break;
			}
		}
	}
	$img_width=550;
	$img_height=400; 
	$margins=20;

 
	# ---- Find the size of graph by subtracting the size of borders
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