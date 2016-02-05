<!DOCTYPE html>

<html lang="nl">
	<head>
            <meta charset="utf-8" />

            <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

            <meta content="OV Groningen" name="description" />
            <meta content="Wesley Pruim" name="author" />
            <meta content="index, follow" name="robots" />

            <title>OV Groningen - Editor</title>

            <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />		
            <link href="./css/map.css" rel="stylesheet" />
            
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

            <script src="./js/map/concept_line.js"></script>
            <script src="./js/map/concept_station.js"></script>
            <script src="./js/map/grid.js"></script>
            <script src="./js/map/line.js"></script>
            <script src="./js/map/map.js"></script>
            <script src="./js/map/mouse.js"></script>
            <script src="./js/map/station.js"></script>
	</head>
	
	<body>
		<div id="map"></div>
		
		<script>var map = new Map(jQuery('#map'));</script>
	</body>
</html>