document.addEventListener('DOMContentLoaded', function ()
{
	class GIFOpts {
		constructor () {
			this.fontcolor = {
				red : 0,
				green : 0,
				blue : 0,
			};

			this.bgcolor = {
				red : 255,
				green : 255,
				blue : 255,
			}

			this.font = 'FrutigerLTStd-Black.ttf';
		}

		buildQuery ()
		{
			let instance = this;
			let querystr = '?';
			let fontcolor = '';
			let bgcolor = '';

			Object.keys(instance.fontcolor).forEach(function(key,index,arr)
			{
				(arr.length > index + 1) ? fontcolor += instance.fontcolor[key] + ',' : fontcolor += instance.fontcolor[key];
			});

			Object.keys(instance.bgcolor).forEach(function(key,index,arr)
			{
				(arr.length > index + 1) ? bgcolor += instance.bgcolor[key] + ',' : bgcolor += instance.bgcolor[key];
			});

			querystr += `font=${this.font}&fontcolor=${fontcolor}&bgcolor=${bgcolor}`;

			return querystr;
		}
	}

	"use strict";

	let gifopts = new GIFOpts();
	let image = document.querySelector('#countdowngif');
	let options = document.querySelector('.options');

	// Update Font Color

	options.querySelectorAll('.font-color input[type="range"]').forEach(function(input)
	{
		input.onchange = function ()
		{
			gifopts.fontcolor[input.name] = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};

		input.oninput = function ()
		{
			options.querySelector('.font-color input[type="number"][name="' + input.name + '"]').value = input.value;
		};
	});

	options.querySelectorAll('.font-color input[type="number"]').forEach(function(input)
	{
		input.onchange = function ()
		{
			gifopts.fontcolor[input.name] = input.value;
			options.querySelector('.font-color input[type="range"][name="' + input.name + '"]').value = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};
	});

	// Update Background Color

	options.querySelectorAll('.bg-color input[type="range"]').forEach(function(input)
	{
		input.onchange = function ()
		{
			gifopts.bgcolor[input.name] = input.value;
			options.querySelector('.bg-color input[type="range"][name="' + input.name + '"]').value = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};

		input.oninput = function ()
		{
			options.querySelector('.bg-color input[type="number"][name="' + input.name + '"]').value = input.value;
		};
	});

	options.querySelectorAll('.bg-color input[type="number"]').forEach(function(input)
	{
		input.onchange = function ()
		{
			gifopts.bgcolor[input.name] = input.value;
			options.querySelector('.bg-color input[type="range"][name="' + input.name + '"]').value = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};
	});

	// Update font

	options.querySelector('#font').onchange = function (evt)
	{
		gifopts.font = evt.target.value;
		image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
	}

	// Initialize

	image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
	options.querySelector('#font').value = gifopts.font;
});