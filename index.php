<?php
date_default_timezone_set('America/New York');
include 'GIFEncoder.php';
include 'php52-fix.php';

// globals
$frames = [];	
$delays = [];
$loops = 0;

// create base image
function createFrame(array $color)
{
	$base_img = imagecreatetruecolor(600,200);
	$bg_color = imagecolorallocate($base_img, $color['red'] ?? 255, $color['green'] ?? 255, $color['blue'] ?? 255);
	imagefill($base_img, 0, 0, $bg_color);
	return $base_img;
}

// set font options
function setFontOpts(array $opts, $red, $green, $blue)
{
	$img = imagecreatetruecolor(600,200);
	$color = imagecolorallocate($img, $red, $green, $blue);
	imagedestroy($img);
	
	$font_opts = [
		'size'		=>	$opts['size'] ?? 47,
		'angle'		=>	$opts['angle'] ?? 0,
		'x_offset'	=>	$opts['x_offset'] ?? 0,
		'y_offset'	=>	$opts['y_offset'] ?? 60,
		'font_path'	=>	$opts['font_path'] ?? './Verdana.ttf',
		'text'		=>	$opts['text'] ?? '',
		'color'		=>	$color,
	];

	return $font_opts;
}

// set dates
$now = date_create('now');

if ($_GET['enddate'] && date_create($_GET['enddate']))
{
	$end_date = date_create($_GET['enddate']);
}
else
{
	$end_date = date_create('tomorrow');
}

// create timestamp frames
for ($i = 0; $i <= 60; $i++) {
	// check if date has passed
	if (
		$end_date->format('Y') < $now->format('Y') &&
		$end_date->format('m') < $now->format('m') &&
		$end_date->format('d') < $now->format('d')
	) {
		// logic here
	}

	$date_diff = $now->diff($end_date);
	$frame = createFrame([
		'red' 	=> 255,
		'green' => 255,
		'blue' 	=> 255
	]);
	
	// add leading zero if days left are less than 10
	if (strlen($date_diff->format('%a')) < 2) {
		$timestamp = $date_diff->format('0%a %H %I %S');
	}
	else {
		$timestamp = $date_diff->format('%a %H %I %S');
	}

	// set font options
	$countdown = setFontOpts(
		[
			'size' 		=> 52,
			'angle' 	=> 0,
			'x_offset' 	=> 90,
			'y_offset' 	=> 110,
			'font_path' => './FrutigerLTStd-Black.ttf',
			'text' 		=> $timestamp,
		],
		168, // red
		84, // green
		50 // blue
	);

	$labels = setFontOpts(
		[
			'size' 		=> 12,
			'angle' 	=> 0,
			'x_offset' 	=> 110,
			'y_offset' 	=> 140,
			'font_path' => './FrutigerLTStd-Black.ttf',
			'text' 		=> 'DAYS           HOURS         MINUTES       SECONDS',
		],
		168, // red
		84, // green
		50 // blue
	);

	// set frame delay
	$delays[] = 100;

	// create image in output buffer
	ob_start();
	imagettftext($frame,
		$countdown['size'],
		$countdown['angle'],
		$countdown['x_offset'],
		$countdown['y_offset'],
		$countdown['color'],
		$countdown['font_path'],
		$countdown['text']);
	imagettftext($frame,
		$labels['size'],
		$labels['angle'],
		$labels['x_offset'],
		$labels['y_offset'],
		$labels['color'],
		$labels['font_path'],
		$labels['text']);
	imagegif($frame);
	$frames[] = ob_get_contents();
	ob_end_clean();

	// add one second to current date
	$now->modify('+1 second');

	// wipe image from memory
	imagedestroy($frame);
}

// expire this image instantly
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
$gif = new AnimatedGif($frames, $delays, $loops);
$gif->display();