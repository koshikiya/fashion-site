<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fashion extends Model
{
    protected $fillable = ['photo', 'user_id','tops','bottoms','shoes','accessory','photo_name'];

    public function user(){
        
        return $this->belongsTo(User::class);
    }
    
    public function favorited(){
        
        return $this->belongsToMany(User::class,'favorites','fashion_id','user_id');
    }
    

    
}

