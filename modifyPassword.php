<?
	require_once 'head.html';
	require_once 'Hanfu_SqlHelper.class.php';
	$user=SqlHelper::getUserByName($_SESSION['userName']);
	$pwd=$_POST['passwordold'];
	$pwdnew=$_POST['passwordnew'];
	if(md5($pwd)==$user->getPassword()){
		$user->updatePassword($pwdnew);
		echo "密码修改成功，点此<a href='index.php'>返回</a>";
	}else{
		echo "密码输入错误，请<a href='setting.php'>重试</a>";
	}
	require_once 'footer.html';
?>