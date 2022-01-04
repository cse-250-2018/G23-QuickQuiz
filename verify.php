<?php
	$msg = "";
	include 'functions.php';
	include 'connection.php';
	
	//store previous inputs in f_****
	$_SESSION['f_name']="";
	$_SESSION['f_user_name']="";
	$_SESSION['f_email']="";
	$_SESSION['f_reg']="";
	if(isset($_SESSION['current_user'])){
        // header("location: index.php");
        // die;
    }
	$msg="";
	if(isset($_SESSION['postData']))
	{
		$prepost=$_SESSION['postData'];
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

			if($_POST['code'] == $prepost['code']){
				$msg = userRegistration($prepost, $con);
				echo $msg;
				if($msg == "* Your account is created successfully")
				{
					$msg="<div class='msg-2'>Your account is created successfully.</div>";
					$_SESSION['current_user']=$prepost['username'];
					header("location: index.php");
				}
				else{
					$msg="<div class='msg'>Server error. Please try registering again after few moments.</div>";
				}
			}
			else{

				$msg = "<div class='msg'>Wrong code</div>";
			}
		}
	}
	else{
		header("location: registration.php");
	}
	
?>
<html>
<head>
	<title> Verify account </title>
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
					<div id="form_title">A verification code is sent to your email</div>
					<label class="inp_lbl">Verification Code</label>
					<input class="inp" type="text" name="code">
					<div class="inp_btn_container"><button class="inp_btn" type="submit" name="submit">Log In</button></div>
					<div class="form_extra">
						Don't have an account? <a href="registration.php">Sign Up</a>
					</div>
				</form>
			</div>
	</div>
</body>

</html>
