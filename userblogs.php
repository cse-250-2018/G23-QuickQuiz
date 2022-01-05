<?php
    include 'connection.php';
    include 'functions.php';
    if(!isset($_SESSION['current_user'])){
        header("location: forum.php");
        die;
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/forum.css">
        <script src="scripts/vanila.js"></script>
        <script src="scripts/forum.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="center">
            <div id="forum_home">
                <div id="left_bar">
                    <a href="create_post.php" id="new_blog">+Create New Blog</a>
                    <div id="forum_menu">
                        <a href="forum.php" class="forum_nav_btn">Forum Home</a>
                        <a href="userblogs.php" class="forum_nav_btn selected_forum_nav_btn">My blogs</a>
                    </div>
                </div>
                <div id="blog_list_container">
                    <?php
                            $query = "SELECT * FROM posts WHERE author = '".$_SESSION['current_user']."' ORDER BY id DESC ";
                            $result = mysqli_query($con,$query);
                            if ($result){
                                while($row = mysqli_fetch_array($result))
                                {
                                    $id = $row['id'];
                                    $query = "SELECT * FROM comments WHERE lvl = '0' AND par = '$id'";
                                    echo get_forum_list_item($row,mysqli_num_rows(mysqli_query($con,$query)),$con);
                                }
                            }
                    ?>
                    
                </div>
                
                
            </div>
        </div>
    </body>
</html>
