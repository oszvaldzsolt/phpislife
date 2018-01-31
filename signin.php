<?php

include 'connection/databaseConnection.php';

$name = $password = "";

$sqlStatement = 'SELECT * FROM users';

$simpleSiginDataRequest = $conn->query($sqlStatement);

$name = $_POST['name'];
$password = $_POST['password'];

$joE = false;

foreach ($simpleSiginDataRequest as $row) {
	if ($row['name'] == $name && $row['password'] == $password)
	{
		$joE = true;
		header('Location: barhova.php');
	}
}

if ($joE == false)
	header('Location: index.php');

$conn = null;

?>