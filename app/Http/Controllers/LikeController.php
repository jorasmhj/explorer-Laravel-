<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\User;
use Illuminate\Support\Facades\Auth;
/**
 *
 */
class LikeController extends Controller
{
  public function postLike(Request $request){
    $post_id=$request['postId'];
    $post= Post::find($post_id);
    if(!$post){
      return response()->json( array('success' => true, 'info'=>'Post does not exist.','type'=>'error','title'=>'Oops!'));
    }
    if( (Auth::user()->id != $post->user_id) && (!Auth::user()->isFriendsWith(User::find($post->user_id)) )){
      return response()->json( array('success' => true, 'info'=>'You cannot like this post.','type'=>'error','title'=>'Oops!'));
    }
    $like_exist=Auth::user()->likes()->where('post_id',$post_id)->first();
    if($like_exist){
      $like_exist->delete();
      return response()->json( array('success' => true, 'info'=>'Like deleted.','type'=>'success','title'=>'Deleted'));
    }
    $like=new Like();
    $like->user_id=Auth::user()->id;
    $like->post_id=$post_id;
    $like->save();
    return response()->json( array('success' => true, 'info'=>'Liked.','type'=>'success','title'=>'Liked'));
  }
}