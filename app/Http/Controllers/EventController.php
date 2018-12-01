<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Attendees;
use Illuminate\Support\Facades\Auth;
/**
 *
 */
class EventController extends Controller
{
  public function postNewEvent(Request $request)
  {
    $this->validate($request,[
      'event_name'=>'required',
      'event_location'=>'required',
      'event_date'=>'required',
      'event_time'=>'required',
    ]);
    $event = new Post();
    $event->post_type='event';
    $event->event_name=$request['event_name'];
    $event->event_location=$request['event_location'];
    $event->event_date=$request['event_date'];
    $event->event_time=$request['event_time'];
    $event->user_id=Auth::user()->id;
    $event->save();
    dd('ok');
  }

  public function postAttendEvent($post_id)
  {
    $post = Post::find($post_id);
    $already_attended=false;
    $check=$post->attendees()->where('user_id',Auth::user()->id)->first();
    if($check){
      $already_attended=true;
    }
    if($already_attended){
      $post->attendees()->where('user_id',Auth::user()->id)->delete();
      dd('canceled');
    }
    if(!$post){
      dd('no such event to attend');
    }
    if(Auth::user() == $post->user){
      dd('You cannot attend your own event');
    }
    if(!Auth::user()->isFriendsWith($post->user)){
      dd('no permission');
    }

    $attend=new Attendees();
    $attend->post_id = $post_id;
    Auth::user()->attends()->save($attend);
    dd('done');
  }

}
