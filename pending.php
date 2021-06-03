<?php
	
	session_start();
	
	$msg = "";
	include 'functions.php';
	include 'connection.php';
	
	if(!isset($_SESSION['email']))
	{
		//redirect to reset
		header("Location: reset.php");
		die;
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		$msg = checkCode($_POST, $con);
		if($msg == "valid")
		{
			$msg="";
			header("location: new_pass.php");
			die;
		}
		
	}
	
?>

<html>
<head>
	<title> Password Reset </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

	<div class="box-2">
	<h1>Reset Password</h1><div class="bar"></div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="my-form">
	
		<p>
			We sent a verification code to  <b><?php echo $_SESSION['email'] ?></b>. 
			Please login into your email account and enter the code.</p>
		
		<?php echo $msg; ?>
		
		<div class="form-group">
			<label>Verification code:</label>
            <input type="text" name="code">
        </div>
		
        <button type="submit" name="submit" class="button">Submit</button>
		
    </form>
	</div>
</body>

</html>