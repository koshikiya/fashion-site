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
        'name', 'email', 'password',
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
        
        return $this->belongsToMany(User::class,'favorites','user_id','fashion_id')->withTimestamps();
    }
    //お気に入りしているかどうか
    public function favoring($fashionId){
        
        return $this->favorites()->where('fashion_id',$fashionId)->exists();
    }
    
    public function favorite($fashionId){
        $exist = $this->favoring($fashionId);
        
        if(!$exist){
            $this->favorites()->attach($fashionId);
            return true;
        }
    }
    
    public function unfavorite($fashionId){
        $exist = $this->favoring($fashionId);
        
        if($exist){
            $this->favorites()->detach($fashionId);
            return true;
        }
        
    }
    
}
