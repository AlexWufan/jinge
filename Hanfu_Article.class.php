<?php
	
	require_once 'Hanfu_SqlHelper.class.php';
	
	class Article
	{
		
		function __construct($row)
		{
			# code...
			$this->id=$row["id"];
			$this->userid=$row["userid"];
			$this->content=$row['content'];
			$this->title=$row['title'];
			$this->timer=$row['addTime'];	
		}
		function  __destruct(){
			unset($row);
		}
		public function getId(){
			return $this->id;
		}
		public function getUserId(){
			return $this->userid;
		}
		public function getContent(){
			return $this->content;
		}
		public function getTitle(){
			return $this->title;
		}
		public function getTime(){
			return $this->timer;
		}
		public function getAuthor(){
			return SqlHelper::getUserById($this->userid);
		}
	}
	
?>