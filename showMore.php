<?
	require_once 'Hanfu_SqlHelper.class.php';
	$oneDayId=$_GET['oneDayId'];
	$returnArr=array();
	$arr=SqlHelper::getsubComment($oneDayId);
	for ($i=0; $i <count($arr) ; $i++) { 
		$comment=SqlHelper::getCommentById($arr[$i]);
		$user=SqlHelper::getUserById($comment->getCommentUserId());
		$arr2=array("authorName"=>$user->getUserName(),"authorImage"=>$user->getPicture(),"comment"=>$comment->getComment(),"authorId"=>$user->getUserId());
		array_push($returnArr,$arr2);
	}
	echo json_encode($returnArr);
?>