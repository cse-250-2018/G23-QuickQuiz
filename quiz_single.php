<?php
    include 'connection.php';
    include 'functions.php';
    if(!isset($_GET["quizid"]) || !isset($_SESSION["current_user"]))
    {
        header("location: quiz.php");
        die;
    }
    
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
            <?php           date_default_timezone_set("Asia/Dhaka");
                            $quizid=$_GET["quizid"];
                            $query = "SELECT * FROM `quizs` WHERE id = ".$quizid." limit 1";
                            $result = mysqli_query($con,$query);
                            if($result && mysqli_num_rows ( $result )>0)
                            {
                                $row = mysqli_fetch_assoc($result);
                            
                                echo '<div id="quiz_name" quizid="'.$quizid.'"><div>Quiz Title:</div><div>'.$row["name"].'</div></div>';
                                
                                
                                echo '<div id="questions_container">';
                                $query="SELECT * FROM `questions` WHERE quiz = ".$quizid;
                                $questions=$con->query($query);
                                while($question = mysqli_fetch_array($questions))
                                {
                                    echo '<div class="question_container">';
                                        echo '<div class="question" id="'.$question["id"].'">'.$question["question"].'</div>';
                                        $query="SELECT * FROM `options` WHERE question = ".$question["id"];
                                        $options=$con->query($query);
                                        $a='A';
                                        while($option=mysqli_fetch_array($options)){
                                            echo '<div class="option_container" correct="0">';
                                                echo '<div class="option_prefix" onclick="markCorrect(this)">'.$a.'</div>';
                                                echo '<div class="option_suffix">'.$option["option"].'</div>';
                                            echo'</div>';
                                            $a = chr(ord($a)+1);
                                        }
                                    echo '</div>';

                                }
                                echo'</div>';
                                echo'<div id="question_menu">';
                                echo '<div id="showResults"><a href="results.php?quizid='.$quizid.'">Results</a></div>';
                                    if(isset($_SESSION["current_user"]))
                                    echo '<div id="submitAnswer" onclick="quizAnswerSubmit()">Submit Answer</div>';
                                    echo '</div>';
                                }
                                
                        
                            
                   
                    ?>
        </div>
    </body>
</html>