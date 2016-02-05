/**
 * @class Grid
 * @param {Map} map
 */
var Grid = function(map)
{
	/**
	 * @property {Map} map
	 */
	this.map = null;
	
	/**
	 * @property {Number} cellWidth
	 */
	this.cellWidth = null;
	
	/**
	 * @property {Number} cellHeight
	 */
	this.cellHeight = null;
	
	/**
	 * @constructs
	 */
	{
		this.map = map;
		
		this.cellWidth = 24;
		this.cellHeight = 24;
	};
};

/**
 * @function calculateSnapPointX
 * @param {Number} x
 * @returns {Number}
 */
Grid.prototype.calculateSnapPointX = function(x)
{
	return Math.floor(x / this.cellWidth) * this.cellWidth;
};

/**
 * @function calculateSnapPointY
 * @param {Number} y
 * @returns {Number}
 */
Grid.prototype.calculateSnapPointY = function(y)
{
	return Math.floor(y / this.cellHeight) * this.cellHeight;
};

/**
 * @function render
 */
Grid.prototype.render = function()
{
	this.map.context.beginPath();
	{
		for (var x = 0; x < this.map.canvas.attr('width'); x += this.cellWidth)
		{
			this.map.context.moveTo(0.5 + x, 0);
			this.map.context.lineTo(0.5 + x, this.map.canvas.attr('height'));
		}
		
		for (var y = 0; y < this.map.canvas.attr('height'); y += this.cellHeight)
		{
			this.map.context.moveTo(0, 0.5 + y);
			this.map.context.lineTo(this.map.canvas.attr('width'), 0.5 + y);
		}
		
		this.map.context.lineWidth = 1;
		
		this.map.context.strokeStyle = 'rgb(200, 200, 200)';
		this.map.context.stroke();
		
		this.map.context.closePath();
	};
};

/**
 * @function update
 */
Grid.prototype.update = function() { };