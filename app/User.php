<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function posts()
    {
      return $this->hasMany('App\Post');
    }
  
    public function likes()
    {
      return $this->hasMany('App\Like');
    }

    public function info()
    {
      return $this->hasOne('App\Info','user_id');
    }

    public function attends()
    {
      return $this->hasMany('App\Attendees','user_id');
    }

    public function friendsOfMine(){
      return $this->belongsToMany('App\User','friends','from_id','to_id');
    }

    public function friendsOf(){
      return $this->belongsToMany('App\User','friends','to_id','from_id');
    }

    public function friends(){
      return $this->friendsOfMine()->wherePivot('accepted',true)->get()->merge($this->friendsOf()->wherePivot('accepted',true)->get());
    }

    public function friendRequests(){
      return $this->friendsOfMine()->wherePivot('accepted',false)->get();
    }

    public function friendRequestPending(){
      return $this->friendsOf()->wherePivot('accepted',false)->get();
    }

    public function hasFriendRequestPending(User $user){
      return (bool) $this->friendRequestPending()->where('username',$user->username)->count();
    }

    public function hasFriendRequestReceived(User $user){
      return (bool) $this->friendRequests()->where('id',$user->id)->count();
    }

    public function addFriend(User $user){
      $this->friendsOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user){
      $this->friendRequests()->where('id',$user->id)->first()->pivot->update([
        'accepted'=>true,
      ]);
    }

    public function isFriendsWith(User $user)
    {
      return (bool) $this->friends()->where('id',$user->id)->count();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
