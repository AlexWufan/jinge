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
  $markedPeopleList=FileControl::getMarkedPeopleList($id);
  $allRate=FileControl::caucalateTheSumOfRate($markedPeopleList);
?>
<link rel='stylesheet' type="text/css" href='rank/rateit.css'>
<link rel="stylesheet" type="text/css" href="css/lightbox.css">
<div class='container '>
   <div class='row'>
    <div class='col-md-9'>
      <div class='panel panel-default'>
         <div class='panel-body'>
            <div class='wrapShowImg'>
            <img  src="<?echo $hanfu->getMain_pic();?>"> 
            </div>
            <div class='info'>
                <span class='vin_item' admire-type='hanfu' admire-count='true' admire-itemId="<?echo $hanfu->getHanfuId();?>" admire-admired="<?echo $user->isAdmired('hanfu',$hanfu->getHanfuId());?>" admire-num="<?echo $hanfu->getAdmireNum();?>"></span>
                 | 
                 <span class='join'>
                  <a class='btn btn-info' data-toggle="modal" data-target="#CollectionBox">加入篮子</a> 
                   <a href="<?echo $hanfu->getLink();?>"class='btn btn-danger'>去购买</a>
                 </span>
                
              </div>
            <div class='wrapShowMessage pull-right'>
              <h5><a href="<?echo $hanfu->getLink();?>"><?echo $hanfu->getHanfuName();?></a></h5>
              <ul>
                <li>商家:<?echo $hanfu->getBusiness();?></li>
                <li>形制:<?echo $hanfu->getStructure();?></li>
                <li>其他:<?echo $hanfu->getOther();?></li>
                <li>颜色:<?echo $hanfu->getColor();?></li>
                <li>元素:<?echo $hanfu->getElement();?></li>
                <li>销售情况:<?echo $hanfu->getSell();?></li>
              </ul>
              <div class='rank'>
                <?
                  if(!FileControl::inArray($user->getUserId(),$markedPeopleList,"rank")){
                ?>
                <ul>
                <li>评分1：
                    <input type='rate' value='0' min='0' max='5' step='0.5' id='backing1'/>
                    <div class='rateit' data-rateit-backingfld='#backing1' data-rateit-resetable="false">   
                    </div>
                     <span class='showRate myRate'>0</span>  
                </li>
                <li>评分2：
                    <input type='rate' value='0' min='0' max='5' step='0.5' id='backing2'/>
                    <div class='rateit' data-rateit-backingfld='#backing2'data-rateit-resetable="false"></div>
                    <span class='showRate myRate'>0</span>
                </li>
                <li>评分3：
                    <input type='rate' value='0' min='0' max='5' step='0.5' id='backing3'/>
                    <div class='rateit' data-rateit-backingfld='#backing3'data-rateit-resetable="false"></div>
                    <span class='showRate myRate'>0</span>
                </li>
                <li>评分4：
                    <input type='rate' value='0' min='0' max='5' step='0.5' id='backing4'/>
                    <div class='rateit' data-rateit-backingfld='#backing4'data-rateit-resetable="false"></div>
                    <span class='showRate myRate'>0</span>
                </li>
                 <button class='btn btn-default pull-right' id='updateRate'>提交点评</button>
                <?
                  }else{
                ?>
                    <div class="alert alert-warning alert-dismissable" >您已经参与过投票</div>
                <?
                  }
                ?>
                </ul>
               
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
                      $admireUser=SqlHelper::getUserById($admires[$i]["userId"]);
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
          <h4>总评</h4>
          <p class='alert-success'>共有<?echo count($markedPeopleList);?>人评分</p>
          <hr>
          <ul class='nopadding'>
            <?
              for($i=0;$i<count($allRate);$i++){
            ?>
            <li>评分<?echo $i+1;?>：<span class="rateit allRate" data-rateit-value="<?echo $allRate[$i];?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span><span class='showRate'><?echo $allRate[$i];?></span></li>
          <?
            }
          ?>
          </ul>
        </div>
      </div>
    </div>
   </div>
</div>
<?
  include_once 'footer.html';
?>
<script src="js/lightbox-2.6.min.js"></script>
<script type="text/javascript" src='rank/jquery.rateit.min.js'></script>
<script type="text/javascript">
  var option={
    item:$(".vin_item"),
    type:"hanfu",
    url:"vin_uploadAdmire.php"
  }
  createAdmireItem(option);
  showComment();
  switchTab();
  $('.rateit').click(function(){
    var item=$(this).attr("data-rateit-backingfld");
   $(this).parent().children('.showRate').html($(item)[0].value);
  });  
  $('#updateRate').click(function(){
      var ISRATED = -1;
      var ALRIGHT = 0;
      var obj={};
      var temp={};
      var items=$('.myRate');
      obj['hanfuid']=getReq('id');
      var itemsKey=["items1","items2",'items3','items4'];
      items.each(function(index, el) {
       temp[itemsKey[index]]=$(this).html();
      });
      obj['data']=temp;
      $.ajax({
        url: 'addRate.php',
        type: 'get',
        dataType: 'json',
        data: obj,
        success:function(response){
          console.log(response);
          if(response == ISRATED){
            alert('您已经参与过评分，按规则不能刷分！');
              return;
          }
          else
              window.location.href="show.php?id="+getReq('id')+"";
        }

    }); 
  });
</script>
