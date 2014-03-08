<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	//echo $_SESSION['userName'];
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	if($_GET['hanfuid']){
		$hanfuid=$_GET['hanfuid'];
		if(!is_null($_GET['toid'])){
			$type=0;
			$toid=$_GET['toid'];
			//type=0表示对别的用户评论
		}else{
			//$type=9表示对汉服进行评论
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
	}
	if($_GET['oneDayId']){
		$oneDayId=$_GET['oneDayId'];
		$comment=$_GET['oneDayValue'];
		//对首页进行评论
		$type=8;
		$user->setComment($oneDayId,$comment,$type,$oneDayId);
		$returnArr = array('authorName' =>$user->getUserName() ,'authorId'=>$user->getUserId(),'authorImg'=>$user->getPicture(),'comment'=>$comment );
		echo json_encode($returnArr);
	}
?>