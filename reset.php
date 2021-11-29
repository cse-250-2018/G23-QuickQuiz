<?php
	
	$msg = "";
	include 'functions.php';
	include 'connection.php';
	
	$_SESSION['f_email']="";
	$_SESSION['code']="";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		$msg = passwordReset($_POST, $con);
		if($msg == "Email send")
		{
			$msg="";
			$_SESSION['email']=$_POST['email'];
			header("location: pending.php");
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
    
    <br/>
	<div class="box-2">
	<h1>Reset Password</h1><div class="bar"></div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="my-form">
		<?php echo $msg; ?>
		
		<div class="form-group">
			<label>Enter your Email:</label>
            <input type="email" name="email" value="<?php echo $_SESSION['f_email']; ?>">
        </div>
		
        <button type="submit" name="submit" class="button">Send Mail</button>
		
    </form>
	</div>
</body>

</html>
