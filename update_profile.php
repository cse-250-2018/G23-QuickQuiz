<?php
	include 'functions.php';
	include 'connection.php';
	//store previous inputs in f_****
	$_SESSION['f_name']="";
	$_SESSION['f_user_name']="";
	$_SESSION['f_email']="";
	$_SESSION['f_reg']="";
	if(!isset($_SESSION['current_user'])){
        header("location: registration.php");
        die;
    }
    $sql = "SELECT * FROM users WHERE username = '".$_SESSION['current_user']."' ";
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $name = $row['name'];
    $email = $row['email'];
    $reg = $row['reg_no'];
    $psd = $row['password'];
	//check for reg
    $msg = "";
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
        if(modifyPassword($_POST['password'])==$psd){
            $sql = "UPDATE users SET name = '".$_POST['name']."',reg_no = '".$_POST['reg_no']."' WHERE username = '".$username."';";
            $con->query($sql);
            $sql = "SELECT * FROM users WHERE username = '".$_SESSION['current_user']."' ";
            $result = $con->query($sql);
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
            $name = $row['name'];
            $email = $row['email'];
            $reg = $row['reg_no'];
            $psd = $row['password'];
            $msg = "<div class = 'msg-2'>Updated sucessfully</div>";
        }
        else{
            $msg = "<div class='msg'>Incorrect password</div>";
        }
	}

	
?>

<html>
<head>
	<title> Update Profile </title>
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
                    <?php echo $msg; ?>
                    <div id="form_title">Update Profile</div>
                    <label class="inp_lbl">Username</label>
                    <input class="inp" type="text" name="username" value="<?php echo $username; ?>" required readonly>
                    
                    <label class="inp_lbl">Full Name</label>
                    <input class="inp" type="text"  name="name" value="<?php echo $name; ?>" required>
                    
                    <label class="inp_lbl">Email</label>
                    <input class="inp" type="text" name="email" value="<?php echo $email; ?>" required readonly>
                    <label class="inp_lbl">Registration Number</label>
                    <input class="inp" type="text" name = "reg_no" value = <?php echo $reg; ?> required>
                    <label class="inp_lbl">Password</label>
                    <input class="inp" type="password" name="password" required>
                    <div class="inp_btn_container"><button class="inp_btn" type="submit" name="submit">Update</button></div>
                </form>
            </div>
    </div>
</body>

</html>

