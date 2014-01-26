<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	$title=$_GET['title'];
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	if($_GET['flag']){
		$user->newCollectionList($title);
		header("Location:backet.php");
	}else{
		if($user->newCollectionList($title)){
			echo $title;
		}
	}
?>