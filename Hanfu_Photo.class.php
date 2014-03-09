<?php
require_once 'Hanfu_FileControl.class.php';
require_once 'Hanfu_SqlHelper.class.php';
require_once 'FriendlyTime.php';
class Photo{
		
		public function __construct($row){
			$this->author=$row['author'];
			$this->reason=$row['reason'];
			$this->time=$row['timer'];
			$this->id=$row['id'];
			$this->commentList=SqlHelper::getCommentsByToId($this->time);
			$this->admiresList=FileControl::readHanfuAdmiresById($this->time);
			$this->admireNum=count($this->admiresList);
		}
		public function __destruct(){
			unset($row);
		}	
		public function getAuthor(){
			return $this->author;
		}
		public function getTime(){
			return friendlyDate($this->time);
		}
		public function getReason(){
			return $this->reason;
		}
		public function getId(){
			return $this->id;
		}
		public function getTimeStamp(){
			return $this->time;
		}
		public function getImage(){
			return "./vin/".$this->time.".jpg";
		}
		public function getCommentList(){
			return $this->commentList;
		}
		public function setAdmire($userId){
			if(!FileControl::inArray($userId,$this->admiresList)){
				$arr=array();
				date_default_timezone_set('Asia/Shanghai');
				$now=date("Y-m-d H:i:s");
				array_push($arr,$userId);
				array_push($arr,$now);
				array_push($this->admiresList,$arr);
				$this->admireNum++;
				FileControl::saveHanfuAdmiresById($this->HanfuId,$this->admires);
			}else{
				$this->admireNum--;	
			}
				SqlHelper::updateOneDay('admireNum',$this->admireNum,$this->HanfuId);
		}
		public function getAdmireList(){
			return $this->admiresList;
		}
		public function getAdmireNum(){
			return $this->admireNum;
		}
	}
?>