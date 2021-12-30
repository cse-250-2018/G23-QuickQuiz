<?php 
	include '../connection.php';
	$email=json_decode($_POST['jsonEmail']);
    $query = "SELECT * FROM users WHERE email = '".$email."'";
    $result = mysqli_query($con,$query);
    if ($result){
        if(mysqli_num_rows($result)>0) echo true;
        else echo false;
    }
    else echo false;

?>

