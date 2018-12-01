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
class ProfileController extends Controller
{

  public function getProfile($username)
  {
    $user = User::where('username',$username)->first();
    if(!$user){
      dd('no user');
      return redirect()->back()->with('info','There is no username with '.$username);
    }
    return view('profile/index')->with('user',$user);
  }
}
