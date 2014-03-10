<?
	include_once 'head.html';
	require_once 'Hanfu_FileControl.class.php';
	$sessionid=SqlHelper::getUserIdByName($_SESSION['userName']);
	if(!is_null($_GET['id'])){
		$pageid=$_GET['id'];	
	}else{
		$pageid=$sessionid;
	}
	$user=SqlHelper::getUserById($pageid);
?>
<div class='container '>
	<div class='row'>
		<div class='col-md-8' >
			<?
				if($pageid==$sessionid){
			?>
			<h3>我的主页</h3>
			<ul class="nav nav-pills">
			  <li ><a href="#">我</a></li>
			  <li><a href="fans.php">粉丝</a></li>
			  <li><a href="attention.php">关注</a></li>
			  <li><a href='other.php'>别的动态</a><li>
			  <li><a href="backet.php">篮子</a></li>	
			  <li class="active"><a href="photoGallery.php">相册</a></li>
			</ul>
			<?
				}else{
			?>
			<h3>他的主页</h3>
			<?
				}
			?>
			<div class='lineHr'></div>
			<?
			$ids=$user->getUploadHanfus();
			for($i=0;$i<count($ids);$i++){
				$src="./hanfu/".$ids[$i]."/img/";
				$arr=FileControl::readAllFile($src);
				for($j=0;$j<count($arr);$j++){
					echo "<img style='width:300px;height:300px' src=".$src.$arr[$j]."jpg>";
				}
			}
			?>
			</div>
		<div class='col-md-4'>
			<div class='user' >
				<div class='message'>
					<img src="<?echo $user->getPicture();?>">

					<div class='usermessage' >
						<span><?echo $user->getUserName();?></span>
						<?
							if($pageid!==$sessionid){
								if(!SqlHelper::getUserById($pageid)->isFans($sessionid)){
						?>
						<a class='button-like btn btn-primary' sessionid="<?echo $sessionid;?>" pageid="<?echo $pageid;?>">关注</a>
						<?
								}else{ 
						?>
						<a class='button-like btn btn-default' sessionid="<?echo $sessionid;?>" pageid="<?echo $pageid;?>">已关注</a>
						<?
							}
						}
						?>
						<span class='intime'><?echo $user->getIntime();?></span>
					</div>

				</div>	
				<div class='lineHr'></div>
				<div class='user-describe-show'><?echo $user->getDescribe();?></div>
				<div class='lineHr'></div>
				<div class='friendship'>
						<div class='row'>
							<div class='col-md-4'>
								<div class='text-center '>关注</div>
								<div class='text-center attention-div'><?echo $user->getAttentionPeopleNum();?></div>
							</div>
							<div class='col-md-4'>
								<div class='text-center'>粉丝</div>
								<div class='text-center fans-div'><?echo $user->getFansNum();?></div>
							</div>
							<div class='col-md-4'>
								<div class='text-center'>喜欢</div>
								<div class='text-center like-num'>喜欢数量</div>
							</div>
						</div>
				 </div>
			</div>
		</div>
	</div>
</div>	
<?
	include_once 'footer.html';
?>
<script type="text/javascript" src='js/user.js'></script>