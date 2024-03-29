<?php

require_once "../vendor/autoload.php";

use GDText\Box;
use GDText\Color;

$text = $_REQUEST['txt'];

$im = imagecreatetruecolor(500, 35);
$backgroundColor = imagecolorallocate($im, 0, 0, 0);
imagefill($im, 0, 0, imagecolortransparent($im, NULL));


$box = new Box($im);
$box->setFontFace("../images/martel.ttf"); // http://www.dafont.com/elevant-by-pelash.font
$box->setFontSize(24);
$box->setFontColor(new Color(240, 209, 164));
$box->setBox(4, -4, 260, 28);
$box->setTextAlign('left', 'top');

$box->setStrokeColor(new Color(1, 1, 1)); // Set stroke color
$box->setStrokeSize(0); // Stroke size in pixels

$box->draw($text); // Text to draw

header("Content-type: image/png;");
imagepng($im, NULL, 9, PNG_ALL_FILTERS);
die();

/*
	$text = $_GET['txt'];
	$text = strtoupper($text[0]).substr($text,1,strlen($text));
	$size = 18;
	$sizex = 280;
	$sizey = 28;
	$x = 4;
	$y = 20;
	$color = 'efcfa4';
		$red = (int)hexdec(substr($color,0,2));
		$green = (int)hexdec(substr($color,2,2));
		$blue = (int)hexdec(substr($color,4,2));
	$img = imagecreatetruecolor($sizex,$sizey);
	ImageColorTransparent($img, ImageColorAllocate($img,0,0,0));
	
	imagefttext($img, $size, 0, $x, $y, ImageColorAllocate($img,$red,$green,$blue), '../images/martel.ttf', $text);
	
	header('Content-type: image/png');
	imagepng($img);
	imagedestroy($img);
*/