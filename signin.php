<?php
require_once('Configuration/databaseConnection.php');

//No WAY :D
$name = $password = "";

if ($_POST['name'] == "Zsolt")
{
	if ($_POST['password'] == 123)
	{
		header('Location: index.php');
	}
}

//Maybe you try this.
$name = $_POST['name'];
$password = $_POST['password'];
if($name == "Zsolt" && $password == 123) {
 header('Location: index.php');	
}
?>
