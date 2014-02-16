<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	$username=$_SESSION['userName'];
	if(!$username){
		echo "error";
	}else{
		$id=$_GET['id'];
		$user=SqlHelper::getUserByName($username);
		$hanfu=SqlHelper::getHanfuById($id);
		$user->admireHanfu($hanfu);
		echo $hanfu->getAdmireNum();
	}
	
?>