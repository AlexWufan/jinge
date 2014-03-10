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
			$this->admiresList=FileControl::read_file("oneDay",$this->id,"adm");
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
			
		}
		public function getAdmireList(){
			return $this->admiresList;
		}
		public function getAdmireNum(){
			return $this->admireNum;
		}
		public function getList($type){
			switch ($type) {
				case 'admire':
					return $this->admiresList;
					break;
				
				default:
					# code...
					break;
			}
		}
	}
?>