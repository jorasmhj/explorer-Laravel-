<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Post;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
use Image;
use Illuminate\Support\Facades\File;
/**
 *
 */
class UserController extends Controller
{
  public function getHome()
  {
    if(Auth::check()){
      return redirect()->route('timeline');
    }
    return view('welcome');
  }

  public function getFriends($user)
  {
    $user=User::find($user);
    $friends=$user->friends();
    return view('friends')->with('friends',$friends);
  }

  public function getTimeline(Request $request)
  {
    $posts = Post::notReply()->where(function($query){
      return $query->where('user_id',Auth::user()->id)->orWhereIn('user_id',Auth::user()->friends()->lists('id'));
    })->latest()->paginate(10);
    if($request->ajax()){
      return [
        'posts' => view('includes.getpost')->with('posts',$posts)->render(),
        'next_page' => $posts->nextPageUrl(),
      ];
    }
    return view('timeline')->with('posts',$posts)->with('user',Auth::user());
  }

    public function getLogin(){
        return view('welcome');
    }

  public function postLogIn(Request $request)
  {
    $this->validate($request,[
      'username'=>'required|max:200',
      'password'=>'required|min:5',
    ]);
    $user=User::where('username',$request['username'])->first();
    if(Auth::attempt($request->only(['username','password']), $request->has('remember'))){
      $user=User::where('username',$request['username'])->first();
      $user->first_login=0;
      return response()->json(['user' => $user]);
      return redirect()->intended();
    }
    if($user){
        return redirect()->back()->with('user',$user)->with('info','Password incorrect.')->with('type','error')->with('title','Sorry!');
    }
    return redirect()->back()->with('info','No such user registerd.');
  }

  public function postLoginApi(Request $request){
    return response()->json(['email'=>"asd"]);
  }

  public function getLogout()
  {
    Auth::logOut();
    return redirect()->to('/');
  }

  public function postSignUp(Request $request)
  {
    $this->validate($request, [
      'fname'=>'required|max:200',
      'lname'=>'required|max:200',
      'email'=>'required|unique:users|email|max:200',
      'username'=>'required|unique:users|alpha_dash|max:20',
      'password'=>'required|min:5',
    ]);

    $email=$request['email'];
    $first_name=$request['fname'];
    $last_name=$request['lname'];
    $username=$request['username'];
    $password=bcrypt($request['password']);
    $user = new User();
    $user->email=$email;
    $user->first_name=$first_name;
    $user->last_name=$last_name;
    $user->username=$username;
    $user->password=$password;
    $user->save();
    Auth::logIn($user);
    return redirect()->route('home')->with('firstTime',1);
    
  }

  public function postChangeProfileImage(Request $request)
  {
    $avatar = $request->file('image');
    if($avatar){
      $filename = Auth::user()->first_name . '-' .Auth::user()->id. '.' .$avatar->getClientOriginalExtension();
      Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));
      $user=Auth::user();
      $user->avatar=$filename;
      $user->first_login=0;
      $user->save();
    }
    return redirect()->back();
  }
  
  public function postChangeCoverImage(Request $request)
  {
    $cover = $request->file('image');
    if($cover){
      $filename = Auth::user()->first_name . '-' .Auth::user()->id. '.' .$cover->getClientOriginalExtension();
      Image::make($cover)->resize(720,200)->save(public_path('/uploads/covers/' . $filename));
      $user=Auth::user();
      $user->first_login=0;
      $user->cover_pic=$filename;
      $user->save();
    }
    return redirect()->back();
    
  }


}
