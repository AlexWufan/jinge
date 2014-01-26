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
      <li class="active"><a href="admin_hanfu.php">汉服</a></li>
    </ul>
    </div>  
</nav>
<div class='container'>
<table class='table'>
	<tbody class='table-striped'>
		<tr><td>汉服</td><td>作者</td><td>功能</td><td>删除</td></tr>
	</tbody>
	<?
		$idArr=SqlHelper::getAllHanfuId();
		for($i=0;$i<count($idArr);$i++){
			$hanfu=SqlHelper::getHanfuById($idArr[$i]);
			echo "<tr><td><a href=show.php?id=".$hanfu->getHanfuId()." class='btn btn-link'>".$hanfu->getHanfuName()."</a></td><td><a href=user.php?id=".$hanfu->getAuthorId().">".SqlHelper::getUserById($hanfu->getAuthorId())->getUserName()."</a></td><td></td><td><a href=delete.php?type=hanfu&id=".$hanfu->getHanfuId().">删除</a></td></tr>";
		}
	?>
</table>
</div>