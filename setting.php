<?
	include_once 'head.html';
	include_once 'Hanfu_SqlHelper.class.php';
	$user=SqlHelper::getUserByName($_SESSION['userName']);

?>
	<div class='container main'>
		<div class='row'>
			<ul class="nav nav-tabs" id='myTab'>
			  <li class='active'><a href="#common" data-toggle="tab">账号设置</a></li>
			  <li><a href="#password" data-toggle="tab">密码</a></li>
			  <li><a href="#other" data-toggle="tab">other</a></li>
			  <li><a href="#more" data-toggle="tab">more</a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane fade in active" id="common">
			  	<div class='table-common text-center'>
			  		<div class='updateImg'>
			  			<form action='uploadImg.php' name='imgUp' method='post' enctype="multipart/form-data">
			  				<input type='file' accept='image/*'onchange='openupload()' name='file' style='display:none'id='f_file'>
			  				<img id='faceimg'src="<?echo $user->getPicture();?>" onclick='f_file.click()'>
			  			</form>
			  		</div>
			  		<div class='updateDescribe'>
			  			<h4><?echo $user->getUserName();?></h4>
			  			<!--<form method='get' >
			  			<input  type='text' value=<?echo $user->getDescribe();?>>
			  			</form>-->
			  			<p class='show-des'>个人简介：<span class='main-des'><?echo $user->getDescribe();?></span><span class='edit-des glyphicon glyphicon-pencil'></span></p>
			  		</div>
			  	</div>
			  </div>
			  <div class="tab-pane fade" id="password">
			  	<h4>重置密码</h4>
			  	<form class="form-horizontal" role="form" name="modifyPwd" action='modifyPassword.php' method='post'>
				  <div class="form-group">
				    <label for="passwordold" class="col-sm-2 control-label">旧密码：</label>
				    <div class="col-sm-10">
				      <input type="password" name='passwordold'class="form-control" id="Password1" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="passwordnew" class="col-sm-2 control-label">新密码：</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control"name='passwordnew' id="Password2" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="passwordnewrep" class="col-sm-2 control-label">重复输入：</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" name='passwordnewrep' id="Password3" placeholder="Password">
				    </div>
				  </div>
				  
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" id='modifyPassword'class="btn btn-default">修改</button>
				    </div>
				  </div>
				  <div id="xDiv"></div>
				</form>
			  </div>
			  <div class="tab-pane fade" id="other">...</div>
			  <div class="tab-pane fade" id="more">...</div>
			</div>
		</div>		
	</div>
<?
	include_once 'footer.html';
?>
<script type="text/javascript">
	setting();
	
</script>
