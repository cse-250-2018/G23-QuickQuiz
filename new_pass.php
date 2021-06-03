<?php
	
	session_start();
	
	$msg = "";
	include 'functions.php';
	include 'connection.php';
	
	if(!isset($_SESSION['reset']))
	{
		//redirect to reset
		header("Location: reset.php");
		die;
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		$msg = resetUpdate($_POST, $con);
		if($msg == "* Password reset successfull")
		{
			$msg="<div class='msg-2'>Password reset successfull.</div>";
			$_SESSION['msg']=$msg;
			
			$msg="";
			unset($_SESSION['reset']);
			header("location: login.php");
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
	<h1>New Password</h1><div class="bar"></div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="my-form">
		<?php echo $msg; ?>
		
		<div class="form-group">
			<label>New password:</label>
            <input type="password" name="password">
        </div>
		
		<div class="form-group">
			<label>Confirm password:</label>
            <input type="password" name="cpassword">
        </div>
		
        <button type="submit" name="submit" class="button">Update</button>
		
    </form>
	</div>
</body>

</html>