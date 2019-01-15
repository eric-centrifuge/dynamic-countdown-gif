document.addEventListener('DOMContentLoaded', function ()
{
	"use strict";

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

			this.fields = {
				font1 : 'FrutigerLTStd-Black.ttf',
				font2 : 'FrutigerLTStd-Black.ttf',
				f1size : 57,
				f2size : 12,
				f1xoffset : 0,
				f1yoffset : -20,
				f2xoffset : 0,
				f2yoffset : 20,
				enddate : '',
				text : '',
				countdown : '',
				bgimage : '',
			}
		}

		buildQuery ()
		{
			let instance = this;
			let querystr = '?';
			let fontcolor = '';
			let bgcolor = '';

			Object.keys(instance.fields).forEach(function(name,index,arr){
				querystr += (index === arr.length - 1) ? `${name}=${instance.fields[name]}` : `${name}=${instance.fields[name]}&`;
			});

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


	let gifopts = new GIFOpts();
	let image = document.querySelector('#frame');
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
			gifopts.fields[input.name] = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
			image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};
	});

	// Update font

	options.querySelectorAll('.fonts select').forEach(function (input)
	{
		input.onchange = function (evt)
		{
			gifopts.fields[evt.target.name] = evt.target.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
			image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
		}
	});

	// Update text inputs

	options.querySelectorAll('input[type="text"]').forEach(function(input)
	{
		input.onchange = function ()
		{
			if (this.name === "image") {
				let http = new XMLHttpRequest();
				http.open('HEAD', this.input, false);
				http.send();
				if (http.status != 200) {
					input.value = '';
				}
			}
			gifopts.fields[input.name] = input.value;
			image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
			image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
		};
	});

	// Initialize

	image.src = location.href + 'countdowngif.php' + gifopts.buildQuery();
	image.parentNode.href = location.href + 'countdowngif.php' + gifopts.buildQuery();
	options.querySelector('select[name="font1"]').value = gifopts.font1;
	options.querySelector('select[name="font2"]').value = gifopts.font2;
});