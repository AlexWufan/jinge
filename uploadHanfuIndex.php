<?
  include_once 'head.html';
  include_once 'Hanfu_SqlHelper.class.php';
  $username=$_SESSION['userName'];
  $user=SqlHelper::getUserByName($username);  
?>
	<div class="container main">
        <form role="form" class="form-horizontal" name='mainForm' action='uploadHanfu.php' method='get'>
            <div class="form-group">
                <label class="col-sm-1 control-label">名称</label>
                <div class="col-sm-5">
                    <input type="text" class=" form-control" name="name" placeholder="名称(唯一)">
                </div>
                <label class="col-sm-1 control-label">商家</label>
                <div class="col-sm-5">
                    <select name='business' class='form-control'>
                        <option value="1"> 竹里馆 </option>
                        <option value="2"> 重回汉唐 </option>
                        <option value="3"> 月到风来阁 </option>
                        <option value="4"> 雅韵华章 </option>
                        <option value="5"> 绣春坊 </option>
                        <option value="6"> 衔泥小筑 </option>
                        <option value="7"> 竹里馆 </option> 
                        <option value="8"> 重回汉唐 </option>
                        <option value="9"> 月到风来阁 </option>
                        <option value="10"> 雅韵华章 </option>
                        <option value="11"> 绣春坊  </option>
                        <option value="12"> 衔泥小筑 </option>
                        <option value="13"> 纤云馆  </option>
                        <option value="14"> 瞳莞   </option>
                        <option value="15"> 双玉瓯  </option>
                        <option value="16"> 如梦霓裳 </option>
                        <option value="17"> 清辉阁  </option>
                        <option value="18"> 青鸾殿  </option>
                        <option value="19"> 秦风无衣 </option>
                        <option value="20"> 绮年华裳 </option>
                        <option value="21"> 鹿苑听松 </option>
                        <option value="22"> 兰夜心  </option>
                        <option value="23"> 锦瑟衣庄 </option>
                        <option value="24"> 江南桃花家 </option>
                        <option value="25"> 家家妈妈 </option>
                        <option value="26"> 怀谷居  </option>
                        <option value="27"> 华姿仪赏 </option>
                        <option value="28"> 华夏粹  </option>
                        <option value="29"> 汉尚华莲 </option>
                        <option value="30"> 汉服风流店 </option>
                        <option value="31"> 佛伦   </option>
                        <option value="32"> 枫天阁  </option>
                        <option value="33"> 二木家  </option>
                        <option value="34"> 寸草香舍 </option>
                        <option value="35"> 春拾记  </option>
                        <option value="36"> 朝露之城 </option>
                        <option value="other"> 其他 </option>
                    </select>
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
            <div class="checkbox form-group">
                <label class="checkbox-inline">
                    <input type="radio" name="typeRadio" value="want"> 想要
                </label>
                <label class="checkbox-inline">
                    <input type="radio" name="typeRadio" value="have"> 拥有
                </label>
                <label class="checkbox-inline">
                    <input type="radio" name="typeRadio" value="shar"> 推荐
                </label>
                <label class="checkbox-inline">
                    <input type="radio" name="typeRadio" value="find"> 寻找
                </label>
            </div>
            <div class='form-group'>
                <button type="submit" id='submitBtn'class="btn btn-default">下一步</button>
   	        </div>
    </form>
   </fdiv>
<?
  include_once 'footer.html'; 
?>
