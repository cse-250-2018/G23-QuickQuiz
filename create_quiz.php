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
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="quiz_name"><div>Quiz Title:</div><input type="text" placeholder="Quiz Title" required></div>
            
            <div id="questions_container">
                
            </div>
            
            <div id="part1">
                <?php if(!isset($_SESSION['hideFormDB']))
                echo   '<div class="box-2">
                        <h1 id="heading">Add Question from Database</h1>
                        <form method="POST" enctype="multipart/form-data" action="" >

                            <div>
                                <label>Course :</label>
                                <select name="course">
                                    <option value="any">Any Course</option>
                                    <option value="Structured Programming Language">Structured Programming Language</option>
                                    <option value="Discrete Math">Discrete Math</option>
                                    <option value="Data Structures">Data Structures</option>
                                    <option value="Algorithm Design & Analysis">Algorithm Design & Analysis</option>
                                    <option value="Object Oriented Programming">Object Oriented Programming </option>
                                    <option value="Numerical Analysis">Numerical Analysis </option>
                                    <option value="Theory of Computation">Theory of Computation</option>
                                    <option value="Ethics & Cyber Law"> Ethics & Cyber Law </option>
                                    <option value="Digital Signal Processing">Digital Signal Processing </option>
                                    <option value="Database System"> Database System </option>
                                    <option value="Operating System"> Operating System </option>
                                    <option value="Computer Networking"> Computer Networking </option>
                                    <option value="Computer Graphics"> Computer Graphics </option>
                                    <option value="Computer Architecture"> Computer Architecture </option>
                                    <option value="Artificial Intelligence"> Artificial Intelligence </option>
                                    <option value="Machine Learning"> Machine Learning </option>
                                    <option value="Others"> Others </option>

                                </select>
                            </div>
                            <div>
                                <label>Difficulty :</label>
                                <select name="difficulty">
                                    <option value="any">Any</option>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                            <div align="center" >
                                <input id="button2" type="reset" value="Skip" onclick="hidePart1()">
                                <input id="button" type="submit" name="submit" value="Get Questions">
                            </div>
                        </form>

                    </div>';
                
            ?>
                
                <?php 
                    
                    $course = "any";
                    $dif = "any";
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
                        
                        $course=$_POST['course'];
                        $dif=$_POST['difficulty'];
                        $_SESSION['hideFormDB']="hide";
                    }
                
                    $sql = "SELECT * FROM `questions` ";
                    if($course != "any" && $dif != "any")
                        $sql.="WHERE course='".$course."' AND difficulty='".$dif."'";
                    else if($course != "any")
                        $sql.="WHERE course='".$course."'";
                    else if($dif != "any")
                        $sql.="WHERE difficulty='".$dif."'";
                
                    $result = mysqli_query($con, $sql);
                    //echo $sql;
                    
                    while($qsn = mysqli_fetch_array($result))
                    {
                        $html = '';
                        $html.= '<label>';
                        $html.= '<div class="question_container2">';
                        $html.= 'Select <input type="checkbox" class="q_cont" value="'.$qsn['id'].'">';
                        $html.= '<div class="qid">';
                        $html.= '<div id="left">'.$qsn["course"].'</div>';
                        $html.= '<div id="center">Difficulty: '.$qsn["difficulty"].'</div>';
                        $html.= '<div id="right">Marks: '.$qsn["marks"].'</div> </div>';
                        $html.= '<div class="question2">'.$qsn["question"].'</div>';
                            
                        $qry="SELECT * FROM `options` WHERE question = ".$qsn['id'];
                        $options=mysqli_query($con,$qry);

                        $j=0;
                        while($option=mysqli_fetch_array($options))
                        {
                            $html.='<div class="option" ';
                            if($j == $qsn['answer'])
                                $html.='id="correct">';
                            else 
                                $html.='>';

                            $html.=$option["option"].'</div>';

                            $j++;
                        }
                        $html.='</div>';
                        
                        $html.= '</label>';
                        
                        if(isset($_SESSION['hideFormDB']))
                            echo $html;
                        $html = "";
                    }
                    
                    if(isset($_SESSION['hideFormDB']))
                        echo '<div align="center"><input id="button3" type="submit" value="Done" onclick="hidePart1()"></div>';
                    
                ?>
            </div>
            
            <div id="part2">
                <div id="question_menu">
                    <div id="add_question" onclick="getQuestion()">+Add Question</div>
                    <div id="done" onclick="submit()">Create Quiz</div>
                </div>
            </div>
            
        </div>
    </body>
</html>
