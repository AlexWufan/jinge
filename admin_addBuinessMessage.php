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
      <li><a href="admin_updateIndex.php">编辑首页</a></li>
      <li ><a href="admin_manageIndex.php">首页管理</a></li>
      <li class='active'><a href="admin_addBuinessMessage.php">增加商家动态</a></li>
      <li><a href="admin_manageBuinessMessage.php">管理商家动态</a></li>
    </ul>
    </div>  
</nav>
<div class='container main'>
  <form action='uploadArticle.php' method='get' name='form1'>
  <div class='form-group'>
    <label class='control-label'>标题</label>
    <input type='text' class='form-control' name='title'>
  </div>
	<textarea id="editor_id" name="content" style="width:700px;height:300px;">
	</textarea>
  <hr>
  <button  id='uploadbuiness'class='btn btn-success'>
    提交
  </button>
</form>
</div>
<script charset="utf-8" src="./editor/kindeditor.js"></script>
<script charset="utf-8" src="./editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
</script>