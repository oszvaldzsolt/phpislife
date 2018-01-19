<?php
$name = $password = "";

if ($_POST['name'] == "Zsolt")
{
	if ($_POST['password'] == "123")
	{
		header('Location: index.html');
	}
}
?>