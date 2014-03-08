<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	require_once 'Hanfu_User.class.php';
	if(is_null($_SESSION['userName'])){
		header("Location:index.php");
	}
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$data["taobaoid"]=$_GET['taobaoid'];
	$data["link"]=$_GET['link'];
	$data["main_pic"]=$_GET['main_pic'];
	$data["type"]=$_GET['type'];
	$data["imgs"]=$_GET['imgs'];
	$data["title"]=$_GET['title'];
	$data["comment"]=$_GET['comment'];
	if($user->uploadHanfu($data)){
		$hanfu=SqlHelper::getHanfuByTaobaoid($taobaoid);
		$id=$hanfu->getHanfuId();
		//header("Location:show.php?id=$id");
		echo $id;
	}else{
		die('error');
	}


?>