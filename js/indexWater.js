$(function(){
		var $container = $('#waterfall'),
		imageLoading=false,
		hanfuNum=$container.attr('data-oneDayNum'),
		index=2,
		prePage=10;
		function init(){
			var items=$container.find('.indexitem').css('opacity',0);
			$container.imagesLoaded(function(){
				console.log("image ready");
				items.css('opacity',1);
			});
		}
	function loadNewItems(callback){
		$.ajax({
			url:"getNewOneDay.php",
			method:"get",
			data:{
				index:(index-1)*10-1
			},
			dataType:'json',
			success:function(items){
				console.log(items);
				var feedback=$("<div id='#feedback'></div>");
					for (var i = 0; i < items.length; i++) {
						var oneItem=$("<div class='item_one'></div>");
						var leftItem=$("<div class='left-item'><div class='text-right'><small>"+items[i].timer+"</small><div class='author-of-item'><img src="+items[i].authorImg+"></div><span class='author-name'><strong>"+items[i].authorName+"</strong></span></div></div>");
						var rightItem=$("<div class='item-img'><img class='item-of-img' src="+items[i].mainImg+"><div class='underImg'><span class='vin_item' admire-type='oneDay' admire-admired="+items[i].isAdmired+" admire-count='true' admire-itemId='"+items[i].id+"'' admire-num='"+items[i].admireNum+"'></span><span class='pull-right'><a href='#' class='item-like'><span class='glyphicon glyphicon-share'></span></a></span></div></div>");
						var informationItem=$("<div class='informationOfImg'><p class='information-reason'>"+items[i].reason+"</p></div>");
						var commentBody=$("<div class='comment-body'></div>");
						var authorIn=$("<div class='author-information'></div>");
						var commentList=$("<div class='commentList'></div>");
						var commentObj=items[i].commentList;
						if( commentObj != null){
							var commentLen=parseInt(commentObj.length) >= 3 ? 3 : commentObj.length;
							console.log(commentLen);
							for(var j=0;j<commentLen;j++){
								var comment=$("<div class='comment'><img src="+commentObj[j].img+"><span class='author-name'><a href=user.php?id="+commentObj[j].authorid+">"+commentObj[j].author+"</a></span><span class='comment-of-index'>"+commentObj[j].comment+"</span></div>");
								commentList.append(comment);
							}
							if(commentObj.length>3){
									var showMore=$("<a class='text-center btn btn-link showMore'>点击加载更多</a>");
								commentList.append(showMore);
							}
						}
						var formItem=$("<div class='formAction row'><div class='form-group col-md-8'><input class='form-control' onedayid="+items[i].TimeStamp+"></div><div class='col-md-4'><button class='updateOfComment btn btn-info'>确认</button></div></div>")
						authorIn.append(commentList);
						authorIn.append(formItem);
						commentBody.append(authorIn);
						informationItem.append(commentBody);
						rightItem.append(informationItem);
						oneItem.append(leftItem);
						oneItem.append(rightItem);
					feedback.append(oneItem);
					};
				createAdmireItem({
			          item:feedback.find(".vin_item"),
			          url:"vin_uploadAdmire.php",
			      });	
				feedback.find('.item-of-img').each(function(){
					var w=this.width;
					var h=this.height;
					console.log(w+""+h);
					if(w>h){
						this.width=600;
					}else{
						this.height=600;
					}
				});
				feedback.find('.showMore').click(function(event) {
	      /* Act on the event */
	      var self=$(this);
	      var oneDayId=$(this).parents(".author-information").find('input')[0].getAttribute('oneDayId');
	      console.log(oneDayId);
	            $.ajax({
	              url: 'showMore.php',
	              type: 'get',
	              dataType: 'html',
	              data: {oneDayId: oneDayId},
	              success:function(re){
	                self.hide();
	                eval("re="+re);
	                for(var i=0;i<re.length;i++){
	                  var commentToShow=$("<div class='comment'><img src="+re[i].authorImage+"><span class='author-name'><a href='user.php?id="+re[i].authorId+"'>"+re[i].authorName+"</a></span><span class='comment-of-index'>"+re[i].comment+"</span></div>");
	                  self.parents(".author-information").find('.commentList').append(commentToShow);
	                }
	              }
	           	 });
				            
   				 });
				feedback.find('.updateOfComment').click(function(){
				      var self=$(this);
				      var comment=self.parents(".formAction").find('input')[0];
				      $.ajax({
				        url: 'addComment.php',
				        type: 'get',
				        dataType: 'html',
				        data: {
				          oneDayId: comment.getAttribute('onedayid'),
				          oneDayValue:comment.value
				                },
				        success:function(response){
				          eval("response="+response);
				          var commentToShow=$("<div class='comment'><img src="+response.authorImg+"><span class='author-name'><a href='user.php?id="+response.authorId+"'>"+response.authorName+"</a></span><span class='comment-of-index'>"+response.comment+"</span></div>");
				          self.parents(".author-information").find('.commentList').append(commentToShow);
				          comment.value="";
				        }
				      });
				    });
					
				var x=feedback.find('.item_one');
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
					console.log("ready");
					items.css('opacity',1);
				});
		 });
	}
	$(window).scroll(function(event) {
		/* Act on the event */
		if($(document).height()-$(window).height()-$(document).scrollTop()<10){
				if(!imageLoading){
					console.log("ready");
					appendToMasonry();
					console.log("over");
					imageLoading=true;
				}
			};
			
		});
	init();
});