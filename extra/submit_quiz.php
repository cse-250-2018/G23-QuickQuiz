<?php 
	include '../connection.php';
    if(!isset($_POST['jsonExam'])||!isset($_SESSION['current_user'])){
        echo "Probably not logged in";
        die;
    }
	$exam=json_decode($_POST['jsonExam']);
    $quiz_id=$exam->quizid;
        
    $html="";
    $total=count($exam->questions);
    $correct=0;
    $attempt=0;
    $score=0;
    $total_marks=0;
    for($i=0; $i<$total; $i++)
    {
        $id=$exam->questions[$i]->id;
        $ans=$exam->questions[$i]->answer;
        $query="SELECT * FROM `questions` WHERE id = ".$id;
        $result= mysqli_query($con,$query);
        
        if($ans != -1)
            $attempt++;
        
        if($result && mysqli_num_rows ( $result )>0){
            $row = mysqli_fetch_assoc($result);
            if($row['answer'] == $ans){
                $correct++;
                $score+=$row['marks'];
            }
            
            $total_marks+=$row['marks'];
            
            $html.= '<div class="question_container">';
            $html.= '<div class="qid">';
            $html.= '<div id="left">Question :'.($i+1).'</div>';
            $html.= '<div id="center">Difficulty: '.$row["difficulty"].'</div>';
            $html.= '<div id="right">Marks: '.$row["marks"].'</div> </div>';
            $html.= '<div class="question">'.$row["question"].'</div>';
            
            $qry="SELECT * FROM `options` WHERE question = ".$id;
            $options=mysqli_query($con,$qry);
            
            $j=0;
            while($option=mysqli_fetch_array($options))
            {
                $html.='<div class="option" ';
                if($ans == $j) //selected
                {
                    if($ans == $row['answer']) //correct
                        $html.='id="correct">';
                    else //wrong
                        $html.='id="wrong">';
                }
                else if($j == $row['answer']) //actual ans but not selected
                    $html.='id="correct2">';
                else 
                    $html.='>';
                
                $html.=$option["option"].'</div>';
                
                $j++;
            }
            $html.='</div>';
        }
    }

    $cur_result=$score.'/'.$total_marks;

    $html='<table>
                <tr> <th colspan="2">Result Summary</th> </tr>
                <tr>
                    <td align="center">Total Question</td>
                    <td align="center">'.$total.'</td>
                </tr>
                <tr>
                    <td align="center">Attempt</td>
                    <td align="center">'.$attempt.'</td>
                </tr>
                <tr>
                    <td align="center">Correct</td>
                    <td align="center">'.$correct.'</td>
                </tr>
                <tr>
                    <td align="center">Score</td>
                    <td align="center">'.$cur_result.'</td>
                </tr>
            </table>'.$html;
    
    $_SESSION['your_result']=$html;

    $query="SELECT * FROM `results` WHERE quiz = ".$quiz_id." AND user = '".$_SESSION["current_user"]."'";
    $result = $con->query($query);
    if(!($result && mysqli_num_rows ( $result )>0))
    {
        $query='INSERT INTO results (quiz, user, score) VALUES ("'.$quiz_id.'","'.$_SESSION["current_user"].'","'.$score.'")';
        $con->query($query);
        
        $path="../results/".$_SESSION["current_user"]."/quiz";
        if( is_dir($path) === false )
        {
            mkdir($path,0777,true);
        }
        $path.="/".$quiz_id.".txt";
        $file = fopen($path, 'w');
        fwrite($file, $html);
        
        echo "true";
    }
    else echo"Current score:(".$cur_result.").But you have already submitted before.";

?>