<?php
    include 'connection.php';
    if(!isset($_SESSION['current_user']))
    {
        header("Location:login.php");
        die;
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/quiz.css">
        <script src="scripts/vanila.js"></script>
        <script src="scripts/quiz.js"></script>
        <div ></div>
    </head>
    <body onload="getQuestion()">
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="quiz_name"><div>Quiz Title:</div><input type="text" placeholder="Quiz Title" required></div>
            
            <div id="questions_container">
                
            </div>
            <div id="question_menu">
                <div id="add_question" onclick="getQuestion()">+Add Question</div>
                <div id="add_question_db" onclick="getQuestionFromDB()">+ from DataBase</div>
                <div id="done" onclick="submit()">Create Quiz</div>
            </div>
        </div>
    </body>
</html>