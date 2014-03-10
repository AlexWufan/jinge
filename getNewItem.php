<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	require_once 'Hanfu_FileControl.class.php';
	$user=SqlHelper::getUserByName($_SESSION["userName"]);
	$index=$_GET['index'];
	$num=10;
	$len=18;
	$returnArr=array();
	$hanfuArr=SqlHelper::subPageHanfu($index,$num);
	for($i=0;$i<count($hanfuArr);$i++){
		$arr=array();
		$hanfu=SqlHelper::getHanfuById($hanfuArr[$i]);
		$owner=SqlHelper::getUserById($hanfu->getAuthorId());
		$arr['hanfuName']=$hanfu->getHanfuName();
		$arr['hanfuMainPic']=$hanfu->getMain_pic();
		$arr['hanfuOwner']=$owner->getUserName();
		$commentStr=$hanfu->getComment();
		$arr['hanfuComment']=strlen($commentStr)<=$len ? $commentStr : (mb_substr($commentStr,0,$len,'UTF-8').chr(0)."...");  
		$arr['hanfuCommentNum']=$hanfu->getCommentNum();
		$arr['hanfuLikeNum']=$hanfu->getAdmireNum();
		$arr['hanfuType']=$hanfu->getType();
		$arr['ownerPic']=$owner->getPicture();
		$arr['hanfuLink']="show.php?id=".$hanfuArr[$i];
		$arr['ownerLink']="user.php?id=".$owner->getUserId();
		$arr['commentLink']="show.php?id=".$hanfuArr[$i]."#comment";
		$arr['likeLink']="show.php?id=".$hanfuArr[$i]."#like-tab";
		$arr['isLike']=$user->isAdmired("hanfu",$hanfuArr[$i]);
		$arr['showid']=$hanfuArr[$i];
		array_push($returnArr, $arr);
	}
	//print_r($returnArr);
	echo json_encode($returnArr);
?>