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
					if(item.isLike){
						information=$("<div class='information'><img src="+item.ownerPic+"><span class='author'><a href="+item.ownerLink+">"+
						item.hanfuOwner+"</a></span><span>"+item.hanfuType+"</span><span showid="+item.showid+" class='admire-button  like'><span class='glyphicon glyphicon-heart color-red'></span></span><p class='description'>"+item.hanfuComment+"</p></div>");
					}else{
						information=$("<div class='information'><img src="+item.ownerPic+"><span class='author'><a href="+item.ownerLink+">"+
						item.hanfuOwner+"</a></span><span>"+item.hanfuType+"</span><span showid="+item.showid+" class='admire-button like'><span class='glyphicon glyphicon-heart'></span></span><p class='description'>「"+item.hanfuComment+"」</p></div>");
					}
					userlike=$("<div class='userlike'><a href="+item.likeLink+" class='likeshow'><span class='glyphicon glyphicon-heart'></span><span class='like-num'> "+item.hanfuLikeNum+"</span></a><a href="+item.hanfuCommentLink+" class='comment'><span class='glyphicon glyphicon-comment'> "+item.hanfuCommentNum+"</div>");
					caption=$("<div class='caption'></div>");
					caption.append(information);
					caption.append(userlike);
					indexitem.append(vin);
					indexitem.append(caption);
					indexitem.find('.like').bind('click',function(){
						var like=$(this),
							id=getReq('id')||$(this).attr('showid');
						$.ajax({
							url: 'addAdmire.php',
							type: 'get',
							dataType: 'html',
							data: {
								id:id
							},
						})
						.fail(function() {
							console.log("error");
						})
						.always(function(response) {
							if(getReq('id')){
								$('.like .like-num').html("喜欢 "+response);
									 location.href='show.php?id='+id;
								
							}else{
								heart=like.children('.glyphicon-heart');
								like.parents('.caption').find('.like-num').html(response);
								if(heart.hasClass('color-red')){
									heart.removeClass('color-red').addClass('color-black');
								}else{
									heart.removeClass('color-black').addClass('color-red');
								}
							}
						});	
				
					});
					
					feedback.append(indexitem);
				};
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