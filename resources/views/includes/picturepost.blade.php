<?php
    $files = File::allFiles('uploads/'.$post->user->username.'/'.$post->id);
    $count=count($files);
?>
<div id="{{ $post->id }}" data-postid="{{ $post->id }}" class="grid-item post">
  <div class="timeline-block">
    <div class="panel panel-default">
      <div class="panel-heading {{ $count==1 ? 'transparent-header' : '' }}">
        <div class="media">
          <div class="media-left">
            <a href="{{ route('get.profile',['username'=>$post->user->username]) }}">
              <img src="{{ URL::to('uploads/avatars') }}/{{ $post->user->avatar }}" class="media-object">
            </a>
          </div>
          <div class="media-body">
            @if(Auth::user()==$post->user)
              <div class="dropdown pull-right">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a class="edit_post" data-postid="{{ $post->id }}" >Edit</a></li>
                  <li><a class="del_post" data-postid="{{ $post->id }}" >Delete</a></li>
                </ul>
              </div>
            @endif
            <div style='margin-top:5px' class='creator'>
              <a  href="{{ route('get.profile',['username'=>$post->user->username]) }}" style="display:inline">{{ ucfirst($post->user->first_name) }}</a>
              <br>
              <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
            
          </div>
        </div>
      </div>

      <div class="panel-body">
        
        <div id="upload-images" class="zoom-gallery">
          <?php
            $files = File::allFiles('uploads/'.$post->user->username.'/'.$post->id);
            $count=count($files);
            $counter=1;
            if($count>3){
              $extra=$count-3;
            }
            foreach ($files as $file){
              if($counter<4){
                ?>
                <a href="<?php echo $file ?>">
                 <img src="<?php echo $file ?>" alt="" style="width:80px;height:80px;{{ $count==1 ? 'width:100%;height:auto;' : '' }}">
                </a>
                <?php
              }
              else{
                if($counter==4){
                  ?>
                  <a href="<?php echo $file ?>" class="aui"> 
                        <img src="<?php echo $file ?>">
                        <span><?php echo "+$extra"; ?></span>
                  </a>
                  <?php
                }else{
                  ?>
                  <a href="<?php echo $file ?>">
                   <img src="<?php echo $file ?>" alt="" style="width:80px;{{ $counter>3 ? 'display:none' : '' }}">
                  </a>
                  <?php
                }
              }
              $counter+=1;
            }
            
          ?>
          <script>
           $(document).ready(function() {
             $('.zoom-gallery').each(function() {
                $(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                          verticalFit: true,
                          titleSrc: function(item) {
                                return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
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
        </div>
            
              <p class="{{ $post->body ? '' : 'hide' }}">{{ $post->body }}</p>
            
      </div>
      <div class="post-action">
        <div class="likes" data-postid="{{ $post->id }}" data-likecount="{{ $post->likes->count() }}">
          <i class="fa fa-thumbs-o-up like-button "></i><span>1</span>
        </div>

        <div class="comments" data-commentcount="{{ $post->replies->count() }}">
          <i class="fa fa-comments-o like-button "></i><span>{{ $post->replies->count() }}</span>
        </div>
        <div class="share">
          <i class="fa fa-share like-button "></i><span>2</span>
        </div>
      </div>
      <?php
          $comments=$post->replies()->latest()->take(4)->get()->reverse();
          //$comments= array_reverse($comments);
        ?>
      
      <ul class="comments">
       <div class="listcomment" data-parent="{{ $post->id }}">
        @include('includes.getcomments')
       </div>
        <li class="comment-form">
          <div class="input-group">
            <span class="input-group-btn">
              <a class="btn btn-default" href=""><i class="fa fa-photo"></i></a>
            </span>
            <input class="form-control post-comment" type="text" data-postid={{ $post->id }}>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<script>
var urlcom="{{ route('get.comments',['parent_id'=>415]) }}"
</script>