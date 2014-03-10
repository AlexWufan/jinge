<?
  include_once 'head.html';
  $id=$_GET['id'];
  $article=SqlHelper::getArticleById($id);

?>
<div class='container'>
  <h2><?echo $article->getTitle();?></h2>
  <h5><?echo $article->getAuthor()->getUserName();?></h5>  
  <div class='article well'>
   <?
    echo $article->getContent();
   ?>   
  </div>
</div>    
<?
  include_once 'footer.html';
?>