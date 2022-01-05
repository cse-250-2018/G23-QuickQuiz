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
    $_FILES;
	//check for reg
    $msg = "";
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
        if(!!$_FILES['file']['tmp_name']){
            $todir = 'profile/';
            $filename=$_FILES["file"]["name"];
            $newfilename=$username.".jpg";
            move_uploaded_file( $_FILES['file']['tmp_name'], $todir . $newfilename );
            header("location:profile.php");
        }
	}

	
?>

<html>
<head>
	<title> Update Profile </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<link rel="stylesheet" type="text/css" href="css/notes.css">
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
                <form enctype="multipart/form-data" id="form_rht" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validate()">
                    <?php echo $msg; ?>
                    <div id="form_title">Change Profile Picture</div>
                    <input id="choose" class="inp" type="file" name="file" accept=".jpg" required>
                    <div class="inp_btn_container"><button class="inp_btn" type="submit" name="submit">Upload</button></div>
                </form>
            </div>
    </div>
</body>

</html>


