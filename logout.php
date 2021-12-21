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


	header("Location: index.php");
	die;
?>
