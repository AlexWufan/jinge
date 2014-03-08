<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	if($_SESSION['userName']!=="admin"){
		header("Location:index.php");
	}
?>
<!doctype html>
<html>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width,initial-scale=1.0'>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<body  style='padding-top:0;background-color:#e3e3e3'>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="navbar-header">
    <a class="navbar-brand" href="#">锦歌事务管理系统</a>
  </div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li ><a href="admin.php">用户</a></li>
      <li ><a href="admin_hanfu.php">汉服</a></li>
      <li ><a href="admin_comment.php">评论</a></li>
      <li class='active'><a href="admin_updateIndex.php">编辑首页</a></li>
      <li ><a href="admin_manageIndex.php">首页管理</a></li>
    </ul>
    </div>  
</nav>
<div class='container'>
	<form action='uploadShare.php' method='post' enctype="multipart/form-data">
		<div class='form-group'>
			<label class='control-label'>上传理由：</label>
			<input class="form-control" name='reason'type='text'>
		</div>
		<div class='form-group'>
			<label class='control-label'>主图：</label>
			<input class='form-contorl' name='file' type='file'>
		</div>
		<button type='submit' class='btn btn-success'>确认</button>
	</form>
</div>