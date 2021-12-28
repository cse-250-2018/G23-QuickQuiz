<?php
    include 'connection.php';
    include 'functions.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/forum.css">
        <script src="scripts/vanila.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="center">
            <div id="forum_home">
                <div id="left_bar">
                    <a href="create_post.php" id="new_blog">+Create New Blog</a>
                    <div id="forum_menu">
                        <a href="#" class="forum_nav_btn selected_forum_nav_btn">Forum Home</a>
                        <a href="#" class="forum_nav_btn">My blogs</a>
                        <a href="#" class="forum_nav_btn">My groups</a>
                        <a href="#" class="forum_nav_btn">Groups</a>
                    </div>
                    <div id="top_users">
                        Top Users
                        <a href="#" class="top_user_item">You Kn0who</a>
                        <a href="#" class="top_user_item">Steinum</a>
                        <a href="#" class="top_user_item">Kawchar85</a>
                        <a href="#" class="top_user_item">Raiden</a>
                        <a href="#" class="top_user_item">DEVIL_MAY_CRY</a>
                    </div>
                </div>
                <div id="blog_list_container">
                    <?php
                            $query = "SELECT * FROM posts ORDER BY id DESC ";
                            $result = mysqli_query($con,$query);
                            if ($result){
                                while($row = mysqli_fetch_array($result))
                                {
                                    $id = $row['id'];
                                    $query = "SELECT * FROM comments WHERE lvl = '0' AND par = '$id'";
                                    echo get_forum_list_item($row,mysqli_num_rows(mysqli_query($con,$query)));
                                }
                            }
                    ?>
                    
                </div>
                
                
            </div>
        </div>
    </body>
</html>