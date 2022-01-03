<?php 
	include '../connection.php';
    if(isset($_SESSION['hideFormDB']))
    {
        unset($_SESSION['hideFormDB']);
    }
    if(!isset($_POST['jsonExam'])||!isset($_SESSION['current_user'])){
        echo "Probably not logged in";
        die;
    }

	$exam=json_decode($_POST['jsonExam']);
    $quiz_id=$exam->quizid;

    for($i=0;$i<count($exam->questions);$i++){
        $question_id=$exam->questions[$i]->id;
        
        $query="SELECT * FROM `questions` WHERE id = ".$question_id." LIMIT 1";
        $result= mysqli_query($con,$query);
        
        if($result && mysqli_num_rows ( $result )>0){
            $row = mysqli_fetch_assoc($result);
            
            $query='INSERT INTO `questions` (question, answer, quiz, course, difficulty, marks, duplicate) VALUES ("'.$row["question"].'","'.$row['answer'].'","'.$quiz_id.'","'.$row['course'].'","'.$row['difficulty'].'","'.$row['marks'].'", "1" )';
            
            //echo $query;
            
            $con->query($query);
            $id=$con->insert_id;
            
            //echo 'new qsn as '.$id.' insted of '.$question_id.' ';
            
            $qry="SELECT * FROM `options` WHERE question = ".$question_id;
            $options=mysqli_query($con,$qry);
            while($option=mysqli_fetch_array($options)){
                $query='INSERT INTO options (question,option) VALUES ("'.$id.'","'.$option["option"].'")';
                $con->query($query);
                //echo 'new op as '.$con->insert_id.' insted of '.$question_id;
            }
        }
    }
    echo "true";

?>