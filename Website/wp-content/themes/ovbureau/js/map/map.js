/**
 * @class Map
 * @param {HTMLElement} container
 */
var Map = function(container)
{
	/**
	 * @property {HTMLElement} container
	 */
	this.container = null;
	
	/**
	 * @property {HTMLCanvasElement} canvas
	 */
	this.canvas = null;
	
	/**
	 * @property {CanvasRenderingContext2D} context
	 */
	this.context = null;
	
	/**
	 * @property {Mouse} mouse
	 */
	this.mouse = null;
	
	/**
	 * @property {Grid} grid
	 */
	this.grid = null;
	
	/**
	 * @property {Array} lines
	 */
	this.lines = null;
	
	/**
	 * @property {Array} stations
	 */
	this.stations = null;
	
	/**
	 * @property {ConceptLine} conceptLine
	 */
	this.conceptLine = null;
	
	/**
	 * @property {ConceptStation} conceptStation
	 */
	this.conceptStation = null;
	
	/**
	 * @property {Boolean} removeLine
	 */
	this.removeLine = null;
	
	/**
	 * @property {Boolean} removeStation
	 */
	this.removeStation = null;
	
	/**
	 * @property {Number} loopId
	 */
	this.loopId = null;
	
	/**
	 * @constructs
	 */
	{
		this.container = container;
		
		this.createCanvas();
		this.createContext();
		this.createNavigation();
		
		this.mouse = new Mouse(this);
		this.grid = new Grid(this);
		
		this.lines = [];
		this.stations = [];
		
		this.removeLine = false;
		this.removeStation = false;
		
		this.loadLines();
		this.loadStations();
		
		this.startLoop();
	};
};

/**
 * @function createCanvas
 */
Map.prototype.createCanvas = function()
{
	this.canvas = jQuery('<canvas>');
	{
		this.canvas.attr('width', this.container.width());
		this.canvas.attr('height', this.container.height());
	};
	
	this.container.append(this.canvas);
};

/**
 * @function createContext
 */
Map.prototype.createContext = function()
{
	this.context = this.canvas.get(0).getContext('2d');
};

/**
 * @function createNavigation
 */
Map.prototype.createNavigation = function()
{
	this.navigation = jQuery('<nav>');
	{
		var handle = jQuery('<div>');
		{
			handle.attr('class', 'handle');
			
			this.navigation.append(handle);
		}
		
		var list = jQuery('<ul>');
		{
			var item = jQuery('<li>');
			{
				var select = jQuery('<select>');
				{
					select.attr('name', 'type');
					
					var option = jQuery('<option>');
					{
						option.val('1');
						option.text('Bus');
					}
					
					select.append(option);
					
					var option = jQuery('<option>');
					{
						option.val('2');
						option.text('Taxi');
					}
					
					select.append(option);
					
					var option = jQuery('<option>');
					{
						option.val('3');
						option.text('Trein');
					}
					
					select.append(option);

					var option = jQuery('<option>');
					{
						option.val('4');
						option.text('Auto');
					}
					
					select.append(option);
				};
				
				item.append(select);
				
				var button = jQuery('<button>');
				{
					button.text('Lijn toevoegen');
					button.attr('name', 'addLine');
					
					button.on('click', { map: this }, function()
					{
						map.navigation.find('ul li *').each(function(index, element)
						{
							element.disabled = true;
						});
						
						map.conceptLine = new ConceptLine(map, parseInt(jQuery('nav ul li select[name="type"] option:selected').val()));
					});
				};
				
				item.append(button);
			};
			
			list.append(item);
			
			var item = jQuery('<li>');
			{
				var button = jQuery('<button>');
				{
					button.text('Station toevoegen');
					button.attr('name', 'addStation');
					
					button.on('click', { map: this }, function()
					{
						map.navigation.find('ul li *').each(function(index, element)
						{
							element.disabled = true;
						});
						
						map.conceptStation = new ConceptStation(map);
					});
				};
				
				item.append(button);
			};
			
			list.append(item);
			
			var item = jQuery('<li>');
			{
				var button = jQuery('<button>');
				{
					button.text('Lijn verwijderen');
					button.attr('name', 'removeLine');
					
					button.on('click', { map: this }, function()
					{
						map.navigation.find('ul li *').each(function(index, element)
						{
							element.disabled = true;
						});
						
						map.removeLine = true;
					});
				};
				
				item.append(button);
			};
			
			list.append(item);
			
			var item = jQuery('<li>');
			{
				var button = jQuery('<button>');
				{
					button.text('Station verwijderen');
					button.attr('name', 'removeStation');
					
					button.on('click', { map: this }, function()
					{
						map.navigation.find('ul li *').each(function(index, element)
						{
							element.disabled = true;
						});
						
						map.removeStation = true;
					});
				};
				
				item.append(button);
			};
			
			list.append(item);
		};
		
		this.navigation.append(list);
	};
	
	this.container.append(this.navigation);
	
	this.navigation.draggable(
	{
		containment: 'parent',
		handle: 'div.handle'
	});
};

/**
 * @function loadLines
 */
Map.prototype.loadLines = function()
{
	jQuery.ajax({ context: this, url: 'js/map/json/lines.php' }).done(function(lines)
	{
		var map = this;
		
		jQuery.each(lines, function()
		{
			map.lines.push(new Line(map, this.id, this.type, this.points));
		});
	});
};

/**
 * @function loadStations
 */
Map.prototype.loadStations = function()
{
	jQuery.ajax({ context: this, url: 'js/map/json/stations.php' }).done(function(stations)
	{
		var map = this;
		
		jQuery.each(stations, function()
		{
			map.stations.push(new Station(map, this.id, this.name, this.position, this.lines));
		});
	});
};

/**
 * @function render
 */
Map.prototype.render = function()
{
	this.context.clearRect(0, 0, this.canvas.width(), this.canvas.height());
	
	this.grid.render();
	
	if (this.lines.length > 0)
	{
		jQuery.each(this.lines, function()
		{
			if (this.render) this.render();
		});
	}
	
	if (!(!(this.conceptLine)))
	{
		this.conceptLine.render();
	}
	
	if (this.stations.length > 0)
	{
		jQuery.each(this.stations, function()
		{
			if (this.render) this.render();
		});
	}
	
	if (!(!(this.conceptStation)))
	{
		this.conceptStation.render();
	}
};

/**
 * @function startLoop
 */
Map.prototype.startLoop = function()
{
	this.loopId = window.setInterval(this.tick.bind(this), 1000 / 60);
};

/**
 * @function stopLoop
 */
Map.prototype.stopLoop = function()
{
	window.clearInterval(this.loopId);
	{
		this.loopId = null;
	};
};

/**
 * @function tick
 */
Map.prototype.tick = function()
{
	this.update();
	this.render();
	
	this.mouse.reset();
};

/**
 * @function update
 */
Map.prototype.update = function()
{
	this.canvas.attr('width', this.container.width());
	this.canvas.attr('height', this.container.height());
	
	this.grid.update();
	
	if (this.lines.length > 0)
	{
		jQuery.each(this.lines, function()
		{
			if (this.update) this.update();
		});
	}
	
	if (!(!(this.conceptLine)))
	{
		this.conceptLine.update();
	}
	
	if (this.stations.length > 0)
	{
		jQuery.each(this.stations, function()
		{
			if (this.update) this.update();
		});
	}
	
	if (!(!(this.conceptStation)))
	{
		this.conceptStation.update();
	}
};