/**
 * @class Station
 * @param {Map} map
 * @param {Number} id
 * @param {String} name
 * @param {Array} position
 * @param {Array} lines
 */
var Station = function(map, id, name, position, lines)
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
	 * @property {String} name
	 */
	this.name = null;
	
	/**
	 * @property {Array} position
	 */
	this.position = null;
	
	/**
	 * @property {Array} lines
	 */
	this.lines = null;
	
	/**
	 * @constructs
	 */
	{
		this.map = map;
		
		this.id = id;
		this.name = name;
		this.position = position;
		this.lines = lines;
	};
};

/**
 * @function render
 */
Station.prototype.render = function()
{
	var x = (this.map.grid.cellWidth / 2) + (this.position[0] * this.map.grid.cellWidth);
	var y = (this.map.grid.cellHeight / 2) + (this.position[1] * this.map.grid.cellHeight);
	
	this.map.context.beginPath();
	{
		this.map.context.lineWidth = ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 2) / 6;
		
		this.map.context.arc(x, y, ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 2) / 3, 0, 2 * Math.PI);
		
		this.map.context.fillStyle = (this.map.context.isPointInPath(this.map.mouse.x, this.map.mouse.y) && (this.map.context.globalHover === this)) ? 'rgb(0, 0, 0)' : 'rgb(255, 255, 255)';
		this.map.context.fill();
		
		this.map.context.strokeStyle = 'rgb(0, 0, 0)';
		this.map.context.stroke();
		
                var station = this;
		if (this.map.context.isPointInPath(this.map.mouse.x, this.map.mouse.y) && this.map.context.globalHover === this && this.map.removeStation && this.map.mouse.leftClick)
		{
			var index = this.map.stations.indexOf(this);
			
			if (index > -1)
			{
				if (this.map.stations[index] === this)
				{
                                    jQuery.ajax(
					{
						url: 'http://ovgroningen.serverict.nl/wp-content/themes/ovbureau/js/map/ajax/save.php',
						type: 'POST',
						data:
						{
							action: 'removeStation',
							id: this.id
						},
						dataType: 'json',
						success: function()
						{
							station.map.stations.splice(index, 1);

							station.map.navigation.find('ul li *').each(function(index, element)
							{
								if (!(jQuery(this).attr('name') === 'removeLine' && station.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && station.map.stations.length === 0))
								{
									element.disabled = false;
								}
							});
						}
					});
                                        
					
					if (this.map.stations.length === 0)
					{
						this.map.removeStation = false;
						
						var station = this;

						this.map.navigation.find('ul li *').each(function(index, element)
						{
							if (!(jQuery(this).attr('name') === 'removeLine' && station.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && station.map.stations.length === 0))
							{
								element.disabled = false;
							}
						});
					}
				}
			}
		}
		else if (this.map.removeStation && this.map.mouse.rightClick)
		{
			this.map.removeStation = false;
			
			var station = this;
			
			this.map.navigation.find('ul li *').each(function(index, element)
			{
				if (!(jQuery(this).attr('name') === 'removeLine' && station.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && station.map.stations.length === 0))
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
Station.prototype.update = function()
{
	var x = (this.map.grid.cellWidth / 2) + (this.position[0] * this.map.grid.cellWidth);
	var y = (this.map.grid.cellHeight / 2) + (this.position[1] * this.map.grid.cellHeight);
	
	this.map.context.beginPath();
	{
		this.map.context.lineWidth = ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 2) / 6;
		
		this.map.context.arc(x, y, ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 2) / 3, 0, 2 * Math.PI);
		
		if (this.map.context.isPointInPath(this.map.mouse.x, this.map.mouse.y) && (this.map.context.globalHover !== this))
		{
			this.map.context.globalHover = this;
		}
		
		this.map.context.closePath();
	};
};