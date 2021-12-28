<?php
    include 'connection.php';
    include 'functions.php';
    $blogid=27;
    if(isset($_GET['blogid']))
        $blogid=$_GET['blogid'];
    else
        $_GET['blogid']=$blogid;
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_btn']))
	{
		writeComment($_GET,$_POST, $con);
        $url="blog_single.php?blogid=".$blogid;
		unset($_POST);
        header("Location: ".$url);
        exit;
	}
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_submit']))
	{
		writeReply($_POST, $con);
        $url="blog_single.php?blogid=".$blogid;
		unset($_POST);
        header("Location: ".$url);
        exit;
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
        <script src="library/ckeditor/build/ckeditor.js"></script>
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
                <div id="blog_single_page_container">
                    <div id="blog_single_container">
                        <?php 
                            echo '<div id="blog_single_blog_area">';
                                $blogid=$_GET['blogid'];
                                $query = "SELECT * FROM `posts` WHERE id = ".$blogid." limit 1";
                                $result = mysqli_query($con,$query);
                                if($result && mysqli_num_rows ( $result )>0){
                                    $row = mysqli_fetch_assoc($result);
                                    $blog = $row['content'];
                                    echo '<a href="#">'.$row['title'].'</a>';
                                    echo '<p id="blog_time">Posted by <a href="#">'.$row['author'].'</a> '.timeSince($row['time']).' ago</p>';

                                }
                                echo '<div id="blog_body">';
                                echo $blog;
                                echo '</div>';
                            echo '</div>';
                            echo'<div id="blog_single_vote_bar">
                            <div id="lft_vote_bar">
                                <img src="images/upvote_icon.svg">
                                    <p>+3</p>
                                <img src="images/downvote_icon.svg">
                            </div>
                            <div id="rht_vote_bar">
                                <a id="author_vote_bar" href="#">'.$row['author'].'</a>
                                <img src="images/comments.svg">
                                38
                            </div>
                        </div>';
                        ?>
                    
                    </div>
                    <?php 
                        if(isset($_SESSION['current_user']))
                        echo'<div id="comment_field">
                            <?php $current_url?>
                            <form action="" method="POST" onsubmit="return calibrateTextArea()">
                                <textarea name="comment" cols="90" rows="10" class="editor"></textarea>
                                <button type="submit" id="comment_btn" name="comment_btn">Add Comment</button>
                            </form>
                        </div>';
                    ?>
                    <div id="comment_area">
                        <?php
                                $query = "SELECT * FROM comments WHERE lvl = '0' AND par = '$blogid'";
                                $result = mysqli_query($con,$query);
                                if ($result){
                                    while($row = mysqli_fetch_array($result))
                                    {
                                    echo '<div class="comment_container">';
                                    $cmnt=$row['content'];
                                            echo '<div class="comment_total">';
                                                echo'<div class="comment_prefix">';
                                                    echo '<div class="comment_author">';
                                                        echo '<div>';
                                                            echo '<img src="profile/'.$row['user'].'.jpg">';
                                                            echo '<a href="#">'.$row['user'].'</a>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                                echo '<div class="comment_suffix">
                                                        <p class="comment_time">'.timeSince($row['time']).' ago</p>
                                                        '.$cmnt.'
                                                        <div class="reply_btn_container"><div class="comment_replay_btn" onclick="showReplyField(this,'.$row['id'].');">&#8594;Reply</div></div>
                                                        <div class="reply_form_container">
                                                            <form method="post" onsubmit="return calibrateTextArea()">
                                                                <textarea name="reply" class="editor"></textarea>
                                                                <input name="replyto" type="text">
                                                                <div id="reply_btns_container"><button type="submit" name="reply_submit">Post</button><button onclick="hideReplyField(this)" type="button">Cancel</button></div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                </div>';
                                            echo '<div class="replies">';
                                                echo dfsReplies($row['id'],$con);
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                }
                        ?>
                        <script>
                            
                            let elements = document.querySelectorAll( ".editor" );
                            for(let i=0;i<elements.length;i++) {
                                let=element=elements[i];
                                // console.log(element);
                                ClassicEditor.create( element, {
                                            
                                            licenseKey: "",
                                            
                                            
                                            
                                        } )
                                        .then( editor => {
                                            window.editor = editor;
                                    
                                            
                                            
                                            
                                        } )
                                        .catch( error => {
                                            console.error( "Oops, something went wrong!" );
                                            console.error( "Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:" );
                                            console.warn( "Build id: qbme1jx5fki8-5m8tcsd1s9ci" );
                                            console.error( error );
                                        } );
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>