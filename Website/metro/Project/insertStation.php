<?php
$return = ["errors" => []];

header("Content-Type: application/json");

$connect = mysqli_connect('localhost', 'root', '', 'ovgroningen');
if(!$connect)
{
    $return["errors"][] = "kan geen verbinding maken met de database";
}
$query = "INSERT INTO haltes VALUES('" . mysqli_real_escape_string($connect, $_GET['halte']) . "', '" . mysqli_real_escape_string($connect, $_GET['type']) . "')";
if(!$query)
{
    $return["errors"][] = "er ging iets mis bij het toevoegen van de gegevens in de database";
}

$result = mysqli_query($connect, $query);
if($result)
{
    $return["errors"] [] = "De halte is succesvol toegevoegd!";
    echo json_encode($return, JSON_PRETTY_PRINT);
}

mysqli_close($connect);
