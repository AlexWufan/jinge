<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	require_once 'Hanfu_FileControl.class.php';
	$index=$_GET['index'];
	$num=10;
	$len=18;
	$user=SqlHelper::getuserByName($_SESSION["userName"]);
	$returnArr=array();
	$oneDayArr=SqlHelper::subOneDay($index,$num);
	for($i=0;$i<count($oneDayArr);$i++){
		$arr=array();
		$oneDay=SqlHelper::getOneDayById($oneDayArr[$i]);
		$owner=SqlHelper::getuserByName($oneDay->getAuthor());
		$arrToComment=array();
		$onedayComments=$oneDay->getCommentList();
		for($j=0;$j<count($onedayComments);$j++){
			$comment=SqlHelper::getCommentById($onedayComments[$j]);
			$commenter=SqlHelper::getUserById($comment->getCommentUserId());
			$arr2 = array(
				"author"=>$commenter->getUserName(),
				"comment"=>$comment->getComment(),
				"authorid"=>$commenter->getUserId(),
				"img"=>$commenter->getPicture()
				); 
			array_push($arrToComment,$arr2);
		}
		$arr = array(
			'authorName' =>$owner->getUserName(),
			"timer"=>$oneDay->getTime(),
			"mainImg"=>$oneDay->getImage(),
			"admireNum"=>$oneDay->getAdmireNum(),
			"authorImg"=>$owner->getPicture(),
			"reason"=>$oneDay->getReason(),
			"commentList"=>$arrToComment,
			"TimeStamp"=>$oneDay->getTimeStamp(),
			"id"=>$oneDay->getId(),
			"isAdmired"=>$user->isAdmired("oneDay",$oneDay->getId())
			 );
		array_push($returnArr, $arr);
	}
	echo json_encode($returnArr);
?>