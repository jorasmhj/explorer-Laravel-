$(document).ready(function(){
	$('.album-uploader').click(function(){
		$("#upload-album").click();	
	})
	
	var input = $('#upload-album'),
      formdata = false;
    
  if (window.FormData) {
    formdata = new FormData();
   // document.getElementById("btn3").style.display = "none";
  }

  input.change(function(){
  	album_name=$('.album-name').val();
  	if(!album_name){
  		alert("You should Name your album.");
  		$('.album-name').focus();

  	}else{
	    var i = 0, len = input.length, img, reader, file;
	    
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
	      }else{
	      	alert();
	      } 
	    }

	    if (formdata) {
	    	//$('.pro_pic').attr('src','assets/images/loading.gif');
		  $.ajax({
		    url: "../friendster/ajax/album_uploader.php?album_name="+album_name,
		    type: "POST",
		    data: formdata,
		    processData: false,
		    
		    contentType: false,
		    /*beforeSend: function() {
		    	$('.status').width('0%');
			},
		    uploadProgress: function(event, position, total, percentComplete) {
		      //var pVel = percentComplete + '%';
		      //$('.status').width(pVel);
		      alert();
		    },*/
		    success: function (res) {
			$('.create_new_album, .new_album_info').fadeOut();
			alert(res);
		    }
		  });
		}
	}
  });
})


// make a function so that when upload is clicked...it runs the code to upload th album