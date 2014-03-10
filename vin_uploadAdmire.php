<?
session_start();
require_once 'Hanfu_FileControl.class.php';
require_once 'Hanfu_SqlHelper.class.php';
//handle the admire things 
$user=SqlHelper::getUserByName($_SESSION['userName']);
$itemId=$_GET['itemId'];
$type=$_GET['type'];
$num=$user->admire($itemId,$type);
echo $num;
?>