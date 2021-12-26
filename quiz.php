<?php
    include 'connection.php';
    include 'functions.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quiz</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/quiz.css">
        <script src="scripts/vanila.js"></script>
        <script src="scripts/quiz.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="create_quiz"><a href="create_quiz.php">Create Quiz</a> <br> <a href="random.php">Random Quiz</a></div>
            <div><p><br></p></div>
            <div id="quiz_list_container">
                <h2>Recent Quiz:</h2>
                 <?php
                            $query = "SELECT * FROM quizs ORDER BY id DESC ";
                            $result = mysqli_query($con,$query);
                            if ($result){
                                while($row = mysqli_fetch_array($result))
                                {
                                    echo get_quiz_list_item($row);
                                }
                            }
                    ?>
            </div>
        </div>
    </body>
</html>
