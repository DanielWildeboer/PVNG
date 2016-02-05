/**
 * @class Line
 * @param {Map} map
 * @param {Number} id
 * @param {Number} type
 * @param {Array} points
 */
var Line = function(map, id, type, points)
{
	/**
	 * @property {Map} map
	 */
	this.map = null;
	
	/**
	 * @property {Number} id
	 */
	this.id = null;
	
	/**
	 * @property {Number} type
	 */
	this.type = null;
	
	/**
	 * @property {Array} points
	 */
	this.points = null;
	
	/**
	 * @constructs
	 */
	{
		this.map = map;
		
		this.id = id;
		this.type = type;
		this.points = points;
	};
};

/**
 * @static
 * @function getColorByType
 * @param {Number} type
 * @returns {String}
 */
Line.getColorByType = function(type)
{
	switch (type)
	{
		case 1:
			return 'blue';
		case 2:
			return 'orange';
		case 3:
			return 'green';
		case 4:
			return 'red';
	}
};

/**
 * @function render
 */
Line.prototype.render = function()
{
	this.map.context.beginPath();
	{
		var x = (this.map.grid.cellWidth / 2) + (this.points[0][0] * this.map.grid.cellWidth);
		var y = (this.map.grid.cellHeight / 2) + (this.points[0][1] * this.map.grid.cellHeight);
		
		this.map.context.moveTo(x, y);
		
		var line = this;
		
		jQuery.each(this.points, function(index)
		{
			if (index > 0)
			{
				var x = (line.map.grid.cellWidth / 2) + (line.points[index][0] * line.map.grid.cellWidth);
				var y = (line.map.grid.cellHeight / 2) + (line.points[index][1] * line.map.grid.cellHeight);
			}
			
			line.map.context.lineTo(x, y);
		});
		
		this.map.context.lineWidth = ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 4);
		
		this.map.context.lineJoin = 'round';
		this.map.context.lineCap = 'round';
		
		this.map.context.strokeStyle = (this.map.context.isPointInStroke(this.map.mouse.x, this.map.mouse.y) && (this.map.context.globalHover === this)) ? 'rgb(0, 0, 0)' : Line.getColorByType(this.type);
		this.map.context.stroke();
		
		if (this.map.context.isPointInStroke(this.map.mouse.x, this.map.mouse.y) && this.map.context.globalHover === this && this.map.removeLine && this.map.mouse.leftClick)
		{
			var index = this.map.lines.indexOf(this);
			
			if (index > -1)
			{
				if (this.map.lines[index] === this)
				{
					jQuery.ajax(
					{
						url: 'http://ovgroningen.serverict.nl/wp-content/themes/ovbureau/js/map/ajax/save.php',
						type: 'POST',
						data:
						{
							action: 'removeLine',
							id: this.id
						},
						dataType: 'json',
						success: function()
						{
							line.map.lines.splice(index, 1);

							line.map.navigation.find('ul li *').each(function(index, element)
							{
								if (!(jQuery(this).attr('name') === 'removeLine' && line.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && line.map.stations.length === 0))
								{
									element.disabled = false;
								}
							});
						}
					});
					
					
					if (this.map.lines.length === 0)
					{
						this.map.removeLine = false;
						
						var line = this;

						this.map.navigation.find('ul li *').each(function(index, element)
						{
							if (!(jQuery(this).attr('name') === 'removeLine' && line.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && line.map.stations.length === 0))
							{
								element.disabled = false;
							}
						});
					}
				}
			}
		}
		else if (this.map.removeLine && this.map.mouse.rightClick)
		{
			this.map.removeLine = false;
			
			var line = this;
			
			this.map.navigation.find('ul li *').each(function(index, element)
			{
				if (!(jQuery(this).attr('name') === 'removeLine' && line.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && line.map.stations.length === 0))
				{
					element.disabled = false;
				}
			});
		}
		
		this.map.context.closePath();
	};
};

/**
 * @function update
 */
Line.prototype.update = function()
{
	this.map.context.beginPath();
	{
		var x = (this.map.grid.cellWidth / 2) + (this.points[0][0] * this.map.grid.cellWidth);
		var y = (this.map.grid.cellHeight / 2) + (this.points[0][1] * this.map.grid.cellHeight);
		
		this.map.context.moveTo(x, y);
		
		var line = this;
		
		jQuery.each(this.points, function(index)
		{
			if (index > 0)
			{
				var x = (line.map.grid.cellWidth / 2) + (line.points[index][0] * line.map.grid.cellWidth);
				var y = (line.map.grid.cellHeight / 2) + (line.points[index][1] * line.map.grid.cellHeight);
			}
			
			line.map.context.lineTo(x, y);
		});
		
		this.map.context.lineWidth = ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 4);
		
		this.map.context.lineJoin = 'round';
		this.map.context.lineCap = 'round';
		
		if (this.map.context.isPointInStroke(this.map.mouse.x, this.map.mouse.y) && (this.map.context.globalHover !== this))
		{
			this.map.context.globalHover = this;
		}
		
		this.map.context.closePath();
	};
};