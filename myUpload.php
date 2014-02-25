<?php
    require_once 'head.html';
?>
<div class="container">

    <form role="form">
        <div class="form-group">
            <label for="title">标题</label>
            <input type="text" class="form-control" id="title" placeholder="标题">
        </div>
        <div class="form-group">
            <label >推荐理由</label>
            <textarea name='comment' class="form-control" rows="3" placeholder='推荐理由'></textarea>
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
        <div class="mainImg">
            <label>上传主图</label>
            <input type="file" class="form-control"/>
        </div>
        <div class="other-img">
            
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

<script src="swfupload/swfupload.js"></script>
    <script>
        var swf;
        window.onload = function(){
            var setting_object={
                upload_url:'uploadMyImg.php',
                flash_url:'swfupload/swfupload.swf',
                file_post_name:"itemImg",
                use_query_string : false,
                requeue_on_error : false,
                file_types:"*.jpg;*.png;*.jpeg",
                file_size_limit:'2048',
                file_upload_limit:10,
                file_queue_limit:2,
                debug:false
            }
        }
    </script>
</div>