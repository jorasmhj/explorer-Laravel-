<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Info;
use Illuminate\Support\Facades\Auth;
/**
 *
 */
class InfoController extends Controller
{
  public function postInfoSave(Request $request)
  {
    $gender=$request['gender'];
    $dob=$request['dob'];
    $location=$request['location'];
    $update=false;
    $user=Auth::user();
    $info=$user->info()->where('user_id',$user->id)->first();
    if ($info) {
      $update=true;
    }else{
      $info=new Info();
    }
    $info->dob=$dob;
    $info->gender=$gender;
    $info->location=$location;
    $info->user_id=$user->id;
    if($update){
      $info->update();
    }else{
      $info->save();
    }
    return response()->json( array('success' => true, 'html'=>$gender.$dob.$location));
  }
}
