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
        <link rel="stylesheet" href="css/exam.css">
        <script src="scripts/vanila.js"></script>
        <script src="scripts/exam.js"></script>
        <div ></div>
    </head>
    <body onload="getQuestion()">
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="exam_name"><div>Exam Title:</div><input type="text" placeholder="Exam Title" required></div>
            <div id="input_time">
                <div>Start:
                    <input type="datetime-local" required>
                </div>
                <div>
                    End:
                    <input type="datetime-local" required>
                </div>
            </div>
            <div id="questions_container">
                
            </div>
            <div id="question_menu">
                <div id="add_question" onclick="getQuestion()">+Add Question</div>
                <div id="done" onclick="submit()">Create Exam</div>
            </div>
        </div>
    </body>
</html>