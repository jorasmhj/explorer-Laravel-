<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
/**
 *
 */
class FriendController extends Controller
{
  public function postAddFriend(Request $request)
  {
    //return response()->json( array('success' => true, 'html'=>'ok') );
    $this->validate($request,[
      'username'=>'required',
    ]);
    $username=$request['username'];
    $user=User::where('username',$username)->first();
    if(!$user){
      return response(['new_body'=>'no such username.'],200);
    }
    if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
      return response(['new_body'=>'Friend request pending.'],200);
    }
    if(Auth::user()->id == $user->id){
      return response(['new_body'=>'You cannot add yourself.'],200);
    }
    if(Auth::user()->isFriendsWith($user)){
      return response(['new_body'=>'You two are already friends.'],200);
    }
    Auth::user()->addFriend($user);
    return response(['new_body'=>'Request Sent.'],200);
  }

  public function postAccept(Request $request)
  {
    $this->validate($request,[
      'username'=>'required',
    ]);
    $username=$request['username'];
    $user=User::where('username',$username)->first();
    if(!$user){
      return redirect()->back()->with('info','Username not found.');
    }
    if(!Auth::user()->hasFriendRequestReceived($user)){
      return redirect()->back()->with('info',$user->username.' has not sent you request.');
    }
    Auth::user()->acceptFriendRequest($user);
    return response(['new_body'=>'done'],200);
    dd($username);
  }

  public function postUnfriend()
  {
    return response(['msg'=>'done'],200);
  }
  
  public function getFriendRequest(Request $request){
    if($request->ajax()){
      $user= Auth::user();
      $requests=$user->friendRequests();
      $html= view('includes/friendrequest')->with('requests',$requests)->render();
      return response()->json( array('success' => true, 'html'=>$html));
    }
  }
}
