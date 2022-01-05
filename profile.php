<?php
    include 'connection.php';
    include 'functions.php';
    if(!isset($_SESSION['current_user']) && !isset($_GET['username']))
    {
        header("location: login.php");
    }
    $username=$_SESSION['current_user'];
    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }
    $sql = "SELECT * FROM users WHERE username = '$username' ";
    $result = mysqli_query($con, $sql);
    $name="";
    $email="";
    $reg_no="";
    $img_url = "profile/".$username.".jpg";
    if(mysqli_num_rows($result) > 0)
    {	
        $row = mysqli_fetch_assoc($result);
        $name=$row['name'];
        $email=$row['email'];
        $reg_no=$row['reg_no'];

    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/notes.css">
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>         
        <div id = "profile_container">
            <div class="lft">
                <div class="image_container">
                    <img src="<?php echo $img_url ?>">
                    <h2><?php echo $username; ?></h2>
                </div>
                <div class="info_total">
                    <div class="info_container">
                        <div class="info">Full Name: <?php echo $name ?></div>
                        <div class="info">Email: <?php echo $email ?></div>
                        <div class="info">Registration Number: <?php echo $reg_no?></div>
                    </div>
                    <div class="btn_container">
                        <?php 
                            if(!isset($_GET['username'])){
                                echo '<div class = "btn">
                                <a href = "update_profile.php">Update Profile</a>
                            </div>
                            <div class ="btn dp">
                                <a href = "change_dp.php">Change Profile Picture</a>
                            </div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="rht">
                <div class="forum_container">
                <h1>Recent Blogs</h1>
                <?php
                            $query = "SELECT * FROM posts WHERE author = '".$username."' ORDER BY id DESC LIMIT 3" ;
                            $result = mysqli_query($con,$query);
                            if ($result){
                                while($row = mysqli_fetch_array($result))
                                {
                                    $id = $row['id'];
                                    echo "<a href='blog_single.php?blogid=".$row['id']."'>".$row['title']."</a>";
                                }
                            }
                    ?>
                </div>
            </div>
        </div>
        <div class="notes_total">
        <h1>  Notes: </h1>
            <table id="main"> </table>
            <?php getNotes($con); ?>
        </div>
    </body>
</html>

