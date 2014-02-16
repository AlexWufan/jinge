<?
require_once 'head.html';
?>
<div class='container entryForm'>
	<div class='row'>
		<div class='col-md-6 col-md-offset-3'>
			<form role="form" action='entry.php' method='post'>
			  <div class="form-group">
			    <label for="userName">账号</label>
			    <input type="text" class="form-control" placeholder="请输入email或者邮箱地址来登录">
			  </div>
			  <div class="form-group">
			    <label for="password">密码</label>
			    <input type="password" class="form-control" placeholder="密码">
			  </div>
			  <button type="submit" class="btn btn-info">登录</button>
			</form>
		</div>
	</div>

</div>

<?
require_once 'footer.html';
?>