$(function(){
	var index=1,
		flag=false,
		type=$("#userINFO").attr('type');
	function addItems(callback){
		//alert(index);
	var	id=$('#userINFO').attr('userid');
		console.log(index);
		$.ajax({
			url: 'getUserInfo.php',
			type: 'GET',
			dataType: 'json',
			data: {
				index: index,
				id   : $("#userINFO").attr('userid'),
				type : type
			},
		})
		.done(function(items) {
			//console.log(items[0]);
			if(type=='me'){
				var feedback=$("<div></div>"),
				i,
				item,
				useritem;
				for(i=0;i<items.length;i++){
					item=items[i];
					if(typeof item.hanfuName==null) continue;
					useritem=$("<div class='user-item'></div>");
					if(item.type=='comment'){
							userinfo=$("<p class='userinfo'><span class='glyphicon glyphicon-comment'></span>评论了汉服<span class='time'>"+item.time+"</span></p>");
					}else{
							userinfo=$("<p class='userinfo'><span class='glyphicon glyphicon-heart'></span>喜欢了汉服<span class='time'>"+item.time+"</span></p>");
					}
					hanfuinfo=$("<div class='hanfuinfo'></div>");
					infotitle=$("<div class='info-title'><img src="+item.ownerImage+"><a href="+item.ownerLink+">"+item.ownerName+"</a>的汉服<a href="+item.hanfuLink+">"+item.hanfuName+"</a></div>");	
					mainimg=$("<div class='main-img'><img src="+item.mainpic+"></div>");
					infobottom=$("<div class='info-bottom'><p><a href='#'>喜欢</a>·<a href='#'>加入篮子</a>·<a href='"+item.hanfuLink+"#comment' >回应</a></p></div>");
					hr=$("<div class='lineHr'></div>");
					useritem.append(userinfo);
					hanfuinfo.append(infotitle);
					hanfuinfo.append(mainimg);
					hanfuinfo.append(infobottom);
					hanfuinfo.append(hr);
					useritem.append(hanfuinfo);
					feedback.append(useritem);
				}
				callback(feedback.find('.user-item'));
			}
			if(type=='fans'||type=='attention'){
					var feedback=$("<div></div>"),
					i,
					item,
					useritem;
					for(i=0;i<items.length;i++){
						item=items[i];
						if(item.userDes===null) item.userDes="";
						if(typeof item.userName==null) continue;
						useritem=$("<div class='user-item user-fans'></div>");
						img=$("<div class='user-wrap-image'><img src="+item.userPic+"></div>");
						userinfo=$("<div class='user-info'></div>");
						a=$("<a class='name' href="+item.userLink+">"+item.userName+"</a>");
						p=$("<p class='user-describe'>"+item.userDes+"</p>");
						
							if(type=='fans'){
								if(item.isIn){
									a2=("<a class='button-like btn btn-info' type='fans' sessionid="+id+" pageid="+item.userid+">互相关注</a>");
								}else{
									a2=("<a class='button-like btn btn-primary' type='fans' sessionid="+id+" pageid="+item.userid+">关注</a>");
								}
							}else{
								if(item.isIn){
									a2=("<a class='button-like btn btn-info' type='attention' sessionid="+id+" pageid="+item.userid+">互相关注</a>");
								}else{
									a2=("<a class='button-like btn btn-default' type='attention' sessionid="+id+" pageid="+item.userid+">取消关注</a>")
								}
							}	
						useritem.append(img);
						userinfo.append(a);
						userinfo.append(p);
						userinfo.append(a2);
						useritem.append(userinfo);
						feedback.append(useritem);
					}
					callback(feedback.find('.user-item'));
			}
		})
		.fail(function(error) {
			console.log(error);
		})
		.always(function() {
			console.log("complete");
		});
		
	} 
	function carefor(){
		$('.button-like').click(function(){
			    var button=$(this),
				sessionid=$(this).attr('sessionid');
				pageid=$(this).attr('pageid');
				type=$(this).attr('type');
				//alert(sessionid);
				//alert(pageid);
				$.ajax({
					url: 'addfans.php',
					type: 'get',
					dataType: 'html',
					data: {
							 sessionid:sessionid,
							 pageid:pageid
						},
				})
				.done(function(response) {
					//console.log("success");
					console.log(response);
						if(type=='fans'){
							if(button.hasClass('btn-info')){
								button.removeClass('btn-info').addClass('btn-primary');
								button.html("关注");	
							}else{
								button.removeClass('btn-primary').addClass('btn-info');
								button.html("互相关注");
							}
						}else if(type=='attention'){
							if(button.hasClass('btn-info')){
								button.removeClass('btn-info').addClass('btn-primary');
								button.html("关注");
							}else{
								button.removeClass('btn-default').addClass('btn-primary');
								button.html("关注");
							}
						}else{
							if(button.hasClass('btn-primary')){
								button.removeClass('btn-primary').addClass('btn-default');
								button.html("关注");
							}else{
								button.removeClass('btn-default').addClass('btn-primary');
								button.html("关注");
							}
							$('.fans-div').html(response);
						}
						
						
					
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			

		
		});
	}
	carefor();
	$(window).scroll(function(event) {
		/* Act on the event */
		if($(document).height()-$(window).height()-$(document).scrollTop()<10){
			if(!flag){
				//alert('rest');
				flag=true;
				addItems(function(item){
					$('#userINFO').append(item);
					flag=false;
				});
				index++;
			}
		}
	});

});