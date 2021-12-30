<?php 
	include '../connection.php';
    if(!isset($_SESSION['current_user'])){
        echo "Probably not logged in";
        die;
    }
	$v=json_decode($_POST['jsonVote']);
    $query = "SELECT * FROM votes WHERE post = ".$v->id." AND user = '".$_SESSION['current_user']."'";
    $dx=0;
    $result = mysqli_query($con,$query);
    if ($result){
        while($row = mysqli_fetch_array($result))
        {
            if($row['vote']==1) $dx=$dx-1;
            elseif($row['vote']==-1) $dx=$dx+1;
        }
    }
    $query = "DELETE FROM votes WHERE post = ".$v->id." AND user = '".$_SESSION['current_user']."'";
    mysqli_query($con,$query);
    $query="INSERT INTO votes (post,user,vote) values (".$v->id.",'".$_SESSION['current_user']."',".$v->vote.")";
    mysqli_query($con,$query);
    $cnt=0;
    $query = "SELECT * FROM votes WHERE post = ".$v->id." AND vote = 1";
    $result = mysqli_query($con,$query);
    if($result) $cnt = $cnt + mysqli_num_rows($result);
    $query = "SELECT * FROM votes WHERE post = ".$v->id." AND vote = -1";
    $result = mysqli_query($con,$query);
    if($result) $cnt = $cnt - mysqli_num_rows($result);
    echo $cnt;
    // echo "true";
    

?>
