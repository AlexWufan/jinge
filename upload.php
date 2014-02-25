<?
  require_once 'head.html';
?>
<div class='container '>
  <div class='row'>
    <div class='col-md-10'>
      <form role="form" name='geturl'>
        <div class="form-group">
          <label  class='control-label col-sm-1'for="exampleInputEmail1">名称</label>
          <div class='col-sm-9'>
            <input type="url" name='url'class="form-control"  placeholder="只需将网址粘贴到这里就可以哦">
          </div>
        </div>   
        <button type="submit"data-toggle="modal" data-target="#uploadModal" id='searchByUrl'class="btn btn-danger">查找商品</button>
      </form>
    </div>

  </div>
  <div class='info'>
      <p>支持：</p>
      <a href='#'>淘宝</a><a href='#'>天猫</a>
    </div>
  <div>
      <a class="btn btn-primary" href="swfupload/index.php">自定义上传</a>
  </div>
</div>
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">发布商品</h4>
      </div>
      <div class="modal-body">
        <div class='row margin'>
          <div class='col-md-4 taobao-item-info'>
            <div class='taobao-item-wrap-image'>
              <img src='img/1.jpg'/>
            </div>
          </div>
          <div class='col-md-8 taobao-item-form'>
            <form class='form-horizontal' role='form' id='formupload'name='formupload'>
              <div class="form-group">
                <label for="title">名称</label>
                <input type="text" class="form-control"  name='title'placeholder="名称">
              </div>
              <label class="checkbox-inline">
                <input type="radio" id="inlineCheckbox1" value="want"> 想要
              </label>
              <label class="checkbox-inline">
                <input type="radio" id="inlineCheckbox2" value="have"> 拥有
              </label>
              <label class="checkbox-inline">
                <input type="radio" id="inlineCheckbox3" value="shar"> 推荐
              </label>
              <div class='form-group margin-top'>
                <label for='textarea'>推荐理由</label>
                <textarea name='comment' class="form-control" rows="3" placeholder='推荐理由'></textarea>
              </div>
            </form>
          </div>
        </div>

        <div class='other-img'>
        <p>点击<span class='glyphicon glyphicon-ok main'></span> 设置为主图， <span class='glyphicon glyphicon-remove delete'></span> 取消加入。<!--<span style='display:inline-block;position:relative;right:-200px;'><a  class='btn btn-info'>上传新图片</a></span>--></p>
        <div class='lineHr'></div>
          <ul class='other-img-ul'>
            
          </ul>
        </div>
      </div>
      <div class='addtoCollection'>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
        <button type="button" id='publishData'class="btn btn-danger">发布</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?
  require_once 'footer.html';
?>
<script type="text/javascript">
    getNewTaobaoItem();
</script>