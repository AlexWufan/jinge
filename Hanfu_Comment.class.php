<?php
	
	require_once 'Hanfu_SqlHelper.class.php';

	/**
	* type=0
	* 向某个人说话,toid=此评论的commentid；
	* type=other
	* toid=""
	* hanfuid=在某件汉服范围内
	* 
	*/
	class Comment
	{
		private $id;
		private $userid;
		private $toid;
		private $comment;
		private $type;
		private $commentdate;
		private $hanfuid;
		function __construct($id,$userid,$toid,$comment,$type,$commentdate,$hanfuid)
		{
			# code...
			$this->id=$id;
			$this->userid=$userid;
			$this->toid=$toid;
			$this->comment=$comment;
			$this->type=$type;
			$this->commentdate=$commentdate;
			$this->hanfuid=$hanfuid;
		}
		function  __destruct(){
			unset($id);
			unset($userid);
			unset($toid);
			unset($comment);
			unset($type);
			unset($commentdate);
			unset($hanfuid);
		}
		public function getCommentId(){
			return $this->id;
		}

		public function getCommentUserId(){
			return $this->userid;
		}
		public function getToId(){
			return $this->toid;
		}
		public function getComment(){
			return $this->comment;
		}
		public function getType(){
			return $this->type;
		}
		public function getCommentDate(){
			return $this->commentdate;
		}
		public function getHanfuId(){
			$this->hanfuid;
		}
	}
	
?>