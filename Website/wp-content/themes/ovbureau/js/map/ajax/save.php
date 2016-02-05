<?php
$mysqli = mysqli_connect('localhost', 'ovgroningen', '$_Vng2015', 'ovgroningen');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if (!(isset($_POST['action'])))
	{
		die(json_encode(['success' => false, 'error' => 'No action']));
	}
	
	switch ($_POST['action'])
	{
		case 'addLine':
		{
			if (!(isset($_POST['type'])))
			{
				die(json_encode(['success' => false, 'error' => 'No type']));
			}
			
			if (!(isset($_POST['points'])))
			{
				die(json_encode(['success' => false, 'error' => 'No points']));
			}
			
			$query =
			'
				INSERT INTO ov_lines
				(
					type
				)
				VALUES
				(
					' . mysqli_real_escape_string($mysqli, $_POST['type']) . '
				);
			';
			
			mysqli_query($mysqli, $query);
			
			$id = mysqli_insert_id($mysqli);
			
			foreach ($_POST['points'] as $point)
			{
				$query =
				'
					INSERT INTO ov_lines_points
					(
						line_id,
						x,
						y
					)
					VALUES
					(
						' . mysqli_real_escape_string($mysqli, $id) . ',
						' . mysqli_real_escape_string($mysqli, $point[0]) . ',
						' . mysqli_real_escape_string($mysqli, $point[1]) . '
					)
				';
				
				mysqli_query($mysqli, $query);
			}
			
			die(json_encode(['id' => $id]));
		}
		
		case 'removeLine':
		{
			if (!(isset($_POST['id'])))
			{
				die(json_encode(['success' => false, 'error' => 'No id']));
			}
			
			$query =
			'
				DELETE FROM ov_lines
				WHERE id = ' . mysqli_real_escape_string($mysqli, $_POST['id']) . ';
			';
			
			mysqli_query($mysqli, $query);
			
			$query =
			'
				DELETE FROM ov_lines_points
				WHERE line_id = ' . mysqli_real_escape_string($mysqli, $_POST['id']) . ';
			';
			
			mysqli_query($mysqli, $query);
		}
                
                
                case 'addStation':
		{
			
			if (!(isset($_POST['x'])))
			{
				die(json_encode(['success' => false, 'error' => 'No x']));
			}
			if (!(isset($_POST['y'])))
			{
				die(json_encode(['success' => false, 'error' => 'No y']));
			}
			
			$query =
			'
				INSERT INTO ov_stations
				(
					x, 
                                        y
				)
				VALUES
				(
					' . mysqli_real_escape_string($mysqli, $_POST['x']) . ',
					' . mysqli_real_escape_string($mysqli, $_POST['y']) . '
				);
			';
			
			mysqli_query($mysqli, $query);
			
			$id = mysqli_insert_id($mysqli);
			
			die(json_encode(['id' => $id]));
		}
		
		case 'removeStation':
		{
			if (!(isset($_POST['id'])))
			{
				die(json_encode(['success' => false, 'error' => 'No id']));
			}
			
			$query =
			'
				DELETE FROM ov_stations
				WHERE id = ' . mysqli_real_escape_string($mysqli, $_POST['id']) . ';
			';		
			mysqli_query($mysqli, $query);
		}
		
		default:
		{
			die(json_encode(['success' => false, 'error' => 'No valid action']));
		}
	}
}
else
{
	die(json_encode(['success' => false, 'error' => 'No POST']));
}