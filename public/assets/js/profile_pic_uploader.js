$(function(){
  $('.pro-pic-uploader').click(function(){
    $('#upload-pro-img').click();
    $('.bubble-holder').css({
      'transform':'scale(0)',
      
    });
    setTimeout(function(){
      $('.bubble-holder').remove();
    },3000);
    
  });
  var input = document.getElementById("upload-pro-img"),
  formdata = false;

  if (window.FormData) {
    formdata = new FormData();
    document.getElementById("image_submit").style.display = "none";
  }

  if (input.addEventListener) {
    input.addEventListener("change", function (evt) {
      $('#image_submit').click();
    }, false);
  }
  $('.cover-uploader').click(function(){
    $('#upload-cover').click();
  });
  var input = document.getElementById("upload-cover"),
  formdata = false;

  if (window.FormData) {
    formdata = new FormData();
    document.getElementById("cover_submit").style.display = "none";
  }

  if (input.addEventListener) {
    input.addEventListener("change", function (evt) {
      $('#cover_submit').click();
    }, false);
  }

});
