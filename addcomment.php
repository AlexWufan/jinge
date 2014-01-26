<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	//echo $_SESSION['userName'];
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$hanfuid=$_GET['hanfuid'];
	if(!is_null($_GET['toid'])){
		$type=0;
		$toid=$_GET['toid'];
		//type=0表示对别的用户评论
	}else{
		//$toid=9表示对汉服进行评论
		$type=9;
		$toid=0;
	}
	//echo $toid;
	$comment=$_GET['comment-area'];
	#insertComment($userid,$toid,$hanfuid,$usercomment,$type,$commentdate);
	#setComment($toid,$content,$type,$hanfuid)
	//echo $user->getUserId();
	$user->setComment($toid,$comment,$type,$hanfuid);
	header("location:show.php?id=$hanfuid");
?>