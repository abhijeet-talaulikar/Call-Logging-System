<?php
session_start();
$code=rand(1000,9999);
$_SESSION["code"]=$code;
$im = imagecreatetruecolor(100, 48);
$bg = imagecolorallocate($im, 58, 175, 143); //background color blue
$fg = imagecolorallocate($im, 255, 255, 255);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 15, 30, 15,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>
