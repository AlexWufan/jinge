<?
	require_once 'Hanfu_SqlHelper.class.php';
	$userName=$_GET['userName'];
	if(SqlHelper::getUserByName($userName)->getUserName()==""){
		echo 0;
	}else{
		echo 1;
	}
?>