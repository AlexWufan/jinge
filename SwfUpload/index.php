<?php
session_start();
if(is_null($_SESSION['userName'])){
    header("Location:../upload.php");
}
$_SESSION["file_info"] = array();
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>自定义上传</title>
        <link href="css/swfupload.css" rel="stylesheet" type="text/css"/>
        <link rel='stylesheet' type="text/css" href="../css/bootstrap.css"/>
        <script type="text/javascript" src="js/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="js/swfupload/handlers.js"></script>
        <script type="text/javascript" src="js/swfupload/fileprogress.js"></script>
        <script type="text/javascript">
            var swfu;
            window.onload = function () {
                swfu = new SWFUpload({
                    // Backend Settings
                    upload_url: "upload.php",
                    post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

                    // File Upload Settings
                    file_size_limit : "2 MB",	// 2MB
                    file_types : "*.jpg",
                    file_types_description : "JPG Images",
                    file_upload_limit : "0",

                    // Event Handler Settings - these functions as defined in Handlers.js
                    //  The handlers are not part of SWFUpload but are part of my website and control how
                    //  my website reacts to the SWFUpload events.
                    file_queued_handler : fileQueued,
                    file_queue_error_handler : fileQueueError,
                    file_dialog_complete_handler : fileDialogComplete,
                    upload_progress_handler : uploadProgress,
                    upload_error_handler : uploadError,
                    upload_success_handler : uploadSuccess,
                    upload_complete_handler : uploadComplete,

                    // Button Settings
                    button_image_url : "images/SmallSpyGlassWithTransperancy_17x18.png",
                    button_placeholder_id : "spanButtonPlaceholder",
                    button_width: 180,
                    button_height: 18,
                    button_text : '<span class="button">选择图片<span class="btn_startupload">(最大 2 MB)</span></span>',
                    button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12px; }',
                    button_text_top_padding: 0,
                    button_text_left_padding: 18,
                    button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
                    button_cursor: SWFUpload.CURSOR.HAND,

                    // Flash Settings
                    flash_url : "js/swfupload/swfupload.swf",

                    custom_settings : {
                        progressTarget : "fsUploadProgress",
                        cancelButtonId : "btnCancel"
                    },

                    // Debug Settings
                    debug: false
                });
            };
        </script>
    </head>
    <body>
    <header class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class='container'>
            <div class='navbar-header'>
                <a class='navbar-brand' href='../index.php'>锦歌-alpha</a>
            </div>
            <div class='collapse navbar-collapse'>
                <ul class='nav navbar-nav'>
                    <li><a href='../jgxy.php'>锦歌撷英</a></li>
                    <li><a href='#'>商家专栏</a></li>
                    <?
                    if(!is_null($_SESSION['userName'])){

                        ?>
                        <li class='dropdown'>
                            <a href="../user.php" class="dropdown-toggle" data-toggle="dropdown">我的主页<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="../user.php"><span class='glyphicon glyphicon-user'></span> 基本信息</a></li>
                                <li><a href="../setting.php"><span class='glyphicon glyphicon-cog'></span> 设置</a></li>
                                <li><a href="#">thing1</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="../logout.php">退出</a></li>
                            </ul>
                        </li>
                    <?
                    }
                    ?>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="搜索君~">
                    </div>
                    <button type="submit" class="btn btn-default">提交</button>
                </form>
            </div>
         </div>
        </header>
        <div class="container main">
        <form role="form" class="form-horizontal" action="upload.php" method="get">
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
                    <input type="text" class="form-control " name="sheme" placeholder="形制">
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
                    <input type="text" class="form-control " name="yuansu" placeholder="元素">
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
            <div class="hanfuImg">
                <div id="uploadpanel" class="usual">
                    <div id="content">
                        <?php
                        if( !function_exists("imagecopyresampled") ) {
                            ?>
                            <div class="message">
                                <h4><strong>错误:</strong> </h4>
                                <p>服务器端并没有安装GD库</p>
                                <p>请在php.ini中把<code>;extension=php_gd2.dll</code>修改为<code>extension=php_gd2.dll</code> and making sure your extension_dir is pointing in the right place. <code>extension_dir = "c:\php\extensions"</code></p>
                            </div>
                        <?php
                        } else {
                            ?>
                            <form>
                                <div class="fieldset flash" id="fsUploadProgress">
                                    <span class="legend">快速上传</span>
                                </div>
                                <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                                    <span id="spanButtonPlaceholder"></span>&nbsp;
                                    <input type="button" value="开始上传" class="btn_startupload" onclick="swfu.startUpload();"/>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                        <div id="thumbnails"></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

    </body>
</html>