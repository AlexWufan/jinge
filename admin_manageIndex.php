<?
	session_start();
	require_once 'Hanfu_SqlHelper.class.php';
	if($_SESSION['userName']!=="admin"){
		header("Location:index.php");
	}
	$index=0;
	$num=9;
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
      <li ><a href="admin_updateIndex.php">编辑首页</a></li>
      <li class='active'><a href="admin_manageIndex.php">首页管理</a></li>
      <li ><a href="admin_addBuinessMessage.php">增加商家动态</a></li>
      <li><a href="admin_manageBuinessMessage.php">管理商家动态</a></li>
      
    </ul>
    </div>  
</nav>
<div class='container'>
	<table class='table'>
	<tbody class='table-striped'>
		<tr><td>图片</td><td>理由</td><td>删除</td></tr>
	</tbody>
	<?
	$oneDayArr=SqlHelper::subOneDay($index,$num);
		for($i=0;$i<count($oneDayArr);$i++){
			$oneDay=SqlHelper::getOneDayById($oneDayArr[$i]);
			echo "<tr><td><img style='width:80px;height:80px' class='img-thumbnail' src=".$oneDay->getImage().">"."</td><td>".$oneDay->getReason()."</td><td><a href=delete.php?type=oneDay&id=".$oneDay->getId().">删除</a></td></tr>";
		}
	?>
</table>
</div>