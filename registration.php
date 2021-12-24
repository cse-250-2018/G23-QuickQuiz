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
                    <div id="form_title">Join Us</div>
                    <label class="inp_lbl">Username</label>
                    <input class="inp" type="text" name="username" value="<?php echo $_SESSION['f_user_name']; ?>" >
                    
                    <label class="inp_lbl">Full Name</label>
                    <input class="inp" type="text"  name="name" value="<?php echo $_SESSION['f_name']; ?>">
                    
                    <label class="inp_lbl">Email</label>
                    <input class="inp" type="text" name="email" value="<?php echo $_SESSION['f_email']; ?>">
                    
                    <label class="inp_lbl">Password</label>
                    <input class="inp" type="password" name="password">
                    
                    <label class="inp_lbl">Confirm Password</label>
                    <input class="inp" type="password" name="cpassword">
                    
                    <label class="inp_lbl">Registration Number</label>
                    <input class="inp" type="text">
                    <div class="inp_btn_container"><button class="inp_btn" type="submit" name="submit">Create Account</button></div>
                    <div class="form_extra">
                        Already have an account? <a href="login.php">Sign In</a>
                    </div>
                </form>
            </div>
    </div>
</body>

</html>
