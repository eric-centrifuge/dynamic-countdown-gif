<?php
$fonts = scandir("./fonts");
array_shift($fonts);
array_shift($fonts);
?>
<html>
	<head>
		<title>Dynamic PHP Counter</title>
		<script src="main.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
		<link rel="stylesheet" href="styles.css">
	</head>
	<body class="flex-center">
		<h1>Countdown Generator</h1>

		<div class="gifdisplay">
			<img id="countdowngif" src="" alt="">
		</div>

		<div class="options">
			<h2>Font</h2>

			<div class="fonts">
				<h3>Typeface</h3>
				<select name="font" id="font">
					<?php foreach ($fonts as $font): ?>
					<option><?php echo $font ?></option>
					<?php endforeach; ?>
				</select>	
			</div>

			<div class="font-size">
				<h3>Size</h3>
				<div class="">
					<label for="fsize1">Timestamp</label>
					<input type="number" name="fsize1" value="52">
				</div>
				<div class="">
					<label for="fsize2">Labels</label>
					<input type="number" name="fsize2" value="12">
				</div>
			</div>

			<div class="font-position">
				<h3>Positioning</h3>
				<div class="">
					<label for="fsize1">Timestamp X Offset</label>
					<input type="number" name="f1xoffset" value="0">
				</div>
				<div class="">
					<label for="fsize2">Timestamp Y Offset</label>
					<input type="number" name="f1yoffset" value="-20">
				</div>
				<div class="">
					<label for="fsize1">Labels X Offset</label>
					<input type="number" name="f2xoffset" value="0">
				</div>
				<div class="">
					<label for="fsize2">Labels Y Offset</label>
					<input type="number" name="f2yoffset" value="20">
				</div>
			</div>

			<div class="font-color">
				<h3>Color</h3>
				<div class="color-range">
					<label for="red">Red</label>
					<input type="number" name="red" min="0" max="255" value="0">
					<input type="range" name="red" min="0" max="255" value="0">
				</div>

				<div class="color-range">
					<label for="green">Green</label>
					<input type="number" name="green" min="0" max="255" value="0">
					<input type="range" name="green" min="0" max="255" value="0">
				</div>

				<div class="color-range">
					<label for="blue">Blue</label>
					<input type="number" name="blue" min="0" max="255" value="0">
					<input type="range" name="blue" min="0" max="255" value="0">
				</div>
			</div>
			
			<h2>Background</h2>

			<div class="bg-color">
				<h3>Color</h3>
				<div class="color-range">
					<label for="red">Red</label>
					<input type="number" name="red" min="0" max="255" value="255">
					<input type="range" name="red" min="0" max="255" value="255">
				</div>

				<div class="color-range">
					<label for="green">Green</label>
					<input type="number" name="green" min="0" max="255" value="255">
					<input type="range" name="green" min="0" max="255" value="255">
				</div>

				<div class="color-range">
					<label for="blue">Blue</label>
					<input type="number" name="blue" min="0" max="255" value="255">
					<input type="range" name="blue" min="0" max="255" value="255">
				</div>
			</div>
		</div>
	</body>
</html>