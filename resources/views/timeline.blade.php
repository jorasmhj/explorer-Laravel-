@extends('layout.master')
@section('title')
  Explore | Let's Explore
@endsection
@section('content')
<form action="" enctype="multipart/form-data" id="upload_pic_post" style="display:none">
  <input type="file" accept="image/*" style="display:none" id="browse-img" multiple name="file[]">
  <input type="text" name="body" id="get-body">
  <input type="hidden" name="_token" value="{{ Session::token() }}">
  <button type="submit" id="img_post_submit" style="display: none;">Upload Files!</button>
</form>
 <script src="{{ URL::to('assets/js/post_pic_uploader.js') }}"></script>
 <script>
  
  var form = document.getElementById('upload_pic_post');
  var request = new XMLHttpRequest();
  form.addEventListener('submit',function(e){
    var body =$('#share_text').val();
    $('#share').attr('disabled',true);
    $('#share').html('Posting..');
    $('#get-body').val(body);
    e.preventDefault();
    var formData= new FormData(form);
    request.open('post','picpost');
    request.send(formData);
    request.onreadystatechange = function(data) {
      if (this.readyState == 4 && this.status == 200) {
        response = JSON.parse(data.currentTarget.response);
        var $content = $( response.html );
        $('#share').html('Post');
        $('#share').removeClass('pic_share');
        $('#share').addClass('post_share');
        $('#share_text').val('');  
        $('#pre-upload-images').css('transform','scale(0)');
        $('#pre-upload-images').css('height','0px');
        $('.posts').imagesLoaded(function () {
            $('.posts').masonry({
              cornerStampSelector: '.stamp'
            });
            $('.posts').append( $content ).masonry( 'prepended', $content );
        });
      }
    };
  },false);
</script>
 <script>
 $(document).ready(function() {
   $('#pre-upload-images').each(function() {
      $(this).magnificPopup({
          delegate: 'a',
          type: 'image',
          closeOnContentClick: false,
          closeBtnInside: false,
          mainClass: 'mfp-with-zoom mfp-img-mobile',
          image: {
              verticalFit: true,
              titleSrc: function(item) {
                  return item.el.attr('title') + ' &middot;';
              }
          },
          gallery: {
              enabled: true
          },
          zoom: {
              enabled: true,
              duration: 300, // don't foget to change the duration also in CSS
              opener: function(element) {
                  return element.find('img');
              }
          }

      });
   });
  });
</script>
  @include('includes.cover')
  <div class="row timeline-post grid" style="position: relative; height: 159px;">
    <div class="posts endlesspagination" data-nextpage="{{ $posts->render() ? $posts->nextPageUrl() : 'no-page' }}">
        <div class="stamp grid-item" style="position: absolute; left: 0px; top: 0px;">
          <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
              What´s new
            </div>
            <form>
              <div class="panel-body share-post" style="text-align:center;padding:0px;">
                <div id="pre-upload-images" class="container">
                  <a class='image-count'></a>
                </div>
                <textarea name="body" class="form-control share-text" rows="3" id="share_text" placeholder="Share your status..." onkeyup="share_post_check();"></textarea>
              </div>
              <div class="panel-footer share-buttons" style="padding:5px 15px;z-index:0">
                <a href="#"><i class="fa fa-map-marker"></i></a>
                <a class="select-img"><i class="fa fa-photo"></i></a>
                <a href="#"><i class="fa fa-video-camera"></i></a>
                <button id="share" type="button" class="btn btn-primary btn-xs pull-right display-none post_share" style="line-height:0px; height:30px" disabled="">Post</button> <!--onclick="share_post('joras')"-->
              </div>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
          </div>
        </div>
      @include('includes.getpost')
      <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="post-body"></label>
                  <textarea name="post-body" rows="5" id="post-body" class="form-control"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="post-save">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div><!--end posts-->
  </div>
@endsection
<script>
  var urlshare="{{ route('new.post') }}";
  var urldelpost="{{ route('delete.post') }}";
  var token = "{{ Session::token() }}";
  var editurl = "{{ route('edit.post') }}";
  var reply = "{{ route('reply.post') }}" ;
</script>