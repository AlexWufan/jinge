<?php
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	$userName=$_POST['userName'];
	$password=$_POST['password'];
	$sql="select password from user where name='$userName'";
	$res=SqlHelper::execute_sql($sql);
	$row=mysql_fetch_assoc($res);
	if($row){
        if(md5($password)==$row['password']){
            $_SESSION['userName']=$userName;
            echo 0;
        }
        else
            echo 1;
    }else{
        echo 2;
    }

?>