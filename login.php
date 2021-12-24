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
	<link rel="stylesheet" type="text/css" href="css/form.css">
</head>

<body>
	<?php include 'parts/nav_bar.php' ?>
	<div id="container">
		<div id="form_total">
				<div id="form_lft">
					<div id="lft1">
						<img src="images/form_left.svg">
											</div>
					<div id="lft2"><img src="images/form_right.svg"></div>
				</div>
				<form id="form_rht" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
				<?php echo $msg; ?>
					<div id="form_title">Sign In</div>
					<label class="inp_lbl">Username</label>
					<input class="inp" type="text" name="username" value="<?php echo $_SESSION['f_user_name']; ?>" >
					<label class="inp_lbl">Password</label>
					<input class="inp" type="password" name="password">
					<div class="inp_btn_container"><button class="inp_btn" type="submit" name="submit">Log In</button></div>
					<div class="form_extra">
						Don't have an account? <a href="registration.php">Sign Up</a>
					</div>
				</form>
			</div>
	</div>
</body>

</html>
