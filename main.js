document.addEventListener('DOMContentLoaded', function ()
{
	class GIFOpts {
		constructor () {
			this.fontcolor = {
				red : 0,
				green : 0,
				blue : 0,
			}

			this.bgcolor = {
				red : 255,
				green : 255,
				blue : 255,
			}

			this.font1 = 'FrutigerLTStd-Black.ttf';
			this.font2 = 'FrutigerLTStd-Black.ttf';
			this.f1size = 57;
			this.f2size = 12;
			this.f1xoffset = 0;
			this.f1yoffset = -20;
			this.f2xoffset = 0;
			this.f2yoffset = 20;
			this.enddate = '';
		}

		buildQuery ()
		{
			let instance = this;
			let querystr = `?enddate=${this.enddate}&font1=${this.font1}&font2=${this.font2}&f1size=${this.f1size}&f2size=${this.f2size}&f1xoffset=${this.f1xoffset}&f1yoffset=${this.f1yoffset}&f2xoffset=${this.f2xoffset}&f2yoffset=${this.f2yoffset}`;
			let fontcolor = '';
			let bgcolor = '';

			Object.keys(instance.fontcolor).forEach(function(key,index,arr)
			{
				(arr.length > index + 1) ? fontcolor += instance.fontcolor[key] + ',' : fontcolor += instance.fontcolor[key];
			});

			querystr += `&fontcolor=${fontcolor}`;

			Object.keys(instance.bgcolor).forEach(function(key,index,arr)
			{
				(arr.length > index + 1) ? bgcolor += instance.bgcolor[key] + ',' : bgcolor += instance.bgcolor[key];
			});

			querystr += `&bgcolor=${bgcolor}`;

			return querystr;
		}
	}

	"use strict";

	let gifopts = new GIFOpts();
	let image = document.querySelector('#countdowngif');
	let options = document.querySelector('.options');

	// Update Colors

	options.querySelectorAll('input[type="range"]').forEach(function (input)
	{
		let coloroption;
		(input.dataset.color === 'font') ? coloroption = 'fontcolor' : coloroption = 'bgcolor';

		input.onchange = function ()
		{
			gifopts[coloroption][input.name] = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
			image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};

		input.oninput = function ()
		{
			options.querySelector('input[type="number"][data-color="'+input.dataset.color+'"][name="' + input.name + '"]').value = input.value;
		};
	});

	options.querySelectorAll('input[type="number"]').forEach(function (input)
	{
		let coloroption;
		(input.dataset.color === 'font') ? coloroption = 'fontcolor' : coloroption = 'bgcolor';

		input.onchange = function ()
		{
			gifopts[coloroption][input.name] = input.value;
			options.querySelector('input[type="range"][data-color="'+input.dataset.color+'"][name="' + input.name + '"]').value = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
			image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};
	});

	// Update Font Size/Position/Date

	options.querySelectorAll('.font-size input[type="number"],.font-position input[type="number"],.end-date input[type="date"]').forEach(function(input)
	{
		input.onchange = function ()
		{
			gifopts[input.name] = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
			image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};
	});

	// Update font

	options.querySelectorAll('.fonts select').forEach(function (input)
	{
		input.onchange = function (evt)
		{
			gifopts[evt.target.name] = evt.target.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
			image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
		}
	});

	// Initialize

	image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
	image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
	options.querySelector('select[name="font1"]').value = gifopts.font1;
	options.querySelector('select[name="font2"]').value = gifopts.font2;
});