/**
 * @class Mouse
 * @param {Map} map
 */
var Mouse = function(map)
{
	/**
	 * @property {Map} map
	 */
	this.map = null;
	
	/**
	 * @property {Number} x
	 */
	this.x = null;
	
	/**
	 * @property {Number} y
	 */
	this.y = null;
	
	/**
	 * @property {Boolean} leftClick
	 */
	this.leftClick = null;
	
	/**
	 * @property {Boolean} rightClick
	 */
	this.rightClick = null;
	
	/**
	 * @constructs
	 */
	{
		this.map = map;
		
		this.x = 0;
		this.y = 0;
		
		this.leftClick = false;
		this.rightClick = false;
		
		this.bindEventListeners();
	};
};

/**
 * @function bindEventListeners
 */
Mouse.prototype.bindEventListeners = function()
{
	this.map.canvas.on('click', this.onClick.bind(this));
	this.map.canvas.on('contextmenu', this.onContextMenu.bind(this));
	this.map.canvas.on('mousemove', this.onMouseMove.bind(this));
};

/**
 * @function onClick
 * @param {MouseEvent} event
 */
Mouse.prototype.onClick = function(event)
{
	if (event.which === 1) this.leftClick = true;
};

/**
 * @function onContextMenu
 * @param {Event} event
 * @returns {Boolean}
 */
Mouse.prototype.onContextMenu = function(event)
{
	return (!(this.rightClick = true));
};

/**
 * @function onMouseMove
 * @param {MouseEvent} event
 */
Mouse.prototype.onMouseMove = function(event)
{
	this.x = event.clientX;
	this.y = event.clientY;
};

/**
 * @function reset
 */
Mouse.prototype.reset = function()
{
	this.leftClick = false;
	this.rightClick = false;
};