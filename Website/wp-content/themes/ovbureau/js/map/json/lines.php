<?php
header('Content-Type: application/json');

$mysqli = mysqli_connect('localhost', 'ovgroningen', '$_Vng2015', 'ovgroningen');

$json = [];

$query =
'
	SELECT
		id,
		type
	FROM ov_lines
';

$result = mysqli_query($mysqli, $query);

while ($line = mysqli_fetch_assoc($result))
{
	$query_2 =
	'
		SELECT
			x,
			y
		FROM ov_lines_points
		WHERE line_id = ' . mysqli_real_escape_string($mysqli, $line['id']) . ';
	';
	
	$result_2 = mysqli_query($mysqli, $query_2);
	
	$points = [];
	
	while ($point = mysqli_fetch_assoc($result_2))
	{
		$points[] = [(int) $point['x'], (int) $point['y']];
	}
	
	$json[] =
	[
		'id' => (int) $line['id'],
		'type' => (int) $line['type'],
		'points' => $points
	];
}

die(json_encode($json, JSON_PRETTY_PRINT));