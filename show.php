<?
  include_once 'head.html';
  require_once 'Hanfu_SqlHelper.class.php';
  require_once 'Hanfu_FileControl.class.php';
  include_once 'Hanfu_fenye.class.php';
  $hanfu=SqlHelper::getHanfuById($_GET['id']);
  $author=SqlHelper::getUserById($hanfu->getAuthorId());
  $resComment=SqlHelper::getCommentById($_GET['toid']);
  $resUser=SqlHelper::getUserById($resComment->getCommentUserId());
  $user=SqlHelper::getUserByName($_SESSION['userName']);
  $id=$_GET['id'];
  $page_size=5;
  $nums=$hanfu->getCommentNum();
  $subpages=10;
  $pageCurrent=$_GET['p'];
?>
<link rel="stylesheet" type="text/css" href="css/lightbox.css">
<div class='container '>
   <div class='row'>
    <div class='col-md-9'>
      <div class='panel panel-default'>
         <div class='panel-body'>
            <div class='wrapShowImg'>
            <img  src="<?echo $hanfu->getMain_pic();?>"> 
            </div>
            <div class='wrapShowMessage'>
              <h5><a href="<?echo $hanfu->getLink();?>"><?echo $hanfu->getHanfuName();?></a></h5>
              <div class='info'>
                <span class='like'>
                  <?
                    if(FileControl::inArray($hanfu->getHanfuId(),$user->getAdmireHanfuList())){

                  ?>
                  <span class='glyphicon glyphicon-heart color-red'></span> 
                  <span class='like-num'>喜欢 <?echo $hanfu->getAdmireNum();?></span>
                  <span  class='visibility-hide addadmire'>-1</span>
                  <?
                   }else{ 
                  ?>
                  <span class='glyphicon glyphicon-heart'></span> 
                  <span class='like-num'>喜欢 <?echo $hanfu->getAdmireNum();?></span>
                  <span  class='visibility-hide addadmire'>+1</span>
                  <?
                    }
                  ?>
                </span>
                 | 
                 <span class='join'>
                  <a class='btn btn-info' data-toggle="modal" data-target="#CollectionBox">加入篮子</a> 
                   <a href="<?echo $hanfu->getLink();?>"class='btn btn-danger'>去购买</a>
                 </span>
                
              </div>
            </div>
            <hr>
            <div class='information'>
                <img src="<?echo $author->getPicture();?>">
                <span class='author'><a href='user.php'><?echo $author->getUserName();?></a></span><span><?echo $hanfu->getType();?></span>
                <p class='description'>
                  「 <?echo $hanfu->getComment();?> 」
                </p>
            </div>
          
         </div>
         <div class='panel-heading'>
          <?
            if($author->getUserId()==$user->getUserId()){
              echo "<a href=modify.php?id=$id>修改</a>";
              echo "<a href=delete.php?id=$id>删除</a>";
            }
          ?>
         </div> 
      </div>
      <div class='panel panel-default'>
        <div class='panel-heading'>
          <span>更多图片</span>
        </div>
        <div class='panel-body'>
          <ul class='more-img'>
            <?
            $arr=array();
            $arr=$hanfu->getImgs();
            for ($i=0; $i <count($arr) ; $i++) { 
            
            ?>
            <li><a data-lightbox='roadtrip'href="<?echo $arr[$i];?>"><img src="<?echo $arr[$i];?>"></a></li>
            <?
            }
            ?>
          </ul>
        </div>
      </div>
      <div class='panel panel-default'>
        <div class='panel-title'>
          <ul class="nav nav-tabs nav-justified shabi" id='xxx'>
            <li class='active'><a href="#response-title" data-toggle="tab">回应<span class='alert'><?echo $hanfu->getCommentNum();?></span></a></li>
            <li><a href="#likes" data-toggle="tab">喜欢<span class="alert"><?echo $hanfu->getAdmireNum();?></span></a></li>
          </ul>
        </div> 
        <div class='panel-body'>
          <div class="tab-content">
            <div class="tab-pane  fade in active" id="response-title">
               <div class='comment-body' id='comment'>
                  <?
                    $comments=SqlHelper::getCommentsByHanfuId($hanfu->getHanfuId());
                    $page=$_GET['p'];
                    if(is_null($page)){
                      $page=1;
                    }
                    $index=($page-1)*$page_size;
                    $allpage=intval($nums/$page_size);
                    if($page==$allpage+1){
                        $sum=$nums;
                    }else{
                      $sum=($index+$page_size);
                    }
                    for ($i=$index; $i < $sum; $i++) { 
                      # code...
                      $comment=SqlHelper::getCommentById($comments[$i]);
                      $man=SqlHelper::getUserById($comment->getCommentUserId());
                  ?>
                  <div class='comment-item'>
                    <div class='comment-user-img'>
                      <img src="<?echo $man->getPicture();?>"/>
                    </div>
                    <div class='comment-info'>
                      <div class='comment-author'>
                        <span class='comment-time'><?echo $comment->getCommentDate();?></span>
                        <a href="user.php?id=<?echo $man->getUserId();?>"><?echo $man->getUserName();?></a><span>(<?echo $man->getDescribe();?>)</span>
                        <?
                          if($comment->getType()=='0'){
                           $resComment=SqlHelper::getCommentById($comment->getToid());
                        ?>
                          <blockquote>「 <?echo $resComment->getComment();?>  」<a href="user.php?id=<?echo $resComment->getCommentUserId()?>">@<?echo SqlHelper::getUserById($resComment->getCommentUserId())->getUserName();?></a></blockquote>
                        <?
                          }
                        ?>
                        <p class='comment-comment'>「<?echo $comment->getComment(); ?> 」</p>
                        <div class='comment-plus comment-hide'>
                          <a href="show.php?id=<?echo $hanfu->getHanfuId();?>&toid=<?echo $comment->getCommentId();?>">回应</a><a href="#">有用</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?
                    }
                  if(!is_null($_GET['toid'])){
                  ?>
                  <div class='res-message'><p><?echo $resComment->getComment();?> <a href="user.php?id=<?echo $resUser->getUserId;?>">@<?echo $resUser->getUserName();?></a><span class='close-item glyphicon glyphicon-remove'></span></p></div>
                  
                  <?
                    }
                  ?>
                  <p class='text-center subpage'>  
                  <?
                  if ($nums>10) {
                    $subpages=new subPages($page_size,$nums,$pageCurrent,$sub_pages,"show.php?id=$id&p=",2,"#response-title");
                    # code...
                  }
                  ?>
                </p>
                  <div class='comment-form'>
                    <form role='form' name='addcomment'action='addcomment.php' method='get'>
                      <input type='hidden' name='hanfuid'value="<?echo $hanfu->getHanfuId();?>">
                      <?
                        if(!is_null($_GET['toid'])){
                          $toid=$_GET['toid'];
                          echo "<input type='hidden' name='toid' value='$toid'/>";
                        }
                      ?>
                      <div class='form-group'>
                        <textarea name='comment-area'class="form-control" rows="5"></textarea>
                      </div>
                      <div class='text-right'>
                        <button class='comment-response btn btn-info'>回应</button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class="tab-pane fade in " id="likes">
                 <div class='like-body'>
                  <?
                    $admires=$hanfu->getAdmires();
                    for($i=0;$i<count($admires);$i++){
                      $admireUser=SqlHelper::getUserById($admires[$i][0]);
                  ?>
                    <div class='like-item'>
                      <div class='like-img-wrap'>
                        <img src="<?echo $admireUser->getPicture();?>"/>
                      </div>
                      <div class='message'><a href="user.php?id=<?echo $admireUser->getUserId();?>"><?echo $admireUser->getUserName();?></a> 喜欢了这件东西<span><?echo $admires[$i][1];?></span></div>
                    </div>
                   <?
                    }
                   ?>
                  </div>
            </div>
                  
          </div>  
        </div>
      </div>
    </div>
    <div class='col-md-3'>
      <div class='panel panel-default'>
        <div class='panel-body'>
          otherThings
        </div>
      </div>
    </div>
   </div>
</div>
<?
  include_once 'footer.html';
?>
<script src="js/lightbox-2.6.min.js"></script>
<script type="text/javascript">
  addAdmire();
  showComment();
  switchTab();
  
</script>