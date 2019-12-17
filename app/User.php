<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_photo','height','gender','age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function fashions(){
        
        return $this->hasMany(Fashion::class);
    }
    
    public function favorites(){
        
        return $this->belongsToMany(Fashion::class,'favorites','user_id','fashion_id')->withTimestamps();
    }
    //お気に入りしているかどうか
    public function favoring($fashionId){
        
        return $this->favorites()->where('fashion_id',$fashionId)->exists();
    }
    
    public function favorite($fashionId){
        $exist = $this->favoring($fashionId);
        
        if(!$exist){
            $this->favorites()->attach($fashionId);
            return 1;
        }
    }
    
    public function unfavorite($fashionId){
        $exist = $this->favoring($fashionId);
        
        if($exist){
            $this->favorites()->detach($fashionId);
            return 1;
        }
    }
    
    public function followings(){
       
        return $this->belongsToMany(User::class,'follows','user_id','follow_id')->withTimestamps();
    }
    public function followers(){
        
        return $this->belongsToMany(User::class,'follows','follow_id','user_id')->withTimestamps();
    }
    
    public function following($userId){
        return $this->followings()->where('follow_id',$userId)->exists();
    }
    
    public function follow($userId){
        
        $exist = $this->following($userId);
        $me = $this->id == $userId;
        
        if(!$exist || !$me){
            $this->followings()->attach($userId);
            return true; 
        }
    }
    
    public function unfollow($userId){
        $exist = $this->following($userId);
        $me = $this->id == $userId;
        
        if($exist && !$me){
            $this->followings()->detach($userId);
            return true;
        }
    }
    
    public function timeline(){
        
        $following_user_ids = $this->followings()->pluck('users.id')->toArray();
        $following_user_ids[] = $this->id;
        return Fashion::whereIn('user_id',$following_user_ids);
    }
    
}
