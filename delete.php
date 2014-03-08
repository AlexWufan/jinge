<?
	require_once 'Hanfu_SqlHelper.class.php';
	$type=$_GET['type'];
	$id=$_GET['id'];
	switch ($type) {
		case 'user':
			SqlHelper::deleteUser($id);
			header("Location:admin.php");
			break;
		case 'hanfu':
			SqlHelper::deleteHanfu($id);
			header("Location:admin_hanfu.php");
			break;
		case 'comment':
			SqlHelper::deleteComment($id);
			header("Location:admin_comment.php");
			break;	
		case 'oneDay':
			SqlHelper::deleteOneDay($id);
			header("Location:admin_manageIndex.php");
			break;	
	}
?>