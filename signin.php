<!DOCTYPE html>
<html>
<head>
	<title>Sign in platform</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>

<?php

$joE = false;

if (isset($_POST['submit']))
{
	if  ( isset($_POST['name']) and isset($_POST['password']) )
	{
		
		require_once 'connection/databaseConnection.php';

		$name = $password = "";

		$sqlStatement = 'SELECT * FROM users';

		$simpleSiginDataRequest = $conn->query($sqlStatement);

		$name = $_POST['name'];
		$password = $_POST['password'];

		foreach ($simpleSiginDataRequest as $row) {
			if ($row['name'] == $name and $row['password'] == $password)
			{
				$joE = true;
				header('Location: barhova.php');
			}
		}
	}
}

if ($joE == false)
{
	echo '<h2>Please sign in!</h2>';
	//header('Location: index.php');
}

$conn = null;

?>

<form action="signin.html" method="post">
	<p>Name: <input type="text" name="name"></input></p>
	<p>Password: <input type="text" name="password"></input></p>
	<input type="submit" value="Submit" name="submit"></input>
</form>

<a href="signup.php">Sign up</a>

</body>
</html>