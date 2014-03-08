<?
	session_start();
	require_once 'Hanfu_FileControl.class.php';
	require_once 'Hanfu_SqlHelper.class.php';
	$reason=$_POST['reason'];
	$user=$_SESSION['userName'];
	date_default_timezone_set('Asia/Shanghai');
	$now=date("U");
	if(!is_dir("./vin/"))
	        mkdir("./vin/",0777);
	

	if($_FILES["file"]["size"] < 200000){
	  if($_FILES["file"]["error"] > 0){

	  }else{
	 
		if(($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg")){
			
			  if(move_uploaded_file($_FILES["file"]["tmp_name"],
	      	"./vin/".$now.".jpg")){
	        	if(SqlHelper::addNewIndexItem($now,$reason,$user)){
	        	  header("Location:uploadComplete.php");    
	        	}
	      }
	      else
	          die('fail4');
	    }else if($_FILES["file"]["type"] == "image/png"){
	    	if(move_uploaded_file($_FILES["file"]["tmp_name"],
	        "./vin/".$now.".jpg")){
	        	if(SqlHelper::addNewIndexItem($now,$reason,$user)){
	        		 header("Location:uploadComplete.php"); 
	        	}
	      }
	      else
	         die('fail');
	    }else if($_FILES["file"]["type"] == "image/gif"){
	    	if(move_uploaded_file($_FILES["file"]["tmp_name"],
	        "./vin/".$now.".jpg")){
	        	if(SqlHelper::addNewIndexItem($now,$reason,$user)){
	        		header("Location:uploadComplete.php");
	        	}
	          } 
	      else
	        die('fail');
	    }else{
	     // header("Location:uploadComplete.php");
	    	die('failx');
	    }
	  }
	}
?>