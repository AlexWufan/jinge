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
?>
<div class='container '>
	<div class='row'>
		<div class='col-md-8' >
			<?
				if($pageid==$sessionid){
			?>
			<h3>我的主页</h3>
			<ul class="nav nav-pills">
			  <li ><a href="user.php">我</a></li>
			  <li><a href="fans.php">粉丝</a></li>
			  <li><a href="attention.php">关注</a></li>
			  <li class="active"><a href='other.php'>别的动态</a><li>
			  <li><a href="backet.php">篮子</a></li>	
			</ul>
			<?
				}else{
			?>
			<h3>他的主页</h3>
			<?
				}
			?>
			<div class='lineHr'></div>
			<div id='userINFO' userid="<?echo $user->getUserId();?>"></div>
			<?
				$num=3;
				$hanfulist=$user->getInfo();
				for ($i=0;$i<$num;$i++) { 
					if($hanfulist[$i][0]==null)continue;
					$hanfu=SqlHelper::getHanfuById($hanfulist[$i][0]);
					$author=SqlHelper::getUserById($hanfu->getAuthorId());
					$time=$hanfulist[$i][1];
			?>
			<div class='user-item'>
				<p class='userinfo'>
					<?
						if($hanfulist[$i][2]=='comment'){
					?>
					<span class='glyphicon glyphicon-comment'> 评论了汉服</span>
					<?
						}else{
					?>
					<span class='glyphicon glyphicon-heart'> 喜欢了汉服</span>
					<?
						}
					?>
					<span class='time'><?echo $time;?></span>
				</p>
				<div class='hanfuinfo'>
					<div class='info-title'>
						<img src="<?echo $author->getPicture();?>">
						<a href="user.php?id=<?echo $author->getUserId();?>"><?echo $author->getUserName();?></a>的汉服<a href='show.php?id=<?echo $hanfu->getHanfuId();?>'><?echo $hanfu->getHanfuName();?></a>
					</div>				
					<div class='main-img'>
						<img src="<?echo $hanfu->getMain_pic();?>">
					</div>
					<div class='info-bottom'>
						<p><a href="#"></span>喜欢</a>·<a href='#'>加入篮子</a>·<a href="show.php?id=<?echo $hanfu->getHanfuId();?>#comment">回应</a></p>
					</div>
				</div>
				<div class='lineHr'></div>
			</div>
			<?
				}
			?>
			</div>
		<div class='col-md-4'>
			<div class='user' >
				<div class='message'>
					<img src="<?echo $user->getPicture();?>">

					<div class='usermessage' sessionid="<?echo $sessionid;?>" pageid="<?echo $pageid;?>">
						<span><?echo $user->getUserName();?></span>
						<?
							if($pageid!==$sessionid){
								if(!SqlHelper::getUserById($pageid)->isFans($sessionid)){
						?>
						<a class='button-like btn btn-primary'>关注</a>
						<?
								}else{ 
						?>
						<a class='button-like btn btn-default'>已关注</a>
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