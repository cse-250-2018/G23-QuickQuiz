<?php
    include 'connection.php';
    include 'functions.php';

    $noQ="10";
    $course="any";

    if(!isset($_POST['submit']))
    {
        header("Location: random.php");
        die;
    }
    if(isset($_POST['noQ'])) $noQ=$_POST['noQ'];
    if(isset($_POST['course'])) $course=$_POST['course'];
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Random Quiz</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/quiz.css">
        <script src="scripts/quiz.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
    
        
            <div id="home">
                <?php           
                            
                    date_default_timezone_set("Asia/Dhaka");
                
                    //$query = "SELECT * FROM `questions` ORDER BY RAND() LIMIT 10";
                    $query = "SELECT * FROM `questions` ";
                    if($course != "any")
                        $query = $query."WHERE course = "."'".$course."'"." ";
                    $query = $query."ORDER BY RAND() LIMIT ".$noQ;
                    
        
        
                    $questions = mysqli_query($con,$query);

                    $empty=1;
        
                    
                    echo '<div id="questions_container">';
                    while($question = mysqli_fetch_array($questions))
                    {
                        $empty=0;
                        echo '<div class="question_container">';
                            echo '<div class="question" id="'.$question["id"].'">'.$question["question"].'</div>';
                            $query="SELECT * FROM `options` WHERE question = ".$question["id"];
                            $options= mysqli_query($con,$query);
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
                    if($empty)
                    {
                        echo "Sorry! No questions in databse about ".$course;
                    }
                    else
                    {
                        echo'<div id="question_menu">';
                            if(isset($_SESSION["current_user"]))
                            echo '<div id="submitAnswer" onclick="answerSubmit()">Submit Answer</div>';
                            echo '</div>';
                    }        
                    
                   
                    ?>
        </div>
        
    </body>
</html>
