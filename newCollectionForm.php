<?
	include_once 'head.html';
	include_once 'Hanfu_SqlHelper.class.php';
	$sessionid=SqlHelper::getUserIdByName($_SESSION['userName']);
	if(!is_null($_GET['id'])){
		$pageid=$_GET['id'];	
	}else{
		$pageid=$sessionid;
	}
	$user=SqlHelper::getUserById($pageid);
	if($_GET['backetid']){
		$backet=SqlHelper::getCollectionById($user->getUserId(),$_GET['backetid']);
	}
?>
<div class='container '>
	<div class='row'>
		<form action='addCollectionList.php'>
			篮子
			<input type='text' name='title' />
			<input type='hidden' name='flag' value='flag'/>
			<button class='btn btn-info'>提交</button>
		</form>
	</div>
</div>	
<?
	include_once 'footer.html';
?>
<script type="text/javascript" src='js/user.js'></script>