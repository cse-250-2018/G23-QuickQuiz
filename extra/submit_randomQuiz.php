 <?php 
	include '../connection.php';
    if(!isset($_POST['jsonExam'])||!isset($_SESSION['current_user'])){
        echo "Probably not logged in";
        die;
    }
	$exam=json_decode($_POST['jsonExam']);
    
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
    
    $result=$score.'/'.$total_marks;
    //store in session
    $_SESSION['total']=$total;
    $_SESSION['correct']=$correct;
    $_SESSION['score']=$result;
    $_SESSION['attempt']=$attempt;
    $_SESSION['your_ans']=$html;


    echo "true";

?>
