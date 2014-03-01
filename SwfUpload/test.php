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
        
    </head>
    <body>
   
        <div class='container'>
            <div id='swfu-placeholder'></div>
            <div> 
                <input type='button' onclick='swfu.startUpload();'value="上传"/>
            </div>    
    </div>
    <script type="text/javascript">
          var swfuOption={
            upload_url:"uploadDeal.php",
            flash_url:"js/swfupload/swfupload.swf",
            button_placeholder_id:"swfu-placeholder",
            file_size_limit:"20480",
            button_width:200,
            button_height:20,
            button_text:"点我选择文件",
            debug:true,
            file_post_name:"Filedata"
          }
          var swfu=new SWFUpload(swfuOption);
        </script>
    </body>
</html>