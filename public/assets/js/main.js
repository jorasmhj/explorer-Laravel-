$(window).load(function(){
	$(".signup").click(function() {
	    $('.main').css('transform','translatex(-50%)');
	});

	$(".signin").click(function() {
	    $('.main').css('transform','translatex(0%)');
	});
    
      $(".show-password").bind("click",function() {
          if($(this).hasClass('show')){
              $(this).css('color','#34a2ef');
              $(this).removeClass('fa-eye-slash');
              $(this).removeClass('show');
              $('#login_password').attr('type','password');  
          }else{
              $(this).css('color','#828282');
              $(this).addClass('fa-eye-slash');
              $(this).addClass('show');
              $('#login_password').attr('type','text');  
          }
	    
	});
    

	//setInterval(check_request,4000);
	$('.another-user').click(function(){
		$('.pwd_err').hide(700);
		$("form").submit(function(e){
			 e.preventDefault(e);
        });
		$('#login_username').val('');
		$('#login_username').css('display','inline');
		$('.user_pic').hide('500');
		$('.another-user').hide('500');

	});

	$('#signup_dob').focusout(function(){
		error_msg('#signup_dob','Enter your DOB');
	});

	$('#signup_username,#signup_password').focusout(function(){
		a=$(this).val().trim();
		if(a.length<5){
                $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
                $(this).addClass('animated shake');
		}else{
                $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px green');
                $(this).removeClass('animated shake');
            }
	});
    
      $('#signup_fname,#signup_lname').focusout(function(){
		a=$(this).val().trim();
		if(a.length<2){
                $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
                $(this).addClass('animated shake');
		}else{
                $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px green');
                $(this).removeClass('animated shake');
            }
	});
    
      $(document).on('keyup','#signup_email',function(){
          var a = $(this).val().trim();
		var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (testEmail.test(a)){
                $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px green');
                $(this).removeClass('animated shake');
            }
      });
    
      $('#signup_email').focusout(function(){
	   	var a = $(this).val().trim();
		var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (testEmail.test(a)){
                $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px green');
                $(this).removeClass('animated shake');
            }else{
                $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
                $(this).addClass('animated shake');
            }
	});
      
      $(document).on('submit','.signup-form',function(e){
          var fname = $('#signup_fname').val().trim();
          var lname = $('#signup_lname').val().trim();
          var email = $('#signup_email').val().trim();
          var username = $('#signup_username').val().trim();
          var password = $('#signup_password').val().trim();
          var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
          if(fname.length<2 || lname.length<0 || !testEmail.test(email) || username.length<5 || password.length<5){
            e.preventDefault();
            if(fname.length < 2){
                $('.signup_fname').css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
            }
            if(lname.length < 2){
                $('.signup_lname').css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
            }
            if(username.length < 5){
                $('.signup_username').css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
            }
            if(password.length < 5){
                $('.signup_password').css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
            }
            if(!testEmail.test(email)){
                $('.signup_email').css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px red');
            }
          }else{
            $('.signup-input button[type=submit]').html("<div class='peekaboo'></div>");
              $('.signup-input button[type=submit] .peekaboo').show();
              $('.signup-input button[type=submit]').css('float','none');
            $('.signup-input button[type=submit]').attr('disabled','1');
            $('.signup-input button[type=submit]').css('background','none');
              
          }
      });
    
      $(document).on('keyup','#signup_fname,#signup_lname',function(){
          var value=$(this).val().trim();
          if(value.length >= 2){
              $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px green');
              $(this).removeClass('animated shake');
          }
      })
    
      $(document).on('keyup','#signup_username,#signup_password',function(){
          var value=$(this).val();
          if(value.length >= 5){
              $(this).css('box-shadow','inset 0 1px 1px rgba(102, 175, 233, .6), 0 0 8px green');
              $(this).removeClass('animated shake');
          }
      })

	$('#signup_password').focusout(function(){
		error_msg('#signup_password','Enter Password');
		a=$('#signup_password').val().trim();
		if(a.length<5 && a.length!=0){
			$('#signup_password_err').html('Must be more than 5 characters');
			buzz('#signup_password_err');
			$('#signup_password_err').fadeIn(500);
		}
	});

	$('#signup_password_c').focusout(function(){
		a=$(this).val();
		b=$('#signup_password').val();
		if(a!=b){
			$('#signup_password_c_err').html('Didnt Match.');
			$('#signup_password_c_err').css('padding','3');
			$('#signup_password_c_err').fadeIn(500);
			buzz('#signup_password_c_err');
		}else{
			$('#signup_password_c_err').fadeOut(500);
		}
	});

	$(window).scroll(function(){
		if($(window).scrollTop()>325){
			$('.scrolltop').fadeIn(1000);
		}
		if($(window).scrollTop()<125){
			$('.scrolltop').fadeOut(1000);
		}
		if($(window).scrollTop()>5){
			$('.main-menu').css('padding-top',0);
			$('.main-menu').addClass('important');
			$('.main-menu').css('height','50px');
			$('.main-menu').css('box-shadow','0px 1px 2px rgba(0, 0, 0, 0.15)');
			$('.navbar-brand').css('letter-spacing','0');
			$('.list').css('letter-spacing','2px');
			$('.menu-list li .border').css('background','#fff');
			$('.menu-list li a').css('color','#fff');
		}
		if($(window).scrollTop()<30){
			$('.main-menu').css('padding-top',25);
			$('.main-menu').css('height','80px');
			$('.main-menu').css('box-shadow','none');
			$('.main-menu').removeClass('important')
			$('.navbar-brand').css('letter-spacing','5px');
			$('.list').css('letter-spacing','3px');
			$('.menu-list li a').css('color','#000');
			$('.menu-list li .border').css('background','#26A69A');
		}
	});

	$('.add-event').click(function(){
		$('.event-maker').css('z-index',10000);
		$('.event-maker').css('transform','scale(1)');
		$('.event-box').addClass('show');
	});

	$('.event-maker').click(function(){
		$('.event-maker').css('z-index',-1);
		$('.event-maker').css('transform','scale(0)');
		$('.event-box').removeClass('show');
	});

	$('.scrolltop a').click(function(){
		$('.scrolltop').fadeOut(1000);
		$('html, body').animate({
	        scrollTop: 0
	    });
	});

	$('.custom-search').click(function(){
		$('.menu-search-form').css('opacity',1);
		$('.menu-search-form-input').focus();
	});
	$('.menu-search-form-input').focusout(function(){
		$('.menu-search-form').css('opacity',0);
	});
	$('.select-img').click(function(){
		$('.browse-img').click();
	});

	$('.chat').click(function(){
		$('.chat').addClass('show').bind(function(){
			alert();
		});
	});

	$('#dob').datepicker();
	$('#signup_dob').datepicker();
	$('#event_date').datepicker();
        $(".grid").ready(function(){
          $('.posts').masonry({
            // set itemSelector so .grid-sizer is not used in layout
                itemSelector: '.post',
                stamp : '.stamp',
            // use element for option
                transitionDuration: '1.5s',
            //percentPosition: true
          });
});
});


