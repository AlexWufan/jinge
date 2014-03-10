<?php
session_start();
require_once '../Hanfu_SqlHelper.class.php';
if(is_null($_SESSION['userName'])){
    header("Location:../upload.php");
}

$hanfuId=$_GET['id'];
$hanfu=SqlHelper::getHanfuById($hanfuId);
$_SESSION["file_info"] = array();
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>自定义上传</title>
        <link href="css/swfupload.css" rel="stylesheet" type="text/css"/>
        <link rel='stylesheet' type="text/css" href="../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <script type="text/javascript" src='../js/jquery.js'></script>
        <script type="text/javascript" src='../js/bootstrap.js'></script>
        <script type="text/javascript" src="js/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="js/swfupload/handlers.js"></script>
        <script type="text/javascript" src="js/swfupload/fileprogress.js"></script>
        <script type="text/javascript">
            var swfu;
            window.onload = function () {
                swfu = new SWFUpload({
                    // Backend Settings
                    upload_url: "upload.php",
                    post_params: {
                            "PHPSESSID": "<?php echo session_id(); ?>",
                            "id":"<?php echo $_GET['id'] ?>"    
                                    },

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
            <div class='well well-lg'>
                    <div class='alert alert-success'>
                        您【<?echo $hanfu->getType();?>】的汉服【<?echo $hanfu->getHanfuName();?>】上传第一步已经完成，完善下列信息来完成上传。
                    </div>    
                <form role="form" class="form-horizontal" name='mainForm'>
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
                                        <div class='row'>
                                        <div class='alert alert-info col-md-offset-1 col-md-4'>
                                            <span id="spanButtonPlaceholder"></span>
                                        </div>
                                        </div>
                                    </form>
                                   <?php
                                }
                                ?>
                            </div>
                        </div>
                </form>
        <div class="hanfuImg">
                 <div id="thumbnails"></div>
        </div>
        <button class='btn btn-danger' onclick="swfu.startUpload();">开始上传</button>
        <a class='btn btn-success' href='../show.php?id=<?echo $hanfuId;?>'>完成创建汉服</a>
    </div>    

    </div>
    <script type="text/javascript">
        var btn = document.getElementById('submitBtn');
        btn.onclick=function(){
            mainForm.submit();
        }
    </script>
    </body>
</html>