$(function(){
		var $container = $('#waterfall'),
		imageLoading=false,
		hanfuNum=$container.attr('data-hanfunum'),
		index=2,
		prePage=10;
		function init(){
			var items=$container.find('.indexitem').css('opacity',0);
			$container.imagesLoaded(function(){
				items.css('opacity',1);
				$container.masonry({
					itemSelector : '.indexitem',
		    		isFitWidth:true
				});
			});
		}
	function loadNewItems(callback){
		$.ajax({
			url:"getNewItem.php",
			method:"get",
			data:{
				index:(index-1)*10-1
			},
			dataType:'json',
			success:function(items){
				var feedback=$("<div id='#feedback'></div>");
				for (var i = 0; i < items.length ; i++) {
						var item=items[i];
						console.log(item);
					indexitem=$('<div class="indexitem"></div>');
					vin=$("<div class='vin'><a href="+item.hanfuLink+"><img alt='test'src="+item.hanfuMainPic+"></a>"+
						"<div class='title notchosen'><a href="+item.hanfuLink+">"+item.hanfuName+"</a></div>"+"</div>");
						information=$("<div class='information'><img src="+item.ownerPic+"><span class='author'><a href="+item.ownerLink+">"+
						item.hanfuOwner+"</a></span><span>"+item.hanfuType+"</span><p class='description'>「"+item.hanfuComment+"」</p></div>");
					userlike=$("<div class='userlike'><span class='vin_item' admire-type='hanfu' admire-admired='"+item.isLike+"' admire-count='true' admire-itemId='"+item.showid+"' admire-num="+item.hanfuLikeNum+"></span><a href="+item.hanfuCommentLink+" class='comment'><span class='glyphicon glyphicon-comment'> "+item.hanfuCommentNum+"</div>");
					caption=$("<div class='caption'></div>");
					caption.append(information);
					caption.append(userlike);
					indexitem.append(vin);
					indexitem.append(caption);
					feedback.append(indexitem);
				};
				var option={
					item:feedback.find(".vin_item"),
					type:"hanfu",
					url:"vin_uploadAdmire.php"
				}
				createAdmireItem(option);
				var x=feedback.find('.indexitem');
				callback(x);
				index++;
			},
			error:function(error){
				console.log(error);
			},
			complete:function(status){
			}
		
		});	 
	}
	function appendToMasonry(){
		 loadNewItems(function(returnitem){
		 	var items=returnitem.css('opacity', 0);	 	
		 		$container.append(items);			
				items.imagesLoaded(function(){
					imageLoading=false;
					items.css('opacity',1);
					$container.masonry('appended',items);
				});
		 });
	}
	$(window).scroll(function(event) {
		/* Act on the event */
		if($(document).height()-$(window).height()-$(document).scrollTop()<10){
				if(!imageLoading){
					appendToMasonry();
					imageLoading=true;
				}
			};
			
		});
	init();
});