function view_albums(owner){
	$('#album').html("<img src='assets/images/loading.gif' style='width:150px'>");
	setTimeout(function(){
		$.ajax({
			url: "ajax/view_albums.php?u="+owner,

		})
		.done(function(data){
			$('#album').html(data);
			setTimeout(function(){
				$('.grid').masonry({
				  // set itemSelector so .grid-sizer is not used in layout
				  itemSelector: '.grid-item6',
				  // use element for option
				  transitionDuration: '1.5s'
				  //percentPosition: true
				});
			},1);
		});
	},500);
}

function rem(id){
    var obj = $('#'+id); // item is the product id# but also the div id#
    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
	    }else{
	        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	    }
	    xmlhttp.onreadystatechange=function(){
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	        	result=xmlhttp.responseText;

	        }
	    }
	    xmlhttp.open('GET','ajax/rem_post.php?id='+id,true);
	    xmlhttp.send();
 $('.grid').masonry('remove',obj);
$('.grid').masonry({
  // set itemSelector so .grid-sizer is not used in layout
  itemSelector: '.grid-item',
  // use element for option
  transitionDuration: '1.5s'
  //percentPosition: true
});

}

function add(){
	var $boxes = $('<div class="grid-item" style="height:200px;">sasd</div>');
	$('.posts').prepend( $boxes ).masonry( 'prepended', $boxes, true );
	//$('.grid').masonry( 'destroy' );
	$('.grid').masonry({
	  // set itemSelector so .grid-sizer is not used in layout
	  itemSelector: '.grid-item'
	  // use element for option
	  //transitionDuration: '0.8s',
	  //percentPosition: true
	});
}

