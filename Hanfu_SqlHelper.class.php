<?php
	require_once 'Hanfu_User.class.php';
	require_once "Hanfu_Hanfu.class.php";	
	require_once 'Hanfu_Comment.class.php';
    require_once 'Hanfu_Photo.class.php';
    require_once 'Hanfu_Article.class.php';
	class SqlHelper{
		public static function getCollectionById($userid,$id){
			$sql="SELECT * from collectionlist where owner='$userid' and id='$id'";
			$result=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($result);
			return $row['title'];
		}
		public static function getCollectionByUser($userid){
			$sql="SELECT * FROM collectionlist where owner='$userid'";
			$result=SqlHelper::execute_sql($sql);
			$returnArr=array();
			while ($row=mysql_fetch_assoc($result)) {
				$tempArr=array();
				array_push($tempArr,$row['id']);
				array_push($tempArr,$row['title']);
				array_push($returnArr,$tempArr);
			}
			return $returnArr;
		}
		public static function registUser($userName,$password,$email){
			date_default_timezone_set('Asia/Shanghai');
			$intime=date("Y-m-d H:i:s");
			$sql="insert into user(name,password,email,intime) values('$userName','".md5($password).
			"','$email','$intime')";
			SqlHelper::execute_sql($sql);
		} 
		public static function insertHanfu($userid,$data){
			date_default_timezone_set('Asia/Shanghai');
			$addtime=date("Y-m-d H:i:s");
			if(!is_null($data['taobaoid'])){
						$sql="insert into hanfu(userid,name,addtime,admirenum,main_pic,type,imgs,taobaoid,link,comment) values ('$userid','".$data["title"]."','$addtime',0,'".$data["main_pic"]."','".$data["type"]."','".$data["imgs"]."','".$data["taobaoid"]."','".$data["link"]."','".$data["comment"]."')";			
			}else{				
				$sql="insert into hanfu(userid,name,addtime,admirenum,type,business,structure,other,color,element,sell,comment)
				values('$userid','".$data['name']."','$addtime',0,'".$data["type"]."','".$data["business"]."','".$data["structure"]."','".$data["other"]."','".$data["color"]."','".$data["element"]."','".$data["sell"]."','".$data["comment"]."')";
			}
			SqlHelper::execute_sql($sql);
			return SqlHelper::getTheLastInsert($addtime,$userid);
		}
		public static function deleteHanfu($id){
			$sql="DELETE from hanfu where id='$id'";
			SqlHelper::execute_sql($sql);
		}
		public static function deleteUser($id){
			$sql="DELETE from user where id='$id'";
			SqlHelper::execute_sql($sql);
		}
		public static function deleteComment($id){
			$sql="DELETE from comment where id='$id'";
			SqlHelper::execute_sql($sql);
		}
		public static function deleteOneDay($id){
			$sql="DELETE from oneDay where id='$id'";
			SqlHelper::execute_sql($sql);
		}
		public static function addNewIndexItem($now,$reason,$author){
			$sql="insert into oneDay(timer,reason,author) values ('$now','$reason','$author')";
			SqlHelper::execute_sql($sql) or die("error");
			return true;
		}
		public static function updateHanfu($key,$value,$id){
			$sql="UPDATE hanfu set $key='$value' where id ='$id'";
			SqlHelper::execute_sql($sql);
		}
		public static function subPageHanfu($index,$nums){
			$sql="SELECT * from hanfu order by addtime desc limit $index,$nums";
			$res=SqlHelper::execute_sql($sql);
			$arr=array();
			while($row=mysql_fetch_assoc($res)){
				array_push($arr,$row['id']);
			}
			SqlHelper::free_result($res);
			return $arr;
		}
		public static function subOneDay($index,$nums){
			$sql="SELECT * from oneDay order by timer desc limit $index,$nums";
			$res=SqlHelper::execute_sql($sql);
			$arr=array();
			while($row=mysql_fetch_assoc($res)){
				array_push($arr,$row['id']);
			}
			SqlHelper::free_result($res);
			return $arr;	
		}
		public static function getOneDayById($id){
			$sql="SELECT * from oneDay where id='$id'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			return new Photo($row);
		}
		public static function getOneDayNum(){
			$sql="SELECT count(*) as num from oneDay";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			return $row["num"];
		}
		public static function updateOneDay($key,$value,$id){
			$sql="UPDATE oneday $key='$value' where id ='$id'";
			SqlHelper::execute_sql($sql);
		}
		public static function updatePassword($userid,$password){
			$sql="UPDATE user set password=".md5($password)."where id='$userid'";
			SqlHelper::execute_sql($sql);
		}
		public static function insertComment($userid,$toid,$hanfuid,$usercomment,$type,$commentdate){
			$sql="insert into comment(userid,toid,comment,type,commentdate,hanfuid) values('$userid','$toid','$usercomment','$type','$commentdate','$hanfuid')";
			SqlHelper::execute_sql($sql);
		}
		public static function getCommentsByHanfuId($id){
			$sql="SELECT * from comment where hanfuid='$id'";
			$res=SqlHelper::execute_sql($sql);	
			$arr=array();
			while($row=mysql_fetch_array($res)){
				array_push($arr, $row['id']);
			}
			SqlHelper::free_result($res);
			return $arr;

		}
		public static function getHanfuCommentsNum($id){
			$sql="SELECT count(id) as max FROM comment where hanfuid='$id'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			return $row['max'];
		}
		public static function getCommentById($id){
			$sql="SELECT * from comment where id='$id'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			$comment=new Comment($row['id'],$row['userid'],$row['toid'],$row['comment'],$row['type'],$row['commentdate'],$row['hanfuid']);
			SqlHelper::free_result($res);
			return $comment;
		}

		public static function getComment(){
			$sql="SELECT * from comment";
			$res=SqlHelper::execute_sql($sql);
			$return=array();
			while($row=mysql_fetch_assoc($res)){
				array_push($return,$row['id']);
			}
			SqlHelper::free_result($res);
			return $return;
		}
		public static function getCommentsByToid($toid){
			$sql="select * from comment where toid='$toid'";
			$res=SqlHelper::execute_sql($sql);
			$return=array();
			while ($row=mysql_fetch_assoc($res)) {
				array_push($return, $row['id']);
			}
			SqlHelper::free_result($res);
			return $return ;
		}
		public static function getCommentsByUserId($userid){
			$sql="SELECT * FROM comment where userid='$userid'";
			$res=SqlHelper::execute_sql($sql);
			$return=array();
			while($row=mysql_fetch_assoc($res)){
				$arr=array();
				$arr[0]=$row['hanfuid'];
				$arr[1]=$row['commentdate'];
				$arr[2]="comment";
				array_push($return,$arr);
			}
			SqlHelper::free_result($res);
			return $return;
		}
		public static function getSubComment($oneDayId){
			$sql="SELECT * from comment where toid='$oneDayId' limit 3,5 ";
			$res=SqlHelper::execute_sql($sql);
			$return=array();
			while($row=mysql_fetch_assoc($res)){
				array_push($return,$row['id']);
			}
			SqlHelper::free_result($res);
			return $return;

		}
		public static function addCollectionList($userid,$title){
			$sql="insert into collectionlist (title,owner) values ('$title','$userid')";
			SqlHelper::execute_sql($sql);
		}
		public static function delCollectionList($userid,$title){
			$sql="delete from collectionlist where owner='$userid' and title='$title'";
			SqlHelper::execute_sql($sql);
		}
		public static function getAllUserId(){
			$sql="select * from user";
			$res=SqlHelper::execute_sql($sql);
			$return=array();
			while($row=mysql_fetch_assoc($res)){
				array_push($return,$row['id']);
			}
			SqlHelper::free_result($res);
			return $return;
		}
		public static function getUserById($id){
			$sql="select * from user where id='$id'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			$user=new User($row['id'],$row['name'],$row['password'],$row['email'],$row['intime'],$row['description']);
			SqlHelper::free_result($res);
			return $user;
		}

		public static function getUserByName($name){
			$sql="select * from user where name='$name'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			$user=new User($row['id'],$row['name'],$row['password'],$row['email'],$row['intime'],$row['description']);
			SqlHelper::free_result($res);
			return $user;
		}
		public static function getUserByEmail($email){
			$sql="select * from user where email='$email'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			$user=new User($row['id'],$row['name'],$row['password'],$row['email'],$row['intime'],$row['description']);
			SqlHelper::free_result($res);
			return $user;
		}
		public static function addArticle($userid,$title,$content,$now){
			$sql="insert into article (title,content,userid,addTime) values ('$title','$content','$userid','$now')";
			SqlHelper::execute_sql($sql);
		}
		public static function getArticle($index,$num){
			$sql="SELECT * from article limit $index,$num";
			$res=SqlHelper::execute_sql($sql);
			$return=array();
			while($row=mysql_fetch_assoc($res)){
				array_push($return, $row);
			}
			return $return;
		}
		public static function getArticleById($id){
			$sql="SELECT * from article where id ='$id'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			return new Article($row);
		}
		public static function getHanfuByTaobaoId($id){
			$sql="select * from hanfu where taobaoid='$id'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			$hanfu=new Hanfu($row);
			SqlHelper::free_result($res);
			return $hanfu;
		}
		public static function getAllHanfuId(){
			$sql="SELECT id from hanfu  order by id desc";
			$res=SqlHelper::execute_sql($sql);
			$return=array();
			while($row=mysql_fetch_assoc($res)){
				array_push($return, $row['id']);
			}
			return $return;
		}
		public static function getTheLastInsert($addtime,$userid){
			$sql="SELECT id from hanfu where addtime='$addtime' and userid='$userid'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_array($res);
			SqlHelper::free_result($res);
			return $row[0];
		}
		public static function getHanfuById($id){
			$sql="select * from hanfu where id='$id'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			$hanfu=new Hanfu($row);
			SqlHelper::free_result($res);
			return $hanfu;
		}
		public static function getHanfuNum(){
			$sql="SELECT count(*) as num from hanfu ";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_assoc($res);
			SqlHelper::free_result($res);
			return $row['num'];
		}
		public static function getUserIdByName($name){
			$sql="SELECT id from user where name='$name'";
			$res=SqlHelper::execute_sql($sql);
			$row=mysql_fetch_array($res);
			SqlHelper::free_result($res);
			return $row[0];
		}
		public static function updateDescribe($userid,$describe){
			$sql="UPDATE user set description='$describe' where id='$userid' ";
			SqlHelper::execute_sql($sql);
			//SqlHelper::free_result($res);
		}
		public static function execute_sql($sql){
			$username="root";
			$password="123456";
			$dbname="hanfu";
			$host="127.0.0.1";
			$conn=mysql_connect($host,$username,$password);
			if(!$conn){
				die("连接失败".mysql_error());
			}
			mysql_select_db($dbname);
			mysql_query("set names utf8");
			$res=mysql_query($sql);
			return $res;
		}
		
		private static function free_result($res){
			if(mysql_free_result($res)){
				return true;
			}else{
				return false;
			}
		}
	}
?>