<?
	require_once 'Hanfu_SqlHelper.class.php';
	require_once 'Hanfu_FileControl.class.php';
	$pageid=$_GET['pageid'];
	$sessionid=$_GET['sessionid'];
	$user=SqlHelper::getUserById($sessionid);
	$people=SqlHelper::getUserById($pageid);
	$user->addAttentionPeople($people);
	$people->addFans($user);
	$num=count(FileControl::readUserFansById($people->getUserId()));
	echo $num;
?>	