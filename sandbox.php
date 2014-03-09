<meta charset='utf8'> 
<?php  
require_once 'Hanfu_SqlHelper.class.php';
require_once 'Hanfu_FileControl.class.php';
require_once 'Hanfu_User.class.php';
require_once 'Hanfu_Photo.class.php';

print_r(SqlHelper::getOneDayByTime(2));
?>