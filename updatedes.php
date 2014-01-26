<?
	session_start();
	$des=$_GET['des'];
	require_once 'Hanfu_SqlHelper.class.php';
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$user->setDescribe($des);
	header("Location:setting.php");
?>