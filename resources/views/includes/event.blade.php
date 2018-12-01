<div id="{{ $post->id }}" data-postid="{{ $post->id }}" class="grid-item post">
  <div class="timeline-block event">
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
          <h4 style="color:#fff">{{ ucfirst($post->event_name) }}</h4>
        </div>
        </div>
      </div>
      <ul class="icon-list icon-list-block">
        <li><i class="fa fa-globe"></i> {{ $post->event_location }}</li>
        <li><i class="fa fa-calendar-o"></i> {{ $post->event_date }}</li>
        <li><i class="fa fa-clock-o"></i> {{ $post->event_time }}</li>
        <li>
          <i class="fa fa-users"></i>
          {{ $post->attendees->count() }} Attendees
          @if($post->user->id != Auth::user()->id)
            @if(Auth::user()->attends()->where('post_id', $post->id)->first())
              <a href="{{ route('attend.event',['post_id'=>$post->id]) }}" class="btn btn-danger btn-stroke btn-xs pull-right">Cancel</a>
            @else
              <a href="{{ route('attend.event',['post_id'=>$post->id]) }}" class="btn btn-primary btn-stroke btn-xs pull-right">Attend</a>
            @endif
          @endif
        </li>
      </ul>
      @if($post->attendees)
        <ul class="img-grid">
        @foreach($post->attendees as $attendee)
          <li>
            <a href="{{ route('get.profile',['username'=>$attendee->user->username]) }}">
              <img src="{{ URL::to('uploads/avatars') }}/{{ $attendee->user->avatar }}" alt="{{ $attendee->user->first_name }}" title="{{ $attendee->user->first_name }}" class="img-responsive">
            </a>
          </li>
        @endforeach
      </ul>
      @endif
      <div class="clearfix"></div>
    </div>
  </div>
</div>
