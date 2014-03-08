<?php
require_once 'Hanfu_FileControl.class.php';

class User{
	private $userId;
	private $userName;
	private $password;
	private $email;
	private $collectHanfuList;
	private $collectHanfuNum;
	private $admireHanfuList;
	private $admireHanfuNum;
	private $picture;
	private $intime;
	private $describe;
	private $attentionPeopleList;
	private $attentionPeoplePath;
	private $attentionPeopleNum;
	private $fansList;
	private $fansPath;
	private $fansNum;
	private $markedPeopleList;

	public function __construct($userId,$userName,$password,$email,$intime,$describe){
		$this->userId=$userId;
		$this->userName=$userName;
		$this->password=$password;
		$this->email=$email;

		$this->collectHanfuList=FileControl::readUserCollectById($this->userId);
		$this->admireHanfuList=FileControl::readUserAdmireById($this->userId);
		$this->collectHanfuNum=count($this->collectHanfuList);
		$this->admireHanfuNum=count($this->admireHanfuList);
		$this->picture=FileControl::readUserPic($this->userId);
		$this->intime=$intime;
		$this->describe=$describe;
		$this->attentionPeopleList=FileControl::readUserAttentionPeoplesById($this->userId);
		$this->fansList=FileControl::readUserFansById($this->userId);
		$this->attentionPeopleNum=count($this->attentionPeopleList);
		$this->fansNum=count($this->fansList);
		
	}
	function __destruct(){
			unset($userId);
			unset($userName);
			unset($password);
			unset($email);
			unset($intime);
		}
	public function getUserId(){
		return $this->userId;
	}
	public function getIntime(){
		return $this->intime;
	}
	public function getUserName(){
		return $this->userName;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getPicture(){
		return $this->picture;
	}
	
	public function getCollectHanfuNum(){
		return $this->collectHanfuNum;	
	}
	
	public function getCollectHanfuList(){
		return $this->collectHanfuList;
	}
	
	public function getAdmireHanfuList(){
		return $this->admireHanfuList;
	}
	
	public function getAdmireHanfuNum(){
		return $this->admireHanfuNum;
	}
	
	public function getFansList(){
		return $this->fansList;
	}
	
	public function getFansNum(){
		return $this->fansNum;
	}
	
	public function getAttentionPeopleList(){
		return $this->attentionPeopleList;
	}
	
	public function getAttentionPeopleNum(){
		return $this->attentionPeopleNum;
	}
	
	public function getRecentNewsList(){
		return $this->recentNewsList;
	}
	
	public function getRecentNewsNum(){
		return $this->recentNewsNum;
	}
	public function addUserInfo($userId,$arr){
		FileControl::saveUserInfo($userId,$arr);
	}
	public function getRecentNews(){
		$recentNews=array();
		for($i=$this->recentNewsNum-1,$j=0;$i>=0 && $j<(self::newsLimit);$i--,$j++){
			array_push($recentNews,$this->recentNewsList[$i % (self::newsLimit)]);
		}	
		return $recentNews;
	}
	public function getAdmireNum(){
		$trees=$this->sqlHelper->getFullTreesByUserId($this->userId);
		foreach ($trees as $tree){
			$this->admireNum+=$tree->getAdmire();
		}
		return $this->admireNum;
	}
	public function resetUserName($userName){
		$this->userName=$userName;
	}
	
	public function resetPassword($password){
		SqlHelper::updatePassword($this->userId,$password);
	}
	public function setDescribe($describe){
		SqlHelper::updateDescribe($this->userId,$describe);
	}
	public function collectHanfu($Hanfu){
		if(!in_array($Hanfu->getHanfuId(),$this->collectHanfuList)){
			array_push($this->collectHanfuList,$Hanfu->getHanfuId());
			$this->collectHanfuNum++;
			FileControl::saveUserCollectHanfuById($this->userId,$this->collectHanfuList);
		}
	}
	public function getCollection(){
		return SqlHelper::getCollectionByUser($this->userId);
	}
	public function getCollectionById($id){
		return	SqlHelper::getCollectionById($this->userId,$id);
	}
	public function getCollectionList(){
		return FileControl::getCollectionList($this->userId);
	}

	public function newCollectionList($name){
		sqlHelper::addCollectionList($this->userId,$name);
		return	FileControl::createCollectionList($this->userId,$name);

	}
	public function addCollectionItem($whichCollect,$itemId){
		FileControl::addCollectionItem($this->userId,$whichCollect,$itemId);
	}
	/*
	public function deleteCollectionItem($whichCollect,$itemId){
		if(!FileControl::inArray($itemId,FileControl::findCollectionByName($whichCollect))){
			return -1;
		}else{
			FileControl::delCollectionItem($this->userId,$whichCollect,$itemId);
		}
	}
	*/
	public function showCollection($whichCollect){
		return FileControl::showCollection($this->userId,$whichCollect);
	}
	public function deleteCollectionList($collect){
		sqlHelper::delCollectionList($this->userId,$name);
		FileControl::delCollectionList($userid,$collect);
	}
	public function admireHanfu($Hanfu){
		if(!FileControl::inArray($Hanfu->getHanfuId(),$this->fansList)){
			date_default_timezone_set('Asia/Shanghai');
			$now=date("Y-m-d H:i:s");
			$type="admire";
			$arr=array();
			array_push($arr,$Hanfu->getHanfuId());
			array_push($arr,$now);
			array_push($arr,$type);
			array_push($this->admireHanfuList,$arr);
			FileControl::saveUserAdmireHanfuById($this->userId,$this->admireHanfuList);			
		}else{
			
			FileControl::deleteAdmire($this->userId,$Hanfu->getHanfuId());
			
		}
		$Hanfu->setAdmire($this->userId);
	}
	
	public function delCollectHanfu($Hanfu){
		if(array_splice($this->collectHanfuList,array_search($Hanfu->getHanfuId(),$this->collectHanfuList),1))
			return true;
		else 
			return false;
		
	}
	
	public function setComment($toid,$content,$type,$hanfuid){
		date_default_timezone_set('Asia/Shanghai');
		$commentdate=date("Y-m-d H:i:s");
		SqlHelper::insertComment($this->userId,$toid,$hanfuid,$content,$type,$commentdate);
	}
	
	public function uploadHanfu($data){
		return	SqlHelper::InsertHanfu($this->userId,$data);
	}
	
	public function addAttentionPeople($user){
		if($user->id!=$this->userId){
			if(!FileControl::inArray($user->getuserId(),$this->attentionPeopleList)){
				date_default_timezone_set('Asia/Shanghai');
				$now=date("Y-m-d H:i:s");
				$arr=array();
				array_push($arr,$user->getUserId());
				array_push($arr,$now);
				array_push($this->attentionPeopleList,$arr);
				FileControl::saveUserAttentionPeoplesById($this->userId,$this->attentionPeopleList);	
				//$this->addUserInfo($this->userId,$this->admireHanfuList);		
			}else{
				//$list=fileControl::toBeNewArr($this->admireHanfuList);
				FileControl::delUserAttentionPeoplesById($this->userId,$user->getUserId());
				//$this->delUserInfo($this->userId,$hanfu->getHanfuId());
			}
		}
	}	
	public function addFans($user){
		if($user->id!=$this->userId){
			if(!FileControl::inArray($user->getuserId(),$this->fansList)){
				date_default_timezone_set('Asia/Shanghai');
				$now=date("Y-m-d H:i:s");
				$arr=array();
				array_push($arr,$user->getUserId());
				array_push($arr,$now);
				array_push($this->fansList,$arr);
				FileControl::saveUserFansById($this->userId,$this->fansList);		
			}else{
				FileControl::delUserFansById($this->userId,$user->getUserId());
			}
		}
		
	}
	public function isFans($userid){
		return FileControl::inArray($userid,$this->fansList);
	}
	public function isAttention($userid){
		return FileControl::inArray($userid,$this->attentionPeopleList);
	}
	public function addRecentNews($msg){
		$this->recentNewsList[$this->recentNewsNum % (self::newsLimit)]=$msg;
		$this->recentNewsNum++;
		$this->fileControl->saveUserRecentNewsById($this->userId,$this->recentNewsList,$this->recentNewsNum);
	}
	public function getDescribe(){
		return $this->describe;
	}
	public function reflashUserInfo(){
		$commentArr=SqlHelper::getCommentsByUserId($this->userId);
		$d=array_merge($commentArr,$this->admireHanfuList);
		FileControl::saveUserInfo($this->userId,$d);
	}
	public function rateHanfu($hanfuid,$data){
		//data=[5,4,3,2];
		//存入 userid，时间，data
		$markedPeopleList=FileControl::getMarkedPeopleList($hanfuid);
		if(!FileControl::inArray($this->userId,$markedPeopleList)){
			date_default_timezone_set('Asia/Shanghai');
			$now=date("Y-m-d H:i:s");
			$arr=array();
			$returnArr=array();
			array_push($arr,$this->userId);//userid
			array_push($arr,$now);//time
			array_push($arr,$data);//data
			array_push($markedPeopleList,$arr);
			FileControl::savemarkScore($this->userId,$hanfuid,$markedPeopleList);
			$returnArr["allRate"]=FileControl::caucalateTheSumOfRate($markedPeopleList);
			$returnArr["ratePeople"]=count($markedPeopleList);
			return json_encode($returnArr);
		}else{
			return -1;
		}	

	}
	public function getInfo(){
		$commentArr=SqlHelper::getCommentsByUserId($this->userId);
		$d=array_merge($commentArr,$this->admireHanfuList);
		return	$this->array_sort($d,1,desc);
	} 

	private function array_sort($arr,$keys,$type='asc'){ 
		$keysvalue = $new_array = array();
			foreach ($arr as $k=>$v){
				$keysvalue[$k] = $v[$keys];
			}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		$i=0;
		foreach ($keysvalue as $k=>$v){
			$new_array[$i] = $arr[$k];
			$i++;
			}
		return $new_array; 
		} 
}
?>