function share_post_check(){
	a=$('#share_text').val();
	a=a.trim();
	if(a!=''){
		a=a.replace(/\n/g,"<br>");
		$('#share').removeAttr('disabled');
	}else{
		$('#share').attr('disabled','true');
	}
}

function edit_about(){
	if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
	    }else{
	        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	    }
	    xmlhttp.onreadystatechange=function(){
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	        	result=xmlhttp.responseText;
	        	$('.profile-about').html(result);
	        }
	    }
	    xmlhttp.open('GET','ajax/edit_about.php',true);
	    xmlhttp.send();
}

function update_about(){
	var dob=$("#signup_dob").val();
	var job=$("#job").val();
	gender="";
	if($('#male').is(':checked')){
		gender='male';
	}
	if($('#female').is(':checked')){
		gender='female';
	}
	address=$("#address").val();

}

function share_post(to){
	a=$('#share_text').val();
	a=a.replace(/\n/g,"<br>");
	a=a.replace('#',"hashtag");
	a=a.trim();
	if(a!=''){
		var param = "text="+a+"&to="+to;
		$.ajax({
		  url: 'ajax/post.php',
		  data: param,
		  success: function(result) {
		    $('.posts').prepend( result );
			$('.grid').masonry( 'destroy' );
			$('.grid').masonry({
			  // set itemSelector so .grid-sizer is not used in layout
			  itemSelector: '.grid-item'
			  // use element for option
			  //transitionDuration: '0.8s',
			  //percentPosition: true
			});
		  }
		});

		$('#share_text').val('');
		$('#share').attr('disabled','true');
	}else{
		$('#share').attr('disabled','true');
	}
}

function check_request(){
	$.ajax({
		url: "ajax/check_request.php",
		dataType: 'json',
	})
	.done(function(data){
		number=data[0];
		name=data[1];
		count=data[2];
		prev_count=$('.request_list li').size();
		if(prev_count!=count){
			if(count>0){
				var audioElement = document.createElement('audio');
		        audioElement.setAttribute('src', 'new_friend1.mp3');
		        audioElement.addEventListener("load", function() {
		            audioElement.play();
		        }, true);
		        audioElement.play();
		        setTimeout(function(){
		        	audioElement.pause();
		        },1000);
	    	}

			$('friend').html(number);
			$('.request_list').html(name);
		}
	});
}

var selDiv = "";

	document.addEventListener("DOMContentLoaded", init, false);

	function init() {
		//document.querySelector('.browse-img').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#blah");

	}

	function handleFileSelect(e) {

		if(!e.target.files || !window.FileReader) return;

		selDiv.innerHTML = "";

		var files = e.target.files;
		var filesArr = Array.prototype.slice.call(files);
		var cnt=1;
		filesArr.forEach(function(f) {
			if(!f.type.match("image.*")) {
				return;
			}

			var reader = new FileReader();
			reader.onload = function (e) {

				var html = "<img src=\"" + e.target.result + "\">";
				selDiv.innerHTML += html;
				image=$('.browse-img').val();
				alert(image);
				width=100;
				if(cnt>1){
				width=250/cnt;
				}
				$('#blah img').css('width',width);
				$('#blah img').css('height',width);
				//$('#blah img').css('float','left');
				$('#blah').show('blind',1000);

				//clip,bounce,blind
				cnt +=1;
			}
			reader.readAsDataURL(f);

		});


	}

function hide_err(id){
	$(id).hide(700);
}

function error_msg(id,msg){
		a=$(id).val();
		if(a.length==0){
			$(id+'_err').html(msg);
			buzz(id+'_err');
			$(id+'_err').show(500);
		}else{
			$(id+'_err').hide(500);
		}
}

