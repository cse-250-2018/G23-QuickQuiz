<?php
    
    session_start();

	if(isset($_SESSION['current_user']))
	{
		unset($_SESSION['current_user']);
	}
    
    if(isset($_SESSION['A_type']))
	{
		unset($_SESSION['A_type']);
	}
    if(isset($_SESSION['N_type']))
	{
		unset($_SESSION['N_type']);
	}
    if(isset($_SESSION['C_type']))
	{
		unset($_SESSION['C_type']);
	}
    if(isset($_SESSION['T_type']))
	{
		unset($_SESSION['T_type']);
	}
    if(isset($_SESSION['cntRank']))
	{
		unset($_SESSION['cntRank']);
	}
    if(isset($_SESSION['cntUser']))
	{
		unset($_SESSION['cntUser']);
	}
    if(isset($_SESSION['cntAcc']))
	{
		unset($_SESSION['cntAcc']);
	}

    if(isset($_SESSION['leaderboard_Rank']))
	{
		unset($_SESSION['leaderboard_Rank']);
	}
    if(isset($_SESSION['leaderboard_user']))
	{
		unset($_SESSION['leaderboard_user']);
	}
    if(isset($_SESSION['leaderboard_Accuracy']))
	{
		unset($_SESSION['leaderboard_Accuracy']);
	}


	header("Location: index.php");
	die;
?>
