<?
	session_start();
	require_once 'Hanfu_FileControl.class.php';
	require_once 'Hanfu_SqlHelper.class.php';
	//echo $_SESSION['userName'];
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$id=$user->getUserId();
	//echo "1";
	if(!is_dir("./user/".$id))
	        mkdir("./user/".$id);
	      //echo "teat";
	if($_FILES["file"]["size"] < 200000){
	  //echo "2";
	  if($_FILES["file"]["error"] > 0){
	  	//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	  }else{
	   //echo $_FILES["file"]["type"];
		if(($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg")){
			 // echo "x";
			  if(move_uploaded_file($_FILES["file"]["tmp_name"],
	      	"./user/".$id."/".$id.".jpg")){
	          header("Location:setting.php");    
	          //echo '4';        
	      }
	      else
	          die('fail4');
	    }else if($_FILES["file"]["type"] == "image/png"){
	    	if(move_uploaded_file($_FILES["file"]["tmp_name"],
	        "./user/".$id."/".$id.".jpg")){
	         header("Location:setting.php"); 
	      }
	      else
	         die('fail');
	    }else if($_FILES["file"]["type"] == "image/gif"){
	    	if(move_uploaded_file($_FILES["file"]["tmp_name"],
	        "./user/".$id."/".$id.".jpg")){
	        header("Location:setting.php");
	          } //
	      else
	        die('fail');
	    }else{
	      header("Location:setting.php");
	    	die('failx');
	    }
	  }
	}
?>