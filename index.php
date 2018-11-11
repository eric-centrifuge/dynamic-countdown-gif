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
			<div class="fonts">
				<h2>Font</h2>
				<select name="font" id="font">
					<?php foreach (glob("*.ttf") as $font): ?>
					<option><?php echo $font ?></option>
					<?php endforeach; ?>
				</select>	
			</div>

			<div class="font-color">
				<h2>Font Color</h2>
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

			<div class="bg-color">
				<h2>Background Color</h2>
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