<?php
	$nameErr = $emailErr = $genderErr = $passwordErr = $retypedPasswordErr = '';
	$name = $email = $gender = $password = $retypedPassword = '';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$everythingIsOk = true;
		
		if (empty($name))
		{
			$nameErr = '* Name is required!';
						
			$everythingIsOk = false;
		}
		else
		{
			$name = properOutputFormat($_POST['name']);
		}
		
		if (empty($email))
		{
			$emailErr = '* Email is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$email = properOutputFormat($_POST['email']);
		}		
		
		if (empty($password))
		{
			$passwordErr = '* Password is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$password = properOutputFormat($_POST['password']);
		}
		
		if (empty($retypedPassword))
		{
			$retypedPasswordErr = '* Password is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$retypedPassword = properOutputFormat($_POST['password']);
		}
		
		if ($everythingIsOk == true)
		{
			if ($password == $retypedPassword)
			{
				require_once 'connection/databaseConnection.php';
		
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
	
	Password: <input type="text" name="website">
	<span class="error"> <?php echo $passwordErr; ?></span>
	
	<br><br>
	
	Retype password: <input type="text" name="website">
	<span class="error"> <?php echo $retypedPasswordErr; ?></span>
	
	<br><br>
	
	Gender:
	<input type="radio" name="gender" value="Male"></input>
	<input type="radio" name="gender" value="Female"></input>
	<span class="error"> <?php echo $genderErr; ?></span>
	
	<br><br>
	
	<input type="submit" value="Submit" name="submit"></input>
</form>
