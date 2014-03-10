<meta charset='utf8'> 
<?php  
require_once 'Hanfu_SqlHelper.class.php';
require_once 'Hanfu_FileControl.class.php';
require_once 'Hanfu_User.class.php';
require_once 'Hanfu_Photo.class.php';
$user=SqlHelper::getUserById(16);
echo $user->isAdmired("oneDay",14);
echo $user->isAdmired("oneDay",17);
echo $user->isAdmired("oneDay",19);

?>