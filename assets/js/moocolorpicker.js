/*
---
description: A plugin for choosing a color from a list of square boxes.

license: MIT-style

authors:
- Lorenzo Stanco

requires:
- core/1.2.1: '*'

provides: [MooColorPicker]

...
*/

var MooColorPicker = new Class({

	Implements: [Options, Events],

	options: {
		colors: [],
		defaultColor: -1,
		className: 'moocolorcheckbox',
		selectedClassName: 'moocolorcheckbox_selected'
	},

	initialize: function(container, options) {
		var $this = this;
		this.setOptions(options);
		this.container = $(container);
		this.container.setStyle('overflow', 'hidden');
		this.draw();
		if (this.options.defaultColor >= 0) this.selectColor(this.options.colors[this.options.defaultColor]);
		return this;
	},

	addColor: function(color) {
		if (!color) return this;
		this.options.colors.include(color);
		this.draw();
		return this.draw();
	},

	removeColor: function(color) {
		if (!color) return this;
		this.options.colors.erase(color);
		return this.draw();
	},

	selectColor: function(color) {
		if (!color) return this;
		var $this = this;
		this.selectedColor = color;
		this.container.getElements('div').each(function(item) {
			if (item.getStyle('background-color').toUpperCase() == color.toUpperCase()) {
				$this.fireEvent('change', [color, item]);
				item.addClass($this.options.selectedClassName);
			} else {
				item.removeClass($this.options.selectedClassName);
			}
		});
		return this;
	},

	getCurrentColor: function() {
		return this.selectedColor;
	},

	getContainer: function() {
		return this.container;
	},

	draw: function() {
		var $this = this;
		this.container.empty();
		this.options.colors.each(function (color, index) {
			var div = new Element('div', { 'class': $this.options.className });
			div.set('html', '&nbsp;');
			div.setStyles({
				'float': 'left',
				'background-color': color,
				cursor: 'pointer'
			}).addEvents({
				'click':	  function () { $this.selectColor(color); },
				'mouseenter': function () { $this.fireEvent('mouseenter', [div]); },
				'mouseleave': function () { $this.fireEvent('mouseleave', [div]); }
			}).inject($this.container);
		});
		return this;
	}

});
