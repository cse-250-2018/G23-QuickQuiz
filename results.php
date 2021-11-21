<?php
    include 'connection.php';
    include 'functions.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/exam.css">
        <script src="scripts/run.js"></script>
        <script src="scripts/exam.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="score_board">
                 <?php
                            if(isset($_GET['examid'])){
                                $query = "SELECT * FROM results WHERE exam = ".$_GET["examid"]." ORDER BY score DESC ";
                                $result = mysqli_query($con,$query);
                                if ($result){
                                    $sql="SELECT * FROM exams WHERE id = '".$_GET["examid"]."'";
                                    $res=mysqli_query($con,$sql);
                                    $exm=mysqli_fetch_array($res);
                                    echo '<h2>Results of '.$exm["name"].'</h2>';
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        
                                        echo '<div class="score_container">';
                                            echo '<div class="score_user">'.$row["user"].'</div>';
                                            echo '<div class="score">'.$row["score"].'</div>';
                                        echo '</div>';
                                    }
                                }
                            }
                            else{
                                echo"<h1>404 Not found</h1>";
                            }
                    ?>
            </div>
        </div>
    </body>
</html>