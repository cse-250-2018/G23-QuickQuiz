<?php

	
	$msg = "";
	include 'functions.php';
	include 'connection.php';
	
	if(isset($_SESSION['msg']))
	{
		$msg=$_SESSION['msg'];
	}
	
	//store previous inputs in f_****
	$_SESSION['f_user_name']="";
	
	
	//check for login
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		if(isset($_SESSION['msg']))
			unset($_SESSION['msg']);
		
		$msg = userLogin($_POST, $con);
		if($msg == "* Login successfull")
		{
			$msg="";
			header("location: index.php");
			die;
		}
		
	}
	
?>

<html>
<head>
	<title> LogIn form </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

	<div class="box-2">
	<h1>Log in</h1><div class="bar"></div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="my-form">
		<?php echo $msg; ?>
		
		<div class="form-group">
			<label>Username</label>
            <input type="text" name="username" value="<?php echo $_SESSION['f_user_name']; ?>">
        </div>
		
        <div class="form-group">
			<label>Password</label>
            <input type="password" name="password">
        </div>
		
        <button type="submit" name="submit" class="button">Log in</button>
       
		<p> Don't have an account? <a href="registration.php">Register here</a><br/>
		Forget password? <a href="reset.php">Reset</a></p>
		
    </form>
	</div>
</body>

</html>
