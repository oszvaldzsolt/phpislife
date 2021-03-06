<?php
	$nameErr = $emailErr = $genderErr = $passwordErr = $retypedPasswordErr = $passwordExpressionErr = '';
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
		
		/*if ($everythingIsOk == false)
		{
			echo '<p>A névnél száll el!</p>';
		}*/
		
		if (empty($_POST["email"]))
		{
			$emailErr = '* Email is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$email = properOutputFormat($_POST['email']);
		}	

		/*if ($everythingIsOk == false)
		{
			echo '<p>Az emailnél száll el!</p>';
		}*/		
		
		$passwordExpression = "/^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/";
		
		if (!preg_match($passwordExpression, $_POST['password'])) {
			
			$passwordExpressionErr = "* The conditions haven't met";
			
			$everythingIsOk = false;
			
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
		
		/*if ($everythingIsOk == false)
		{
			echo '<p>A passwordnél száll el!</p>';
		}*/
		
		if (empty($_POST["retypedPassword"]))
		{
			$retypedPasswordErr = '* Password is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$retypedPassword = properOutputFormat($_POST['password']);
		}
		
		if (empty($_POST['gender']))
		{
			$genderErr = '* Gender is required!';
			
			$everythingIsOk = false;
		}
		else
		{
			$gender = $_POST['gender'];
			
			if ($gender == 'male')
			{
				$gender = true;
			}
			else if ($gender == 'female')
			{
				$gender = false;
			}
			else 
			{
				$gender = NULL;
			}
		}
		
		/*if ($everythingIsOk == false)
		{
			echo '<p>A retyped passwordnél száll el!</p>';
		}*/
		
		if ($everythingIsOk == true)
		{
			
			if ($password == $retypedPassword)
			{
				//require_once 'connection/databaseConnection.php';
				require_once 'connection/databaseConnection.php';
		
				$sql_statement = $conn->prepare('INSERT INTO users(name, password, email, gender) VALUES(:name,:password,:email,:gender)');
				$sql_statement->execute(array('name'=>$name, 'password'=>$password, 'email'=>$email, 'gender'=>$gender));
				
				
				
				header('Location: index.php');
				
				$conn = null;
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
	
	<p>Password needs to contain at least:</p> 
	<ul>
		<li>a number</li> 
		<li>a lower case letter</li> 
		<li>an upper case letter</li>
		<li>8 characters</li>
	</ul>
	
	Password: <input type="text" name="password">
	<span class="error"> <?php echo $passwordErr; ?> <?php echo $passwordExpressionErr; ?> </span>
	<br><br>
	
	Retype password: <input type="text" name="retypedPassword">
	<span class="error"> <?php echo $retypedPasswordErr; ?></span>
	
	<br><br>
	
	Gender:
	<input type="radio" name="gender" value="male"></input> Male 
	<input type="radio" name="gender" value="female"></input> Female 
	<span class="error"> <?php echo $genderErr; ?></span>
	
	<br><br>
	
	<input type="submit" value="Submit" name="submit"></input>
</form>
