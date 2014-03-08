<?
  include_once 'head.html';
  include_once 'Hanfu_SqlHelper.class.php';
  $username=$_SESSION['userName'];
  $user=SqlHelper::getUserByName($username);  
?>
	<div class="container main">
          
   </div>
<?
  include_once 'footer.html'; 
?>
