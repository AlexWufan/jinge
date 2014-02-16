<?php
	require_once 'Hanfu_FileControl.class.php';
	require_once 'Hanfu_SqlHelper.class.php';
	
	class Hanfu{
		private $HanfuId;
		private $authorId;
		private $HanfuName;
		private $pictures;
		private $members;
		private $memberNum; 
		private $admires;
		private $admireNum;
		private $main_pic;
		private $type;
		private $imgs;
		private $link;
		private $comment;
		
	    function __construct($HanfuId,$authorId,$HanfuName,$main_pic,$type,$imgs,$link,$comment){
			$this->HanfuId=$HanfuId;
			$this->authorId=$authorId;
			$this->HanfuName=$HanfuName;
			//$this->members=FileControl::readHanfuMembersById($this->HanfuId);
			$this->admires=FileControl::readHanfuAdmiresById($this->HanfuId);
			//$this->memberNum=count($this->members);
			$this->admireNum=count($this->admires);
			$this->main_pic=$main_pic;
			$this->type=$type;
			$this->imgs=$imgs;
			$this->link=$link;
			$this->comment=$comment;
			$this->commentNum=SqlHelper::getHanfuCommentsNum($this->HanfuId);
		}
		function __destruct(){
			unset($HanfuId);
			unset($authorId);
			unset($HanfuName);
			unset($main_pic);
			unset($type);
			unset($imgs);
			unset($link);
			unset($comment);
		}
		public function getHanfuId(){
			return $this->HanfuId;
		}
		
		public function getAuthorId(){
			return $this->authorId;
		}
		
		public function getHanfuName(){
			return $this->HanfuName;
		}
		public function getMain_pic(){
			return $this->main_pic;
		}
		public function getType(){
			switch ($this->type) {
				case 'want':
					# code...
					$return='想要';
					break;
				case 'have':
				    $return='拥有';
				    break; 
				case 'shar':
					$return='推荐';
					# code...
					break;
			}
			return $return;
		}
		public function getImgs(){
			$returnArr=array();
			$arr=explode(',',$this->imgs);
			for($i=0,$max=count($arr);$i<$max;$i++){
				array_push($returnArr, $arr[$i]);
			}
			return $returnArr;
		}
		public function getLink(){
			return $this->link;
		}
		public function getComment(){
			return $this->comment;
		}
		public function getOtherComment(){
			return SqlHelper::getCommentsByHanfuId($this->HanfuId);
		}
		public function setAdmire($userId){
			if(!FileControl::inArray($userId,$this->admires)){
				$arr=array();
				date_default_timezone_set('Asia/Shanghai');
				$now=date("Y-m-d H:i:s");
				array_push($arr,$userId);
				array_push($arr,$now);
				array_push($this->admires,$arr);
				$this->admireNum++;
				FileControl::saveHanfuAdmiresById($this->HanfuId,$this->admires);
			}else{
				//FileControl::admire_array_remove($this->admires,$userId);
				$this->admireNum--;	
			}
				SqlHelper::updateHanfu('admirenum',$this->admireNum,$this->HanfuId);

		}
		public function getAdmires(){
			return $this->admires;
		}
		public function getAdmireNum(){
			return $this->admireNum;
		}
		public function getCommentNum(){
			return $this->commentNum;
		}
	}
?>