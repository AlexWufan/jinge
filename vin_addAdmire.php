<?
	require_once 'head.html';
?>
<div class='container'>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='123' admire-num='0'>	
	</div>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='124' admire-num='1'>	
	</div>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='125' admire-num='0'>	
	</div>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='126' admire-num='3'>	
	</div>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='127' admire-num='0'>	
	</div>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='128' admire-num='4'>	
	</div>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='129' admire-num='0'>	
	</div>
	<div class='vin_item' admire-type='oneDay' admire-count='true' admire-itemId='130' admire-num='6'>	
	</div>
</div>
<?
	require_once 'footer.html';
?>
<script type="text/javascript">

$(document).ready(function(){
	var option={
		item:$(".vin_item"),
		type:"oneDay",
		url:"vin_uploadAdmire.php"
	}
	createAdmireItem(option);
});	
</script>