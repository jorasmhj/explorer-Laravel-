$(function(){
	$('.cover-uploader').click(function(){
		$('#upload-cover').click();
	});
	var input = document.getElementById("upload-cover"),
      formdata = false;
    
  if (window.FormData) {
    formdata = new FormData();
    document.getElementById("btn").style.display = "none";
  }

  if (input.addEventListener) {
  input.addEventListener("change", function (evt) {
    var i = 0, len = this.files.length, img, reader, file;
    
    
    
    for ( ; i < len; i++ ) {
      file = this.files[i];
  
      if (!!file.type.match(/image.*/)) {
      	if ( window.FileReader ) {
		  reader = new FileReader();
		  
		  reader.readAsDataURL(file);
		}
		if (formdata) {
		  formdata.append("images[]", file);
		}
      } 
    }

    if (formdata) {
    	$('.cover-image img').attr('src','assets/images/loading.gif');
	  $.ajax({
	    url: "../friendster/ajax/upload.php",
	    type: "POST",
	    data: formdata,
	    processData: false,
	    contentType: false,
	    success: function (res) {
	
		$('.cover-image img').attr('src',res);
	

	    }
	  });
	}
      
  }, false);
}


});