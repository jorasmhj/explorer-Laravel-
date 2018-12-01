 <div class="comment" data-commentid="{{ $comment->id }}">
  <li class="media comment-5" style="opacity: 1; transform: none; background: none; height: 45px; padding: 5px;">
    <div class="media-left">
      <a href="{{ route('get.profile',['username'=>$comment->user->username]) }}">
      <img src="{{ URL::to('uploads/avatars') }}/{{ $comment->user->avatar }}" class="media-object">
    </a>
    </div>
    <div class="media-body">
      @if(Auth::user()==$comment->user || Auth::user() == $comment->post->user)
        <div class="pull-right dropdown" data-show-hover="li">
          <a href="#" data-toggle="dropdown" class="toggle-button">
            <i class="fa fa-pencil"></i>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a class="edit_comment" data-commentid="{{ $comment->id }}" >Edit</a></li>
            <li><a class="del_post" data-postid="{{ $comment->id }}" >Delete</a></li>
          </ul>
        </div>
      @endif
      <a  href="{{ route('get.profile',['username'=>$comment->user->username]) }}" class="comment-author pull-left">{{ ucfirst($comment->user->first_name) }}</a>
      <span>{{ $comment->body }}</span>
      <div class="comment-date">{{ $comment->created_at->diffForHumans() }}</div>
    </div>
  </li>
</div>