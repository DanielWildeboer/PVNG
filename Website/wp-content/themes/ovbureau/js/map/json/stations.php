<?php
header('Content-Type: application/json');

$mysqli = mysqli_connect('localhost', 'ovgroningen', '$_Vng2015', 'ovgroningen');

$json = [];

$query =
'
	SELECT
		id,
		x,
                y
	FROM ov_stations
';

$result = mysqli_query($mysqli, $query);

while ($station = mysqli_fetch_assoc($result))
{		
	$json[] =
	[
		'id' => (int) $station['id'],
		'position' => [(int) $station['x'], (int) $station['y']]
		
	];
}

die(json_encode($json, JSON_PRETTY_PRINT));