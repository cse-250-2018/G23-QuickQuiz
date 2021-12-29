<?php 
	include '../connection.php';
    if(!isset($_POST['jsonExam'])||!isset($_SESSION['current_user'])){
        echo "Probably not logged in";
        die;
    }

	$exam=json_decode($_POST['jsonExam']);
    $query='INSERT INTO quizs (name, author) VALUES ("'.$exam->name.'", "'.$_SESSION['current_user'].'")';
    $con->query($query);
    $quiz_id=$con->insert_id;
    for($i=0;$i<count($exam->questions);$i++){
        $question=$exam->questions[$i];
        $query='INSERT INTO questions (question, answer, quiz, course, difficulty, marks) VALUES ("'.$question->statement.'","'.$question->answer.'","'.$quiz_id.'","'.$question->course.'","'.$question->difficulty.'","'.(int)$question->marks.'")';
        $con->query($query);
        $question_id=$con->insert_id;
        for($j=0;$j<count($question->options);$j++){
            $option=$question->options[$j];
            $query='INSERT INTO options (question,option) VALUES ("'.$question_id.'","'.$option->value.'")';
            $con->query($query);
        }
    }
    echo count($exam->questions);

?>