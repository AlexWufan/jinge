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
		
	    function __construct($row){
			$this->HanfuId=$row['id'];
			$this->authorId=$row['userid'];
			$this->HanfuName=$row['name'];
			$this->admires=FileControl::readHanfuAdmiresById($this->HanfuId);
			$this->admireNum=count($this->admires);
			$this->main_pic=$row['main_pic'];
			$this->type=$row['type'];
			$this->imgs=$row['imgs'];
			$this->link=$row['link'];
			$this->comment=$row['comment'];
			$this->business=$row['business'];
			$this->structure=$row['structure'];
			$this->other=$row['other'];
			$this->color=$row['color'];
			$this->element=$row['element'];
			$this->sell=$row['sell'];
			$this->commentNum=SqlHelper::getHanfuCommentsNum($this->HanfuId);
		}
		function __destruct(){
			unset($row);

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
			if($this->main_pic)
				return $this->main_pic;
			else{
				$files=glob("hanfu/".$this->HanfuId."/img/*.jpg");
				return $files[0];
			}
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
				case 'find':
					$return='寻找';
					break;	
			}
			return $return;
		}
		public function getImgs(){
			$returnArr=array();
			if($this->imgs){
				$arr=explode(',',$this->imgs);
				for($i=0,$max=count($arr);$i<$max;$i++){
					array_push($returnArr, $arr[$i]);
				}
			}else{
				$returnArr=glob("hanfu/".$this->HanfuId."/img/*.jpg");
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
		public function getBusiness(){
			return $this->business;
		}
		public function getStructure(){
			return $this->structure;
		}
		public function getOther(){
			return $this->other;
		}
		public function getColor(){
			return $this->color;
		}
		public function getElement(){
			return $this->element;
		}
		public function getSell(){
			return $this->sell;
		}
	}
?>