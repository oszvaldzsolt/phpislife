<?php
//Bad style!
	$nameErr = $emailErr = $genderErr = $passwordErr = $retypedPasswordErr = '';
	$name = $email = $gender = $password = $retypedPassword = '';
//Try Arrays like
$data = array(
'nameErr' => '',
//And so far.
);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (empty($name))
		{
			$nameErr = '* Name is required!';
		}
		else
		{
			$name = properOutputFormat($_POST['name']);
		}
		
		if (empty($email))
		{
			$emailErr = '* Email is required!';
		}
		else
		{
			$email = properOutputFormat($_POST['email']);
		}
		
		if (empty($gender))
		{
			$genderErr = '* Gender is required!';
		}
		else
		{
			$gender = properOutputFormat($_POST['gender']);
		}
		
		
		if (empty($password))
		{
			$passwordErr = '* Password is required!';
		}
		else
		{
			$password = properOutputFormat($_POST['password']);
		}
		
		if (empty($retypedPassword))
		{
			$retypedPasswordErr = '* Password is required!';
		}
		else
		{
			$retypedPassword = properOutputFormat($_POST['password']);
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
	<span class="error"> *<?php echo $genderErr; ?></span>
	<br><br>
	<input type="submit" value="Submit" name="submit"></input>
</form>

<?php
	if (isset($_POST['submit']) and ($password == $retypedPassword) and ($password != ''))
	{
		require_once 'connection/databaseConnection.php';
		
		$sql_statement = $conn->prepare('INSERT INTO users(name, password) VALUES(:name,:password)');
		$sql_statement->execute(array('name'=>$name,':password'=>$password));
	}
?>
