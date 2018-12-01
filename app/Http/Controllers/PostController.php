<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\response;
use Image;

/**
 *
 */
class PostController extends Controller
{
    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
          'body'=>'required|max:1000',
        ]);
        $post=new Post();
        $post->body=$request['body'];
        $post->user_id=Auth::user()->id;
        $post->post_type='status';
        $message="There was an error.";
        if ($post->save()) {
            $message="Post succesfully created.";
        }
        $returnHTML = view('includes/posts', ['post'=> $post])->render();
        return ['success' => true, 'html'=>$returnHTML,'id'=>$post->id ];
    }

    public function postDeletePost(Request $request)
    {
        $this->validate($request, [
          'post_id'=>'required|max:1000',
        ]);
        $type="post";
        $post = Post::where('id', $request['post_id'])->first();
        if ($post->parent_id!=null) {
            $type="reply";
        }
        if (Auth::user()!=$post->user && Auth::user() != $post->post->user) {
            return response()->json(array('sucess' => true, 'message'=>'You cannot delete this post.'));
        }
        $message='Something went wrong.';
        $post->replies()->delete();
        if ($post->delete()) {
            $message='Post Deleted.';
        }

        return response()->json(array('success' => true, 'message'=>$message, 'type'=>$type));
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
          'body'=>'required',
        ]);
        $post=Post::find($request['postId']);
        if (Auth::user()!=$post->user) {
            return response(['error'=>'You do not have permission to edit this post'], 200);
        }
        $post->body=$request['body'];
        $post->update();
        if ($post->parent_id==null) {
            return response(['new_body'=>$post->body,'type'=>'post'], 200);
        } else {
            return response(['new_body'=>$post->body,'type'=>'reply'], 200);
        }
    }

    public function postReply(Request $request)
    {
        $exist = Post::where('id', $request['postId'])->first();
        if (!$exist) {
            return response()->json(array('success' => true, 'html'=>'Post does not exist.'));
        }
        $post = new Post();
        $post->body=$request['reply'];
        $post->parent_id=$request['postId'];
        $post->user_id=Auth::user()->id;
        $post->post_type='reply';
        $post->save();
        $returnHTML = view('includes/comments', ['comment'=> $post])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML, 'id'=>$post->id));
    }
  
    public function postPicPost(Request $request)
    {
        $images=Input::file('file');
        $body=Input::get('body');
        if (!$images) {
            return response()->json(array('success' => false, 'html'=>'no'));
        }
        $post = new Post();
        $post->body=$body;
        $post->user_id=Auth::user()->id;
        $post->post_type='picture post';
    
        if (!$post->save()) {
            return response()->json(array('success' => false, 'html'=>'could not post'));
        }
        $id=$post->id;
        foreach (Input::file('file') as $image) {
            $imagename=$image->getClientOriginalName();
            $uploadflag= $image->move('uploads/'.Auth::user()->username.'/'.$id, $imagename);
        }
        if ($uploadflag) {
            $returnHTML = view('includes/picturepost', ['post'=> $post])->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML,'id'=>$post->id));
        }
    }
    
    public function postGetReplies(Request $request)
    {
        $lastid=$request['lastid'];
        $parentpost=$request['parentpost'];
        if (!Post::where('parent_id', $parentpost)->where('id', '<', $lastid)->count() > 0) {
            return response()->json(array('success' => false));
        }
        $precomments=Post::where('parent_id', $parentpost)->where('id', '<', $lastid)->latest()->take(4)->get()->reverse();
        $count=$precomments->count();
        $lastid=$precomments[$count-1]->id;
        $html= view('includes/getcomments')->with('comments', $precomments)->render();
        return response()->json(array('success' => true, 'html'=>$html, 'lastid'=>$lastid));
    }
}
