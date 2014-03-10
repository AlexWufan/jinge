<?
  include_once 'head.html';
  include_once 'Hanfu_SqlHelper.class.php';
  $username=$_SESSION['userName'];
  $user=SqlHelper::getUserByName($username);
  $index=0;
  $num=9;
  $oneDayIdArr=SqlHelper::subOneDay($index,$num);
  $oneDayNum=SqlHelper::getOneDayNum();
?>
  <div class='container indexMain'>	
	<div id='waterfall' class='container-of-index' data-oneDayNum="<?echo $oneDayNum;?>">
    <?
      for($i=0;$i<count($oneDayIdArr);$i++){
        $oneDay=SqlHelper::getOneDayById($oneDayIdArr[$i]);
      
        $isAdmired=$user->isAdmired("oneDay",$oneDay->getId());
        
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
                  <span class='vin_item' admire-type='oneDay' admire-admired='<?echo $isAdmired;?>' admire-count='true' admire-itemId="<?echo $oneDay->getId();?>" admire-num="<?echo $oneDay->getAdmireNum();?>"> </span>
                  <span class='item-likeNum'></span>
                  <span class='pull-right'>
                    <a class='item-like'><span class='glyphicon glyphicon-share'></span> </a>
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
                        $commenter=SqlHelper::getUserById($comment->getCommentUserId());
                        ?>
                        <div class='comment'>                      
                          <img src="<?echo $commenter->getPicture();?>">
                          <span class='author-name'><a href="user.php?id=<?echo $commenter->getUserId;?>"><?echo $commenter->getUserName();?></a></span>
                          <span class='comment-of-index'><?echo $comment->getComment();?></span>
                        </div>
                  <?      
                    }
                  }else{
                     for($j=0;$j<3;$j++){
                        $comment=SqlHelper::getCommentById($comments[$j]);
                        $commenter=SqlHelper::getUserById($comment->getCommentUserId()); 
                  ?>
                     <div class='comment'>                      
                          <img src="<?echo $commenter->getPicture();?>">
                          <span class='author-name'><a href="user.php?id=<?echo $commenter->getUserId;?>"><?echo $commenter->getUserName();?></a></span>
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
       console.log(w+""+h);
       if(w>h){
          this.width=600;
        }
        else{
          this.height=600;
        }
    });
    $('.updateOfComment').click(function(){
      var self=$(this);
      var comment=self.parents(".formAction").find('input')[0];
      if(comment.value.length==0){
        return false;
      }
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
      createAdmireItem({
          item:$(".vin_item"),
          url:"vin_uploadAdmire.php",
      });
  });
</script>
<script type="text/javascript" src='js/imageloaded.js'></script>
<script type="text/javascript" src='js/indexwater.js'></script>
</html>