<?php 
    //session_start();
    include 'functions.php';
	include 'connection.php';
    
    date_default_timezone_set('Asia/Dhaka');

    $file = $_FILES['file'];
    $folder = "notes/".$_SESSION['current_user'];

    if( is_dir($folder) === false )
    {
        mkdir($folder);
    }
    
    //already exists?
    if(file_exists($folder."/".$file["name"]))
    {
        $extra="duplicate_".random_num(5)."_";
        $extra=date('m-d-Y_h-i-s_a', time())."_";
        $file["name"]=$extra.$file["name"];
        $_FILES['file']['name']=$extra.$_FILES['file']['name'];
    }

    move_uploaded_file($file["tmp_name"], $folder."/".$file["name"]);

    //store in DB
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		echo uploadNote($_FILES, $_POST, $con);
	}

    header("Location: notes.php");

?>