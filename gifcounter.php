<?php

include 'GIFEncoder.php';

class GIFCounter extends AnimatedGif
{
	function __construct()
	{
		$this->frames = [];
		$this->delays = [];
		$this->loops = 0;
		$this->font1 = $_GET['font1'];
		$this->font2 = $_GET['font2'];
		$this->fontsize1 = $_GET['f1size'];
		$this->fontsize2 = $_GET['f2size'];
		$this->font1xoffset = $_GET['f1xoffset'];
		$this->font1yoffset = $_GET['f1yoffset'];
		$this->font2xoffset = $_GET['f2xoffset'];
		$this->font2yoffset = $_GET['f2yoffset'];
		$this->font_dir = './fonts/';
		$this->fontcolor = '0,0,0';
		$this->bgcolor = '255,255,255';
		$this->now = date_create('now');
		$this->end_date = $_GET['enddate'];
	}

	public function begin()
	{
		date_default_timezone_set('America/New_York');

		$this->bgcolor = $this->setColor($_GET['bgcolor'];
		$this->fontcolor = $this->setColor($_GET['fontcolor'];
		$timestamps = $this->createTimeStamps();

		foreach ($timestamps as $timestamp):
			$days = 
			[
				'size'		=> $this->fontsize1,
				'angle'		=> 0,
				'x_offset'	=> $this->font1xoffset,
				'y_offset'	=> $this->font1yoffset,
				'content'	=> $timestamp['days'],
				'font'		=> $this->font_dir . $this->font1,
				'column'	=> 1,
			];
			
			$days_label = 
			[
				'size'		=> $this->fontsize2,
				'angle'		=> 0,
				'x_offset'	=> $this->font2xoffset,
				'y_offset'	=> $this->font2yoffset,
				'content'	=> 'DAYS',
				'font'		=> $this->font_dir . $this->font2,
				'column'	=> 1,
			];

			$hours = 
			[
				'size'		=> $this->fontsize1,
				'angle'		=> 0,
				'x_offset'	=> $this->font1xoffset,
				'y_offset'	=> $this->font1yoffset,
				'content'	=> $timestamp['hours'],
				'font'		=> $this->font_dir . $this->font1,
				'column'	=> 2,
			];

			$hours_label = 
			[
				'size'		=> $this->fontsize2,
				'angle'		=> 0,
				'x_offset'	=> $this->font2xoffset,
				'y_offset'	=> $this->font2yoffset,
				'content'	=> 'HOURS',
				'font'		=> $this->font_dir . $this->font2,
				'column'	=> 2,
			];

			$minutes = 
			[
				'size'		=> $this->fontsize1,
				'angle'		=> 0,
				'x_offset'	=> $this->font1xoffset,
				'y_offset'	=> $this->font1yoffset,
				'content'	=> $timestamp['minutes'],
				'font'		=> $this->font_dir . $this->font1,
				'column'	=> 3,
			];

			$minutes_label = 
			[
				'size'		=> $this->fontsize2,
				'angle'		=> 0,
				'x_offset'	=> $this->font2xoffset,
				'y_offset'	=> $this->font2yoffset,
				'content'	=> 'MINUTES',
				'font'		=> $this->font_dir . $this->font2,
				'column'	=> 3,
			];

			$seconds = 
			[
				'size'		=> $this->fontsize1,
				'angle'		=> 0,
				'x_offset'	=> $this->font1xoffset,
				'y_offset'	=> $this->font1yoffset,
				'content'	=> $timestamp['seconds'],
				'font'		=> $this->font_dir . $this->font1,
				'column'	=> 4,
			];

			$seconds_label = 
			[
				'size'		=> $this->fontsize2,
				'angle'		=> 0,
				'x_offset'	=> $this->font2xoffset,
				'y_offset'	=> $this->font2yoffset,
				'content'	=> 'SECONDS',
				'font'		=> $this->font_dir . $this->font2,
				'column'	=> 4,
			];

			$frame = $this->createFrame();
			$this->addText($frame, $days);
			$this->addText($frame, $days_label);
			$this->addText($frame, $hours);
			$this->addText($frame, $hours_label);
			$this->addText($frame, $minutes);
			$this->addText($frame, $minutes_label);
			$this->addText($frame, $seconds);
			$this->addText($frame, $seconds_label);
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

			$timestamp = [
				'days'		=> $date_diff->format('%a'),
				'hours' 	=> $date_diff->format('%H'),
				'minutes'	=> $date_diff->format('%I'),
				'seconds'	=> $date_diff->format('%S'),
			];
			
			// add leading zero if days left are less than 10
			if (strlen($date_diff->format('%a')) < 2):
				$timestamp['days'] = $date_diff->format('0%a');
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
		// grab image/text dimensions
		$textbox = imagettfbbox(
			$text['size'],
			$text['angle'],
			$text['font'],
			$text['content']'
		);

		$columwidth = (imagesx($img)/4);
		$xpos;

		// column placement
		switch ($text['column']) {
			case '1':
				$xpos = 0 + ($columwidth - $textbox[2])/2;
				break;
			
			case '2':
				$xpos = ($columwidth*2) - ($columwidth) + ($columwidth - $textbox[2])/2;
				break;

			case '3':
				$xpos = ($columwidth*2) + ($columwidth - $textbox[2])/2;
				break;

			case '4':
				$xpos = ($columwidth*2) + ($columwidth) + ($columwidth - $textbox[2])/2;
				break;

			default:
				$xpos = 0 + ($columwidth - $textbox[2])/2;
				break;
		}

		imagettftext(
			$img,
			$text['size'],
			$text['angle'],
			$xpos + ((int) $text['x_offset'],
			(imagesy($img) - $textbox[5])/2 + ((int) $text['y_offset'],
			$this->fontcolor,
			$text['font'],
			$text['content']'
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