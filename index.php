<?
  include_once 'head.html';
  include_once 'Hanfu_SqlHelper.class.php';
  $username=$_SESSION['userName'];
  $user=SqlHelper::getUserByName($username);
  $index=0;
  $num=9;
  $oneDayIdArr=SqlHelper::subOneDay($index,$num);
?>
  <div class='container indexMain'>	
	<div id='waterfall' class='container-of-index' data-hanfunum="<?echo $hanfuNum;?>">
    <?
      for($i=0;$i<count($oneDayIdArr);$i++){
        $oneDay=SqlHelper::getOneDayById($oneDayIdArr[$i]);
    ?>
    <div class='item_one'>
        <div class='left-item'>
          <div class='text-right' >
            <small><?echo $oneDay->getTime();?></small>
            <div class='author-of-item'>
              <img src="img/default.jpg">
              <span class='author-name'><strong><?echo $oneDay->getAuthor();?></strong></span>
            </div>
          </div>
        </div>
        <div class='item-img'>
          <div class='item-wrapImg'>
             <img class='item-of-img'src="<?echo $oneDay->getImage();?>"/>
             <div class='underImg'>
                  <a href='#' class='item-like'><span class='glyphicon glyphicon-heart'></span> </a>
                  <span class='item-likeNum'>有1000人喜欢过这附图</span>
                  <span class='pull-right'>
                    <a href='#' class='item-like'><span class='glyphicon glyphicon-heart'></span> </a>
                    <a href='#' class='item-like'><span class='glyphicon glyphicon-heart'></span> </a>
                  </span>
                  
              </div>
            <div class='informationOfImg'>
              <p class='information-reason'><?echo $oneDay->getReason();?></p>
            <div class='comment-body'>
              <div class='author-information'>
                <div class='commentList'>
                  <?
                    $comments=$oneDay->getCommentList();
                    if(count($comments)<=3){
                      for($j=0;$j<count($comments);$j++){
                        $comment=SqlHelper::getCommentById($comments[$j]);
                        $user=SqlHelper::getUserById($comment->getCommentUserId());
                        ?>
                        <div class='comment'>                      
                          <img src="<?echo $user->getPicture();?>">
                          <span class='author-name'><a href="user.php?id=<?echo $user->getUserId;?>"><?echo $user->getUserName();?></a></span>
                          <span class='comment-of-index'><?echo $comment->getComment();?></span>
                        </div>
                  <?      
                    }
                  }else{
                     for($j=0;$j<3;$j++){
                        $comment=SqlHelper::getCommentById($comments[$j]);
                        $user=SqlHelper::getUserById($comment->getCommentUserId()); 
                  ?>
                     <div class='comment'>                      
                          <img src="<?echo $user->getPicture();?>">
                          <span class='author-name'><a href="user.php?id=<?echo $user->getUserId;?>"><?echo $user->getUserName();?></a></span>
                          <span class='comment-of-index'><?echo $comment->getComment();?></span>
                        </div>
                  <?
                      }
                      echo "<a class='text-center btn btn-link showMore'>点击加载更多</a>";
                   }
                  ?>
                </div>
                <div class='formAction row'>
                    <div class='form-group col-md-8'>
                      <input onedayId="<?echo $oneDay->getTimeStamp();?>" type='text' class='form-control'/>
                    </div>
                    <div class='col-md-4'>
                      <button class='updateOfComment btn btn-info'>确认</button>
                    </div>
                </div>
              </div>
            </div>
          </div> 
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
<script>
  $(document).ready(function(){
    var imgs=$('.item-of-img');
    imgs.each(function(){
      var w=this.width;
      var h=this.height;      
       if(w>h){
          this.width=770;
        }
        else{
          this.height=600;
        }
    });
    $('.updateOfComment').click(function(){
      var self=$(this);
      var comment=self.parents(".formAction").find('input')[0];
      $.ajax({
        url: 'addComment.php',
        type: 'get',
        dataType: 'html',
        data: {
          oneDayId: comment.getAttribute('onedayid'),
          oneDayValue:comment.value
                },
        success:function(response){
          eval("response="+response);
          var commentToShow=$("<div class='comment'><img src="+response.authorImg+"><span class='author-name'><a href='user.php?id="+response.authorId+"'>"+response.authorName+"</a></span><span class='comment-of-index'>"+response.comment+"</span></div>");
          self.parents(".author-information").find('.commentList').append(commentToShow);
          comment.value="";
        }
      });
    });
    $('.showMore').click(function(event) {
      /* Act on the event */
      var self=$(this);
      var oneDayId=$(this).parents(".author-information").find('input')[0].getAttribute('oneDayId');
      console.log(oneDayId);
            $.ajax({
              url: 'showMore.php',
              type: 'get',
              dataType: 'html',
              data: {oneDayId: oneDayId},
              success:function(re){
                self.hide();
                eval("re="+re);
                for(var i=0;i<re.length;i++){
                  var commentToShow=$("<div class='comment'><img src="+re[i].authorImage+"><span class='author-name'><a href='user.php?id="+re[i].authorId+"'>"+re[i].authorName+"</a></span><span class='comment-of-index'>"+re[i].comment+"</span></div>");
                  self.parents(".author-information").find('.commentList').append(commentToShow);
                }
              }
            });
            
    });

  });
</script>
<!--
<script type="text/javascript" src="js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="js/jquery.infinitescroll.js"></script>
<script type="text/javascript" src='js/imageloaded.js'></script>
<script type="text/javascript">

addAdmire();
</script>
<script type="text/javascript" src='js/mywater.js'></script>
--></html>