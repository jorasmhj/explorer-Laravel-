<div id="{{ $post->id }}" data-postid="{{ $post->id }}" class="grid-item post">
  <div class="timeline-block">
    <div class="panel panel-default">
      <div class="panel-heading">
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
            <a  href="{{ route('get.profile',['username'=>$post->user->username]) }}" style="display:inline">{{ ucfirst($post->user->first_name) }}</a>
            <br>
            <span>{{ $post->created_at->diffForHumans() }}</span>
          </div>
        </div>
      </div>

      <div class="panel-body">
        <p>{{ $post->body }}</p>
      </div>
      
      <div class="post-action">
        <div class="likes {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? 'clicked' : '' }}" data-postid="{{ $post->id }}" data-likecount="{{ $post->likes->count() }}">
          <i class="fa fa-thumbs-o-up like-button "></i><span>{{ $post->likes->count() }}</span>
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
      <!--<div class="view-all-comments">
        <a href="#">
          <i class="fa fa-comments-o"></i> View all
        </a>
        <span>{{ $post->replies()->count() }} comments</span>
      </div>-->
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
