<?php

    include 'connection.php';

    if(isset($_GET['rename']) && isset($_GET['id']))
    {
        $username=$_SESSION['current_user'];
        $new_name=$_GET['rename'];
        $id=$_GET['id'];
        $sql = "SELECT * FROM notes WHERE ID = '$id' ";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0)
        {	
            $row = mysqli_fetch_assoc($result);
            $author=$row['Author'];
            $name=$row['Name'];
            $folder = "notes/".$_SESSION['current_user'];
            $old = $folder."/".$name;
            $new = $folder."/".$new_name;
            
            if($author == $username)
            {
                
                //in local
                if(!file_exists($new))
                {
                    if(rename($old, $new))
                        echo "Changed";
                    else
                        echo "Something error";
                }
                else
                {
                    echo "Same nam ache!";
                }
                
                //in database
                $sql2="UPDATE notes SET Name='$new_name' WHERE ID='$id' ";
                mysqli_query($con, $sql2);
            }
            else
                echo "You are not the owner of this note!";
            
        }
        
        echo "<br>id=$id new-name=$new_name<br>";
        echo "old=$old <br> new=$new";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
        
        $id = $_POST['id']; 
		$new_course = $_POST['course'];
        $new_type = $_POST['type'];
        $new_name = $_POST['fileName'];
        
        
        $sql = "SELECT * FROM notes WHERE ID = '$id' ";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0)
        {	
            $row = mysqli_fetch_assoc($result);
            $author=$row['Author'];
            $name=$row['Name'];
            $folder = "notes/".$_SESSION['current_user'];
            $old = $folder."/".$name;
            $new = $folder."/".$new_name;
            
            //in local
            if(!file_exists($new))
            {
                if(rename($old, $new))
                    echo "Changed";
                else{
                    $_SESSION['msg']="Something error";
                    header("Location: noteEdit?id=$id");
                    die;
                }
            }
            else if($old != $new)
            {
                echo "Same nam ache!";
                $_SESSION['msg']="This name already exists";
                header("Location: noteEdit?id=$id");
                die;
            }

            //in database
            $sql2="UPDATE `notes` SET `Name`='".$new_name."',`Course`='".$new_course."',`Type`='".$new_type."' WHERE `ID` = '".$id."'";
            mysqli_query($con, $sql2);
            
        }
        
        /*echo "<br>id=$id new-name=$new_name<br>";
        echo "old=$old <br> new=$new";
        echo $new_course."  ".$new_type;*/
		
	}

    //$_SESSION['msg']
    header("Location: profile.php");

?>
