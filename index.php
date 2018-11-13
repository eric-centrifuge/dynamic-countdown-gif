<html>
	<head>
		<title>Dynamic PHP Counter</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" />
		<link rel="stylesheet" href="styles.css">
		<script src="main.js"></script>
	</head>
	<body class="flex-center">
		<div id="app">
			<h1 style="text-align: center;">Countdown Generator</h1>

			<div class="gifdisplay">
				<a href="" target="_blank">
					<img id="countdowngif" src="" alt="">
				</a>
			</div>

			<div class="options container">
				<label class="sections" for="typeface">Typeface</label>
				<input name="controls" type="radio" id="typeface">
				<div class="fonts row">
					<div class="col-xs-12 col-sm-6">
						<label for="font1">Timestamp</label>
						<select name="font1">
							<optgroup label="TTF Fonts">
								<?php foreach (glob("./fonts/*.ttf") as $font): ?>
								<option><?php echo str_replace("./fonts/", "", $font) ?></option>
								<?php endforeach; ?>
							</optgroup>
							<optgroup label="OTF Fonts">
								<?php foreach (glob("./fonts/*.otf") as $font): ?>
								<option><?php echo str_replace("./fonts/", "", $font) ?></option>
								<?php endforeach; ?>
							</optgroup>
						</select>
					</div>
				
					<div class="col-xs-12 col-sm-6">
						<label for="font2">Labels</label>
						<select name="font2">
							<optgroup label="TTF Fonts">
								<?php foreach (glob("./fonts/*.ttf") as $font): ?>
								<option><?php echo str_replace("./fonts/", "", $font) ?></option>
								<?php endforeach; ?>
							</optgroup>
							<optgroup label="OTF Fonts">
								<?php foreach (glob("./fonts/*.otf") as $font): ?>
								<option><?php echo str_replace("./fonts/", "", $font) ?></option>
								<?php endforeach; ?>
							</optgroup>
						</select>
					</div>
				</div>
				
				<label class="sections" for="fontsize">Font Size</label>
				<input name="controls" type="radio" id="fontsize">
				<div class="font-size row">
					<div class="col-xs-12 col-sm-6">
						<label for="f1size">Timestamp</label>
						<input type="number" name="f1size" value="52">
					</div>
					<div class="col-xs-12 col-sm-6">
						<label for="f2size">Labels</label>
						<input type="number" name="f2size" value="12">
					</div>
				</div>

				<label class="sections" for="positioning">Positioning</label>
				<input name="controls" type="radio" id="positioning">
				<div class="font-position row">
					<div class="col-xs-12 col-sm-6">
						<label for="f1size">Timestamp X Offset</label>
						<input type="number" name="f1xoffset" value="0">
						<br>
						<label for="f2size">Timestamp Y Offset</label>
						<input type="number" name="f1yoffset" value="-20">
					</div>
					<div class="col-xs-12 col-sm-6">
						<label for="f1size">Labels X Offset</label>
						<input type="number" name="f2xoffset" value="0">
						<br>
						<label for="f2size">Labels Y Offset</label>
						<input type="number" name="f2yoffset" value="20">
					</div>
				</div>

				<label class="sections" for="fontcolor">Font Color</label>
				<input name="controls" type="radio" id="fontcolor" checked>
				<div class="font-color">
					<div class="col-xs-12 col-sm-4 color-range">
						<label for="red">Red</label>
						<input data-color="font" type="number" name="red" min="0" max="255" value="0">
						<input data-color="font" type="range" name="red" min="0" max="255" value="0">
					</div>

					<div class="col-xs-12 col-sm-4 color-range">
						<label for="green">Green</label>
						<input data-color="font" type="number" name="green" min="0" max="255" value="0">
						<input data-color="font" type="range" name="green" min="0" max="255" value="0">
					</div>

					<div class="col-xs-12 col-sm-4 color-range">
						<label for="blue">Blue</label>
						<input data-color="font" type="number" name="blue" min="0" max="255" value="0">
						<input data-color="font" type="range" name="blue" min="0" max="255" value="0">
					</div>
				</div>

				<label class="sections" for="bgcolor">Background Color</label>
				<input name="controls" type="radio" id="bgcolor">
				<div class="bg-color">
					<div class="col-xs-12 col-sm-4 color-range">
						<label for="red">Red</label>
						<input data-color="background" type="number" name="red" min="0" max="255" value="255">
						<input data-color="background" type="range" name="red" min="0" max="255" value="255">
					</div>

					<div class="col-xs-12 col-sm-4 color-range">
						<label for="green">Green</label>
						<input data-color="background" type="number" name="green" min="0" max="255" value="255">
						<input data-color="background" type="range" name="green" min="0" max="255" value="255">
					</div>

					<div class="col-xs-12 col-sm-4 color-range">
						<label for="blue">Blue</label>
						<input data-color="background" type="number" name="blue" min="0" max="255" value="255">
						<input data-color="background" type="range" name="blue" min="0" max="255" value="255">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>