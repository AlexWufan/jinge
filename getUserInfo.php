<?
	//session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	require_once 'Hanfu_FileControl.class.php';
	//require_once '';
	$index=$_GET['index'];
	$id=$_GET['id'];
	$type=$_GET['type'];
	$user=SqlHelper::getUserById($id);
	//$num=10;
	//$sessionid=SqlHelper::getUserByName($_SESSION['userName'])->getUserId();
	$returnArr=array();
	if($type=='hanfu'){
		$news=$user->getInfo();
		if($index<count($news)){
			for($i=$index*3;$i<$index*3+3;$i++){
				//print_r($news);
				$arr=array();
				$hanfu=SqlHelper::getHanfuById($news[$i][0]);
				$owner=SqlHelper::getUserById($hanfu->getAuthorId());
				$arr['hanfuid']=$news[$i][0];
				$arr['ownerName']=$owner->getUserName();
				$arr['hanfuLink']="show.php?id=".$news[$i][0];
				$arr['hanfuName']=$hanfu->getHanfuName();
				$arr['ownerLink']="user.php?id=".$owner->getUserId();
				$arr['ownerImage']=$owner->getPicture();
				$arr['mainpic']=$hanfu->getMain_pic();
				$arr['time']=$news[$i][1];
				$arr['type']=$news[$i][2];
				if(!is_null($arr['hanfuid'])){
					array_push($returnArr, $arr);
				}
			}
			echo json_encode($returnArr);
		}
		
	}
	if($type=='fans'){
		$list=$user->getFansList();
		if($index<count($list)){
			for ($i=$index*3; $i <$index*2+3 ; $i++) { 
				# code...
				$arr=array();
				$fans=SqlHelper::getUserById($list[$i][0]);
				$arr['userid']=$list[$i][0];
				$arr['userName']=$fans->getUserName();
				$arr['userDes']=$fans->getDescribe();
				$arr['userPic']=$fans->getPicture();
				$arr['isIn']=FileControl::inArray($id,$fans->getFansList());
				$arr['userLink']="user.php?id=".$list[$i][0];
				if(!is_null($arr['userName'])){
					array_push($returnArr, $arr);
				}
			}
			echo json_encode($returnArr);
		}
	}
	if($type=='attention'){
		$list=$user->getAttentionPeopleList();
		if($index<count($list)){
			for ($i=$index*3; $i <$index*3+3 ; $i++) { 
				# code...
				$arr=array();
				$user=SqlHelper::getUserById($list[$i][0]);
				$arr['userid']=$list[$i][0];
				$arr['userName']=$user->getUserName();
				$arr['userDes']=$user->getDescribe();
				$arr['userPic']=$user->getPicture();
				$arr['isIn']=FileControl::inArray($id,$user->getAttentionPeopleList());
				$arr['userLink']="user.php?id=".$list[$i][0];
				if(!is_null($arr['userName'])){
					array_push($returnArr, $arr);
				}
			}
			echo json_encode($returnArr);
		}
	}

	

?>