 <div class="row cover">
  <div class="container">
    <div class="cover-pic">
          <div class="col-md-10 cover-image">
              <form method="post" enctype="multipart/form-data" action="{{ route('change.coverpic') }}" style="display:none">
                  <input type="file" accept="image/*" name="image" id="upload-cover">
                  <button type="submit" id="cover_submit" style="display: none;">Upload Files!</button>
                  <input type="hidden" name="_token" value="{{ Session::token() }}">
              </form>

              <div class="cover-uploader" title="Change cover picture">
                <i class="fa fa-pencil" title="Change Cover image"></i>
                <div class="bubble-holder">
                  <div class="bubble active">
                     Change your profile Picture.
                    <div class="arrow"></div>
                  </div>
                </div>
              </div>

              <img src="{{ URL::to('uploads/covers') }}/{{ $user->cover_pic }}" style="height:auto;width:100%">
          </div>
          <div class="col-md-2 cover-friends hidden-xs">
            @foreach($user->friends() as $friend)
                <a href="{{ route('get.profile',['username'=>$friend->username]) }}">
                    <img src="{{ URL::to('uploads/avatars') }}/{{ $friend->avatar }}" title="{{ ucfirst($friend->first_name) }}" style="position:relative">
                </a>
            @endforeach
          </div>
		</div>
    <div class="cover-menu2">
      <div class="pro-pic-holder2">
        <img src="{{ URL::to('uploads/avatars') }}/{{ $user->avatar }}" class="pro_pic">
        @if(Auth::user()==$user)
          <div class="pro-pic-uploader" title="Change Profile picture">
              <i class="fa fa-pencil"></i>
              @if(Auth::user()->first_login)
                <div class="bubble-holder">
                  <div class="bubble active">
                     Change your profile Picture.
                    <div class="arrow"></div>
                  </div>
                </div>
              @endif
          </div>
          <form method="post" enctype="multipart/form-data" action="{{ route('change.profilepic') }}" style="display:none" id="upload_form">
                <input type="file" name="image" accept="image/*" id="upload-pro-img">
                <button type="submit" id="image_submit" style="display: none;">Upload Files!</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        @endif
         <p class="username"><a  href="{{ route('get.profile',['username'=>$user->username]) }}">{{ ucfirst($user->first_name) }}</a></p>
          @if($user!=Auth::user())
            <div class="a_r">
                  @if(Auth::user()->hasFriendRequestReceived($user))
                      <div class="accept_user" title="Accept friend request" data-username="{{ $user->username }}">
                          <span class="glyphicon glyphicon-ok" data-username="{{ $user->username }}"></span>
                      </div>
                  @elseif(Auth::user()->isFriendsWith($user))
                      <div class="remove_user" title="Delete friend">
                          <span class="glyphicon glyphicon-minus"></span>
                      </div>
                  @else
                      <div class="add_user" title="Add as friend" data-username="{{ $user->username }}"> <!-- onclick="add_friend()-->
                          <span class="glyphicon glyphicon-plus" data-username="{{ $user->username }}"></span>
                      </div>
                  @endif
                </div>
          @endif
      </div>
      <ul class="hidden-xs">
        <li><a href="">Home</a></li>
        <li><a href="">About</a></li>
        <li><a href="{{ route('friends',['user'=>$user]) }}">Friends</a></li>
        <li class="add-event"><a>Add Events</a></li>
      </ul>
    </div>
		        
		        <!--cover munu end-->
    <div class="event-maker">
    </div>
    <div class="event-box">
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-gray">
          <i class="fa fa-fw fa-info-circle"></i> New Event
        </div>
        <div class="panel-body">
          <form class="" action="{{ route('new.event') }}" method="post">
            <ul class="list-unstyled profile-about margin-none">
              <li class="padding-v-5">
              <div class="row">
                <div class="col-sm-4"><span class="text-muted">Event Name</span></div>
                <div class="col-sm-8"><input type="text" id="event_name" required="" name="event_name" value=""></div>
              </div>
              </li>
              <li class="padding-v-5">
                <div class="row">
                  <div class="col-sm-4"><span class="text-muted">Location</span></div>
                <div class="col-sm-8"><input type="text" id="event_location" required="" name="event_location" value=""></div>
                </div>
              </li>
              <li class="padding-v-5">
                <div class="row">
                  <div class="col-sm-4"><span class="text-muted">Date</span></div>
                  <div class="col-sm-8"><input type="text" required="" name="event_date" id="event_date"></div>
                </div>
              </li>
              <li class="padding-v-5">
                <div class="row">
                  <div class="col-sm-4" style="margin-top:15px"><span class="text-muted">Time</span></div>
                  <div class="col-sm-8 input-group clockpicker" style="margin:10px 0px">
                    <input type="text" class="form-control" readonly name="event_time" placeholder="00:00">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                      <script type="text/javascript">
                      $('.clockpicker').clockpicker({
                      placement: 'top',
                      align: 'left',
                      autoclose: true,
                      'default': 'now'
                      });
                      </script>
                  </div>
                </div>
              </li>
              <div class="pull-right">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button type='submit' class="btn btn-primary btn-xs" style="text-align:right">Save</button>
                <button class="btn btn-danger btn-xs" style="text-align:right">Cancel</button>
              </div>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
