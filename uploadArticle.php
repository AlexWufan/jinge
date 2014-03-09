<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	$userName=$_SESSION['userName'];
	$user=SqlHelper::getUserByName($userName);
	date_default_timezone_set('Asia/Shanghai');
	$now=date("Y-m-d H:i:s");
	$user->addArticle($_GET['title'],$_GET['content'],$now);
	header("Location:uploadComplete.php");
?>