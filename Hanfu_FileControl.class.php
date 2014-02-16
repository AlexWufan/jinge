<?php
	class FileControl{
		private static $filepath=".";
		
		public static function saveHanfuMembersById($id,$members){
			if(!is_dir(FileControl::$filepath."/hanfu/".$id))
				mkdir(FileControl::$filepath."/hanfu/".$id,0777);
			$handle=fopen(FileControl::$filepath."/hanfu/".$id."/".$id.".mem","w+b");
			$str=serialize($members);
			fwrite($handle,$str);
			fclose($handle);
		}
		
		public static function saveUserPic($id,$picname){
			if(!is_dir(FileControl::$filepath."/user/".$id))
				mkdir(FileControl::$filepath."/user/".$id);
			move_uploaded_file($picname,FileControl::$filepath."/user/$id/$id.jpg");
		}

		
		public static function saveHanfuAdmiresById($id,$admires){
			if(!is_dir(FileControl::$filepath."/hanfu/".$id))
				mkdir(FileControl::$filepath."/hanfu/".$id);
			$handle=fopen(FileControl::$filepath."/hanfu/".$id."/".$id.".adm","w+b");
			$str=serialize($admires);
			fwrite($handle,$str);
			fclose($handle);
		}
		
		public static function saveUserCollectHanfuById($id,$collectHanfuList){
			if(!is_dir(FileControl::$filepath."/user/".$id))
				mkdir(FileControl::$filepath."/user/".$id);
			$handle=fopen(FileControl::$filepath."/user/".$id."/".$id.".cf","w+b");
			$strCollect=serialize($collectHanfuList);
			fwrite($handle,$strCollect);
			fclose($handle);
		}
		
		public static function saveUserAdmireHanfuById($id,$admireHanfuList){
			if(!is_dir(FileControl::$filepath."/user/".$id))
				mkdir(FileControl::$filepath."/user/".$id);
			$handle=fopen(FileControl::$filepath."/user/".$id."/".$id.".adm","w+b");
			$strAdmire=serialize($admireHanfuList);
			fwrite($handle,$strAdmire);
			fclose($handle);
		}
		
		public static function saveUserFansById($id,$fans){
			if(!is_dir(FileControl::$filepath."/user/".$id))
				mkdir(FileControl::$filepath."/user/".$id);
			$handle=fopen(FileControl::$filepath."/user/".$id."/".$id.".fans","w+b");
			$strFans=serialize($fans);
			fwrite($handle,$strFans);
			fclose($handle);
		}
		
		public static function saveUserAttentionPeoplesById($id,$attentionPeoples){
			if(!is_dir(FileControl::$filepath."/user/".$id))
				mkdir(FileControl::$filepath."/user/".$id);
			$handle=fopen(FileControl::$filepath."/user/".$id."/".$id.".ap","w+b");
			$strAttentionPeoples=serialize($attentionPeoples);
			fwrite($handle,$strAttentionPeoples);
			fclose($handle);
		}
		
		public static function saveUserRecentNewsById($id,$recentNewsList,$recentNewsNum){
			if(!is_dir(FileControl::$filepath."/user/".$id))
				mkdir(FileControl::$filepath."/user/".$id);
			$handle=fopen(FileControl::$filepath."user/".$id."/".$id.".rn","w+b");
			$strRecentNews=serialize($recentNewsList).','.$recentNewsNum;
			fwrite($handle,$strRecentNews);
			fclose($handle);
		}
		public static function saveCollection($arr,$userid,$collection){
			$handle=fopen(FileControl::$filepath."/user/$userid/collection/$collection.cl","w+b");
			$str=serialize($arr);
			fwrite($handle, $str);
			//print_r($arr);
			fclose($handle);
		}
		public static function readHanfuMembersById($id){
			if(FileControl::isExists(FileControl::$filepath."/hanfu/$id/$id.mem")){
				$handle=fopen(FileControl::$filepath."/hanfu/$id/$id.mem","rb");
				$str=fread($handle,filesize(FileControl::$filepath."/hanfu/".$id."/".$id.".mem"));
				$members=unserialize($str);
				fclose($handle);
				return $members;
			}else
				return array();
		}
		
		public static function readHanfuAdmiresById($id){
			if(FileControl::isExists(FileControl::$filepath."/hanfu/$id/$id.adm")){
				$handle=fopen(FileControl::$filepath."/hanfu/$id/$id.adm","rb");
				$str=fread($handle,filesize(FileControl::$filepath."/hanfu/".$id."/".$id.".adm"));
				$admires=unserialize($str);
				fclose($handle);
				return $admires;
			}else
				return array();
		}
		
		public static function readUserCollectById($id){
			if(FileControl::isExists(FileControl::$filepath."/user/$id/$id.cf")){
				$handle=fopen(FileControl::$filepath."/user/$id/$id.cf","rb");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$id/$id.cf"));
				$collect=unserialize($str);
				fclose($handle);
				return $collect;
			}else
				return array();
		}

		public static function readUserAdmireById($id){
			if(FileControl::isExists(FileControl::$filepath."/user/$id/$id.adm")){
				$handle=fopen(FileControl::$filepath."/user/$id/$id.adm","rb");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$id/$id.adm"));
				$admires=unserialize($str);
				fclose($handle);
				return $admires;
			}else 
				return array();
		}
		
		public static function readUserFansById($id){
			if(FileControl::isExists(FileControl::$filepath."/user/$id/$id.fans")){
				$handle=fopen(FileControl::$filepath."/user/$id/$id.fans","rb");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$id/$id.fans"));
				$fans=unserialize($str);
				fclose($handle);
				return $fans;
			}else
				return array();
		}
		public static function readUserAttentionPeoplesById($id){
			if(FileControl::isExists(FileControl::$filepath."/user/$id/$id.ap")){
				$handle=fopen(FileControl::$filepath."/user/$id/$id.ap","rb");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$id/$id.ap"));
				$fans=unserialize($str);
				fclose($handle);
				return $fans;
			}else
				return array();
		}
		public static function readUserPic($id){
			if(FileControl::isExists(FileControl::$filepath."/user/$id/$id.jpg")){
				return "user/$id/$id.jpg";
			}else{	
				return "img/default.jpg";
			}
		}


		public static function readUserRecentNewsById($id){
			if(FileControl::isExists(FileControl::$filepath."/user/$id/$id.rn")){
				$handle=fopen(FileControl::$filepath."/user/$id/$id.rn","rb");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$id/$id.rn"));
				$recentNews=split(",",$str);
				$recentNews[0]=unserialize($recentNews[0]);
				return $recentNews;
			}else
				return array();
		}
		
		public static function getPicturesByHanfuId($id){
			$path="hanfu/$id/";
			if(FileControl::isExists($path)){
				$fileList=array();
				if(false!=($handle=opendir($path))){
					while(false!=($file=readdir($handle))){
						if($file!='.' && $file!='..')
							array_push($fileList,$path.$file);
					}
					return $fileList;
				}else
					return "open dir error";
			}	
		}
		public static function showCollection($userid,$title){
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/collection/$title.cl")){
				$handle=fopen(FileControl::$filepath."/user/$userid/collection/$title.cl", "r+");
				//print_r(filesize(FileControl::$filepath."/user/$userid/collection/$title.cl"));
				if(filesize(FileControl::$filepath."/user/$userid/collection/$title.cl")>0){
					$str=fread($handle, filesize(FileControl::$filepath."/user/$userid/collection/$title.cl"));
					$arr=unserialize($str);
					fclose($handle);
					return $arr;
				}else{
					return array();
				}
				
			}
		}
		public static function delUserAttentionPeoplesById($userid,$peopleid){
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/$userid.ap")){
				$handle=fopen(FileControl::$filepath."/user/$userid/$userid.ap", "r+");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$userid/$userid.ap"));
				$admires=split(",", $str);
				fclose($handle);
				$admires=unserialize($admires[0]);
				$newAdmires=FileControl::arrayRemove($admires,$peopleid);
				//print_r($newAdmires);
				FileControl::saveUserAttentionPeoplesById($userid,$newAdmires);
				//return $newAdmires;
			}	

		}
		public static function delUserFansById($userid,$peopleid){
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/$userid.fans")){
				$handle=fopen(FileControl::$filepath."/user/$userid/$userid.fans", "r+");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$userid/$userid.fans"));
				$admires=split(",", $str);
				fclose($handle);
				$admires=unserialize($admires[0]);
				$newAdmires=FileControl::arrayRemove($admires,$peopleid);
				//print_r($newAdmires);
				FileControl::saveUserFansById($userid,$newAdmires);
				//return $newAdmires;
			}	

		}
		public static function delCollectionList($userid,$collection){
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/collection/$collection.cl")){
				unlink(FileControl::$filepath."/user/$userid/collection/$collection.cl");
			}
		}
		public static function deleteAdmire($userid,$hanfuid){
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/$userid.adm")&&FileControl::isExists(FileControl::$filepath."/hanfu/$hanfuid/$hanfuid.adm")){
				$handle=fopen(FileControl::$filepath."/user/$userid/$userid.adm", "r+");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$userid/$userid.adm"));
				$admires=split(",", $str);
				fclose($handle);
				$admires=unserialize($admires[0]);
				$newAdmires=FileControl::arrayRemove($admires,$hanfuid);
				FileControl::saveUserAdmireHanfuById($userid,$newAdmires);
				$handle=fopen(FileControl::$filepath."/hanfu/$hanfuid/$hanfuid.adm", "r+");
				$str=fread($handle, filesize(FileControl::$filepath."/hanfu/$hanfuid/$hanfuid.adm"));
				$admires=split(",", $str);
				fclose($handle);
				$admires=unserialize($admires[0]);
				$newAdmires=FileControl::arrayRemove($admires,$userid);
				FileControl::saveHanfuAdmiresById($hanfuid,$newAdmires);
			}	
		}
		public static function createCollectionList($userid,$title){
			if(!is_dir(FileControl::$filepath."/user/$userid/collection/"))
				mkdir(FileControl::$filepath."/user/$userid/collection/");
			$handle=fopen(FileControl::$filepath."/user/$userid/collection/$title.cl","w+");
			fclose($handle);
			return true;
		}
		public static function addCollectionItem($userid,$collection,$itemid){
			$arr=array();
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/collection/$collection.cl")){
				if(filesize(FileControl::$filepath."/user/$userid/collection/$collection.cl")==0){
					$temparr=array();
					array_push($temparr, $itemid);
					array_push($temparr, FileControl::now());
					array_push($arr, $temparr);
					FileControl::saveCollection($arr,$userid,$collection);
				}else{
					//print_r("in");
					$handle=fopen(FileControl::$filepath."/user/$userid/collection/$collection.cl","r+");
					$str=fread($handle, filesize(FileControl::$filepath."/user/$userid/collection/$collection.cl"));
					$arr=unserialize($str);
					fclose($handle);
					//print_r($arr);
					if(FileControl::inArray($itemid, $arr)){
						FileControl::deleteCollectionItem($userid,$collection,$itemid);
					}else{
						$temparr=array();
						array_push($temparr, $itemid);
						array_push($temparr, FileControl::now());
						array_push($arr, $temparr);
						FileControl::saveCollection($arr,$userid,$collection);
					}

				}
				
			}
		}
		public static function findCollectionByName($userid,$collection){
			//print_r(FileControl::$filepath."/user/$userid/collection/$collection.cl");
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/collection/$collection.cl")){
				//print_r(filesize(FileControl::$filepath."/user/$userid/collection/$collection.cl"));
				$handle=fopen(FileControl::$filepath."/user/$userid/collection/$collection.cl", "r+");
				if(filesize(FileControl::$filepath."/user/$userid/collection/$collection.cl")>0){
					$str=fread($handle, filesize(FileControl::$filepath."/user/$userid/collection/$collection.cl"));
					$arr=unserialize($str);
					return $arr;
				}else{
					return array();
				}
			}else{
				return array();
			}
		}
		public static function deleteCollectionItem($userid,$collection,$itemid){
			if(FileControl::isExists(FileControl::$filepath."/user/$userid/collection/$collection.cl")){
				$handle=fopen(FileControl::$filepath."/user/$userid/collection/$collection.cl", "r+");
				$str=fread($handle,filesize(FileControl::$filepath."/user/$userid/collection/$collection.cl"));
				fclose($handle);
				$Temp=unserialize($str);
				$newTemp=FileControl::arrayRemove($Temp,$itemid);
				//print_r($newTemp);
				FileControl::saveCollection($newTemp,$userid,$collection);
				
			}
		}
		public static function readAllFile($url){
			$files=array();
			if($handle=opendir($url)){
				while (false !== ($file =readdir($handle))) {
					if($file=='.'||$file=="..")
						continue;
					//echo $file;
					//if(is_file($file)){
						//echo $file;
						$file=substr($file,0,-3);
						array_push($files, $file);
					//}
				}
				closedir($handle);
			}else{
				mkdir($url,0777);
			}
			return $files;
		}
		public static function getCollectionList($userid){
			$url=FileControl::$filepath."/user/$userid/collection/";
			//echo $url;
			$arr=FileControl::readAllFile($url);
			//print_r($arr);
			return $arr;
		}
		public static function isExists($path){
			if(file_exists($path))
				return true;
			else
				return false;
		}
		public static function inArray($var,$array){
			for($i=0;$i<count($array);$i++){
				if($var==$array[$i][0])
					return true;
			}
			return false;
		}
		public static function inArrayReturnKey($array,$var){
			for($i=0;$i<count($array);$i++){
				if($var==$array[$i][0])
					return $i+1;
			}
			return false;
		}
		public static function toBeNewArr($array){
			$returnArr=array();
			for($i=0;$i<count($array);$i++){
				$returnArr[$i]=$array[$i][0];
			}
			return $returnArr;
		}
		public static function arrayRemove($arr,$id) 
		{ 	
			$index=FileControl::inArrayReturnKey($arr,$id);
			if($index){
				$index=$index-1;
				array_splice($arr, $index, 1); 
			}
			return $arr;
		}	
		public static function array_offset($arr,$id){
			for($i=0;$i<count($arr);$i++){
				if($arr[$i]==$id)
				return $i;	
			}
		}
		public static function now(){
				date_default_timezone_set('Asia/Shanghai');
				$now=date("Y-m-d H:i:s");
				return $now;
		}
		public static function countAdmire($arr){
			//for ($i=0; $i <count() ; $i++) {
				# code...
			//}
		} 
	}
?>