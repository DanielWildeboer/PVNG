/**
 * @class ConceptStation
 * @param {Map} map
 */
var ConceptStation = function(map)
{
	/**
	 * @property {Map} map
	 */
	this.map = null;
	
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
		
		this.lines = [];
	};
};

/**
 * @function render
 */
ConceptStation.prototype.render = function()
{
	var x = this.map.grid.calculateSnapPointX(this.map.mouse.x) + (this.map.grid.cellWidth / 2);
	var y = this.map.grid.calculateSnapPointX(this.map.mouse.y) + (this.map.grid.cellWidth / 2);
	
	this.map.context.beginPath();
	{
		this.map.context.lineWidth = ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 2) / 6;
		
		this.map.context.arc(x, y, ((this.map.grid.cellWidth + this.map.grid.cellHeight) / 2) / 3, 0, 2 * Math.PI);
		
		this.map.context.fillStyle = (this.map.context.isPointInPath(this.map.mouse.x, this.map.mouse.y) && (this.map.context.globalHover === this)) ? 'rgb(0, 0, 0)' : 'rgb(255, 255, 255)';
		this.map.context.fill();
		
		this.map.context.strokeStyle = 'rgb(0, 0, 0)';
		this.map.context.stroke();
		
		this.map.context.closePath();
	};
};

/**
 * @function update
 */
ConceptStation.prototype.update = function()
{
	if (this.map.mouse.leftClick)
	{
		this.map.conceptStation = new ConceptStation(this.map);
		
		var x = this.map.grid.calculateSnapPointX(this.map.mouse.x);
		var y = this.map.grid.calculateSnapPointX(this.map.mouse.y);
		
                ///////
                var station = this;
			
                jQuery.ajax(
                {
                        url: 'http://ovgroningen.serverict.nl/wp-content/themes/ovbureau/js/map/ajax/save.php',
                        type: 'POST',
                        data:
                        {
                                action: 'addStation',
                                x: x / this.map.grid.cellWidth,
                                y: y / this.map.grid.cellHeight
                        },
                        dataType: 'json',
                        success: function(data)
                        {
                                station.map.conceptStation = null;

                		station.map.stations.push(new Station(station.map, -1, "", [x / station.map.grid.cellWidth, y / station.map.grid.cellHeight], []));

                                station.map.navigation.find('ul li *').each(function(index, element)
                                {
                                        if ((jQuery(this).attr('name') === 'removeStation'))
                                        {
                                                element.disabled = false;
                                        }
                                });
                        }
                });
		
		var line = this;
		
		this.map.navigation.find('ul li *').each(function(index, element)
		{
			if (!(jQuery(this).attr('name') === 'removeLine' && line.map.lines.length === 0) && !(jQuery(this).attr('name') === 'removeStation' && line.map.stations.length === 0))
			{
				element.disabled = false;
			}
		});
	}
	
	if (this.map.mouse.rightClick)
	{
		this.map.conceptStation = null;
		
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