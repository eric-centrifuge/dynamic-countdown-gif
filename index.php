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
			<h1 style="text-align: center;">PHP Image Generator</h1>

			<div class="gifdisplay">
				<a href="" target="_blank">
					<img id="frame" src="" alt="">
				</a>
			</div>

			<div class="options container">
                <div class="image-type">
                    <input type="radio" id="countdown" name="imagetype" value="countdown" checked>
                    <label for="countdown">Count Down</label>
                    <input type="radio" id="singleframe" name="imagetype" value="singleframe">
                    <label for="singleframe">Single Image</label>
                </div>

				<label class="sections" for="text">Text</label>
				<input name="controls" type="radio" id="text">
				<div class="text">
					<input type="text" name="text" value="" style="display:block;width:100%;">
				</div>

				<label class="sections" for="enddate">End Date</label>
				<input name="controls" type="radio" id="enddate" checked>
				<div class="enddate row">
					<div class="col-xs-12 col-sm-6">
						<label for="enddate">End Date</label>
						<input type="date" name="enddate">
					</div>
				</div>

				<label class="sections" for="typeface">Typeface</label>
				<input name="controls" type="radio" id="typeface">
				<div class="fonts row">
					<div class="col-xs-12 col-sm-6">
                        <?php
                            $ttf_fonts = glob("./fonts/*.ttf");
                            $otf_fonts = glob("./fonts/*.otf");
                        ?>
						<label for="font1">Font #1</label>
						<select name="font1">
                            <?php
                            foreach ($ttf_fonts as $font):
                                if ($ttf_fonts[0] === $font):
                                    $selected = 'selected';
                                else:
                                    $selected = "";
                                endif;

                                $font = str_replace("./fonts/", "", $font);
                            ?>
                                <option <?php echo $selected; ?> value="<?php echo $font; ?>"><?php echo $font ?></option>
                            <?php endforeach; ?>

                            <?php
                            foreach ($otf_fonts as $font):
                                if ($otf_fonts[0] === $font):
                                    $selected = "selected";
                                else:
                                    $selected = "";
                                endif;
                                $font = str_replace("./fonts/", "", $font);
                            ?>
                                <option <?php echo $selected; ?> value="<?php echo $font; ?>"><?php echo $font ?></option>
                            <?php endforeach; ?>
						</select>
					</div>

					<div class="col-xs-12 col-sm-6">
						<label for="font2">Font #2</label>
						<select name="font2">
                            <?php
                            foreach ($ttf_fonts as $font):
                                if ($ttf_fonts[0] === $font):
                                    $selected = "selected";
                                else:
                                    $selected = "";
                                endif;
                                $font = str_replace("./fonts/", "", $font);
                            ?>
                                <option <?php echo $selected; ?> value="<?php echo $font; ?>"><?php echo $font ?></option>
                            <?php endforeach; ?>

                            <?php
                            foreach ($otf_fonts as $font):
                                if ($otf_fonts[0] === $font):
                                    $selected = "selected";
                                else:
                                    $selected = "";
                                endif;
                                $font = str_replace("./fonts/", "", $font);
                            ?>
                                <option <?php echo $selected; ?> value="<?php echo $font; ?>"><?php echo $font ?></option>
                            <?php endforeach; ?>
						</select>
					</div>
				</div>

				<label class="sections" for="fontsize">Font Size</label>
				<input name="controls" type="radio" id="fontsize">
				<div class="font-size row">
					<div class="col-xs-12 col-sm-6">
						<label for="f1size">Font #1</label>
						<input type="number" name="f1size" value="52">
					</div>
					<div class="col-xs-12 col-sm-6">
						<label for="f2size">Font #2</label>
						<input type="number" name="f2size" value="12">
					</div>
				</div>

				<label class="sections" for="positioning">Positioning</label>
				<input name="controls" type="radio" id="positioning">
				<div class="font-position row">
					<div class="col-xs-12 col-sm-6">
						<label for="f1size">Font #1 X Offset</label>
						<input type="number" name="f1xoffset" value="0">
						<br>
						<label for="f2size">Font #1 Y Offset</label>
						<input type="number" name="f1yoffset" value="-20">
					</div>
					<div class="col-xs-12 col-sm-6">
						<label for="f1size">Font #2 X Offset</label>
						<input type="number" name="f2xoffset" value="0">
						<br>
						<label for="f2size">Font #2 Y Offset</label>
						<input type="number" name="f2yoffset" value="20">
					</div>
				</div>

				<label class="sections" for="fontcolor">Font Color</label>
				<input name="controls" type="radio" id="fontcolor">
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

				<label class="sections" for="bgimage">Background Image</label>
				<input name="controls" type="radio" id="bgimage">
				<div class="bgimage">
					<label for="image">Image URL</label>
					<input type="text" name="image" value="" style="display:block;width:100%;">
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