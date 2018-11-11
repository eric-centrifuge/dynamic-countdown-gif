<?php

include 'GIFEncoder.php';

class GIFCounter extends AnimatedGif
{
	public $frames;
	public $delays;
	public $loops;
	public $fontcolor;
	public $bgcolor;
	public $now;
	public $end_date;

	function __construct()
	{
		$this->frames = [];
		$this->delays = [];
		$this->loops = 0;
		$this->fontcolor = '0,0,0';
		$this->bgcolor = '255,255,255';
		$this->now = date_create('now');
		$this->end_date = $_GET['enddate'] ?? 'tomorrow';
	}

	public function begin()
	{
		date_default_timezone_set('America/New_York');

		$this->bgcolor = $this->setColor($_GET['bgcolor'] ?? '255,255,255');
		$this->fontcolor = $this->setColor($_GET['fontcolor'] ?? '0,0,0');
		$timestamps = $this->createTimeStamps();

		foreach ($timestamps as $timestamp):
			$counter = 
			[
				'size'		=> 52,
				'angle'		=> 0,
				'x_offset'	=> 90,
				'y_offset'	=> 110,
				'font_path'	=> './FrutigerLTStd-Black.ttf',
				'content'	=> $timestamp,
			];

			$text = 
			[
				'size'		=> 12,
				'angle'		=> 0,
				'x_offset'	=> 108,
				'y_offset'	=> 140,
				'font_path'	=> './FrutigerLTStd-Black.ttf',
				'content'	=> 'DAYS           HOURS         MINUTES       SECONDS',
			];

			$frame = $this->createFrame();
			$this->addText($frame, $counter);
			$this->addText($frame, $text);
			$this->addFrame($frame);
			$this->delays[] = 100;

			// wipe image from memory
			imagedestroy($frame);
		endforeach;

		$gif = new AnimatedGif($this->frames, $this->delays, $this->loops);
		$gif->display();
	}

	private function setColor(string $rgb)
	{
		$color = [];
		$img = imagecreatetruecolor(1,1);

		// create array with rgb values
		if (count(explode(',', $rgb)) > 0):
			$arr = explode(',', $rgb);
			for ($i=0; $i < 3; $i++):
				$value = (isset($arr[$i])) ? (int) $arr[$i] : 0;
				$color[] = $value;
			endfor;
		endif;

		$color = imagecolorallocate($img, $color[0], $color[1], $color[2]);
		imagedestroy($img);

		return $color;
	}

	private function createTimeStamps()
	{
		$timestamps = [];

		if (date_create($this->end_date)):
			$this->end_date = date_create($this->end_date);
		else:
			$this->end_date = date_create('tomorrow');
		endif;

		// create timestamp frames
		for ($i = 0; $i <= 60; $i++):
			// check if date has passed
			if (
				$this->end_date->format('Y') < $this->now->format('Y') &&
				$this->end_date->format('m') < $this->now->format('m') &&
				$this->end_date->format('d') < $this->now->format('d')
			):
				// logic here
			endif;

			$date_diff = $this->now->diff($this->end_date);
			
			// add leading zero if days left are less than 10
			if (strlen($date_diff->format('%a')) < 2):
				$timestamp = $date_diff->format('0%a %H %I %S');
			else:
				$timestamp = $date_diff->format('%a %H %I %S');
			endif;

			$timestamps[] = $timestamp;

			// add one second to current date
			$this->now->modify('+1 second');
		endfor;

		return $timestamps;
	}

	private function createFrame()
	{
		$base_img = imagecreatetruecolor(600,200);
		imagefill($base_img, 0, 0, $this->bgcolor);

		return $base_img;
	}

	private function addText($img, array $text)
	{
		imagettftext(
			$img,
			$text['size'] ?? 47,
			$text['angle'] ?? 0,
			$text['x_offset'] ?? 0,
			$text['y_offset'] ?? 60,
			$this->fontcolor,
			$text['font_path'] ?? './Verdana.ttf',
			$text['content'] ?? ''
		);
	}

	private function addFrame($frame)
	{
		// create image in output buffer
		ob_start();
		imagegif($frame);
		$this->frames[] = ob_get_contents();
		ob_end_clean();
	}
}