<?
  include_once 'head.html';
  include_once 'Hanfu_SqlHelper.class.php';
  $username=$_SESSION['userName'];
  $user=SqlHelper::getUserByName($username);
  $index=0;
  $num=9;
  $hanfuIdArr=SqlHelper::subPageHanfu($index,$num);
  $hanfuNum=SqlHelper::getHanfuNum();
?>
  <div class='container '>	
	<div id='waterfall' data-hanfunum="<?echo $hanfuNum;?>">
    <?
    for ($i=0; $i < count($hanfuIdArr); $i++) { 
      # code...
      $hanfu=SqlHelper::getHanfuById($hanfuIdArr[$i]);
      $author=SqlHelper::getUserById($hanfu->getAuthorId());
    ?>
  	<div class='indexitem'>
      <div class='vin'>
  		<a href="show.php?id=<?echo $hanfu->getHanfuId();?>"><img src="<?echo $hanfu->getMain_pic();?>"/></a>
              <div class="title notchosen">
              	<a href="show.php?id=<?echo $hanfu->getHanfuId();?>"><?echo $hanfu->getHanfuName();?></a>
              </div>
       </div>
       <div class="caption">
              <div class='information'>
                <img src="<?echo $author->getPicture();?>">
                <span class='author'><a href="user.php?id=<?echo $author->getUserId();?>"><?echo $author->getUserName();?></a></span><span><?echo $hanfu->getType();?></span>

                <span showid="<?echo $hanfu->getHanfuId();?>"class='admire-button like '>
                
                   <?
                    if(FileControl::inArray($hanfu->getHanfuId(),$user->getAdmireHanfuList())){

                  ?>
                  <span class='glyphicon glyphicon-heart color-red'></span>
                  <?
                    }else{

                  ?>
                  <span class='glyphicon glyphicon-heart'></span>
                  <?
                     }
                  ?>
                </span>
                <span class='glyphicon glyphicon-inbox'></span>

                <p class='description'>
                  「<?
                  //echo $hanfu->getComment();
                    $len=60;
                    $commentStr=$hanfu->getComment();
                    echo strlen($commentStr)<=18 ? $commentStr : (mb_substr($commentStr,0,$len,'UTF-8').chr(0)."...");                  
                  ?>」
                </p>

              </div>
              <div class='userlike'>
              <a href="#"class='likeshow'>
                <span class="glyphicon glyphicon-heart"></span> <span class='like-num'><?echo $hanfu->getAdmireNum();?></span></a>
              <a href="show.php?id=<?echo $hanfu->getHanfuId();?>#comment" class='comment'>
                <span class="glyphicon glyphicon-comment"></span> <?echo $hanfu->getCommentNum();?></a>	
              </div> 
          </div> 
  	</div>
    <?
  }
    ?>
  </div>
</div>

<?
  include_once 'footer.html'; 
?>
<script type="text/javascript" src="js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="js/jquery.infinitescroll.js"></script>
<script type="text/javascript" src='js/imageloaded.js'></script>
<script type="text/javascript">

addAdmire();
</script>
<script type="text/javascript" src='js/mywater.js'></script>
</html>