<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	require_once 'Hanfu_User.class.php';
	if(is_null($_SESSION['userName'])){
		header("Location:index.php");
	}
	$taobaoid=$_GET['taobaoid'];
	//echo $_SESSION['userName'];
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	//echo $user->getUserId();
	$link=$_GET['link'];
	$main_pic=$_GET['main_pic'];
	$type=$_GET['type'];
	$imgs=$_GET['imgs'];
	$title=$_GET['title'];
	$comment=$_GET['comment'];
	if($user->uploadHanfu($title,$main_pic,$comment,$type,$imgs,$taobaoid,$link)){
		$hanfu=SqlHelper::getHanfuByTaobaoid($taobaoid);
		$id=$hanfu->getHanfuId();
		//header("Location:show.php?id=$id");
		echo $id;
	}else{
		die('error');
	}


?>