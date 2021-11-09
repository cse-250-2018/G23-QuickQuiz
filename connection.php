<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "project";
session_start();
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}
?>
