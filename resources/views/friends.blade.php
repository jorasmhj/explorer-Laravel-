@extends('layout.master')
@section('title')
  Friends
@endsection
@section('content')
<div class="container">
  <div class="friends">
    <div class="row friends-filter text-center">
      <input type="text" class="quicksearch" placeholder="Search" />
    </div>
    <div class="grid">
      @foreach($friends as $friend)
        @if($friend->id != Auth::user()->id)
        <div class="grid-item" >
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="media">
                <div class="pull-left">
                 <a href="{{ route('get.profile',['username'=>$friend->username]) }}">
                  <img src="{{ URL::to('uploads/avatars') }}/{{ $friend->avatar }}" alt="people" class="media-object img-circle" style="margin-top:-5px">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading margin-v-5">
                  <a href="{{ route('get.profile',['username'=>$friend->username]) }}">
                    {{ ucfirst($friend->first_name) }}
                  </a>
                  </h4>
                  <div class="profile-icons">
                    <span><i class="fa fa-users"></i> {{ $friend->friends()->count() }}</span>
                    <span><i class="fa fa-photo"></i> 43</span>
                    <span><i class="fa fa-video-camera"></i> 3</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <p class="common-friends">Common Friends</p>
              <div class="user-friend-list">
                @foreach($friend->friends() as $friendsoffriend)
                  @if($friendsoffriend!=Auth::user() && Auth::user()->isFriendsWith($friendsoffriend))
                    <a href="{{ route('get.profile',['username'=>$friendsoffriend->username]) }}">
                      <img src="{{ URL::to('uploads/avatars') }}/{{ $friendsoffriend->avatar }}" alt="people" class="img-circle" title="{{ $friendsoffriend->first_name }}">
                    </a>
                  
                  @endif
                @endforeach
              </div>
            </div>
            <div class="panel-footer">
              @if(Auth::user()->hasFriendRequestReceived($friend))
                <div class="accept_user" title="Accept friend request" data-username="{{ $friend->username }}">
                  <a href="#" class="btn btn-primary btn-sm">Accept <i class="fa fa-ok"></i></a>
                </div>
              @elseif(Auth::user()->isFriendsWith($friend))
                <div class="remove_user" title="Delete friend">
                  <a href="#" class="btn btn-danger btn-sm" data-username="{{ $friend->username }}">Unfriend <i class="fa fa-close"></i></a>
                </div>
              @else
                <div class="add_user" title="Add as friend" data-username="{{ $friend->username }}"> <!-- onclick="add_friend()-->
                  <a href="#" class="btn btn-primary btn-sm" data-username="{{ $friend->username }}">Add <i class="fa fa-plus"></i></a>
                </div>
              @endif
            </div>
          </div>
        </div>
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection

<script type="text/javascript">
  var urladdfriend="{{ route('add.friend') }}";
  var token="{{ Session::token() }}";
  var urlinfo = "{{ route('info.save') }}";
  var urlaccept = "{{ route('accept.friend') }}";
  var urlchangepic = "{{ route('change.profilepic') }}";
  var unfriend= "{{ route('remove.friend') }}";
</script>
