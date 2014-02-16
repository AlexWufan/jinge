<html>
<form action='test.php' method='get'>
	<input type='text' name='sno'>
	<input type='submit'/>提交
</form>
</html>
<?
$sno=$_GET['sno'];
$abc2="dadwa";
$abc3="awdwadaw";
$result=mysql_query("select *");
while($row=mysql_fetch_assoc($result)){
	echo "<tr><td>$row['sno']</td><td>$row['sname']</td><tr>";
}
$row=mysql_fetch_row(result);
echo "<table border='1'>";
echo "<tr><td>$row</td><td>性别</td><tr>";
echo "<tr><td>$abc2</td><td>$abc3</td><tr>";
echo "</table>";
?>