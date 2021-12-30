<?php 
	include '../connection.php';
	$username=json_decode($_POST['jsonUsername']);
    $query = "SELECT * FROM users WHERE username = '".$username."'";
    $result = mysqli_query($con,$query);
    if ($result){
        if(mysqli_num_rows($result)>0) echo true;
        else echo false;
    }
    else echo false;

?>

