<?php
	require_once 'Hanfu_SqlHelper.class.php';
	$userName=$_POST['userName'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	if(SqlHelper::registUser($userName,$password,$email))
		echo 0;
	else 
		echo 1;
?>