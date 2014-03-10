<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$data=$_GET['data'];
	$hanfuid=$_GET['hanfuid'];
	$returnObj=$user->rateHanfu($hanfuid,$data);
	if(!is_null($returnObj)){
		echo $returnObj;	
	}else{
		echo -1;
	}
?>