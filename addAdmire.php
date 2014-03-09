<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	$username=$_SESSION['userName'];
	$id=$_GET['id'];
	$user=SqlHelper::getUserByName($username);
	if(!$username){
		echo "error";
	}else{
		if($_GET['type']){
			$oneDay=SqlHelper::getOneDayById($id);
			$user->admireHanfu($oneDay,"oneDay");
		}else{
			$hanfu=SqlHelper::getHanfuById($id);
			$user->admireHanfu($hanfu);
			echo $hanfu->getAdmireNum();
	
			}
		}
?>