/**
 * @class ConceptLine
 * @param {Map} map
 * @param {Number} type
 */
var ConceptLine = function(map, type)
{
	/**
	 * @property {Map} map
	 */
	this.map = null;
	
	/**
	 * @property {Number} type
	 */
	this.type = null;
	
	/**
	 * @property {Array} points
	 */
	this.points = null;
	
	/**
	 * @property {Boolean} pinned
	 */
	this.pinned = null;
	
	/**
	 * @constructs
	 */
	{
		this.map = map;
		this.type = type;
		this.points = [];
		this.pinned = false;
	};
};

/**
 * @function render
 */
ConceptLine.prototype.render = function()
{
	if (!(this.pinned))
	{
		this.map.context.beginPath();
		{
			var x = this.map.grid.calculateSnapPointX(this.map.mouse.x) + (this.map.grid.cellWidth / 2);
			var y = this.map.grid.calculateSnapPointX(this.map.mouse.y) + (this.map.grid.cellWidth / 2);

			this.map.context.moveTo(x, y);
			this.map.context.lineTo(x + 0.5, y + 0.5);

			this.map.context.lineWidth = ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 4);

			this.map.context.lineJoin = 'round';
			this.map.context.lineCap = 'round';

			this.map.context.strokeStyle = Line.getColorByType(this.type);
			this.map.context.stroke();

			this.map.context.closePath();
		};
	}
	else
	{
		this.map.context.beginPath();
		{
			var x = ((this.map.grid.cellWidth / 2) + (this.points[0][0] * this.map.grid.cellWidth));
			var y = ((this.map.grid.cellHeight / 2) + (this.points[0][1] * this.map.grid.cellHeight));
			
			this.map.context.moveTo(x, y);
			
			var line = this;
			
			jQuery.each(this.points, function(index)
			{
				if (index > 0)
				{
					var x = ((line.map.grid.cellWidth / 2) + (line.points[index][0] * line.map.grid.cellWidth));
					var y = ((line.map.grid.cellHeight / 2) + (line.points[index][1] * line.map.grid.cellHeight));
				}
				
				line.map.context.lineTo(x, y);
			});
			
			this.map.context.lineTo(this.map.mouse.x, this.map.mouse.y);
			
			this.map.context.lineWidth = ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 4);
			
			this.map.context.lineJoin = 'round';
			this.map.context.lineCap = 'round';
			
			this.map.context.strokeStyle = Line.getColorByType(this.type);
			this.map.context.stroke();
			
			this.map.context.closePath();
		};
	}
};

/**
 * @function update
 */
ConceptLine.prototype.update = function()
{
	if (this.map.mouse.leftClick)
	{
		this.pinned = true;
		
		var x = this.map.grid.calculateSnapPointX(this.map.mouse.x);
		var y = this.map.grid.calculateSnapPointX(this.map.mouse.y);
		
		this.points.push([x / this.map.grid.cellWidth, y / this.map.grid.cellHeight]);
	}
	
	if (this.map.mouse.rightClick)
	{
		if (this.points.length > 1)
		{
			var line = this;
			
			jQuery.ajax(
			{
				url: 'http://ovgroningen.serverict.nl/wp-content/themes/ovbureau/js/map/ajax/save.php',
				type: 'POST',
				data:
				{
					action: 'addLine',
					type: this.type,
					points: this.points
				},
				dataType: 'json',
				success: function(data)
				{
					line.map.conceptLine = null;
					
					line.map.lines.push(new Line(line.map, data.id, line.type, line.points));
					
					line.map.navigation.find('ul li *').each(function(index, element)
					{
						if ((jQuery(this).attr('name') === 'removeLine'))
						{
							element.disabled = false;
						}
					});
				}
			});
		}
		else
		{
			this.map.conceptLine = null;
		}
		
		var line = this;
		
		this.map.navigation.find('ul li *').each(function(index, element)
		{
			if (!(jQuery(this).attr('name') === 'removeLine' && line.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && line.map.stations.length === 0))
			{
				element.disabled = false;
			}
		});
	}
};