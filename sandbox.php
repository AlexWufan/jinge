<meta charset='utf8'> 
<?php  
require_once 'Hanfu_SqlHelper.class.php';
require_once 'Hanfu_FileControl.class.php';
require_once 'Hanfu_User.class.php';
$user=SqlHelper::getUserById(16);
$id=2;
echo $user->getCollectionById($id);
$userid=16;
$collection="hanfu";
//$user->addCollectionItem($collection,13);
//echo filesize("./user/$userid/collection/$collection.cl");
//print_r($user->showCollection("hanfu"));
//FileControl::addCollectionItem(16,$collection,15);
print_r($user->showCollection("hanfu"));
?>