$(function(){
  $('.listcomment').scrollTop(1000);


  $(window).scroll(function() {
      clearTimeout($.data(this, "scrollCheck"));
      $.data(this, "scrollCheck", setTimeout(function(){
        if(($(window).scrollTop()) >= ($(document).height() - 800)) {
          var page = $('.posts').data('nextpage');
          $('.post-loading').fadeIn();
          if(page != 'no-page'){
            $.get(page, function(data){
              $('.post-loading').fadeOut();
              var $content = $( data.posts );
              $('.posts').masonry({
                cornerStampSelector: '.grid-item'
              });
              $('.posts').append( $content ).masonry( 'appended', $content );
              if(data.next_page == null){
                data.next_page = 'no-page';
              }
              $('.endlesspagination').data('nextpage', data.next_page); 
            })
          }
          else{
            setTimeout(function(){
              $('.post-loading').fadeOut();
            },3000);
          }
        }
      },350));
  });

  
  $(document).on('click', '.view-previous',function(){
      var lastid = $(this).data('nextpage');
      var parentpost = $(this).data('parent');
      $(this).css('opacity',0);
      $('.post[data-postid='+parentpost+'] .peekaboo').fadeIn();
      $.ajax({
        method : 'POST',
        url : 'comments', //url of the page to request from
        data : { lastid: lastid, parentpost : parentpost, _token: token},
        dataType: 'json',
        success : function(data){
            if(data.success==true){
                var $content = $( data['html'] ); //3 latest previous comments
                var $lastid = $( data['lastid'] );//id of the last comment fetched
                $('.listcomment[data-parent='+ parentpost +']').prepend($content);
                $('.view-previous[data-parent='+ parentpost +']').data('nextpage', data.lastid); 
                $('.view-previous[data-parent='+ parentpost +']').css('opacity',1);
                $('.post[data-postid='+parentpost+'] .peekaboo').hide();
                var d =$('.listcomment[data-parent='+ parentpost +']');
                d.scrollTop(d.prop("scrollHeight"));
                $('.listcomment[data-parent='+ parentpost +']').animate({
                   scrollTop: 0
                }, 'slow');    
            }else{
                $('.view-previous[data-parent='+ parentpost +']').css('opacity',1);
                $('.post[data-postid='+parentpost+'] .peekaboo').hide();
            }
        },
        error : function(data){
          $('.post_share').html('Post');
        }
      });
  })
  var postId=0;
  $('#share').click(function(){
    if($('#share').hasClass('pic_share')){
      $('#img_post_submit').click();
    }
    else{
      $('.post_share').attr('disabled','true');
      $('.post_share').html('Posting..').animate();
      $.ajax({
        method : 'POST',
        url : urlshare,
        data : { body: $('#share_text').val(), _token: token},
        dataType: 'json',
        success : function(data){
            var $content = $( data['html'] );
            $('.posts').masonry({
              cornerStampSelector: '.stamp'
            });
            $('.posts').append( $content ).masonry( 'prepended', $content );
            $('#share_text').val('');
            $('.post_share').html('Post');   
        },
        error : function(data){
          $('.post_share').html('Post');
        }
      });
    }
  });
  $(document).on('click', '.del_post',function(event){
    postId=event.target.dataset['postid'];
    //alert(postId);
    swal({
        title: "Delete?",
        text: "Delete your post?",
        type: "error",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function(){
      $.ajax({
          method : 'POST',
          url : urldelpost,
          data:{'post_id': postId ,_token:token},
          dataType: 'json',
          success : function(data){
            setTimeout(function(){
              swal({
                title: "Deleted",
                text: "Post was deleted",
                type: "success",
                timer:800,
                showConfirmButton: false,
            });
            if(data['message']=='You cannot delete this post.'){
              alert(data['message']);
            }
            else if(data['message']=='Post Deleted.'){
              $('.posts').masonry({
                cornerStampSelector: '.stamp'
              });
              if(data['type']=='reply'){
                $('.posts .grid-item .comments .comment[data-commentid='+ postId +']').css({
                  'transform' : 'scale(0)',
                  'background' : '#c54444',
                  //'height' : '0px',
                });
                setTimeout(function(){
                  $('.posts .grid-item .comments .comment[data-commentid='+ postId +']').remove();
                  $('.posts').masonry();
                },500);

              }else{
                var obj=$('.posts .grid-item[data-postid='+ postId +']');
                $('.posts').masonry( 'remove', obj )
                // layout remaining item elements
                .masonry('layout');
              }
            }
            },1000);
          }
      });
    });
    
  });

$(document).on('click', '.post-action .likes',function(event){
    event.preventDefault();
    postId=$(this).data('postid');
    $(this).parent('div').append("<div class='overlay'></div>");
    likecount =$(this).data('likecount');
    $this= $(this);
    if(1==1){
      if($this.hasClass('clicked')){
        $this.data('likecount', likecount - 1);
        $this.children('span').html(likecount - 1);  
        $this.toggleClass('clicked');
        $newcount = likecount - 1;
        $this.toggleClass('animated bounceIn').delay(1000).queue(function(next){
        $this.removeClass("animated bounceIn");
            next();
        });
      }else{
        $this.toggleClass('clicked');
        $this.data('likecount', likecount + 1);
        $this.children('span').html(likecount + 1);
        $newcount = likecount + 1;
        $this.toggleClass('animated bounceIn').delay(1000).queue(function(next){
        $this.removeClass("animated bounceIn");
            next();
        });
      }
      $.ajax({
        method : 'POST',
            url : urllike,
            data:{'postId': postId, _token : token},
            dataType: 'json',
            success : function(data){
              if(data['title'] == 'Liked'){
                $this.data('likecount', likecount + 1);
                $this.children('span').html(likecount + 1);
              }
              else if(data['title'] == 'Deleted'){
                $this.data('likecount', likecount - 1);
              }
              setTimeout(function(){
                $this.parent('div').children(".overlay").remove();
              },1000);
            },
            error: function () {$(this).parent('div').children(".overlay").remove();
              setTimeout(function(){
                $this.parent('div').children(".overlay").remove();
                if($this.hasClass('clicked')){
                  $this.data('likecount', $newcount - 1);
                  $this.children('span').html($newcount - 1);  
                  $this.toggleClass('clicked');
                }else{
                  $this.toggleClass('clicked');
                  $this.data('likecount', $newcount + 1);
                  $this.children('span').html($newcount + 1);
                }
              },2000);
            }
      })
    }
  });

  $(document).on('click','.edit_post',function(){
    postId=event.target.dataset['postid'];
    var postBody=$('.posts .grid-item[data-postid='+ postId +'] .panel-body p').text();
    //alert(postId);
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
    $('.modal-body .form-control').focus();
  })
  $(document).on('click','.update-info',function(){
    //var postBody=$('.posts .grid-item[data-postid='+ postId +'] .panel-body p').text();
    //alert(postId);
    //$('#post-body').val(postBody);
    $('#edit-info').modal();
    //$('.modal-body .form-control').focus();
  })
  $(document).on('click','.edit-info',function(){
    //var postBody=$('.posts .grid-item[data-postid='+ postId +'] .panel-body p').text();
    //alert(postId);
    //$('#post-body').val(postBody);
    $('#edit-info').modal();
    //$('.modal-body .form-control').focus();
  })
  $(document).on('click','.edit_comment',function(){
    postId=event.target.dataset['commentid'];
    var postBody=$('.posts .grid-item .comments .comment[data-commentid='+ postId +'] span').text();
    //alert(postBody);
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
  })
  $('#post-save').click(function(){
    $.ajax({
      method : 'POST',
      url : editurl,
      data : { body: $('#post-body').val(), postId: postId, _token: token}
    })
    .done(function(msg){
      if(msg['error']){
        alert(msg['error']);
      }else{
        if(msg['type']=='post'){
          $('.posts .grid-item[data-postid='+ postId +'] .panel-body p').text(msg['new_body']);
          $('#edit-modal').modal('hide');
          
        }else{
          $('.posts .grid-item .comments .comment[data-commentid='+ postId +'] .media-body span').text(msg['new_body']);
          $('#edit-modal').modal('hide');
        }
      }
    });
  });
  $('#info-save').click(function(){
    var gender;
    var year=$('#year').val();
    var month=$('#month').val();
    var day=$('#day').val();
    var dob=year + '-' + month + '-' + day
    var location=$('.address').val();
    if($('#male').is(':checked')){
      gender='male';
    }else if ($('#female').is(':checked')) {
      gender='female';
    }
    $.ajax({
      method : 'POST',
      url : urlinfo,
      data : {dob:dob, gender:gender, location:location, _token: token}
    })
    .done(function(msg){
      if(msg['error']){
        alert(msg['error']);
      }else{
        if(msg['html']){
          $('#edit-info').modal('hide');
        }else{
          $('.posts .grid-item .comments .comment[data-commentid='+ postId +'] .media-body span').text(msg['new_body']);
          $('#edit-modal').modal('hide');
        }
      }
    });
  });
  
  $(document).on('keydown','.post-comment',function(event){
    var value=$(this).val();
    if(event.which==13){
      $(this).val('');
      if(value!=''){
          postId=event.target.dataset['postid'];
          $.ajax({
            method : 'POST',
            url : reply,
            data : { reply: value, postId: postId, _token: token},
            dataType : 'json',
            success : function(data){
              if(data['html']=='Post does not exist.'){

              }else{
                $('.posts .grid-item[data-postid='+ postId +'] .comments .listcomment').append(data['html']);
                $('.posts .grid-item[data-postid='+ postId +'] .comments .listcomment .comment[data-commentid='+ data['id'] +']').css({
                  'transform':'scale(0)',
                });
                $('.posts .grid-item[data-postid='+ postId +'] .comments .listcomment').animate({ scrollTop: $('.posts .grid-item[data-postid='+ postId +'] .comments .listcomment').prop("scrollHeight")}, 1000);
                
                setTimeout(function(){
                  $('.posts .grid-item[data-postid='+ postId +'] .comments .comment[data-commentid='+ data['id'] +']').css({
                    'transform':'scale(1)',
                  });
                  $('.post-comment[data-postid='+ postId +']').val('');
                  $('.posts').masonry({
                     cornerStampSelector: '.stamp'
                  });
                },100);
              }

            }
          });
    }
  }
  })
  $('.add_user').click(function(event){
    var username=event.target.dataset['username'];
    //alert(urladdfriend);
    $.ajax({
      method : 'POST',
      url : urladdfriend,
      data:{'username': username ,_token:token},
      dataType: 'json',
      success : function(data){
        if(data['new_body']=='Request Sent.'){
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
        else if (data['new_body']=="Friend request pending.") {
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
    });
  });
  $('.accept_user, .accept-request').click(function(event){
    var username=event.target.dataset['username'];
    var home = false;
    if($(this).attr('class')=='accept-request'){
      home=true;
    }
    //alert(username);
    $.ajax({
      method : 'POST',
      url : urlaccept,
      data:{'username': username ,_token:token},
      dataType: 'json',
      success : function(data){
        if(home){
          $('.request_list li[data-username='+ username +']').css({
            'transform' : 'scale(0)',
            'background' : 'rgba(0, 170, 0, 0.83)',
          });
          setTimeout(function(){
            $('.request_list li[data-username='+ username +']').remove();
          },1000);
        }else{
         if(data['new_body']=='done'){
            $('.accept_user').css({
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
            $('.accept_user').html('Accepted');
            $('.accept_user').delay(1000).hide('explode',1000);
         }
        } 
      }
    });
  });
  $('.remove_user').click(function(event){
    var username=event.target.dataset['username'];
    //alert(username);
    $.ajax({
      method : 'POST' ,
      url : unfriend ,
      data:{'username': username ,_token:token},
      success : function(data){
        alert(data['msg']);
      }
    });
  });
  function getRequest(){
    $.get('getrequest', function(data){
      var $content = data['html'];
      $('.request_list').html( $content );
    });
  }
  //getRequest();
  
});