function request_response(r,i){
	if(window.XMLHttpRequest){
    xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        	result=xmlhttp.responseText;
        	if(result=='Accepted'){
        		$('.'+i+'abc').hide('slide');
        	}
        	if(result=='Rejected'){
        		$('.'+i+'abc').hide('slide',100);
        	}
        }
    }
    xmlhttp.open('GET','ajax/request_response.php?response='+r+'&id='+i,true);
    xmlhttp.send();
}

function validate_signup(){
	fname=$('#signup_fname').val();
	lname=$('#signup_lname').val();
	email=$('#signup_email').val();
	username=$('#signup_username').val();
	password=$('#signup_password').val();
	password2=$('#signup_password_c').val();
	if(fname && lname && email && username.length>4 && password.length>4 && password2.length>4 ){

			if(password==password2){
				$("form").submit(function(e){

	                e.preventDefault(e);
            	});
            	gender="";
            	if($('#c1').is(':checked')){
            		gender='male';
            	}
            	if($('#c2').is(':checked')){
            		gender='female';
            	}
            	if(gender=='male' || gender=='female'){
            		$('.login').attr('disabled',true);
					$('.login').css('background','#7A7975');
					$('.login').css('color','#fff');
					$('.login').val('Signing up..');
					$('.login').css('color','#ADADAD');
		$('.login').css('border','1px solid #ADADAD');
					if(window.XMLHttpRequest){
			        xmlhttp=new XMLHttpRequest();
				    }else{
				        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
				    }
				    xmlhttp.onreadystatechange=function(){
				        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				        	result=xmlhttp.responseText;
				        	$('.footer').html(result);

				        }
				    }
				    xmlhttp.open('GET','ajax/signup.php?fname='+fname+'&lname='+lname+'&username='+username+'&email='+email+'&pwd='+password+'&pwd_c='+password2+'&gender='+gender,true);
				    xmlhttp.send();
				}else{
					alert('select the gender');
				}
			}else{
				$("form").submit(function(e){

	                e.preventDefault(e);
            	});
				$('#signup_password_c_err').html('Didnt Match.');
				$('#signup_password_c_err').css('padding','3');
				$('#signup_password_c_err').fadeIn(500);
				buzz('#signup_password_c_err');
				$('#signup_password_c').focus();
			}


	}else{
		$('#signup_fname').val(fname);
		$('#signup_lname').val(lname);
		$('#signup_email').val(email);
		$('#signup_username').val(username);
	}
}



function validate_login(){
	b=$('#login_username').val();
	a=$('#login_password').val();
	$('.pwd_err,.usr_err').html('');
	$('.pwd_err,.usr_err').css('padding','0');
	$("form").submit(function(e){

	                e.preventDefault(e);
            	});
	remember='no';
	if($('#c3').is(':checked')){
		remember='yes';
	}

	if(b.length<5){
		$('#login_username').val('');
		$('.usr_err').html('Wrong Username');
		$('.usr_err').css('padding','3');
		buzz('.usr_err');
		$('.usr_err').fadeIn(100);
		}
	if(a.length<5){

		$('#login_password').val('');
		$('.loading').hide();
		$('.pwd_err').html('Wrong password');
		$('.pwd_err').css('padding','3');
		buzz('.pwd_err');
		$('.pwd_err').fadeIn(100);
	}else if(a.length>=5 && b.length>=5){
		//$('.loading').show();

		$('.pwd_err,.usr_err').html('');
		$('.login').attr('disabled',true);
		$('.login').css('background','#7A7975');
		$('.login').css('color','#fff');
		$('.login').val('Logging in..');
		$('.login').css('color','#ADADAD');
		$('.login').css('border','1px solid #ADADAD');
		if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
	    }else{
	        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	    }
	    xmlhttp.onreadystatechange=function(){
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	        	result=xmlhttp.responseText;
	        	$('.footer').html(result);

	        }
	    }
	    xmlhttp.open('GET','ajax/login.php?username='+b+'&password='+a+'&rem='+remember,true);
	    xmlhttp.send();
	}
}

function search_user(){
	a=$('.menu-search-form-input').val();
	a=a.replace('#',"hashtag");
	if($.trim(a)!=''){
		$('.menu-search-list').css('display','block');
		if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
	    }else{
	        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	    }
	    xmlhttp.onreadystatechange=function(){
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	        	result=xmlhttp.responseText;

	    		$('.menu-search-list').html(result);
	        }
	    }
	    xmlhttp.open('GET','ajax/search_user.php?input='+a,true);
	    xmlhttp.send();

	}else{
		$('.menu-search-list').css('display','none');
	}
}

