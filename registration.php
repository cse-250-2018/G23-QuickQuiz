<?php
	$msg = "";
	include 'functions.php';
	include 'connection.php';
	
	//store previous inputs in f_****
	$_SESSION['f_name']="";
	$_SESSION['f_user_name']="";
	$_SESSION['f_email']="";
	$_SESSION['f_reg']="";
	
	//check for reg
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		$msg = userRegistration($_POST, $con);
		if($msg == "* Your account is created successfully")
		{
			$msg="<div class='msg-2'>Your account is created successfully.</div>";
			$_SESSION['msg']=$msg;
			header("location: login.php");
		}
		
	}
	
?>

<html>
<head>
	<title> Registration form </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<?php include 'parts/nav_bar.php' ?>
	<div class="box-2">
	<h1>Create a new account</h1><div class="bar"></div>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="my-form">
		<?php echo $msg; ?>
		<div class="form-group">
			<label>Name</label>
            <input type="text" name="name" value="<?php echo $_SESSION['f_name']; ?>">
        </div>
		
		<div class="form-group">
			<label>Username</label>
            <input type="text" name="username" value="<?php echo $_SESSION['f_user_name']; ?>">
        </div>
        
		<div class="form-group">
			<label>Email</label>
            <input type="email" name="email" value="<?php echo $_SESSION['f_email']; ?>">
        </div>
		
        <div class="form-group">
			<label>Password</label>
            <input type="password" name="password">
        </div>
		 
		<div class="form-group">
			<label>Confirm Password</label>
            <input type="password" name="cpassword">
        </div>
		
        <button type="submit" name="submit" class="button">Submit</button>
       
		<p> Already have an account? <a href="login.php">Log in</a></p>
		
    </form>
	</div>
</body>

</html>
