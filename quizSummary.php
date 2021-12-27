<?php
    include 'connection.php';
    include 'functions.php';
    if(!isset($_SESSION['your_ans']))
    {
        header("location: quiz.php");
        die;
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quiz Result</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/summary.css">
        <script src="scripts/vanila.js"></script>
        <script src="scripts/quiz.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
            
            
            <table>
                <tr>
                    <th colspan="2">Result Summary</th>
                </tr>
                <tr>
                    <td align="center">Total Question</td>
                    <td align="center"><?php echo $_SESSION['total']; ?></td>
                </tr>
                <tr>
                    <td align="center">Attempt</td>
                    <td align="center"><?php echo $_SESSION['attempt']; ?></td>
                </tr>
                <tr>
                    <td align="center">Correct</td>
                    <td align="center"><?php echo $_SESSION['correct']; ?></td>
                </tr>
                <tr>
                    <td align="center">Total Score</td>
                    <td align="center"><?php echo $_SESSION['score']; ?></td>
                </tr>
            
            </table>
            <?php
                echo $_SESSION['your_ans']; echo "<br>";
            ?>
        
    </body>
    
        <?php 
            
            //Dummy question for test
    
            /*<div class="question_container">
            
                <div class="qid">
                    <div id="left">Question 1:</div>
                    <div id="center">Difficulty: Easy</div>
                    <div id="right">Marks: 5</div>
                </div>
                <div class="question">Did you read fft to solve this question?</div>
                <div class="option" id="wrong">Yes</div>
                <div class="option">Why</div>
                <div class="option" id="correct">No</div>
                <div class="option">WTF</div>
                <div class="option">hewew</div>
                <div class="option">Yup</div>
            
            </div>
            
            <div class="question_container">
            
                <div class="qid">
                    <div id="left">Question 2:</div>
                    <div id="center">Difficulty: Easy</div>
                    <div id="right">Marks: 5</div>
                </div>
                <div class="question">Did you read fft to solve this question?</div>
                <div class="option">Yes</div>
                <div class="option">Why</div>
                <div class="option" id="correct">No</div>
                <div class="option">WTF</div>
                <div class="option">hewew</div>
                <div class="option">Yup</div>
            
            </div>
            
            <hr><hr><hr>*/
        ?>
</html>
