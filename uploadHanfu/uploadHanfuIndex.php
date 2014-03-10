<?
  include_once 'head.html';
  include_once 'Hanfu_SqlHelper.class.php';
  $username=$_SESSION['userName'];
  $user=SqlHelper::getUserByName($username);  
?>
	<div class="container main">
        <form role="form" class="form-horizontal" name='mainForm'>
            <div class="form-group">
                <label class="col-sm-1 control-label">名称</label>
                <div class="col-sm-5">
                    <input type="text" class=" form-control" name="title" placeholder="名称">
                </div>
                <label class="col-sm-1 control-label">商家</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control " name="business" placeholder="商家">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label">形制</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control " name="structure" placeholder="形制">
                </div>
                <label class="col-sm-1 control-label">其他</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="other" placeholder="标题">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">颜色</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control " name="color" placeholder="颜色">
                </div>
                <label class="col-sm-1 control-label">元素</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control " name="element" placeholder="元素">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">销售情况</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control " name="sell" placeholder="销售情况">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label">推荐理由</label>
                <textarea name='comment' class="form-control " rows="3" placeholder='推荐理由'></textarea>
            </div>
            <div class="checkbox">

                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox1" value="want"> 想要
                </label>
                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox2" value="have"> 拥有
                </label>
                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox3" value="shar"> 推荐
                </label>
                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox4" value="find"> 寻找
                </label>
            </div>
            <button type="submit" id='submitBtn'class="btn btn-default">下一步</button>
   	</form>
   </fdiv>
<?
  include_once 'footer.html'; 
?>
