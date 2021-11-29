<?php

	session_start();
	if(isset($_SESSION['current_user']))
	{
		unset($_SESSION['current_user']);
	}

	header("Location: index.php");
	die;
?>
