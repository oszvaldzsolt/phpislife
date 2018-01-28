<?php
	$nameErr = $emailErr = $genderErr = $passwordErr = $retypedPasswordErr = '';
	$name = $email = $gender = $password = $retypedPassword = '';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$everythingIsOk = true;
		
		if (empty($_POST["name"]))
		{
			$nameErr = '* Name is required!';
						
			$everythingIsOk = false;
		}
		else
		{
			$name = properOutputFormat($_POST['name']);
		}
		
		if ($everythingIsOk == false)
		{
			echo '<p>A névnél száll el!</p>';
		}
		
		if (empty($_POST["email"]))
		{
			$emailErr = '* Email is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$email = properOutputFormat($_POST['email']);
		}	

		if ($everythingIsOk == false)
		{
			echo '<p>Az emailnél száll el!</p>';
		}		
		
		if (empty($_POST["password"]))
		{
			$passwordErr = '* Password is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$password = properOutputFormat($_POST['password']);
		}
		
		if ($everythingIsOk == false)
		{
			echo '<p>A passwordnél száll el!</p>';
		}
		
		if (empty($_POST["retypedPassword"]))
		{
			$retypedPasswordErr = '* Password is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$retypedPassword = properOutputFormat($_POST['password']);
		}
		
		if ($everythingIsOk == false)
		{
			echo '<p>A retyped passwordnél száll el!</p>';
		}
		
		if ($everythingIsOk == true)
		{
			
			if ($password == $retypedPassword)
			{
				//require_once 'connection/databaseConnection.php';
				include 'connection/databaseConnection.php';
		
				$sql_statement = $conn->prepare('INSERT INTO users(name, password) VALUES(:name,:password)');
				$sql_statement->execute(array('name'=>$name,':password'=>$password));
				
				header('Location: index.php');
			}
		}
		
	}
	
	function properOutputFormat($data) {
		$properOutput = trim($data);
		$properOutput = stripslashes($data);
		$properOutput = htmlspecialchars($data);
		
		return $properOutput;
	}
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
	Name: <input type="text" name="name">
	<span class="error"> <?php echo $nameErr; ?></span>
	<br><br>
	E-mail: <input type="text" name="email">
	<span class="error"> <?php echo $emailErr; ?></span>
	
	<br><br>
	
	Password: <input type="text" name="password">
	<span class="error"> <?php echo $passwordErr; ?></span>
	
	<br><br>
	
	Retype password: <input type="text" name="retypedPassword">
	<span class="error"> <?php echo $retypedPasswordErr; ?></span>
	
	<br><br>
	
	Gender:
	<input type="radio" name="gender" value="Male"></input>
	<input type="radio" name="gender" value="Female"></input>
	<span class="error"> <?php echo $genderErr; ?></span>
	
	<br><br>
	
	<input type="submit" value="Submit" name="submit"></input>
</form>
