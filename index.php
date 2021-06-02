<?php 
	session_start();

	include("connection.php");
	include("functions.php");

	$user_data = alreadyLogin($con);

?>

<html>
<head>
	<title>Quick Quiz</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>This is the home page</h1>

	<br>
	Hello, <?php echo $user_data['user_name']; ?>
	
	<br><br><br><br><hr>
	[Not finished! Will work.... Temporary...]
	<hr>
</body>
</html>
