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
        <script src="scripts/vanila.js"></script>
        <script src="scripts/exam.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <?php           date_default_timezone_set("Asia/Dhaka");
                            $examid=$_GET["examid"];
                            $query = "SELECT * FROM `exams` WHERE id = ".$examid." limit 1";
                            $result = mysqli_query($con,$query);
                            if($result && mysqli_num_rows ( $result )>0){
                                $row = mysqli_fetch_assoc($result);
                                $start=strtotime($row["startTime"]);
                                $end=strtotime($row["endTime"]);
                                $cur=time();
                                echo '<div id="exam_name" examid="'.$examid.'"><h2>'.$row["name"].'</h2></div>';
                                if($cur<$start){
                                    echo '<div id="before_start">Before Start</div>';
                                    echo '<div id="countDown"></div>';
                                    echo '<script>
                                        startCount("'.$row["startTime"].'");
                                    </script>';
                                }
                                else{
                                    echo '<div id="questions_container">';
                                    $query="SELECT * FROM `questions` WHERE exam = ".$examid;
                                    $questions=$con->query($query);
                                    while($question = mysqli_fetch_array($questions))
                                    {
                                        echo '<div class="question_container">';
                                            echo '<div class="question">'.$question["question"].'</div>';
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
                                        if(isset($_SESSION["current_user"]))
                                        echo '<div id="submitAnswer" onclick="answerSubmit()">Submit Answer</div>';
                                        echo '<div id="showResults"><a href="results.php?examid='.$examid.'">Results</a></div>
                                    </div>';
                                }
                                
                            }
                        
                            
                   
                    ?>
        </div>
    </body>
</html>