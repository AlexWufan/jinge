<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$id=$_GET['id'];
	$hanfuid=$_GET['hanfuid'];
	$user->addCollectionItem($user->getCollectionById($id),$hanfuid);
?>