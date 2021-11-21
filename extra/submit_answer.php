<?php 
	include '../connection.php';
    if(!isset($_POST['jsonExam'])||!isset($_SESSION['current_user'])){
        echo "Probably not logged in";
        die;
    }
	$exam=json_decode($_POST['jsonExam']);
    $exam_id=$exam->examid;
    $query="SELECT * FROM `questions` WHERE exam = ".$exam_id;
    $questions=$con->query($query);
    $i=0;
    $score=0;
    while($question = mysqli_fetch_array($questions))
    {
        if($question["answer"]==$exam->questions[$i]->answer) $score++;
        $i++;
    }
    $query="SELECT * FROM `results` WHERE exam = ".$exam_id." AND user = '".$_SESSION["current_user"]."'";
    $result = $con->query($query);
    if(!($result && mysqli_num_rows ( $result )>0)){
        $query='INSERT INTO results (exam, user, score) VALUES ("'.$exam_id.'","'.$_SESSION["current_user"].'","'.$score.'")';
        $con->query($query);
    }
    else echo"Current score:".$score.".But you have already submitted before.";
    echo "true";

?>