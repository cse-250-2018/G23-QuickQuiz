<?php 
    
    include 'connection.php';
    include 'functions.php';
    if(!isset($_SESSION['current_user']))
    {
        header("location: login.php");
    }

    if(!isset($_GET['id']))
    {
        header("location: profile.php");
    }


    $username=$_SESSION['current_user'];
    $id=$_GET['id'];
    $which=$_GET['which'];

    $sql = "SELECT * FROM notes WHERE ID = '$id' ";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0)
    {	
        $row = mysqli_fetch_assoc($result);
        $author=$row['Author'];
        $name=$row['Name'];
        $file="notes/".$username."/".$name;
        
        if($author != $username)
        {
            echo "<script language='javascript'>
	           alert('Permission denied!');
	           window.location = 'profile.php';
	          </script>";
        }
        
        $sql2 = "DELETE FROM notes WHERE ID = '$id' ";
        $result2 = mysqli_query($con, $sql2);
        
        //delete from local
        if (file_exists($file))
        {
            unlink($file);
            echo "<script language='javascript'>
	           alert('Deleted');
	           window.location = 'profile.php';
	          </script>";
        }
        else
        {
            echo "<script language='javascript'>
	           alert('WTF?');
	           window.location = 'profile.php';
	          </script>";
        }
        header("location: profile.php");
        
    }
    else
    {   
        echo "<script language='javascript'>
	           alert('no such file in the attachemnts');
	           window.location = 'profile.php';
	          </script>";
        
    }
?>