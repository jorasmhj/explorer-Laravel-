<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.

|
*/

Route::get('/', [
  'uses' => '\App\Http\Controllers\UserController@getHome',
  'as' => 'home',
]);

Route::get('/home', [
  'uses' => '\App\Http\Controllers\UserController@getHome',
  'as' => 'home',
]);

Route::get('/timeline', [
  'uses' => '\App\Http\Controllers\UserController@getTimeline',
  'as' => 'timeline',
  'middleware'=>'auth',
]);

Route::get('/logout', [
  'uses' => '\App\Http\Controllers\UserController@getLogout',
  'as' => 'logout',
    'middleware'=>'auth',
]);

Route::post('/login', [
  'uses' => '\App\Http\Controllers\UserController@postLogin',
  'as' => 'login',
    
]);

Route::get('/login', [
  'uses' => '\App\Http\Controllers\UserController@getLogin',
  'as' => 'login',
    'middleware'=>'guest',
]);

Route::post('/signup', [
  'uses' => '\App\Http\Controllers\UserController@postSignup',
  'as' => 'signup',
  'middleware'=>'guest',
]);

Route::post('/createpost', [
  'uses' => '\App\Http\Controllers\PostController@postCreatePost',
  'as' => 'new.post',
  'middleware'=>'auth',
]);

Route::post('/deletepost', [
  'uses' => '\App\Http\Controllers\PostController@postDeletePost',
  'as' => 'delete.post',
  'middleware'=>'auth',
]);

Route::post('/editpost', [
  'uses' => '\App\Http\Controllers\PostController@postEditPost',
  'as' => 'edit.post',
  'middleware'=>'auth',
]);

Route::post('/replypost', [
  'uses' => '\App\Http\Controllers\PostController@postReply',
  'as' => 'reply.post',
  'middleware'=>'auth',
]);

Route::get('/user/{username}', [
  'uses' => '\App\Http\Controllers\ProfileController@getProfile',
  'as' => 'get.profile',
  'middleware'=>'auth',
]);

Route::post('/addfriend', [
  'uses' => '\App\Http\Controllers\FriendController@postAddFriend',
  'as' => 'add.friend',
  'middleware'=>'auth',
]);

Route::post('/acceptfriend', [
  'uses' => '\App\Http\Controllers\FriendController@postAccept',
  'as' => 'accept.friend',
  'middleware'=>'auth',
]);

Route::post('/removefriend', [
  'uses' => '\App\Http\Controllers\FriendController@postUnfriend',
  'as' => 'remove.friend',
  'middleware'=>'auth',
]);


Route::post('/saveinfo', [
  'uses' => '\App\Http\Controllers\InfoController@postInfoSave',
  'as' => 'info.save',
  'middleware'=>'auth',
]);

Route::post('/newevent', [
  'uses' => '\App\Http\Controllers\EventController@postNewEvent',
  'as' => 'new.event',
  'middleware'=>'auth',
]);

Route::get('/attendevent/{post_id}', [
  'uses' => '\App\Http\Controllers\EventController@postAttendEvent',
  'as' => 'attend.event',
  'middleware'=>'auth',
]);

Route::post('/changepic', [
  'uses' => '\App\Http\Controllers\UserController@postChangeProfileImage',
  'as' => 'change.profilepic',
  'middleware'=>'auth',
]);

Route::post('/changecover', [
  'uses' => '\App\Http\Controllers\UserController@postChangeCoverImage',
  'as' => 'change.coverpic',
  'middleware'=>'auth',
]);

Route::get('/userimage/{filename}',[
  'uses' => '\App\Http\Controllers\UserController@getUserImage',
  'as'=>'account.image',
  'middleware'=>'auth',
]);

Route::get('/friends/{user}',[
  'uses' => '\App\Http\Controllers\UserController@getFriends',
  'as'=>'friends',
]);

Route::post('/picpost',[
  'uses' => '\App\Http\Controllers\PostController@postPicPost',
  'as'=>'picpost',
  'middleware'=>'auth',
]);

Route::get('/getrequest',[
  'uses' => '\App\Http\Controllers\FriendController@getFriendRequest',
  'as'=>'getrequest',
]);

Route::post('/likepost',[
  'uses' => '\App\Http\Controllers\LikeController@postLike',
  'as'=>'likepost',
  'middleware'=>'auth',
]);

Route::post('/comments', [
  'uses' => '\App\Http\Controllers\PostController@postGetReplies',
  'as' => 'get.comments',
  'middleware'=>'auth',
]);

Route::group(['prefix' => 'api'], function () {
  Route::post('/login', function(){
    return "haha";
  });
});

Route::group([

  'middleware' => 'api',
  'prefix' => 'api'

], function ($router) {

  Route::post('login', 'UserController@postLogin');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');

});