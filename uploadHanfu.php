<?
	session_start();
	if(is_null($_SESSION['userName'])){
		header("Location:404.html");
	}
	require_once 'Hanfu_SqlHelper.class.php';
	$data=array();
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$data["name"]=$_GET['name'];
	$data["business"]=$_GET['business'];
	$data["structure"]=$_GET['structure'];
	$data["other"]=$_GET['other'];
	$data["color"]=$_GET['color'];
	$data["element"]=$_GET['element'];
	$data['sell']=$_GET['sell'];
	$data["comment"]=$_GET['comment'];
	$data["type"]=$_GET['typeRadio'];

	$id=$user->uploadHanfu($data);
	
	if($id){
		header("Location:./SwfUpload/index.php?id=$id");
	}else{
		header("Location:404.html");
	}
?>