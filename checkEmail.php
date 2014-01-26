<?
	require_once 'Hanfu_SqlHelper.class.php';
	$email=$_GET['email'];
	if(SqlHelper::getUserByEmail($email)->getUserName()==""){
		echo 0;
	}else{
		echo 1;
	}
?>