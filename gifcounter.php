<?php

include 'GIFEncoder.php';

class GIFCounter extends AnimatedGif
{
	function __construct()
	{
		$this->frames = [];
		$this->delays = [];
		$this->loops = 0;
		$this->font1 = isset($_REQUEST['font1']) ? $_REQUEST['font1'] : 'Verdana.ttf';
		$this->font2 = isset($_REQUEST['font2']) ? $_REQUEST['font2'] : 'Verdana.ttf';
		$this->fontsize1 = isset($_REQUEST['f1size']) ? $_REQUEST['f1size'] : 52;
		$this->fontsize2 = isset($_REQUEST['f2size']) ? $_REQUEST['f2size'] : 12;
		$this->font1xoffset = isset($_REQUEST['f1xoffset']) ? $_REQUEST['f1xoffset'] : 0;
		$this->font1yoffset = isset($_REQUEST['f1yoffset']) ? $_REQUEST['f1yoffset'] : -20;
		$this->font2xoffset = isset($_REQUEST['f2xoffset']) ? $_REQUEST['f2xoffset'] : 0;
		$this->font2yoffset = isset($_REQUEST['f2yoffset']) ? $_REQUEST['f2yoffset'] : 20;
		$this->font_dir = './fonts/';
		$this->fontcolor = $this->setColor(isset($_REQUEST['fontcolor']) ? $_REQUEST['fontcolor'] : '0,0,0');
		$this->bgcolor = $this->setColor(isset($_REQUEST['bgcolor']) ? $_REQUEST['bgcolor'] : '255,255,255');
		$this->now = date_create('now');
		$this->end_date = isset($_REQUEST['enddate']) ? $_REQUEST['enddate'] : 'tomorrow';
		$this->text = isset($_REQUEST['text']) ? $_REQUEST['text'] : "TEXT HERE";
		$this->imageurl = isset($_REQUEST['image']) ? $_REQUEST['image'] : "";
		$this->imageurltype = isset($_REQUEST['imagetype']) ? $_REQUEST['imagetype'] : false;
	}

	public function begin()
	{
		if ($this->imageurltype === "singleframe") {
			$this->createSingleImage();
		}
		else {
			$this->createCountDown();
		}
	}

	public function createSingleImage()
	{
		$text = 
		[
			'size'		=> $this->fontsize1,
			'angle'		=> 0,
			'x_offset'	=> $this->font1xoffset,
			'y_offset'	=> $this->font1yoffset,
			'content'	=> $this->text,
			'font'		=> $this->font_dir . $this->font1,
            'column'    => 'all',
		];

		$frame = $this->createFrame();
		$this->addText($frame, $text);

		header('Content-Type: image/jpeg');
		imagejpeg($frame);

		// wipe image from memory
		imagedestroy($frame);

	}

	public function createCountDown()
	{
		date_default_timezone_set('America/New_York');
		$timestamps = $this->createTimeStamps();

		foreach ($timestamps as $timestamp)
		{
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
		}

		$gif = new AnimatedGif($this->frames, $this->delays, $this->loops);
		$gif->display();
	}

	private function setColor($rgb)
	{
		$color = [];
		$img = imagecreatetruecolor(1,1);

		// create array with rgb values
		if (count(explode(',', $rgb)) > 0)
		{
			$arr = explode(',', $rgb);
			for ($i=0; $i < 3; $i++)
			{
				$value = (isset($arr[$i])) ? $arr[$i] : 0;
				$color[] = $value;
			}
		}

		$color = imagecolorallocate($img, $color[0], $color[1], $color[2]);
		imagedestroy($img);

		return $color;
	}

	private function createTimeStamps()
	{
		$timestamps = [];

		if (date_create($this->end_date))
		{
			$this->end_date = date_create($this->end_date);
		}
		else
		{
			$this->end_date = date_create('tomorrow');
		}

		// create timestamp frames
		for ($i = 0; $i <= 25; $i++)
		{
			$date_diff = $this->now->diff($this->end_date);

			// check if end date has passed
			if ($this->now > $this->end_date)
			{
				// logic here
				$timestamp = [
					'days'		=> '00',
					'hours' 	=> '00',
					'minutes'	=> '00',
					'seconds'	=> '00',
				];
			}
			else
			{
				$timestamp = [
					'days'		=> $date_diff->format('%a'),
					'hours' 	=> $date_diff->format('%H'),
					'minutes'	=> $date_diff->format('%I'),
					'seconds'	=> $date_diff->format('%S'),
				];

				// add leading zero if days left are less than 10
				if (strlen($date_diff->format('%a')) < 2)
				{
					$timestamp['days'] = $date_diff->format('0%a');
				}

				// add one second to current date
				$this->now->modify('+1 second');
			}

			$timestamps[] = $timestamp;
		}

		return $timestamps;
	}

	private function createFrame()
	{
		if ($this->imageurl) {
			$base_img = imagecreatefromjpeg($this->imageurl);
		}
		else {
			$base_img = imagecreatetruecolor(600,200);
			imagefill($base_img, 0, 0, $this->bgcolor);
		}

		return $base_img;
	}

	private function addText($img, array $text)
	{
		// grab image/text dimensions
		$textbox = imagettfbbox(
			$text['size'],
			$text['angle'],
			$text['font'],
			isset($text['content']) ? $text['content'] : ''
		);

		$columwidth = (imagesx($img)/4);
		$xpos = null;

		// column placement
		switch ($text['column'])
		{
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
				$xpos = 0 + (imagesx($img) - $textbox[2])/2;
				break;
		}

		imagettftext(
			$img,
			$text['size'],
			$text['angle'],
			$xpos + (isset($text['x_offset']) ? $text['x_offset'] : 0),
			(imagesy($img) - $textbox[5])/2 + (isset($text['y_offset']) ? $text['y_offset'] : 0),
			$this->fontcolor,
			$text['font'],
			isset($text['content']) ? $text['content'] : ''
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