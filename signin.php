<?php

include 'connection/databaseConnection.php';

$name = $password = "";

$sqlStatement = 'SELECT * FROM users';

$simpleSiginDataRequest = $conn->query($sqlStatement);

$name = $_POST['name'];
$password = $_POST['password'];

foreach ($simpleSiginDataRequest as $row) {
	if ($row['name'] == $name && $row['password'] == $password)
	{
		header('Location: barhova.php');
	}
}
?>