<?php
	include 'functions.php';
	include 'connection.php';
	//store previous inputs in f_****
	$_SESSION['f_name']="";
	$_SESSION['f_user_name']="";
	$_SESSION['f_email']="";
	$_SESSION['f_reg']="";
	if(isset($_SESSION['current_user'])){
        header("location: index.php");
        die;
    }
	//check for reg
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
        ini_set("SMTP","ssl://smtp.gmail.com");
        ini_set("smtp_port","465");
        $to = $_POST['email'];
        $subject = "Email verification";
        $code=rand(1000000,9999999);
        $messege = "you verification code is ".$code;
        mail($to,$subject,$messege);
        $_POST['code'] = $code;
        $_SESSION['postData'] = $_POST;
        header("location:verify.php");
        die;
	}

	
?>

<html>
<head>
	<title> Registration form </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="scripts/vanila.js"></script>
    <script src="scripts/form.js"></script>
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
                <form id="form_rht" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validate()">
                    <div id="form_title">Join Us</div>
                    <label class="inp_lbl">Username</label>
                    <input class="inp" type="text" name="username" value="<?php echo $_SESSION['f_user_name']; ?>" required>
                    
                    <label class="inp_lbl">Full Name</label>
                    <input class="inp" type="text"  name="name" value="<?php echo $_SESSION['f_name']; ?>" required>
                    
                    <label class="inp_lbl">Email</label>
                    <input class="inp" type="text" name="email" value="<?php echo $_SESSION['f_email']; ?>" required>
                    
                    <label class="inp_lbl">Password</label>
                    <input class="inp" type="password" name="password" required>
                    
                    <label class="inp_lbl">Confirm Password</label>
                    <input class="inp" type="password" name="cpassword" required>
                    
                    <label class="inp_lbl">Registration Number</label>
                    <input class="inp" type="text" required>
                    <div class="inp_btn_container"><button class="inp_btn" type="submit" name="submit">Create Account</button></div>
                    <div class="form_extra">
                        Already have an account? <a href="login.php">Sign In</a>
                    </div>
                </form>
            </div>
    </div>
</body>

</html>