function new_album(){
	$('.create_new_album, .moving-zone').fadeIn();
	$('.album-name').focus();
	setTimeout(function(){
			$('.moving-zone').css('transform','scale(1)');
	},500)


}



function cancel_alb(){
	$('.moving-zone').css('transform','scale(0)');
	$('.album-name, #upload-album').val('');
	$('.create_new_album, .moving-zone').fadeOut(1000);


}



function add_friend(user){
	if(window.XMLHttpRequest){
    xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        	result=xmlhttp.responseText;
        	if(result=='ok'){
        	  $('.add_user').css({
				'opacity' : 1,
				'border-radius' : '50%',
				'bottom' : '2px' ,
				'left' : '15px',
				'width' : '116px',
				'height' : '116px',
				'padding' : 25,
				'font-weight' : 'bold',
				'z-index' : 1000
				});
				$('.add_user').html('Friend Request Sent');
				$('.add_user').delay(1000).hide('explode',1000);
        	}
        	else if(result='already'){
        		$('.add_user').css({
				'opacity' : 1,
				'border-radius' : '50%',
				'bottom' : '2px' ,
				'left' : '15px',
				'width' : '116px',
				'height' : '116px',
				'padding' : 25,
				'font-weight' : 'bold',
				'z-index' : 1000
				});
				$('.add_user').html('Request Already Sent');
				$('.add_user').delay(1000).hide('explode',1000);
        	}
        }
    }
    xmlhttp.open('GET','ajax/friend_request.php?username='+user,true);
    xmlhttp.send();
}

function post_comment(e,id){
	comment=$("#comment-input-"+id).val();
	comment=comment.replace('#',"hashtag");
	if(e.which==13){
		if (comment.trim()) {
		$("#comment-input-"+id).val("");
		if(window.XMLHttpRequest){
	    xmlhttp=new XMLHttpRequest();
	    }else{
	        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	    }
	    xmlhttp.onreadystatechange=function(){
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	        	result=xmlhttp.responseText;
	        	$(".comment-section-"+id).append(result);
				//$('.grid').masonry( 'destroy' );
				$('.grid').masonry({
				  // set itemSelector so .grid-sizer is not used in layout
				  itemSelector: '.grid-item',
				  // use element for option
				  transitionDuration: '0.8s'
				  //percentPosition: true
				});

  					$(".comment-section-"+id+" .media:last").css({
					   'opacity' : '1',
						'transform' : 'scale(1)',
						'background' : 'none',
						'height' : '50px',
						'padding' :'5px'
					});

					setTimeout(function(){
						$(".comment-section-"+id+" .media:last").css('transform','none');
					})


	        }
	    }
	    xmlhttp.open('GET','ajax/post_comment.php?comment='+comment+'&post_id='+id,true);
	    xmlhttp.send();
		}
	}
}

function del_comment(id){
	if(window.XMLHttpRequest){
	    xmlhttp=new XMLHttpRequest();
	    }else{
	        xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	    }
	    xmlhttp.onreadystatechange=function(){
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	        	result=xmlhttp.responseText;
	        	if (result=='deleted') {
	        		//$(".comment-"+id).hide('slow');
					$(".comment-"+id).css({
						'transform' : 'scale(0)',
						'background' : '#c54444'
						//'height' : '0px'
					})
					setTimeout( function(){
						$('.comment-'+id).remove();
						$('.grid').masonry({
				  // set itemSelector so .grid-sizer is not used in layout
				  itemSelector: '.grid-item'
				  // use element for option
				  //transitionDuration: '0.8s',
				  //percentPosition: true
				});
					}  , 1000 );

	        	}else{
	        		alert(result);
	        	}
	        }
	    }
	    xmlhttp.open('GET','ajax/del_comment.php?id='+id,true);
	    xmlhttp.send();
}

function view_photos(album){
	$.ajax({
		url: "ajax/view_photo.php?album="+album,

		type:"POST",
	})
	.done(function(data){
		$('.user-album').html(data);

	});

}