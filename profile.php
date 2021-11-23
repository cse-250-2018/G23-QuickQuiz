<?php
    include 'connection.php';
    include 'functions.php';
    if(!isset($_SESSION['current_user']))
    {
        header("location: login.php");
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/notes.css">
    </head>
    <body>
            <?php include 'parts/nav_bar.php' ?>
        
            <?php
                $username=$_SESSION['current_user'];
                $sql = "SELECT * FROM users WHERE username = '$username' ";
                $result = mysqli_query($con, $sql);
                $name="";
                $email="";
                if(mysqli_num_rows($result) > 0)
                {	
                    $row = mysqli_fetch_assoc($result);
                    $name=$row['name'];
                    $email=$row['email'];
                }
            ?>
        
                <font size="11" color="green">
                <b><i>Informations:</i></b></font>
                <table border="0">
                    <tr>
                        <td>Username:</td>
                        <td><?php echo $username; ?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $email; ?></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2"><p> <a href="#">Edit Profile Info</a></p></td>
                    </tr>
                    <tr>
                        <td colspan="2"><p> <a href="#">Update Password</a></p></td>
                    </tr>

                </table>

            <h1>  My Notes: </h1>

            <table id="main"> </table>
            <?php getNotes($con); ?>
                            
                        
                        
    </body>
</html>
