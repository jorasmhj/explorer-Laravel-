$(function () {
    $('.select-img').click(function(){
      $("#browse-img").click();
    })
    $("#browse-img").change(function () {
      $('#pre-upload-images').imagesLoaded(function () {
          $('.posts').masonry({
            cornerStampSelector: '.stamp'
          });
      });
      
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#pre-upload-images");
            dvPreview.html("<a class='image-count'></a>");
            
            var count = 1;
            $("#share").removeClass('post_share');
            $("#share").addClass('pic_share');
            $('#share').removeAttr('disabled');
            $('#pre-upload-images').css('height','auto');
            $($(this)[0].files).each(function () {
                var file = $(this);
                if(count<3){
            
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var html="<a href='"+e.target.result+"'><img src='"+e.target.result+"' style='height:100px;width: 100px'></a>";
                        dvPreview.append(html);
                        dvPreview.css({
                         'transform':'scale(1)' ,
                          
                        });
                      $('#pre-upload-images').imagesLoaded(function () {
                          $('.posts').masonry({
                            cornerStampSelector: '.stamp'
                          });
                      });
                    }
                    reader.readAsDataURL(file[0]);
            
                }else{
                  var reader = new FileReader();
                  reader.onload = function (e) {
                      var html="<a href='"+e.target.result+"'><img src='"+e.target.result+"' style='display:none'></a>";
                      dvPreview.append(html);
                      dvPreview.css({
                       'transform':'scale(1)' ,

                      });
                    $('#pre-upload-images').imagesLoaded(function () {
                        $('.posts').masonry({
                          cornerStampSelector: '.stamp'
                        });
                    });
                  }
                  reader.readAsDataURL(file[0]);
                  var extra=count-2;
                  $('.image-count').css({
                    "height":"100px",
                    "width": "100px",
                    "transform":"scale(1)",
                  });
                  $('.image-count').html("+" + extra);  
                  
                }
              count=count+1;
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
});