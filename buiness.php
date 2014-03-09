<?
  include_once 'head.html';
  $index=0;
  $num=9;
  $articles=SqlHelper::getArticle($index,$num);
?>
<div class='container '>

  <table class='table'>
      <tr><td>标题</td></tr>
      <?
        for ($i=0; $i <count($articles) ; $i++) { 
         ?>
         <tr><td><a href=article.php?id=<?echo $articles[$i]["id"];?>><?echo $articles[$i]["title"];?></td></tr>
      <?   
        }
      ?>
  </table>

</div>    
<?
  include_once 'footer.html';
?>