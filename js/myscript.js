//$(function(){
	function register(){
		var userNameflag=false,
			emailflag=false,
			passwordflag=false;
			password2flag=false;
			userName2flag=false;
		$('#regUserName').keyup(function(event) {
			/* Act on the event */
			userName=regForm.userName.value;
			if(userName.length<2||userName.length>18){
				$('#alertDiv').html("用户名输入错误");
				userNameflag=false;
				$(this).parent('.form-group').removeClass('has-success').addClass('has-error');
			}else{
				$('#alertDiv').html("");
				$(this).parent('.form-group').removeClass('has-error').addClass('has-success');
				userNameflag=true;
			}
		});
		$('#regUserName').blur(function(event) {
			/* Act on the event */
			thisitem=$(this);
			userName=regForm.userName.value;
			$.ajax({
				url:'checkName.php',
				method:'get',
				data:"userName="+userName,
				dataType:'html',
				success:function(response){
					if(response=='0'){
						$('#alertDiv').html("");
						thisitem.parent('.form-group').removeClass('has-error').addClass('has-success');
						userName2flag=true;
					}else{
						$("#regUserName").parent('.form-group').removeClass('has-success').addClass('has-error');
						$('#alertDiv').html("用户名重复");
					}
				}
			});
		});
		$('#regUserEmail').blur(function(event) {
			thisitem=$(this);
			email=regForm.email.value;
			reg=new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
			//alert(reg.test(email));
			if(reg.test(email)){
				$.ajax({
					url:'checkEmail.php',
					method:'get',
					data:"email="+email,
					dataType:'html',
					success:function(response){
						if(response=='0'){
							$('#alertDiv').html("");
							thisitem.parent('.form-group').removeClass('has-error').addClass('has-success');
							emailflag=true;
						}else{
							thisitem.parent('.form-group').removeClass('has-success').addClass('has-error');
							$('#alertDiv').html("email重复");
						}
					}
				});
			}
			else{
				$("#alertDiv").html("email错误");
			}
			/* Act on the event */
		});
		$('#regPwd').keydown(function(event) {
			/* Act on the event */
				pwdlen=regForm.password.value.length;
				if(pwdlen<6||pwdlen>18){
					$('#alertDiv').html("密码长度过长或过短");
					passwordflag=false;
					$(this).parent('.form-group').removeClass('has-success').addClass('has-error');
				}else{
					$('#alertDiv').html("");
					passwordflag=true;
					$(this).parent('.form-group').removeClass('has-error').addClass('has-success');
				}
			});
		$('#regPwd2').keyup(function(event) {
			/* Act on the event */
				pwdlen=regForm.password.value;
				pwd2len=regForm.passwordrep.value;
				if(pwdlen!==pwd2len){
					$('#alertDiv').html("两次密码输入不一样");
					password2flag=false;
					$(this).parent('.form-group').removeClass('has-success').addClass('has-error');
				}else{
					$('#alertDiv').html("");
					password2flag=true;
					$(this).parent('.form-group').removeClass('has-error').addClass('has-success');
				}
				
			});
		$('#registerSubmit').click(function(event) {
			event.preventDefault();
			if(passwordflag&&password2flag&&userNameflag&&emailflag&&userName2flag){
				var userName=regForm.userName.value;
				password=regForm.password.value,
				email=regForm.email.value,
				data="userName="+userName+"&password="+password+"&email="+email;
			   $.ajax({
			   		url:'register.php',
			   		method:'post',
			   		data:data,
			   		dataType:"html",
			   		success:function(response){
			   			console.log(response);
			   			if(response){
				   			$("#register").modal('hide');
				   			$("#entry").modal('show');	
			   			}
			   		}
			   });
			}

		});
	}	
	
	function getReq(name) {
	    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	    var r = window.location.search.substr(1).match(reg);
	    if (r != null) return unescape(r[2]); return null;
    }
	function entry(){
		$("#entrySubmit").click(function(event){
			event.preventDefault();
			var userName=entryForm.userName.value;
			var password=entryForm.password.value;
			data="userName="+userName+"&password="+password;
			$.ajax({
				url:'entry.php',
				method:'post',
				data:data,
				dataType:'html',
				success:function(response){
					console.log(response);
					if(response==0){
						window.location.reload();
					}
                    if(response==1){
                        window.alert("密码错误！");
                    }
                    if(response==2){
                        window.alert("账户名不存在！");
                    }
				}
			})
		});
	}
	function addBackColor(){
		$(".indexitem").mouseenter(function(){
	       	$(this).find('.title').removeClass('notchosen').addClass('chosen');
	    	$(this).mouseleave(function(){
	      		$(this).find('.title').removeClass('chosen').addClass('notchosen');
		  	});
	  	});
	}
	function publishData(id,link){
		$('#publishData').click(function(event) {
			/* Act on the event */
			var title=formupload.title.value,
				imgs=[],
				imgStr='',
				type=getRadioBoxValue(),
				comment=formupload.comment.value,
				main_pic=$('.taobao-item-wrap-image img').attr('src');
				$('.other-img-ul img').each(function(){
					imgs.push($(this).attr('src'));
				});
				console.log(id);
				console.log(comment);
				imgStr=imgs.join(',')
				$.ajax({
					url: 'publishItem.php',
					type: 'GET',
					dataType: '',
					data: {
							taobaoid: id,
							link:link,
							main_pic:main_pic,
							type:type,
							imgs:imgStr,
							title:title,
							comment:comment
						}
				})
				.done(function(response) {
					location.href="show.php?id="+response;
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
		});
	};
	function addAdmire(){
		if(getReq('id')){
			$('.like').mouseenter(function(event) {
			/* Act on the event */
			var heart=$(this).children('.glyphicon-heart');
			$(this).children('.addadmire').removeClass('visibility-hide');
			if(heart.hasClass('color-red')){
				heart.removeClass('color-red').addClass('color-grey');
			}else{
				heart.addClass('color-red');
			}

			$(this).mouseleave(function(event) {
				/* Act on the event */
				$(this).children('.glyphicon-heart').removeClass('color-red');
				$(this).children('.addadmire').addClass('visibility-hide');
				if(heart.hasClass('color-grey')){
					heart.removeClass('color-grey').addClass('color-red');
				}
				});
			});
		}	
		$('.like').click(function(){
			//console.log('click');
			var like=$(this),
				id=getReq('id')||$(this).attr('showid');
			$.ajax({
				url: 'addAdmire.php',
				type: 'get',
				dataType: 'html',
				data: {
					id:id
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function(response) {
				//console.log(response);
				if(getReq('id')){
					$('.like .like-num').html("喜欢 "+response);
						 location.href='show.php?id='+id;
					
				}else{
					if(response=='error'){
						location.href="entryForm.php";
					}else{
						heart=like.children('.glyphicon-heart');
						like.parents('.caption').find('.like-num').html(response);
						if(heart.hasClass('color-red')){
							heart.removeClass('color-red').addClass('color-black');
						}else{
							heart.removeClass('color-black').addClass('color-red');
						}
					}
					
				}
			});	
				
		})

	}
	function modifyItem(){
		$('.other-img-ul .glyphicon-ok').bind("click",function(){
			$('.other-img-ul .glyphicon-ok').removeClass('font-color-black').addClass('main');
			$(this).removeClass('main').addClass('font-color-black');
			var main=$(this).parents('li').children('img').attr('src');
			//alert(main);	
			$('.taobao-item-wrap-image img').attr("src",main);
		});
		$('.other-img-ul .glyphicon-remove').bind("click",function(){
			//alert($(this).siblings().hasClass('font-color-black'))
			if($(this).siblings().hasClass('font-color-black')){
				$(this).parents('li').remove();
				var firstli=$('.other-img-ul').children('li').eq(0);
					firstli.find('.glyphicon-ok').removeClass('main').addClass('font-color-black');
				var main=firstli.children('img').attr('src');
				$('.taobao-item-wrap-image img').attr('src',main);
			}
			$(this).parents('li').remove();	
		});
	}
	function getRadioBoxValue(){
		var node=$(':radio');
		for(var i=0,max=node.length;i<max;i++){
			if(node[i].checked){
				return node[i].value;
			}
		}
		return "undefined";
	}
	function addItemToModal(title,main_pic,imgs,link,id){
		console.log(imgs.length);
		formupload.title.value=title;
		var ul=$('.other-img-ul'),
		i,max,
		p=$("<p class='img-info'>"+
			"<span class='glyphicon glyphicon-remove delete'></span>"+
            "<span class='glyphicon glyphicon-ok main'></span>"+
             "</p>");
		ul.html("");
		$('.taobao-item-wrap-image img').attr("src",main_pic);
		for(i=0,max=imgs.length;i<max;i++){
			img=$("<img src='"+imgs[i]+"'/>");
			li=$("<li></li>");
			li.append(img);
			ul.append(li);
		}	
		ul.children('li').append(p);
		$('.other-img-ul .glyphicon-ok').eq(0).removeClass('main').addClass('font-color-black');
		modifyItem();
		publishData(id,link);
	}
	function getNewTaobaoItem(){
		$("#searchByUrl").click(function(event){
			event.preventDefault();
			var url=geturl.url.value,
				id=getId(url),
				title,
				imgs=[],
				id,
				link,
				res,
				index,
				item,
				data="id="+id;
				$.ajax({
					url:'getTaobaoItem.php',
					method:'get',
					data:data,
					dataType:'json',
					ajaxsend:function(){
						console.log("sending...");
					},
					success:function(res){
						//eval("res="+response);
						//console.log('1='+response);
						item=res.item_get_response.item;
						title=item.title;
						mainPic=item.pic_url;
						for(i=0,max=item.item_imgs.item_img.length;i<max;i++){
							imgs[i]=item.item_imgs.item_img[i].url;
						};
						link=item.detail_url;
						id=item.num_iid;
						addItemToModal(title,mainPic,imgs,link,id);
					}
				});
		});
	}
	function getId(url){
		var strs=[],i;
			strs=url.split("&");
			for(i in strs){
				if(strs[i].substring(0,2)==="id"){
					return strs[i].substring(3);
				}
			}
	}
	function showComment(){
		$('.comment-item').mouseenter(function(event) {
			/* Act on the event */
			//alert(['test']);
			$(this).find('.comment-plus').removeClass('comment-hide');
			$(this).mouseleave(function(event) {
				/* Act on the event */
				$(this).find('.comment-plus').addClass('comment-hide');
			});
		});
	}
	function switchTab(){
		$('#xxx a').click(function (e) {
			  //alert('test');
			  e.preventDefault();
			  $(this).tab('show');
			})
	}
	function openupload(){
		imgUp.submit();
	}

	function resetPassword(){
		var passwordflag=false,
		password2flag=false;
		$('#Password2').keydown(function(event) {
			/* Act on the event */
				pwdlen=modifyPwd.passwordnew.value.length;
				console.log(pwdlen);
				if(pwdlen<6||pwdlen>18){
					$('#xDiv').html("密码长度过长或过短");
					passwordflag=false;
					$(this).parents('.form-group').removeClass('has-success').addClass('has-error');
				}else{
					$('#xDiv').html("");
					passwordflag=true;
					$(this).parents('.form-group').removeClass('has-error').addClass('has-success');
				}
			});
		$('#Password3').keyup(function(event) {
			/* Act on the event */
				pwdlen=modifyPwd.passwordnew.value;
				pwd2len=modifyPwd.passwordnewrep.value;
				if(pwdlen!==pwd2len){
					$('#xDiv').html("两次密码输入不一样");
					password2flag=false;
					$(this).parents('.form-group').removeClass('has-success').addClass('has-error');
				}else{
					$('#xDiv').html("");
					password2flag=true;
					$(this).parents('.form-group').removeClass('has-error').addClass('has-success');
				}
			});
		$("#modifyPassword").click(function(event) {
			event.preventDefault();
			if(passwordflag&&password2flag){
				pwdOld=modifyPwd.passwordold.value;
				pwdNew=modifyPwd.passwordnew.value;
				pwdNewRep=modifyPwd.passwordnewrep.value;
				modifyPwd.submit();
			}
			
			/* Act on the event */
		});
	}
	function setting(){
		resetPassword();
		$('#faceimg').mouseenter(function(event) {
		    $(this).addClass('background-70');
		    $(this).mouseleave(function(event) {
		    	$(this).removeClass('background-70');
		    });
		});
		$('#myTab a').click(function (e) {
			  e.preventDefault();
			  $(this).tab('show');
			})
	$('.edit-des').click(function(){
		var form=$("<form  id='update-des-form'method='get' action='updatedes.php'></form>"),
			text=$('.main-des').html(),
			input=$("<input type='text' name='des' value='"+text+"'/>");
			button=$("<span class='glyphicon glyphicon-ok'> </span><span class='glyphicon glyphicon-remove'> </span>");
			form.append(input);
			form.append(button);
		$('.show-des').html(form);
		$('.show-des .glyphicon-ok').click(function(event) {
			/* Act on the event */
			$('#update-des-form').submit();
		});
		$('.show-des .glyphicon-remove').click(function(event) {
			location.reload();
		});
	});
	}
	collection();
	function collection(){
		$('#addCollectionList').click(function(event) {
			/* Act on the event */
			ul=$("#collectionListUl");
			event.preventDefault();
			$.ajax({
				url: 'addCollectionList.php',
				type: 'get',
				dataType: 'html',
				data: {
					title:collectionAddForm.list.value
				},
			})
			.done(function(response) {
				console.log(response);
				collectionAddForm.list.value="";
				ul.append("<li><a class='collectionLink'>"+response+"</a></li>");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});
		$('.collectionLink').click(function(){
			var me=$(this);
			//id=$(this).attr('collectionid');
			//console.log(id);
			hanfuid=getReq('id');
			if(me.hasClass('collection-link-chosen')){
				//delete
				me.removeClass('collection-link-chosen');
			}else{
				//add
				me.addClass('collection-link-chosen');
			}
			var id=me.attr('collectionid');
				$.ajax({
					url: 'addtoCollection.php',
					type: 'get',
					dataType: 'html',
					data: {
						id: id,
						hanfuid:hanfuid
					}
				})
				.done(function(response) {
					console.log(response);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			
		});
	}
function createAdmireItem(option){
	var item=option.item;//object
	var ajaxUrl=option.url;
	item.each(function(){
		var that = $(this);
		var countable=that.attr("admire-count");//boolean
		var type=that.attr("admire-type");//string
		var itemId=that.attr("admire-itemId");//string or number
		var initNum=that.attr("admire-num");//number
		var admired=that.attr('admire-admired');//boolean
		var content=$("<span  class='vin_admire '><span class='glyphicon glyphicon-heart'></span></span><span class='vin_count'>"+initNum+"</span>");
		if(admired=="1" || admired=="true")
			content.find(".glyphicon-heart").addClass('vin_admired');
		else
			content.find(".glyphicon-heart").addClass('vin_notAdmired');
		that.append(content);
	});
	item.click(function(event){
		var adm=$(this);
		var heart=$(this).find(".glyphicon-heart");
		if(heart.hasClass('vin_admired')){
			heart.removeClass('vin_admired').addClass('vin_notAdmired');
		}else{
			heart.removeClass('vin_notAdmired').addClass('vin_admired');
		}
		$.ajax({
			url:ajaxUrl,
			method:'get',
			data:
			{
				itemId:$(this).attr("admire-itemId"),
				type:$(this).attr("admire-type"),
			},
			dataType:'html',
			success:function(response){
				console.log(response);
				if(response >= 0 )
					adm.find(".vin_count").html(response);
				
			},
			error:function(error){
				console.log(error);
			}
		});
	});
}

//});