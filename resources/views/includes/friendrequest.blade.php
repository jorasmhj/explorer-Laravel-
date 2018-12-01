@if(Auth::user()->friendRequests()->count()>0)
  @foreach(Auth::user()->friendRequests() as $request)
   <li class="" data-username={{  $request->username }}>
    <a href="{{ route('get.profile',['username'=>$request->username]) }}" style="color: rgb(0, 0, 0);">
      <img src="{{ URL::to('uploads/avatars') }}/{{ $request->avatar }}" title="{{ $request->username }}">
    </a>
    <span style="margin-left:10px">{{ ucfirst($request->first_name) }}</span>
    <p style="float:left;padding-left:10px">
    <button class="accept-request" data-username="{{ $request->username }}">Accept</button> 
    <button style="background:#F63E3E">Reject</button></p> 
  </li>
  @endforeach
@else
  <p style="margin-left:10px">No friend request</p>
@endif